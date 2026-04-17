<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        if ($user->role == 'admin' || $user->role == 'petugas') {
            // Stats for Admin & Petugas: menggunakan SUM stok agar sesuai dengan jumlah fisik alat
            $stats['total_alat'] = Alat::sum('stok_total');
            $stats['tersedia']   = Alat::sum('stok_tersedia');
            if ($user->role == 'admin') {
                $stats['rusak'] = Alat::sum('stok_rusak');
            }
            
            $stats['peminjam']   = Peminjaman::where('status', 'dipinjam')->count();
            
            if ($user->role == 'petugas') {
                $stats['pending'] = Peminjaman::where('status', 'pending')->count();
            }
        } else {
            // Stats for Peminjam (default)
            $stats['my_loans'] = Peminjaman::where('user_id', $user->id)->count();
            $stats['my_active_loans'] = Peminjaman::where('user_id', $user->id)->where('status', 'dipinjam')->count();
        }

        return view('dashboard', compact('stats'));
    }
}
