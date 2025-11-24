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
            $table->enum('condition', ['safe', 'damaged', 'lost'])->default('safe')->after('late_fee');
            $table->decimal('damage_fee', 15, 2)->default(0)->after('condition');
            $table->decimal('lost_fee', 15, 2)->default(0)->after('damage_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropColumn(['condition', 'damage_fee', 'lost_fee']);
        });
    }
};
