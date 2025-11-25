<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pemesanan extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'alamat',
        'jenis_layanan',
        'deskripsi',
        'harga',
        'total',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    
    public function pemesananDetails(): HasMany
    {
        return $this->hasMany(PemesananDetail::class);
    }

    public function alat(): BelongsToMany
    {
        return $this->belongsToMany(Alat::class, 'pemesanan_details', 'pemesanan_id', 'alat_id')
                    ->withPivot('jumlah', 'harga_satuan')
                    ->withTimestamps();
    }

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

    public function getNamaPemesanAttribute()
    {
        return $this->pelanggan ? $this->pelanggan->nama : '';
    }

    public function getEmailAttribute()
    {
        return $this->pelanggan ? $this->pelanggan->email : '';
    }

    public function getTeleponAttribute()
    {
        return $this->pelanggan ? $this->pelanggan->telepon : '';
    }
    
    public function user()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
