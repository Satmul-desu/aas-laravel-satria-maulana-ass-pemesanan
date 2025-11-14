@extends('layouts.app')

@section('title', 'Lainnya - Customer Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-secondary text-white py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('customer-service.index') }}" class="btn btn-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h3 class="mb-0">
                            <i class="fas fa-question-circle me-3"></i>
                            Pertanyaan Umum Lainnya
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="solution-content">
                                <h4 class="text-secondary mb-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Umum Smulz.Lab:
                                </h4>

                                <div class="info-sections">
                                    <div class="info-section">
                                        <h5><i class="fas fa-clock text-secondary me-2"></i>Jadwal Operasional</h5>
                                        <div class="info-content">
                                            <p><strong>Senin - Jumat:</strong> 08:00 - 17:00 WIB</p>
                                            <p><strong>Sabtu:</strong> 08:00 - 12:00 WIB (khusus pengembalian)</p>
                                            <p><strong>Minggu & Hari Libur:</strong> Tutup</p>
                                            <small class="text-muted">*Diluar jam operasional, gunakan sistem online untuk pemesanan</small>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h5><i class="fas fa-map-marker-alt text-secondary me-2"></i>Lokasi & Kontak</h5>
                                        <div class="info-content">
                                            <p><strong>Alamat:</strong> Gedung Teknik, Lantai 3<br>Universitas Smulz<br>Jl. Teknologi No. 123</p>
                                            <p><strong>Telepon:</strong> (021) 1234-5678</p>
                                            <p><strong>Email:</strong> info@smulzlab.com</p>
                                            <p><strong>WhatsApp:</strong> +62 812-3456-7890</p>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h5><i class="fas fa-users text-secondary me-2"></i>Siapa yang Bisa Menggunakan?</h5>
                                        <div class="info-content">
                                            <ul>
                                                <li>Mahasiswa aktif Universitas Smulz</li>
                                                <li>Dosen & Staff pengajar</li>
                                                <li>Peneliti terdaftar</li>
                                                <li>Pihak eksternal dengan rekomendasi</li>
                                            </ul>
                                            <small class="text-muted">*Wajib memiliki akun terverifikasi untuk akses sistem</small>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h5><i class="fas fa-file-contract text-secondary me-2"></i>Ketentuan Peminjaman</h5>
                                        <div class="info-content">
                                            <ul>
                                                <li>Maksimal peminjaman: 7 hari untuk mahasiswa, 14 hari untuk dosen</li>
                                                <li>Dapat diperpanjang dengan persetujuan admin</li>
                                                <li>Alat hanya digunakan di area lab yang ditentukan</li>
                                                <li>Tanggung jawab penuh atas kerusakan atau kehilangan</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h5><i class="fas fa-tools text-secondary me-2"></i>Jenis Alat Tersedia</h5>
                                        <div class="info-content">
                                            <ul>
                                                <li>Alat Kimia (mikroskop, spektrometer, dll)</li>
                                                <li>Alat Fisika (osiloskop, multimeter, dll)</li>
                                                <li>Alat Biologi (inkubator, centrifuge, dll)</li>
                                                <li>Alat Komputasi (software lab, dll)</li>
                                            </ul>
                                            <small class="text-muted">*Stok dan ketersediaan dapat berubah sewaktu-waktu</small>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-secondary mb-4 mt-5">
                                    <i class="fas fa-question-circle me-2"></i>
                                    FAQ (Frequently Asked Questions):
                                </h4>

                                <div class="faq-list">
                                    <div class="faq-item">
                                        <h6>Apakah bisa pinjam alat untuk keperluan di luar kampus?</h6>
                                        <p>Jawab: Tidak, alat hanya boleh digunakan di area lab Smulz.Lab untuk alasan keamanan dan tanggung jawab.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6>Bagaimana jika ada kerusakan saat penggunaan?</h6>
                                        <p>Jawab: Segera hentikan penggunaan dan laporkan ke admin lab. Jangan mencoba memperbaiki sendiri.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6>Apakah ada biaya tambahan selain sewa alat?</h6>
                                        <p>Jawab: Biaya dasar sudah termasuk dalam tarif sewa. Biaya tambahan hanya untuk kerusakan atau keterlambatan.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6>Bisa ganti alat jika tidak sesuai kebutuhan?</h6>
                                        <p>Jawab: Ya, bisa diganti dalam 24 jam pertama dengan syarat alat belum digunakan dan dalam kondisi baik.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6>Apakah ada pelatihan penggunaan alat?</h6>
                                        <p>Jawab: Ya, tersedia pelatihan dasar untuk alat-alat tertentu. Jadwalkan melalui admin lab.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar-help">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <h5 class="text-secondary mb-3">
                                            <i class="fas fa-envelope me-2"></i>
                                            Butuh Bantuan Khusus?
                                        </h5>
                                        <p class="mb-3">Untuk pertanyaan yang tidak tercover di sini, hubungi kami langsung.</p>
                                        <div class="contact-options">
                                            <a href="mailto:support@smulzlab.com" class="btn btn-outline-secondary w-100 mb-2">
                                                <i class="fas fa-envelope me-2"></i>Email Support
                                            </a>
                                            <a href="https://wa.me/6281234567890" class="btn btn-success w-100">
                                                <i class="fab fa-whatsapp me-2"></i>WhatsApp Admin
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 bg-info text-white rounded-3">
                                    <div class="card-body p-4 text-center">
                                        <i class="fas fa-star fa-3x mb-3"></i>
                                        <h5>Feedback</h5>
                                        <p class="mb-2">Bantu kami improve!</p>
                                        <button class="btn btn-light btn-sm" onclick="alert('Fitur feedback akan segera hadir!')">
                                            <i class="fas fa-comment me-1"></i>Beri Masukan
                                        </button>
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
.info-sections {
    margin-top: 20px;
}

.info-section {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    border-left: 5px solid #6c757d;
}

.info-section:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.info-section h5 {
    color: #495057;
    margin-bottom: 15px;
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 10px;
}

.info-content ul {
    padding-left: 20px;
}

.info-content li {
    margin-bottom: 5px;
    color: #666;
}

.faq-list {
    margin-top: 20px;
}

.faq-item {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.faq-item h6 {
    color: #495057;
    margin-bottom: 10px;
    font-weight: 600;
}

.faq-item p {
    color: #666;
    margin: 0;
    font-style: italic;
}

.sidebar-help .card {
    transition: all 0.3s ease;
}

.sidebar-help .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-options .btn {
    transition: all 0.3s ease;
}

.contact-options .btn:hover {
    transform: scale(1.05);
}
</style>
@endsection
