<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemesananExport;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pemesanans = Pemesanan::paginate(10);
        return view('pemesanans.index', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pemesanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemesananRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Pemesanan::create($validated);

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan): View
    {
        return view('pemesanans.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan): View
    {
        return view('pemesanans.edit', compact('pemesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemesananRequest $request, Pemesanan $pemesanan): RedirectResponse
    {
        $validated = $request->validated();
        $pemesanan->update($validated);

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan): RedirectResponse
    {
        $pemesanan->delete();

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dihapus!');
    }

    public function exportPdf()
    {
        $pemesanans = Pemesanan::all();

        $pdf = Pdf::loadView('pemesanans.export_pdf', compact('pemesanans'));
        return $pdf->download('data_pemesanan_' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PemesananExport, 'data_pemesanan_' . date('Y-m-d') . '.xlsx');
    }
}
