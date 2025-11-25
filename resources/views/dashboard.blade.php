@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-tools fa-3x text-primary mb-3"></i>
                <h4>{{ $totalAlats }}</h4>
                <p class="text-muted mb-0">Total Stok Alat</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-tags fa-3x text-success mb-3"></i>
                <h4>{{ $totalKategori }}</h4>
                <p class="text-muted mb-0">Kategori Alat</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-hand-holding fa-3x text-warning mb-3"></i>
                <h4>{{ $totalPemesanan }}</h4>
                <p class="text-muted mb-0">Total Pemesanan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-calendar-month fa-3x text-info mb-3"></i>
                <h4>{{ $pemesananBulanIni }}</h4>
                <p class="text-muted mb-0">Pemesanan Bulan Ini</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-3x text-danger mb-3"></i>
                <h4>Rp {{ number_format($totalKerugian, 0, ',', '.') }}</h4>
                <p class="text-muted mb-0">Total Kerugian (Denda)</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                <h4>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                <p class="text-muted mb-0">Total Pemasukan</p>
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

<!-- Recent Pemesanan -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock"></i> Pemesanan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Pesan</th>
                                <th>User</th>
                                <th>Tanggal Pesan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Pemesanan::with('user')->latest()->take(5)->get() as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->kode_pesan }}</td>
                                <td>{{ $pemesanan->user->name }}</td>
                                <td>{{ $pemesanan->tanggal_pesan ? $pemesanan->tanggal_pesan->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($pemesanan->is_done)
                                        <span class="badge bg-success">Done</span>
                                    @else
                                        <span class="badge bg-warning">No</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data pemesanan</td>
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
