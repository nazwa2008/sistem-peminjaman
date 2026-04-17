<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['user_id', 'nama_peminjam', 'petugas_id', 'approver_id', 'kode_peminjaman', 'tanggal_pengajuan', 'status', 'alasan_penolakan'];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function details()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }


}
