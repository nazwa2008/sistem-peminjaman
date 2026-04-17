@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Kategori Alat</h1>
            <p class="text-gray-500 mt-1 font-medium">Kelola grup dan prefix kode untuk manajemen alat yang lebih terstruktur.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 group">
            <i data-lucide="plus" class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform"></i>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl flex items-center shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 mr-3"></i>
        <p class="text-emerald-700 font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl flex items-center shadow-sm">
        <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 mr-3"></i>
        <p class="text-rose-700 font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Nama Kategori</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Kode Prefix</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Jumlah Alat</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-5">
                            <span class="text-sm font-bold text-gray-900">{{ $category->nama_kategori }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-black tracking-widest border border-indigo-100">
                                {{ $category->kode_kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-sm font-medium text-gray-600">{{ $category->alats_count }} unit</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="tag" class="w-8 h-8 text-gray-300"></i>
                                </div>
                                <h3 class="text-gray-900 font-bold">Belum Ada Kategori</h3>
                                <p class="text-gray-500 text-sm mt-1">Klik tombol 'Tambah Kategori' untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
