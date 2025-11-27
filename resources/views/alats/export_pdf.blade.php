<!DOCTYPE html>
<html>
<head>
    <title>Export Alat PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Alat Laboratorium</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Status Fungsi</th>
                <th>Kualitas</th>
                <th>Layak Pakai</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alats as $alat)
                <tr>
                    <td>{{ $alat->id }}</td>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $alat->stok }}</td>
                    <td>{{ ucfirst($alat->kondisi ?? 'N/A') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $alat->status_fungsi ?? 'N/A')) }}</td>
                    <td>{{ ucfirst($alat->kualitas ?? 'N/A') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $alat->layak ?? 'N/A')) }}</td>
                    <td>Rp {{ number_format($alat->harga, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
