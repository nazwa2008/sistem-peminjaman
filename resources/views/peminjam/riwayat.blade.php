@extends('layouts.dashboard')
@section('title', 'Riwayat Peminjaman Saya')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-800">Daftar Pengajuan & Peminjaman</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-600 bg-gray-50 uppercase border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3">No Request</th>
                    <th class="px-6 py-3">Alat</th>
                    <th class="px-6 py-3">Tgl Pinjam</th>
                    <th class="px-6 py-3">Tgl Kembali</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $item)
                <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50">
                    <td class="px-6 py-4 font-medium text-gray-900">#REQ-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        @foreach($item->detailPeminjaman as $detail)
                            <div class="flex items-center">
                                <i data-lucide="tool" class="w-4 h-4 text-gray-400 mr-2"></i>
                                {{ $detail->alat->nama_alat }} ({{ $detail->jumlah }})
                            </div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @if($item->status == 'pending')
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-medium border border-amber-200">Pending</span>
                        @elseif($item->status == 'disetujui')
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium border border-blue-200">Aktif/Disetujui</span>
                        @elseif($item->status == 'selesai')
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-medium border border-green-200">Selesai</span>
                        @else
                            <span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-medium border border-red-200">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i data-lucide="inbox" class="w-10 h-10 text-gray-300 mb-2"></i>
                            <p>Belum ada riwayat peminjaman.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100 bg-gray-50">
        {{ $peminjamans->links() }}
    </div>
</div>
@endsection
