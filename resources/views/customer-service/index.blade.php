@extends('layouts.app')

@section('title', 'Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <h2 class="mb-0">
                        <i class="fas fa-headset fa-2x me-3"></i>
                        Customer Service Smulz.Lab
                    </h2>
                    <p class="mb-0 mt-2">Pilih kategori masalah yang Anda hadapi untuk mendapatkan solusi cepat</p>
                </div>
                <div class="card-body p-5">
                    <div class="row g-4">
                        <!-- Cara Pemesanan -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Cara Peminjaman</h5>
                                    <p class="card-text text-muted">Panduan lengkap cara meminjam alat laboratorium</p>
                                    <a href="{{ route('customer-service.cara-pemesanan') }}" class="btn btn-primary btn-lg rounded-pill w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Solusi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Masalah Pembayaran -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-credit-card fa-3x text-success"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Masalah Pembayaran</h5>
                                    <p class="card-text text-muted">Solusi untuk masalah pembayaran dan transaksi saat dikenakan denda</p>
                                    <a href="{{ route('customer-service.masalah-pembayaran') }}" class="btn btn-success btn-lg rounded-pill w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Solusi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pengembalian Alat -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-undo fa-3x text-warning"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Pengembalian Alat</h5>
                                    <p class="card-text text-muted">Panduan pengembalian alat dan prosedur</p>
                                    <a href="{{ route('customer-service.pengembalian-alat') }}" class="btn btn-warning btn-lg rounded-pill w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Solusi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Masalah Teknis -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-cogs fa-3x text-info"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Masalah Teknis</h5>
                                    <p class="card-text text-muted">Solusi untuk error sistem dan masalah teknis</p>
                                    <a href="{{ route('customer-service.masalah-teknis') }}" class="btn btn-info btn-lg rounded-pill w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Solusi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Lainnya -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-question-circle fa-3x text-secondary"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Lainnya</h5>
                                    <p class="card-text text-muted">Pertanyaan umum dan informasi tambahan</p>
                                    <a href="{{ route('customer-service.lainnya') }}" class="btn btn-secondary btn-lg rounded-pill w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Solusi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 bg-light rounded-4">
                                <div class="card-body text-center p-4">
                                    <h4 class="mb-3">
                                        <i class="fas fa-phone-alt text-primary me-2"></i>
                                        Butuh Bantuan Lebih Lanjut?
                                    </h4>
                                    <p class="mb-3">Jika masalah Anda tidak terselesaikan, hubungi tim support kami</p>
                                    <div class="row justify-content-center">
                                        <div class="col-md-4">
                                            <div class="contact-item">
                                                <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                                <p class="mb-0">Tsumulz.Lab@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="contact-item">
                                                <i class="fas fa-phone fa-2x text-success mb-2"></i>
                                                <p class="mb-0">+62 821-2993-9458</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="contact-item">
                                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                                <p class="mb-0">Senin - Jumat<br>07:00 - 20:00 WIB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<style>
.hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.icon-wrapper {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    border-radius: 50%;
    width: 80px;
    margin: 0 auto;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.contact-item {
    padding: 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin: 10px 0;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: scale(1.05);
}
</style>
@endsection
