@extends('layouts.master-without-nav')
@section('title') Landing @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->

<style>

    /*Animasi hubungi*/
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Animasi & styling bagian contact */
    .contact-title {
        position: relative;
    }


    .contact-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .contact-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: #28a745;
    }

    .contact-icon {
        transition: all 0.3s ease;
    }

    .contact-card:hover .contact-icon {
        transform: scale(1.1);
        color: #28a745 !important;
    }

    .contact-card:hover .contact-icon i {
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 20%, 60%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        80% {
            transform: translateY(-5px);
        }
    }

    .contact-item {
        margin-bottom: 20px;

    }

    /* Animasi fade in */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .contact-item:nth-child(1) { animation-delay: 0.1s; }
    .contact-item:nth-child(2) { animation-delay: 0.2s; }
    .contact-item:nth-child(3) { animation-delay: 0.3s; }
    .contact-item:nth-child(4) { animation-delay: 0.4s; }
    .contact-item:nth-child(5) { animation-delay: 0.5s; }
    .contact-item:nth-child(6) { animation-delay: 0.6s; }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-card:hover {
            transform: translateY(-4px) scale(1.01);
        }
    }

    /* Styling tambahan untuk footer */
    .footer-title {
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        color: white !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
        margin-bottom: 1.2rem !important;
    }
    
    .footer-content-text {
        font-size: 0.85rem !important;
        line-height: 1.4 !important;
        color: rgba(255,255,255,0.9) !important;
    }
    
    .contact-label {
        font-size: 0.75rem !important;
        color: rgba(255,255,255,0.7) !important;
        margin-bottom: 0.1rem !important;
        text-transform: uppercase !important;
    }
    
    .contact-value {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        color: white !important;
    }
    
    .hours-day {
        font-size: 0.85rem !important;
        font-weight: 600 !important;
    }
    
    .hours-time {
        font-size: 0.8rem !important;
        color: rgba(255,255,255,0.9) !important;
    }
    
    .address-label {
        font-size: 0.75rem !important;
        color: rgba(255,255,255,0.7) !important;
        margin-bottom: 0.2rem !important;
        text-transform: uppercase !important;
    }
    
    .address-value {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        line-height: 1.3 !important;
        color: white !important;
    }
    
    .map-hint {
        font-size: 0.7rem !important;
        color: rgba(255,255,255,0.6) !important;
        margin-top: 0.2rem !important;
        font-style: italic !important;
        text-transform: uppercase !important;
    }

    /* Animasi pulse */
    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255,255,255,0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(255,255,255,0.1);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255,255,255,0);
        }
    }

    .phone-contact {
        position: relative;
        overflow: hidden;
    }

    .phone-contact::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .phone-contact:hover::after {
        left: 100%;
    }

    .address-item {
        position: relative;
    }

    .address-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: rgba(255,255,255,0.1);
        transition: width 0.3s ease;
    }

    .address-item:hover::before {
        width: 100%;
    }

    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .contact-item:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important;
        border-color: rgba(255,255,255,0.3) !important;
    }


    /* ========== NAVBAR MODERN UPGRADE ========== */
.navbar-landing {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease !important;
}

/* Modern Navigation Links */
.navbar-nav .nav-link {
    position: relative !important;
    font-weight: 500 !important;
    font-size: 0.95rem !important;
    color: #2c3e50 !important;
    padding: 0.8rem 1.2rem !important;
    margin: 0 0.3rem !important;
    border-radius: 25px !important;
    transition: all 0.3s ease !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

/* Active State dengan Gradient */
.navbar-nav .nav-link.active {
    background: linear-gradient(135deg, ##2c2b29ff 0%, #2c2b29ff 100%) !important;
    color: #2c2b29ff !important;
    box-shadow: 0 4px 15px rgba(32, 30, 30, 0.2) !important;
    transform: translateY(-2px) !important;
}

/* Hover Effect */
.navbar-nav .nav-link:hover:not(.active) {
    background: rgba(46, 54, 57, 0.1) !important;
    color: #000000ff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

/* Logo Enhancement */
.navbar-brand img {
    transition: transform 0.3s ease !important;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)) !important;
}

.navbar-brand:hover img {
    transform: scale(1.1) !important;
}

/* Modern Login Button */
.btn-soft-danger {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%) !important;
    border: none !important;
    border-radius: 25px !important;
    padding: 0.7rem 1.5rem !important;
    font-weight: 600 !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4) !important;
    transition: all 0.3s ease !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.btn-soft-danger:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6) !important;
    background: linear-gradient(135deg, #ee5a24 0%, #ff6b6b 100%) !important;
    color: white !important;
}

/* ========== HERO SECTION UPGRADE ========== */
.job-hero-section.bg-light {
    background: linear-gradient(135deg, #F3F6F9 0%, #F3F6F9 100%) !important;
    position: relative !important;
    overflow: hidden !important;
}

/* Animated Background Particles */
.job-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
    animation: float 6s ease-in-out infinite;
    z-index: 1;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
}

/* Hero Content Z-Index */
.job-hero-section .container {
    position: relative;
    z-index: 2;
}

/* Hero Text Styling */
.job-hero-section .display-6 {
    color: light grey !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 1px rgba(0,0,0,0.2) !important;
    line-height: 1.2 !important;
    margin-bottom: 2rem !important;
}

.job-hero-section .lead {
    color: light grey !important;
    font-size: 1.1rem !important;
    line-height: 1.6 !important;
    text-shadow: 0 0px 1px rgba(0,0,0,0.2) !important;
    text-align: justify !important;
}

/* Modern Inquiry Box */
.inquiry-box {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15) !important;
    border-radius: 20px !important;
    transition: all 0.3s ease !important;
}

.inquiry-box:hover {
    transform: translateY(-5px) scale(1.02) !important;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
}

/* Avatar Title Modernisasi */
.inquiry-box .avatar-title.bg-soft-warning {
    background: linear-gradient(135deg, #feca57 0%, #ff9ff3 100%) !important;
    box-shadow: 0 4px 15px rgba(254, 202, 87, 0.4) !important;
}

/* ========== SECTION IMPROVEMENTS ========== */

/* Informasi Section */
#informasi {
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
}

/* Cuma untuk title "INFORMASI" */
#informasi h1 {
    text-shadow: 0 1px 1px rgba(0,0,0,0.3) !important;
}

/* Tryout Section */
#tryout {
    background: linear-gradient(135deg, #ffffff 0%, #f1f3f4 100%) !important;
}

/* Cuma untuk title "TRYOUT" */
#tryout h1 {
    text-shadow: 0 1px 1px rgba(0,0,0,0.3) !important;
}

/* ========== RESPONSIVE IMPROVEMENTS ========== */
@media (max-width: 768px) {
    .navbar-nav .nav-link {
        margin: 0.2rem 0 !important;
        text-align: center !important;
        border-radius: 15px !important;
    }
    
    .navbar-collapse {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px) !important;
        border-radius: 15px !important;
        margin-top: 1rem !important;
        padding: 1rem !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid rgba(226, 182, 2, 0.2) !important;
    }
    
    .job-hero-section {
        padding-top: 100px !important;
    }
    
    .job-hero-section .display-6 {
        font-size: 2rem !important;
    }
    
    .job-hero-section .lead {
        font-size: 1rem !important;
    }
}

/* ========== ADDITIONAL MODERN TOUCHES ========== */
html {
    scroll-behavior: smooth !important;
}

/* Focus States untuk Accessibility */
.nav-link:focus, .btn:focus {
    outline: 2px solid rgba(255, 255, 255, 0.5) !important;
    outline-offset: 2px !important;
}

/* Loading Animation untuk Elements */
.navbar-brand, .nav-link, .btn {
    will-change: transform !important;
}

/* Enhanced Back to Top Button */
.landing-back-top {
    background: linear-gradient(135deg, #E2B602 0%, #E2B602 100%) !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(226, 182, 2, 0.4) !important;
    transition: all 0.3s ease !important;
}

.landing-back-top:hover {
    transform: translateY(-3px) scale(1.1) !important;
    box-shadow: 0 6px 20px rgba(226, 182, 2, 0.6) !important;
}

/* WHATSAPP ICON - HIJAU KONTRAS TANPA GRADIENT */
.inquiry-box .avatar-title.bg-soft-warning {
    background: #28a745 !important; /* WhatsApp Green */
    color: white !important;
    box-shadow: 0 4px 15px #F3F6F9 !important;
}

.inquiry-box .avatar-title.bg-soft-warning i {
    color: white !important;
}

.inquiry-box:hover .avatar-title.bg-soft-warning {
    background: #1b7e33ff !important; /* Darker WhatsApp Green */
    transform: scale(1.1) !important;
}

/* BACKGROUND SECTIONS - HOME KUNING, HUBUNGI KUNING (SISANYA TETAP) */

/* Home/Hero Section - KUNING */
.job-hero-section.bg-light {
    background: linear-gradient(135deg, #F3F6F9 0%, #F3F6F9 100%) !important;
}

/* Hubungi Section - KUNING */
#hubungi.bg-light {
    background: linear-gradient(135deg, #F3F6F9 0%, #F3F6F9 100%) !important;
}

/* Ubah warna teks title di section hubungi jadi putih biar kontras */
#hubungi .contact-title {
    color: light grey !important;
    text-shadow: 0 1px 1px rgba(0,0,0,0.3) !important;
}

#hubungi .contact-title::after {
    background: white !important;
}



</style>

@endsection
@section('body')

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')
    <div class="layout-wrapper landing">
        <!-- HEADER dari index.blade.php -->
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="40">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-light" alt="logo light" height="40">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hubungi">Hubungi</a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a class="nav-link" href="#promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tryout">Tryout</a>
                        </li>
                    </ul>
                    <div>
                        <a href="{{ route('login')}}" class="btn btn-soft-danger"><i class="ri-user-3-line align-bottom me-1"></i> Masuk & Daftar</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navbar -->

        <!-- start tryout -->
        <section class="section bg-light" id="tryout">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container py-5">
                <div class="row justify-content-center align-items-stretch">
                    <!-- Kotak Kiri: Penjelasan -->
                    <div class="col-lg-6 mb-4 mb-lg-0 d-flex align-items-center">
                        <div class="p-4 rounded shadow bg-white w-100 h-100">
                            <h2 class="fw-bold mb-3 text-center">PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024</h2>
                            <div class="mb-3">
                                <div class="border rounded p-3 bg-light mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="font-size:1.3rem;">✨</span>
                                        <span class="ms-2 fw-semibold" style="font-size:1.1rem;">Halo adik-adik kelas 6 SD✨</span>
                                    </div>
                                    <div class="text-muted" style="font-size:1rem;">
                                        Dalam rangka pemantapan persiapan ASPD, OSIS NATA ADIBRATA - SMP Negeri 9 Yogyakarta bekerjasama LBB Cendekia dengan mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang berlangsung pada <b>SABTU, 25 NOVEMBER 2023</b> dengan sesi pengerjaan <b>08.00-10.15 WIB</b>
                                    </div>
                                </div>
                                <div class="border rounded p-3 bg-light mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2" style="font-size:1.3rem;">
                                            <i class="ri-smartphone-line"></i>
                                        </span>
                                        <span class="fw-semibold" style="font-size:1.1rem;">Ananda Wajib membawa HP yang berisikan Kuota</span>
                                    </div>
                                    <div class="text-muted" style="font-size:1rem;">
                                        untuk mengisikan jawaban Try out pada lembar jawab google form.
                                    </div>
                                </div>
                                <div class="border rounded p-3 bg-light mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="font-size:1.3rem;">❇️</span>
                                        <span class="ms-2 fw-semibold" style="font-size:1.1rem;">CARA MENDAFTAR :</span>
                                    </div>
                                    <div class="text-muted" style="font-size:1rem;">
                                        <ol class="mb-2 ps-3">
                                            <li>Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui:
                                                <ul>
                                                    <li>Transfer BRI : <b>117501003821538 RATIH PADMA SARI</b></li>
                                                    <li>atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja</li>
                                                </ul>
                                            </li>
                                            <li>Mengisi link pendaftaran:<br>
                                                <a href="https://lbbcendekia.com/to2023" target="_blank" class="fw-bold text-primary">🔗https://lbbcendekia.com/to2023</a>
                                            </li>
                                            <li>Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.</li>
                                            <li>Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran (setelah submit).</li>
                                            <li>Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kotak Kanan: Form Pendaftaran -->
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="p-4 rounded shadow bg-white w-100 h-100">
                            <h2 class="fw-bold mb-3">Form Pendaftaran</h2>
                            <!-- Step Indicator -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="step-indicator flex-fill text-center" id="indicator-step-1">
                                        <div class="rounded-circle bg-warning text-white fw-bold mx-auto mb-1" style="width:32px;height:32px;line-height:32px;">1</div>
                                        <div style="font-size:0.95rem;">Identitas</div>
                                    </div>
                                    <div class="flex-fill mx-2" style="height:2px;background:#eee;"></div>
                                    <div class="step-indicator flex-fill text-center" id="indicator-step-2">
                                        <div class="rounded-circle bg-warning text-white fw-bold mx-auto mb-1" style="width:32px;height:32px;line-height:32px;">2</div>
                                        <div style="font-size:0.95rem;">Pembayaran</div>
                                    </div>
                                    <div class="flex-fill mx-2" style="height:2px;background:#eee;"></div>
                                    <div class="step-indicator flex-fill text-center" id="indicator-step-3">
                                        <div class="rounded-circle bg-warning text-white fw-bold mx-auto mb-1" style="width:32px;height:32px;line-height:32px;">3</div>
                                        <div style="font-size:0.95rem;">Konfirmasi</div>
                                    </div>
                                </div>
                            </div>
                            @include('components.message')
                            <form action="{{ route('daftar_tryout.store',$tryout->tryout_id)}}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                                @csrf
                                <!-- Step 1: Identitas -->
                                <div id="step1">
                                    <h4 class="card-title mb-0 flex-grow-1">IDENTITAS</h4>
                                    <div class="mb-3">
                                        <label for="input-email" class="form-label">Email Aktif</label>
                                        <input type="text" class="form-control" id="input-email" name="top_email" placeholder="Masukan Nama Email" required value="{{ old('top_email') }}">
                                        @if ($errors->has('top_email'))
                                        <div class="text-danger">{{ $errors->first('top_email') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="input-nama" name="top_nama_siswa" placeholder="Masukan Nama Email" required value="{{ old('top_nama_siswa') }}">
                                        @if ($errors->has('top_nama_siswa'))
                                        <div class="text-danger">{{ $errors->first('top_nama_siswa') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                        <select class="form-control select2" name="top_asal_sekolah" id="asal_sekolah">
                                        </select>
                                        @if ($errors->has('top_asal_sekolah'))
                                        <div class="text-danger">{{ $errors->first('top_asal_sekolah') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-telpon-siswa" class="form-label">Nomor HP/WA SISWA</label>
                                        <input type="text" class="form-control" id="input-telpon-siswa" name="top_telpon_siswa" placeholder="Masukan Nama Telepon / Wa Siswa" required value="{{ old('top_telpon_siswa') }}">
                                        @if ($errors->has('top_telpon_siswa'))
                                        <div class="text-danger">{{ $errors->first('top_telpon_siswa') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-nama-orang-tua" class="form-label">Nama Orang Tua / Wali</label>
                                        <input type="text" class="form-control" id="input-nama-orang-tua" name="top_nama_orang_tua" placeholder="Masukan Nama Nama Orang Tua / Wali" required value="{{ old('top_telpon_siswa') }}">
                                        @if ($errors->has('top_nama_orang_tua'))
                                        <div class="text-danger">{{ $errors->first('top_nama_orang_tua') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-telpon-orang-tua" class="form-label">Nomor HP/WA Orang Tua/ Wali</label>
                                        <input type="text" class="form-control" id="input-telpon-orang-tua" name="top_telpon_orang_tua" placeholder="Masukan Nama Telepon / Wa Orang Tua / Wali" required value="{{ old('top_telpon_orang_tua') }}">
                                        @if ($errors->has('top_telpon_orang_tua'))
                                        <div class="text-danger">{{ $errors->first('top_telpon_orang_tua') }}</div>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-warning" onclick="nextStep(2)">Lanjut ke Pembayaran</button>
                                    </div>
                                </div>
                                <!-- Step 2: Pembayaran -->
                                <div id="step2" style="display:none;">
                                    <h4 class="card-title mb-0 flex-grow-1">PEMBAYARAN</h4>
                                    <div class="mb-3">
                                        <label for="input-tanggal-bayar" class="form-label">Tanggal Bayar</label>
                                        <input type="date" class="form-control" id="input-tanggal-bayar" name="top_tanggal_bayar" data-provider="flatpickr" data-date-format="d M, Y" required value="{{ old('top_tanggal_bayar') }}">
                                        @if ($errors->has('top_tanggal_bayar'))
                                        <div class="text-danger">{{ $errors->first('top_tanggal_bayar') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenjang" class="form-label">Pembayaran Via</label>
                                        <select id="jenjang" class="form-control" name="top_jenis_bayar">
                                            <option value="">Pilih Jenis Pembayaran</option>
                                            <option value="Bank Transfer" {{ old('top_jenis_bayar') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="Datang Langsung Ke Kantor Cendekia" {{ old('top_jenis_bayar') == 'Datang Langsung Ke Kantor Cendekia' ? 'selected' : '' }}>Datang Langsung Ke Kantor Cendekia</option>
                                        </select>
                                        @if ($errors->has('top_jenis_bayar'))
                                        <div class="text-danger">{{ $errors->first('top_jenis_bayar') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-bukti-bayar" class="form-label">Bukti Bayar</label>
                                        <input type="file" class="form-control" id="input-bukti-bayar" name="top_bukti_bayar" placeholder="Upload Bukti Bayar" required value="{{ old('top_bukti_bayar') }}">
                                        @if ($errors->has('top_bukti_bayar'))
                                        <div class="text-danger">{{ $errors->first('top_bukti_bayar') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-nama-pembayar" class="form-label">Pembayaran Atas Nama</label>
                                        <input type="text" class="form-control" id="input-nama-pembayar" name="top_nama_bayar" placeholder="Masukan Atas Nama Pembayar" required value="{{ old('top_nama_bayar') }}">
                                        @if ($errors->has('top_nama_bayar'))
                                        <div class="text-danger">{{ $errors->first('top_nama_bayar') }}</div>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" onclick="nextStep(1)">Kembali</button>
                                        <button type="button" class="btn btn-warning" onclick="nextStep(3)">Lanjut ke Konfirmasi</button>
                                    </div>
                                </div>
                                <!-- Step 3: Konfirmasi -->
                                <div id="step3" style="display:none;">
                                    <h4 class="card-title mb-3">Konfirmasi & Submit</h4>
                                    <p>Pastikan data yang kamu isi sudah benar sebelum mendaftar.</p>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" onclick="nextStep(2)">Kembali</button>
                                        <button class="btn btn-danger" type="submit">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Kotak Catatan memanjang di bawah -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="p-4 rounded shadow bg-white w-100">
                            <h4 class="fw-bold mb-3 text-center">CATATAN</h4>
                            <div class="border rounded p-3 bg-light mb-3">
                                <ul class="mb-2 ps-3">
                                    <li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li>
                                    <li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li>
                                    <li>Adanya perubahan waktu Tryout menjadi SABTU, 25 November 2023, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 November 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li>
                                    <li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. Zulfa nur aulia menjadi RATIH PADMA SARI, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li>
                                    <li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- end tryout -->

        <!-- Start footer -->
<footer class="py-5 position-relative" style="background-color: #e2b602;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-4">
                <div>
                    <div>
                        <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" alt="logo light" height="40" />
                    </div>
                    <div class="mt-4 fs-13">
                        <p style="text-align: justify;">Selamat datang di LBB Cendekia!</p>
                        <p style="text-align: justify;">Lembaga Bimbingan Belajar Cendekia adalah bimbingan belajar yang melayani kebutuhan belajar dengan Kurikulum Merdeka. Program pembelajaran difokuskan pada penguasaan konsep sekaligus strategi praktis dalam penyelesaian soal, serta pengembangan tipe-tipe soal untuk menghadapi asesmen daerah. Proses belajar didampingi oleh tentor senior berpengalaman yang telah menulis soal ujian nasional, baik di tingkat provinsi maupun nasional.</p>
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/profile.php?id=100070975055336" target="_blank" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://instagram.com/lbbcendekia" target="_blank" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 ms-lg-auto">
                <div class="row">
                    <!-- Contact Section with Animation -->
                    <div class="col-sm-4 mt-4">
                        <h5 class="footer-title">HUBUNGI KAMI</h5>
                        
                        <!-- WhatsApp Contact 1 -->
                        <a href="https://wa.me/6281272139500" target="_blank" class="contact-item phone-contact text-decoration-none" 
                           style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; padding: 0.8rem; background: rgba(255,255,255,0.1); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: white;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="contact-icon" 
                                 style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                <i class="ri-whatsapp-line" style="color: white;"></i>
                            </div>
                            <div class="contact-info" style="flex: 1; text-align: left;">
                                <div class="contact-label" style="font-size: 0.75rem; opacity: 0.9;">WHATSAPP</div>
                                <div class="contact-value"><strong>Kak Lia : 081272139500</strong></div>
                            </div>
                        </a>

                        <!-- WhatsApp Contact 2 -->
                        <a href="https://wa.me/6282323356415" target="_blank" class="contact-item phone-contact text-decoration-none"
                           style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; padding: 0.8rem; background: rgba(255,255,255,0.1); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: white;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="contact-icon" 
                                 style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                <i class="ri-whatsapp-line" style="color: white;"></i>
                            </div>
                            <div class="contact-info" style="flex: 1; text-align: left;">
                                <div class="contact-label" style="font-size: 0.75rem; opacity: 0.9;">WHATSAPP</div>
                                <div class="contact-value"><strong>Kak Yeni : 082323356415</strong></div>
                            </div>
                        </a>
                    </div>

                    <!-- Working Hours -->
                    <div class="col-sm-4 mt-4">
                        <h5 class="footer-title">JAM KERJA</h5>
                        <div class="text-white mt-3">
                            <div class="hours-item" style="background: rgba(255,255,255,0.1); padding: 0.6rem 0.8rem; border-radius: 6px; margin-bottom: 0.6rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease;"
                                 onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateX(5px)';"
                                 onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateX(0)';">
                                <span class="hours-day">SENIN - JUMAT</span>
                                <span class="hours-time">09.00 - 20.00</span>
                            </div>
                            
                            <div class="hours-item" style="background: rgba(255,255,255,0.1); padding: 0.6rem 0.8rem; border-radius: 6px; margin-bottom: 0.6rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease;"
                                 onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateX(5px)';"
                                 onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateX(0)';">
                                <span class="hours-day">SABTU</span>
                                <span class="hours-time">09.00 - 17.00</span>
                            </div>
                            
                            <div class="hours-item" style="background: rgba(255,255,255,0.1); padding: 0.6rem 0.8rem; border-radius: 6px; margin-bottom: 0.6rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease;"
                                 onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateX(5px)';"
                                 onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateX(0)';">
                                <span class="hours-day">AHAD</span>
                                <span class="hours-time">LIBUR</span>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section with Maps Integration -->
                    <div class="col-sm-4 mt-4">
                        <h5 class="footer-title">ALAMAT</h5>
                        
                        <a href="https://maps.app.goo.gl/8Yq12fMQ2qCd8h9ZA" target="_blank" class="address-item text-decoration-none" 
                           style="display: flex; align-items: center; gap: 0.8rem; padding: 0.8rem; background: rgba(255,255,255,0.1); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; color: white; border: 2px solid transparent; position: relative; overflow: hidden;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)'; this.style.borderColor='rgba(255,255,255,0.4)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='transparent';">
                            <div class="address-icon" 
                                 style="width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; position: relative; z-index: 1;">
                                <i class="ri-map-pin-line" style="color: white;"></i>
                            </div>
                            <div class="address-info" style="flex: 1; text-align: left; position: relative; z-index: 1;">
                                <div class="address-label" style="font-size: 0.75rem; opacity: 0.9;">LOKASI KAMI</div>
                                <div class="address-value" style="font-size: 0.9rem; line-height: 1.4;">BARAT GEDUNG SMPN 9<br>YOGYAKARTA</div>
                                <div class="map-hint" style="font-size: 0.7rem; opacity: 0.8; margin-top: 0.3rem;"> KLIK UNTUK BUKA PETA</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center text-sm-start align-items-center mt-5">
            <div class="col-sm-6">
                <div>
                    <p class="copy-rights mb-0">
                        <script>
                         document.write(new Date().getFullYear())
                        </script> © LBB Cendekia
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-warning btn-icon landing-back-top" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->

</body>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/job-lading.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>

<!-- init js -->
<script src="{{ URL::asset('assets/js/pages/form-pickers.init.js') }}"></script>
<script>
    $('#asal_sekolah').select2({
        placeholder: "Cari Asal Sekolah",
        allowClear: true,
        tags: true,
        minimumInputLength: 1,
        ajax: {
            url: '<?= route('ajax.cari-sekolah') ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },

    });
     
     // Phone Call Functionality - Langsung ke WhatsApp
function callPhone(number) {
    const clickedElement = event.currentTarget;
    const icon = clickedElement.querySelector('.contact-icon i');
    
    // Add click animation
    clickedElement.style.transform = 'scale(0.95)';
    setTimeout(() => {
        clickedElement.style.transform = 'translateY(-2px)';
    }, 150);
    
    // Change icon temporarily
    const originalClass = icon.className;
    icon.className = 'loading';
    
    setTimeout(() => {
        icon.className = originalClass;
        
        // Langsung ke WhatsApp tanpa confirm dialog
        const whatsappURL = `https://wa.me/+62${number.substring(1)}?text=Halo,%20saya%20tertarik%20dengan%20layanan%20LBB%20Cendekia`;
        window.open(whatsappURL, '_blank');
    }, 800);
}

// Maps Functionality - Langsung ke alamat spesifik
function openMaps(event) {
    event.preventDefault();
    
    const addressElement = event.currentTarget;
    const icon = addressElement.querySelector('.address-icon i');
    
    // Add click animation
    addressElement.style.transform = 'scale(0.95)';
    setTimeout(() => {
        addressElement.style.transform = 'translateY(-2px)';
    }, 150);
    
    // Change icon temporarily
    const originalClass = icon.className;
    icon.className = 'loading';
    
    setTimeout(() => {
        icon.className = originalClass;
        
        // Langsung ke alamat Maps yang spesifik
        const mapsURL = "https://maps.app.goo.gl/b7vKStGm4U2x2iFY7";
        window.open(mapsURL, '_blank');
    }, 600);
}

    function setRequiredFields(step) {
        // Step 1 fields
        const step1Fields = [
            'input-email',
            'input-nama',
            'input-telpon-siswa',
            'input-nama-orang-tua',
            'input-telpon-orang-tua'
        ];
        // Step 2 fields
        const step2Fields = [
            'input-tanggal-bayar',
            'jenjang',
            'input-bukti-bayar',
            'input-nama-pembayar'
        ];
        // Remove required from all
        step1Fields.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.removeAttribute('required');
        });
        step2Fields.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.removeAttribute('required');
        });
        // Add required only to visible step
        if (step === 1) {
            step1Fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.setAttribute('required', 'required');
            });
        } else if (step === 2) {
            step2Fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.setAttribute('required', 'required');
            });
        }
    }

    function nextStep(step) {
        document.getElementById('step1').style.display = (step === 1) ? 'block' : 'none';
        document.getElementById('step2').style.display = (step === 2) ? 'block' : 'none';
        document.getElementById('step3').style.display = (step === 3) ? 'block' : 'none';
        // Step indicator
        for (let i = 1; i <= 3; i++) {
            document.getElementById('indicator-step-' + i).querySelector('.rounded-circle').classList.remove('bg-warning', 'bg-success');
            document.getElementById('indicator-step-' + i).querySelector('.rounded-circle').classList.add(i === step ? 'bg-success' : 'bg-warning');
        }
        setRequiredFields(step);
    }
    // Inisialisasi step indicator dan required fields di awal
    nextStep(1);
</script>
@endsection