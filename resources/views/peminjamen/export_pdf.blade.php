<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peminjaman Alat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .status-terlambat { color: red; }
        .status-sedang { color: orange; }
        .status-selesai { color: green; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Peminjaman Alat Laboratorium</h2>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>User</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Alat Dipinjam</th>
                <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Late Fee</th>
                                    <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamen as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->kode_pinjam }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                <td>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                <td>
                    @foreach($peminjaman->details as $detail)
                        {{ $detail->alat->nama_alat }} ({{ $detail->jumlah }})
                        @if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>{{ $peminjaman->details->sum('jumlah') }}</td>
                <td>Rp {{ number_format($peminjaman->total, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($peminjaman->late_fee ?? 0, 0, ',', '.') }}</td>
                <td>
                    @if($peminjaman->tanggal_kembali < now())
                        <span class="status-terlambat">Terlambat</span>
                    @elseif($peminjaman->tanggal_pinjam <= now() && $peminjaman->tanggal_kembali >= now())
                        <span class="status-sedang">Sedang Dipinjam</span>
                    @else
                        <span class="status-selesai">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center;">
        <p>Total Data: {{ $peminjamen->count() }} peminjaman</p>
    </div>
</body>
</html>
