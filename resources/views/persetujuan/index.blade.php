@extends('layouts.app')

@section('header', 'Persetujuan Peminjaman')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-xl font-bold text-gray-900">Permohonan Menunggu</h3>
        <p class="text-sm text-gray-500 mt-1">Review dan kelola permohonan peminjaman alat yang masuk.</p>
    </div>

    @forelse($peminjaman as $item)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group hover:border-primary-100 transition-all">
            <div class="p-6">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-primary-600 font-bold text-xs uppercase group-hover:bg-primary-50 transition-colors">
                            {{ substr($item->nama_peminjam ?? $item->user->name, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $item->nama_peminjam }}</p>
                            <p class="text-xs text-gray-400">Kode: {{ $item->kode_peminjaman }} • {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="document.getElementById('approve-form-{{ $item->id }}').submit()" class="px-4 py-2 bg-primary-600 text-white text-xs font-bold rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            Setujui
                        </button>
                        <button onclick="const reason = prompt('Alasan penolakan:'); if(reason) { document.getElementById('reject-reason-{{ $item->id }}').value = reason; document.getElementById('reject-form-{{ $item->id }}').submit(); }" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                            Tolak
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($item->details as $detail)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <i data-lucide="box" class="w-4 h-4 text-gray-400 mt-0.5"></i>
                            <div>
                                <p class="text-xs font-semibold text-gray-900">{{ $detail->alat->nama_alat }}</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">ID: #{{ $detail->alat->id }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Hidden Forms -->
                <form id="approve-form-{{ $item->id }}" action="{{ route('admin.persetujuan.approve', $item->id) }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                </form>
                <form id="reject-form-{{ $item->id }}" action="{{ route('admin.persetujuan.reject', $item->id) }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    <input type="hidden" name="alasan_penolakan" id="reject-reason-{{ $item->id }}">
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <i data-lucide="check-circle-2" class="w-12 h-12 text-gray-100 mx-auto mb-4"></i>
            <p class="text-sm text-gray-500 font-medium">Semua permohonan sudah diproses.</p>
        </div>
    @endforelse
</div>
@endsection
