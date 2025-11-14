<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'email',
        'telepon',
        'alamat',
        'tanggal_pemesanan',
        'jenis_layanan',
        'deskripsi',
        'harga',
        'status',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'date',
        'harga' => 'decimal:2',
    ];
}
