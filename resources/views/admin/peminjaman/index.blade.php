@extends('layouts.dashboard')
@section('title', 'Manajemen Peminjaman')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-lg font-bold text-gray-800">Daftar Pengajuan Peminjaman</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-600 bg-gray-100 uppercase border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Peminjam</th>
                    <th class="px-6 py-4">Alat (Stok Saat Ini)</th>
                    <th class="px-6 py-4">Periode</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi (Pending)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($peminjamans as $item)
                <tr class="bg-white hover:bg-gray-50/70 transition">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $item->peminjam->name }}</div>
                        <div class="text-xs text-gray-500">{{ $item->peminjam->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @foreach($item->detailPeminjaman as $detail)
                            <div class="flex items-center text-gray-700">
                                <i data-lucide="tool" class="w-3.5 h-3.5 text-gray-400 mr-1.5"></i>
                                {{ $detail->alat->nama_alat }} 
                                <span class="text-xs text-gray-400 ml-1">(Sisa: {{ $detail->alat->stok }})</span>
                            </div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }} <br>
                        <span class="text-xs text-gray-400">s/d</span> <br>
                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($item->status == 'pending')
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-medium border border-amber-200">Pending</span>
                        @elseif($item->status == 'disetujui')
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium border border-blue-200">Disetujui</span>
                        @elseif($item->status == 'selesai')
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-medium border border-green-200">Selesai</span>
                        @else
                            <span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-medium border border-red-200">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($item->status == 'pending')
                        <div class="flex items-center justify-center space-x-2">
                            <form action="{{ route('peminjaman.approve', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Setujui peminjaman ini?')" class="p-1.5 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition tooltip" title="Setujui">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </button>
                            </form>
                            <form action="{{ route('peminjaman.reject', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Tolak peminjaman ini?')" class="p-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition tooltip" title="Tolak">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                        @else
                            <span class="text-xs text-gray-400 flex justify-center">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i data-lucide="inbox" class="w-10 h-10 text-gray-300 mb-2"></i>
                            <p>Tidak ada data peminjaman.</p>
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
