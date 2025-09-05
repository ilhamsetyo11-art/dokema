<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Magang\ProfilPesertaController;
use App\Http\Controllers\Magang\DataMagangController;
use App\Http\Controllers\Magang\LaporanKegiatanController;
use App\Http\Controllers\Magang\LogBimbinganController;
use App\Http\Controllers\Magang\PenilaianAkhirController;

Route::get('/', function () {
    return view('welcome');
});
// Profil Peserta
Route::get('/profil', [ProfilPesertaController::class, 'index'])->name('profil.index');
Route::get('/profil/create', [ProfilPesertaController::class, 'create'])->name('profil.create');
Route::post('/profil', [ProfilPesertaController::class, 'store'])->name('profil.store');
Route::get('/profil/edit', [ProfilPesertaController::class, 'edit'])->name('profil.edit');
Route::put('/profil', [ProfilPesertaController::class, 'update'])->name('profil.update');

// Data Magang
Route::get('/magang', [DataMagangController::class, 'index'])->name('magang.index');
Route::get('/magang/create', [DataMagangController::class, 'create'])->name('magang.create');
Route::post('/magang', [DataMagangController::class, 'store'])->name('magang.store');

// Laporan Kegiatan
Route::get('/magang/{magangId}/laporan', [LaporanKegiatanController::class, 'index'])->name('laporan.index');
Route::get('/magang/{magangId}/laporan/create', [LaporanKegiatanController::class, 'create'])->name('laporan.create');
Route::post('/magang/{magangId}/laporan', [LaporanKegiatanController::class, 'store'])->name('laporan.store');

// Log Bimbingan
Route::get('/magang/{magangId}/bimbingan', [LogBimbinganController::class, 'index'])->name('bimbingan.index');
Route::get('/magang/{magangId}/bimbingan/create', [LogBimbinganController::class, 'create'])->name('bimbingan.create');
Route::post('/magang/{magangId}/bimbingan', [LogBimbinganController::class, 'store'])->name('bimbingan.store');

// Penilaian Akhir
Route::get('/magang/{magangId}/penilaian', [PenilaianAkhirController::class, 'index'])->name('penilaian.index');
Route::get('/magang/{magangId}/penilaian/create', [PenilaianAkhirController::class, 'create'])->name('penilaian.create');
Route::post('/magang/{magangId}/penilaian', [PenilaianAkhirController::class, 'store'])->name('penilaian.store');
