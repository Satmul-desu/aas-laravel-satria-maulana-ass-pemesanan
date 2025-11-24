@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Card -->
            <div class="card shadow-lg border-0 rounded-lg mb-4">
                <div class="card-header bg-gradient-info text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1"><i class="fas fa-eye me-2"></i>Detail Pemesanan</h2>
                            <p class="mb-0 opacity-75">Kode: {{ $pemesanan->kode_pesan ?? '-' }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('pemesanans.edit', $pemesanan->id) }}" class="btn btn-warning btn-lg shadow-sm">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('pemesanans.index') }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="p-3 rounded bg-light">
                                        <i class="fas fa-user fa-2x text-primary mb-2"></i>
                                        <h5 class="mb-1">{{ $pemesanan->user->name }}</h5>
                                        <small class="text-muted">Pelanggan</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded bg-light">
                                        <i class="fas fa-calendar-plus fa-2x text-success mb-2"></i>
                                        <h5 class="mb-1">{{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d/m/Y') }}</h5>
                                        <small class="text-muted">Tanggal Pesan</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded bg-light">
                                        @if($pemesanan->is_done ?? false)
                                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                            <h5 class="mb-1 text-success">Selesai</h5>
                                        @else
                                            <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                            <h5 class="mb-1 text-warning">Aktif</h5>
                                        @endif
                                        <small class="text-muted">Status</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-md-12">
                                    <div class="p-3 rounded bg-light">
                                        <i class="fas fa-dollar-sign fa-2x text-success mb-2"></i>
                                        <h5 class="mb-1 text-success">Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</h5>
                                        <small class="text-muted">Total</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alat Details -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-gradient-primary text-white py-4">
                            <h4 class="mb-0">
                                <i class="fas fa-tools me-2"></i>Alat yang Dipesan
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            @if($pemesanan->details->count() > 0)
                                <div class="row">
                                    @foreach($pemesanan->details as $detail)
                                    <div class="col-md-6 mb-4">
                                        <div class="card border h-100 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-3">
                                                        <div class="text-center">
                                                            <i class="fas fa-toolbox fa-3x text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="card-title text-primary mb-2">{{ $detail->alat->nama_alat }}</h5>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <small class="text-muted">Jumlah:</small>
                                                                <h6 class="text-success mb-0">{{ $detail->jumlah }}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted">Kategori:</small>
                                                                <h6 class="text-info mb-0">{{ $detail->alat->kategori->nama_kategori }}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <small class="text-muted">Harga per unit:</small>
                                                            <h6 class="text-warning mb-0">Rp {{ number_format($detail->alat->harga, 0, ',', '.') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Summary -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <h5 class="text-center mb-3">
                                                    <i class="fas fa-calculator me-2"></i>Ringkasan Pemesanan
                                                </h5>
                                                <div class="row text-center">
                                                    <div class="col-md-6">
                                                        <div class="p-3">
                                                            <i class="fas fa-tools fa-2x text-primary mb-2"></i>
                                                            <h4 class="text-primary">{{ $pemesanan->details->count() }}</h4>
                                                            <small class="text-muted">Jenis Alat</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="p-3">
                                                            <i class="fas fa-hashtag fa-2x text-success mb-2"></i>
                                                            <h4 class="text-success">{{ $pemesanan->details->sum('jumlah') }}</h4>
                                                            <small class="text-muted">Total Unit</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-tools fa-4x text-muted mb-3"></i>
                                    <h4 class="text-muted">Tidak ada alat yang dipesan</h4>
                                    <p class="text-muted">Data alat untuk pemesanan ini tidak tersedia</p>
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
