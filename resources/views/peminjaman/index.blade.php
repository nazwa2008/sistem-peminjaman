@extends('layouts.app')

@section('header', 'Riwayat Peminjaman')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Data Transaksi</h3>
            <p class="text-sm text-gray-500 mt-1">Lacak semua status peminjaman alat di sini.</p>
        </div>
        @if(auth()->user()->role == 'peminjam')
            <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Pinjam Alat
            </a>
        @endif
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Kode & Peminjam</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Alat</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($peminjaman as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $item->kode_peminjaman }}</p>
                                    <p class="text-sm font-bold text-gray-900 mt-0.5">{{ $item->nama_peminjam }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    @foreach($item->details->take(3) as $detail)
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 border-2 border-white flex items-center justify-center text-gray-500 text-[10px] font-bold" title="{{ $detail->alat->nama_alat }}">
                                            <i data-lucide="box" class="w-3 h-3"></i>
                                        </div>
                                    @endforeach
                                    @if($item->details->count() > 3)
                                        <div class="w-8 h-8 rounded-lg bg-primary-50 border-2 border-white flex items-center justify-center text-primary-600 text-[10px] font-bold">
                                            +{{ $item->details->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-tight">
                                    {{ $item->details->count() }} ALAT DIPINJAM
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-700',
                                        'disetujui' => 'bg-blue-50 text-blue-700',
                                        'ditolak' => 'bg-red-50 text-red-700',
                                        'dipinjam' => 'bg-indigo-50 text-indigo-700',
                                        'selesai' => 'bg-green-50 text-green-700',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex flex-col items-end gap-2">
                                    @foreach($item->details as $detail)
                                        <a href="{{ route('struk.cetak', $detail->id) }}" target="_blank" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-primary-700 text-[10px] font-black uppercase rounded-lg hover:bg-primary-50 transition-all border border-primary-100 shadow-sm whitespace-nowrap"
                                           title="Cetak Struk {{ $detail->alat->nama_alat }}">
                                            <i data-lucide="printer" class="w-3 h-3"></i>
                                            {{ $detail->alat->nama_alat }}
                                        </a>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                                <i data-lucide="inbox" class="w-12 h-12 text-gray-200 mx-auto mb-4"></i>
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($peminjaman->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $peminjaman->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
