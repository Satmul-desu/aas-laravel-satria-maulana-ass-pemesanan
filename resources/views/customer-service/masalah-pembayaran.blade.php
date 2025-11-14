@extends('layouts.app')

@section('title', 'Masalah Pembayaran - Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-success text-white py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('customer-service.index') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h3 class="mb-0">
                            <i class="fas fa-credit-card me-3"></i>
                            Masalah Pembayaran
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="solution-content">
                                <h4 class="text-success mb-4">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Metode Pembayaran yang Didukung:
                                </h4>

                                <div class="payment-methods">
                                    <div class="payment-item">
                                        <div class="payment-icon">
                                            <i class="fas fa-university fa-2x text-primary"></i>
                                        </div>
                                        <div class="payment-content">
                                            <h5>Transfer Bank</h5>
                                            <p>Transfer ke rekening resmi Smulz.Lab</p>
                                            <small class="text-muted">BCA: 1234567890 a.n Smulz.Lab</small>
                                        </div>
                                    </div>

                                    <div class="payment-item">
                                        <div class="payment-icon">
                                            <i class="fas fa-mobile-alt fa-2x text-success"></i>
                                        </div>
                                        <div class="payment-content">
                                            <h5>E-Wallet</h5>
                                            <p>Gopay, OVO, Dana, LinkAja</p>
                                            <small class="text-muted">Kirim ke nomor admin yang tertera</small>
                                        </div>
                                    </div>

                                    <div class="payment-item">
                                        <div class="payment-icon">
                                            <i class="fas fa-cash-register fa-2x text-warning"></i>
                                        </div>
                                        <div class="payment-content">
                                            <h5>Tunai</h5>
                                            <p>Pembayaran langsung di lokasi</p>
                                            <small class="text-muted">Saat pengambilan alat</small>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-success mb-4 mt-5">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Masalah Umum & Solusi:
                                </h4>

                                <div class="issues-list">
                                    <div class="issue-item">
                                        <h5>Transfer Sudah Dilakukan tapi Belum Dikonfirmasi</h5>
                                        <p><strong>Solusi:</strong> Kirim bukti transfer ke email support@smulzlab.com atau WhatsApp admin dengan menyertakan kode peminjaman.</p>
                                    </div>

                                    <div class="issue-item">
                                        <h5>Pembayaran Ditolak Sistem</h5>
                                        <p><strong>Solusi:</strong> Pastikan jumlah transfer sesuai dengan nominal yang tertera. Jika masih bermasalah, hubungi admin untuk verifikasi manual.</p>
                                    </div>

                                    <div class="issue-item">
                                        <h5>Lupa Nomor Rekening Tujuan</h5>
                                        <p><strong>Solusi:</strong> Cek kembali email konfirmasi peminjaman atau hubungi admin untuk mendapatkan informasi rekening.</p>
                                    </div>

                                    <div class="issue-item">
                                        <h5>Pembayaran Double/Terlalu Banyak</h5>
                                        <p><strong>Solusi:</strong> Segera hubungi admin untuk proses refund. Lampirkan bukti transfer asli.</p>
                                    </div>

                                    <div class="issue-item">
                                        <h5>E-Wallet Tidak Menerima Pembayaran</h5>
                                        <p><strong>Solusi:</strong> Coba metode pembayaran lain atau transfer bank. Pastikan saldo mencukupi.</p>
                                    </div>
                                </div>

                                <div class="alert alert-success mt-4">
                                    <h5><i class="fas fa-clock me-2"></i>Waktu Konfirmasi:</h5>
                                    <ul class="mb-0">
                                        <li>Transfer Bank: 1-2 jam kerja</li>
                                        <li>E-Wallet: Maksimal 30 menit</li>
                                        <li>Tunai: Instant saat pengambilan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <h5 class="text-success mb-3">
                                            <i class="fas fa-phone-alt me-2"></i>
                                            Butuh Bantuan Segera?
                                        </h5>
                                        <p class="mb-3">Untuk masalah pembayaran urgent, hubungi admin langsung.</p>
                                        <div class="contact-info">
                                            <p class="mb-1"><i class="fab fa-whatsapp text-success me-2"></i>WA: +62 812-3456-7890</p>
                                            <p class="mb-0"><i class="fas fa-envelope text-primary me-2"></i>support@smulzlab.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 bg-warning text-white rounded-3">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-receipt fa-3x mb-3"></i>
                                        <h5>Simpan Bukti Bayar</h5>
                                        <p class="mb-0">Selalu simpan bukti pembayaran untuk referensi!</p>
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
.payment-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 15px;
    margin-bottom: 20px;
    border-left: 5px solid #28a745;
    transition: all 0.3s ease;
}

.payment-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.payment-icon {
    margin-right: 20px;
    flex-shrink: 0;
}

.payment-content h5 {
    margin-bottom: 5px;
    color: #333;
}

.payment-content p {
    margin-bottom: 5px;
    color: #666;
}

.issues-list {
    margin-top: 20px;
}

.issue-item {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 15px;
}

.issue-item h5 {
    color: #856404;
    margin-bottom: 10px;
}

.issue-item p {
    color: #856404;
    margin: 0;
}

.alert-success {
    border: none;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(34, 197, 94, 0.1));
    color: #155724;
}

.sidebar-help .card {
    transition: all 0.3s ease;
}

.sidebar-help .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-info p {
    font-weight: 500;
}
</style>
@endsection
