@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-8 animate-in slide-in-from-bottom-8 duration-700">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.categories.index') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all">
            <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Kategori</h1>
            <p class="text-gray-500 mt-1 font-medium">Buat klasifikasi baru untuk inventaris alat Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden transform transition-all">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-8 space-y-8 text-left">
            @csrf
            
            <div class="space-y-6">
                <!-- Nama Kategori -->
                <div class="space-y-2">
                    <label for="nama_kategori" class="text-sm font-bold text-gray-700 ml-1">Nama Kategori</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i data-lucide="tag" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="nama_kategori" id="nama_kategori" required
                            class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-gray-900 font-medium placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none"
                            placeholder="Contoh: Elektronik, Alat Tulis, Meubel">
                    </div>
                    @error('nama_kategori')
                        <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kode Kategori -->
                <div class="space-y-2">
                    <label for="kode_kategori" class="text-sm font-bold text-gray-700 ml-1">Kode Prefix (Opsional)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i data-lucide="hash" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="kode_kategori" id="kode_kategori" maxlength="5"
                            class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-gray-900 font-bold tracking-widest placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none uppercase"
                            placeholder="Contoh: ELK">
                    </div>
                    <p class="text-xs text-gray-400 font-medium ml-1">Jika kosong, sistem akan mengambil 3 huruf pertama kategori.</p>
                    @error('kode_kategori')
                        <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
