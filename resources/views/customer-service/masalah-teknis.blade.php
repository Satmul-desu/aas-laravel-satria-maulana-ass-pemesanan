@extends('layouts.app')

@section('title', 'Masalah Teknis - Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-info text-white py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('customer-service.index') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h3 class="mb-0">
                            <i class="fas fa-cogs me-3"></i>
                            Masalah Teknis Sistem
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="solution-content">
                                <h4 class="text-info mb-4">
                                    <i class="fas fa-tools me-2"></i>
                                    Masalah Umum & Solusi Teknis:
                                </h4>

                                <div class="issues-list">
                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-sign-in-alt fa-2x text-info"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Tidak Bisa Login</h5>
                                            <p><strong>Penyebab:</strong> Username/password salah, akun belum aktif, atau masalah koneksi.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Pastikan username dan password benar (case-sensitive)</li>
                                                <li>Reset password jika lupa</li>
                                                <li>Cek koneksi internet</li>
                                                <li>Clear cache browser</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-spinner fa-2x text-warning"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Halaman Loading Lambat</h5>
                                            <p><strong>Penyebab:</strong> Koneksi internet lambat atau server overload.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Periksa kecepatan internet</li>
                                                <li>Coba refresh halaman (Ctrl+F5)</li>
                                                <li>Coba akses di waktu berbeda</li>
                                                <li>Gunakan browser terbaru</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Error 404 / Halaman Tidak Ditemukan</h5>
                                            <p><strong>Penyebab:</strong> URL salah atau halaman dihapus.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Periksa URL yang diketik</li>
                                                <li>Gunakan navigasi menu</li>
                                                <li>Kembali ke dashboard dan navigasi ulang</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-upload fa-2x text-success"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Gagal Upload File</h5>
                                            <p><strong>Penyebab:</strong> File terlalu besar, format tidak didukung, atau koneksi terputus.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Periksa ukuran file (max 10MB)</li>
                                                <li>Pastikan format file didukung (PDF, JPG, PNG)</li>
                                                <li>Cek koneksi internet stabil</li>
                                                <li>Coba upload ulang</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-database fa-2x text-primary"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Data Tidak Tersimpan</h5>
                                            <p><strong>Penyebab:</strong> Error validasi atau masalah server.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Periksa semua field wajib terisi</li>
                                                <li>Pastikan format data benar</li>
                                                <li>Coba simpan lagi</li>
                                                <li>Laporkan jika terus berlanjut</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="issue-item">
                                        <div class="issue-icon">
                                            <i class="fas fa-mobile-alt fa-2x text-secondary"></i>
                                        </div>
                                        <div class="issue-content">
                                            <h5>Problem di Mobile Device</h5>
                                            <p><strong>Penyebab:</strong> Browser mobile atau ukuran layar.</p>
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Gunakan browser Chrome/Safari terbaru</li>
                                                <li>Zoom out jika perlu (pinch out)</li>
                                                <li>Rotate device ke landscape</li>
                                                <li>Update aplikasi browser</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-4">
                                    <h5><i class="fas fa-lightbulb me-2"></i>Tips Troubleshooting:</h5>
                                    <ul class="mb-0">
                                        <li>Selalu gunakan browser terbaru (Chrome, Firefox, Safari, Edge)</li>
                                        <li>Clear cache dan cookies browser secara berkala</li>
                                        <li>Pastikan koneksi internet stabil saat menggunakan sistem</li>
                                        <li>Jangan gunakan mode incognito/private untuk login</li>
                                        <li>Simpan screenshot error untuk dilaporkan ke admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <h5 class="text-info mb-3">
                                            <i class="fas fa-bug me-2"></i>
                                            Laporkan Bug
                                        </h5>
                                        <p class="mb-3">Temukan bug atau error sistem? Laporkan segera!</p>
                                        <div class="bug-report">
                                            <p class="mb-2"><strong>Info yang perlu disertakan:</strong></p>
                                            <ul class="small mb-3">
                                                <li>Screenshot error</li>
                                                <li>Browser & versi</li>
                                                <li>Langkah reproduce</li>
                                                <li>Waktu kejadian</li>
                                            </ul>
                                            <button class="btn btn-outline-info w-100" onclick="alert('Fitur laporan bug akan segera hadir!')">
                                                <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 bg-primary text-white rounded-3">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-shield-alt fa-3x mb-3"></i>
                                        <h5>System Status</h5>
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
.issues-list {
    margin-top: 20px;
}

.issue-item {
    display: flex;
    align-items: flex-start;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    border-left: 5px solid #17a2b8;
}

.issue-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.issue-icon {
    margin-right: 20px;
    flex-shrink: 0;
    padding: 15px;
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1), rgba(23, 162, 184, 0.2));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.issue-content h5 {
    color: #333;
    margin-bottom: 10px;
}

.issue-content p {
    color: #666;
    margin-bottom: 10px;
}

.issue-content ul {
    padding-left: 20px;
}

.issue-content li {
    margin-bottom: 5px;
    color: #555;
}

.alert-info {
    border: none;
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1), rgba(23, 162, 184, 0.2));
    color: #0c5460;
}

.sidebar-help .card {
    transition: all 0.3s ease;
}

.sidebar-help .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.bug-report {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
</style>
@endsection
