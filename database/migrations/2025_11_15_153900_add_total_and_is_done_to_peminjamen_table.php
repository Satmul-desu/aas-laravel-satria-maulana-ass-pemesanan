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
            $table->decimal('total', 15, 2)->default(0)->after('tanggal_dikembalikan');
            $table->dropColumn('status_pengembalian');
            $table->boolean('is_done')->default(false)->after('total');
            $table->decimal('late_fee', 15, 2)->default(0)->after('is_done');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropColumn(['total', 'is_done', 'late_fee']);
            $table->enum('status_pengembalian', ['belum_dikembalikan', 'sudah_dikembalikan', 'terlambat_dikembalikan'])->default('belum_dikembalikan')->after('tanggal_dikembalikan');
        });
    }
};
