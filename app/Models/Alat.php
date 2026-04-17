<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $fillable = [
        'nama_alat', 
        'kode_barang', 
        'kategori_id', 
        'kondisi',
        'stok_total', 
        'stok_baik', 
        'stok_rusak',
        'stok_tersedia'
    ];

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    /**
     * Relasi ke detail peminjaman.
     */
    public function peminjamanDetail()
    {
        return $this->hasMany(PeminjamanDetail::class, 'alat_id');
    }

    /**
     * Menghitung jumlah alat yang sedang dipinjam (Dinamis untuk pengecekan).
     */
    public function getStokDipinjamAttribute()
    {
        return $this->peminjamanDetail()
            ->where('status_item', 'dipinjam')
            ->count();
    }
}
