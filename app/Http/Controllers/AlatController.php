<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlatExport;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::paginate(10);
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.index', compact('alats', 'kategoris'));
    }

    public function create()
    {
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_alats,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:baru,bekas',
            'status_fungsi' => 'required|in:berfungsi,tidak_berfungsi',
            'kualitas' => 'required|in:baik,buruk',
            'layak' => 'required|in:layak,tidak_layak',
        ]);

        Alat::create($request->all());

        return redirect()->route('alats.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show($id)
    {
        $alat = Alat::with('kategoriAlat')->findOrFail($id);
        return view('alats.show', compact('alat'));
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alats.index')->with('success', 'Alat berhasil dihapus!');
    }

    // Show Alat data as PDF view (instead of download)
    public function exportPdf()
    {
        $alats = Alat::all();
        $pdf = Pdf::loadView('alats.export_pdf', compact('alats'));
        return $pdf->stream('data_alat_' . date('Y-m-d') . '.pdf');
    }

    // Export Alat data to Excel
    public function exportExcel()
    {
        return Excel::download(new AlatExport, 'data_alat_' . date('Y-m-d') . '.xlsx');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = \App\Models\KategoriAlat::all();
        return view('alats.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_alats,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:baru,bekas',
            'status_fungsi' => 'required|in:berfungsi,tidak_berfungsi',
            'kualitas' => 'required|in:baik,buruk',
            'layak' => 'required|in:layak,tidak_layak',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()->route('alats.index')->with('success', 'Alat berhasil diperbarui!');
    }
}
