<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alat extends Model
{
    protected $table = 'alats';

    protected $fillable = [
        'nama_alat',
        'stok',
        'kategori_id',
        'kondisi',
        'status_fungsi',
        'kualitas',
        'layak',
        'deskripsi',
        'harga',
        'kode_alat',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriAlat::class, 'kategori_id');
    }

    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class, 'alat_id');
    }

    public function pemesanan(): BelongsToMany
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_details', 'alat_id', 'pemesanan_id')
                    ->withPivot('jumlah', 'harga_satuan')
                    ->withTimestamps();
    }
}
