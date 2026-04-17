<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Peminjaman #{{ $detail->peminjaman->kode_peminjaman }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.4; color: #333; margin: 0; padding: 0; }
        .receipt-box { width: 100%; max-width: 500px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { padding: 5px 0; }
        .items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items th { border-bottom: 2px solid #eee; text-align: left; padding: 10px; background-color: #f9f9f9; }
        .items td { padding: 10px; border-bottom: 1px solid #eee; }
        .total { text-align: right; font-weight: bold; font-size: 16px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 40px; font-style: italic; color: #777; font-size: 12px; }
    </style>
</head>
<body>
    <div class="receipt-box">
        <div class="header">
            <h2>{{ config('app.name') }}</h2>
            <p>Bukti Peminjaman Alat Resmi</p>
        </div>

        <div class="info">
            <table>
                <tr>
                    <td width="40%"><strong>Kode Transaksi</strong></td>
                    <td>: #{{ $detail->peminjaman->kode_peminjaman }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Peminjam</strong></td>
                    <td>: {{ $detail->peminjaman->nama_peminjam }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Cetak</strong></td>
                    <td>: {{ date('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Deskripsi Alat</th>
                    <th align="right">Denda</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $detail->alat->nama_alat }}<br>
                        <small>Pinjam: {{ \Carbon\Carbon::parse($detail->tanggal_pinjam)->format('d/m/Y') }}</small><br>
                        <small>Kembali: {{ \Carbon\Carbon::parse($detail->tanggal_pengembalian)->format('d/m/Y') }}</small>
                        @if($detail->keterangan_denda)
                            <div style="margin-top: 5px; color: #d32f2f; font-style: italic; font-size: 11px;">
                                Rincian: {{ $detail->keterangan_denda }}
                            </div>
                        @endif
                    </td>
                    <td align="right">Rp {{ number_format($detail->denda, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            TOTAL DENDA: Rp {{ number_format($detail->denda, 0, ',', '.') }}
        </div>

        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
            <p>Simpan struk ini sebagai bukti resmi.</p>
        </div>
    </div>
</body>
</html>
