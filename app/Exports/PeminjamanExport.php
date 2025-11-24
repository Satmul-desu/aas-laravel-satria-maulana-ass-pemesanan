<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with(['user', 'details.alat'])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Pinjam',
            'User',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Alat Dipinjam',
            'Jumlah Alat',
            'Total',
            'Late Fee',
            'Status'
        ];
    }

    public function map($peminjaman): array
    {
        $alatNames = $peminjaman->details->map(function ($detail) {
            return $detail->alat->nama_alat;
        })->implode(', ');

        $jumlahAlat = $peminjaman->details->sum('jumlah');

        $status = '';
        if ($peminjaman->tanggal_kembali < now()) {
            $status = 'Terlambat';
        } elseif ($peminjaman->tanggal_pinjam <= now() && $peminjaman->tanggal_kembali >= now()) {
            $status = 'Sedang Dipinjam';
        } else {
            $status = 'Selesai';
        }

        return [
            $peminjaman->kode_pinjam,
            $peminjaman->user->name,
            $peminjaman->tanggal_pinjam->format('d/m/Y'),
            $peminjaman->tanggal_kembali->format('d/m/Y'),
            $alatNames,
            $jumlahAlat,
            $peminjaman->total,
            $peminjaman->late_fee ?? 0,
            $status
        ];
    }
}
