<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Alat;
use App\Models\PeminjamanDetail;
use Illuminate\Support\Facades\DB;

echo "--- MEMULAI PEMBERSIHAN DATA ALAT ---\n";

DB::transaction(function() {
    // 1. Ambil semua data alat
    $alats = Alat::all();
    
    // Kelompokkan berdasarkan nama (case-insensitive)
    $groups = $alats->groupBy(function($item) {
        return strtolower(trim($item->nama_alat));
    });

    foreach ($groups as $name => $items) {
        $main = $items->first();
        $others = $items->slice(1);

        if ($others->count() > 0) {
            echo "Menggabungkan " . $others->count() . " duplikat untuk: $name\n";
            
            foreach ($others as $other) {
                // Update referensi di peminjaman_detail
                PeminjamanDetail::where('alat_id', $other->id)->update(['alat_id' => $main->id]);
                
                // Tambahkan stok ke data utama
                $main->jumlah_total += $other->jumlah_total;
                $main->jumlah_baik += $other->jumlah_baik;
                $main->jumlah_rusak += $other->jumlah_rusak;
                
                // Hapus data duplikat
                $other->delete();
            }
            $main->save();
        }
    }

    echo "Pembaruan kode barang... \n";
    
    // 2. Re-generate semua kode barang agar seragam
    // Kita reset semua kode dulu agar tidak bentrok saat proses penomoran
    Alat::query()->update(['kode_barang' => null]);
    
    $allAlat = Alat::all();
    $prefixCounters = [];

    foreach ($allAlat as $alat) {
        $kategori = trim($alat->kategori ?: 'Lainnya');
        $prefix = (strtolower($kategori) == 'elektronik') ? 'ELK' : strtoupper(substr($kategori, 0, 3));
        
        if (!isset($prefixCounters[$prefix])) {
            $prefixCounters[$prefix] = 1;
        }

        $kodeBaru = $prefix . '-' . str_pad($prefixCounters[$prefix], 3, '0', STR_PAD_LEFT);
        $alat->kode_barang = $kodeBaru;
        $alat->kategori = $kategori; // Pastikan kategori juga rapi
        $alat->save();
        
        $prefixCounters[$prefix]++;
        echo "Updating: " . $alat->nama_alat . " -> " . $kodeBaru . "\n";
    }
});

echo "--- PEMBERSIHAN SELESAI ---\n";
