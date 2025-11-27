@extends('layouts.app')

@section('title', 'Tambah Pelanggan Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Tambah Pelanggan Baru</h3>
                            <p class="mb-0 opacity-75">Tambahkan pelanggan baru ke dalam sistem</p>
                        </div>
                        <a href="{{ route('pelanggans.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('pelanggans.store') }}" method="POST" novalidate>
                        @csrf

                        <!-- Informasi Dasar Pelanggan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary bg-opacity-10 border-primary">
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar Pelanggan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                           id="nama" name="nama" value="{{ old('nama') }}"
                                                           placeholder="Masukkan nama pelanggan" required>
                                                    <label for="nama">
                                                        <i class="fas fa-user me-1"></i>Nama Pelanggan <span class="text-danger">*</span>
                                                    </label>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" readonly
                                                           placeholder="Kode otomatis">
                                                    <label for="kode_pelanggan">
                                                        <i class="fas fa-hashtag me-1"></i>Kode Pelanggan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                           id="email" name="email" value="{{ old('email') }}"
                                                           placeholder="Masukkan email pelanggan" required>
                                                    <label for="email">
                                                        <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                                    </label>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                                           id="telepon" name="telepon" value="{{ old('telepon') }}"
                                                           placeholder="Masukkan nomor telepon" required>
                                                    <label for="telepon">
                                                        <i class="fas fa-phone me-1"></i>Telepon <span class="text-danger">*</span>
                                                    </label>
                                                    @error('telepon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                                                              id="alamat" name="alamat" style="height: 100px"
                                                              placeholder="Masukkan alamat lengkap pelanggan" required>{{ old('alamat') }}</textarea>
                                                    <label for="alamat">
                                                        <i class="fas fa-map-marker-alt me-1"></i>Alamat <span class="text-danger">*</span>
                                                    </label>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                            <i class="fas fa-eye me-2"></i>Pratinjau Pelanggan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user fa-2x text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 id="preview-nama" class="mb-1">Nama Pelanggan</h5>
                                                <p id="preview-email" class="text-muted mb-1">Email: <span class="text-primary">Belum diisi</span></p>
                                                <p id="preview-telepon" class="text-muted mb-1">Telepon: <span class="text-primary">Belum diisi</span></p>
                                                <p id="preview-alamat" class="text-muted mb-1">Alamat akan muncul di sini</p>
                                                <div class="d-flex gap-3">
                                                    <small class="text-muted">
                                                        <i class="fas fa-hashtag me-1"></i><span id="preview-kode">Kode akan di-generate otomatis</span>
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save me-2"></i>Simpan Pelanggan
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

<!-- Statistics Card -->
<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="card border-info shadow-sm">
            <div class="card-header bg-info bg-opacity-10 border-info">
                <h5 class="mb-0 text-info">
                    <i class="fas fa-chart-bar me-2"></i>Statistik Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                            <h4>{{ \App\Models\Pelanggan::count() }}</h4>
                            <small class="text-muted">Total Pelanggan</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-shopping-cart fa-2x text-info mb-2"></i>
                            <h4>{{ \App\Models\Pemesanan::count() }}</h4>
                            <small class="text-muted">Total Pemesanan</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-hand-holding fa-2x text-success mb-2"></i>
                            <h4>{{ \App\Models\Peminjaman::count() }}</h4>
                            <small class="text-muted">Total Peminjaman</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-tools fa-2x text-warning mb-2"></i>
                            <h4>{{ \App\Models\Alat::count() }}</h4>
                            <small class="text-muted">Total Alat</small>
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
    // Generate kode pelanggan
    function generateKodePelanggan() {
        const nama = $('#nama').val().trim();
        if (nama) {
            const words = nama.split(' ');
            const kode = words.map(word => word.charAt(0).toUpperCase()).join('').substring(0, 3);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            return `PLG-${kode}-${random}`;
        }
        return '';
    }

    // Update preview when nama changes
    $('#nama').on('input', function() {
        const nama = $(this).val().trim();
        const kode = generateKodePelanggan();

        $('#preview-nama').text(nama || 'Nama Pelanggan');
        $('#preview-kode').text(kode || 'Kode akan di-generate otomatis');
        $('#kode_pelanggan').val(kode);
    });

    // Update preview when email changes
    $('#email').on('input', function() {
        const email = $(this).val().trim();
        $('#preview-email').html(email ? `Email: <span class="text-primary">${email}</span>` : 'Email: <span class="text-primary">Belum diisi</span>');
    });

    // Update preview when telepon changes
    $('#telepon').on('input', function() {
        const telepon = $(this).val().trim();
        $('#preview-telepon').html(telepon ? `Telepon: <span class="text-primary">${telepon}</span>` : 'Telepon: <span class="text-primary">Belum diisi</span>');
    });

    // Update preview when alamat changes
    $('#alamat').on('input', function() {
        const alamat = $(this).val().trim();
        $('#preview-alamat').text(alamat || 'Alamat akan muncul di sini');
    });

    // Form validation
    $('form').on('submit', function(e) {
        const nama = $('#nama').val().trim();
        const email = $('#email').val().trim();
        const telepon = $('#telepon').val().trim();
        const alamat = $('#alamat').val().trim();

        if (!nama) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Nama pelanggan harus diisi'
            });
            $('#nama').focus();
            return false;
        }

        if (!email) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Email harus diisi'
            });
            $('#email').focus();
            return false;
        }

        if (!telepon) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Telepon harus diisi'
            });
            $('#telepon').focus();
            return false;
        }

        if (!alamat) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Error!',
                text: 'Alamat harus diisi'
            });
            $('#alamat').focus();
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
    $('#nama').trigger('input');
    $('#email').trigger('input');
    $('#telepon').trigger('input');
    $('#alamat').trigger('input');
});
</script>
@endsection
