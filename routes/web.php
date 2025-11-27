<?php


use App\Http\Controllers\AlatController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriAlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PeminjamanController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : view('auth.login');
});

/* Resource routes */
Route::resource('pemesanans', PemesananController::class);
Route::resource('alats', AlatController::class);
Route::resource('kategori-alats', KategoriAlatController::class);
Route::resource('pelanggans', PelangganController::class);
Route::resource('peminjamans', PeminjamanController::class);

/* Export routes for Pemesanan */
Route::get('pemesanans-export-pdf', [PemesananController::class, 'exportPdf'])->name('pemesanans.export.pdf');
Route::get('pemesanans-export-excel', [PemesananController::class, 'exportExcel'])->name('pemesanans.export.excel');

/* Export routes for Peminjaman */
Route::get('peminjamans-export-pdf', [PeminjamanController::class, 'exportPDF'])->name('peminjamans.export.pdf');
Route::get('peminjamans-export-excel', [PeminjamanController::class, 'exportExcel'])->name('peminjamans.export.excel');

/* Export routes for Alat */
Route::get('alats-export-pdf', [AlatController::class, 'exportPdf'])->name('alats.export.pdf');
Route::get('alats-export-excel', [AlatController::class, 'exportExcel'])->name('alats.export.excel');

/* Export routes for KategoriAlat */
Route::get('kategori-alats-export-pdf', [KategoriAlatController::class, 'exportPdf'])->name('kategori-alats.export.pdf');
Route::get('kategori-alats-export-excel', [KategoriAlatController::class, 'exportExcel'])->name('kategori-alats.export.excel');

/* Export routes for Pelanggan */
Route::get('pelanggans-export-pdf', [PelangganController::class, 'exportPdf'])->name('pelanggans.export.pdf');
Route::get('pelanggans-export-excel', [PelangganController::class, 'exportExcel'])->name('pelanggans.export.excel');

/* New routes for pesan form related to pemesanan */
Route::get('pemesanans/{id}/pesan', [PemesananController::class, 'pesanForm'])->name('pemesanans.pesan.form');
Route::post('pemesanans/{id}/pesan', [PemesananController::class, 'storePesan'])->name('pemesanans.pesan.store');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pengeluaran', [App\Http\Controllers\PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/pay/{id}', [App\Http\Controllers\PengeluaranController::class, 'pay'])->name('pengeluaran.pay');
    Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');
    Route::get('/customer-service/cara-pemesanan', [CustomerServiceController::class, 'caraPemesanan'])->name('customer-service.cara-pemesanan');
    Route::get('/customer-service/masalah-pembayaran', [CustomerServiceController::class, 'masalahPembayaran'])->name('customer-service.masalah-pembayaran');
    Route::get('/customer-service/pengembalian-alat', [CustomerServiceController::class, 'pengembalianAlat'])->name('customer-service.pengembalian-alat');
    Route::get('/customer-service/masalah-teknis', [CustomerServiceController::class, 'masalahTeknis'])->name('customer-service.masalah-teknis');
    Route::get('/customer-service/lainnya', [CustomerServiceController::class, 'lainnya'])->name('customer-service.lainnya');
    Route::get('/customer-service/ketentuan-pelanggan', [CustomerServiceController::class, 'ketentuanPelanggan'])->name('customer-service.ketentuan-pelanggan');
    Route::resource('kategori-alats', KategoriAlatController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('pelanggans', PelangganController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// New routes for pesan form related to pemesanan
Route::get('pemesanans/{id}/pesan', [PemesananController::class, 'pesanForm'])->name('pemesanans.pesan.form');
Route::post('pemesanans/{id}/pesan', [PemesananController::class, 'storePesan'])->name('pemesanans.pesan.store');



Route::get('pemesanans-export-pdf', [PemesananController::class, 'exportPdf'])->name('pemesanans.export.pdf');
Route::get('pemesanans-export-excel', [PemesananController::class, 'exportExcel'])->name('pemesanans.export.excel');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pengeluaran', [App\Http\Controllers\PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/pay/{id}', [App\Http\Controllers\PengeluaranController::class, 'pay'])->name('pengeluaran.pay');
    Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');
    Route::get('/customer-service/cara-pemesanan', [CustomerServiceController::class, 'caraPemesanan'])->name('customer-service.cara-pemesanan');
    Route::get('/customer-service/masalah-pembayaran', [CustomerServiceController::class, 'masalahPembayaran'])->name('customer-service.masalah-pembayaran');
    Route::get('/customer-service/pengembalian-alat', [CustomerServiceController::class, 'pengembalianAlat'])->name('customer-service.pengembalian-alat');
    Route::get('/customer-service/masalah-teknis', [CustomerServiceController::class, 'masalahTeknis'])->name('customer-service.masalah-teknis');
    Route::get('/customer-service/lainnya', [CustomerServiceController::class, 'lainnya'])->name('customer-service.lainnya');
    Route::get('/customer-service/ketentuan-pelanggan', [CustomerServiceController::class, 'ketentuanPelanggan'])->name('customer-service.ketentuan-pelanggan');
    Route::resource('kategori-alats', KategoriAlatController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('pelanggans', PelangganController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


