@extends('layouts.master-without-nav')
@section('title')
    Lupa Password Panel
@endsection
@section('css')
<style>
    /* Mengadopsi style dari halaman login dengan improvement V2 (sama seperti siswa) */
    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('assets/images/bg-login.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    /* [IMPROVEMENT V2] Efek Glassmorphism pada Card dengan !important */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        background: rgba(255, 255, 255, 0.65) !important; /* DIPAKSA DENGAN !important */
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

    .form-floating > .form-control {
        height: calc(3.5rem + 2px);
        padding: 1rem 1.25rem;
        font-size: 1rem;
        border-radius: 0.5rem;
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .form-floating > label {
        padding: 1rem 1.25rem;
        color: #6c757d;
    }

    .form-floating > .form-control:focus {
        border-color: #980000;
        box-shadow: 0 0 0 0.2rem rgba(152, 0, 0, 0.15);
    }
    
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-control:focus ~ label {
        color: #980000;
        transform: scale(.85) translateY(-.5rem) translateX(.15rem);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        font-size: 0.875em;
        font-weight: 500;
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
        box-shadow: 0 8px 20px rgba(152, 0, 0, 0.3);
    }
    
    .bottom-link a {
        transition: color 0.3s ease;
    }
    
    .bottom-link a:hover {
        color: #212529 !important;
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
                                <h4 class="text-dark mt-4">Lupa Password Panel</h4>
                                <p class="text-muted">Masukkan email admin Anda untuk menerima kode OTP.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('panel.doForgotPassword') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail" name="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                                        <label for="floatingEmail">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Kirim Kode OTP</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center bottom-link">
                        <p class="mb-0">Ingat password Anda? <a href="{{ route('panel.login') }}" class="fw-semibold text-dark text-decoration-underline"> Kembali ke Login </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
