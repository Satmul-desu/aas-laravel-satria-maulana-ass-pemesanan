<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
     * Return all peminjaman data for export.
     */
    public function collection()
    {
        // Select fields to export, customize as needed
        return Peminjaman::select('kode_pinjam', 'tanggal_pinjam', 'tanggal_kembali', 'user_id', 'total')->get();
    }

    /**
     * Set headings for the Excel sheet.
     */
    public function headings(): array
    {
        return [
            'Kode Pinjam',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'User ID',
            'Total',
        ];
    }
}
