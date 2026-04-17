@extends('layouts.app')

@section('header', 'Edit Unit Alat')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between gap-4 py-2">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-blue-50 rounded-2xl">
                <i data-lucide="edit-3" class="w-6 h-6 text-blue-600"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Perbarui Informasi Alat</h3>
                <p class="text-sm text-gray-500 mt-0.5">Ubah detail teknis, kondisi, atau status alat pada sistem.</p>
            </div>
        </div>
        <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <!-- Nama Alat -->
                <div class="md:col-span-2 space-y-2">
                    <label for="nama_alat" class="text-sm font-bold text-gray-700 ml-1">Nama Alat</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="package" class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" 
                            name="nama_alat" 
                            id="nama_alat" 
                            value="{{ old('nama_alat', $alat->nama_alat) }}"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none" 
                            placeholder="Contoh: Proyektor Epson EB-X05" 
                            required>
                    </div>
                </div>

                <!-- Kode Barang -->
                <div class="space-y-2 text-left">
                    <label for="kode_barang" class="text-sm font-bold text-gray-700 ml-1">Kode Barang</label>
                    <div class="relative group text-left">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="tag" class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" 
                            name="kode_barang" 
                            id="kode_barang" 
                            value="{{ old('kode_barang', $alat->kode_barang) }}"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-100 border border-gray-200 text-gray-500 text-sm rounded-2xl cursor-not-allowed outline-none font-mono" 
                            readonly>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="space-y-2 text-left">
                    <label for="kategori_id" class="text-sm font-bold text-gray-700 ml-1">Kategori</label>
                    <div class="relative group text-left">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="layers" class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <select name="kategori_id" id="kategori_id" 
                            class="block w-full pl-11 pr-10 py-3 bg-gray-50/50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none appearance-none cursor-pointer" 
                            required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $alat->kategori_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }} ({{ $category->kode_kategori }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Total -->
                <div class="space-y-2 text-left md:col-span-2">
                    <label for="jumlah" class="text-sm font-bold text-gray-700 ml-1">Jumlah Unit Keseluruhan</label>
                    <div class="relative group text-left">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="hash" class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="number" 
                            name="jumlah" 
                            id="jumlah" 
                            value="{{ old('jumlah', $alat->stok_total) }}"
                            min="1"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none" 
                            required>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1 italic ml-1">Meningkatkan jumlah total akan menambah unit tersedia (kondisi 'Baik').</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                <a href="{{ route('admin.alat.index') }}" 
                    class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                    Batalkan
                </a>
                <button type="submit" 
                    class="inline-flex items-center gap-2 px-8 py-2.5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-500/30 transition-all shadow-md shadow-blue-500/20 active:scale-95">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
