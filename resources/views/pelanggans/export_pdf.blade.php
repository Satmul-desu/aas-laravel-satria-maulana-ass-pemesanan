<!DOCTYPE html>
<html>
<head>
    <title>Export Pelanggan PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Pelanggan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $pelanggan->id }}</td>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    <td>{{ $pelanggan->telepon }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
