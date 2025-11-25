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
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->foreignId('pelanggan_id')->nullable()->after('id')->constrained('pelanggans')->onDelete('set null');
            $table->dropColumn(['nama_pemesan', 'email', 'telepon']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->string('nama_pemesan')->after('id');
            $table->string('email')->after('nama_pemesan');
            $table->string('telepon')->after('email');
            $table->dropForeign(['pelanggan_id']);
            $table->dropColumn('pelanggan_id');
        });
    }
};
