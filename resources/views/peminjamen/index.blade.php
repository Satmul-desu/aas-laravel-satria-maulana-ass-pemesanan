@extends('layouts.app')

@section('title', 'Kelola Peminjaman Alat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-hand-holding"></i> Kelola Peminjaman Alat</h4>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> Tambah Peminjaman
                    </button>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari peminjaman...">
                        </div>
                        <div class="col-md-6">
                            <select id="statusFilter" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="sedang">Sedang Dipinjam</option>
                                <option value="terlambat">Terlambat</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="peminjamenTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pinjam</th>
                                    <th>User</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Alat Dipinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamen as $index => $peminjaman)
                                <tr>
                                    <td>{{ $peminjamen->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $peminjaman->kode_pinjam }}</span>
                                    </td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                    <td>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($peminjaman->details as $detail)
                                            <small class="d-block">{{ $detail->alat->nama_alat }} ({{ $detail->jumlah }})</small>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($peminjaman->tanggal_kembali < now())
                                            <span class="badge bg-danger">Terlambat</span>
                                        @elseif($peminjaman->tanggal_pinjam <= now() && $peminjaman->tanggal_kembali >= now())
                                            <span class="badge bg-warning">Sedang Dipinjam</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info me-1" onclick="viewPeminjaman({{ $peminjaman->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="editPeminjaman({{ $peminjaman->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deletePeminjaman({{ $peminjaman->id }}, '{{ $peminjaman->kode_pinjam }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-hand-holding fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data peminjaman</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $peminjamen->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Tambah Peminjaman Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="createForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">User</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">Pilih User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Pinjam</label>
                                <input type="text" name="kode_pinjam" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alat yang Dipinjam</label>
                        <div id="alatContainer">
                            <div class="row alat-row mb-2">
                                <div class="col-md-7">
                                    <select name="alats[0][id]" class="form-select alat-select" required>
                                        <option value="">Pilih Alat</option>
                                        @foreach($alats as $alat)
                                            <option value="{{ $alat->id }}" data-stok="{{ $alat->stok }}">{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="alats[0][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-alat" style="display: none;">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addAlat">
                            <i class="fas fa-plus"></i> Tambah Alat
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title"><i class="fas fa-eye"></i> Detail Peminjaman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Peminjaman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">User</label>
                                <select id="editUserId" name="user_id" class="form-select" required>
                                    <option value="">Pilih User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Pinjam</label>
                                <input type="text" id="editKodePinjam" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="date" id="editTanggalPinjam" name="tanggal_pinjam" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input type="date" id="editTanggalKembali" name="tanggal_kembali" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alat yang Dipinjam</label>
                        <div id="editAlatContainer">
                            <!-- Edit alat rows will be loaded here -->
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="editAddAlat">
                            <i class="fas fa-plus"></i> Tambah Alat
                        </button>
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
    let alatIndex = 1;

    // Generate kode pinjam
    function generateKodePinjam() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        return `PJM-${year}${month}-${random}`;
    }

    $('input[name="tanggal_pinjam"]').on('change', function() {
        const kode = generateKodePinjam();
        $('input[name="kode_pinjam"]').val(kode);
    });

    // Add alat row
    $('#addAlat').on('click', function() {
        const rowHtml = `
            <div class="row alat-row mb-2">
                <div class="col-md-7">
                    <select name="alats[${alatIndex}][id]" class="form-select alat-select" required>
                        <option value="">Pilih Alat</option>
                        @foreach($alats as $alat)
                            <option value="{{ $alat->id }}" data-stok="{{ $alat->stok }}">{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="alats[${alatIndex}][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-alat">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        `;
        $('#alatContainer').append(rowHtml);
        alatIndex++;
        updateRemoveButtons();
    });

    // Remove alat row
    $(document).on('click', '.remove-alat', function() {
        $(this).closest('.alat-row').remove();
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        const rows = $('.alat-row');
        if (rows.length === 1) {
            $('.remove-alat').hide();
        } else {
            $('.remove-alat').show();
        }
    }

    // Create Peminjaman
    $('#createForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("peminjamen.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#createModal').modal('hide');
                $('#createForm')[0].reset();
                $('#alatContainer').html(`
                    <div class="row alat-row mb-2">
                        <div class="col-md-7">
                            <select name="alats[0][id]" class="form-select alat-select" required>
                                <option value="">Pilih Alat</option>
                                @foreach($alats as $alat)
                                    <option value="{{ $alat->id }}" data-stok="{{ $alat->stok }}">{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="alats[0][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-alat" style="display: none;">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                `);
                alatIndex = 1;
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Peminjaman berhasil ditambahkan',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                let errorMessage = 'Terjadi kesalahan saat menambah peminjaman';
                if (response && response.errors) {
                    const errors = Object.values(response.errors).flat();
                    errorMessage = errors.join('<br>');
                } else if (response && response.message) {
                    errorMessage = response.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: errorMessage
                });
            }
        });
    });

    // Search functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#peminjamenTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Filter by status
    $('#statusFilter').on('change', function() {
        const status = $(this).val();
        if (status === '') {
            $('#peminjamenTable tbody tr').show();
        } else {
            $('#peminjamenTable tbody tr').each(function() {
                const statusBadge = $(this).find('td:eq(6) .badge').text().toLowerCase();
                $(this).toggle(statusBadge.includes(status));
            });
        }
    });
});

// View Peminjaman
function viewPeminjaman(id) {
    $.get(`{{ url('peminjamen') }}/${id}`, function(data) {
        let content = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Kode Pinjam: <span class="badge bg-info">${data.kode_pinjam}</span></h6>
                    <h6>User: ${data.user.name}</h6>
                    <h6>Tanggal Pinjam: ${new Date(data.tanggal_pinjam).toLocaleDateString('id-ID')}</h6>
                    <h6>Tanggal Kembali: ${new Date(data.tanggal_kembali).toLocaleDateString('id-ID')}</h6>
                </div>
                <div class="col-md-6">
                    <h6>Status:
                        ${new Date(data.tanggal_kembali) < new Date() ? '<span class="badge bg-danger">Terlambat</span>' :
                          new Date(data.tanggal_pinjam) <= new Date() && new Date(data.tanggal_kembali) >= new Date() ? '<span class="badge bg-warning">Sedang Dipinjam</span>' :
                          '<span class="badge bg-success">Selesai</span>'}
                    </h6>
                </div>
            </div>
            <hr>
            <h6>Alat yang Dipinjam:</h6>
            <ul class="list-group">
        `;

        data.details.forEach(detail => {
            content += `<li class="list-group-item d-flex justify-content-between align-items-center">
                ${detail.alat.nama_alat}
                <span class="badge bg-primary rounded-pill">${detail.jumlah}</span>
            </li>`;
        });

        content += '</ul>';
        $('#viewContent').html(content);
        $('#viewModal').modal('show');
    }).fail(function(xhr) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat detail peminjaman'
        });
    });
}

// Edit Peminjaman
function editPeminjaman(id) {
    $.get(`{{ url('peminjamen') }}/${id}`, function(data) {
        $('#editId').val(data.id);
        $('#editUserId').val(data.user_id);
        $('#editKodePinjam').val(data.kode_pinjam);
        $('#editTanggalPinjam').val(data.tanggal_pinjam);
        $('#editTanggalKembali').val(data.tanggal_kembali);

        let alatHtml = '';
        data.details.forEach((detail, index) => {
            alatHtml += `
                <div class="row alat-row mb-2">
                    <div class="col-md-7">
                        <select name="alats[${index}][id]" class="form-select alat-select" required>
                            <option value="">Pilih Alat</option>
                            @foreach($alats as $alat)
                                <option value="{{ $alat->id }}" data-stok="{{ $alat->stok }}" ${detail.alat_id == $alat->id ? 'selected' : ''}>{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="alats[${index}][jumlah]" class="form-control jumlah-input" value="${detail.jumlah}" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-alat">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        $('#editAlatContainer').html(alatHtml);
        $('#editModal').modal('show');
    }).fail(function(xhr) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat data edit peminjaman'
        });
    });
}

// Delete Peminjaman
function deletePeminjaman(id, kode) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Hapus peminjaman "${kode}"? Stok alat akan dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('peminjamen') }}/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Peminjaman berhasil dihapus',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errortolol',
                        text: 'Terjadi kesalahan saat menghapus peminjaman'
                    });
                }
            });
        }
    });
}
</script>
@endsection
