@extends('layouts.dashboard')
@section('title', 'Proses Pengembalian')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Kolom Kiri: Peminjaman Aktif (Bisa Dikembalikan) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-indigo-50/50">
            <h3 class="font-bold text-indigo-900">Peminjaman Aktif</h3>
            <p class="text-xs text-indigo-600">Pilih peminjaman untuk diproses pengembalian</p>
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-600 bg-gray-50 uppercase border-b border-gray-100">
                    <tr>
                        <th class="py-2 px-3">Peminjam</th>
                        <th class="py-2 px-3">Tgl Kembali Seharusnya</th>
                        <th class="py-2 px-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($peminjamans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-3">
                            <span class="font-medium text-gray-900 block">{{ $item->peminjam->name }}</span>
                            @foreach($item->detailPeminjaman as $d)
                                <span class="text-xs text-gray-500 block">• {{ $d->alat->nama_alat }} ({{$d->jumlah}})</span>
                            @endforeach
                        </td>
                        <td class="py-3 px-3 text-gray-600">
                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                        </td>
                        <td class="py-3 px-3 text-center">
                            <form action="{{ route('pengembalian.proses', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Proses pengembalian alat ini?')" class="inline-flex items-center text-xs bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md transition">
                                    <i data-lucide="corner-down-left" class="w-3.5 h-3.5 mr-1"></i> Proses
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center py-6 text-gray-500 text-xs">Tidak ada peminjaman aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $peminjamans->links() }}</div>
        </div>
    </div>

    <!-- Kolom Kanan: Riwayat Pengembalian -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-green-50/50">
            <h3 class="font-bold text-green-900">Riwayat Pengembalian</h3>
            <p class="text-xs text-green-600">Alat yang sudah dikembalikan</p>
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-600 bg-gray-50 uppercase border-b border-gray-100">
                    <tr>
                        <th class="py-2 px-3">Peminjam</th>
                        <th class="py-2 px-3">Tgl Dikembalikan</th>
                        <th class="py-2 px-3">Denda</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($riwayat_pengembalian as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-3 font-medium text-gray-900">{{ $item->peminjaman->peminjam->name ?? '-' }}</td>
                        <td class="py-3 px-3 text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d M Y') }}</td>
                        <td class="py-3 px-3">
                            @if($item->denda > 0)
                                <span class="text-red-600 font-semibold">Rp {{ number_format($item->denda, 0, ',', '.') }}</span>
                            @else
                                <span class="text-green-600 font-medium">Rp 0</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center py-6 text-gray-500 text-xs">Belum ada riwayat.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $riwayat_pengembalian->links() }}</div>
        </div>
    </div>

</div>
@endsection
