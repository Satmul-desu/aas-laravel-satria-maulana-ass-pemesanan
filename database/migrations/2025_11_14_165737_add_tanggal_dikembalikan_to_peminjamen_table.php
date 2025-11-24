<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->date('tanggal_dikembalikan')->nullable()->after('tanggal_kembali');
            $table->enum('status_pengembalian', ['belum_dikembalikan', 'sudah_dikembalikan', 'terlambat_dikembalikan'])->default('belum_dikembalikan')->after('tanggal_dikembalikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropColumn(['tanggal_dikembalikan', 'status_pengembalian']);
        });
    }
};
