@extends('layouts.master-without-nav')
@section('title')
    Masuk ke Akun Cendekia
@endsection
@section('css')
<style>
    /* Custom Styles for an Improved Login Experience */
    :root {
        --primary-red: #980000;
        --primary-orange: #EE5A24;
    }

    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('assets/images/bg-login.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    /* Overlay tidak lagi diperlukan, efek blur sudah cukup */
    /* .bg-overlay { background-color: rgba(0, 0, 0, 0.5); } */

    /* [IMPROVEMENT] Efek Glassmorphism pada Card */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.8); /* Latar belakang semi-transparan */
        backdrop-filter: blur(15px); /* Efek blur utama */
        -webkit-backdrop-filter: blur(15px); /* Untuk Safari */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .2) !important;
        border-radius: 1rem !important;
        animation: fadeInDown 0.7s ease-out forwards;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
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

    /* [IMPROVEMENT] Styling Input Lebih Halus */
    .form-control-lg {
        font-size: 1rem;
        padding: 0.75rem 1.25rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .form-control-lg:focus {
        background-color: rgba(255, 255, 255, 0.7);
        border-color: var(--primary-red);
        box-shadow: 0 0 0 0.2rem rgba(152, 0, 0, 0.15);
    }
    
    /* [IMPROVEMENT] Tombol dengan gradasi dan efek hover */
    .btn-gradient-danger {
        border: none;
        background-image: linear-gradient(to right, var(--primary-orange) 0%, var(--primary-red) 50%, var(--primary-orange) 100%);
        background-size: 200% auto;
        color: white;
        transition: all 0.5s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-gradient-danger:hover {
        background-position: right center; /* Menggeser gradasi saat hover */
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(152, 0, 0, 0.3);
    }
    
    /* [IMPROVEMENT] Tombol Google lebih interaktif */
    .btn-google {
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .btn-google:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(0,0,0,0.1);
    }

    .bottom-link a {
        transition: color 0.3s ease;
    }
    .bottom-link a:hover {
        color: #f8f9fa !important;
    }
</style>
@endsection
@section('content')
<div class="auth-page-wrapper">
    
    <div class="auth-page-content overflow-hidden py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mt-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <a href="/" class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia" height="50">
                                </a>
                                <h4 class="text-dark mt-4">Selamat Datang Kembali!</h4>
                                <p class="text-muted">Masuk untuk melanjutkan ke LBB Cendekia.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('siswa.doLogin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('siswa.forgotPassword') }}" class="text-muted">Lupa password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control form-control-lg pe-5 password-input" name="password" placeholder="Masukkan password" id="password-input" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        {{-- [IMPROVEMENT] Menggunakan class tombol gradasi --}}
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Masuk</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title text-muted">atau masuk dengan</h5>
                                        </div>
                                        <div>
                                            {{-- [IMPROVEMENT] Class baru untuk tombol google --}}
                                            <a href="{{ route('google.redirect') }}" class="btn btn-light border w-100 btn-google">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" height="20" class="me-2">
                                                Masuk dengan Google
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center bottom-link">
                        <p class="mb-0 text-white">Belum Punya Akun? <a href="{{ route('register.choice') }}" class="fw-semibold text-white text-decoration-underline"> Daftar Sekarang </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection