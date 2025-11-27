<!DOCTYPE html>
<html>
<head>
    <title>Export Kategori Alat PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Kategori Alat Laboratorium</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Jumlah Alat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoriAlats as $kategori)
                <tr>
                    <td>{{ $kategori->id }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>{{ $kategori->alats->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
