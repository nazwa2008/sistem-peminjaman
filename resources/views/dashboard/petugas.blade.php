@extends('layouts.dashboard')
@section('title', 'Dashboard Petugas')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mr-4">
            <i data-lucide="tool" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Alat</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_alat'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 mr-4">
            <i data-lucide="clock" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Peminjaman Pending</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['peminjaman_pending'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-4">
            <i data-lucide="check-circle" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['peminjaman_aktif'] }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Selamat Datang di Menu Petugas</h2>
    <p class="text-gray-600">Anda dapat memproses permohonan peminjaman di menu Peminjaman, memvalidasi pengembalian di menu Pengembalian, dan mencetak laporan transaksi.</p>
</div>
@endsection
