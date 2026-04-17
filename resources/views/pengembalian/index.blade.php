@extends('layouts.app')

@section('header', 'Pengembalian Alat')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-xl font-bold text-gray-900">Alat Sedang Dipinjam</h3>
        <p class="text-sm text-gray-500 mt-1">Proses pengembalian alat dan verifikasi kondisi akhir.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Alat & Peminjam</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center">Tgl Kembali</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($details as $detail)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400">
                                        <i data-lucide="box" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $detail->alat->nama_alat }}</p>
                                        <p class="text-[11px] text-gray-500 uppercase font-bold tracking-tight">{{ $detail->peminjaman->nama_peminjam }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium {{ \Carbon\Carbon::parse($detail->tanggal_kembali)->isPast() ? 'text-red-500 font-bold' : 'text-gray-500' }}">
                                    {{ \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openReturnModal({{ $detail->id }}, '{{ $detail->alat->nama_alat }}')" class="px-4 py-2 bg-primary-600 text-white text-xs font-bold rounded-lg hover:bg-primary-700 transition-colors shadow-sm shadow-primary-500/20">
                                    Proses Kembali
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500 text-sm">
                                <i data-lucide="info" class="w-12 h-12 text-gray-100 mx-auto mb-4"></i>
                                Tidak ada alat yang perlu dikembalikan saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Simple Modal -->
<div id="returnModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6 bg-black/50 backdrop-blur-sm">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-900" id="modalTitle">Pengembalian Alat</h3>
        <p class="text-sm text-gray-500 mt-2">Pilih kondisi alat saat dikembalikan.</p>

        <form id="returnForm" method="POST" action="" class="mt-8 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Akhir</label>
                <select name="kondisi_akhir" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-primary-500 outline-none transition-all">
                    <option value="Baik">Baik (Normal)</option>
                    <option value="Rusak">Rusak (Denda Rp 5.000)</option>
                    <option value="Hilang">Hilang (Denda Rp 50.000)</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 py-2.5 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
                    Simpan & Selesai
                </button>
                <button type="button" onclick="closeReturnModal()" class="px-6 py-2.5 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-colors text-sm border border-gray-100">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReturnModal(id, name) {
        const modal = document.getElementById('returnModal');
        const form = document.getElementById('returnForm');
        const title = document.getElementById('modalTitle');
        
        form.action = `{{ route('admin.pengembalian.process', ':id') }}`.replace(':id', id);
        title.innerText = `Kembali: ${name}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeReturnModal() {
        const modal = document.getElementById('returnModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
