<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alat;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alats = [
            ['nama_alat' => 'Mikroskop Optik', 'stok' => 5, 'kategori_id' => 1],
            ['nama_alat' => 'Mikroskop Elektron', 'stok' => 2, 'kategori_id' => 1],
            ['nama_alat' => 'Tabung Reaksi 10ml', 'stok' => 50, 'kategori_id' => 2],
            ['nama_alat' => 'Tabung Reaksi 50ml', 'stok' => 30, 'kategori_id' => 2],
            ['nama_alat' => 'Pipet Mikro 10µl', 'stok' => 20, 'kategori_id' => 3],
            ['nama_alat' => 'Pipet Mikro 100µl', 'stok' => 15, 'kategori_id' => 3],
            ['nama_alat' => 'Timbangan Analitik', 'stok' => 3, 'kategori_id' => 4],
            ['nama_alat' => 'Timbangan Digital', 'stok' => 8, 'kategori_id' => 4],
            ['nama_alat' => 'Inkubator CO2', 'stok' => 2, 'kategori_id' => 5],
            ['nama_alat' => 'Inkubator Standar', 'stok' => 4, 'kategori_id' => 5],
            ['nama_alat' => 'Sentrifugasi Mikro', 'stok' => 6, 'kategori_id' => 6],
            ['nama_alat' => 'Sentrifugasi High Speed', 'stok' => 2, 'kategori_id' => 6],
            ['nama_alat' => 'Spektrofotometer UV-Vis', 'stok' => 3, 'kategori_id' => 7],
            ['nama_alat' => 'pH Meter Digital', 'stok' => 10, 'kategori_id' => 8],
            ['nama_alat' => 'Oven Vakum', 'stok' => 2, 'kategori_id' => 9],
            ['nama_alat' => 'Freezer -80°C', 'stok' => 1, 'kategori_id' => 10],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}
