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
        $pemesanans = Pemesanan::with(['pelanggan', 'alat'])->paginate(10);
        return view('pemesanans.index', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pelanggans = \App\Models\Pelanggan::all();
        return view('pemesanans.create', compact('pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemesananRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Create Pemesanan without total and harga first
        $pemesanan = new \App\Models\Pemesanan($validated);
        $pemesanan->harga = 0;
        $pemesanan->total = 0;
        $pemesanan->save();

        // Assume alat_id and jumlah arrays are sent from request
        $alatIds = $request->input('alat_id', []);
        $jumlahs = $request->input('jumlah', []);

        $totalHarga = 0;
        $syncData = [];

        foreach ($alatIds as $index => $alatId) {
            $jumlah = isset($jumlahs[$index]) ? intval($jumlahs[$index]) : 0;
            if ($jumlah > 0) {
                $alat = \App\Models\Alat::find($alatId);
                if ($alat) {
                    $hargaSatuan = $alat->harga;
                    $subtotal = $jumlah * $hargaSatuan;
                    $totalHarga += $subtotal;

                    $syncData[$alatId] = [
                        'jumlah' => $jumlah,
                        'harga_satuan' => $hargaSatuan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Save details
        $pemesanan->alat()->sync($syncData);

        // Update total and harga
        $pemesanan->harga = $totalHarga;
        $pemesanan->total = $totalHarga;
        $pemesanan->save();

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan): View
    {
        $pemesanan->load('alat');
        return view('pemesanans.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan): View
    {
        $pelanggans = \App\Models\Pelanggan::all();
        $pemesanan->load('alat');
        return view('pemesanans.edit', compact('pemesanan', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemesananRequest $request, Pemesanan $pemesanan): RedirectResponse
    {
        $validated = $request->validated();

        $pemesanan->update($validated);

        $alatIds = $request->input('alat_id', []);
        $jumlahs = $request->input('jumlah', []);

        $totalHarga = 0;
        $syncData = [];

        foreach ($alatIds as $index => $alatId) {
            $jumlah = isset($jumlahs[$index]) ? intval($jumlahs[$index]) : 0;
            if ($jumlah > 0) {
                $alat = \App\Models\Alat::find($alatId);
                if ($alat) {
                    $hargaSatuan = $alat->harga;
                    $subtotal = $jumlah * $hargaSatuan;
                    $totalHarga += $subtotal;

                    $syncData[$alatId] = [
                        'jumlah' => $jumlah,
                        'harga_satuan' => $hargaSatuan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        $pemesanan->alat()->sync($syncData);

        $pemesanan->harga = $totalHarga;
        $pemesanan->total = $totalHarga;
        $pemesanan->save();

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
