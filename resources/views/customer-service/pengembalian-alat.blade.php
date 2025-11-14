@extends('layouts.app')

@section('title', 'Pengembalian Alat - Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('customer-service.index') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h3 class="mb-0">
                            <i class="fas fa-undo me-3"></i>
                            Pengembalian Alat Laboratorium
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="solution-content">
                                <h4 class="text-warning mb-4">
                                    <i class="fas fa-list-check me-2"></i>
                                    Prosedur Pengembalian Alat:
                                </h4>

                                <div class="steps-container">
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <div class="step-content">
                                            <h5>Persiapkan Alat</h5>
                                            <p>Pastikan semua alat dalam kondisi baik dan bersih. Kemas dengan aman untuk transportasi.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <div class="step-content">
                                            <h5>Periksa Kondisi</h5>
                                            <p>Lakukan self-check terhadap kerusakan atau kehilangan. Laporkan jika ada masalah.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">3</div>
                                        <div class="step-content">
                                            <h5>Datang ke Lokasi</h5>
                                            <p>Kembalikan alat ke lokasi peminjaman sesuai jadwal yang telah ditentukan.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">4</div>
                                        <div class="step-content">
                                            <h5>Verifikasi Admin</h5>
                                            <p>Tunjukkan kode peminjaman dan tunggu verifikasi kondisi alat oleh admin.</p>
                                        </div>
                                    </div>

                                    <div class="step-item">
                                        <div class="step-number">5</div>
                                        <div class="step-content">
                                            <h5>Konfirmasi Pengembalian</h5>
                                            <p>Dapatkan tanda terima pengembalian sebagai bukti bahwa alat telah dikembalikan.</p>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-warning mb-4 mt-5">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Hal Penting yang Perlu Diperhatikan:
                                </h4>

                                <div class="important-notes">
                                    <div class="note-item">
                                        <i class="fas fa-clock text-warning me-3"></i>
                                        <div>
                                            <strong>Waktu Pengembalian:</strong> Harus tepat waktu sesuai jadwal. Keterlambatan akan dikenakan denda.
                                        </div>
                                    </div>

                                    <div class="note-item">
                                        <i class="fas fa-tools text-warning me-3"></i>
                                        <div>
                                            <strong>Kondisi Alat:</strong> Alat harus dikembalikan dalam kondisi sama seperti saat dipinjam.
                                        </div>
                                    </div>

                                    <div class="note-item">
                                        <i class="fas fa-box text-warning me-3"></i>
                                        <div>
                                            <strong>Kelengkapan:</strong> Pastikan semua komponen alat lengkap sesuai daftar inventaris.
                                        </div>
                                    </div>

                                    <div class="note-item">
                                        <i class="fas fa-file-alt text-warning me-3"></i>
                                        <div>
                                            <strong>Dokumentasi:</strong> Simpan bukti pengembalian untuk referensi di masa depan.
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-warning mt-4">
                                    <h5><i class="fas fa-info-circle me-2"></i>Denda Keterlambatan:</h5>
                                    <ul class="mb-0">
                                        <li>1-3 hari: Rp 10.000 per hari per alat</li>
                                        <li>4-7 hari: Rp 25.000 per hari per alat</li>
                                        <li>>7 hari: Denda maksimal + potensi blacklist</li>
                                    </ul>
                                </div>

                                <div class="alert alert-danger mt-3">
                                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Kerusakan atau Kehilangan:</h5>
                                    <p class="mb-0">Jika alat rusak atau hilang, akan dikenakan biaya penggantian sesuai nilai alat. Segera laporkan ke admin untuk penanganan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <h5 class="text-warning mb-3">
                                            <i class="fas fa-calendar-check me-2"></i>
                                            Pengingat Jadwal
                                        </h5>
                                        <p class="mb-3">Jangan lupa deadline pengembalian alat Anda!</p>
                                        <div class="reminder-box">
                                            <p class="mb-1"><strong>Lokasi Pengembalian:</strong></p>
                                            <p class="mb-0">Lab Smulz.Lab<br>Gedung Teknik<br>Jam: 08:00 - 16:00 WIB</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 bg-danger text-white rounded-3">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                        <h5>Perhatian!</h5>
                                        <p class="mb-0">Keterlambatan pengembalian akan dikenakan sanksi</p>
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
    border-left: 5px solid #ffc107;
    transition: all 0.3s ease;
}

.step-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #ffc107, #fd7e14);
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

.important-notes {
    margin-top: 20px;
}

.note-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    margin-bottom: 10px;
}

.note-item strong {
    color: #856404;
}

.alert-warning {
    border: none;
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 193, 7, 0.2));
    color: #856404;
}

.alert-danger {
    border: none;
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.2));
    color: #721c24;
}

.sidebar-help .card {
    transition: all 0.3s ease;
}

.sidebar-help .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.reminder-box {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
</style>
@endsection
