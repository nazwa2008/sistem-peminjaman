@extends('layouts.dashboard')
@section('title', 'Dashboard Peminjam')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mr-4">
            <i data-lucide="book-open" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Peminjaman Saat Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['sedang_pinjam'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 mr-4">
            <i data-lucide="history" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Riwayat Pinjaman</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['riwayat_saya'] }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Mulai Meminjam Alat</h2>
    <p class="text-gray-600 mb-6">Silakan masuk ke menu <span class="font-semibold">Katalog Alat</span> untuk melihat persediaan alat dan mengajukan peminjaman. Pastikan mematuhi aturan pengembalian agar tidak terkena denda keterlambatan.</p>
    
    <a href="{{ route('peminjam.katalog') }}" class="inline-flex flex-row items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
        Lihat Katalog
        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
    </a>
</div>
@endsection
