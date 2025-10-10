@extends('layouts.master-without-nav')
@section('title')
    Atur Ulang Password
@endsection
@section('css')
<style>
    /* Mengadopsi style dari halaman login & lupa password */
    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('assets/images/bg-login.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    /* Efek Glassmorphism pada Card */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
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
    
    .form-control {
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.7);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        font-size: 0.875em;
        font-weight: 500;
        color: #dc3545;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-block;
    }
    
    /* Tombol dengan gradasi dan efek hover */
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
                                <h4 class="text-dark mt-4">Buat Password Baru</h4>
                                <p class="text-muted">Password baru anda harus berbeda dari password yang pernah digunakan sebelumnya.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('siswa.do.password.reset') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    {{-- Input Password Baru --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password Baru</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password baru" id="password-input" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Input Konfirmasi Password Baru --}}
                                    <div class="mb-4">
                                        <label class="form-label" for="confirm-password-input">Konfirmasi Password Baru</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            {{-- ID diperbaiki agar unik --}}
                                            <input type="password" class="form-control pe-5 password-input" name="password_confirmation" placeholder="Ulangi password baru" id="confirm-password-input" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Simpan Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center bottom-link">
                        <p class="mb-0">Kembali ke halaman <a href="{{ route('login') }}" class="fw-semibold text-dark text-decoration-underline"> Login </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
{{-- Script untuk fungsionalitas show/hide password --}}
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection