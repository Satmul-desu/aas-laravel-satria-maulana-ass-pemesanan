<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemesananExport implements FromCollection, WithHeadings
{
    /**
     * Return all pemesanan data for export.
     */
    public function collection()
    {
        // Select fields to export, customize as needed
        return Pemesanan::select('kode_transaksi', 'tanggal_pemesanan', 'pelanggan_id', 'total')->get();
    }

    /**
     * Set headings for the Excel sheet.
     */
    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal Pemesanan',
            'Pelanggan ID',
            'Total',
        ];
    }
}
