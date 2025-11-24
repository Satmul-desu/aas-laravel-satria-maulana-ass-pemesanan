# Dokumentasi Lengkap Sistem Manajemen Lab Tools (Smulz.Lab)

## Pendahuluan

Sistem Manajemen Lab Tools adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola peminjaman alat-alat laboratorium. Sistem ini menyediakan fitur lengkap untuk mengelola kategori alat, alat, pelanggan, peminjaman, dan pemesanan dengan antarmuka yang user-friendly.

## Arsitektur Aplikasi

### Teknologi yang Digunakan
- **Framework**: Laravel 11.x
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **Authentication**: Laravel Breeze
- **Libraries Tambahan**:
  - SweetAlert2 untuk notifikasi
  - Font Awesome untuk ikon
  - DomPDF untuk export PDF
  - Laravel Permission untuk role management

## Struktur Database

### 1. Tabel `users`
**Fungsi**: Menyimpan data pengguna sistem
**Field**:
- `id` (Primary Key)
- `name` (Nama pengguna)
- `email` (Email unik)
- `email_verified_at` (Timestamp verifikasi email)
- `password` (Password terenkripsi)
- `remember_token` (Token untuk remember me)
- `created_at`, `updated_at` (Timestamps)

### 2. Tabel `kategori_alats`
**Fungsi**: Mengelompokkan alat berdasarkan kategori
**Field**:
- `id` (Primary Key)
- `nama` (Nama kategori)
- `deskripsi` (Deskripsi kategori)
- `created_at`, `updated_at` (Timestamps)

### 3. Tabel `alats`
**Fungsi**: Menyimpan data alat laboratorium
**Field**:
- `id` (Primary Key)
- `nama` (Nama alat)
- `deskripsi` (Deskripsi alat)
- `kategori_alat_id` (Foreign Key ke kategori_alats)
- `harga_sewa` (Harga sewa per hari)
- `stok` (Jumlah stok tersedia)
- `kondisi` (Kondisi alat: baik/rusak)
- `lokasi_penyimpanan` (Lokasi penyimpanan alat)
- `tanggal_pembelian` (Tanggal pembelian)
- `created_at`, `updated_at` (Timestamps)

### 4. Tabel `pelanggans`
**Fungsi**: Menyimpan data pelanggan yang meminjam alat
**Field**:
- `id` (Primary Key)
- `nama` (Nama pelanggan)
- `email` (Email pelanggan)
- `telepon` (Nomor telepon)
- `alamat` (Alamat pelanggan)
- `created_at`, `updated_at` (Timestamps)

### 5. Tabel `peminjamen`
**Fungsi**: Menyimpan data transaksi peminjaman
**Field**:
- `id` (Primary Key)
- `pelanggan_id` (Foreign Key ke pelanggans)
- `tanggal_pinjam` (Tanggal peminjaman)
- `tanggal_kembali` (Tanggal pengembalian)
- `tanggal_dikembalikan` (Tanggal aktual pengembalian)
- `total` (Total biaya peminjaman)
- `is_done` (Status selesai: 0/1)
- `late_fee` (Denda keterlambatan)
- `return_condition` (Kondisi alat saat dikembalikan)
- `additional_fees` (Biaya tambahan)
- `created_at`, `updated_at` (Timestamps)

### 6. Tabel `peminjaman_details`
**Fungsi**: Detail item yang dipinjam dalam satu transaksi
**Field**:
- `id` (Primary Key)
- `peminjaman_id` (Foreign Key ke peminjamen)
- `alat_id` (Foreign Key ke alats)
- `quantity` (Jumlah alat yang dipinjam)
- `harga_sewa` (Harga sewa per item)
- `subtotal` (Total harga untuk item ini)
- `created_at`, `updated_at` (Timestamps)

### 7. Tabel `pemesanans`
**Fungsi**: Menyimpan data pemesanan alat
**Field**:
- `id` (Primary Key)
- `nama_pemesan` (Nama pemesan)
- `email` (Email pemesan)
- `telepon` (Nomor telepon)
- `alat` (Nama alat yang dipesan)
- `quantity` (Jumlah yang dipesan)
- `tanggal_pesan` (Tanggal pemesanan)
- `catatan` (Catatan tambahan)
- `status` (Status pemesanan)
- `total` (Total biaya)
- `created_at`, `updated_at` (Timestamps)

## Model Eloquent

### 1. Model `User`
**Lokasi**: `app/Models/User.php`
**Fungsi**: Model untuk autentikasi pengguna
**Relasi**:
- Menggunakan Laravel Sanctum untuk API tokens
- Menggunakan Spatie Laravel Permission untuk role dan permission

### 2. Model `KategoriAlat`
**Lokasi**: `app/Models/KategoriAlat.php`
**Fungsi**: Model untuk kategori alat
**Relasi**:
```php
public function alats()
{
    return $this->hasMany(Alat::class);
}
```

### 3. Model `Alat`
**Lokasi**: `app/Models/Alat.php`
**Fungsi**: Model untuk data alat
**Relasi**:
```php
public function kategoriAlat()
{
    return $this->belongsTo(KategoriAlat::class);
}

public function peminjamanDetails()
{
    return $this->hasMany(PeminjamanDetail::class);
}
```
**Fillable Fields**:
- nama, deskripsi, kategori_alat_id, harga_sewa, stok, kondisi, lokasi_penyimpanan, tanggal_pembelian

### 4. Model `Pelanggan`
**Lokasi**: `app/Models/Pelanggan.php`
**Fungsi**: Model untuk data pelanggan
**Relasi**:
```php
public function peminjamen()
{
    return $this->hasMany(Peminjaman::class);
}
```
**Fillable Fields**:
- nama, email, telepon, alamat

### 5. Model `Peminjaman`
**Lokasi**: `app/Models/Peminjaman.php`
**Fungsi**: Model untuk transaksi peminjaman
**Relasi**:
```php
public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class);
}

public function peminjamanDetails()
{
    return $this->hasMany(PeminjamanDetail::class);
}
```
**Fillable Fields**:
- pelanggan_id, tanggal_pinjam, tanggal_kembali, tanggal_dikembalikan, total, is_done, late_fee, return_condition, additional_fees

### 6. Model `PeminjamanDetail`
**Lokasi**: `app/Models/PeminjamanDetail.php`
**Fungsi**: Model untuk detail peminjaman
**Relasi**:
```php
public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class);
}

public function alat()
{
    return $this->belongsTo(Alat::class);
}
```
**Fillable Fields**:
- peminjaman_id, alat_id, quantity, harga_sewa, subtotal

### 7. Model `Pemesanan`
**Lokasi**: `app/Models/Pemesanan.php`
**Fungsi**: Model untuk data pemesanan
**Fillable Fields**:
- nama_pemesan, email, telepon, alat, quantity, tanggal_pesan, catatan, status, total

## Controller

### 1. `DashboardController`
**Lokasi**: `app/Http/Controllers/DashboardController.php`
**Fungsi**: Mengelola halaman dashboard utama
**Method**:
- `index()`: Menampilkan statistik dashboard (total alat, peminjaman aktif, dll.)

### 2. `KategoriAlatController`
**Lokasi**: `app/Http/Controllers/KategoriAlatController.php`
**Fungsi**: CRUD untuk kategori alat
**Method**:
- `index()`: Menampilkan daftar kategori dengan pagination
- `create()`: Form tambah kategori baru
- `store()`: Menyimpan kategori baru dengan validasi
- `show()`: Menampilkan detail kategori
- `edit()`: Form edit kategori
- `update()`: Update kategori dengan validasi
- `destroy()`: Hapus kategori

### 3. `AlatController`
**Lokasi**: `app/Http/Controllers/AlatController.php`
**Fungsi**: CRUD untuk alat laboratorium
**Method**:
- `index()`: Daftar alat dengan filter kategori
- `create()`: Form tambah alat
- `store()`: Simpan alat baru
- `show()`: Detail alat
- `edit()`: Form edit alat
- `update()`: Update alat
- `destroy()`: Hapus alat

### 4. `PelangganController`
**Lokasi**: `app/Http/Controllers/PelangganController.php`
**Fungsi**: CRUD untuk data pelanggan
**Method**:
- `index()`: Daftar pelanggan dengan pagination
- `create()`: Form tambah pelanggan
- `store()`: Simpan pelanggan baru dengan validasi email unik
- `show()`: Detail pelanggan
- `edit()`: Form edit pelanggan
- `update()`: Update pelanggan dengan validasi
- `destroy()`: Hapus pelanggan

### 5. `PeminjamanController`
**Lokasi**: `app/Http/Controllers/PeminjamanController.php`
**Fungsi**: Mengelola transaksi peminjaman
**Method**:
- `index()`: Daftar peminjaman dengan status
- `create()`: Form peminjaman baru
- `store()`: Simpan peminjaman
- `show()`: Detail peminjaman
- `edit()`: Form edit peminjaman
- `update()`: Update peminjaman
- `destroy()`: Hapus peminjaman
- `returnAlat()`: Proses pengembalian alat
- `purchase()`: Proses pembelian alat
- `exportPdf()`: Export data ke PDF

### 6. `PemesananController`
**Lokasi**: `app/Http/Controllers/PemesananController.php`
**Fungsi**: Mengelola pemesanan alat
**Method**:
- `index()`: Daftar pemesanan
- `create()`: Form pemesanan baru
- `store()`: Simpan pemesanan
- `show()`: Detail pemesanan
- `edit()`: Form edit pemesanan
- `update()`: Update pemesanan
- `destroy()`: Hapus pemesanan
- `exportPdf()`: Export ke PDF
- `exportExcel()`: Export ke Excel

### 7. `CustomerServiceController`
**Lokasi**: `app/Http/Controllers/CustomerServiceController.php`
**Fungsi**: Menampilkan halaman customer service
**Method**:
- `index()`: Halaman utama customer service
- `caraPemesanan()`: Panduan cara pemesanan
- `masalahPembayaran()`: Panduan masalah pembayaran
- `pengembalianAlat()`: Panduan pengembalian alat
- `masalahTeknis()`: Panduan masalah teknis
- `lainnya()`: Panduan lainnya

## Routes

### Web Routes (`routes/web.php`)
```php
// Public routes
Route::get('/', function () { ... });

// Auth routes
Auth::routes();

// Protected routes (middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('kategori-alats', KategoriAlatController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('pelanggans', PelangganController::class);
    Route::resource('peminjamen', PeminjamanController::class);
    Route::resource('pemesanans', PemesananController::class);

    // Special routes
    Route::post('peminjamen/{peminjaman}/return-alat', [PeminjamanController::class, 'returnAlat']);
    Route::post('peminjamen/{peminjaman}/purchase', [PeminjamanController::class, 'purchase']);
    Route::get('peminjamen-export-pdf', [PeminjamanController::class, 'exportPdf']);
    Route::get('pemesanans-export-pdf', [PemesananController::class, 'exportPdf']);
    Route::get('pemesanans-export-excel', [PemesananController::class, 'exportExcel']);

    // Customer service routes
    Route::get('/customer-service', [CustomerServiceController::class, 'index']);
    Route::get('/customer-service/cara-pemesanan', [CustomerServiceController::class, 'caraPemesanan']);
    // ... other customer service routes
});
```

## Views (Blade Templates)

### Layouts

#### 1. `layouts/app.blade.php`
**Fungsi**: Layout utama aplikasi dengan sidebar navigation
**Komponen**:
- Header dengan branding "Lab Tools System"
- Sidebar navigation dengan menu:
  - Dashboard
  - Kategori Alat
  - Alat
  - Pelanggan
  - Peminjaman
  - Customer Service
- Main content area
- Toast notifications untuk success messages
- SweetAlert untuk error messages

#### 2. `layouts/auth.blade.php`
**Fungsi**: Layout untuk halaman autentikasi (login/register)
**Komponen**:
- Clean design tanpa sidebar
- Centered content
- Bootstrap styling

### Dashboard

#### `dashboard.blade.php`
**Fungsi**: Halaman dashboard utama
**Fitur**:
- Cards statistik (total alat, peminjaman aktif, dll.)
- Charts menggunakan Chart.js
- Quick actions

### Kategori Alat

#### `kategori-alats/index.blade.php`
**Fungsi**: Daftar semua kategori alat
**Fitur**:
- Tabel dengan pagination
- Tombol tambah kategori baru
- Action buttons (view, edit, delete)
- Search/filter functionality

#### `kategori-alats/create.blade.php`
**Fungsi**: Form tambah kategori baru
**Field**:
- Nama kategori (required)
- Deskripsi (textarea)

#### `kategori-alats/edit.blade.php`
**Fungsi**: Form edit kategori
**Field**: Sama dengan create form

#### `kategori-alats/show.blade.php`
**Fungsi**: Detail kategori alat
**Menampilkan**:
- Nama kategori
- Deskripsi
- Daftar alat dalam kategori
- Tombol edit/delete

### Alat

#### `alats/index.blade.php`
**Fungsi**: Daftar semua alat
**Fitur**:
- Filter berdasarkan kategori
- Tabel dengan informasi lengkap
- Status stok dan kondisi
- Action buttons

#### `alats/create.blade.php`
**Fungsi**: Form tambah alat baru
**Field**:
- Nama alat
- Deskripsi
- Kategori (dropdown)
- Harga sewa
- Stok
- Kondisi
- Lokasi penyimpanan
- Tanggal pembelian

#### `alats/edit.blade.php`
**Fungsi**: Form edit alat
**Field**: Sama dengan create form

#### `alats/show.blade.php`
**Fungsi**: Detail alat
**Menampilkan**:
- Semua informasi alat
- Riwayat peminjaman
- Status ketersediaan

### Pelanggan

#### `pelanggans/index.blade.php`
**Fungsi**: Daftar semua pelanggan
**Fitur**:
- Tabel dengan informasi kontak
- Pagination
- Action buttons (view, edit, delete)

#### `pelanggans/create.blade.php`
**Fungsi**: Form tambah pelanggan baru
**Field**:
- Nama (required)
- Email (required, unique)
- Telepon (required)
- Alamat (required)

#### `pelanggans/edit.blade.php`
**Fungsi**: Form edit pelanggan
**Field**: Sama dengan create form

#### `pelanggans/show.blade.php`
**Fungsi**: Detail pelanggan
**Menampilkan**:
- Informasi kontak lengkap
- Riwayat peminjaman
- Total peminjaman

### Peminjaman

#### `peminjamen/index.blade.php`
**Fungsi**: Daftar semua transaksi peminjaman
**Fitur**:
- Filter berdasarkan status
- Tabel dengan detail lengkap
- Status indicators (aktif, terlambat, selesai)
- Export to PDF

#### `peminjamen/create.blade.php`
**Fungsi**: Form peminjaman baru
**Fitur**:
- Pilih pelanggan (dropdown)
- Pilih alat dengan quantity
- Tanggal pinjam dan kembali
- Kalkulasi otomatis total biaya

#### `peminjamen/edit.blade.php`
**Fungsi**: Form edit peminjaman
**Field**: Sama dengan create form

#### `peminjamen/show.blade.php`
**Fungsi**: Detail transaksi peminjaman
**Menampilkan**:
- Informasi pelanggan
- Daftar alat yang dipinjam
- Status dan tanggal
- Total biaya dan denda

#### `peminjamen/export_pdf.blade.php`
**Fungsi**: Template export PDF untuk laporan peminjaman

### Pemesanan

#### `pemesanans/index.blade.php`
**Fungsi**: Daftar semua pemesanan
**Fitur**:
- Filter berdasarkan status
- Export ke PDF dan Excel

#### `pemesanans/create.blade.php`
**Fungsi**: Form pemesanan baru
**Field**:
- Nama pemesan
- Email dan telepon
- Alat yang dipesan
- Quantity
- Tanggal pesan
- Catatan

#### `pemesanans/edit.blade.php`
**Fungsi**: Form edit pemesanan

#### `pemesanans/show.blade.php`
**Fungsi**: Detail pemesanan

#### `pemesanans/export_pdf.blade.php`
**Fungsi**: Template export PDF

### Customer Service

#### `customer-service/index.blade.php`
**Fungsi**: Halaman utama customer service
**Menampilkan**: Menu panduan bantuan

#### `customer-service/cara-pemesanan.blade.php`
**Fungsi**: Panduan cara melakukan pemesanan

#### `customer-service/masalah-pembayaran.blade.php`
**Fungsi**: Panduan mengatasi masalah pembayaran

#### `customer-service/pengembalian-alat.blade.php`
**Fungsi**: Panduan proses pengembalian alat

#### `customer-service/masalah-teknis.blade.php`
**Fungsi**: Panduan mengatasi masalah teknis

#### `customer-service/lainnya.blade.php`
**Fungsi**: Panduan untuk masalah lainnya

### Authentication Views

#### `auth/login.blade.php`
**Fungsi**: Form login
**Field**: Email dan password

#### `auth/register.blade.php`
**Fungsi**: Form registrasi
**Field**: Name, email, password, confirm password

#### `auth/passwords/email.blade.php`
**Fungsi**: Form reset password - request email

#### `auth/passwords/reset.blade.php`
**Fungsi**: Form reset password - new password

#### `auth/passwords/confirm.blade.php`
**Fungsi**: Form konfirmasi password

## Fitur Utama

### 1. Manajemen Kategori Alat
- **CRUD lengkap** untuk kategori alat
- **Relasi** dengan alat
- **Validasi** input data

### 2. Manajemen Alat
- **CRUD lengkap** untuk alat laboratorium
- **Tracking kondisi** alat (baik/rusak)
- **Manajemen stok** real-time
- **Lokasi penyimpanan** alat

### 3. Manajemen Pelanggan
- **Database pelanggan** terpusat
- **Riwayat peminjaman** per pelanggan
- **Validasi data** kontak

### 4. Sistem Peminjaman
- **Multi-item peminjaman** dalam satu transaksi
- **Kalkulasi biaya** otomatis
- **Tracking pengembalian** alat
- **Denda keterlambatan** otomatis
- **Status tracking** (aktif/terlambat/selesai)

### 5. Sistem Pemesanan
- **Form pemesanan** online
- **Tracking status** pemesanan
- **Export laporan** PDF/Excel

### 6. Customer Service
- **Panduan lengkap** untuk pengguna
- **Berbagai kategori** masalah dan solusi

### 7. Dashboard & Reporting
- **Statistik real-time** semua data
- **Charts visualisasi** data
- **Export laporan** dalam format PDF

### 8. Authentication & Authorization
- **Laravel Breeze** untuk autentikasi
- **Role-based access** dengan Spatie Permission
- **Secure password** hashing

### 9. UI/UX Features
- **Responsive design** dengan Bootstrap 5
- **Modern glassmorphism** design
- **Toast notifications** untuk feedback
- **SweetAlert modals** untuk konfirmasi
- **Loading states** dan animations

## Alur Kerja Sistem

### 1. Setup Awal
1. User melakukan registrasi/login
2. Admin setup kategori alat
3. Admin menambah data alat

### 2. Proses Peminjaman
1. Pelanggan datang/mendaftar
2. Admin buat transaksi peminjaman
3. Pilih alat dan quantity
4. Set tanggal pinjam dan kembali
5. Kalkulasi biaya otomatis
6. Simpan transaksi

### 3. Proses Pengembalian
1. Admin cek kondisi alat kembali
2. Hitung denda jika terlambat
3. Update status peminjaman
4. Update stok alat

### 4. Monitoring & Reporting
1. Dashboard real-time statistics
2. Export laporan periodik
3. Tracking performa sistem

## Keamanan & Validasi

### Validasi Input
- **Server-side validation** di semua controller
- **Unique constraints** untuk email
- **Required fields** untuk data penting
- **Data type validation** (email, numeric, date)

### Keamanan
- **CSRF protection** di semua form
- **SQL injection prevention** dengan Eloquent ORM
- **XSS protection** dengan blade escaping
- **Authentication middleware** untuk protected routes

## Kesimpulan

Sistem Manajemen Lab Tools ini adalah solusi komprehensif untuk mengelola operasional laboratorium dengan fitur:

- ✅ **Manajemen inventaris** alat lengkap
- ✅ **Sistem peminjaman** yang terintegrasi
- ✅ **Tracking pelanggan** dan riwayat
- ✅ **Reporting** dan export data
- ✅ **Customer service** built-in
- ✅ **UI modern** dan responsive
- ✅ **Keamanan** dan validasi data
- ✅ **Scalable architecture** dengan Laravel

Sistem ini siap digunakan untuk mengelola lab tools dengan efisien dan profesional.
