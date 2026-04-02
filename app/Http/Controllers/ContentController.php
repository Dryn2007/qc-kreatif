<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

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
}


