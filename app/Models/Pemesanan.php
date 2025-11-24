<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'nama_pemesan',
        'email',
        'telepon',
        'alamat',
        'tanggal_pemesanan',
        'jenis_layanan',
        'deskripsi',
        'harga',
        'total',
        'status',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'date',
        'harga' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pemesanan) {
            // Generate kode transaksi otomatis
            if (empty($pemesanan->kode_transaksi)) {
                $pemesanan->kode_transaksi = self::generateKodeTransaksi();
            }
        });

        static::saving(function ($pemesanan) {
            // Hitung total otomatis dari harga (untuk sekarang, karena belum ada detail transaksi)
            $pemesanan->total = $pemesanan->harga;
        });
    }

    public static function generateKodeTransaksi()
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');

        // Cari nomor urut terakhir untuk hari ini
        $lastOrder = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastOrder ? intval(substr($lastOrder->kode_transaksi, -4)) + 1 : 1;
        $sequence = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return "PSN-{$year}{$month}{$day}-{$sequence}";
    }

    public function getTotalAttribute($value)
    {
        // Jika ada detail transaksi di masa depan, hitung dari detail
        // Untuk sekarang, return harga sebagai total
        return $this->harga;
    }
}
