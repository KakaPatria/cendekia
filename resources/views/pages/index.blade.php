@extends('layouts.master-without-nav')
@section('title') Landing @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />

<style>

/* Section FAQ */
#faq {
  padding: 80px 0;
}

#faq h2 {
  font-weight: 700;
  font-size: 2rem;
  color: #2c3e50;
}

#faq p.text-muted {
  font-size: 1rem;
  color: #6c757d;
}

/* Accordion Style */
.accordion-item {
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  transition: all 0.3s ease;
}

.accordion-item:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.accordion-button {
  font-weight: 600;
  font-size: 1rem;
  color: #2c3e50;
  background-color: #fff;
}

.accordion-button:not(.collapsed) {
  color: #0d6efd;
  background-color: #e9f3ff;
}

.accordion-body {
  background-color: #fff;
  color: #555;
  line-height: 1.6;
}

.explore-place-bid-img img {
    width: 100%;
    height: 280px; /* atau sesuaikan */
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

    .img-wrapper {
    background: white;        /* Biar ada background putih */
    padding: 10px;           /* Kasih jarak dari tepi */
    border-radius: 10px;     /* Biar sudutnya halus */
    height: 280px;           /* Samain tinggi seperti sebelumnya */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;       /* Biar gak gepeng tapi tetap penuh */
}

/* Biar section FAQ pas 1 layar penuh */
#faq {
  min-height: 100vh; /* setinggi layar */
  display: flex;
  align-items: center; /* biar konten di tengah vertikal */
  justify-content: center;
  flex-direction: column;
  padding: 80px 0;
  background-color: #980000; /* opsional: kasih warna lembut agar beda dari section lain */
}

#faq .container {
  width: 100%;
  max-width: 900px; /* biar lebar konten gak terlalu melebar */
}

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
        animation: fadeInUp 0.6s ease-out both;
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 1), transparent);
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
/* === HERO SECTION === */
.job-hero-section.bg-light {
    background: linear-gradient(180deg, #980000 0%, #7A0000 100%) !important;
    position: relative !important;
    overflow: hidden !important;
    color: #ffffff !important;
}

/* Wave kuning atas (gradasi merah ke kuning, lebih tinggi & jelas) */
.job-hero-section.bg-light::before {
    content: '';
    position: absolute;
    top: 80px; /* dinaikkan sedikit biar ga ketutup header */
    left: 0;
    width: 100%;
    height: 200px; /* lebih tinggi supaya gradasinya keliatan */
    z-index: 1;
    background: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 140'><defs><linearGradient id='grad' x1='0%' y1='0%' x2='100%' y2='0%'><stop offset='0%' style='stop-color:%23980000;stop-opacity:1' /><stop offset='100%' style='stop-color:%23E2B602;stop-opacity:1' /></linearGradient></defs><path fill='url(%23grad)' d='M0,40 C300,60 800,0 1440,90 L1440,0 L0,0 Z'></path></svg>");
    background-size: cover;
    background-repeat: no-repeat;
}



/* Wave kuning bawah */
.job-hero-section.bg-light::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 140px;
    background: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'><path fill='%23E2B602' fill-opacity='1' d='M0,64L120,80C240,96,480,128,720,144C960,160,1200,160,1320,154.7L1440,149L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z'></path></svg>");
    background-size: cover;
    background-repeat: no-repeat;
}

/* === NAVBAR === */
.navbar, .header {
    background-color: #ffffff !important;
}

.navbar a, .nav-link {
    color: #980000 !important;
    font-weight: 600;
}

.navbar a:hover, .nav-link.active {
    color: #E2B602 !important;
}

/* === TOMBOL LOGIN & DAFTAR === */
.btn-login {
    background-color: #ffffff !important;
    color: #980000 !important;
    border: 2px solid #980000 !important;
}

.btn-daftar {
    background-color: #E2B602 !important;
    color: #980000 !important;
    font-weight: 600 !important;
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
    color: white !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 1px #f1f3f4!important;
    line-height: 1.2 !important;
    margin-bottom: 2rem !important;
}

.job-hero-section .lead {
    color: white !important;
    font-size: 1.1rem !important;
    line-height: 1.6 !important;
    text-shadow: 0 0px 1px rgba(255, 255, 255, 1) !important;
    text-align: justify !important;
}


/* ========== SECTION IMPROVEMENTS ========== */

/* Informasi Section */
#informasi {
    position: relative;
    background:  #980000 !important;
}

/* Cuma untuk title "INFORMASI" */
#informasi h1 {
    text-shadow: white !important;
}

/* Tryout Section */
#tryout {
    background: #980000 !important;
}

/* Cuma untuk title "TRYOUT" */
#tryout h1 {
    text-shadow: 0 1px 1px white !important;
}

/* ========== RESPONSIVE IMPROVEMENTS ========== */
@media (max-width: 768px) {
    .navbar-nav .nav-link {
        margin: 0.2rem 0 !important;
        text-align: center !important;
        border-radius: 15px !important;
    }
    
    .navbar-collapse {
        background:#E2B602!important;
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
    background:  #980000 !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(226, 182, 2, 0.4) !important;
    transition: all 0.3s ease !important;
}

.landing-back-top:hover {
    transform: translateY(-3px) scale(1.1) !important;
    box-shadow: 0 6px 20px rgba(226, 182, 2, 0.6) !important;
}

/* WHATSAPP BOX - HIJAU PENUH (PRIORITAS TERTINGGI) */
#hero .inquiry-box {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%) !important;
    backdrop-filter: blur(10px) !important;
    border: none !important;
    box-shadow: 0 8px 32px rgba(37, 211, 102, 0.4) !important;
    border-radius: 20px !important;
    transition: all 0.3s ease !important;
}

#hero .inquiry-box:hover {
    transform: translateY(-5px) scale(1.03) !important;
    box-shadow: 0 15px 40px rgba(37, 211, 102, 0.6) !important;
    background: linear-gradient(135deg, #128C7E 0%, #075E54 100%) !important;
}

/* Icon WhatsApp - PUTIH */
#hero .inquiry-box .avatar-title.bg-soft-warning {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    box-shadow: none !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
}

#hero .inquiry-box .avatar-title.bg-soft-warning i {
    color: white !important;
    font-size: 1.5rem !important;
}

#hero .inquiry-box:hover .avatar-title.bg-soft-warning {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: scale(1.15) rotate(8deg) !important;
    border-color: white !important;
}

/* Text dalam box WhatsApp - PUTIH */
#hero .inquiry-box h5 {
    color: white !important;
    font-weight: 600 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
}

#hero .inquiry-box a {
    color: white !important;
    text-decoration: none !important;
}

/* Home/Hero Section - KUNING */
.job-hero-section.bg-light {
    background:#980000 !important;
}

/* Hubungi Section - KUNING */
#hubungi.bg-light {
    background: #980000 !important;
}

/* Ubah warna teks title di section hubungi jadi putih biar kontras */
#hubungi .contact-title {
    color: white !important;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 1) !important;
}

#hubungi .contact-title::after {
    background: #980000 !important;
}

/* Biar background maroon dan judul teksnya tetap kontras */
#informasi {
  background-color: #980000;
}

/* Hanya ubah warna teks judul utama di bagian atas */
#informasi h1,
#informasi h2,
#informasi h3 {
  color: #ffffff !important;
  text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Pastikan teks dalam card tetap gelap */
#informasi .card,
#informasi .card * {
  color: #2c3e50 !important;
}

#informasi,
#tryout,
#hero,
#faq {
  background-color: #980000 !important;
  color: #ffffff !important;
}

/* Khusus judul utama di setiap section */
#informasi h1, #tryout h1, #hero h1, #faq h1,
#informasi h2, #tryout h2, #hero h2, #faq h2,
#informasi .text-center h1, #tryout .text-center h1, #faq .text-center h2 {
  color: #ffffff !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
}


/* Khusus teks tambahan (yang pakai .text-muted dari Bootstrap) */
#faq .text-muted,
#informasi .text-muted,
#tryout .text-muted,
#hero .text-muted{
  color: #f1f1f1 !important; /* jadi abu muda biar tetap lembut tapi kontras */
}

/* Pastikan isi card tetap gelap dan terbaca - KECUALI WhatsApp Box */
#faq .card:not(.inquiry-box), 
#faq .card:not(.inquiry-box) *,
#informasi .card:not(.inquiry-box), 
#informasi .card:not(.inquiry-box) *,
#tryout .card:not(.inquiry-box), 
#tryout .card:not(.inquiry-box) * {
  color: #2c3e50 !important;
  background-color: #ffffff !important;
}

/* Khusus card hero yang bukan WhatsApp box */
#hero .card:not(.inquiry-box), 
#hero .card:not(.inquiry-box) * {
  color: #2c3e50 !important;
  background-color: #ffffff !important;
}

/* PAKSA text WhatsApp box tetap putih! */
#hero .inquiry-box h5,
#hero .inquiry-box a,
#hero .inquiry-box .stretched-link {
  color: white !important;
  background-color: transparent !important;
}




</style>
@endsection
@section('body')

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand" href="https://instagram.com/lbbcendekia" target="_blank">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="40">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-light" alt="logo light" height="40">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a class="nav-link" href="#hubungi">Hubungi</a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a class="nav-link" href="#promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tryout">Tryout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                    </ul>

                    <div class="">
                        <a href="{{ route('login')}}" class="btn btn-soft-danger"><i class="ri-user-3-line align-bottom me-1"></i> Masuk & Daftar</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start hero section -->
        <section class="section job-hero-section bg-light pb-0" id="hero" style="padding-top:85px;">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div>
                            <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Lembaga Bimbingan Belajar Cendekia Yogyakarta</h1>
                            <p class="lead text-muted lh-base mb-4">Lembaga Bimbingan Belajar Cendekia adalah bimbingan belajar yang melayani kebutuhan belajar dengan Kurikulum Merdeka. Program pembelajaran difokuskan pada penguasaan konsep sekaligus strategi praktis dalam penyelesaian soal, serta pengembangan tipe-tipe soal untuk menghadapi asesmen daerah. Proses belajar didampingi oleh tentor senior berpengalaman yang telah menulis soal ujian nasional, baik di tingkat provinsi maupun nasional.</p>

                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="position-relative home-img text-center mt-5 mt-lg-0">
                            <div class="card p-3 rounded shadow-lg inquiry-box">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0 me-3">
                                        <div class="avatar-title bg-soft-warning text-warning rounded fs-18">
                                            <i class="ri-whatsapp-line"></i>
                                        </div>
                                    </div>
                                    <a href="https://bit.ly/WA-CENDEKIA-LIA" target="_blank" class="stretched-link">
                                        <h5 class="fs-15 lh-base mb-0">Hubungi Kami</h5>
                                    </a>
                                </div>
                            </div>.


                            <img src="{{URL::asset('assets/images/job-profile2.png')}}" alt="" class="user-img">

                            <div class="circle-effect">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end hero section -->

        <section class="section" id="informasi" style="padding-top:160px; padding-bottom:160px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold lh-base">TOP 3 HASIL TRYOUT PENILAIAN AKHIR SEMESTER</h1>

                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>1</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Syakira Marsya T</h6>
                                <p class="text-muted mb-0 fs-15"> dari SDN 1 Godean dengan total nilai 276,67.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>2</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Fadlan Raya Efendi</h6>
                                <p class="text-muted mb-0 fs-15">dari SD N Adisucipto 1 dengan total nilai 276,66.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>3</span>
                                </h1>

                                <h6 class="fs-17 mb-2">Janu Lanang P</h6>
                                <p class="text-muted mb-0 fs-15">dari SD Budi Utama dengan total nilai 269,99.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>4</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Nathanael V. T.</h6>
                                <p class="text-muted mb-0 fs-15">SD Model dengan total nilai 266,67.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end container-->
        </section>


        <!-- start services -->
        <section class="section bg-light" id="hubungi" style="padding-top:110px; padding-bottom:10px; display:none;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center mb-3">
                            <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base contact-title">HUBUNGI KAMI DI : </h1>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row justify-content-center" style="padding-top:25px; padding-bottom:160px;">
                    <div class="col-lg-3 col-md-6 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-pencil-ruler-2-line fs-1"></i>
                                    </div>
                                </div>
                                @php
                                    $tahunAwal = now()->year;
                                    $tahunAkhir = $tahunAwal + 1;
                                @endphp
                                <a href="{{ route('siswa.index') }}" class="stretched-link">
                                <h5 class="fs-17 pt-1">
                                    Daftar Siswa Baru TA {{ $tahunAwal }}-{{ $tahunAkhir }}
                                </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-whatsapp-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="https://bit.ly/WA-CENDEKIA-YENI" target="_blank" class="stretched-link">
                                    <h5 class="fs-17 pt-1">Whatsapp Kak Yeni</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-whatsapp-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="https://bit.ly/WA-CENDEKIA-LIA" target="_blank" class="stretched-link">
                                    <h5 class="fs-17 pt-3">Whatsapp Kak Lia</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-instagram-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="https://instagram.com/lbbcendekia" target="_blank" class="stretched-link">
                                    <h5 class="fs-17 pt-1">Instagram</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex mt-4 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-map-pin-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="https://bit.ly/ALAMATLBBC" target="_blank" class="stretched-link">
                                    <h5 class="fs-17 pt-1">Alamat</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex mt-4 contact-item">
                        <div class="card shadow-none text-center py-2 h-100 w-100 contact-card">
                            <div class="card-body py-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="avatar-sm position-relative mb-3 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle contact-icon">
                                        <i class="ri-bookmark-2-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="https://sites.google.com/view/rekrutmenlbbcendekiayk/lbb-cendekia-yogyakarta" class="stretched-link">
                                    <h5 class="fs-17 pt-1">Rekrutmen</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end services -->

        <!-- start tryout -->
        <section class="section bg-white" id="tryout" style="padding-top:100px; padding-bottom:160px;">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">TRY OUT</h1>
                            <p class="text-muted mb-4">Temukan tryout yang sesuai dengan kebutuhan anda.</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <div class="row">
                    @foreach($tryout as $key => $value)
                    <div class="col-lg-4 product-item artwork crypto-card 3d-style">
                        <div class="card explore-box card-animate">
                            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                            </div>
                            <div class="explore-place-bid-img">
    <div class="explore-place-bid-img">
    <img 
        src="{{ $value->tryout_banner && Storage::exists($value->tryout_banner) 
          ? Storage::url($value->tryout_banner) 
          : asset('storage/uploads/tryout_banner/tryoutbanner-nataadibrata.jpg') }}" 
        alt="" 
        class="card-img-top explore-img">

    <div class="bg-overlay"></div>
</div>




                            </div>
                            <div class="card-body">
                                {{--<p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 19.29k </p>--}}
                                <h5 class="mb-1"><a href="apps-nft-item-details.html" class="link-dark">{{ $value->tryout_judul}}</a></h5>
                                <p class="text-muted mb-0">{{ $value->tryout_jenjang.' Kelas '.$value->tryout_kelas}}</p>

                            </div>
                            <div class="card-footer border-top border-top-dashed">
                                <div class="text-center">
                                    <a href="{{ route('daftar_tryout',$value->tryout_id)}}" class="btn btn-primary waves-effect waves-light">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            <!-- end container -->
        </section>
        <!-- end tryout -->



        {{--<section class="section" id="promo">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">PROMO</h1>
                            <p class="text-muted">Temukan Promo Menarik.</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->


            </div>
        </section>--}}

<!-- start faq -->
<section id="faq" class="section bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-semibold text-uppercase">FAQ</h2>
      <p class="text-muted">Pertanyaan yang sering diajukan</p>
    </div>
    
    <div class="accordion" id="faqAccordion">
      <!-- item 1 -->
      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="faq1">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
            Bagaimana cara mengikuti tryout?
          </button>
        </h2>
        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Kamu bisa mendaftar akun terlebih dahulu, lalu pilih tryout yang tersedia di menu dashboard.
          </div>
        </div>
      </div>
      <!-- item 2 -->
<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq2">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
      Apakah Tryout bisa diakses gratis?
    </button>
  </h2>
  <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Beberapa tryout disediakan gratis, sedangkan versi premium bisa diakses setelah login dan berlangganan.
    </div>
  </div>
</div>

<!-- item 3 -->
<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq3">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
      Bagaimana jika lupa password akun?
    </button>
  </h2>
  <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Gunakan fitur “Lupa Password” di halaman login untuk mengatur ulang kata sandi kamu.
    </div>
  </div>
</div>

    </div>
  </div>
</section>


<!-- end faq -->

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

<script>
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
        const whatsappURL = https://wa.me/+62${number.substring(1)}?text=Halo,%20saya%20tertarik%20dengan%20layanan%20LBB%20Cendekia;
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
</script>

