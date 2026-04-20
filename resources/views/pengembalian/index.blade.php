@extends('layouts.app')

@section('header', 'Pengembalian Alat')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-xl font-bold text-gray-900">Proses Pengembalian</h3>
        <p class="text-sm text-gray-500 mt-1">Verifikasi kondisi akhir alat untuk menyelesaikan transaksi.</p>
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
        <p class="text-sm text-gray-500 mt-2">Verifikasi kondisi akhir alat.</p>

        <form id="returnForm" method="POST" action="" class="mt-8 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Akhir</label>
                <select id="kondisi_akhir" name="kondisi_akhir" onchange="toggleFineInput()" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-primary-500 outline-none transition-all">
                    <option value="Baik">Baik (Normal)</option>
                    <option value="Telat">Telat (Denda Otomatis)</option>
                    <option value="Rusak / Hilang">Rusak / Hilang (Denda Manual)</option>
                </select>
            </div>

            <!-- Input Jumlah Hari (Hanya untuk Telat) -->
            <div id="telatGroup" class="hidden animate-in fade-in slide-in-from-top-2 duration-300">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Hari Keterlambatan</label>
                <div class="flex items-center gap-3">
                    <button type="button" onclick="adjustDays(-1)" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <i data-lucide="minus" class="w-4 h-4 text-gray-600"></i>
                    </button>
                    <input type="number" id="jumlah_hari" name="jumlah_hari" value="0" min="0" oninput="calculateFine()" class="flex-1 text-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-primary-500 outline-none">
                    <button type="button" onclick="adjustDays(1)" class="w-10 h-10 flex items-center justify-center bg-primary-50 text-primary-600 rounded-lg hover:bg-primary-100 transition-colors">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
                <p class="text-[11px] text-gray-400 mt-2 italic">* Denda otomatis: Rp 5.000 / hari</p>
            </div>

            <!-- Input Denda Manual (Hanya untuk Rusak/Hilang) -->
            <div id="manualGroup" class="hidden animate-in fade-in slide-in-from-top-2 duration-300">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Denda (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span>
                    <input type="number" id="denda_manual" name="denda_manual" placeholder="Masukkan harga barang..." oninput="calculateFine()" class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-primary-500 outline-none transition-all">
                </div>
            </div>

            <!-- Total Denda Display -->
            <div class="p-4 bg-primary-50/50 rounded-2xl border border-primary-100/50">
                <div class="flex justify-between items-center">
                    <span class="text-xs font-bold text-primary-900 uppercase tracking-wider">Total Denda</span>
                    <span id="total_denda_display" class="text-lg font-black text-primary-600">Rp 0</span>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/20 text-sm">
                    Simpan & Selesai
                </button>
                <button type="button" onclick="closeReturnModal()" class="px-6 py-3 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-colors text-sm border border-gray-100">
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
        
        // Reset form
        document.getElementById('kondisi_akhir').value = 'Baik';
        document.getElementById('jumlah_hari').value = '0';
        document.getElementById('denda_manual').value = '';
        toggleFineInput();
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeReturnModal() {
        const modal = document.getElementById('returnModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function toggleFineInput() {
        const kondisi = document.getElementById('kondisi_akhir').value;
        const telatGroup = document.getElementById('telatGroup');
        const manualGroup = document.getElementById('manualGroup');

        telatGroup.classList.add('hidden');
        manualGroup.classList.add('hidden');

        if (kondisi === 'Telat') {
            telatGroup.classList.remove('hidden');
        } else if (kondisi === 'Rusak / Hilang') {
            manualGroup.classList.remove('hidden');
        }
        
        calculateFine();
    }

    function adjustDays(val) {
        const input = document.getElementById('jumlah_hari');
        let current = parseInt(input.value) || 0;
        input.value = Math.max(0, current + val);
        calculateFine();
    }

    function calculateFine() {
        const kondisi = document.getElementById('kondisi_akhir').value;
        const display = document.getElementById('total_denda_display');
        let total = 0;

        if (kondisi === 'Telat') {
            const hari = parseInt(document.getElementById('jumlah_hari').value) || 0;
            total = hari * 5000;
        } else if (kondisi === 'Rusak / Hilang') {
            total = parseInt(document.getElementById('denda_manual').value) || 0;
        }

        display.innerText = `Rp ${total.toLocaleString('id-ID')}`;
    }
</script>
@endsection
