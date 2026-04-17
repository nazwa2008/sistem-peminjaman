@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')

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
        <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 mr-4">
            <i data-lucide="users" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total User</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_user'] }}</p>
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
    <h2 class="text-lg font-bold text-gray-800 mb-4">Selamat Datang di SipaApp</h2>
    <p class="text-gray-600">Anda login sebagai Administrator. Gunakan menu di sidebar untuk mengelola master data seperti user, referensi kategori, data alat, serta memantau log aktivitas sistem secara menyeluruh.</p>
</div>
@endsection
