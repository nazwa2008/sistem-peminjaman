<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Peminjaman #{{ $detail->peminjaman->kode_peminjaman }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .invoice-card { border: none !important; box-shadow: none !important; }
            @page { margin: 10mm; }
        }

        .gradient-brand {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">

    <div class="max-w-2xl mx-auto">
        <!-- Action Buttons -->
        <div class="no-print flex items-center justify-between mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-400 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Kembali
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M7 18h10"/></svg>
                Cetak Struk
            </button>
        </div>

        <!-- Main Invoice Card -->
        <div class="invoice-card bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-2xl">
            <!-- Header Section -->
            <div class="gradient-brand p-10 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
                    <svg width="300" height="300" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" fill="currentColor"/></svg>
                </div>
                
                <div class="relative z-10 flex flex-wrap justify-between items-start gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                            </div>
                            <span class="text-xl font-extrabold tracking-tight uppercase">{{ config('app.name', 'SIPA') }}</span>
                        </div>
                        <p class="text-blue-100 text-[10px] font-black uppercase tracking-[0.3em]">Nota Peminjaman Alat</p>
                    </div>

                    <div class="text-right">
                        <h1 class="text-xs font-black uppercase tracking-[0.2em] text-blue-200 mb-1">KODE TRANSAKSI</h1>
                        <p class="text-2xl font-black tracking-tighter">#{{ $detail->peminjaman->kode_peminjaman }}</p>
                        <p class="text-blue-200 text-[9px] mt-1 font-bold">{{ now()->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Status Badges Wrapper -->
                <div class="relative z-10 flex gap-2 mt-8">
                    @php
                        $isReturned = $detail->status_item === 'dikembalikan';
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-wider {{ $isReturned ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-blue-500/20 text-blue-200 border border-blue-500/30' }}">
                        {{ $isReturned ? '✓ Selesai' : '⏳ Sedang Dipinjam' }}
                    </span>
                    @if($detail->denda > 0)
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-red-500/20 text-red-300 border border-red-500/30">
                            ⚠ Ada Denda
                        </span>
                    @else
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-white/10 text-white/80 border border-white/20">
                            ✓ Tanpa Denda
                        </span>
                    @endif
                </div>
            </div>

            <!-- Borrower Information Section -->
            <div class="p-10 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Informasi Peminjam</h3>
                <div class="grid grid-cols-2 gap-y-6 gap-x-12">
                    <div class="space-y-1">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Nama Peminjam</p>
                        <p class="text-sm font-extrabold text-blue-900">{{ $detail->peminjaman->nama_peminjam }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">ID Detail</p>
                        <p class="text-sm font-bold text-gray-800 uppercase">#DTL-{{ str_pad($detail->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Pinjam</p>
                        <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($detail->tanggal_pinjam)->format('d F Y') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Batas Kembali</p>
                        <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Single Item Detail Section -->
            <div class="p-10 border-b border-gray-50">
                <h3 class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Detail Alat</h3>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-black text-gray-900 uppercase">{{ $detail->alat->nama_alat }}</p>
                        <p class="text-[9px] text-gray-500 font-bold mt-1 uppercase tracking-wider">Kategori: {{ $detail->alat->kategori }}</p>
                        @if($detail->kondisi_akhir)
                            <p class="text-[9px] text-blue-600 font-black mt-0.5 uppercase tracking-wider">Kondisi Saat Kembali: {{ $detail->kondisi_akhir }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        @if($isReturned)
                            <p class="text-[9px] font-black text-green-500 uppercase tracking-widest mb-1">Status Item</p>
                            <p class="text-xs font-bold text-green-600 uppercase">Sudah Kembali</p>
                        @else
                            <p class="text-[9px] font-black text-blue-400 uppercase tracking-widest mb-1">Status Item</p>
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-wide">Masih Dipinjam</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Fine Summary Section -->
            <div class="p-10 bg-gray-50/50">
                <h3 class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Ringkasan Denda</h3>
                
                @if($detail->denda > 0)
                    <div class="bg-red-50 border-2 border-red-100 rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute right-0 top-0 text-red-100 transform translate-x-1/4 -translate-y-1/4 opacity-40">
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 22h20L12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                        </div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-[9px] font-black text-red-400 uppercase tracking-[0.2em] mb-1">Total Denda</p>
                                    <p class="text-3xl font-black text-red-600 tracking-tighter">Rp {{ number_format($detail->denda, 0, ',', '.') }}</p>
                                </div>
                                <div class="bg-red-600 text-white px-3 py-1 rounded-lg text-[9px] font-black uppercase">Wajib Bayar</div>
                            </div>
                            <div class="pt-4 border-t border-red-100 mt-4 space-y-3">
                                <p class="text-[9px] font-black text-red-400 uppercase tracking-wider">Rincian Denda:</p>
                                @php
                                    $parts = explode(' & ', $detail->keterangan_denda);
                                @endphp
                                <ul class="space-y-1.5">
                                    @foreach($parts as $part)
                                        <li class="flex items-center gap-2 text-xs font-bold text-red-800 uppercase italic">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><path d="m9 18 6-6-6-6"/></svg>
                                            {{ $part }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-green-50 border-2 border-green-100 rounded-2xl p-8 flex items-center justify-between">
                        <div>
                            <p class="text-[9px] font-black text-green-400 uppercase tracking-[0.2em] mb-1">Status Pembayaran</p>
                            <p class="text-sm font-extrabold text-green-800 uppercase italic">LUNAS / TIDAK ADA DENDA</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Footer Section -->
            <div class="p-10 border-t border-gray-100 flex flex-wrap justify-between items-end gap-10">
                <div>
                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-10">Tanda Tangan Petugas</p>
                    <div class="border-b border-gray-300 w-40 mb-2"></div>
                    <p class="text-[10px] font-black text-gray-900 uppercase">{{ $detail->returnHandler->name ?? $detail->peminjaman->petugas->name ?? 'Administrator' }}</p>
                    <p class="text-[8px] text-gray-400 font-bold uppercase tracking-tight">DIPROSES SECARA DIGITAL</p>
                </div>

                <div class="text-right max-w-xs">
                    <p class="text-[9px] text-gray-300 font-bold uppercase tracking-widest leading-loose">
                        Struk ini diterbitkan oleh {{ config('app.name') }} sebagai bukti transaksi yang sah.
                        &copy; {{ date('Y') }} SIPA INDONESIA.
                    </p>
                </div>
            </div>
        </div>

        <p class="text-center mt-8 text-gray-300 text-[9px] font-black uppercase tracking-[0.4em]">One Item One Receipt Policy</p>
    </div>

</body>
</html>
