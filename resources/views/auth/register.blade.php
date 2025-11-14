@extends('layouts.auth')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary mb-2">
                            <i class="fas fa-flask me-2"></i>Daftar Akun
                        </h2>
                        <p class="text-muted">Sistem Pemesanan Alat Laboratorium</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="user">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>Nama Lengkap
                            </label>
                            <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="Masukkan nama lengkap" style="border-radius: 10px; padding: 12px;">
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-1"></i>Email
                            </label>
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="Masukkan alamat email" style="border-radius: 10px; padding: 12px;">
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-1"></i>Password
                            </label>
                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Minimal 8 karakter" style="border-radius: 10px; padding: 12px;">
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">
                                <i class="fas fa-lock me-1"></i>Konfirmasi Password
                            </label>
                            <input id="password-confirm" type="password" class="form-control form-control-user"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Ulangi password" style="border-radius: 10px; padding: 12px;">
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block w-100 mb-3" style="border-radius: 10px; padding: 12px; font-weight: 600;">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-primary fw-semibold">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-user {
    border-radius: 10rem;
    padding: 1.5rem 1rem;
    border: 1px solid #d1d3e2;
    font-size: 0.9rem;
}

.form-control-user:focus {
    border-color: #bac8f3;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn-user {
    padding: 0.75rem 1rem;
    border-radius: 10rem;
    font-size: 0.9rem;
    font-weight: 600;
}

.btn-user:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.card {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
