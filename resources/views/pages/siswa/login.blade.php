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
        background-image: url('{{ asset('assets/images/loginbaruu.png') }}');
        background-size: cover;
        background-position: center;
    }

    /* [IMPROVEMENT] Efek Glassmorphism pada Card */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        
        /* ==== DIBERI !important UNTUK MEMAKSA STYLE INI AKTIF ==== */
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
        color: white !important;
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

    /* ===== Disable native password reveal Edge ===== */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
        display: none;
    }

    /* Fix tampilan icon eye agar tidak seperti link */
    .password-addon {
        text-decoration: none !important;
        color: #6c757d !important; /* abu-abu halus seperti sebelumnya */
    }

    .password-addon:hover,
    .password-addon:focus,
    .password-addon:active {
        text-decoration: none !important;
        color: #495057 !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .password-addon i {
        font-size: 1.1rem;
        pointer-events: none;
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
                                <form action="{{ route('siswa.doLogin') }}" method="POST" id="loginForm">
                                    @csrf
                                    <input type="hidden" name="encrypted_data" id="encrypted_data">
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('siswa.forgotPassword') }}" class="text-muted">Lupa password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control form-control-lg pe-5 password-input" placeholder="Masukkan password" id="password-input" required>
                                            <button
                                                type="button"
                                                class="btn btn-link position-absolute end-0 top-50 translate-middle-y password-addon"
                                                style="z-index: 5;"
                                            >
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>

                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Masuk</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title text-muted">atau masuk dengan</h5>
                                        </div>
                                        <div>
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
                        <p class="mb-0 text-white">Belum Punya Akun? <a href="{{ route('register.siswa') }}" class="fw-semibold text-white text-decoration-underline"> Daftar Sekarang </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
<script>
// Enkripsi sederhana untuk menyembunyikan payload
function encryptData(data) {
    // Konversi object ke JSON string
    const jsonStr = JSON.stringify(data);
    
    // Base64 encoding + reverse string + tambah random prefix/suffix
    const encoded = btoa(jsonStr);
    const reversed = encoded.split('').reverse().join('');
    const randomPrefix = Math.random().toString(36).substring(2, 8);
    const randomSuffix = Math.random().toString(36).substring(2, 8);
    
    return randomPrefix + reversed + randomSuffix;
}

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password-input').value;
    
    // Buat object data
    const data = {
        email: email,
        password: password,
        timestamp: Date.now()
    };
    
    // Enkripsi data
    const encrypted = encryptData(data);
    
    // Set ke hidden input
    document.getElementById('encrypted_data').value = encrypted;
    
    // Clear original inputs sebelum submit
    document.getElementById('email').removeAttribute('name');
    document.getElementById('password-input').removeAttribute('name');
    
    // Submit form
    this.submit();
});
</script>
@endsection