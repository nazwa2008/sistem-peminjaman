<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Alat;

// Test generation logic
$kategori = "Elektronik";
$prefix = strtoupper(substr($kategori, 0, 3));
$terakhir = Alat::where('kode_barang', 'like', "$prefix-%")
    ->orderBy('kode_barang', 'desc')
    ->first();

if ($terakhir) {
    $nomorTerakhir = (int) substr($terakhir->kode_barang, 4);
    $nomorBaru = $nomorTerakhir + 1;
} else {
    $nomorBaru = 1;
}

$kodeBaru = $prefix . '-' . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);

echo "Prefix: $prefix\n";
echo "Terakhir: " . ($terakhir ? $terakhir->kode_barang : 'None') . "\n";
echo "Generated: $kodeBaru\n";
