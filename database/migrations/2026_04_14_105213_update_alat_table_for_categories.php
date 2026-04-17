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
        Schema::table('alat', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('kode_barang')->constrained('categories')->onDelete('set null');
        });

        // DATA MIGRATION: Pindahkan data kategori (string) ke kategori_id
        $kategoriLama = DB::table('alat')->distinct()->pluck('kategori')->filter();
        
        foreach ($kategoriLama as $nama) {
            $namaClean = trim($nama);
            $prefix = (strtolower($namaClean) == 'elektronik') ? 'ELK' : strtoupper(substr($namaClean, 0, 3));
            
            // Buat kategori jika belum ada
            $id = DB::table('categories')->insertGetId([
                'nama_kategori' => ucfirst($namaClean),
                'kode_kategori' => $prefix,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // Update semua alat yang memiliki kategori string ini
            DB::table('alat')->where('kategori', $nama)->update(['kategori_id' => $id]);
        }

        // Hapus kolom kategori lama
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('kategori_id');
        });

        // Kembalikan data (opsional, untuk safety)
        $alat = DB::table('alat')->get();
        foreach ($alat as $item) {
            $namaKategori = DB::table('categories')->where('id', $item->kategori_id)->value('nama_kategori');
            DB::table('alat')->where('id', $item->id)->update(['kategori' => $namaKategori]);
        }

        Schema::table('alat', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
