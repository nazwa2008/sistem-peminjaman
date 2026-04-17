<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            // Menambah kolom baru
            $table->string('kode_barang')->after('nama_alat')->nullable();
            $table->string('kategori')->after('kode_barang')->nullable();
            $table->integer('jumlah_total')->default(0)->after('kategori');
            $table->integer('jumlah_baik')->default(0)->after('jumlah_total');
            $table->integer('jumlah_rusak')->default(0)->after('jumlah_baik');

            // Menghapus kolom lama yang tidak diperlukan lagi
            // Catatan: Gunakan ->nullable() jika ingin migrasi berjalan di database yang sudah ada isinya
            $table->dropColumn(['kondisi', 'status']);
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn(['kode_barang', 'kategori', 'jumlah_total', 'jumlah_baik', 'jumlah_rusak']);
            $table->enum('kondisi', ['Baik', 'Rusak', 'Hilang'])->default('Baik');
            $table->enum('status', ['tersedia', 'dipinjam', 'perbaikan'])->default('tersedia');
        });
    }
};
