<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'pelanggan', 'alats'])->paginate(10);
        $alats = Alat::all();
        $users = \App\Models\User::all();
        return view('peminjamans.index', compact('peminjamans', 'alats', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alats = Alat::all();
        $users = \App\Models\User::all();
        $pelanggans = \App\Models\Pelanggan::all();
        return view('peminjamans.create', compact('alats', 'users', 'pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            foreach ($request->alats as $alatData) {
                $alat = Alat::findOrFail($alatData['id']);
                $total += $alat->harga * $alatData['jumlah'];
            }

            // Apply 70% discount on total (total becomes 30% of original price)
            $total = $total * 0.3;

            $peminjaman = Peminjaman::create([
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => $request->user_id,
                'total' => $total,
                'is_done' => false,
            ]);

            foreach ($request->alats as $alatData) {
                $peminjaman->alats()->attach($alatData['id'], ['jumlah' => $alatData['jumlah']]);
            }
        });

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'alats']);
        $alats = Alat::all();
        $users = \App\Models\User::all();
        return view('peminjamans.show', compact('peminjaman', 'alats', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'pelanggan', 'alats']);
        $alats = Alat::all();
        $users = \App\Models\User::all();
        $pelanggans = \App\Models\Pelanggan::all();
        return view('peminjamans.edit', compact('peminjaman', 'alats', 'users', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {
            $total = 0;
            foreach ($request->alats as $alatData) {
                $alat = Alat::findOrFail($alatData['id']);
                $total += $alat->harga * $alatData['jumlah'];
            }

            // Apply 70% discount on total (total becomes 30% of original price)
            $total = $total * 0.3;

            $peminjaman->update([
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => $request->user_id,
                'total' => $total,
            ]);

            $peminjaman->alats()->detach();

            foreach ($request->alats as $alatData) {
                $peminjaman->alats()->attach($alatData['id'], ['jumlah' => $alatData['jumlah']]);
            }
        });

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            $peminjaman->alats()->detach();
            $peminjaman->delete();
        });

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman deleted successfully');
    }

    /**
     * Export peminjaman data to Excel.
     */
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PeminjamanExport, 'peminjaman.xlsx');
    }

    /**
     * Export peminjaman data to PDF.
     */
    public function exportPDF()
    {
        $peminjamans = Peminjaman::all();
        $pdf = \PDF::loadView('peminjamans.export_pdf', compact('peminjamans'));
        return $pdf->download('peminjaman.pdf');
    }
}
