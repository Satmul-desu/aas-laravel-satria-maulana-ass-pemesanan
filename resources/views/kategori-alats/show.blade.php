@extends('layouts.app')

@section('title', 'Detail Kategori: ' . $kategoriAlat->nama_kategori)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0"><i class="fas fa-tags"></i> {{ $kategoriAlat->nama_kategori }}</h4>
                            <small>Kategori Alat Laboratorium</small>
                        </div>
                        <div>
                            <a href="{{ route('kategori-alats.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Statistik Kategori -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Kategori</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Total Alat:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-primary fs-6">{{ $totalAlats }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Total Stok:</strong>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-success fs-6">{{ $totalStok }}</span>
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
                        </div>
                    </div>

                    @if($mostBorrowedAlat)
                    <!-- Alat Terpopuler -->
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="fas fa-star"></i> Alat Terpopuler</h6>
                        </div>
                        <div class="card-body">
                            <h6>{{ $mostBorrowedAlat->nama_alat }}</h6>
                            <p class="mb-1">Total peminjaman: <strong>{{ $mostBorrowedAlat->total_borrowed ?? 0 }}</strong></p>
                            <a href="{{ route('alats.show', $mostBorrowedAlat->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Daftar Alat -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-tools"></i> Daftar Alat dalam Kategori</h5>
                        </div>
                        <div class="card-body">
                            @if($kategoriAlat->alats->count() > 0)
                                <div class="row">
                                    @foreach($kategoriAlat->alats as $alat)
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100 border">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $alat->nama_alat }}</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small class="text-muted">Stok:</small>
                                                        <span class="badge {{ $alat->stok > 10 ? 'bg-success' : ($alat->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                            {{ $alat->stok }}
                                                        </span>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <a href="{{ route('alats.show', $alat->id) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada alat dalam kategori ini</p>
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
