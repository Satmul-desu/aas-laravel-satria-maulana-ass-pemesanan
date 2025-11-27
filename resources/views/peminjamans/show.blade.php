@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Peminjaman</h1>
    <div class="card p-3">
        <p><strong>Kode Pinjam:</strong> {{ $peminjaman->kode_pinjam }}</p>
        <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}</p>
        <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali->format('Y-m-d') }}</p>
        <p><strong>Admin (User):</strong> {{ $peminjaman->user->name }}</p>
        <p><strong>Total:</strong> {{ number_format($peminjaman->total, 2) }}</p>

        <h5>Daftar Alat yang Dipinjam</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman->alats as $alat)
                <tr>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->pivot->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('peminjamans.edit', $peminjaman->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
