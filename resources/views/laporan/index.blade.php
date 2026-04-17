@extends('layouts.app')

@section('header', 'Laporan Peminjaman')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Rekapitulasi Transaksi</h3>
            <p class="text-sm text-gray-500 mt-1">Daftar semua penyerahan dan pengembalian alat yang sudah selesai.</p>
        </div>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm no-print">
            <i data-lucide="printer" class="w-4 h-4"></i>
            Cetak Laporan
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-100 no-print flex items-center gap-3">
            <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-2xl bg-red-50 border border-red-100 no-print flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden print:shadow-none print:border-none">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Peminjam</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Alat</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Petugas</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Denda</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($details as $detail)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] leading-none mb-1">{{ $detail->peminjaman->kode_peminjaman }}</p>
                                <p class="text-sm font-bold text-gray-800">{{ $detail->peminjaman->nama_peminjam }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</p>
                                <p class="text-[9px] text-gray-400 uppercase font-black tracking-widest mt-0.5">ID: #{{ $detail->alat->id }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-0.5">
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-tight flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> In: {{ $detail->peminjaman->petugas->name ?? 'System' }}
                                    </p>
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-tight flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Out: {{ $detail->returnHandler->name ?? '-' }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="block text-sm font-black {{ $detail->denda > 0 ? 'text-red-600' : 'text-gray-900' }}">
                                    Rp {{ number_format($detail->denda, 0, ',', '.') }}
                                </span>
                                @if($detail->keterangan_denda && $detail->denda > 0)
                                    @php
                                        $raw = $detail->keterangan_denda;
                                        $lbls = [];
                                        if (str_contains($raw, 'Keterlambatan')) $lbls[] = 'Terlambat';
                                        if (str_contains($raw, 'Rusak')) $lbls[] = 'Rusak';
                                        if (str_contains($raw, 'Hilang')) $lbls[] = 'Hilang';
                                        $finalLabel = implode(' & ', $lbls);
                                    @endphp
                                    <p class="text-[9px] font-black text-red-400 uppercase tracking-widest mt-0.5">{{ $finalLabel ?: 'Lainnya' }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 no-print">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('struk.cetak', $detail->id) }}" target="_blank" 
                                        class="p-2 bg-gray-50 text-gray-600 border border-gray-200 rounded-xl hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all group" title="Cetak Struk">
                                        <i data-lucide="printer" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.laporan.sendEmail', $detail->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        <input type="email" name="email" placeholder="Email" required
                                            class="hidden md:block w-32 px-3 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition-all">
                                        <button type="submit" title="Kirim Email"
                                            class="p-2 bg-gray-50 text-gray-600 border border-gray-200 rounded-xl hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all">
                                            <i data-lucide="send" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                                Tidak ada data peminjaman yang selesai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                @if($details->count() > 0)
                    <tfoot>
                        <tr class="bg-gray-50/50 font-bold">
                            <td colspan="3" class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-gray-500">Pendapatan Denda</td>
                            <td class="px-6 py-4 text-right text-base font-black text-primary-600">
                                Rp {{ number_format($details->sum('denda'), 0, ',', '.') }}
                            </td>
                            <td class="no-print"></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

</div>
@endsection
