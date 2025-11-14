<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\KategoriAlat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlats = Alat::sum('stok');
        $totalKategori = KategoriAlat::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanBulanIni = Peminjaman::whereMonth('created_at', now()->month)->count();

        // Data untuk chart peminjaman per bulan - menggunakan PostgreSQL syntax
        $peminjamanPerBulan = Peminjaman::selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as jumlah')
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [now()->year])
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        return view('dashboard', compact('totalAlats', 'totalKategori', 'totalPeminjaman', 'peminjamanBulanIni', 'peminjamanPerBulan'));
    }
}
