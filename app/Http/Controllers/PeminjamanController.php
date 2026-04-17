<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Mail\StrukPeminjamanMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin' || $user->role == 'petugas') {
            $peminjaman = Peminjaman::with(['user', 'details.alat'])->latest()->paginate(10);
        } else {
            $peminjaman = Peminjaman::with(['details.alat'])->where('user_id', $user->id)->latest()->paginate(10);
        }
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        // Hanya menampilkan alat yang memiliki stok baik tersedia
        $alat = Alat::where('stok_tersedia', '>', 0)->get();
        
        return view('peminjaman.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'alat_ids' => 'required|array',
            'alat_ids.*' => 'exists:alat,id',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        $kode = 'PJ-' . time();
        $user = Auth::user();
        
        $peminjaman = Peminjaman::create([
            'user_id' => $user->role == 'peminjam' ? $user->id : Auth::id(),
            'nama_peminjam' => $request->nama_peminjam,
            'petugas_id' => ($user->role == 'admin' || $user->role == 'petugas') ? $user->id : null,
            'kode_peminjaman' => $kode,
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
        ]);

        foreach ($request->alat_ids as $alat_id) {
            PeminjamanDetail::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $alat_id,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => $request->tanggal_kembali,
                'status_item' => 'dipinjam',
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Permohonan peminjaman berhasil diajukan.');
    }

    public function persetujuan()
    {
        $peminjaman = Peminjaman::with(['user', 'details.alat'])->where('status', 'pending')->latest()->get();
        return view('persetujuan.index', compact('peminjaman'));
    }

    public function approve(Request $request, Peminjaman $peminjaman)
    {
        if ($request->action == 'approve') {
            foreach ($peminjaman->details as $detail) {
                if ($detail->alat->stok_tersedia <= 0) {
                    return back()->with('error', 'Alat ' . $detail->alat->nama_alat . ' sudah habis dipinjam orang lain.');
                }
            }

            $peminjaman->update([
                'status' => 'dipinjam',
                'approver_id' => Auth::id(),
            ]);
            
            // Kurangi stok tersedia untuk setiap alat
            foreach ($peminjaman->details as $detail) {
                $detail->alat->decrement('stok_tersedia');
            }
            
            return back()->with('success', 'Peminjaman disetujui.');
        } else {
            $peminjaman->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan,
                'approver_id' => Auth::id(),
            ]);
            return back()->with('error', 'Peminjaman ditolak.');
        }
    }

    public function pengembalian()
    {
        $details = PeminjamanDetail::with(['peminjaman.user', 'alat'])
            ->where('status_item', 'dipinjam')
            ->whereHas('peminjaman', function($q) {
                $q->where('status', 'dipinjam');
            })
            ->latest()
            ->get();
            
        return view('pengembalian.index', compact('details'));
    }

    public function processReturn(Request $request, PeminjamanDetail $detail)
    {
        $request->validate([
            'kondisi_akhir' => 'required|in:Baik,Rusak,Hilang',
            'alasan_denda' => 'nullable|in:terlambat,rusak,hilang',
        ]);

        $tanggal_sekarang = Carbon::now();
        $tanggal_kembali = Carbon::parse($detail->tanggal_kembali);
        
        $denda_terlambat = 0;
        $denda_kondisi = 0;
        $hari_terlambat = 0;

        // 1. Hitung Denda Keterlambatan
        if ($tanggal_sekarang->isAfter($tanggal_kembali)) {
            // Kita gunakan diffInDays yang menghasilkan integer absolut
            $hari_terlambat = (int) $tanggal_sekarang->diffInDays($tanggal_kembali);
            $denda_terlambat = $hari_terlambat * 5000;
        }

        // 2. Hitung Denda Kondisi Alat
        if ($request->kondisi_akhir == 'Rusak') {
            $denda_kondisi = 5000;
        } elseif ($request->kondisi_akhir == 'Hilang') {
            $denda_kondisi = 50000;
        }

        $total_denda = $denda_terlambat + $denda_kondisi;

        // 3. Susun Keterangan Denda yang Transparan
        $rincian = [];
        if ($hari_terlambat > 0) {
            $rincian[] = "Keterlambatan ($hari_terlambat Hari): Rp " . number_format($denda_terlambat, 0, ',', '.');
        }
        
        if ($request->kondisi_akhir == 'Rusak') {
            $rincian[] = "Kerusakan Alat: Rp " . number_format($denda_kondisi, 0, ',', '.');
        } elseif ($request->kondisi_akhir == 'Hilang') {
            $rincian[] = "Kehilangan Alat: Rp " . number_format($denda_kondisi, 0, ',', '.');
        }

        $keterangan_denda = implode(" & ", $rincian);
        if (empty($keterangan_denda) && $total_denda > 0) {
            $keterangan_denda = "Denda Lainnya";
        }

        // Tentukan alasan_denda utama untuk statistik
        $alasan_denda = null;
        if ($hari_terlambat > 0 && $denda_kondisi > 0) {
            $alasan_denda = 'terlambat'; // atau bisa buat enum baru, tapi kita pakai yang ada
        } elseif ($hari_terlambat > 0) {
            $alasan_denda = 'terlambat';
        } elseif ($request->kondisi_akhir == 'Rusak') {
            $alasan_denda = 'rusak';
        } elseif ($request->kondisi_akhir == 'Hilang') {
            $alasan_denda = 'hilang';
        }

        $detail->update([
            'tanggal_pengembalian' => $tanggal_sekarang,
            'kondisi_akhir' => $request->kondisi_akhir,
            'denda' => $total_denda,
            'alasan_denda' => $alasan_denda,
            'keterangan_denda' => $keterangan_denda,
            'status_item' => 'dikembalikan',
            'returned_by_id' => Auth::id(),
        ]);

        // LOGIKA OTOMATIS: Update stok dan kondisi alat
        $alat = $detail->alat;
        if ($request->kondisi_akhir == 'Rusak') {
            // Jika rusak, kurangi stok Baik dan tambah stok Rusak
            // Stok tersedia tidak bertambah karena alat masuk kategori Rusak
            $alat->increment('stok_rusak');
            $alat->decrement('stok_baik');
        } elseif ($request->kondisi_akhir == 'Hilang') {
            // Jika hilang, kurangi stok Baik dan kurangi total kepemilikan
            // Stok tersedia tidak bertambah karena alat hilang
            $alat->decrement('stok_baik');
            $alat->decrement('stok_total');
        } else {
            // Jika kembali 'Baik', stok tersedia bertambah
            $alat->increment('stok_tersedia');
        }

        // Check if all items in this loan are returned
        $peminjaman = $detail->peminjaman;
        if ($peminjaman->details()->where('status_item', 'dipinjam')->count() == 0) {
            $peminjaman->update(['status' => 'selesai']);
        }

        return back()->with('success', 'Alat ' . $detail->alat->nama_alat . ' berhasil dikembalikan. Denda: Rp ' . number_format($total_denda));
    }

    public function laporan()
    {
        $details = PeminjamanDetail::with([
                'peminjaman.user', 
                'peminjaman.petugas', 
                'peminjaman.approver', 
                'alat', 
                'returnHandler'
            ])
            ->where('status_item', 'dikembalikan')
            ->latest()
            ->get();
            
        return view('laporan.index', compact('details'));
    }

    public function pengingat()
    {
        $details = PeminjamanDetail::with(['peminjaman.user', 'alat'])
            ->where('status_item', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->get();
            
        return view('pengingat.index', compact('details'));
    }

    public function kirimEmail(Request $request, PeminjamanDetail $detail)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // 1. Load data detail (eager load relationship)
            $detail->load(['peminjaman.user', 'alat']);

            // 2. Generate PDF
            $pdf = Pdf::loadView('laporan.pdf_struk', compact('detail'));
            $pdfContent = $pdf->output();

            // 3. Kirim Email
            Mail::to($request->email)->send(new StrukPeminjamanMail($detail, $pdfContent));

            return back()->with('success', 'Struk berhasil dikirim ke ' . $request->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function cetakStruk($id)
    {
        $detail = PeminjamanDetail::with([
            'peminjaman.user',
            'peminjaman.petugas',
            'peminjaman.approver',
            'alat',
            'returnHandler'
        ])->findOrFail($id);

        return view('struk.cetak', compact('detail'));
    }
}
