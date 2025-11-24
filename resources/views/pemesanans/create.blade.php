@extends('layouts.app')

@section('title', 'Tambah Pemesanan Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Tambah Pemesanan Baru</h3>
                            <p class="mb-0 opacity-75">Buat pemesanan baru dengan mudah</p>
                        </div>
                        <a href="{{ route('pemesanans.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form id="createForm" method="POST" action="{{ route('pemesanans.store') }}" novalidate>
                        @csrf

                        <!-- Informasi Dasar -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary bg-opacity-10 border-primary">
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar Pemesanan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="nama_pemesan" id="nama_pemesan"
                                                           class="form-control @error('nama_pemesan') is-invalid @enderror" placeholder="Nama Pemesan" required>
                                                    <label for="nama_pemesan">
                                                        <i class="fas fa-user me-1"></i>Nama Pemesan <span class="text-danger">*</span>
                                                    </label>
                                                    @error('nama_pemesan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="email" name="email" id="email"
                                                           class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                                                    <label for="email">
                                                        <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                                    </label>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="tel" name="telepon" id="telepon"
                                                           class="form-control @error('telepon') is-invalid @enderror" placeholder="Telepon" required>
                                                    <label for="telepon">
                                                        <i class="fas fa-phone me-1"></i>Telepon <span class="text-danger">*</span>
                                                    </label>
                                                    @error('telepon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan"
                                                           class="form-control @error('tanggal_pemesanan') is-invalid @enderror" value="{{ date('Y-m-d') }}" required>
                                                    <label for="tanggal_pemesanan">
                                                        <i class="fas fa-calendar-plus me-1"></i>Tanggal Pemesanan <span class="text-danger">*</span>
                                                    </label>
                                                    @error('tanggal_pemesanan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                                              placeholder="Alamat" style="height: 80px;" required>{{ old('alamat') }}</textarea>
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

                        <!-- Detail Pemesanan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-success shadow-sm">
                                    <div class="card-header bg-success bg-opacity-10 border-success">
                                        <h5 class="mb-0 text-success">
                                            <i class="fas fa-shopping-cart me-2"></i>Detail Pemesanan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="jenis_layanan" id="jenis_layanan" class="form-select @error('jenis_layanan') is-invalid @enderror" required>
                                                        <option value="">Pilih Jenis Layanan</option>
                                                        <option value="Konsultasi" {{ old('jenis_layanan') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                                        <option value="Service Alat" {{ old('jenis_layanan') == 'Service Alat' ? 'selected' : '' }}>Service Alat</option>
                                                        <option value="Kalibrasi" {{ old('jenis_layanan') == 'Kalibrasi' ? 'selected' : '' }}>Kalibrasi</option>
                                                        <option value="Pelatihan" {{ old('jenis_layanan') == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                                                        <option value="Lainnya" {{ old('jenis_layanan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                    </select>
                                                    <label for="jenis_layanan">
                                                        <i class="fas fa-cogs me-1"></i>Jenis Layanan <span class="text-danger">*</span>
                                                    </label>
                                                    @error('jenis_layanan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="harga" id="harga"
                                                           class="form-control @error('harga') is-invalid @enderror" placeholder="Harga" min="0" step="0.01" value="{{ old('harga') }}" required>
                                                    <label for="harga">
                                                        <i class="fas fa-money-bill-wave me-1"></i>Harga (Rp) <span class="text-danger">*</span>
                                                    </label>
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                              placeholder="Deskripsi" style="height: 100px;" required>{{ old('deskripsi') }}</textarea>
                                                    <label for="deskripsi">
                                                        <i class="fas fa-sticky-note me-1"></i>Deskripsi <span class="text-danger">*</span>
                                                    </label>
                                                    @error('deskripsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                        <i class="fas fa-save me-2"></i>Simpan Pemesanan
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

<!-- Summary Card -->
<div class="row justify-content-center mt-4">
    <div class="col-lg-8">
        <div class="card border-info shadow-sm">
            <div class="card-header bg-info bg-opacity-10 border-info">
                <h5 class="mb-0 text-info">
                    <i class="fas fa-calculator me-2"></i>Ringkasan Pemesanan
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="p-3">
                            <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                            <h4 id="totalHarga">Rp 0</h4>
                            <small class="text-muted">Total Harga</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3">
                            <i class="fas fa-calendar-day fa-2x text-primary mb-2"></i>
                            <h4 id="tanggalPesan">{{ date('d/m/Y') }}</h4>
                            <small class="text-muted">Tanggal Pemesanan</small>
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
    // Update summary when harga changes
    $('#harga').on('input', function() {
        updateSummary();
    });

    // Update summary when tanggal changes
    $('#tanggal_pemesanan').on('change', function() {
        updateSummary();
    });

    // Update summary
    function updateSummary() {
        const harga = parseFloat($('#harga').val()) || 0;
        const tanggal = $('#tanggal_pemesanan').val();

        $('#totalHarga').text('Rp ' + harga.toLocaleString('id-ID'));
        $('#tanggalPesan').text(tanggal ? new Date(tanggal).toLocaleDateString('id-ID') : '{{ date("d/m/Y") }}');
    }

    // Initialize summary on page load
    updateSummary();

    // Form validation
    $('#createForm').on('submit', function(e) {
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
});
</script>
@endsection
