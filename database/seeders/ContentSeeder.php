<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            // KAMIS
            ['klien' => 'BIG', 'hari' => 'Kamis', 'pilar_konten' => 'Story Telling', 'status' => 'upload'],
            ['klien' => 'HH', 'hari' => 'Kamis', 'pilar_konten' => 'Hiburan', 'status' => 'upload'],
            ['klien' => 'HFC', 'hari' => 'Kamis', 'pilar_konten' => 'Promosi', 'status' => 'upload'],

            // JUMAT
            ['klien' => 'BIG', 'hari' => 'Jumat', 'pilar_konten' => 'Kandungan Manfaat', 'status' => 'upload'],
            ['klien' => 'HH', 'hari' => 'Jumat', 'pilar_konten' => 'Tips & Trik', 'status' => 'edit'], // Contoh status: proses edit
            ['klien' => 'HFC', 'hari' => 'Jumat', 'pilar_konten' => 'Q&A', 'status' => 'take'], // Contoh status: udah take

            // SABTU
            ['klien' => 'BIG', 'hari' => 'Sabtu', 'pilar_konten' => 'Hiburan', 'status' => 'upload'],
            ['klien' => 'HH', 'hari' => 'Sabtu', 'pilar_konten' => 'Hiburan', 'status' => 'acc'], // Contoh status: udh acc blm upload
            ['klien' => 'HFC', 'hari' => 'Sabtu', 'pilar_konten' => 'Promosi', 'status' => 'kosong'], // Belum diapa-apain

            // MINGGU
            ['klien' => 'BIG', 'hari' => 'Minggu', 'pilar_konten' => 'Q & A', 'status' => 'upload'],
            ['klien' => 'HH', 'hari' => 'Minggu', 'pilar_konten' => 'Promosi', 'status' => 'edit'],
            ['klien' => 'HFC', 'hari' => 'Minggu', 'pilar_konten' => 'Challenge game', 'status' => 'take'],
        ];

        foreach ($data as $item) {
            DB::table('contents')->insert([
                'klien' => $item['klien'],
                'hari' => $item['hari'],
                'pilar_konten' => $item['pilar_konten'],
                'status' => $item['status'],
                'script_video' => 'Contoh draft script untuk video ' . $item['pilar_konten'] . ' brand ' . $item['klien'],
                'caption' => 'Contoh caption siap upload untuk ' . $item['klien'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
