<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Alat;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->string('kode_alat')->nullable()->after('nama_alat');
        });

        // Populate existing records with kode_alat
        $alats = Alat::all();
        foreach ($alats as $alat) {
            $nama = $alat->nama_alat;
            $words = explode(' ', $nama);
            $kode = strtoupper(substr(implode('', array_map(function($word) { return substr($word, 0, 1); }, $words)), 0, 3));
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $kode_alat = "ALT-{$kode}-{$random}";

            $alat->update(['kode_alat' => $kode_alat]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('kode_alat');
        });
    }
};
