<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Alat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .text-center { text-align: center; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 60px; font-weight: bold; text-decoration: underline; }
        @media print {
            body { padding: 0; }
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>LAPORAN TRANSAKSI PEMINJAMAN ALAT</h1>
        <p>Sistem Peminjaman Alat (SipaApp)</p>
        @if(request('start_date') && request('end_date'))
            <p>Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</p>
        @else
            <p>Periode: Semua Riwayat Transaksi</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%">Peminjam</th>
                <th width="30%">Alat (Jumlah)</th>
                <th width="15%" class="text-center">Tgl Pinjam</th>
                <th width="15%" class="text-center">Tgl Kembali</th>
                <th width="15%" class="text-center">Status / Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->peminjam->name }}</td>
                <td>
                    @foreach($item->detailPeminjaman as $d)
                        <div>- {{ $d->alat->nama_alat }} ({{ $d->jumlah }})</div>
                    @endforeach
                </td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</td>
                <td class="text-center">
                    <div>{{ strtoupper($item->status) }}</div>
                    @if($item->pengembalian && $item->pengembalian->denda > 0)
                        <div style="color: red; font-size: 10px; margin-top: 4px;">Denda: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}</div>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
        <p>Petugas/Admin,</p>
        <div class="signature">{{ Auth::user()->name }}</div>
    </div>
</body>
</html>
