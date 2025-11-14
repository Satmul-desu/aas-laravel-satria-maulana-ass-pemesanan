<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriAlat;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view dashboard',
            'manage users',
            'manage kategori-alats',
            'manage alats',
            'manage peminjamen',
            'view reports',
            'export data',
            'borrow alats'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $labAssistantRole = Role::create(['name' => 'lab_assistant']);
        $labAssistantRole->givePermissionTo([
            'view dashboard',
            'manage kategori-alats',
            'manage alats',
            'manage peminjamen',
            'view reports',
            'export data'
        ]);

        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo([
            'view dashboard',
            'borrow alats'
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@smulzlab.com',
            'password' => bcrypt('Admin.Mulz'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create lab assistant user
        $labAssistant = User::create([
            'name' => 'teachers',
            'email' => 'teachers@smulzlab.com',
            'password' => bcrypt('Lab.teach'),
            'email_verified_at' => now(),
        ]);
        $labAssistant->assignRole('lab_assistant');

        // Create student user
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@smulzlab.com',
            'password' => bcrypt('Lab.Stud'),
            'email_verified_at' => now(),
        ]);
        $student->assignRole('student');

        // Seed kategori alat
        $kategoriAlats = [
            ['nama_kategori' => 'Mikroskop'],
            ['nama_kategori' => 'Tabung Reaksi'],
            ['nama_kategori' => 'Pipet'],
            ['nama_kategori' => 'Timbangan'],
            ['nama_kategori' => 'Spektrometer'],
            ['nama_kategori' => 'Inkubator'],
            ['nama_kategori' => 'Centrifuge'],
            ['nama_kategori' => 'pH Meter'],
        ];

        foreach ($kategoriAlats as $kategori) {
            KategoriAlat::create($kategori);
        }

        // Seed alat
        $alats = [
            ['nama_alat' => 'Mikroskop Optik Compound', 'stok' => 5, 'kategori_id' => 1],
            ['nama_alat' => 'Mikroskop Stereo', 'stok' => 3, 'kategori_id' => 1],
            ['nama_alat' => 'Tabung Reaksi 50ml', 'stok' => 20, 'kategori_id' => 2],
            ['nama_alat' => 'Tabung Reaksi 100ml', 'stok' => 15, 'kategori_id' => 2],
            ['nama_alat' => 'Pipet Mikro 10µl', 'stok' => 10, 'kategori_id' => 3],
            ['nama_alat' => 'Pipet Mikro 100µl', 'stok' => 8, 'kategori_id' => 3],
            ['nama_alat' => 'Timbangan Analitik', 'stok' => 2, 'kategori_id' => 4],
            ['nama_alat' => 'Timbangan Digital', 'stok' => 4, 'kategori_id' => 4],
            ['nama_alat' => 'Spektrometer UV-Vis', 'stok' => 1, 'kategori_id' => 5],
            ['nama_alat' => 'Inkubator CO2', 'stok' => 2, 'kategori_id' => 6],
            ['nama_alat' => 'Centrifuge Mikro', 'stok' => 3, 'kategori_id' => 7],
            ['nama_alat' => 'pH Meter Digital', 'stok' => 5, 'kategori_id' => 8],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }

        // Seed sample peminjaman
        $peminjaman = Peminjaman::create([
            'kode_pinjam' => 'INV202411001',
            'tanggal_pinjam' => now()->subDays(5),
            'tanggal_kembali' => now()->addDays(2),
            'user_id' => $student->id,
        ]);

        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->id,
            'alat_id' => 1,
            'jumlah' => 1,
        ]);

        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->id,
            'alat_id' => 3,
            'jumlah' => 5,
        ]);
    }
}
