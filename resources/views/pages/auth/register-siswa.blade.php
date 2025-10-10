@extends('layouts.master-without-nav')
@section('title')
    Daftar Akun Siswa
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom Styling Sesuai Desain */
    :root {
        --primary-red: #980000;
        --border-color: #dee2e6;
        --text-muted: #6c757d;
    }
    body {
        background-color: #E9EBF1; /* Warna background abu-abu kebiruan */
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
        background-image: url("{{ asset('assets/images/bg-login.jpg') }}");
        background-size: cover;
        background-position: center;
        position: relative;
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
    .btn-next, .btn-submit {
        height: 50px;
        border-radius: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .btn-submit {
        background-color: var(--primary-red);
        border: none;
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
@section('css')
<style>
    /* Custom Styling Sesuai Desain Baru */
    :root {
        --primary-red: #980000;
        --primary-yellow: #E2B602;
        --border-color: #dee2e6;
        --text-muted: #6c757d;
    }
    
    body {
        background-color: #f8f9fa; /* Warna background abu-abu muda */
    }

    .auth-page-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .register-container {
        display: flex;
        width: 100%;
        max-width: 1100px;
        min-height: 700px;
        background-color: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .left-panel {
        flex: 1;
        background-image: url("{{ asset('assets/images/bg-login.jpg') }}"); /* Ganti dengan path gambar Anda */
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 3rem;
    }
    
    .left-panel .logo img {
        height: 50px;
    }

    .right-panel {
        flex: 1;
        padding: 3rem 4rem;
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
        font-size: 0.9rem;
        color: #495057;
    }
    
    .form-control, .form-select {
        height: 50px;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-red);
        background-color: #fff;
        box-shadow: none;
    }
    
    /* Wizard Steps */
    .form-step {
        display: none;
        animation: fadeIn 0.5s;
    }
    .form-step.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-next, .btn-submit {
        height: 50px;
        border-radius: 0.5rem;
        font-weight: 600;
    }
    
    .btn-submit {
        background-color: var(--primary-red);
        border: none;
    }
    
    .btn-back {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-weight: 600;
    }

    .form-footer {
        margin-top: auto;
        text-align: center;
        padding-top: 1.5rem;
    }
</style>
@endsection
@section('css')
<style>
    /* Custom Styling Sesuai Desain Baru */
    :root {
        --primary-red: #980000;
        --primary-yellow: #E2B602;
        --border-color: #dee2e6;
        --text-muted: #6c757d;
    }
    
    body {
        background-color: #f8f9fa; /* Warna background abu-abu muda */
    }

    .auth-page-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .register-container {
        display: flex;
        width: 100%;
        max-width: 1100px;
        min-height: 700px;
        background-color: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .left-panel {
        flex: 1;
        background-image: url("{{ asset('assets/images/bg-login.jpg') }}"); /* Ganti dengan path gambar Anda */
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 3rem;
    }
    
    .left-panel .logo img {
        height: 50px;
    }

    .right-panel {
        flex: 1;
        padding: 3rem 4rem;
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
        font-size: 0.9rem;
        color: #495057;
    }
    
    .form-control, .form-select {
        height: 50px;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-red);
        background-color: #fff;
        box-shadow: none;
    }
    
    /* Wizard Steps */
    .form-step {
        display: none;
        animation: fadeIn 0.5s;
    }
    .form-step.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-next, .btn-submit {
        height: 50px;
        border-radius: 0.5rem;
        font-weight: 600;
    }
    
    .btn-submit {
        background-color: var(--primary-red);
        border: none;
    }
    
    .btn-back {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-weight: 600;
    }

    .form-footer {
        margin-top: auto;
        text-align: center;
        padding-top: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="auth-page-wrapper">
    <div class="register-container">
        <div class="left-panel">
            <div class="logo">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <a href="/"><img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia"></a>
            </div>
=======
=======
>>>>>>> Stashed changes
                <a href="/">
                    <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia">
                </a>
            </div>
            {{-- Bisa ditambahkan teks atau elemen lain di sini jika perlu --}}
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        </div>

        <div class="right-panel">
            <div class="form-header">
                <h3>Selamat Datang di LBB Cendekia!</h3>
                <p>Daftar Akun LBB Cendekia</p>
            </div>

            @if ($errors->any())
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="alert alert-danger py-2 mb-4">
=======
                <div class="alert alert-danger py-2">
>>>>>>> Stashed changes
=======
                <div class="alert alert-danger py-2">
>>>>>>> Stashed changes
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.siswa') }}">
                @csrf
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="form-step active" id="step1">
                    <div class="row gx-3">
                        <div class="col-12 mb-3"><label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required></div>
                        <div class="col-12 mb-3"><label for="email" class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required></div>
                        <div class="col-12 mb-3"><label for="telepon" class="form-label">Nomor Telepon</label><input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('telepon') }}"></div>
=======
=======
>>>>>>> Stashed changes

                <div class="form-step active" id="step1">
                    <div class="row">
                        <div class="col-12 mb-3"><label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required></div>
                        <div class="col-12 mb-3"><label for="email" class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required></div>
                        <div class="col-12 mb-3"><label for="telepon" class="form-label">Nomor Telepon</label><input type="text" class="form-control" name="telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('telepon') }}"></div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                        <div class="col-12 mb-3"><label for="nama_orang_tua" class="form-label">Nama Orang Tua</label><input type="text" class="form-control" name="nama_orang_tua" placeholder="Masukkan Nama Orang Tua" value="{{ old('nama_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="telp_orang_tua" class="form-label">Nomor Telepon Orang Tua</label><input type="text" class="form-control" name="telp_orang_tua" placeholder="Masukkan Nomor Telepon Orang Tua" value="{{ old('telp_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="alamat" class="form-label">Alamat</label><input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}"></div>
                    </div>
                    <div class="d-grid mt-3">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                        <button type="button" class="btn btn-warning btn-next" onclick="nextStep()" disabled>Next</button>
=======
                        <button type="button" class="btn btn-warning btn-next" onclick="nextStep()">Next</button>
>>>>>>> Stashed changes
                    </div>
                </div>
                
                <div class="form-step" id="step2">
<<<<<<< Updated upstream
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
                        <div class="col-12 mb-3">
                            <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" id="password-input" required>
                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                            </div>
                            @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control pe-5 password-input" name="password_confirmation" placeholder="Ketik ulang password" id="password-confirmation-input" required>
                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                            </div>
                        </div>
=======
                        <button type="button" class="btn btn-warning btn-next" onclick="nextStep()">Next</button>
>>>>>>> Stashed changes
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn-back" onclick="prevStep()">Back</button>
                        <button class="btn btn-danger btn-submit" type="submit" disabled>Daftar</button>
                    </div>
                </div>
<<<<<<< Updated upstream
=======
                
                <div class="form-step" id="step2">
=======
>>>>>>> Stashed changes
                    <div class="row">
                        <div class="col-12 mb-3"><label for="asal_sekolah" class="form-label">Asal Sekolah</label><input type="text" class="form-control" name="asal_sekolah" placeholder="Cari Asal Sekolah" value="{{ old('asal_sekolah') }}"></div>
                        <div class="col-md-6 mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select class="form-select" name="jenjang" id="jenjang">
                                <option value="" selected>Pilih Jenjang</option>
                                <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" id="kelas" disabled>
                                <option value="">Pilih Jenjang Dulu</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3"><label class="form-label" for="password">Password <span class="text-danger">*</span></label><input type="password" class="form-control" name="password" placeholder="Masukkan Password" required></div>
                        <div class="col-12 mb-3"><label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label><input type="password" class="form-control" name="password_confirmation" placeholder="Ketik Ulang Password" required></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn-back" onclick="prevStep()">Back</button>
                        <button class="btn btn-danger btn-submit" type="submit">Daftar</button>
                    </div>
                </div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            </form>
            
            <div class="form-footer">
                <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-underline" style="color: var(--primary-red);">Masuk</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- === [PERBAIKAN] Hapus pemanggilan file yang tidak ada === --}}
{{-- <script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script> --}}

=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');

<<<<<<< Updated upstream
<<<<<<< Updated upstream
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
=======
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
>>>>>>> Stashed changes
=======
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
<<<<<<< Updated upstream
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
        });

=======
=======
>>>>>>> Stashed changes
    document.addEventListener('DOMContentLoaded', function() {
>>>>>>> Stashed changes
        const jenjangDropdown = document.getElementById('jenjang');
        const kelasDropdown = document.getElementById('kelas');
        const kelasOptions = {
            'SD': ['1', '2', '3', '4', '5', '6'],
            'SMP': ['7', '8', '9'],
            'SMA': ['10', '11', '12']
        };

<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
        // Function to update 'kelas' dropdown
>>>>>>> Stashed changes
=======
        // Function to update 'kelas' dropdown
>>>>>>> Stashed changes
        function updateKelasDropdown() {
            const selectedJenjang = jenjangDropdown.value;
            kelasDropdown.innerHTML = '<option value="">Pilih Kelas</option>';
            if (selectedJenjang && kelasOptions[selectedJenjang]) {
                kelasDropdown.disabled = false;
                kelasOptions[selectedJenjang].forEach(function(kelas) {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = `Kelas ${kelas}`;
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
                    // Re-select old value if available
>>>>>>> Stashed changes
=======
                    // Re-select old value if available
>>>>>>> Stashed changes
                    if ('{{ old('kelas') }}' === kelas) {
                        option.selected = true;
                    }
                    kelasDropdown.appendChild(option);
                });
            } else {
                kelasDropdown.disabled = true;
                kelasDropdown.innerHTML = '<option value="">Pilih Jenjang Dulu</option>';
            }
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            validateStep(currentStep);
        }
        
=======
        }
        
        // Initial check in case of old input
>>>>>>> Stashed changes
=======
        }
        
        // Initial check in case of old input
>>>>>>> Stashed changes
        if (jenjangDropdown.value) {
            updateKelasDropdown();
        }
        
        jenjangDropdown.addEventListener('change', updateKelasDropdown);
<<<<<<< Updated upstream
<<<<<<< Updated upstream

        // === [PERBAIKAN] Tambahkan logika show/hide password di sini ===
        document.querySelectorAll('.password-addon').forEach(function (button) {
            button.addEventListener('click', function () {
                var passwordInput = this.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.querySelector('i').classList.remove('ri-eye-fill');
                    this.querySelector('i').classList.add('ri-eye-off-fill');
                } else {
                    passwordInput.type = 'password';
                    this.querySelector('i').classList.remove('ri-eye-off-fill');
                    this.querySelector('i').classList.add('ri-eye-fill');
                }
            });
        });
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    });
</script>
@endsection