@extends('layouts.master-without-nav')
@section('title', 'Reset Password Panel')
@section('css')
<style>
    /* Mengadopsi style dari halaman login dengan !important (sama seperti siswa reset) */
    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('assets/images/bg-login.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    .card {
        /* ==== JURUS PAMUNGKAS DENGAN !important ==== */
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        background: rgba(255, 255, 255, 0.65) !important;
        backdrop-filter: blur(15px) !important;
        -webkit-backdrop-filter: blur(15px) !important;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .2) !important;
        border-radius: 1rem !important;
        animation: fadeInDown 0.7s ease-out forwards;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-body {
        padding: 2.5rem;
    }

    .auth-logo:hover img {
        transform: scale(1.05);
    }
    .auth-logo img {
        transition: transform 0.3s ease-in-out;
    }
    
    .otp-input-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 2rem 0;
    }
    .otp-input {
        width: 48px;
        height: 55px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 600;
        border-radius: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }
    .otp-input:focus {
        border-color: #980000;
        box-shadow: 0 0 0 0.2rem rgba(152, 0, 0, 0.15);
        outline: none;
        transform: scale(1.05);
    }
    
    .btn-gradient-danger {
        border: none;
        background-image: linear-gradient(to right, #EE5A24 0%, #980000 50%, #EE5A24 100%);
        background-size: 200% auto;
        color: white;
        transition: all 0.5s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-gradient-danger:hover {
        background-position: right center;
        transform: translateY(-3px);
    }
</style>
@endsection
@section('content')
<div class="auth-page-wrapper">
    <div class="auth-page-content overflow-hidden py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <a href="/" class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia" height="50">
                                </a>
                                <h4 class="text-dark mt-4">Reset Kata Sandi Panel</h4>
                                <p class="text-muted">Masukkan kata sandi baru untuk akun <strong>{{ $email ?? 'emailanda@example.com' }}</strong>.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('panel.do.password.reset') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token ?? '' }}">
                                    <input type="hidden" name="email" value="{{ $email ?? '' }}">

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kata Sandi Baru" required>
                                        <label for="password">Kata Sandi Baru</label>
                                        @error('password')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-muted">Ingat password Anda? <a href="{{ route('panel.login') }}" class="fw-semibold text-decoration-underline" style="color: #980000;">Kembali ke Login</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pwd = document.getElementById('password');
    if (pwd) pwd.focus();
});
</script>
@endsection
