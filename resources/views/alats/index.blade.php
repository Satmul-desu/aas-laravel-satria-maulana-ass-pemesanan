@extends('layouts.app')

@section('title', 'Kelola Alat Laboratorium')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-tools"></i> Kelola Alat Laboratorium</h5>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> Tambah Alat
                    </button>
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
                                        <a href="{{ route('alats.show', $alat->id) }}" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="editAlat({{ $alat->id }})" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteAlat({{ $alat->id }}, '{{ $alat->nama_alat }}')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data alat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $alats->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Tambah Alat Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="createForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Alat</label>
                        <input type="text" name="nama_alat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Alat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label class="form-label">Nama Alat</label>
                        <input type="text" id="editNamaAlat" name="nama_alat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select id="editKategoriId" name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" id="editStok" name="stok" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Create Alat
    $('#createForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("alats.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#createModal').modal('hide');
                $('#createForm')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Alat berhasil ditambahkan',
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
                    text: 'Terjadi kesalahan saat menambah alat'
                });
            }
        });
    });

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

// Edit Alat
function editAlat(id) {
    $.get(`{{ url('alats') }}/${id}`, function(data) {
        $('#editId').val(data.id);
        $('#editNamaAlat').val(data.nama_alat);
        $('#editKategoriId').val(data.kategori_id);
        $('#editStok').val(data.stok);
        $('#editModal').modal('show');
    });
}

// Update Alat
$('#editForm').on('submit', function(e) {
    e.preventDefault();
    const id = $('#editId').val();
    const formData = new FormData(this);

    $.ajax({
        url: `{{ url('alats') }}/${id}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#editModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Alat berhasil diupdate',
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
                text: 'Terjadi kesalahan saat mengupdate alat'
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
