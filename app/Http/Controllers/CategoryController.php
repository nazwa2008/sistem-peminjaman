<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('alats')->latest()->paginate(10);
        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
            'kode_kategori' => 'nullable|string|max:5|unique:categories,kode_kategori',
        ]);

        // Jika kode_kategori kosong, ambil 3 huruf pertama nama_kategori
        $kode = $request->kode_kategori 
            ? strtoupper($request->kode_kategori) 
            : strtoupper(substr($request->nama_kategori, 0, 3));

        Category::create([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => $kode,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori "' . $request->nama_kategori . '" berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('kategori.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $category->id,
            'kode_kategori' => 'required|string|max:5|unique:categories,kode_kategori,' . $category->id,
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => strtoupper($request->kode_kategori),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Cek apakah ada alat yang menggunakan kategori ini
        if ($category->alats()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh beberapa alat.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
