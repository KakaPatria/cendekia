@extends('layouts.master-without-nav')
@section('title')
    Login Panel Admin
@endsection
@section('css')
<style>
    /* Mengadopsi style dari halaman login siswa */
    :root {
        --primary-red: #980000;
        --primary-orange: #EE5A24;
    }

    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('assets/images/loginadmin.jpeg') }}');
        background-size: cover;
        background-position: center;
    }

    /* Efek Glassmorphism pada Card */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        background: rgba(255, 255, 255, 0.65) !important;
        backdrop-filter: blur(15px) !important;
        -webkit-backdrop-filter: blur(15px) !important;
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

    /* Styling Input */
    .form-control {
        font-size: 1rem;
        padding: 0.75rem 1.25rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.7);
        border-color: var(--primary-red);
        box-shadow: 0 0 0 0.2rem rgba(152, 0, 0, 0.15);
    }
    
    /* Tombol Gradasi */
    .btn-gradient-danger {
        border: none;
        background-image: linear-gradient(to right, var(--primary-orange) 0%, var(--primary-red) 50%, var(--primary-orange) 100%);
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
    
    .footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 1.5rem 0;
        background-color: rgba(0,0,0,0.2);
    }
</style>
@endsection
@section('content')
<div class="auth-page-wrapper">
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <a href="/" class="d-inline-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/logo-cendikia.png')}}" alt="" height="50">
                                </a>
                                <h4 class="text-dark mt-4">Admin Panel Login</h4>
                                <p class="text-muted">Masuk untuk melanjutkan ke dashboard.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2 mt-4">
                                <form action="{{ route('panel.doLogin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Masukkan email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="float-end">
                                            {{-- [PERBAIKAN] Link diubah ke route Lupa Password untuk PANEL/ADMIN --}}
                                            <a href="{{ route('panel.forgotPassword') }}" class="text-muted">Lupa password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" placeholder="Masukkan password" name="password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script> LBB Cendekia</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection

