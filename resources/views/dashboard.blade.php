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
                <h4>{{ $totalPeminjaman }}</h4>
                <p class="text-muted mb-0">Total Peminjaman</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-calendar-month fa-3x text-info mb-3"></i>
                <h4>{{ $peminjamanBulanIni }}</h4>
                <p class="text-muted mb-0">Peminjaman Bulan Ini</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-line"></i> Statistik Peminjaman Per Bulan</h5>
            </div>
            <div class="card-body">
                <canvas id="peminjamanChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Peminjaman -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock"></i> Peminjaman Terbaru</h5>
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Peminjaman::with('user')->latest()->take(5)->get() as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_pinjam }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                                <td>
                                    @if($peminjaman->tanggal_kembali < now())
                                        <span class="badge bg-danger">Terlambat</span>
                                    @elseif($peminjaman->tanggal_pinjam <= now() && $peminjaman->tanggal_kembali >= now())
                                        <span class="badge bg-warning">Sedang Dipinjam</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data peminjaman</td>
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
    // Chart.js untuk statistik peminjaman
    const ctx = document.getElementById('peminjamanChart').getContext('2d');
    const peminjamanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Peminjaman',
                data: [
                    {{ $peminjamanPerBulan[1] ?? 0 }},
                    {{ $peminjamanPerBulan[2] ?? 0 }},
                    {{ $peminjamanPerBulan[3] ?? 0 }},
                    {{ $peminjamanPerBulan[4] ?? 0 }},
                    {{ $peminjamanPerBulan[5] ?? 0 }},
                    {{ $peminjamanPerBulan[6] ?? 0 }},
                    {{ $peminjamanPerBulan[7] ?? 0 }},
                    {{ $peminjamanPerBulan[8] ?? 0 }},
                    {{ $peminjamanPerBulan[9] ?? 0 }},
                    {{ $peminjamanPerBulan[10] ?? 0 }},
                    {{ $peminjamanPerBulan[11] ?? 0 }},
                    {{ $peminjamanPerBulan[12] ?? 0 }}
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
                    text: 'Peminjaman Alat Laboratorium Per Bulan'
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
