<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\KategoriAlat;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlats = Alat::sum('stok');
        $totalKategori = KategoriAlat::count();
        $totalPemesanan = Pemesanan::count();
        $pemesananBulanIni = Pemesanan::whereMonth('created_at', now()->month)->count();
        $totalKerugian = 0;

        $pemesananPerBulan = Pemesanan::selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as jumlah')
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [now()->year])
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        return view('dashboard', compact('totalAlats', 'totalKategori', 'totalPemesanan', 'pemesananBulanIni', 'totalKerugian', 'pemesananPerBulan'));
    }
}
