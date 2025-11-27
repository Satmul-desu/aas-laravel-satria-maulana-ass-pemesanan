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
use Illuminate\Support\Facades\Session;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Pemesanan::with(['pelanggan', 'alat']);

        // Apply search filters if provided
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('pelanggan', function ($q2) use ($search) {
                      $q2->where('nama', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('alat', function ($q3) use ($search) {
                      $q3->where('nama_alat', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // Add filter by status
        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $pemesanans = $query->paginate(10);
        $pemesanans->appends($request->all());

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

        // Use model to generate kode_transaksi for consistency
        if (empty($validated['kode_transaksi'])) {
            $validated['kode_transaksi'] = \App\Models\Pemesanan::generateKodeTransaksi();
        }

        // Create Pemesanan without total and harga first
        $pemesanan = new \App\Models\Pemesanan($validated);
        $pemesanan->harga = 0;
        $pemesanan->total = 0;
        $pemesanan->save();

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

                    // Update stock - reduce stok when pemesanan created (outgoing)
                    $alat->stok = max(0, $alat->stok - $jumlah);
                    $alat->save();

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

        // Update total and harga from details
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

        // Restore previous stock before update to revert stock changes of previous details
        $previousDetails = $pemesanan->alat()->get();
        foreach ($previousDetails as $detail) {
            $alat = \App\Models\Alat::find($detail->id);
            if ($alat) {
                $alat->stok += $detail->pivot->jumlah;
                $alat->save();
            }
        }

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

                    // Adjust stock correctly by calculating stock change between old and new jumlah
                    $oldJumlah = 0;
                    foreach ($previousDetails as $oldDetail) {
                        if ($oldDetail->id == $alatId) {
                            $oldJumlah = $oldDetail->pivot->jumlah;
                            break;
                        }
                    }
                    $change = $oldJumlah - $jumlah; // positive if returned, negative if more taken
                    $alat->stok = max(0, $alat->stok + $change);
                    $alat->save();

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
        // Restore stock when deleting pemesanan (incoming)
        $details = $pemesanan->alat()->get();
        foreach ($details as $detail) {
            $alat = \App\Models\Alat::find($detail->id);
            if ($alat) {
                // Add jumlah back to stock properly
                $alat->stok += $detail->pivot->jumlah;
                $alat->save();
            }
        }

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

    /**
     * Show the pesan form for a specific pemesanan.
     */
    public function pesanForm($id)
    {
        $pemesanan = Pemesanan::with('pelanggan', 'alat')->findOrFail($id);
        return view('pemesanans.pesan', compact('pemesanan'));
    }

    /**
     * Handle the pesan form submission.
     */
    public function storePesan(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required|string|max:500',
        ]);

        // For demo, just flash the pesan message linked to pemesanan ID.
        // In a real app, this could save to db or send notification.
        Session::flash('success', 'Pesan untuk pemesanan #' . $id . ' berhasil dikirim.');
        Session::flash('pesan_content', $request->input('pesan'));

        return redirect()->route('pemesanans.pesan.form', ['id' => $id]);
    }
}
