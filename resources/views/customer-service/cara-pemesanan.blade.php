@extends('layouts.app')

@section('title', 'Cara Pemesanan - Customer Service')

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
                            <i class="fas fa-shopping-cart me-3"></i>
                            Cara Pemesanan Alat Laboratorium
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="solution-content">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-list-check me-2"></i>
                                    Langkah-langkah Pemesanan:
                                </h4>

                                <div class="steps-container">
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <div class="step-content">
                                            <h5>Login ke Sistem</h5>
                                            <p>Masuk ke akun Anda di dashboard Smulz.Lab menggunakan username dan password yang telah terdaftar.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <div class="step-content">
                                            <h5>Pilih Kategori Alat</h5>
                                            <p>Klik menu "Kategori Alat" untuk melihat berbagai kategori alat yang tersedia.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">3</div>
                                        <div class="step-content">
                                            <h5>Pilih Alat yang Diinginkan</h5>
                                            <p>Browse alat dalam kategori yang dipilih dan klik "Detail" untuk melihat spesifikasi lengkap.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">4</div>
                                        <div class="step-content">
                                            <h5>Ajukan Peminjaman</h5>
                                            <p>Klik tombol "Pinjam" dan isi form peminjaman dengan tanggal pinjam dan kembali yang diinginkan.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">5</div>
                                        <div class="step-content">
                                            <h5>Konfirmasi dan Pembayaran</h5>
                                            <p>Tunggu konfirmasi dari admin dan lakukan pembayaran sesuai instruksi yang diberikan.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">6</div>
                                        <div class="step-content">
                                            <h5>Ambil Alat</h5>
                                            <p>Setelah pembayaran dikonfirmasi, ambil alat di lokasi yang telah ditentukan.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-4">
                                    <h5><i class="fas fa-info-circle me-2"></i>Tips Penting:</h5>
                                    <ul class="mb-0">
                                        <li>Pastikan tanggal peminjaman dan pengembalian sesuai dengan jadwal Anda</li>
                                        <li>Periksa ketersediaan stok alat sebelum mengajukan peminjaman</li>
                                        <li>Simpan bukti peminjaman untuk referensi</li>
                                        <li>Hubungi admin jika ada perubahan jadwal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-question-circle me-2"></i>
                                            Masih Butuh Bantuan?
                                        </h5>
                                        <p class="mb-3">Jika Anda masih mengalami kesulitan, coba kategori lain atau hubungi support.</p>
                                        <a href="{{ route('customer-service.index') }}" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-list me-2"></i>Lihat Kategori Lain
                                        </a>
                                    </div>
                                </div>

                                <div class="card border-0 bg-success text-white rounded-3">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                                        <h5>Solusi Ditemukan?</h5>
                                        <p class="mb-0">Kami senang bisa membantu Anda!</p>
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
.step-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 15px;
    border-left: 5px solid #667eea;
    transition: all 0.3s ease;
}

.step-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 20px;
    flex-shrink: 0;
}

.step-content h5 {
    color: #333;
    margin-bottom: 10px;
}

.step-content p {
    color: #666;
    margin: 0;
}

.solution-content h4 {
    border-bottom: 3px solid #667eea;
    padding-bottom: 10px;
}

.alert-info {
    border: none;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    color: #333;
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
