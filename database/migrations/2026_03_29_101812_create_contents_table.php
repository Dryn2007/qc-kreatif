<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('klien'); // Untuk BIG, HH, HFC
            $table->string('hari'); // Untuk Kamis, Jumat, Sabtu, Minggu
            $table->string('minggu')->default('Minggu 1');
            $table->string('pilar_konten')->nullable(); // Story Telling, Hiburan, dll
            $table->text('script_video')->nullable();
            $table->text('caption')->nullable();
            $table->string('link_referensi')->nullable();
            $table->string('link_gdrive')->nullable();
            $table->string('status')->default('kosong'); // kosong, take, edit, acc, upload
            $table->text('catatan_qc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
