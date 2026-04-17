<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        // View for Admin/Petugas to handle returns
        $peminjamans = Peminjaman::with(['peminjam', 'detailPeminjaman.alat', 'pengembalian'])
                                 ->where('status', 'disetujui')
                                 ->latest()
                                 ->paginate(15);
        
        $riwayat_pengembalian = Pengembalian::with('peminjaman.peminjam')
                                            ->latest()
                                            ->paginate(15);

        return view('admin.pengembalian.index', compact('peminjamans', 'riwayat_pengembalian'));
    }

    public function prosesKembali(Request $request, $peminjaman_id)
    {
        $peminjaman = Peminjaman::with('detailPeminjaman.alat')->findOrFail($peminjaman_id);

        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Hanya peminjaman aktif (disetujui) yang bisa dikembalikan.');
        }

        DB::beginTransaction();
        try {
            $tgl_kembali_seharusnya = Carbon::parse($peminjaman->tanggal_kembali);
            $tgl_dikembalikan_aktual = Carbon::now();

            $denda = 0;
            if ($tgl_dikembalikan_aktual->greaterThan($tgl_kembali_seharusnya)) {
                $selisih_hari = $tgl_dikembalikan_aktual->diffInDays($tgl_kembali_seharusnya);
                $denda = $selisih_hari * 2000; // Rp 2000 per day as requested
            }

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_dikembalikan' => $tgl_dikembalikan_aktual->toDateString(),
                'denda' => $denda,
                'status' => 'sudah_dikembalikan'
            ]);

            // Restore Stok
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
                if ($detail->alat->stok > 0) {
                    $detail->alat->update(['status' => 'tersedia']);
                }
            }

            $peminjaman->update(['status' => 'selesai']);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Memproses pengembalian peminjaman ID: '.$peminjaman->id . ($denda > 0 ? " (Denda: Rp $denda)" : "")
            ]);

            DB::commit();
            return back()->with('success', 'Pengembalian berhasil diproses. Denda: Rp ' . number_format($denda, 0, ',', '.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses. '.$e->getMessage());
        }
    }
}
