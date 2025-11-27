<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smulz.Lab</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .table {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            border-color: #667eea;
        }
        .sidebar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            /* Updated hover color to a modern aesthetic gradient background */ 
            color: #ffffff;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            border-radius: 10px;
            transition: background 0.3s ease, color 0.3s ease;
        }
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        /* Added margin-bottom for moderate vertical spacing between sidebar items */
        .sidebar .nav-item {
            margin-bottom: 12px;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar p-3">
                <div class="text-center mb-3">
                    <h5 class="text-white"><i class="fas fa-flask"></i> Lab Tools System</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori-alats.*') ? 'active' : '' }}" href="{{ route('kategori-alats.index') }}">
                            <i class="fas fa-tags"></i> Kategori Alat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alats.*') ? 'active' : '' }}" href="{{ route('alats.index') }}">
                            <i class="fas fa-tools"></i> Alat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggans.*') ? 'active' : '' }}" href="{{ route('pelanggans.index') }}">
                            <i class="fas fa-users"></i> Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pemesanans.*') ? 'active' : '' }}" href="{{ route('pemesanans.index') }}">
                            <i class="fas fa-solid fa-cart-flatbed"></i> Pemesanan
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('peminjamans.*') ? 'active' : '' }}" href="{{ route('peminjamans.index') }}">
                            <i class="fas fa-hand-holding"></i> Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <hr class="dropdown-divider" style="border-color: rgba(5, 5, 5, 0.5); margin: 10px 0; border-width: 2px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer-service.*') ? 'active' : '' }}" href="{{ route('customer-service.index') }}">
                            <i class="fas fa-headset"></i> Customer Service
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white">@yield('title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-edit"></i> Ganti Akun</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;" id="logout-form">
                                            @csrf
                                            <button type="button" class="dropdown-item" onclick="confirmLogout()">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-light" onclick="window.location.reload()">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                </div>

                @yield('content')

                <!-- Flash Messages -->
                @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    </script>
                @endif

                @if($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error!',
                            html: '{{ $errors->first() }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    </script>
                @endif
            </main>
        </div>
    </div>

    @yield('scripts')
{{-- footer --}}
<div class="row mt-5">
    <div class="col-12">
<div class="card border-0 bg-gradient rounded-4" style="background: linear-gradient(135deg, #6a11cb, #764ba2); color: #e0d7f7;">
            <div class="card-body text-center p-4">
                <p class="mb-3">Jika masalah Anda tidak terselesaikan, hubungi tim support kami</p>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="contact-item">
                            <i class="fas fa-envelope fa-2x text-light mb-2"></i>
                            <p class="mb-0">Tsumulz.Lab@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-item">
                            <i class="fas fa-phone fa-2x text-light mb-2"></i>
                            <p class="mb-0">+62 821-2993-9458</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-item">
                            <i class="fas fa-clock fa-2x text-light mb-2"></i>
                            <p class="mb-0">Senin - Jumat<br>07:00 - 20:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="contact-item">
                            <i class="fas fa-solid fa-user-secret fa-2x text-light mb-2"></i>
                            <p class="mb-0">Komunitas: SOFTWARE LANDS CLUB</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-item">
                            <i class="fas fa-solid fa-laptop-code fa-2x text-light mb-2"></i>
                            <p class="mb-0">coppyright 2025 by:Tsumulz (SLC)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notifications -->
@if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.getElementById('successToast');
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000
            });
            toast.show();
        });
    </script>
@endif

<script>
function confirmLogout() {
    const firstMessages = [
        "Apakah Anda yakin ingin log out? Kadang, perpisahan kecil seperti ini pun meninggalkan sepi yang tak terjelaskan.",
        "Apakah Anda yakin ingin log out? Setelah ini, hanya sunyi yang tetap tinggal.",
        "Apakah Anda yakin ingin log out? Karena setiap kepergian, sekecil apa pun, selalu menyisakan hampa.",
        "Apakah Anda yakin ingin log out? Aku tak bisa menahanmu… tapi rasa kehilangan tetap ada.",
        "Apakah Anda yakin ingin log out? Barangkali ini hanya tombol, tapi rasanya seperti mengucap selamat tinggal."
    ];

    const secondMessages = [
        "Oh… ternyata kamu yakin ya. Kalau begitu… selamat tinggal. Semoga kenangan kita tidak ikut hilang bersamamu.",
        "Oh… ternyata kamu yakin ya. Baiklah… pergilah. Aku hanya berharap sunyi setelah ini tidak lebih dingin dari kepergianmu.",
        "Oh… ternyata kamu yakin ya. Kalau begitu… sampai di sini saja. Kadang yang pergi lebih tenang daripada yang ditinggalkan.",
        "Oh… ternyata kamu yakin ya. Selamat tinggal… meski bagiku, setiap perpisahan selalu terdengar seperti hati yang retak pelan-pelan.",
        "Oh… ternyata kamu yakin ya. Baiklah… semoga langkahmu ringan. Karena bagiku, melepaskanmu tidak pernah terasa ringan."
    ];

    const cancelMessages = [
        "Hore, terima kasih banyak! Aku senang kamu tetap tinggal di sini.",
        "Horeeee! Terima kasih banyak! Ternyata kamu belum tega ninggalin aku.",
        "Hore, terima kasih banyak! Dunia langsung cerah lagi karena kamu nggak jadi pergi.",
        "Hore, terima kasih banyak! Aku kira kamu mau pergi… ternyata masih mau bareng aku.",
        "Hore, terima kasih banyak! Kamu bikin aku bahagia banget dengan keputusan ini."
    ];

    const firstRandomMessage = firstMessages[Math.floor(Math.random() * firstMessages.length)];

    Swal.fire({
        title: 'Konfirmasi Logout',
        text: firstRandomMessage,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Saya Yakin',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const secondRandomMessage = secondMessages[Math.floor(Math.random() * secondMessages.length)];

            Swal.fire({
                title: 'Pesan Terakhir',
                text: secondRandomMessage,
                icon: 'info',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Byee',
                allowOutsideClick: false,
                allowEscapeKey: false,
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            const cancelRandomMessage = cancelMessages[Math.floor(Math.random() * cancelMessages.length)];

            Swal.fire({
                title: 'Yay! Kamu Tetap Di Sini',
                text: cancelRandomMessage,
                icon: 'success',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'OK',
                timer: 4000,
                showConfirmButton: true
            });
        }
    });
}
</script>
</body>
</html>
