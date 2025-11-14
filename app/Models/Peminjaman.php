<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjaman extends Model
{
    protected $fillable = ['kode_pinjam', 'tanggal_pinjam', 'tanggal_kembali', 'user_id'];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class);
    }

    public function alats(): BelongsToMany
    {
        return $this->belongsToMany(Alat::class, 'peminjaman_details', 'peminjaman_id', 'alat_id')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peminjaman) {
            if (empty($peminjaman->kode_pinjam)) {
                $peminjaman->kode_pinjam = 'TRX' . date('Ymd') . str_pad(static::count() + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
