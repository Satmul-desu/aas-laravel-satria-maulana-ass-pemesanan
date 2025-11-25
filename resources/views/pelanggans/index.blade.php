@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pelanggan</h4>
                    <a href="{{ route('pelanggans.create') }}" class="btn btn-primary float-right">Tambah Pelanggan</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class=table-dark >
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelanggans as $pelanggan)
                                    <tr>
                                        <td>{{ $pelanggan->id }}</td>
                                        <td>{{ $pelanggan->nama }}</td>
                                        <td>{{ $pelanggan->email }}</td>
                                        <td>{{ $pelanggan->telepon }}</td>
                                        <td>{{ $pelanggan->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pelanggans.show', $pelanggan) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('pelanggans.edit', $pelanggan) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pelanggans.destroy', $pelanggan) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data pelanggan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
