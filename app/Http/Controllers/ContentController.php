<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $minggu_aktif = $request->query('minggu', 'Minggu 1');

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

    public function destroy($id)
    {
        Content::destroy($id);
        return back()->with('success', 'Jadwal berhasil dihapus!');
    }

    // Export contents as CSV (for Excel compatibility)
    public function exportExcel(Request $request)
    {
        $minggu = $request->query('minggu', 'Minggu 1');
        $contents = Content::where('minggu', $minggu)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        $filename = 'laporan_qc_' . str_replace(' ', '_', strtolower($minggu)) . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Hari', 'Klien', 'Pilar Konten', 'Status', 'Script', 'Caption', 'Link Referensi', 'Link GDrive'];

        $callback = function () use ($contents, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($contents as $c) {
                fputcsv($file, [
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
        $minggu = $request->query('minggu', 'Minggu 1');
        $contents = Content::where('minggu', $minggu)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get()
            ->groupBy('hari');

        // If Dompdf is installed, render PDF and return download
        if (class_exists(\Dompdf\Dompdf::class)) {
            $html = view('pdf_report', ['contents' => $contents, 'minggu' => $minggu])->render();
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $output = $dompdf->output();

            $filename = 'laporan_qc_' . str_replace(' ', '_', strtolower($minggu)) . '.pdf';
            return response($output, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]);
        }

        // Fallback: return HTML view (user can print to PDF from browser)
        return view('pdf_report', ['contents' => $contents, 'minggu' => $minggu]);
    }
}
