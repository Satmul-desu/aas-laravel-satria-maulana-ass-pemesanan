@extends('layouts.app')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-edit me-2"></i>Edit Pemesanan</h3>
                            <p class="mb-0 opacity-75">Kode: {{ $pemesanan->kode_pesan ?? '-' }}</p>
                        </div>
                        <a href="{{ route('pemesanans.show', $pemesanan->id) }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form id="editForm" method="POST" action="{{ route('pemesanans.update', $pemesanan->id) }}" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Informasi Dasar -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-warning shadow-sm">
                                    <div class="card-header bg-warning bg-opacity-10 border-warning">
                                        <h5 class="mb-0 text-warning">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar Pemesanan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <select name="user_id" id="user_id" class="form-select" required>
                                                <option value="">Pilih User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $pemesanan->user_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="user_id">
                                                <i class="fas fa-user me-1"></i>User <span class="text-danger">*</span>
                                            </label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="date" name="tanggal_pesan" id="tanggal_pesan"
                                                   class="form-control" value="{{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('Y-m-d') }}" required>
                                            <label for="tanggal_pesan">
                                                <i class="fas fa-calendar-plus me-1"></i>Tanggal Pesan <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alat yang Dipesan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary bg-opacity-10 border-primary d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-tools me-2"></i>Alat yang Dipesan
                                        </h5>
                                        <button type="button" id="addAlatBtn" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus me-1"></i>Tambah Alat
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="editAlatContainer">
                                            @foreach($pemesanan->details as $index => $detail)
                                            <div class="alat-item card border-light shadow-sm mb-3">
                                                <div class="card-body">
                                                    <div class="row align-items-end">
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <select name="alats[{{ $index }}][id]" class="form-select alat-select" required>
                                                                    <option value="">Pilih Alat</option>
                                                                    @foreach($alats as $alat)
                                                                        <option value="{{ $alat->id }}" {{ $detail->alat_id == $alat->id ? 'selected' : '' }}
                                                                                data-stok="{{ $alat->stok }}">
                                                                            {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <label>
                                                                    <i class="fas fa-toolbox me-1"></i>Nama Alat <span class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <input type="number" name="alats[{{ $index }}][jumlah]" class="form-control jumlah-input"
                                                                       value="{{ $detail->jumlah }}" min="1" required>
                                                                <label>
                                                                    <i class="fas fa-hashtag me-1"></i>Jumlah <span class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-outline-danger btn-sm remove-alat w-100">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Empty state -->
                                        <div id="emptyState" class="text-center py-5" style="display: none;">
                                            <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada alat yang dipilih</h5>
                                            <p class="text-muted">Klik tombol "Tambah Alat" untuk memulai</p>
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
                                        <i class="fas fa-save me-2"></i>Update Pemesanan
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

<!-- Template for new alat row -->
<div id="alatTemplate" style="display: none;">
    <div class="alat-item card border-light shadow-sm mb-3">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="alats[{index}][id]" class="form-select alat-select" required>
                            <option value="">Pilih Alat</option>
                            @foreach($alats as $alat)
                                <option value="{{ $alat->id }}" data-stok="{{ $alat->stok }}">
                                    {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                                </option>
                            @endforeach
                        </select>
                        <label>
                            <i class="fas fa-toolbox me-1"></i>Nama Alat <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" name="alats[{index}][jumlah]" class="form-control jumlah-input"
                               placeholder="Jumlah" min="1" required>
                        <label>
                            <i class="fas fa-hashtag me-1"></i>Jumlah <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-alat w-100">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Card -->
<div class="row justify-content-center mt-4">
    <div class="col-lg-10">
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
                            <i class="fas fa-tools fa-2x text-primary mb-2"></i>
                            <h4 id="totalAlat">0</h4>
                            <small class="text-muted">Total Alat</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3">
                            <i class="fas fa-hashtag fa-2x text-success mb-2"></i>
                            <h4 id="totalJumlah">0</h4>
                            <small class="text-muted">Total Jumlah</small>
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
    let alatIndex = {{ count($pemesanan->details) }};

    // Add new alat row
    $('#addAlatBtn').click(function() {
        addAlatRow();
    });

    function addAlatRow() {
        const template = $('#alatTemplate').html().replace(/{index}/g, alatIndex);
        $('#editAlatContainer').append(template);
        $('#emptyState').hide();
        alatIndex++;
        updateSummary();
    }

    // Remove alat row
    $(document).on('click', '.remove-alat', function() {
        if ($('.alat-item').length > 1) {
            $(this).closest('.alat-item').remove();
            updateSummary();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Minimal harus ada 1 alat yang dipesan'
            });
        }
    });

    // Update when alat selected
    $(document).on('change', '.alat-select', function() {
        updateSummary();
    });

    // Update summary when jumlah changes
    $(document).on('input', '.jumlah-input', function() {
        updateSummary();
    });

    // Update summary
    function updateSummary() {
        const alatItems = $('.alat-item');
        let totalAlat = alatItems.length;
        let totalJumlah = 0;

        alatItems.each(function() {
            const jumlah = parseInt($(this).find('.jumlah-input').val()) || 0;
            totalJumlah += jumlah;
        });

        $('#totalAlat').text(totalAlat);
        $('#totalJumlah').text(totalJumlah);
    }

    // Initialize summary on page load
    updateSummary();

    // Form validation
    $('#editForm').submit(function(e) {
        let isValid = true;
        let errorMessage = '';

        // Check if at least one alat is selected
        if ($('.alat-item').length === 0) {
            isValid = false;
            errorMessage = 'Minimal harus ada 1 alat yang dipesan';
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error!',
                text: errorMessage
            });
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
});
</script>
@endsection
