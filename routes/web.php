<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;

// Halaman Utama & Filter Minggu
Route::get('/', [ContentController::class, 'index'])->name('home');

// Tambah & Simpan Jadwal
Route::get('/tambah-jadwal', [ContentController::class, 'create'])->name('jadwal.create');
Route::post('/simpan-jadwal', [ContentController::class, 'store'])->name('jadwal.store');

// Update Status Real-time
Route::put('/update-status/{id}', [ContentController::class, 'updateStatus'])->name('update.status');

// Reset Semua Data (Hapus Mingguan)
Route::delete('/hapus-semua', [ContentController::class, 'deleteAll'])->name('jadwal.delete_all');

// Simpan Detail (Script, Caption, Link)
Route::put('/update-detail/{id}', [ContentController::class, 'updateDetail'])->name('jadwal.update_detail');

// Hapus 1 Jadwal Saja
Route::delete('/hapus-jadwal/{id}', [ContentController::class, 'destroy'])->name('jadwal.destroy');

// Upload jadwal dari screenshot (OCR)
Route::get('/upload-jadwal', [ContentController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload-jadwal', [ContentController::class, 'processUpload'])->name('upload.process');
Route::post('/upload-jadwal/save', [ContentController::class, 'processSave'])->name('upload.save');
