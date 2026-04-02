<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use GuzzleHttp\Client;

/**
 * Notes:
 * - This controller now supports uploading an image (screenshot) that contains
 *   the weekly schedule. It will call OCR.space (if API key provided via
 *   OCR_SPACE_API_KEY env) to extract text, parse it into day/entries, and
 *   create `Content` records.
 */

class ContentController extends Controller
{
    public function index(Request $request)
    {
        // Ambil minggu aktif dari URL, default Minggu 1
        $minggu_aktif = $request->query('minggu', 'Minggu 1');

        // Ambil data berdasarkan minggu dan urutkan harinya
        $contents = Content::where('minggu', $minggu_aktif)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get()
            ->groupBy('hari');

        return view('welcome', compact('contents', 'minggu_aktif'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'klien' => 'required',
            'hari' => 'required',
            'minggu' => 'required',
            'pilar_konten' => 'required',
        ]);

        Content::create([
            'klien' => $request->klien,
            'hari' => $request->hari,
            'minggu' => $request->minggu,
            'pilar_konten' => $request->pilar_konten,
            'status' => 'kosong'
        ]);

        return redirect('/?minggu=' . $request->minggu);
    }

    public function updateStatus(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->update(['status' => $request->status]);
        return back();
    }

    public function deleteAll()
    {
        Content::truncate();
        return redirect('/');
    }

    // Fungsi untuk menyimpan isian Modal Detail
    public function updateDetail(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->update([
            'script_video' => $request->script_video,
            'caption' => $request->caption,
            'link_referensi' => $request->link_referensi,
            'link_gdrive' => $request->link_gdrive,
        ]);

        return back()->with('success', 'Detail berhasil disimpan!');
    }

    // Fungsi untuk menghapus 1 data
    public function destroy($id)
    {
        Content::destroy($id);
        return back()->with('success', 'Jadwal berhasil dihapus!');
    }

    // Show upload form
    public function showUploadForm()
    {
        return view('upload');
    }

    // Handle upload and OCR parsing
    public function processUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240', // max 10MB
            'minggu' => 'nullable|string'
        ]);

        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        $fullPath = storage_path('app/public/' . $path);

        // Use OCR.space if key available; otherwise try demo key 'helloworld' (limited)
        $apiKey = env('OCR_SPACE_API_KEY', 'helloworld');

        $client = new Client(['timeout' => 30]);

        try {
            $base64 = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($fullPath));

            $response = $client->request('POST', 'https://api.ocr.space/parse/image', [
                'form_params' => [
                    'apikey' => $apiKey,
                    'base64Image' => $base64,
                    'language' => 'ind',
                    'isOverlayRequired' => 'false'
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            if (empty($body['ParsedResults'][0]['ParsedText'])) {
                return back()->with('error', 'OCR gagal mengekstrak teks dari gambar.');
            }

            $text = $body['ParsedResults'][0]['ParsedText'];
        } catch (\Throwable $e) {
            return back()->with('error', 'Terjadi kesalahan OCR: ' . $e->getMessage());
        }

        // Parse the extracted text into schedule entries
        $lines = preg_split('/\r\n|\n|\r/', $text);
        $daysMap = ['SENIN' => 'Senin', 'SELASA' => 'Selasa', 'RABU' => 'Rabu', 'KAMIS' => 'Kamis', 'JUMAT' => 'Jumat', 'SABTU' => 'Sabtu', 'MINGGU' => 'Minggu'];
        $currentDay = null;
        $created = 0;
        $minggu = $request->input('minggu', 'Minggu 1');

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            // Check if line is a day header
            $upper = mb_strtoupper(preg_replace('/[^\p{L}]/u', '', $line));
            if (isset($daysMap[$upper])) {
                $currentDay = $daysMap[$upper];
                continue;
            }

            // Try to parse key:value pair (e.g., BIG: Hiburan)
            if (preg_match('/^([A-Za-z0-9 _\-]+)\s*[:\-]\s*(.+)$/u', $line, $m)) {
                $key = trim($m[1]);
                $value = trim($m[2]);

                // Remove common emoji markers and checkmarks
                $value = preg_replace('/[✅✔✖❌❗❓\x{1F600}-\x{1F6FF}]/u', '', $value);
                $value = trim($value);

                if ($currentDay) {
                    Content::create([
                        'klien' => $key,
                        'hari' => $currentDay,
                        'minggu' => $minggu,
                        'pilar_konten' => $value,
                        'status' => 'kosong'
                    ]);
                    $created++;
                }
            }
        }

        return redirect('/')->with('success', "Upload selesai. $created entri dibuat untuk $minggu.");
    }
}
