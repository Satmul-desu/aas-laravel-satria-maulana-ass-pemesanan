<?php

namespace App\Exports;

use App\Models\Alat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlatExport implements FromCollection, WithHeadings
{
    /**
     * Return all alat data for export.
     */
    public function collection()
    {
        return Alat::select('id', 'nama', 'kategori_alat_id', 'harga', 'created_at', 'updated_at')->get();
    }

    /**
     * Set headings for the Excel sheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Kategori Alat ID',
            'Harga',
            'Created At',
            'Updated At',
        ];
    }
}
