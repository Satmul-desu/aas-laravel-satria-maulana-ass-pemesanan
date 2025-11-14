@extends('layouts.app')

@section('title', 'Detail Alat: ' . $alat->nama_alat)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0"><i class="fas fa-tools"></i> {{ $alat->nama_alat }}</h4>
                            <small>Kategori: {{ $alat->kategori->nama_kategori }}</small>
                        </div>
                        <div>
                            <a href="{{ route('alats.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Info Alat -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Alat</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Stok Total:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-primary fs-6">{{ $alat->stok }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Tersedia:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge {{ $availableStock > 10 ? 'bg-success' : ($availableStock > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                        {{ $availableStock }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Dipinjam:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-secondary fs-6">{{ $currentBorrowed }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Total Peminjaman:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-info fs-6">{{ $totalPeminjaman }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="fas fa-qrcode"></i> QR Code</h6>
                        </div>
                        <div class="card-body text-center">
                            {!! QrCode::size(150)->generate(route('alats.show', $alat->id)) !!}
                            <p class="mt-2 mb-0 small text-muted">Scan untuk detail alat</p>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Peminjaman Terbaru</h5>
                        </div>
                        <div class="card-body">
                            @if($recentPeminjaman->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Peminjam</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentPeminjaman as $detail)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($detail->peminjaman->tanggal_pinjam)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($detail->peminjaman->tanggal_kembali)->format('d/m/Y') }}</td>
                                                <td>{{ $detail->peminjaman->user->name }}</td>
                                                <td>{{ $detail->jumlah }}</td>
                                                <td>
                                                    @if($detail->peminjaman->tanggal_kembali < now())
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    @elseif($detail->peminjaman->tanggal_kembali > now())
                                                        <span class="badge bg-warning">Dipinjam</span>
                                                    @else
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada riwayat peminjaman</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto refresh every 30 seconds for real-time updates
    setInterval(function() {
        // You can add AJAX call here to refresh data if needed
    }, 30000);
});
</script>
@endsection
