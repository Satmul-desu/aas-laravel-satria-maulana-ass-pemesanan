<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\KategoriAlat;
use App\Models\Pemesanan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlats = Alat::sum('stok');
        $totalKategori = KategoriAlat::count();
        $totalPemesanan = Pemesanan::count();
        $pemesananBulanIni = Pemesanan::whereMonth('created_at', now()->month)->count();

        $peminjamanBulanIni = Peminjaman::whereMonth('created_at', now()->month)->count();

        $totalPemasukanPemesanan = Pemesanan::sum('total');
        $totalPemasukanPeminjaman = Peminjaman::sum('total');
        $totalPemasukan = $totalPemasukanPemesanan + $totalPemasukanPeminjaman;

        $saldo = Saldo::latest()->first();
        $currentSaldo = $saldo ? $saldo->amount : 0;

        $pemesananPerBulan = Pemesanan::selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as jumlah')
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [now()->year])
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        $peminjamanCount = Peminjaman::count();
        $recentPeminjamans = Peminjaman::with('user')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard', compact(
            'totalAlats',
            'totalKategori',
            'totalPemesanan',
            'peminjamanCount',
            'pemesananBulanIni',
            'peminjamanBulanIni',
            'pemesananPerBulan',
            'totalPemasukan',
            'currentSaldo',
            'recentPeminjamans'
        ));
    }
}
