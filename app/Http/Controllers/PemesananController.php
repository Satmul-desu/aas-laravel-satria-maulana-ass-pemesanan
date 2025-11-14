<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pemesanans = Pemesanan::all();
        return response()->json($pemesanans);
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
    public function store(StorePemesananRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $pemesanan = Pemesanan::create($validated);
        return response()->json($pemesanan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
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
    public function update(UpdatePemesananRequest $request, string $id): JsonResponse
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $validated = $request->validated();
        $pemesanan->update($validated);
        return response()->json($pemesanan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return response()->json(['message' => 'Pemesanan deleted successfully']);
    }
}
