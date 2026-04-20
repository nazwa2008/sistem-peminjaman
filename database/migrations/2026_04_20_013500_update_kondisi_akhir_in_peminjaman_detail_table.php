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
            // Change enum to string to support 'Telat' and 'Rusak / Hilang'
            $table->string('kondisi_akhir')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_detail', function (Blueprint $table) {
            $table->enum('kondisi_akhir', ['Baik', 'Rusak', 'Hilang'])->nullable()->change();
        });
    }
};
