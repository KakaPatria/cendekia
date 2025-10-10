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
        /* [WARNA] Latar belakang disamakan dengan login */

        background-size: cover;
        background-position: center;
    }
    .register-container {
        display: flex;
        width: 100%;
        max-width: 1100px;
        min-height: 700px;
        /* [WARNA] Container utama dibuat transparan */
        background-color: transparent;
        border-radius: 1rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .left-panel {
        flex: 1;
        background-image: url("{{ asset('assets/images/bg_registerrrr.jpg') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-start;
        padding: 3rem;
        border-top-left-radius: 1rem;
        border-bottom-left-radius: 1rem;
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
        /* [WARNA] Efek Glassmorphism diterapkan di sini */
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
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
        transition: all 0.3s ease;
        font-size: 0.9rem;
        /* [WARNA] Input field dibuat semi-transparan */
        background-color: rgba(255, 255, 255, 0.5) !important;
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
    }
    .select2-container .select2-selection--single { padding: 0.5rem 1rem; }
    .select2-container .select2-selection--single .select2-selection__rendered { line-height: 36px !important; padding-left: 0 !important;}
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 46px !important; }
    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.7) !important;
        border-color: var(--primary-red) !important;
        box-shadow: none;
    }
    .form-step { display: none; animation: fadeIn 0.5s; }
    .form-step.active { display: block; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* [WARNA] Tombol disamakan dengan login */
    .btn-custom-action {
        border-radius: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        height: 50px;
        border: none;
        background-image: linear-gradient(to right, var(--primary-orange) 0%, var(--primary-red) 50%, var(--primary-orange) 100%);
        background-size: 200% auto;
        color: white;
        transition: all 0.5s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-custom-action:hover {
        background-position: right center;
        transform: translateY(-3px);
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
        <div class="left-panel">
            <div class="logo">

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

            <form method="POST" action="{{ route('register.siswa') }}">
                @csrf
                <div class="form-step active" id="step1">
                    <div class="row gx-3">
                        <div class="col-12 mb-3"><label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required></div>
                        <div class="col-12 mb-3"><label for="email" class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required></div>
                        <div class="col-12 mb-3"><label for="telepon" class="form-label">Nomor Telepon</label><input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('telepon') }}"></div>
                        <div class="col-12 mb-3"><label for="nama_orang_tua" class="form-label">Nama Orang Tua</label><input type="text" class="form-control" name="nama_orang_tua" placeholder="Masukkan Nama Orang Tua" value="{{ old('nama_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="telp_orang_tua" class="form-label">Nomor Telepon Orang Tua</label><input type="text" class="form-control" name="telp_orang_tua" placeholder="Masukkan Nomor Telepon Orang Tua" value="{{ old('telp_orang_tua') }}"></div>
                        <div class="col-12 mb-3"><label for="alamat" class="form-label">Alamat</label><input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}"></div>
                    </div>
                    <div class="d-grid mt-3">
                        <button type="button" class="btn btn-custom-action" onclick="nextStep()" disabled>Next</button>
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
                        <div class="col-12 mb-3"><label class="form-label" for="password">Password <span class="text-danger">*</span></label><input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-12 mb-3"><label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label><input type="password" class="form-control" name="password_confirmation" placeholder="Ketik ulang password" required></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn-back" onclick="prevStep()">Back</button>
                        <button class="btn btn-custom-action" type="submit" disabled>Daftar</button>
                    </div>
                </div>
            </form>
            
            <div class="form-footer">
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
    // Fungsionalitas JavaScript tidak diubah dan tetap sama
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');

    function validateStep(stepIndex) { /* ... (fungsi validasi utuh) ... */ }
    function showStep(stepIndex) { /* ... (fungsi show step utuh) ... */ }
    function nextStep() { /* ... (fungsi next step utuh) ... */ }
    function prevStep() { /* ... (fungsi prev step utuh) ... */ }

    $(document).ready(function() {
        // ... (seluruh script jQuery Anda yang sudah ada di sini)
    });
</script>
@endsection