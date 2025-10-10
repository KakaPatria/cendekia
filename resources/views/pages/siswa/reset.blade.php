@extends('layouts.master-without-nav')
@section('title', 'Verifikasi OTP')
@section('css')
<style>
    /* Mengadopsi style dari halaman login dengan !important */
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
                                <h4 class="text-dark mt-4">Verifikasi Email Anda</h4>
                                <p class="text-muted">Masukkan 6 digit kode OTP yang telah kami kirimkan ke email <strong>{{ $email ?? 'emailanda@example.com' }}</strong>.</p>
                            </div>

                            @include('components.message')

                            <div class="p-2">
                                <form action="{{ route('siswa.verifyOtp') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                    
                                    <div class="otp-input-group">
                                        @for ($i = 0; $i < 6; $i++)
                                            <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" required>
                                        @endfor
                                    </div>
                                    
                                    <input type="hidden" name="otp" id="otp-full">

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

            if (currentInput.value !== '' && nextInput && index < inputs.length - 1) {
                nextInput.focus();
            }

            if (e.key === 'Backspace' && !currentInput.value && prevInput && index > 0) {
                prevInput.focus();
            }
        });

        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text').slice(0, 6);
            const otpDigits = pasteData.split('');

            inputs.forEach((input, i) => {
                input.value = otpDigits[i] || '';
            });
            
            const lastFilledIndex = Math.min(otpDigits.length, inputs.length) - 1;
            if (lastFilledIndex >= 0) {
                inputs[lastFilledIndex].focus();
            }
        });
    });

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