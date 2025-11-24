<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alat extends Model
{
    protected $fillable = ['nama_alat', 'stok', 'kategori_id', 'kondisi', 'status_fungsi', 'kualitas', 'layak', 'deskripsi'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriAlat::class, 'kategori_id');
    }

    public function peminjamen(): BelongsToMany
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_details', 'alat_id', 'peminjaman_id')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }

    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class, 'alat_id');
    }
}
