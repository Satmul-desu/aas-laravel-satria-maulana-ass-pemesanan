@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-edit me-2"></i>Edit Alat</h3>
                            <p class="mb-0 opacity-75">Perbarui informasi alat yang ada</p>
                        </div>
                        <a href="{{ route('alats.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('alats.update', $alat->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Informasi Dasar Alat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-warning shadow-sm">
                                    <div class="card-header bg-warning bg-opacity-10 border-warning">
                                        <h5 class="mb-0 text-warning">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar Alat
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror"
                                                           id="nama_alat" name="nama_alat"
                                                           value="{{ old('nama_alat', $alat->nama_alat) }}"
                                                           placeholder="Masukkan nama alat" required>
                                                    <label for="nama_alat">
                                                        <i class="fas fa-toolbox me-1"></i>Nama Alat <span class="text-danger">*</span>
                                                    </label>
                                                    @error('nama_alat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select @error('kategori_id') is-invalid @enderror"
                                                            id="kategori_id" name="kategori_id" required>
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                                {{ $kategori->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="kategori_id">
                                                        <i class="fas fa-tag me-1"></i>Kategori <span class="text-danger">*</span>
                                                    </label>
                                                    @error('kategori_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                                           id="stok" name="stok" value="{{ old('stok', $alat->stok) }}" min="0" required>
                                                    <label for="stok">
                                                        <i class="fas fa-boxes me-1"></i>Stok <span class="text-danger">*</span>
                                                    </label>
                                                    @error('stok')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kode_alat"
                                                           value="{{ $alat->id }}" readonly>
                                                    <label for="kode_alat">
                                                        <i class="fas fa-hashtag me-1"></i>ID Alat
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                              style="height: 100px" placeholder="Deskripsi alat (opsional)">{{ old('deskripsi', $alat->deskripsi ?? '') }}</textarea>
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

                        <!-- Informasi Kualitas Alat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-warning shadow-sm">
                                    <div class="card-header bg-warning bg-opacity-10 border-warning">
                                        <h5 class="mb-0 text-warning">
                                            <i class="fas fa-star me-2"></i>Informasi Kualitas Alat
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select @error('kondisi') is-invalid @enderror"
                                                            id="kondisi" name="kondisi" required>
                                                        <option value="">Pilih Kondisi</option>
                                                        <option value="baru" {{ old('kondisi', $alat->kondisi ?? '') == 'baru' ? 'selected' : '' }}>Baru</option>
                                                        <option value="bekas" {{ old('kondisi', $alat->kondisi ?? '') == 'bekas' ? 'selected' : '' }}>Bekas</option>
                                                    </select>
                                                    <label for="kondisi">
                                                        <i class="fas fa-clock me-1"></i>Kondisi Alat <span class="text-danger">*</span>
                                                    </label>
                                                    @error('kondisi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select @error('status_fungsi') is-invalid @enderror"
                                                            id="status_fungsi" name="status_fungsi" required>
                                                        <option value="">Pilih Status Fungsi</option>
                                                        <option value="berfungsi" {{ old('status_fungsi', $alat->status_fungsi ?? '') == 'berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                                                        <option value="tidak_berfungsi" {{ old('status_fungsi', $alat->status_fungsi ?? '') == 'tidak_berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                                                    </select>
                                                    <label for="status_fungsi">
                                                        <i class="fas fa-cogs me-1"></i>Status Fungsi <span class="text-danger">*</span>
                                                    </label>
                                                    @error('status_fungsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select @error('kualitas') is-invalid @enderror"
                                                            id="kualitas" name="kualitas" required>
                                                        <option value="">Pilih Kualitas</option>
                                                        <option value="baik" {{ old('kualitas', $alat->kualitas ?? '') == 'baik' ? 'selected' : '' }}>Baik</option>
                                                        <option value="buruk" {{ old('kualitas', $alat->kualitas ?? '') == 'buruk' ? 'selected' : '' }}>Buruk</option>
                                                    </select>
                                                    <label for="kualitas">
                                                        <i class="fas fa-award me-1"></i>Kualitas <span class="text-danger">*</span>
                                                    </label>
                                                    @error('kualitas')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select @error('layak') is-invalid @enderror"
                                                            id="layak" name="layak" required>
                                                        <option value="">Pilih Status Layak</option>
                                                        <option value="layak" {{ old('layak', $alat->layak ?? '') == 'layak' ? 'selected' : '' }}>Layak</option>
                                                        <option value="tidak_layak" {{ old('layak', $alat->layak ?? '') == 'tidak_layak' ? 'selected' : '' }}>Tidak Layak</option>
                                                    </select>
                                                    <label for="layak">
                                                        <i class="fas fa-check-circle me-1"></i>Layak Pakai <span class="text-danger">*</span>
                                                    </label>
                                                    @error('layak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                            <i class="fas fa-chart-bar me-2"></i>Statistik Alat Saat Ini
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-3">
                                                <div class="p-3">
                                                    <i class="fas fa-boxes fa-2x text-primary mb-2"></i>
                                                    <h4>{{ $alat->stok }}</h4>
                                                    <small class="text-muted">Stok Tersedia</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3">
                                                    <i class="fas fa-hand-holding fa-2x text-warning mb-2"></i>
                                                    <h4>{{ $alat->peminjamanDetails()->whereHas('peminjaman', function($query) { $query->where('tanggal_kembali', '>', now()); })->sum('jumlah') }}</h4>
                                                    <small class="text-muted">Sedang Dipinjam</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3">
                                                    <i class="fas fa-history fa-2x text-success mb-2"></i>
                                                    <h4>{{ $alat->peminjamanDetails()->sum('jumlah') }}</h4>
                                                    <small class="text-muted">Total Peminjaman</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3">
                                                    <i class="fas fa-calendar-plus fa-2x text-info mb-2"></i>
                                                    <h4>{{ $alat->created_at->format('d/m/Y') }}</h4>
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
                                                    <i class="fas fa-toolbox fa-2x text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 id="preview-nama" class="mb-1">{{ $alat->nama_alat }}</h5>
                                                <p id="preview-kategori" class="text-muted mb-1">Kategori: <span class="text-primary">{{ $alat->kategori->nama_kategori }}</span></p>
                                                <p id="preview-deskripsi" class="text-muted mb-1">{{ $alat->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                                <div class="d-flex gap-3">
                                                    <small class="text-muted">
                                                        <i class="fas fa-hashtag me-1"></i>ID: {{ $alat->id }}
                                                    </small>
                                                    <small class="text-muted">
                                                        <i class="fas fa-boxes me-1"></i>Stok: <span id="preview-stok">{{ $alat->stok }}</span>
                                                    </small>
                                                </div>
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
                                        <i class="fas fa-save me-2"></i>Update Alat
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
    <div class="col-md-10">
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
                                <small class="text-muted d-block">Alat Dibuat</small>
                                <strong>{{ $alat->created_at->format('d M Y, H:i') }}</strong>
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
                                <strong>{{ $alat->updated_at->format('d M Y, H:i') }}</strong>
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
    // Update preview when nama alat changes
    $('#nama_alat').on('input', function() {
        const nama = $(this).val().trim();
        $('#preview-nama').text(nama || 'Nama Alat');
    });

    // Update preview when kategori changes
    $('#kategori_id').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const kategoriNama = selectedOption.text().trim();
        $('#preview-kategori').html(kategoriNama ? `Kategori: <span class="text-primary">${kategoriNama}</span>` : 'Kategori: <span class="text-primary">Belum dipilih</span>');
    });

    // Update preview when stok changes
    $('#stok').on('input', function() {
        const stok = $(this).val() || 0;
        $('#preview-stok').text(stok);
    });

    // Update preview when deskripsi changes
    $('#deskripsi').on('input', function() {
        const deskripsi = $(this).val().trim();
        $('#preview-deskripsi').text(deskripsi || 'Tidak ada deskripsi');
    });

    // Form validation
    $('form').on('submit', function(e) {
        const namaAlat = $('#nama_alat').val().trim();
        const kategoriId = $('#kategori_id').val();
        const stok = $('#stok').val();

        if (!namaAlat) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Nama alat harus diisi'
            });
            $('#nama_alat').focus();
            return false;
        }

        if (!kategoriId) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Kategori harus dipilih'
            });
            $('#kategori_id').focus();
            return false;
        }

        if (stok === '' || stok < 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Stok harus diisi dengan angka positif'
            });
            $('#stok').focus();
            return false;
        }

        const kondisi = $('#kondisi').val();
        const statusFungsi = $('#status_fungsi').val();
        const kualitas = $('#kualitas').val();
        const layak = $('#layak').val();

        if (!kondisi) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Kondisi alat harus dipilih'
            });
            $('#kondisi').focus();
            return false;
        }

        if (!statusFungsi) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Status fungsi harus dipilih'
            });
            $('#status_fungsi').focus();
            return false;
        }

        if (!kualitas) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Kualitas harus dipilih'
            });
            $('#kualitas').focus();
            return false;
        }

        if (!layak) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Status layak pakai harus dipilih'
            });
            $('#layak').focus();
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
    $('#nama_alat').trigger('input');
    $('#kategori_id').trigger('change');
    $('#stok').trigger('input');
    $('#deskripsi').trigger('input');
});
</script>
@endsection
