@extends('layouts.master-without-nav')
@section('title')
    Pendaftaran Akun Pengajar
@endsection
@section('css')
<style>
    /* Custom Styling Sesuai Desain Registrasi Siswa */
    :root {
        --primary-red: #980000;
        --border-color: #dee2e6;
        --text-muted: #6c757d;
    }
    body {
        background-color: #E9EBF1;
    }
    .auth-page-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem;
    }
    .register-container {
        display: flex;
        width: 100%;
        max-width: 1100px;
        min-height: 700px; /* Disesuaikan agar pas */
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 8px solid white;
    }
    .left-panel {
        flex: 1;
        background-image: url("{{ asset('assets/images/bg-login.jpg') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-start;
        padding: 3rem;
        border-radius: 1rem;
    }
    .left-panel .logo img {
        height: 50px;
        filter: drop-shadow(0 2px 3px rgba(0,0,0,0.3));
    }
    .right-panel {
        flex: 1;
        padding: 2rem 4rem;
        display: flex;
        flex-direction: column;
    }
    .form-header h3 {
        font-weight: 700;
        color: #333;
    }
    .form-header p {
        color: var(--text-muted);
        margin-bottom: 2rem;
    }
    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #495057;
        margin-bottom: 0.25rem;
    }
    .form-control {
        height: 50px !important;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background-color: #f3f3f9;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    .form-control:focus {
        border-color: var(--primary-red);
        background-color: #fff;
        box-shadow: none;
    }
    .btn-submit {
        height: 50px;
        border-radius: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        background-color: var(--primary-red);
        border: none;
    }
    .btn-submit:hover {
        background-color: #800000;
    }
    .form-footer {
        margin-top: auto;
        text-align: center;
        padding-top: 1.5rem;
    }
    .invalid-feedback {
        font-size: 0.875em;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="auth-page-wrapper">
    <div class="register-container">
        <div class="left-panel">
            <div class="logo">
                <a href="/"><img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia"></a>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-header">
                <h3>Selamat Datang, Calon Pengajar!</h3>
                <p>Daftar untuk menjadi bagian dari tim pengajar LBB Cendekia.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.pengajar') }}">
                @csrf
                <div class="row gx-3">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap Sesuai KTP" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email aktif" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon/WhatsApp</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Contoh: 08123456789" value="{{ old('telepon') }}">
                        @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ketik ulang password" required>
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button class="btn btn-danger btn-submit" type="submit">Daftar</button>
                </div>
            </form>
            
            <div class="form-footer">
                <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-underline" style="color: var(--primary-red);">Masuk</a></p>
            </div>
        </div>
    </div>
</div>
@endsection