<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::with(['user', 'details.alat'])->paginate(10);
        $alats = \App\Models\Alat::all();
        $users = \App\Models\User::all();
        return view('pemesanans.index', compact('pemesanans', 'alats', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alats = \App\Models\Alat::all();
        $users = \App\Models\User::all();
        return view('pemesanans.create', compact('alats', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'tanggal_pesan' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // Calculate total cost
            $total = 0;
            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                $total += $alat->harga * $alatData['jumlah'];
            }

            $pesanan = Pemesanan::create([
                'tanggal_pesan' => $request->tanggal_pesan,
                'user_id' => $request->user_id,
                'total' => $total,
            ]);

            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                if ($alat->stok < $alatData['jumlah']) {
                    throw new \Exception("Stok alat {$alat->nama_alat} tidak mencukupi");
                }

                $pesanan->details()->create([
                    'pemesanan_id' => $pesanan->id,
                    'alat_id' => $alatData['id'],
                    'jumlah' => $alatData['jumlah'],
                ]);

                $alat->decrement('stok', $alatData['jumlah']);
            }
        });

        return response()->json(['message' => 'Pemesanan created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load(['user', 'details.alat']);
        $alats = \App\Models\Alat::all();
        $users = \App\Models\User::all();
        return view('pemesanans.show', compact('pemesanan', 'alats', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        $pemesanan->load(['user', 'details.alat']);
        $alats = \App\Models\Alat::all();
        $users = \App\Models\User::all();
        return view('pemesanans.edit', compact('pemesanan', 'alats', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan): JsonResponse
    {
        $request->validate([
            'tanggal_pesan' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'alats' => 'required|array',
            'alats.*.id' => 'required|exists:alats,id',
            'alats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $pemesanan) {
            // Restore stock
            foreach ($pemesanan->details as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }

            // Calculate total cost
            $total = 0;
            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                $total += $alat->harga * $alatData['jumlah'];
            }

            $pemesanan->update([
                'tanggal_pesan' => $request->tanggal_pesan,
                'user_id' => $request->user_id,
                'total' => $total,
            ]);

            $pemesanan->details()->delete();

            foreach ($request->alats as $alatData) {
                $alat = Alat::find($alatData['id']);
                if ($alat->stok < $alatData['jumlah']) {
                    throw new \Exception("Stok alat {$alat->nama_alat} tidak mencukupi");
                }

                $pemesanan->details()->create([
                    'pemesanan_id' => $pemesanan->id,
                    'alat_id' => $alatData['id'],
                    'jumlah' => $alatData['jumlah'],
                ]);

                $alat->decrement('stok', $alatData['jumlah']);
            }
        });

        return response()->json(['message' => 'Pemesanan updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan): JsonResponse
    {
        DB::transaction(function () use ($pemesanan) {
            foreach ($pemesanan->details as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }
            $pemesanan->delete();
        });

        return response()->json(['message' => 'Pemesanan deleted successfully']);
    }
}
