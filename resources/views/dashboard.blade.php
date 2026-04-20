@extends('layouts.app')

@section('header', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards -->
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
            <!-- Admin & Petugas Dashboard: Inventory & Borrowers -->
            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Total Alat</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_alat'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Tersedia</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['tersedia'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-green-50 group-hover:text-green-600 transition-colors">
                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                </div>
            </div>

            @if(auth()->user()->role == 'admin')
            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest text-red-500">Rusak</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['rusak'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-500 transition-colors">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
            </div>
            @endif

            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Dipinjam</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['peminjam'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>

            @if(auth()->user()->role == 'petugas')
                <!-- Petugas Specific: Approval Queue -->
                <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors col-span-1 md:col-span-2 lg:col-span-1">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Pending (Permohonan)</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pending'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                </div>
            @endif
        @else
            <!-- Peminjam Dashboard: Personal History -->
            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Riwayat Saya</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['my_loans'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                    <i data-lucide="history" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between group hover:border-primary-100 transition-colors">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Dipinjam</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['my_active_loans'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                    <i data-lucide="play-circle" class="w-6 h-6"></i>
                </div>
            </div>
        @endif
    </div>

    <!-- Welcome Card -->
    <div class="relative overflow-hidden bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold text-gray-900">Halo, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-gray-500 mt-2 max-w-xl">
                Anda masuk sebagai <span class="px-2 py-0.5 bg-primary-50 text-primary-600 font-semibold rounded-md text-sm capitalize">{{ auth()->user()->role }}</span>. 
                Sistem Peminjaman Alat (SIPA) membantu Anda mengelola inventaris dan transaksi alat dengan lebih mudah dan transparan.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                @if(auth()->user()->role == 'peminjam')
                    <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors text-sm">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        Pinjam Alat Sekarang
                    </a>
                @endif
                <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-50 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-sm border border-gray-100">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    Lihat Peminjaman
                </a>
            </div>
        </div>
        
        <!-- Abstract Background Shape -->
        <div class="absolute -right-12 -top-12 w-64 h-64 bg-primary-50 rounded-full opacity-50 blur-3xl"></div>
    </div>
</div>
@endsection
