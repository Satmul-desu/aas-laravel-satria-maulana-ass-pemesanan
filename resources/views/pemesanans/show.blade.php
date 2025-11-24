@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-info text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1"><i class="fas fa-eye me-2"></i>Detail Pemesanan</h3>
                            <p class="mb-0 opacity-75">Kode: {{ $pemesanan->kode_transaksi }}</p>
                        </div>
                        <div>
                            <a href="{{ route('pemesanans.edit', $pemesanan->id) }}" class="btn btn-warning btn-lg shadow-sm me-2">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('pemesanans.index') }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Status Badge -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center">
                                @if($pemesanan->status == 'pending')
                                    <span class="badge bg-warning fs-6 px-4 py-2">Pending</span>
                                @elseif($pemesanan->status == 'confirmed')
                                    <span class="badge bg-info fs-6 px-4 py-2">Confirmed</span>
                                @elseif($pemesanan->status == 'completed')
                                    <span class="badge bg-success fs-6 px-4 py-2">Completed</span>
                                @else
                                    <span class="badge bg-danger fs-6 px-4 py-2">Cancelled</span>
                                @endif
                            </div>
                        </div>
                    </div>

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
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Kode Transaksi</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->kode_transaksi }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Tanggal Pemesanan</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->tanggal_pemesanan->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Nama Pemesan</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->nama_pemesan }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Email</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Telepon</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->telepon }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Jenis Layanan</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->jenis_layanan }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Alamat</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->alamat }}</p>
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
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Harga</label>
                                                <p class="mb-0 fs-4 text-success">Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Total</label>
                                                <p class="mb-0 fs-4 text-primary fw-bold">Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Deskripsi</label>
                                                <p class="mb-0 fs-5">{{ $pemesanan->deskripsi }}</p>
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
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('pemesanans.edit', $pemesanan->id) }}" class="btn btn-warning btn-lg px-5">
                                    <i class="fas fa-edit me-2"></i>Edit Pemesanan
                                </a>
                                <button class="btn btn-danger btn-lg px-5" onclick="deletePemesanan({{ $pemesanan->id }}, '{{ $pemesanan->kode_transaksi }}')">
                                    <i class="fas fa-trash me-2"></i>Hapus Pemesanan
                                </button>
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
// Delete Pemesanan
function deletePemesanan(id, kode) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Hapus pemesanan "${kode}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('pemesanans') }}/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Pemesanan berhasil dihapus',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route("pemesanans.index") }}';
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus pemesanan'
                    });
                }
            });
        }
    });
}
</script>
@endsection
