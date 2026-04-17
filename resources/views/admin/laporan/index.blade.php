@extends('layouts.dashboard')
@section('title', 'Laporan Berdasarkan Peminjaman')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="p-6">
        <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full text-sm rounded-md border border-gray-300 py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full text-sm rounded-md border border-gray-300 py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md flex items-center transition">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i> Filter
                </button>
            </div>
            @if(request()->has('start_date'))
            <div>
                <a href="{{ route('laporan.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md flex items-center transition">
                    Reset
                </a>
            </div>
            @endif
            <div class="ml-auto">
                <button type="submit" name="print" value="1" formtarget="_blank" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md flex items-center transition">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Cetak Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-600 bg-gray-50 uppercase border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3">Peminjam</th>
                    <th class="px-6 py-3">Tgl Pinjam</th>
                    <th class="px-6 py-3">Tgl Kembali</th>
                    <th class="px-6 py-3">Status Peminjaman</th>
                    <th class="px-6 py-3">Denda</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($peminjamans as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $item->peminjam->name }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-semibold uppercase">{{ $item->status }}</span>
                    </td>
                    <td class="px-6 py-4 font-medium">
                        @if($item->pengembalian)
                            Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data untuk periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
