@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Buat Pemesanan Baru</h3>
                        <a href="{{ route('pemesanans.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('pemesanans.store') }}" novalidate>
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="pelanggan_id" class="form-label">Pelanggan <span class="text-danger">*</span></label>
                                <select id="pelanggan_id" name="pelanggan_id" class="form-select @error('pelanggan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                                            {{ $pelanggan->nama }} -- {{ $pelanggan->kode_pelanggan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pelanggan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan <span class="text-danger">*</span></label>
                                <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" class="form-control @error('tanggal_pemesanan') is-invalid @enderror" value="{{ old('tanggal_pemesanan') }}" required>
                                @error('tanggal_pemesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_layanan" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                            <select id="jenis_layanan" name="jenis_layanan" class="form-select @error('jenis_layanan') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Layanan</option>
                                <option value="reguler" {{ old('jenis_layanan') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                                <option value="expres" {{ old('jenis_layanan') == 'expres' ? 'selected' : '' }}>Expres</option>
                                <option value="premium" {{ old('jenis_layanan') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="vip" {{ old('jenis_layanan') == 'vip' ? 'selected' : '' }}>VIP</option>
                                <option value="vvip" {{ old('jenis_layanan') == 'vvip' ? 'selected' : '' }}>VVIP</option>
                            </select>
                            @error('jenis_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" min="0" step="0.01" value="{{ old('harga') }}" readonly required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                                        <div id="alatContainer">
                                        </div>

                                        <!-- Empty state -->
                                        <div id="emptyState" class="text-center py-5">
                                            <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada alat yang dipilih</h5>
                                            <p class="text-muted">Klik tombol "Tambah Alat" untuk memulai</p>
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

                        @error('alats')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-warning btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Simpan Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let alatIndex = 0;
    const alatContainer = $('#alatContainer');
    const emptyState = $('#emptyState');
    const totalAlatEl = $('#totalAlat');
    const totalJumlahEl = $('#totalJumlah');
    const hargaEl = $('#harga');

    // Get available alats from server
    let availableAlats = @json(\App\Models\Alat::all());

    function updateTotals() {
        let totalAlat = 0;
        let totalJumlah = 0;
        let totalHarga = 0;

        $('.alat-item').each(function() {
            const alatId = $(this).find('.alat-select').val();
            const jumlah = parseInt($(this).find('.jumlah-input').val()) || 0;

            if (alatId && jumlah > 0) {
                totalAlat++;
                totalJumlah += jumlah;

                const alat = availableAlats.find(a => a.id == alatId);
                if (alat) {
                    totalHarga += alat.harga * jumlah;
                }
            }
        });

        totalAlatEl.text(totalAlat);
        totalJumlahEl.text(totalJumlah);
        hargaEl.val(totalHarga.toFixed(2));
    }

    function addAlatItem() {
        const itemHtml = `
            <div class="alat-item border rounded p-3 mb-3 bg-light" data-index="${alatIndex}">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Alat</label>
                        <select class="form-select alat-select" name="alat_id[${alatIndex}]" required>
                            <option value="">Pilih Alat</option>
                            ${availableAlats.map(alat => `
                                <option value="${alat.id}" data-harga="${alat.harga}" data-stok="${alat.stok}">
                                    ${alat.nama_alat} (Stok: ${alat.stok}) - Rp ${alat.harga.toLocaleString()}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control jumlah-input" name="jumlah[${alatIndex}]" min="1" value="1" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-alat-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <small class="text-muted harga-satuan-info"></small>
                    </div>
                </div>
            </div>
        `;

        alatContainer.append(itemHtml);
        emptyState.hide();
        alatIndex++;
        updateTotals();
    }

    // Add alat button click
    $('#addAlatBtn').on('click', function() {
        addAlatItem();
    });

    // Remove alat button click
    $(document).on('click', '.remove-alat-btn', function() {
        $(this).closest('.alat-item').remove();
        if ($('.alat-item').length === 0) {
            emptyState.show();
        }
        updateTotals();
    });

    // Alat selection change
    $(document).on('change', '.alat-select', function() {
        const selectedOption = $(this).find('option:selected');
        const harga = selectedOption.data('harga');
        const stok = selectedOption.data('stok');
        const infoEl = $(this).closest('.alat-item').find('.harga-satuan-info');

        if (harga) {
            infoEl.text(`Harga satuan: Rp ${harga.toLocaleString()} | Stok tersedia: ${stok}`);
        } else {
            infoEl.text('');
        }

        updateTotals();
    });

    // Jumlah input change
    $(document).on('input', '.jumlah-input', function() {
        updateTotals();
    });

    // Form validation
    $('form').on('submit', function(e) {
        const alatItems = $('.alat-item');
        if (alatItems.length === 0) {
            e.preventDefault();
            alert('Harap tambahkan setidaknya satu alat ke dalam pemesanan.');
            return false;
        }

        let hasValidAlat = false;
        alatItems.each(function() {
            const alatId = $(this).find('.alat-select').val();
            const jumlah = parseInt($(this).find('.jumlah-input').val()) || 0;
            if (alatId && jumlah > 0) {
                hasValidAlat = true;
            }
        });

        if (!hasValidAlat) {
            e.preventDefault();
            alert('Harap pilih alat dan jumlah yang valid.');
            return false;
        }
    });
});
</script>
@endsection
