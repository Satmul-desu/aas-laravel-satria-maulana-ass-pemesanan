<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriAlat;

class KategoriAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Mikroskop'],
            ['nama_kategori' => 'Tabung Reaksi'],
            ['nama_kategori' => 'Pipet'],
            ['nama_kategori' => 'Timbangan'],
            ['nama_kategori' => 'Inkubator'],
            ['nama_kategori' => 'Sentrifugasi'],
            ['nama_kategori' => 'Spektrofotometer'],
            ['nama_kategori' => 'pH Meter'],
            ['nama_kategori' => 'Oven'],
            ['nama_kategori' => 'Freezer'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriAlat::create($kategori);
        }
    }
}
