@extends('layouts.app')

@section('header', 'Manajemen Data Alat')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Inventaris</h3>
            <p class="text-sm text-gray-500 mt-1">
                Kelola semua alat dan perangkat yang tersedia untuk dipinjam.
                @if(auth()->user()->role == 'petugas')
                    <span class="block mt-1 text-primary-600 font-bold italic">
                        <i data-lucide="info" class="w-3.5 h-3.5 inline-block mr-1"></i>
                        Hanya menampilkan alat dengan kondisi "Baik".
                    </span>
                @endif
            </p>
        </div>
        @if(auth()->user()->role == 'admin')
        <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            Tambah Alat
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="p-4 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-100 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 text-sm text-red-800 rounded-2xl bg-red-50 border border-red-100 flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Nama Alat</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Kode Barang</th>
                        @if(auth()->user()->role == 'petugas')
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center">Tersedia</th>
                        @endif
                        @if(auth()->user()->role == 'admin')
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center">Total Stok</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center">Kondisi (B | R)</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($alat as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                                        <i data-lucide="box" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $item->nama_alat }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}</p>
                                    </div>
                                </div>
                            </td>
                             <td class="px-6 py-4">
                                <span class="text-sm font-mono text-gray-500 px-2 py-1 bg-gray-50 rounded-md border border-gray-100">
                                    {{ $item->kode_barang }}
                                </span>
                            </td>
                            @if(auth()->user()->role == 'petugas')
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-sm font-black {{ $item->stok_tersedia > 0 ? 'bg-primary-50 text-primary-700' : 'bg-red-50 text-red-700' }}">
                                        {{ $item->stok_tersedia }}
                                    </div>
                                </td>
                            @endif
                            @if(auth()->user()->role == 'admin')
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-semibold text-gray-600">
                                        {{ $item->stok_total }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Kondisi Baik (Kiri) -->
                                        <div class="flex flex-col items-center min-w-[40px]">
                                            <span class="text-[9px] uppercase font-bold text-green-500 tracking-tighter">B</span>
                                            <span class="text-xs font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-lg border border-green-100">{{ $item->stok_baik }}</span>
                                        </div>
                                        <div class="h-6 w-px bg-gray-100"></div>
                                        <!-- Kondisi Rusak (Kanan) -->
                                        <div class="flex flex-col items-center min-w-[40px]">
                                            <span class="text-[9px] uppercase font-bold text-red-400 tracking-tighter">R</span>
                                            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-lg border border-red-100">{{ $item->stok_rusak }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.alat.edit', $item->id) }}" class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.alat.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus" onclick="return confirm('Hapus alat ini?')">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? 5 : 3 }}" class="px-6 py-12 text-center">
                                <i data-lucide="inbox" class="w-12 h-12 text-gray-200 mx-auto mb-4"></i>
                                <p class="text-sm text-gray-500">Belum ada data alat tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($alat->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $alat->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
