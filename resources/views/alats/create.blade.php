@extends('layouts.app')

@section('title', 'Tambah Alat Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Tambah Alat Baru</h3>
                            <p class="mb-0 opacity-75">Tambahkan alat baru ke dalam sistem inventaris</p>
                        </div>
                        <a href="{{ route('alats.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('alats.store') }}" method="POST" novalidate>
                        @csrf

                        <!-- Informasi Dasar Alat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary bg-opacity-10 border-primary">
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar Alat
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror"
                                                           id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}"
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
                                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
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
                                                           id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required>
                                                    <label for="stok">
                                                        <i class="fas fa-boxes me-1"></i>Stok Awal <span class="text-danger">*</span>
                                                    </label>
                                                    @error('stok')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kode_alat" readonly
                                                           placeholder="Kode otomatis">
                                                    <label for="kode_alat">
                                                        <i class="fas fa-hashtag me-1"></i>Kode Alat
                                                    </label>
                                                </div>
                                                <input type="hidden" name="kode_alat" id="kode_alat_hidden">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                              style="height: 100px" placeholder="Deskripsi alat (opsional)">{{ old('deskripsi') }}</textarea>
                                                    <label for="deskripsi">
                                                        <i class="fas fa-align-left me-1"></i>Deskripsi (Opsional)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                           id="harga" name="harga" value="{{ old('harga', 0) }}" min="0" step="0.01" required>
                                                    <label for="harga">
                                                        <i class="fas fa-dollar-sign me-1"></i>Harga <span class="text-danger">*</span>
                                                    </label>
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                        <option value="baru" {{ old('kondisi') == 'baru' ? 'selected' : '' }}>Baru</option>
                                                        <option value="bekas" {{ old('kondisi') == 'bekas' ? 'selected' : '' }}>Bekas</option>
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
                                                        <option value="berfungsi" {{ old('status_fungsi') == 'berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                                                        <option value="tidak_berfungsi" {{ old('status_fungsi') == 'tidak_berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
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
                                                        <option value="baik" {{ old('kualitas') == 'baik' ? 'selected' : '' }}>Baik</option>
                                                        <option value="buruk" {{ old('kualitas') == 'buruk' ? 'selected' : '' }}>Buruk</option>
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
                                                        <option value="layak" {{ old('layak') == 'layak' ? 'selected' : '' }}>Layak</option>
                                                        <option value="tidak_layak" {{ old('layak') == 'tidak_layak' ? 'selected' : '' }}>Tidak Layak</option>
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

                        <!-- Preview Card -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-success shadow-sm">
                                    <div class="card-header bg-success bg-opacity-10 border-success">
                                        <h5 class="mb-0 text-success">
                                            <i class="fas fa-eye me-2"></i>Pratinjau Alat
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-toolbox fa-2x text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 id="preview-nama" class="mb-1">Nama Alat</h5>
                                                <p id="preview-kategori" class="text-muted mb-1">Kategori: <span class="text-primary">Belum dipilih</span></p>
                                                <p id="preview-deskripsi" class="text-muted mb-1">Deskripsi alat akan muncul di sini</p>
                                                <div class="d-flex gap-3">
                                                    <small class="text-muted">
                                                        <i class="fas fa-hashtag me-1"></i><span id="preview-kode">Kode akan di-generate otomatis</span>
                                                    </small>
                                                    <small class="text-muted">
                                                        <i class="fas fa-boxes me-1"></i>Stok: <span id="preview-stok">0</span>
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
                                        <i class="fas fa-save me-2"></i>Simpan Alat
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
                            <i class="fas fa-tools fa-2x text-primary mb-2"></i>
                            <h4>{{ \App\Models\Alat::count() }}</h4>
                            <small class="text-muted">Total Alat</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-tags fa-2x text-info mb-2"></i>
                            <h4>{{ \App\Models\KategoriAlat::count() }}</h4>
                            <small class="text-muted">Total Kategori</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-boxes fa-2x text-success mb-2"></i>
                            <h4>{{ \App\Models\Alat::sum('stok') }}</h4>
                            <small class="text-muted">Total Stok</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <i class="fas fa-hand-holding fa-2x text-warning mb-2"></i>
                            <h4>{{ \App\Models\Peminjaman::where('tanggal_kembali', '>', now())->count() }}</h4>
                            <small class="text-muted">Sedang Dipinjam</small>
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
    // Generate kode alat
    function generateKodeAlat() {
        const nama = $('#nama_alat').val().trim();
        const kategoriId = $('#kategori_id').val();
        if (nama && kategoriId) {
            const words = nama.split(' ');
            const kode = words.map(word => word.charAt(0).toUpperCase()).join('').substring(0, 3);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            return `ALT-${kode}-${random}`;
        }
        return '';
    }

    // Update preview when nama alat changes
    $('#nama_alat').on('input', function() {
        const nama = $(this).val().trim();
        const kode = generateKodeAlat();

        $('#preview-nama').text(nama || 'Nama Alat');
        $('#preview-kode').text(kode || 'Kode akan di-generate otomatis');
        $('#kode_alat').val(kode);
        $('#kode_alat_hidden').val(kode);
    });

    // Update preview when kategori changes
    $('#kategori_id').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const kategoriNama = selectedOption.text().trim();
        const kode = generateKodeAlat();

        $('#preview-kategori').html(kategoriNama ? `Kategori: <span class="text-primary">${kategoriNama}</span>` : 'Kategori: <span class="text-primary">Belum dipilih</span>');
        $('#preview-kode').text(kode || 'Kode akan di-generate otomatis');
        $('#kode_alat').val(kode);
        $('#kode_alat_hidden').val(kode);
    });

    // Update preview when stok changes
    $('#stok').on('input', function() {
        const stok = $(this).val() || 0;
        $('#preview-stok').text(stok);
    });

    // Update preview when deskripsi changes
    $('#deskripsi').on('input', function() {
        const deskripsi = $(this).val().trim();
        $('#preview-deskripsi').text(deskripsi || 'Deskripsi alat akan muncul di sini');
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
