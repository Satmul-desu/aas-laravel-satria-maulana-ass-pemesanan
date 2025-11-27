@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm bg-white">
<div class="card-header d-flex justify-content-between align-items-center">
                     <div class="card-header bg-gradient-info text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-hand-holding"></i> Daftar Kategori Alat</h5></div>
                    <div>
                        <a href="{{ route('peminjamans.export.pdf') }}" class="btn btn-info btn-sm me-2">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('peminjamans.export.excel') }}" class="btn btn-info btn-sm me-3">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <a href="{{ route('peminjamans.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Peminjaman
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Kode Pinjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_pinjam }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}</td>
                                <td>{{ $peminjaman->tanggal_kembali->format('Y-m-d') }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ number_format($peminjaman->total, 2) }}</td>
                                <td>
                                    <a href="{{ route('peminjamans.show', $peminjaman->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('peminjamans.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('peminjamans.destroy', $peminjaman->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
