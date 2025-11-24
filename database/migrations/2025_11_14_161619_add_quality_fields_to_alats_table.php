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
        Schema::table('alats', function (Blueprint $table) {
            $table->enum('kondisi', ['baru', 'bekas'])->default('baru')->after('stok');
            $table->enum('status_fungsi', ['berfungsi', 'tidak_berfungsi'])->default('berfungsi')->after('kondisi');
            $table->enum('kualitas', ['baik', 'buruk'])->default('baik')->after('status_fungsi');
            $table->enum('layak', ['layak', 'tidak_layak'])->default('layak')->after('kualitas');
            $table->text('deskripsi')->nullable()->after('layak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn(['kondisi', 'status_fungsi', 'kualitas', 'layak', 'deskripsi']);
        });
    }
};
