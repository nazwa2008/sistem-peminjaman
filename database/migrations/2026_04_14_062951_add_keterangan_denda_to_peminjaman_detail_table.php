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
        Schema::table('peminjaman_detail', function (Blueprint $table) {
            $table->string('keterangan_denda')->nullable()->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_detail', function (Blueprint $table) {
            $table->dropColumn('keterangan_denda');
        });
    }
};
