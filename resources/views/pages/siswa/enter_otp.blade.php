@extends('layouts.master-without-nav')
@section('title', 'Verifikasi OTP')
@section('css')
<style>
    /* Mengadopsi style dari halaman Lupa Password & Login */
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
        background: rgba(255, 255, 255, 0.75); /* Sedikit lebih tebal agar teks lebih jelas */
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
    
    /* [IMPROVEMENT] Styling untuk input OTP */
    .otp-input-group {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .otp-input {
        width: 45px;
        height: 50px;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 600;
        border-radius: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.5);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .otp-input:focus {
        border-color: #980000;
        box-shadow: 0 0 0 0.2rem rgba(152, 0, 0, 0.15);
        outline: none;
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
                                <h4 class="text-dark mt-4">Verifikasi Email Anda</h4>
                                <p class="text-muted">Masukkan 6 digit kode OTP yang telah kami kirimkan ke email <strong>{{ $email }}</strong>.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('siswa.verifyOtp') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    
                                    {{-- [IMPROVEMENT] Input OTP 6 digit --}}
                                    <div class="mb-4">
                                        <label for="otp-input-1" class="form-label text-center d-block">Kode OTP</label>
                                        <div class="otp-input-group">
                                            <input type="text" class="form-control otp-input" id="otp-input-1" name="otp[]" maxlength="1" required>
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                        </div>
                                        {{-- Input tersembunyi untuk menampung gabungan OTP --}}
                                        <input type="hidden" name="otp" id="otp-full">
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Verifikasi</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-muted">Tidak menerima kode? <a href="#" class="fw-semibold text-decoration-underline" style="color: #980000;">Kirim ulang</a></p>
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
    const inputs = document.querySelectorAll('.otp-input');
    const form = document.querySelector('form');
    const otpFullInput = document.getElementById('otp-full');

    inputs.forEach((input, index) => {
        input.addEventListener('keyup', (e) => {
            const currentInput = input;
            const nextInput = input.nextElementSibling;
            const prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = currentInput.value.slice(-1);
            }

            // Pindah ke input selanjutnya jika sudah diisi
            if (currentInput.value !== '' && nextInput && index < inputs.length - 1) {
                nextInput.focus();
            }

            // Pindah ke input sebelumnya jika backspace ditekan
            if (e.key === 'Backspace' && prevInput && index > 0) {
                prevInput.focus();
            }
        });

        // Menangani paste OTP
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text');
            const otpDigits = pasteData.split('');

            for(let i=0; i < inputs.length; i++){
                if(otpDigits[i]){
                    inputs[i].value = otpDigits[i];
                }
            }
            // Pindahkan fokus ke input terakhir
            inputs[inputs.length - 1].focus();
        });
    });

    // Menggabungkan nilai OTP sebelum submit
    form.addEventListener('submit', () => {
        let otpValue = '';
        inputs.forEach(input => {
            otpValue += input.value;
        });
        otpFullInput.value = otpValue;
    });
});
</script>
@endsection