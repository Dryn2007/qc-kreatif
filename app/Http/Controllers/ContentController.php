<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua data tanpa filter minggu
        // 2. Urutkan berdasarkan minggu, lalu hari
        // 3. Group utama berdasarkan klien
        $contents = Content::orderBy('minggu')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get()
            ->groupBy('klien');

        return view('welcome', compact('contents'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'klien' => 'required',
            'minggu' => 'required',
            'hari' => 'required',
            'tanggal' => 'required|date',
            'pilar_konten' => 'required',
        ]);

        // Cek apakah klien sudah ada jadwal di hari dan minggu tersebut
        $exists = Content::where('klien', $request->klien)
            ->where('minggu', $request->minggu)
            ->where('hari', $request->hari)
            ->exists();

        if ($exists) {
            return back()->with('error', "Jadwal untuk klien {$request->klien} di hari {$request->hari} pada {$request->minggu} sudah ada!");
        }

        Content::create([
            'klien' => $request->klien,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'minggu' => $request->minggu,
            'pilar_konten' => $request->pilar_konten,
            'status' => 'kosong'
        ]);

        return redirect('/')->with('success', 'Jadwal baru berhasil ditambahkan!');
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

    public function updateDetail(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $request->validate([
            'pilar_konten' => 'required',
            'status' => 'required',
            'link_referensi' => $request->status == 'done_upload' ? 'required|url' : 'nullable|url',
        ]);

        $content->update([
            'pilar_konten' => $request->pilar_konten,
            'status' => $request->status,
            'link_referensi' => $request->link_referensi,
        ]);

        return back()->with('success', 'Detail konten berhasil diperbarui');
    }

    public function destroy($id)
    {
        Content::destroy($id);
        return back()->with('success', 'Jadwal berhasil dihapus!');
    }

    // Export contents as CSV (for Excel compatibility)
    public function exportExcel(Request $request)
    {
        $contents = Content::orderBy('minggu')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        $filename = 'laporan_qc_all.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Minggu', 'Hari', 'Klien', 'Pilar Konten', 'Status', 'Script', 'Caption', 'Link Referensi', 'Link GDrive'];

        $callback = function () use ($contents, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($contents as $c) {
                fputcsv($file, [
                    $c->minggu,
                    $c->hari,
                    $c->klien,
                    $c->pilar_konten,
                    $c->status,
                    $c->script_video,
                    $c->caption,
                    $c->link_referensi,
                    $c->link_gdrive,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Export contents as PDF (uses dompdf if available, otherwise returns HTML view)
    public function exportPdf(Request $request)
    {
        $contents = Content::orderBy('minggu')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get()
            ->groupBy('klien');

        // If Dompdf is installed, render PDF and return download
        if (class_exists(\Dompdf\Dompdf::class)) {
            $html = view('pdf_report', ['contents' => $contents])->render();
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $output = $dompdf->output();

            $filename = 'laporan_qc_all.pdf';
            return response($output, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]);
        }

        // Fallback: return HTML view (user can print to PDF from browser)
        return view('pdf_report', ['contents' => $contents]);
    }
}
