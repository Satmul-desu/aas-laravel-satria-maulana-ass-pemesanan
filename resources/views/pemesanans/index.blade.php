@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
<div class="card shadow-sm">
  <div class="card-header bg-gradient-info text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-solid fa-cart-flatbed"></i> Daftar Pemesanan</h5>
    <div>
        <a href="{{ route('pemesanans.export.pdf') }}" class="btn btn-info btn-sm me-2">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('pemesanans.export.excel') }}" class="btn btn-info btn-sm me-3">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('pemesanans.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pemesanan
        </a>
    </div>
</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Kode Pesan</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nama Alat</th>
                                    <th scope="col">Detail Alat</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $pemesanan)
                                <tr>
                                    <td>{{ $pemesanan->kode_transaksi }}</td>
                                    <td>{{ $pemesanan->pelanggan->nama ?? 'N/A' }}</td>
                                    <td>
                                        @if($pemesanan->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($pemesanan->status == 'confirmed')
                                            <span class="badge bg-info">Confirmed</span>
                                        @elseif($pemesanan->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pemesanan->alat->isEmpty())
                                            <span class="text-muted">Tidak ada alat</span>
                                        @else
                                            {{ $pemesanan->alat->pluck('nama_alat')->join(', ') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($pemesanan->alat->isEmpty())
                                            <span class="text-muted">Tidak ada alat</span>
                                        @else
                                            <ul class="list-unstyled mb-0">
                                                @foreach($pemesanan->alat as $alat)
                                                    <li>{{ $alat->nama_alat }} x {{ $alat->pivot->jumlah }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>{{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-primary btn-sm">Detail</a>
                                        @if($pemesanan->jenis_layanan === 'permohonan pembayaran' && $pemesanan->status === 'pending pesan')
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin melakukan pembayaran?')" disabled>Bayar</button>
                                            </form>
                                        @elseif($pemesanan->jenis_layanan === 'permohonan pembayaran' && $pemesanan->status === 'paid')
                                            <span class="badge bg-success">Sudah Dibayar</span>
                                        @else
                                            <a href="{{ route('pemesanans.edit', $pemesanan) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form
                                                onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?');"
                                                action="{{ route('pemesanans.destroy', $pemesanan) }}"
                                                method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $pemesanans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
