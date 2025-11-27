<?php

namespace App\Exports;

use App\Models\KategoriAlat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriAlatExport implements FromCollection, WithHeadings
{
    /**
     * Return all kategori alat data for export.
     */
    public function collection()
    {
        return KategoriAlat::select('id', 'nama', 'created_at', 'updated_at')->get();
    }

    /**
     * Set headings for the Excel sheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Created At',
            'Updated At',
        ];
    }
}
