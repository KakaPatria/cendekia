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
        background-image: url("{{ asset('assets/images/bg_registerrrr.jpg') }}");
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email-input" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                            <button type="button" class="btn btn-outline-primary" id="verify-email-btn" onclick="verifyEmailRealtime()">
                                <i class="bi bi-shield-check"></i> Verifikasi
                            </button>
                        </div>
                        <div id="email-status" class="mt-2" style="display:none;"></div>
                        
                        <!-- Input OTP (hidden by default) -->
                        <div id="otp-container" class="mt-3" style="display:none;">
                            <label for="otp-input" class="form-label">Kode OTP <span class="text-danger">*</span></label>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" id="otp-input" placeholder="Masukkan 6 digit kode OTP" maxlength="6" pattern="[0-9]{6}">
                                <button type="button" class="btn btn-success" id="verify-otp-btn" onclick="verifyOTP()">
                                    <i class="bi bi-check-circle"></i> Cek OTP
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Kode OTP telah dikirim ke email Anda. Cek inbox atau folder spam.
                            </small>
                            <div id="otp-status" class="mt-2" style="display:none;"></div>
                        </div>
                        
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Klik "Verifikasi" untuk menerima kode OTP</small>
                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon/WhatsApp</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('telepon') }}">
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
<script>
    // Email verification function
    let emailVerified = false;
    let otpVerified = false;

    function verifyEmailRealtime() {
        const emailInput = document.getElementById('email-input');
        const verifyBtn = document.getElementById('verify-email-btn');
        const statusDiv = document.getElementById('email-status');
        const otpContainer = document.getElementById('otp-container');
        const email = emailInput.value.trim();

        if (!email) {
            statusDiv.innerHTML = '<div class="alert alert-warning py-2"><i class="bi bi-exclamation-circle"></i> Masukkan email terlebih dahulu</div>';
            statusDiv.style.display = 'block';
            return;
        }

        // Disable button and show loading
        verifyBtn.disabled = true;
        verifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Mengirim...';
        statusDiv.style.display = 'block';
        statusDiv.innerHTML = '<div class="alert alert-info py-2"><i class="bi bi-hourglass-split"></i> Memverifikasi email dan mengirim OTP...</div>';

        // Send verification request
        fetch('{{ route("verify.email.realtime") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid && data.otp_sent) {
                // Email valid dan OTP terkirim
                statusDiv.innerHTML = `
                    <div class="alert alert-success py-2">
                        <i class="bi bi-check-circle-fill"></i> ${data.message}
                        <small class="d-block mt-1">Provider: ${data.provider}</small>
                    </div>
                `;
                emailInput.classList.remove('is-invalid');
                emailInput.classList.add('is-valid');
                verifyBtn.innerHTML = '<i class="bi bi-envelope-check"></i> OTP Terkirim';
                verifyBtn.classList.remove('btn-outline-primary');
                verifyBtn.classList.add('btn-info');
                emailVerified = true;
                
                // Tampilkan input OTP
                otpContainer.style.display = 'block';
                document.getElementById('otp-input').focus();
            } else {
                // Email invalid
                statusDiv.innerHTML = `
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-x-circle-fill"></i> ${data.message}
                    </div>
                `;
                emailInput.classList.remove('is-valid');
                emailInput.classList.add('is-invalid');
                verifyBtn.innerHTML = '<i class="bi bi-shield-check"></i> Verifikasi';
                verifyBtn.disabled = false;
                emailVerified = false;
                otpContainer.style.display = 'none';
            }
        })
        .catch(error => {
            statusDiv.innerHTML = '<div class="alert alert-danger py-2"><i class="bi bi-exclamation-triangle"></i> Terjadi kesalahan. Periksa koneksi internet Anda.</div>';
            verifyBtn.innerHTML = '<i class="bi bi-shield-check"></i> Verifikasi';
            verifyBtn.disabled = false;
            emailVerified = false;
        });
    }

    function verifyOTP() {
        const emailInput = document.getElementById('email-input');
        const otpInput = document.getElementById('otp-input');
        const verifyOtpBtn = document.getElementById('verify-otp-btn');
        const otpStatusDiv = document.getElementById('otp-status');
        const email = emailInput.value.trim();
        const otp = otpInput.value.trim();

        if (!otp || otp.length !== 6) {
            otpStatusDiv.innerHTML = '<div class="alert alert-warning py-2"><i class="bi bi-exclamation-circle"></i> Masukkan 6 digit kode OTP</div>';
            otpStatusDiv.style.display = 'block';
            return;
        }

        // Disable button and show loading
        verifyOtpBtn.disabled = true;
        verifyOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memeriksa...';
        otpStatusDiv.style.display = 'block';
        otpStatusDiv.innerHTML = '<div class="alert alert-info py-2"><i class="bi bi-hourglass-split"></i> Memverifikasi kode OTP...</div>';

        // Send OTP verification request
        fetch('{{ route("verify.otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email, otp: otp })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                // OTP benar
                otpStatusDiv.innerHTML = `
                    <div class="alert alert-success py-2">
                        <i class="bi bi-check-circle-fill"></i> ${data.message}
                    </div>
                `;
                otpInput.classList.remove('is-invalid');
                otpInput.classList.add('is-valid');
                verifyOtpBtn.innerHTML = '<i class="bi bi-check-lg"></i> Terverifikasi';
                verifyOtpBtn.disabled = true;
                otpInput.disabled = true;
                otpVerified = true;
                
                // Enable submit button
                const submitBtn = document.querySelector('.btn-submit');
                if (submitBtn) {
                    submitBtn.disabled = false;
                }
            } else {
                // OTP salah
                otpStatusDiv.innerHTML = `
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-x-circle-fill"></i> ${data.message}
                    </div>
                `;
                otpInput.classList.remove('is-valid');
                otpInput.classList.add('is-invalid');
                verifyOtpBtn.innerHTML = '<i class="bi bi-check-circle"></i> Cek OTP';
                verifyOtpBtn.disabled = false;
                otpVerified = false;
            }
        })
        .catch(error => {
            otpStatusDiv.innerHTML = '<div class="alert alert-danger py-2"><i class="bi bi-exclamation-triangle"></i> Terjadi kesalahan. Silakan coba lagi.</div>';
            verifyOtpBtn.innerHTML = '<i class="bi bi-check-circle"></i> Cek OTP';
            verifyOtpBtn.disabled = false;
            otpVerified = false;
        });
    }

    // Prevent form submission if email/OTP not verified
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const emailInput = document.getElementById('email-input');
        const verifyBtn = document.getElementById('verify-email-btn');
        const statusDiv = document.getElementById('email-status');
        const otpContainer = document.getElementById('otp-container');

        form.addEventListener('submit', function(e) {
            if (!emailVerified) {
                e.preventDefault();
                alert('Silakan verifikasi email Anda terlebih dahulu dengan klik tombol "Verifikasi"');
                return false;
            }
            if (!otpVerified) {
                e.preventDefault();
                alert('Silakan masukkan dan verifikasi kode OTP yang telah dikirim ke email Anda');
                return false;
            }
        });

        emailInput.addEventListener('input', function() {
            emailInput.classList.remove('is-valid', 'is-invalid');
            statusDiv.style.display = 'none';
            otpContainer.style.display = 'none';
            verifyBtn.innerHTML = '<i class="bi bi-shield-check"></i> Verifikasi';
            verifyBtn.classList.remove('btn-info', 'btn-success');
            verifyBtn.classList.add('btn-outline-primary');
            verifyBtn.disabled = false;
            emailVerified = false;
            otpVerified = false;
            
            // Reset OTP input
            document.getElementById('otp-input').value = '';
            document.getElementById('otp-input').classList.remove('is-valid', 'is-invalid');
            document.getElementById('otp-status').style.display = 'none';
        });
    });
</script>
@endsection