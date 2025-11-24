<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan - {{ date('d/m/Y') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-confirmed {
            background-color: #cce5ff;
            color: #004085;
        }
        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .total-row {
            background-color: #e9ecef !important;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Pemesanan</h1>
        <p>Dicetak pada: {{ date('d F Y, H:i:s') }}</p>
        <p>Total Data: {{ $pemesanans->count() }} pemesanan</p>
    </div>

    @if($pemesanans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Jenis Layanan</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $totalHarga = 0; $totalKeseluruhan = 0; @endphp
                @foreach($pemesanans as $index => $pemesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pemesanan->kode_transaksi }}</td>
                        <td>{{ $pemesanan->nama_pemesan }}</td>
                        <td>{{ $pemesanan->email }}</td>
                        <td>{{ $pemesanan->telepon }}</td>
                        <td>{{ $pemesanan->tanggal_pemesanan->format('d/m/Y') }}</td>
                        <td>{{ $pemesanan->jenis_layanan }}</td>
                        <td>{{ Str::limit($pemesanan->deskripsi, 50) }}</td>
                        <td>Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="status status-{{ $pemesanan->status }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>
                        </td>
                    </tr>
                    @php
                        $totalHarga += $pemesanan->harga;
                        $totalKeseluruhan += $pemesanan->total;
                    @endphp
                @endforeach
                <tr class="total-row">
                    <td colspan="8" style="text-align: right; font-weight: bold;">TOTAL:</td>
                    <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="no-data">
            <h3>Tidak ada data pemesanan</h3>
            <p>Belum ada pemesanan yang tercatat dalam sistem.</p>
        </div>
    @endif

    <div class="footer">
        <p>Dicetak oleh Sistem Manajemen Laboratorium</p>
        <p>&copy; {{ date('Y') }} - Semua hak dilindungi</p>
    </div>
</body>
</html>
