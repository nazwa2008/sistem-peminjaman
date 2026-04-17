@extends('layouts.app')

@section('header', 'Tambah Alat Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Alat</h3>
            
            <form action="{{ route('admin.alat.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Alat</label>
                        <input type="text" name="nama_alat" id="nama_alat" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" placeholder="Contoh: Proyektor Epson" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none appearance-none cursor-pointer" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama_kategori }} ({{ $category->kode_kategori }})</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-[10px] text-gray-400 italic font-medium">Kode barang akan dibuat otomatis berdasarkan awalan kategori ini.</p>
                        </div>
                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Unit</label>
                            <input type="number" name="jumlah" id="jumlah" min="1" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-50 flex items-center gap-3">
                    <button type="submit" class="flex-1 py-2.5 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
                        Simpan Data Alat
                    </button>
                    <a href="{{ route('admin.alat.index') }}" class="px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors text-sm border border-gray-100">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
