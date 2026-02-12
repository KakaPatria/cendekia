@extends('layouts.master-without-nav')
@section('title')
    Daftar Akun Baru
@endsection
@section('css')
{{-- Link untuk Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 0;
        background-image: url('{{ asset('assets/images/bg-login.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    /* Efek Glassmorphism pada Card */
    .card {
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.8);
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
    .form-control, .select2-container .select2-selection--single {
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
        height: 45px !important;
        padding: 0.5rem 1rem;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 35px !important;
        padding-left: 0 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 45px !important;
    }

    /* Style untuk form wizard/multi-langkah */
    .form-step {
        display: none;
        animation: fadeIn 0.5s ease-in-out;
    }
    .form-step.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Progress Bar */
    .progress-bar-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        position: relative;
    }
    .progress-step {
        width: 30px;
        height: 30px;
        background-color: #e0e0e0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        z-index: 2;
        transition: background-color 0.4s ease;
        font-size: 0.8rem;
    }
    .progress-step.active {
        background-color: #980000; /* Warna merah Cendekia */
    }
    .progress-line {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #e0e0e0;
        z-index: 1;
        transform: translateY(-50%);
    }
    .progress-line-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background-color: #980000;
        width: 0%;
        transition: width 0.4s ease;
    }
    
    .invalid-feedback {
        font-size: 0.875em;
        font-weight: 500;
    }

    .btn-gradient-danger {
        border: none;
        background-image: linear-gradient(to right, #EE5A24 0%, #980000 50%, #EE5A24 100%);
        background-size: 200% auto;
        color: white !important;
        transition: all 0.5s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-gradient-danger:hover {
        background-position: right center;
        transform: translateY(-3px);
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        transition: all 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        transform: translateY(-2px);
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
                                <h4 class="text-dark mt-4">Buat Akun Baru</h4>
                                <p class="text-muted">Jadilah bagian dari LBB Cendekia sekarang!</p>
                            </div>

                            <div class="progress-bar-container">
                                <div class="progress-line"><div class="progress-line-fill"></div></div>
                                <div class="progress-step active" data-title="Info Akun">1</div>
                                <div class="progress-step" data-title="Data Diri">2</div>
                                <div class="progress-step" data-title="Info Sekolah">3</div>
                            </div>
                            
                            @include('components.message')

                            <form action="{{ route('siswa.doRegister') }}" method="POST" id="registerForm">
                                @csrf

                                <div class="form-step active">
                                    <h5 class="text-center mb-4 fs-16 text-muted">Langkah 1: Informasi Akun</h5>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" id="password-input" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="password-confirmation-input">Konfirmasi Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" name="password_confirmation" placeholder="Ulangi password" id="password-confirmation-input" required>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-gradient-danger btn-lg" type="button" onclick="nextStep()">Selanjutnya</button>
                                    </div>
                                </div>

                                <div class="form-step">
                                    <h5 class="text-center mb-4 fs-16 text-muted">Langkah 2: Data Diri & Orang Tua</h5>
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Telepon Siswa</label>
                                        <input type="number" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Contoh: 08123456789" value="{{ old('telepon') }}" required>
                                        @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat" value="{{ old('alamat') }}" required>
                                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
                                        <input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" id="nama_orang_tua" name="nama_orang_tua" placeholder="Masukkan Nama Orang Tua" value="{{ old('nama_orang_tua') }}" required>
                                        @error('nama_orang_tua')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="telp_orang_tua" class="form-label">Telepon Orang Tua</label>
                                        <input type="number" class="form-control @error('telp_orang_tua') is-invalid @enderror" id="telp_orang_tua" name="telp_orang_tua" placeholder="Masukkan Telepon Orang Tua" value="{{ old('telp_orang_tua') }}" required>
                                        @error('telp_orang_tua')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="d-flex justify-content-between gap-2">
                                        <button class="btn btn-secondary" type="button" onclick="prevStep()">Kembali</button>
                                        <button class="btn btn-gradient-danger" type="button" onclick="nextStep()">Selanjutnya</button>
                                    </div>
                                </div>

                                <div class="form-step">
                                    <h5 class="text-center mb-4 fs-16 text-muted">Langkah 3: Informasi Sekolah</h5>
                                    <div class="mb-3">
                                        <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                        <select class="form-control select2 @error('asal_sekolah') is-invalid @enderror" name="asal_sekolah" id="asal_sekolah" style="width: 100%;" required>
                                        </select>
                                        @error('asal_sekolah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="jenjang" class="form-label">Jenjang</label>
                                            <select id="jenjang" class="form-control @error('jenjang') is-invalid @enderror" name="jenjang" required>
                                                <option value="" selected disabled>Pilih</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                            </select>
                                             @error('jenjang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select id="kelas" class="form-control @error('kelas') is-invalid @enderror" name="kelas" disabled required>
                                                <option value="">Pilih Jenjang Dulu</option>
                                            </select>
                                            @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div> 
                                    <div class="d-flex justify-content-between gap-2">
                                        <button class="btn btn-secondary" type="button" onclick="prevStep()">Kembali</button>
                                        <button class="btn btn-gradient-danger w-100 btn-lg" type="submit">Daftar Sekarang</button>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="mt-4 text-center">
                                <p class="mb-0 text-muted">Sudah Punya Akun? <a href="{{ route('login') }}" class="fw-semibold text-decoration-underline" style="color: #980000;"> Masuk di Sini </a></p>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const progressLineFill = document.querySelector('.progress-line-fill');

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        updateProgress(stepIndex);
        // If we're showing the "Informasi Sekolah" step (index 2), ensure Select2 is initialized
        // Initializing Select2 on elements that are hidden (display: none) can cause width/position bugs.
        if (stepIndex === 2) {
            initAsalSekolahSelect2();
        }
    }

    function updateProgress(stepIndex) {
        progressSteps.forEach((step, index) => {
            step.classList.toggle('active', index <= stepIndex);
        });
        const progressPercentage = (stepIndex / (steps.length - 1)) * 100;
        progressLineFill.style.width = progressPercentage + '%';
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

    // Jika ada error validasi dari server, tampilkan step yang relevan
    document.addEventListener('DOMContentLoaded', function() {
        const errorFields = {
            'name': 0, 'email': 0, 'password': 0,
            'telepon': 1, 'alamat': 1, 'nama_orang_tua': 1, 'telp_orang_tua': 1,
            'asal_sekolah': 2, 'jenjang': 2, 'kelas': 2
        };
        let errorStep = -1;
        @if ($errors->any())
            const errorKeys = Object.keys(@json($errors->getMessages()));
            for(let key of errorKeys) {
                if (errorFields.hasOwnProperty(key)) {
                    errorStep = errorFields[key];
                    break;
                }
            }
            if(errorStep !== -1){
                currentStep = errorStep;
                showStep(currentStep);
            }
        @endif
    });

    $(document).ready(function() {
        // Defer Select2 initialization until the step is visible to avoid rendering bugs
        function initAsalSekolahSelect2() {
            // Prevent double initialization
            if ($.fn.select2 && $('#asal_sekolah').data('select2')) {
                return;
            }

            $('#asal_sekolah').select2({
                placeholder: "Cari & Pilih Sekolah",
                allowClear: true,
                tags: true, // Izinkan pengguna menambah sekolah baru
                minimumInputLength: 1,
                dropdownParent: $('body'), // append dropdown to body to avoid clipping/overflow issues
                ajax: {
                    url: '{{ route('ajax.cari-sekolah') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { q: params.term };
                    },
                    processResults: function(data) {
                        return { results: data };
                    },
                    cache: true
                },
                width: '100%'
            });
        }

        // If the page was loaded and the currentStep is already the sekolah step (due to validation errors), init Select2
        if (currentStep === 2) {
            initAsalSekolahSelect2();
        }

        // Logika untuk mengubah pilihan kelas berdasarkan jenjang
        const classes = {
            SD: ['1', '2', '3', '4', '5', '6'],
            SMP: ['7', '8', '9'],
            SMA: ['10', '11', '12']
        };
        $('#jenjang').change(function() {
            var schoolLevel = $(this).val();
            var $classLevel = $('#kelas');
            $classLevel.empty().append('<option value="" selected disabled>Pilih Kelas</option>');
            if (schoolLevel && classes[schoolLevel]) {
                $classLevel.prop('disabled', false);
                classes[schoolLevel].forEach(function(classItem) {
                    $classLevel.append($('<option>', {
                        value: classItem,
                        text: `Kelas ${classItem}`
                    }));
                });
            } else {
                $classLevel.prop('disabled', true).empty().append('<option value="">Pilih Jenjang Dulu</option>');
            }
        });
    });
</script>
@endsection