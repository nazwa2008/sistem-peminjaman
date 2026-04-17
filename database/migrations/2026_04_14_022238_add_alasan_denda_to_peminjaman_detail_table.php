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
            $table->enum('alasan_denda', ['terlambat', 'rusak', 'hilang'])->nullable()->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_detail', function (Blueprint $table) {
            $table->dropColumn('alasan_denda');
        });
    }
};
