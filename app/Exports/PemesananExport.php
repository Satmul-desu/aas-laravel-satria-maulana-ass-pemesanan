<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PemesananExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pemesanan::all();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Nama Pemesan',
            'Email',
            'Telepon',
            'Alamat',
            'Tanggal Pemesanan',
            'Jenis Layanan',
            'Deskripsi',
            'Harga',
            'Total',
            'Status'
        ];
    }

    public function map($pemesanan): array
    {
        return [
            $pemesanan->kode_transaksi ?? 'N/A',
            $pemesanan->nama_pemesan,
            $pemesanan->email,
            $pemesanan->telepon,
            $pemesanan->alamat,
            $pemesanan->tanggal_pemesanan->format('d/m/Y'),
            $pemesanan->jenis_layanan,
            $pemesanan->deskripsi,
            $pemesanan->harga,
            $pemesanan->total,
            ucfirst($pemesanan->status)
        ];
    }
}
