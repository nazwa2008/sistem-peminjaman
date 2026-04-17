<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            if (Schema::hasColumn('alat', 'jumlah_total')) {
                $table->renameColumn('jumlah_total', 'stok_total');
            }
            if (Schema::hasColumn('alat', 'jumlah_baik')) {
                $table->renameColumn('jumlah_baik', 'stok_baik');
            }
            if (Schema::hasColumn('alat', 'jumlah_rusak')) {
                $table->renameColumn('jumlah_rusak', 'stok_rusak');
            }
            
            if (!Schema::hasColumn('alat', 'stok_tersedia')) {
                // Determine which column to use for after()
                $afterCol = Schema::hasColumn('alat', 'stok_rusak') ? 'stok_rusak' : 'jumlah_rusak';
                $table->integer('stok_tersedia')->after($afterCol)->default(0);
            }
        });

        // Populate stok_tersedia for existing records
        $alats = DB::table('alat')->get();
        foreach ($alats as $alat) {
            $dipinjam = DB::table('peminjaman_detail')
                ->where('alat_id', $alat->id)
                ->where('status_item', 'dipinjam')
                ->count();
            
            // Use the correct column name for stok_baik/jumlah_baik
            $baikField = property_exists($alat, 'stok_baik') ? 'stok_baik' : 'jumlah_baik';
            
            DB::table('alat')
                ->where('id', $alat->id)
                ->update(['stok_tersedia' => $alat->$baikField - $dipinjam]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->renameColumn('stok_total', 'jumlah_total');
            $table->renameColumn('stok_baik', 'jumlah_baik');
            $table->renameColumn('stok_rusak', 'jumlah_rusak');
            $table->dropColumn('stok_tersedia');
        });
    }
};
