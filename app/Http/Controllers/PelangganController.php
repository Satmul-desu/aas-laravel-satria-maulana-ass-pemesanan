<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PelangganExport;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::paginate(10);
        return view('pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggans.show', compact('pelanggan'));
    }

    // Show Pelanggan data as PDF view (instead of download)
    public function exportPdf()
    {
        $pelanggans = Pelanggan::all();
        $pdf = Pdf::loadView('pelanggans.export_pdf', compact('pelanggans'));
        return $pdf->stream('data_pelanggan_' . date('Y-m-d') . '.pdf');
    }

    // Export Pelanggan data to Excel
    public function exportExcel()
    {
        return Excel::download(new PelangganExport, 'data_pelanggan_' . date('Y-m-d') . '.xlsx');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email,' . $id,
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }
}
