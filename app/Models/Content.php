<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    // Ini cara paling cepat: mengizinkan semua kolom diisi data
    protected $guarded = [];

    // (Opsional) Kalau di dunia kerja nanti, biasanya pakai $fillable seperti di bawah ini untuk keamanan ekstra:

    // protected $fillable = [
    //     'klien',
    //     'hari',
    //     'pilar_konten',
    //     'script_video',
    //     'caption',
    //     'link_referensi',
    //     'link_gdrive',
    //     'status',
    //     'catatan_qc'
    // ];

}
