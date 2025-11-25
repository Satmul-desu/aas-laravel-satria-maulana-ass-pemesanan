@extends('layouts.app')

@section('title', 'Ketentuan Pelanggan - Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('customer-service.index') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h3 class="mb-0">
                            <i class="fas fa-file-contract me-3"></i>
                            Ketentuan Pelanggan Smulz.Lab
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="terms-content">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    Ketentuan & Panduan Pengguna:
                                </h4>

                                <div class="terms-list">
                                    <div class="term-item">
                                        <div class="term-icon text-success">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                        <div class="term-content">
                                            <h5>Penggunaan Layanan</h5>
                                            <p>Pastikan Anda menggunakan layanan kami dengan itikad baik dan sesuai dengan ketentuan yang berlaku untuk menjaga kenyamanan bersama.</p>
                                        </div>
                                    </div>

                                    <div class="term-item">
                                        <div class="term-icon text-primary">
                                            <i class="fas fa-user-shield fa-2x"></i>
                                        </div>
                                        <div class="term-content">
                                            <h5>Perlindungan Data Pribadi</h5>
                                            <p>Data pribadi Anda kami kelola dengan serius dan hanya digunakan untuk keperluan layanan. Kerahasiaan dan keamanan data Anda adalah prioritas utama kami.</p>
                                        </div>
                                    </div>

                                    <div class="term-item">
                                        <div class="term-icon text-warning">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                        <div class="term-content">
                                            <h5>Kepatuhan Jadwal</h5>
                                            <p>Harap mematuhi jadwal peminjaman dan pengembalian alat agar pelayanan berjalan lancar dan semua pelanggan mendapat kesempatan yang adil.</p>
                                        </div>
                                    </div>

                                    <div class="term-item">
                                        <div class="term-icon text-danger">
                                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                                        </div>
                                        <div class="term-content">
                                            <h5>Dilarang Penyalahgunaan</h5>
                                            <p>Pelanggaran seperti merusak atau menyalahgunakan alat serta layanan dapat berakibat tindakan hukum dan pemblokiran akses layanan.</p>
                                        </div>
                                    </div>

                                    <div class="term-item">
                                        <div class="term-icon text-info">
                                            <i class="fas fa-headset fa-2x"></i>
                                        </div>
                                        <div class="term-content">
                                            <h5>Layanan Pelanggan</h5>
                                            <p>Tim customer service kami siap membantu pertanyaan dan kendala Anda dengan sigap dan profesional setiap saat.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-primary d-flex align-items-center mt-4" role="alert">
                                    <i class="fas fa-info-circle me-2 fs-3"></i>
                                    <div>
                                        Ketentuan ini dapat kami revisi sewaktu-waktu. Mohon kunjungi halaman ini secara berkala untuk selalu mendapatkan informasi terbaru.
                                    </div>
                                </div>

                                <p class="mt-4 mb-0">Terima kasih telah mempercayakan layanan Smulz.Lab. Bersama kita jaga kualitas dan kenyamanan layanan demi kepuasan bersama!</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4 shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Butuh Bantuan?
                                        </h5>
                                        <p class="mb-3">Jika Anda memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                                        <ul class="list-unstyled small mb-3">
                                            <li><i class="fas fa-phone-alt me-2"></i> 0821-2993-9458</li>
                                            <li><i class="fas fa-envelope me-2"></i> Tsumulz.Lab@gmail.com</li>
                                            <li><i class="fas fa-clock me-2"></i> Senin - Jumat, 08:00 - 17:00</li>
                                        </ul>
                                        <a href="{{ route('customer-service.index') }}" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-headset me-2"></i> Hubungi CS
                                        </a>
                                    </div>
                                </div>

                                <div class="card border-0 bg-primary text-white rounded-3 shadow-sm">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-shield-alt fa-3x mb-3"></i>
                                        <h5>Status Layanan</h5>
                                        <p class="mb-2">Status: <span class="badge bg-success">Online</span></p>
                                        <small>Uptime: 99.9%</small>
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
.terms-list {
    margin-top: 20px;
}

.term-item {
    display: flex;
    align-items: flex-start;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    border-left: 6px solid #0d6efd;
}

.term-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.term-icon {
    margin-right: 20px;
    flex-shrink: 0;
    padding: 15px;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.2));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.term-content h5 {
    color: #333;
    margin-bottom: 10px;
}

.term-content p {
    color: #555;
    margin-bottom: 0;
}

.alert-primary {
    border: none;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.2));
    color: #084298;
}

.sidebar-help .card {
    transition: all 0.3s ease;
}

.sidebar-help .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
