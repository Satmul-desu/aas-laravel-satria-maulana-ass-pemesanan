<?php

namespace App\Http\Controllers;

use App\Models\KategoriAlat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KategoriAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriAlats = KategoriAlat::with('alats')->get();
        return view('kategori-alats.index', compact('kategoriAlats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriAlat::create($request->all());
        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriAlat $kategoriAlat)
    {
        // Load alat relationships with peminjaman data
        $kategoriAlat->load(['alats.peminjamanDetails.peminjaman.user']);

        // Calculate statistics for this category
        $totalAlats = $kategoriAlat->alats->count();
        $totalStok = $kategoriAlat->alats->sum('stok');

        // Calculate current borrowed items
        $currentBorrowed = 0;
        foreach ($kategoriAlat->alats as $alat) {
            $currentBorrowed += $alat->peminjamanDetails()
                ->whereHas('peminjaman', function($query) {
                    $query->where('tanggal_kembali', '>', now());
                })
                ->sum('jumlah');
        }

        $availableStock = $totalStok - $currentBorrowed;

        // Get most borrowed alat in this category
        $mostBorrowedAlat = $kategoriAlat->alats()
            ->withCount(['peminjamanDetails as total_borrowed' => function($query) {
                $query->select(\DB::raw('sum(jumlah)'));
            }])
            ->orderBy('total_borrowed', 'desc')
            ->first();

        return view('kategori-alats.show', compact('kategoriAlat', 'totalAlats', 'totalStok', 'currentBorrowed', 'availableStock', 'mostBorrowedAlat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriAlat $kategoriAlat)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategoriAlat->update($request->all());
        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriAlat $kategoriAlat)
    {
        $kategoriAlat->delete();
        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil dihapus');
    }
}
