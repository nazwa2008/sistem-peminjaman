<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e7eb; border-radius: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; }
        .content { margin-bottom: 20px; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; pt: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Berikut kami lampirkan struk peminjaman alat dengan nomor transaksi <strong>#{{ $detail->peminjaman->kode_peminjaman }}</strong>.</p>
            <p>Detail Singkat:</p>
            <ul>
                <li>Alat: {{ $detail->alat->nama_alat }}</li>
                <li>Peminjam: {{ $detail->peminjaman->peminjam->name }}</li>
                <li>Tanggal Kembali: {{ \Carbon\Carbon::parse($detail->tanggal_pengembalian)->format('d/m/Y') }}</li>
            </ul>
            <p>Silakan unduh lampiran PDF untuk melihat rincian lengkapnya.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
