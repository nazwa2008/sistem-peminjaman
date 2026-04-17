<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'detailPeminjaman.alat', 'pengembalian'])
                    ->whereIn('status', ['disetujui', 'selesai', 'ditolak']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->orderBy('tanggal_pinjam', 'desc')->get();

        if ($request->has('print')) {
            return view('admin.laporan.print', compact('peminjamans'));
        }

        return view('admin.laporan.index', compact('peminjamans'));
    }
}
