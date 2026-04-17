@extends('layouts.app')

@section('header', 'Pengajuan Peminjaman')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Pilih Alat yang Ingin Dipinjam</h3>
            
            <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-8">
                @csrf
                
                 <!-- Manual Borrower Name -->
                <div class="max-w-md">
                    <label for="nama_peminjam" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Peminjam</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-gray-400 group-focus-within:text-primary-500 transition-colors"></i>
                        </div>
                        <input 
                            type="text" 
                            name="nama_peminjam" 
                            id="nama_peminjam" 
                            value="{{ auth()->user()->name }}"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none" 
                            placeholder="Contoh: Ahmad Subardjo" 
                            required
                        >
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2">Nama peminjam (default: Anda sendiri, bisa diganti).</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($alat as $item)
                        <label class="relative group cursor-pointer">
                            <input type="checkbox" name="alat_ids[]" value="{{ $item->id }}" class="peer sr-only">
                            <div class="h-full p-5 bg-gray-50 border border-gray-100 rounded-2xl transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:ring-2 peer-checked:ring-primary-500/10 group-hover:bg-gray-100/50">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-gray-400 peer-checked:text-primary-600 shadow-sm">
                                        <i data-lucide="box" class="w-5 h-5"></i>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-500 flex items-center justify-center transition-all">
                                        <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900">{{ $item->nama_alat }}</p>
                                <p class="text-xs text-gray-500 mt-1 uppercase font-bold tracking-tight">Kondisi: {{ $item->kondisi }}</p>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <i data-lucide="alert-circle" class="w-10 h-10 mx-auto mb-3 text-gray-300"></i>
                            <p class="text-sm">Maaf, tidak ada alat yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Hidden/Custom Selector Above -->

                <!-- Return Date Field (Required) -->
                <div class="max-w-xs pt-4">
                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1.5">Rencana Tanggal Pengembalian</label>
                    <input 
                        type="date" 
                        name="tanggal_kembali" 
                        id="tanggal_kembali" 
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                        required 
                        min="{{ date('Y-m-d') }}"
                    >
                    <p class="text-[10px] text-gray-400 mt-2">Pastikan memilih tanggal pengembalian yang sesuai.</p>
                </div>

                <div class="pt-8 border-t border-gray-50 flex items-center justify-between gap-4">
                    <p class="text-xs text-gray-400 italic">* Pilih satu atau lebih alat untuk diajukan.</p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('peminjaman.index') }}" class="px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors text-sm border border-gray-100">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-2.5 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-500/20 text-sm">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
