<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamen = Peminjaman::with(['user', 'details.alat'])->paginate(10);
        $alats = \App\Models\Alat::all();
        $users = \App\Models\User::all();
        return view('peminjamen.index', compact('peminjamen', 'alats', 'users'));
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
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $peminjaman = Peminjaman::create([
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'user_id' => $request->user_id,
            ]);

            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                if ($alat->stok < $alatData['jumlah']) {
                    throw new \Exception("Stok alat {$alat->nama_alat} tidak mencukupi");
                }

                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatData['id'],
                    'jumlah' => $alatData['jumlah'],
                ]);

                $alat->decrement('stok', $alatData['jumlah']);
            }
        });

        return response()->json(['message' => 'Peminjaman created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'details.alat']);
        return response()->json($peminjaman);
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
    public function update(Request $request, Peminjaman $peminjaman): JsonResponse
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {
            // Restore stock
            foreach ($peminjaman->details as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }

            $peminjaman->update([
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'user_id' => $request->user_id,
            ]);

            $peminjaman->details()->delete();

            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                if ($alat->stok < $alatData['jumlah']) {
                    throw new \Exception("Stok alat {$alat->nama_alat} tidak mencukupi");
                }

                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatData['id'],
                    'jumlah' => $alatData['jumlah'],
                ]);

                $alat->decrement('stok', $alatData['jumlah']);
            }
        });

        return response()->json(['message' => 'Peminjaman updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman): JsonResponse
    {
        DB::transaction(function () use ($peminjaman) {
            foreach ($peminjaman->details as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }
            $peminjaman->delete();
        });

        return response()->json(['message' => 'Peminjaman deleted successfully']);
    }
}
