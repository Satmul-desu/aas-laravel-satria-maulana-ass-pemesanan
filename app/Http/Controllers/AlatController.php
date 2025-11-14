<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori_alats,id',
        ]);

        $alat = Alat::create($request->all());
        return response()->json($alat->load('kategori'), 201);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat): JsonResponse
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori_alats,id',
        ]);

        $alat->update($request->all());
        return response()->json($alat->load('kategori'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat): JsonResponse
    {
        $alat->delete();
        return response()->json(['message' => 'Alat deleted successfully']);
    }
}
