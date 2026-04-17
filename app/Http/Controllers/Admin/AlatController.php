<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Category;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        // Eager load category to prevent N+1
        $alats = Alat::with('kategori')->latest()->paginate(10);
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.alat.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|string',
        ]);

        Alat::create($request->all());
        return redirect()->route('admin.alat.index')->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function edit(Alat $alat)
    {
        $categories = Category::all();
        return view('admin.alat.edit', compact('alat', 'categories'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|string',
        ]);

        $alat->update($request->all());
        return redirect()->route('admin.alat.index')->with('success', 'Data alat berhasil diupdate.');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('admin.alat.index')->with('success', 'Data alat berhasil dihapus.');
    }

    // For Peminjam
    public function katalog()
    {
        $alats = Alat::with('kategori')->where('stok', '>', 0)->paginate(12);
        return view('peminjam.katalog', compact('alats'));
    }
}
