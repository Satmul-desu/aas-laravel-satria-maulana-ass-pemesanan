@extends('layouts.app')

@section('title', 'Kategori Alat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
<div class="card shadow-sm">
                <div class="card-header bg-gradient-info text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-tags"></i> Daftar Kategori Alat</h5>
                    <div>
                        <a href="{{ route('kategori-alats.export.pdf') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('kategori-alats.export.excel') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <a href="{{ route('kategori-alats.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Tambah Kategori
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Alat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoriAlats as $kategori)
                                <tr>
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $kategori->alats->count() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('kategori-alats.show', $kategori->id) }}" class="btn btn-sm btn-outline-info me-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('kategori-alats.edit', $kategori->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteKategori({{ $kategori->id }}, '{{ $kategori->nama_kategori }}')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data kategori</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Delete Kategori
    function deleteKategori(id, nama) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Hapus kategori "${nama}"? Semua alat dalam kategori ini akan terpengaruh.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("kategori-alats") }}/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Kategori berhasil dihapus',
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
                            text: xhr.responseJSON.message || 'Terjadi kesalahan saat menghapus kategori'
                        });
                    }
                });
            }
        });
    }
</script>
@endsection
