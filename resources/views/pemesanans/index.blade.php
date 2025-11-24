@extends('layouts.app')

@section('title', 'Kelola Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-shopping-cart"></i> Kelola Pemesanan</h4>
                    <div>
                        <a href="{{ route('pemesanans.export.pdf') }}" class="btn btn-danger btn-sm me-2" target="_blank">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('pemesanans.export.excel') }}" class="btn btn-success btn-sm me-2" target="_blank">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <a href="{{ route('pemesanans.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pemesanan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari pemesanan...">
                        </div>
                        <div class="col-md-6">
                            <select id="statusFilter" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="pemesanansTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Pemesan</th>
                                    <th>Jenis Layanan</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemesanans as $index => $pemesanan)
                                <tr>
                                    <td>{{ $pemesanans->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $pemesanan->kode_transaksi }}</span>
                                    </td>
                                    <td>{{ $pemesanan->nama_pemesan }}</td>
                                    <td>{{ $pemesanan->jenis_layanan }}</td>
                                    <td>{{ $pemesanan->tanggal_pemesanan->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
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
                                        <a href="{{ route('pemesanans.show', $pemesanan->id) }}" class="btn btn-sm btn-outline-info me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pemesanans.edit', $pemesanan->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deletePemesanan({{ $pemesanan->id }}, '{{ $pemesanan->kode_transaksi }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data pemesanan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('pagination', ['paginator' => $pemesanans])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#pemesanansTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Filter by status
    $('#statusFilter').on('change', function() {
        const status = $(this).val();
        if (status === '') {
            $('#pemesanansTable tbody tr').show();
        } else {
            $('#pemesanansTable tbody tr').each(function() {
                const statusBadge = $(this).find('td:eq(6) .badge').text().toLowerCase();
                $(this).toggle(statusBadge.includes(status));
            });
        }
    });
});

// Delete Pemesanan
function deletePemesanan(id, kode) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Hapus pemesanan "${kode}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('pemesanans') }}/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Pemesanan berhasil dihapus',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus pemesanan'
                    });
                }
            });
        }
    });
}
</script>
@endsection
