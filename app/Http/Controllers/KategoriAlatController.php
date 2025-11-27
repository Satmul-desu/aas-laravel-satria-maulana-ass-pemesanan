<?php

namespace App\Http\Controllers;

use App\Models\KategoriAlat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriAlatController extends Controller
{
    public function index()
    {
        $kategoriAlats = KategoriAlat::with('alats')->paginate(10);
        return view('kategori-alats.index', compact('kategoriAlats'));
    }

    public function create()
    {
        return view('kategori-alats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_alats,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriAlat::create($request->all());

        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kategoriAlat = KategoriAlat::with('alats')->findOrFail($id);
        return view('kategori-alats.show', compact('kategoriAlat'));
    }

    public function edit($id)
    {
        $kategoriAlat = KategoriAlat::findOrFail($id);
        return view('kategori-alats.edit', compact('kategoriAlat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_alats,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriAlat = KategoriAlat::findOrFail($id);
        $kategoriAlat->update($request->all());

        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategoriAlat = KategoriAlat::findOrFail($id);
        $kategoriAlat->delete();

        return redirect()->route('kategori-alats.index')->with('success', 'Kategori alat berhasil dihapus!');
    }

    // Show Kategori Alat data as PDF view (instead of download)
    public function exportPdf()
    {
        $kategoriAlats = KategoriAlat::with('alats')->get();
        $pdf = Pdf::loadView('kategori-alats.export_pdf', compact('kategoriAlats'));
        return $pdf->stream('data_kategori_alat_' . date('Y-m-d') . '.pdf');
    }
    
    // TODO: add exportExcel method if needed

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\KategoriAlatExport, 'kategori_alat.xlsx');
    }
}
