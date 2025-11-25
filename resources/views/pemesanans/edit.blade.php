@extends('layouts.app')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pemesanan</h3>
                        <a href="{{ route('pemesanans.show', $pemesanan->id) }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('pemesanans.update', $pemesanan->id) }}" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="pelanggan_id" class="form-label">Pelanggan <span class="text-danger">*</span></label>
                                <select id="pelanggan_id" name="pelanggan_id" class="form-select @error('pelanggan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id') ?? $pemesanan->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                                            {{ $pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pelanggan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan <span class="text-danger">*</span></label>
                                <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" class="form-control @error('tanggal_pemesanan') is-invalid @enderror" value="{{ old('tanggal_pemesanan', $pemesanan->tanggal_pemesanan->format('Y-m-d')) }}" required>
                                @error('tanggal_pemesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $pemesanan->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_layanan" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                            <select id="jenis_layanan" name="jenis_layanan" class="form-select @error('jenis_layanan') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Layanan</option>
                                <option value="reguler" {{ (old('jenis_layanan', $pemesanan->jenis_layanan) == 'reguler') ? 'selected' : '' }}>Reguler</option>
                                <option value="expres" {{ (old('jenis_layanan', $pemesanan->jenis_layanan) == 'expres') ? 'selected' : '' }}>Expres</option>
                                <option value="premium" {{ (old('jenis_layanan', $pemesanan->jenis_layanan) == 'premium') ? 'selected' : '' }}>Premium</option>
                                <option value="vip" {{ (old('jenis_layanan', $pemesanan->jenis_layanan) == 'vip') ? 'selected' : '' }}>VIP</option>
                                <option value="vvip" {{ (old('jenis_layanan', $pemesanan->jenis_layanan) == 'vvip') ? 'selected' : '' }}>VVIP</option>
                            </select>
                            @error('jenis_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" min="0" step="0.01" value="{{ old('harga', $pemesanan->harga) }}" readonly required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pilih Alat dan Jumlah</label>
                            <table class="table table-bordered" id="alat-table">
                                <thead>
                                    <tr>
                                        <th>Alat</th>
                                        <th>Harga Satuan (Rp)</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Alat::all() as $alat)
                                    @php
                                        $pemesananDetail = $pemesanan->alat->firstWhere('id', $alat->id);
                                        $jumlahSelected = $pemesananDetail ? $pemesananDetail->pivot->jumlah : 0;
                                        $checked = $jumlahSelected > 0 ? 'checked' : '';
                                        $jumlahValue = old('jumlah.' . $loop->index, $jumlahSelected);
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="alat-checkbox" id="alat_{{ $alat->id }}" name="alat_id[]" value="{{ $alat->id }}" {{ $checked }}>
                                            <label for="alat_{{ $alat->id }}">{{ $alat->nama_alat }}</label>
                                        </td>
                                        <td class="harga-satuan" data-harga="{{ $alat->harga }}">{{ number_format($alat->harga, 2, ',', '.') }}</td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control jumlah-input" min="1" value="{{ $jumlahValue }}" {{ $checked ? '' : 'disabled' }} placeholder="Masukkan jumlah alat yang dipesan">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="text-muted">Jumlah alat yang dipesan, bukan jumlah stok</small>
                            @error('alat_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('jumlah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const checkboxes = document.querySelectorAll('.alat-checkbox');
                                const jumlahInputs = document.querySelectorAll('.jumlah-input');
                                const hargaInput = document.getElementById('harga');

                                function calculateTotal() {
                                    let total = 0;
                                    checkboxes.forEach((checkbox, index) => {
                                        if (checkbox.checked) {
                                            const hargaSatuan = parseFloat(checkbox.closest('tr').querySelector('.harga-satuan').dataset.harga);
                                            const jumlahInput = jumlahInputs[index];
                                            let jumlah = parseInt(jumlahInput.value) || 0;

                                            if (jumlah < 1) {
                                                jumlahInput.value = 1;
                                                jumlah = 1;
                                            }

                                            total += hargaSatuan * jumlah;
                                        }
                                    });
                                    hargaInput.value = total.toFixed(2);
                                }

                                checkboxes.forEach((checkbox, index) => {
                                    checkbox.addEventListener('change', function () {
                                        jumlahInputs[index].disabled = !this.checked;
                                        if (!this.checked) {
                                            jumlahInputs[index].value = 0;
                                        } else if (jumlahInputs[index].value < 1) {
                                            jumlahInputs[index].value = 1;
                                        }
                                        calculateTotal();
                                    });

                                    jumlahInputs[index].addEventListener('input', function () {
                                        if (this.value < 1) this.value = 1;
                                        calculateTotal();
                                    });
                                });

                                // Initial calculation on page load (to pick old values if any)
                                calculateTotal();
                            });
                        </script>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi', $pemesanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ (old('status', $pemesanan->status) == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ (old('status', $pemesanan->status) == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ (old('status', $pemesanan->status) == 'completed') ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ (old('status', $pemesanan->status) == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
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
                                <i class="fas fa-save me-2"></i>Update Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
