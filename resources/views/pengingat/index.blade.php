@extends('layouts.app')

@section('header', 'Pengingat Keterlambatan')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-xl font-bold text-gray-900">Daftar Terlambat</h3>
        <p class="text-sm text-gray-500 mt-1">Lacak alat yang belum dikembalikan melewati batas waktu.</p>
    </div>

    @forelse($details as $detail)
        @php
            $today = \Carbon\Carbon::now();
            $due = \Carbon\Carbon::parse($detail->tanggal_kembali);
            $daysLate = $today->diffInDays($due, false) * -1;
            $fine = $daysLate > 0 ? $daysLate * 5000 : 0;
        @endphp
        <div class="bg-white rounded-2xl border-l-4 border-l-red-500 border-y border-r border-gray-100 shadow-sm p-6 group hover:shadow-md transition-all">
            <div class="flex flex-wrap items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 transition-colors">
                        <i data-lucide="alert-triangle" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-gray-900">{{ $detail->peminjaman->nama_peminjam }}</h4>
                        <p class="text-sm text-gray-500">Meminjam: <span class="font-semibold text-gray-700">{{ $detail->alat->nama_alat }}</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tgl Kembali</p>
                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $due->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Terlambat</p>
                        <p class="text-sm font-bold text-red-600 mt-1">{{ $daysLate }} Hari</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Estimasi Denda</p>
                        <p class="text-sm font-bold text-gray-900 mt-1">Rp {{ number_format($fine, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center">
                        <a href="https://wa.me/{{ $detail->peminjaman->user->phone ?? '' }}" target="_blank" class="px-4 py-2 bg-green-50 text-green-700 text-xs font-bold rounded-lg hover:bg-green-100 transition-colors flex items-center gap-2">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                            Hubungi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <i data-lucide="smile" class="w-12 h-12 text-gray-100 mx-auto mb-4"></i>
            <p class="text-sm text-gray-500 font-medium">Luar biasa! Tidak ada alat yang terlambat dikembalikan.</p>
        </div>
    @endforelse
</div>
@endsection
