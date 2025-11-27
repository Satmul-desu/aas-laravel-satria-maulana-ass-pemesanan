@extends('layouts.app')

@section('title', 'Kelola Alat Laboratorium')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-tools"></i> Kelola Alat Laboratorium</h5>
                    <div>
                        <a href="{{ route('alats.export.pdf') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('alats.export.excel') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <a href="{{ route('alats.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Tambah Alat
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari alat...">
                        </div>
                        <div class="col-md-6">
                            <select id="kategoriFilter" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="alatsTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                    <th>Status Fungsi</th>
                                    <th>Kualitas</th>
                                <th>Layak Pakai</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $index => $alat)
                            <tr>
                                <td>{{ $alats->firstItem() + $index }}</td>
                                <td>{{ $alat->nama_alat }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $alat->kategori->nama_kategori }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $alat->stok > 10 ? 'bg-success' : ($alat->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $alat->stok }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $alat->kondisi == 'baru' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($alat->kondisi ?? 'N/A') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $alat->status_fungsi == 'berfungsi' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst(str_replace('_', ' ', $alat->status_fungsi ?? 'N/A')) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $alat->kualitas == 'baik' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($alat->kualitas ?? 'N/A') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $alat->layak == 'layak' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst(str_replace('_', ' ', $alat->layak ?? 'N/A')) }}
                                    </span>
                                </td>
                                <td>
                                    Rp {{ number_format($alat->harga, 2, ',', '.') }}
                                </td>
                                <td>
                                    <a href="{{ route('alats.show', $alat->id) }}" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('alats.edit', $alat->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteAlat({{ $alat->id }}, '{{ $alat->nama_alat }}')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data alat</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>

                    <!-- Pagination -->
                    @include('pagination', ['paginator' => $alats])
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
        $('#alatsTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Filter by kategori
    $('#kategoriFilter').on('change', function() {
        const kategoriId = $(this).val();
        if (kategoriId === '') {
            $('#alatsTable tbody tr').show();
        } else {
            $('#alatsTable tbody tr').each(function() {
                const rowKategoriName = $(this).find('td:eq(2) .badge').text();
                const selectedKategori = $('#kategoriFilter option:selected').text();
                $(this).toggle(rowKategoriName === selectedKategori);
            });
        }
    });
});

// Delete Alat
function deleteAlat(id, nama) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Hapus alat "${nama}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('alats') }}/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Alat berhasil dihapus',
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
                        text: 'Terjadi kesalahan saat menghapus alat'
                    });
                }
            });
        }
    });
}
</script>
@endsection
