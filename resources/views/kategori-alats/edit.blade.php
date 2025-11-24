@extends('layouts.app')

@section('title', 'Edit Kategori Alat')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-edit me-2"></i>Edit Kategori Alat</h3>
                            <p class="mb-0 opacity-75">Perbarui informasi kategori alat</p>
                        </div>
                        <a href="{{ route('kategori-alats.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('kategori-alats.update', $kategoriAlat->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Informasi Kategori -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-warning shadow-sm">
                                    <div class="card-header bg-warning bg-opacity-10 border-warning">
                                        <h5 class="mb-0 text-warning">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Kategori
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                                           id="nama_kategori" name="nama_kategori"
                                                           value="{{ old('nama_kategori', $kategoriAlat->nama_kategori) }}"
                                                           placeholder="Masukkan nama kategori" required>
                                                    <label for="nama_kategori">
                                                        <i class="fas fa-tag me-1"></i>Nama Kategori <span class="text-danger">*</span>
                                                    </label>
                                                    @error('nama_kategori')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kode_kategori"
                                                           value="{{ $kategoriAlat->id }}" readonly>
                                                    <label for="kode_kategori">
                                                        <i class="fas fa-hashtag me-1"></i>ID Kategori
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                              style="height: 100px" placeholder="Deskripsi kategori (opsional)">{{ old('deskripsi', $kategoriAlat->deskripsi ?? '') }}</textarea>
                                                    <label for="deskripsi">
                                                        <i class="fas fa-align-left me-1"></i>Deskripsi (Opsional)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Card -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-info shadow-sm">
                                    <div class="card-header bg-info bg-opacity-10 border-info">
                                        <h5 class="mb-0 text-info">
                                            <i class="fas fa-chart-bar me-2"></i>Statistik Kategori Saat Ini
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <div class="p-3">
                                                    <i class="fas fa-tools fa-2x text-primary mb-2"></i>
                                                    <h4>{{ $kategoriAlat->alats->count() }}</h4>
                                                    <small class="text-muted">Jumlah Alat</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="p-3">
                                                    <i class="fas fa-boxes fa-2x text-success mb-2"></i>
                                                    <h4>{{ $kategoriAlat->alats->sum('stok') }}</h4>
                                                    <small class="text-muted">Total Stok</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="p-3">
                                                    <i class="fas fa-calendar-plus fa-2x text-warning mb-2"></i>
                                                    <h4>{{ $kategoriAlat->created_at->format('d/m/Y') }}</h4>
                                                    <small class="text-muted">Dibuat Tanggal</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Card -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-success shadow-sm">
                                    <div class="card-header bg-success bg-opacity-10 border-success">
                                        <h5 class="mb-0 text-success">
                                            <i class="fas fa-eye me-2"></i>Pratinjau Perubahan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-tag fa-2x text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 id="preview-nama" class="mb-1">{{ $kategoriAlat->nama_kategori }}</h5>
                                                <p id="preview-deskripsi" class="text-muted mb-1">{{ $kategoriAlat->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                                <small class="text-muted">
                                                    <i class="fas fa-hashtag me-1"></i>ID: {{ $kategoriAlat->id }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-3">
                                    <button type="reset" class="btn btn-outline-secondary btn-lg px-4">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-warning btn-lg px-5">
                                        <i class="fas fa-save me-2"></i>Update Kategori
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Card -->
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card border-primary shadow-sm">
            <div class="card-header bg-primary bg-opacity-10 border-primary">
                <h5 class="mb-0 text-primary">
                    <i class="fas fa-history me-2"></i>Aktivitas Terkini
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-plus text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Kategori Dibuat</small>
                                <strong>{{ $kategoriAlat->created_at->format('d M Y, H:i') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-edit text-info"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Terakhir Diubah</small>
                                <strong>{{ $kategoriAlat->updated_at->format('d M Y, H:i') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Update preview when nama kategori changes
    $('#nama_kategori').on('input', function() {
        const nama = $(this).val().trim();
        $('#preview-nama').text(nama || 'Nama Kategori');
    });

    // Update preview when deskripsi changes
    $('#deskripsi').on('input', function() {
        const deskripsi = $(this).val().trim();
        $('#preview-deskripsi').text(deskripsi || 'Tidak ada deskripsi');
    });

    // Form validation
    $('form').on('submit', function(e) {
        const namaKategori = $('#nama_kategori').val().trim();

        if (!namaKategori) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Nama kategori harus diisi'
            });
            $('#nama_kategori').focus();
            return false;
        }

        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Initialize preview on page load
    $('#nama_kategori').trigger('input');
    $('#deskripsi').trigger('input');
});
</script>
@endsection
