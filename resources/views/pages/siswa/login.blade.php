@extends('layouts.master-without-nav')
@section('title')
    Masuk ke Akun Cendekia
@endsection
@section('content')
{{-- Kontainer utama dengan gambar background. Ganti nama file jika perlu --}}
<div class="auth-page-wrapper d-flex justify-content-center align-items-center min-vh-100" style="background-image: url('{{ asset('assets/images/bg-login.jpg') }}'); background-size: cover; background-position: center;">
    
    {{-- Lapisan overlay gelap agar form lebih mudah dibaca --}}
    <div class="bg-overlay" style="background-color: rgba(0, 0, 0, 0.5);"></div>

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
                                        <button class="btn btn-danger w-100 btn-lg" type="submit">Masuk</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title text-muted">atau masuk dengan</h5>
                                        </div>
                                        <div>
                                            <a href="{{ route('google.redirect') }}" class="btn btn-light border w-100">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" height="20" class="me-2">
                                                Masuk dengan Google
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        {{-- Teks diubah menjadi putih agar kontras dengan background gelap --}}
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