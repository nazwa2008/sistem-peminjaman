<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_detail';
    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'returned_by_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'kondisi_akhir',
        'denda',
        'alasan_denda',
        'keterangan_denda',
        'status_item'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function returnHandler()
    {
        return $this->belongsTo(User::class, 'returned_by_id');
    }
}
