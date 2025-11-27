@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Row 1: total stok alat, kategori, total pemesanan -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-tools fa-3x text-primary mb-3"></i>
                    <h4>{{ $totalAlats }}</h4>
                    <p class="text-muted mb-0">Total Stok Alat</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-tags fa-3x text-success mb-3"></i>
                    <h4>{{ $totalKategori }}</h4>
                    <p class="text-muted mb-0">Kategori Alat</p>
                </div>
            </div>
        </div>
          <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                    <h4>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                    <p class="text-muted mb-0">Total Pemasukan</p>
                </div>
            </div>
        </div>
    </div>
       
    </div>

    <!-- Row 2: total peminjaman, total pemasukan -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-file-invoice-dollar fa-3x text-info mb-3"></i>
                    <h4>{{ $peminjamanCount }}</h4>
                    <p class="text-muted mb-0">Total Peminjaman</p>
                </div>
            </div>
        </div>
         <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x text-warning mb-3"></i>
                    <h4>{{ $totalPemesanan }}</h4>
                    <p class="text-muted mb-0">Total Pemesanan</p>
                </div>
            </div>
        </div>
      

    <!-- Row 3: total pemesanan bulan ini, total peminjaman bulan ini (vertical columns) -->
    <div class="row mb-4">
        <div class="col-md-6 d-flex flex-column align-items-center">
            <div class="card w-100 mb-3">
                <div class="card-body text-center">
                    <i class="fas fa-envelope fa-3x text-info mb-3"></i>
                    <h4>{{ $pemesananBulanIni }}</h4>
                    <p class="text-muted mb-0">Pemesanan Bulan Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column align-items-center">
            <div class="card w-100 mb-3">
                <div class="card-body text-center">
                    <i class="fas fa-briefcase fa-3x text-info mb-3"></i> 
                    <h4>{{ $peminjamanBulanIni }}</h4>
                    <p class="text-muted mb-0">Peminjaman Bulan Ini</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Chart -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-line"></i> Statistik Pemesanan Per Bulan</h5>
            </div>
            <div class="card-body">
                <canvas id="pemesananChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- History Pemesanan -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-history"></i> History Pemesanan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Pesan</th>
                                <th>User</th>
                                <th>Nama Alat</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Pemesanan::with('pelanggan', 'alat')->latest()->take(5)->get() as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->kode_transaksi }}</td>
                                <td>{{ $pemesanan->pelanggan->nama ?? 'N/A' }}</td>
                                <td>
                                    @if($pemesanan->alat->isEmpty())
                                        <span class="text-muted">Tidak ada alat</span>
                                    @else
                                        {{ $pemesanan->alat->pluck('nama_alat')->join(', ') }}
                                    @endif
                                </td>
                                <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pemesanan selesai</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- History Peminjaman -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-history"></i> History Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Pinjam</th>
                                <th>User</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPeminjamans as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_pinjam ?? 'N/A' }}</td>
                                <td>{{ $peminjaman->user->name ?? 'N/A' }}</td>
                                <td>{{ optional($peminjaman->tanggal_pinjam)->format('Y-m-d') }}</td>
                                <td>{{ optional($peminjaman->tanggal_kembali)->format('Y-m-d') }}</td>
                                <td>Rp {{ number_format($peminjaman->total ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data peminjaman selesai</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Chart.js untuk statistik pemesanan
    const ctx = document.getElementById('pemesananChart').getContext('2d');
    const pemesananChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pemesanan',
                data: [
                    {{ $pemesananPerBulan[1] ?? 0 }},
                    {{ $pemesananPerBulan[2] ?? 0 }},
                    {{ $pemesananPerBulan[3] ?? 0 }},
                    {{ $pemesananPerBulan[4] ?? 0 }},
                    {{ $pemesananPerBulan[5] ?? 0 }},
                    {{ $pemesananPerBulan[6] ?? 0 }},
                    {{ $pemesananPerBulan[7] ?? 0 }},
                    {{ $pemesananPerBulan[8] ?? 0 }},
                    {{ $pemesananPerBulan[9] ?? 0 }},
                    {{ $pemesananPerBulan[10] ?? 0 }},
                    {{ $pemesananPerBulan[11] ?? 0 }},
                    {{ $pemesananPerBulan[12] ?? 0 }}
                ],
                borderColor: 'rgb(102, 126, 234)',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Pemesanan Alat Laboratorium Per Bulan'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
