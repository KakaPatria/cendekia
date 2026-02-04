@extends('layouts.master-without-nav')
@section('title')
    Pendaftaran Akun Siswa
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom Styling Sesuai Desain */
    :root {
        --primary-red: #980000;
        --primary-orange: #EE5A24;
        --border-color: #dee2e6;
        --text-muted: #6c757d;
        --bg-light-grey: #E9EBF1;
    }
    body {
        background-color: var(--bg-light-grey);
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
        min-height: 700px;
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 8px solid white;
    }
    .left-panel {
        flex: 1;
        background-image: url("{{ asset('assets/images/COBA-BG-REGIST.png') }}");
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: flex-start;
        padding: 3rem;
        border-radius: 1rem;
        will-change: transform;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
    .left-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s infinite;
        border-radius: 1rem;
        z-index: 0;
    }
    .left-panel.loaded::before {
        display: none;
    }
    .left-panel .logo {
        position: relative;
        z-index: 1;
    }
    .left-panel .logo img {
        height: 50px;
        filter: drop-shadow(0 2px 3px rgba(0,0,0,0.3));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .left-panel .logo img.loaded {
        opacity: 1;
    }
    .logo-skeleton {
        width: 150px;
        height: 50px;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s infinite;
        border-radius: 8px;
        display: inline-block;
    }
    .logo-skeleton.hidden {
        display: none;
    }
    @keyframes skeleton-loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
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
    .form-control, .form-select, .select2-container .select2-selection--single {
        height: 48px !important;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background-color: #f3f3f9;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    .select2-container .select2-selection--single { padding: 0.5rem 1rem; }
    .select2-container .select2-selection--single .select2-selection__rendered { line-height: 36px !important; padding-left: 0 !important;}
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 46px !important; }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-red);
        background-color: #fff;
        box-shadow: none;
    }
    .form-step { display: none; animation: fadeIn 0.5s; }
    .form-step.active { display: block; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* [PERBAIKAN] Mengembalikan gaya tombol gradasi */
    .btn-gradient-action {
        height: 50px;
        border-radius: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        border: none;
        background-image: linear-gradient(to right, var(--primary-orange) 0%, var(--primary-red) 50%, var(--primary-orange) 100%);
        background-size: 200% auto;
        color: white;
        transition: all 0.5s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-gradient-action:hover {
        background-position: right center;
        transform: translateY(-3px);
        color: white;
    }

    .btn-back {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
    }
    .form-footer {
        margin-top: auto;
        text-align: center;
        padding-top: 1.5rem;
    }
    .btn:disabled {
        cursor: not-allowed;
        opacity: 0.65;
    }
</style>
@endsection

@section('content')
<div class="auth-page-wrapper">
    <div class="register-container">
        <div class="left-panel" id="leftPanel">
            <div class="logo">
                <span class="logo-skeleton" id="logoSkeleton"></span>
                <a href="/"><img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia" loading="lazy" decoding="async" id="logoImage"></a>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-header">
                <h3>Selamat Datang di LBB Cendekia!</h3>
                <p>Daftar Akun LBB Cendekia</p>
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

            <form method="POST" action="{{ route('siswa.doRegister') }}">
                @csrf
                <div class="form-step active" id="step1">
                    <div class="row gx-3">
                        <div class="col-12 mb-3"><label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required></div>
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

                            <small class="text-muted"><i class="bi bi-info-circle"></i> Klik "Verifikasi" untuk menerima kode OTP di email Anda</small>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3"><label for="telepon" class="form-label">Nomor Telepon</label><input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('telepon') }}"></div>
                        <div class="col-12 mb-3"><label for="nama_orang_tua" class="form-label">Nama Orang Tua</label><input type="text" class="form-control" name="nama_orang_tua" placeholder="Masukkan Nama Orang Tua" value="{{ old('nama_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="telp_orang_tua" class="form-label">Nomor Telepon Orang Tua</label><input type="text" class="form-control" name="telp_orang_tua" placeholder="Masukkan Nomor Telepon Orang Tua" value="{{ old('telp_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="alamat" class="form-label">Alamat</label><input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}"></div>
                    </div>
                    <div class="d-grid mt-3">
                        {{-- [PERBAIKAN] Class tombol diubah --}}
                        <button type="button" class="btn btn-gradient-action btn-next" onclick="nextStep()" disabled>Next</button>
                    </div>
                </div>

                <div class="form-step" id="step2">
                    <div class="row gx-3">
                        <div class="col-12 mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="asal_sekolah" id="asal_sekolah" style="width:100%;" required>
                                @if(old('asal_sekolah'))<option selected value="{{ old('asal_sekolah') }}">{{ old('asal_sekolah') }}</option>@endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenjang" id="jenjang" required>
                                <option value="" selected disabled>Pilih Jenjang</option>
                                <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select class="form-select" name="kelas" id="kelas" disabled required>
                                <option value="">Pilih Jenjang Dulu</option>
                            </select>
                        </div>
                    <!-- <div class="col-md-6 mb-3">
                        <label for="golongan" class="form-label">Golongan <span class="text-danger">*</span></label>
                        <select class="form-select" name="golongan" id="golongan" required>
                            <option value="" selected disabled>Pilih Golongan</option>
                            <option value="A" {{ old('golongan') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('golongan') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('golongan') == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                    </div> -->
                        <div class="col-12 mb-3"><label class="form-label" for="password">Password <span class="text-danger">*</span></label><input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-12 mb-3"><label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label><input type="password" class="form-control" name="password_confirmation" placeholder="Ketik ulang password" required></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn-back" onclick="prevStep()">Back</button>
                        {{-- [PERBAIKAN] Class tombol diubah --}}
                        <button class="btn btn-gradient-action btn-submit" type="submit" disabled>Daftar</button>
                    </div>
                </div>
            </form>

            <divter">
                <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-underline" style="color: var(--primary-red);">Masuk</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');

    function validateStep(stepIndex) {
        const currentStepElement = steps[stepIndex];
        const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
        let isStepValid = true;
        inputs.forEach(input => {
            const isVisible = input.offsetParent !== null;
            if (isVisible && !input.value) {
                isStepValid = false;
            }
        });
        const nextButton = currentStepElement.querySelector('.btn-next, .btn-submit');
        if (nextButton) {
            nextButton.disabled = !isStepValid;
        }
    }

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
            if (step.classList.contains('active')) {
                validateStep(index);
                const inputs = step.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    const eventType = (input.tagName.toLowerCase() === 'select') ? 'change' : 'keyup';
                    input.addEventListener(eventType, () => validateStep(index));
                });
                $('#asal_sekolah').on('change', () => validateStep(index));
            }
        });
    }

    function nextStep() {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    $(document).ready(function() {
        showStep(0);

        $('#asal_sekolah').select2({
            placeholder: "Cari & Pilih Sekolah",
            allowClear: true,
            tags: true,
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('ajax.cari-sekolah') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return { results: data }; },
                cache: true
            },
            width: '100%'
        }).on('select2:select', function(e) {
            var data = e.params.data;
            var jenjang = data.jenjang || '';
            var $jenjangSelect = $('#jenjang');
            var $kelasSelect = $('#kelas');

            // Remove existing hidden input if any
            $('#hidden-jenjang').remove();

            if (jenjang && jenjang.trim() !== '') {
                // Jenjang tidak kosong, set value dan disable
                $jenjangSelect.val(jenjang).prop('disabled', true).trigger('change');
                // Add hidden input to ensure value is submitted
                $jenjangSelect.after('<input type="hidden" id="hidden-jenjang" name="jenjang" value="' + jenjang + '">');
            } else {
                // Jenjang kosong, enable untuk input manual
                $jenjangSelect.val('').prop('disabled', false);
                $kelasSelect.empty().append('<option value="">Pilih Jenjang Dulu</option>').prop('disabled', true);
            }

            updateKelasDropdown();
        }).on('select2:clear', function() {
            // Ketika asal sekolah dihapus, enable kembali jenjang
            $('#jenjang').val('').prop('disabled', false);
            $('#kelas').empty().append('<option value="">Pilih Jenjang Dulu</option>').prop('disabled', true);
            // Remove hidden input
            $('#hidden-jenjang').remove();
            validateStep(currentStep);
        });

        const jenjangDropdown = document.getElementById('jenjang');
        const kelasDropdown = document.getElementById('kelas');
        const kelasOptions = {
            'SD': ['1', '2', '3', '4', '5', '6'],
            'SMP': ['7', '8', '9'],
            'SMA': ['10', '11', '12']
        };

        function updateKelasDropdown() {
            const selectedJenjang = jenjangDropdown.value;
            kelasDropdown.innerHTML = '<option value="">Pilih Kelas</option>';
            if (selectedJenjang && kelasOptions[selectedJenjang]) {
                kelasDropdown.disabled = false;
                kelasOptions[selectedJenjang].forEach(function(kelas) {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = `Kelas ${kelas}`;
                    if ('{{ old('kelas') }}' === kelas) {
                        option.selected = true;
                    }
                    kelasDropdown.appendChild(option);
                });
            } else {
                kelasDropdown.disabled = true;
                kelasDropdown.innerHTML = '<option value="">Pilih Jenjang Dulu</option>';
            }
            validateStep(currentStep);
        }

        if (jenjangDropdown.value) {
            updateKelasDropdown();
        }

        jenjangDropdown.addEventListener('change', updateKelasDropdown);
    });

    // Image loading with skeleton
    document.addEventListener('DOMContentLoaded', function() {
        const leftPanel = document.getElementById('leftPanel');
        const logoImage = document.getElementById('logoImage');
        const logoSkeleton = document.getElementById('logoSkeleton');

        // Check if background image is loaded
        const bgImage = new Image();
        bgImage.src = "{{ asset('assets/images/COBA-BG-REGIST.png') }}";
        bgImage.onload = function() {
            leftPanel.classList.add('loaded');
        };

        // Check if logo is loaded
        if (logoImage.complete) {
            logoImage.classList.add('loaded');
            logoSkeleton.classList.add('hidden');
        } else {
            logoImage.addEventListener('load', function() {
                logoImage.classList.add('loaded');
                logoSkeleton.classList.add('hidden');
            });
        }
    });

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
                verifyOtpBtn.classList.remove('btn-success');
                verifyOtpBtn.classList.add('btn-success');
                verifyOtpBtn.disabled = true;
                otpInput.disabled = true;
                otpVerified = true;

                // Enable next button
                const nextBtn = document.querySelector('.btn-next');
                if (nextBtn) {
                    nextBtn.disabled = false;
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

    // Override nextStep function to check OTP verification
    const originalNextStep = window.nextStep;
    window.nextStep = function() {
        const currentStep = parseInt(document.querySelector('.form-step.active').id.replace('step', ''));

        if (currentStep === 1) {
            // Cek apakah email sudah diverifikasi dengan OTP
            if (!emailVerified) {
                alert('Silakan verifikasi email Anda terlebih dahulu dengan klik tombol "Verifikasi"');
                return false;
            }
            if (!otpVerified) {
                alert('Silakan masukkan dan verifikasi kode OTP yang telah dikirim ke email Anda');
                return false;
            }
        }

        // Call original nextStep function
        if (originalNextStep) {
            originalNextStep();
        }
    };

    // Reset verification when email changes
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email-input');
        const verifyBtn = document.getElementById('verify-email-btn');
        const statusDiv = document.getElementById('email-status');
        const otpContainer = document.getElementById('otp-container');

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
