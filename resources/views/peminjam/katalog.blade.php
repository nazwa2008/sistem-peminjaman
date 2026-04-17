@extends('layouts.dashboard')
@section('title', 'Katalog Alat')

@section('content')
<div class="mb-6 flex space-x-4">
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex-1">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Pilih Alat untuk Dipinjam</h3>
        <p class="text-gray-600 text-sm">Alat yang tampil di sini adalah alat yang memiliki stok tersedia.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($alats as $alat)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
        <div class="h-32 bg-indigo-50 flex items-center justify-center text-indigo-200">
            <i data-lucide="image" class="w-12 h-12"></i>
        </div>
        <div class="p-5">
            <span class="inline-block px-2 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full mb-2">
                {{ $alat->kategori->nama_kategori }}
            </span>
            <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $alat->nama_alat }}</h4>
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <span class="mr-3"><i data-lucide="archive" class="w-4 h-4 inline mr-1"></i> Stok: {{ $alat->stok }}</span>
                <span><i data-lucide="info" class="w-4 h-4 inline mr-1"></i> {{ $alat->kondisi }}</span>
            </div>
            
            <form action="{{ route('peminjam.store', $alat->id) }}" method="POST" class="border-t pt-4">
                @csrf
                <div class="mb-3 space-y-2">
                    <div>
                        <label class="text-xs text-gray-500">Dari Tanggal</label>
                        <input type="date" name="tanggal_pinjam" required class="w-full text-sm rounded-md border border-gray-300 py-1.5 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="text-xs text-gray-500">Sampai Tanggal</label>
                        <input type="date" name="tanggal_kembali" required class="w-full text-sm rounded-md border border-gray-300 py-1.5 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex justify-center items-center text-sm transition">
                    <i data-lucide="shopping-cart" class="w-4 h-4 mr-2"></i> Ajukan Peminjaman
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
        <i data-lucide="box" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
        <p class="text-gray-500">Belum ada alat yang tersedia saat ini.</p>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $alats->links() }}
</div>
@endsection
