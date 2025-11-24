<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alats = Alat::with('kategori')->paginate(10);
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.index', compact('alats', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori_alats,id',
            'kondisi' => 'required|in:baru,bekas',
            'status_fungsi' => 'required|in:berfungsi,tidak_berfungsi',
            'kualitas' => 'required|in:baik,buruk',
            'layak' => 'required|in:layak,tidak_layak',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        Alat::create($request->all());

        return redirect()->route('alats.index')->with('success', 'Alat berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        // Load relationships for detailed view
        $alat->load(['kategori', 'peminjamanDetails.peminjaman.user']);

        // Get recent peminjaman history
        $recentPeminjaman = $alat->peminjamanDetails()
            ->with(['peminjaman.user'])
            ->latest()
            ->take(10)
            ->get();

        // Calculate statistics
        $totalPeminjaman = $alat->peminjamanDetails()->sum('jumlah');
        $currentBorrowed = $alat->peminjamanDetails()
            ->whereHas('peminjaman', function($query) {
                $query->where('tanggal_kembali', '>', now());
            })
            ->sum('jumlah');

        $availableStock = $alat->stok - $currentBorrowed;

        return view('alats.show', compact('alat', 'recentPeminjaman', 'totalPeminjaman', 'currentBorrowed', 'availableStock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.edit', compact('alat', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori_alats,id',
            'kondisi' => 'required|in:baru,bekas',
            'status_fungsi' => 'required|in:berfungsi,tidak_berfungsi',
            'kualitas' => 'required|in:baik,buruk',
            'layak' => 'required|in:layak,tidak_layak',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $alat->update($request->all());

        return redirect()->route('alats.index')->with('success', 'Alat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();

        return redirect()->route('alats.index')->with('success', 'Alat berhasil dihapus!');
    }
}
