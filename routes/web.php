<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\RelasiController;
use App\Http\Controllers\LaporanController;

// ===== ROUTE USER (tanpa login) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

// Diagnosa
Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa');
Route::post('/diagnosa/proses', [DiagnosaController::class, 'proses'])->name('diagnosa.proses');
Route::get('/diagnosa/hasil/{kode_sesi}', [DiagnosaController::class, 'hasil'])->name('diagnosa.hasil');
Route::get('/diagnosa/cetak/{kode_sesi}', [DiagnosaController::class, 'cetak'])->name('diagnosa.cetak');

// ===== ROUTE AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== ROUTE ADMIN (harus login) =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Penyakit
    Route::resource('penyakit', PenyakitController::class);

    // Gejala
    Route::resource('gejala', GejalaController::class);

    // Relasi
    Route::resource('relasi', RelasiController::class);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/cetak/{sesi_id}', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    Route::get('/aturan', [RelasiController::class, 'aturan'])->name('aturan');
});