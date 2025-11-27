<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganExport implements FromCollection, WithHeadings
{
    /**
     * Return all pelanggan data for export.
     */
    public function collection()
    {
        return Pelanggan::select('id', 'nama', 'email', 'telp', 'created_at', 'updated_at')->get();
    }

    /**
     * Set headings for the Excel sheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Telepon',
            'Created At',
            'Updated At',
        ];
    }
}
