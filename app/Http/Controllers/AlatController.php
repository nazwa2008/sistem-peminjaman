<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        // Menampilkan semua alat dengan paginasi dan eager loading kategori
        $alat = Alat::with('kategori')->paginate(10);
        return view('alat.index', compact('alat'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('alat.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'jumlah'      => 'required|integer|min:1',
        ]);

        // Ambil data kategori
        $category = \App\Models\Category::findOrFail($request->kategori_id);
        $prefix = $category->kode_kategori;
        
        // Cari kode barang terakhir dengan prefix yang sama
        $terakhir = Alat::where('kode_barang', 'like', "$prefix-%")
            ->orderBy('kode_barang', 'desc')
            ->first();

        if ($terakhir) {
            // Ambil angka dari kode terakhir
            $nomorTerakhir = (int) substr($terakhir->kode_barang, strlen($prefix) + 1);
            $nomorBaru = $nomorTerakhir + 1;
        } else {
            $nomorBaru = 1;
        }

        // Susun kode baru dengan format PREFIX-000
        $kodeBaru = $prefix . '-' . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);

        // Simpan data alat baru
        Alat::create([
            'nama_alat'     => $request->nama_alat,
            'kode_barang'   => $kodeBaru,
            'kategori_id'   => $request->kategori_id,
            'stok_total'    => $request->jumlah,
            'stok_baik'     => $request->jumlah,
            'stok_rusak'    => 0,
            'stok_tersedia' => $request->jumlah,
        ]);

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil ditambahkan dengan Kode: ' . $kodeBaru);
        }

    public function edit(Alat $alat)
    {
        $categories = \App\Models\Category::all();
        return view('alat.edit', compact('alat', 'categories'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'jumlah'      => 'required|integer|min:1',
        ]);

        // Jika jumlah total berubah, sesuaikan stok_baik dan stok_tersedia
        $selisih = $request->jumlah - $alat->stok_total;
        
        $alat->update([
            'nama_alat'     => $request->nama_alat,
            'kategori_id'   => $request->kategori_id,
            'stok_total'    => $request->jumlah,
            'stok_baik'     => $alat->stok_baik + $selisih,
            'stok_tersedia' => $alat->stok_tersedia + $selisih,
        ]);

        return redirect()->route('admin.alat.index')->with('success', 'Informasi alat berhasil diperbarui.');
        }

    public function destroy(Alat $alat)
    {
        // Cek jika sedang ada yang meminjam alat ini
        if ($alat->jumlah_dipinjam > 0) {
            return redirect()->route('admin.alat.index')->with('error', 'Alat tidak bisa dihapus karena sedang dipinjam.');
        }

        $alat->delete();
        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil dihapus.');
    }
}
