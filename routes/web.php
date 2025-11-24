<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriAlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : view('auth.login');
});

Route::resource('pemesanans', PemesananController::class);
Route::get('pemesanans-export-pdf', [PemesananController::class, 'exportPdf'])->name('pemesanans.export.pdf');
Route::get('pemesanans-export-excel', [PemesananController::class, 'exportExcel'])->name('pemesanans.export.excel');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');
    Route::get('/customer-service/cara-pemesanan', [CustomerServiceController::class, 'caraPemesanan'])->name('customer-service.cara-pemesanan');
    Route::get('/customer-service/masalah-pembayaran', [CustomerServiceController::class, 'masalahPembayaran'])->name('customer-service.masalah-pembayaran');
    Route::get('/customer-service/pengembalian-alat', [CustomerServiceController::class, 'pengembalianAlat'])->name('customer-service.pengembalian-alat');
    Route::get('/customer-service/masalah-teknis', [CustomerServiceController::class, 'masalahTeknis'])->name('customer-service.masalah-teknis');
    Route::get('/customer-service/lainnya', [CustomerServiceController::class, 'lainnya'])->name('customer-service.lainnya');
    Route::resource('kategori-alats', KategoriAlatController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('pelanggans', PelangganController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
