@extends('layouts.auth')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary mb-2">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </h2>
                        <p class="text-muted">Masukkan email Anda untuk menerima link reset password</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="user">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-1"></i>Email Address
                            </label>
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Masukkan alamat email" style="border-radius: 10px; padding: 12px;">
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block w-100 mb-3" style="border-radius: 10px; padding: 12px; font-weight: 600;">
                            <i class="fas fa-paper-plane me-2"></i>Send Password Reset Link
                        </button>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0">
                                <a href="{{ route('login') }}" class="text-primary fw-semibold">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
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
