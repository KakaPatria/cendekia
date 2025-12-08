@extends('layouts.master-without-nav')
@section('title') Landing @endsection
@section('body-attr', 'data-bs-spy="scroll" data-bs-target="#navbar-example" data-bs-offset="100" tabindex="0"')
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />

<style>

/* ============================================
   LBB CENDEKIA - CSS ORGANIZED
   Semua nilai SAMA seperti aslinya, cuma dirapikan
   ============================================ */

/* ==========================================
   1. GLOBAL & BASE STYLES
   ========================================== */

html {
  scroll-behavior: smooth !important;
}

/* ==========================================
   2. NAVBAR STYLES
   ========================================== */

/* Modern Navbar Enhancement */
.navbar-landing {
  background: rgba(255, 255, 255, 0.98) !important;
  backdrop-filter: blur(15px) saturate(180%) !important;
  -webkit-backdrop-filter: blur(15px) saturate(180%) !important;
  border-bottom: 1px solid rgba(152, 0, 0, 0.1) !important;
  box-shadow: 0 4px 30px rgba(152, 0, 0, 0.08) !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
  padding: 0.8rem 0 !important;
}

/* Navbar scroll effect */
.navbar-landing.scrolled {
  box-shadow: 0 8px 40px rgba(152, 0, 0, 0.15) !important;
  padding: 0.5rem 0 !important;
}

/* Logo Enhancement */
.navbar-brand img {
  transition: transform 0.3s ease !important;
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)) !important;
}

.navbar-brand:hover img {
  transform: scale(1.1) !important;
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

/* Underline animation effect */
.navbar-nav .nav-link::before {
  content: '';
  position: absolute;
  bottom: 8px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #E2B602, #980000);
  transition: width 0.3s ease;
}

.navbar-nav .nav-link:hover::before {
  width: 60%;
}

/* Active State */
.navbar-nav .nav-link.active {
  background: linear-gradient(135deg, #e1e1e1ff 0%, #e1e1e1ff 100%) !important;
  color: #ffffff !important;
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

/* Focus States untuk Accessibility */
.nav-link:focus, .btn:focus {
  outline: 2px solid rgba(255, 255, 255, 0.5) !important;
  outline-offset: 2px !important;
}

/* ==========================================
   3. HERO SECTION STYLES
   ========================================== */

/* Hero Background & Layout */
.job-hero-section.bg-light {
  background: linear-gradient(180deg, #980000 0%, #7A0000 100%) !important;
  position: relative !important;
  overflow: hidden !important;
  color: #ffffff !important;
}

/* Wave kuning atas - WITH ANIMATION */
/*.job-hero-section.bg-light::before {
  content: '';
  position: absolute;
  top: 70px;
  left: 0;
  width: 100%;
  height: 200px;
  z-index: 1;
  background: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 140'><defs><linearGradient id='grad' x1='0%' y1='0%' x2='100%' y2='0%'><stop offset='0%' style='stop-color:%23980000;stop-opacity:1' /><stop offset='100%' style='stop-color:%23E2B602;stop-opacity:1' /></linearGradient></defs><path fill='url(%23grad)' d='M0,40 C300,60 800,0 1440,90 L1440,0 L0,0 Z'></path></svg>");
  background-size: cover;
  background-repeat: no-repeat;
  animation: waveMove 15s ease-in-out infinite;
}*/

@keyframes waveMove {
  0%, 100% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(10px);
  }
}

/* Wave kuning bawah */
/*.job-hero-section.bg-light::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 140px;
  background: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'><path fill='%23E2B602' fill-opacity='1' d='M0,64L120,80C240,96,480,128,720,144C960,160,1200,160,1320,154.7L1440,149L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z'></path></svg>");
  background-size: cover;
  background-repeat: no-repeat;
}*/

/* Hero Content Z-Index */
.job-hero-section .container {
  position: relative;
  z-index: 2;
}

/* Hero Text Styling - WITH ANIMATIONS */
.job-hero-section .display-6 {
  color: white !important;
  font-weight: 800 !important;
  font-size: 2.8rem !important;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
  line-height: 1.2 !important;
  margin-bottom: 2rem !important;
  animation: fadeInUp 1s ease-out both;
  animation-delay: 0.2s;
}

.job-hero-section .lead {
  color: rgba(255, 255, 255, 0.95) !important;
  font-size: 1.05rem !important;
  line-height: 1.7 !important;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
  text-align: justify !important;
  font-weight: 400 !important;
  animation: fadeInUp 1s ease-out both;
  animation-delay: 0.4s;
}

/* Keyframe untuk fade in dari bawah */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
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

/* Image Stack Styling */
.image-stack {
  position: relative;
  display: inline-block;
  overflow: visible;
}

/* Gambar bawah — bisa kamu geser sendiri */
.img-bottom {
  position: relative;
  width: 110%;        /* ubah sesukamu */
  left: -50px; /* geser kiri */
  z-index: 1;
  display: inline;
}

/* Gambar atas — overlay */
.img-top {
  position: absolute;
  top: 0;
  left: -20px;      /* geser sedikit ke kiri */
  width: 110%;      /* ubah sesuai kebutuhan */
  z-index: 1;
  opacity: 1;       /* 1 = solid, 0.9 = transparan */
}

/* WHATSAPP BOX - HIJAU PENUH */
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
  font-size: 1rem !important;
  text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3) !important;
  letter-spacing: 0.3px !important;
  margin: 0 !important;
  transition: all 0.3s ease !important;
}

#hero .inquiry-box a {
  color: white !important;
  text-decoration: none !important;
}

#hero .inquiry-box {
  margin-top: 0.5rem !important;
  display: inline-flex !important;
}


/* ==========================================
   4. SECTION INFORMASI (TOP 4)
   ========================================== */

#informasi {
  background-color: #ffffffff !important;
  color: #ffffff !important;
  padding-top: 100px;
  padding-bottom: 100px;
}

/* Judul Section */
#informasi h1,
#informasi h2,
#informasi h3 {
  color: #980000 !important;
  text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Styling Dasar Semua Card Hasil Tryout */
#informasi .card {
  background-color: #ffffff !important;
  border-radius: 16px !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  min-height: 250px;
  padding: 15px 15px 20px 15px;
}

/* Efek Hover untuk Semua Card */
#informasi .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(152, 0, 0, 0.15);
}

/* Styling Nama Siswa */
#informasi .card h6 {
  font-size: 1.15rem !important;
  font-weight: 700 !important;
  margin-bottom: 0.5rem;
  color: #2c3e50 !important;
}

/* Styling Keterangan Sekolah dan Nilai */
#informasi .card p {
  font-size: 0.9rem !important;
  line-height: 1.4;
  color: #6c757d !important;
}

/* Styling NILAI TOTAL */
#informasi .card p span.fw-bold {
  font-weight: 700 !important;
  color: #980000 !important;
  font-size: 1rem !important;
}

/* Pastikan isi card tetap gelap dan terbaca */
#informasi .card:not(.inquiry-box),
#informasi .card:not(.inquiry-box) * {
  color: #2c3e50 !important;
  background-color: #ffffff !important;
}

/* ==========================================
   5. SECTION TRYOUT
   ========================================== */

#tryout {
  background-color: #980000 !important;
  color: #ffffff !important;
}

#tryout h1,
#tryout h2 {
  color: #ffffff !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
}

#tryout .text-muted {
  color: #f1f1f1 !important;
}

/* Tryout Cards */
#tryout .card:not(.inquiry-box),
#tryout .card:not(.inquiry-box) * {
  color: #2c3e50 !important;
  background-color: #ffffff !important;
}

/* Tryout Banner Image */
#tryout .explore-place-bid-img img {
  height: 250px;
  object-fit: cover;
  width: 100%;
  filter: brightness(100%) contrast(100%);
  transition: transform 0.4s ease-out;
}

/* Styling teks keterangan */
#tryout .card-body .small.text-muted {
  font-size: 0.75rem !important;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #888 !important;
}

/* Styling nilai Waktu dan Pelaksanaan */
#tryout .card-body h6.text-dark {
  color: #2c3e50 !important;
  font-size: 0.9rem !important;
}

/* Styling Ikon */
#tryout .card-body i.mdi {
  color: #980000 !important;
  transition: transform 0.3s ease;
}

#tryout .explore-box:hover .card-body i.mdi {
  transform: scale(1.1);
}

/* Styling HARGA (Kuning Emas) */
#tryout .card-body h4.text-primary-brand-1 {
  color: #E2B602 !important;
  text-shadow: 0 0 5px rgba(226, 182, 2, 0.5);
  font-size: 1.8rem !important;
}

/* Button Daftar */
#tryout .card-footer a.w-100 {
  width: 100% !important;
}

/* Card Hover Effect */
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-8px) scale(1.03);
  box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

/* Image Wrapper */
.img-wrapper {
  background: white;
  padding: 10px;
  border-radius: 10px;
  height: 280px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.img-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.explore-place-bid-img img {
  width: 100%;
  height: 280px;
  object-fit: cover;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
}

/* ==========================================
   6. SECTION FAQ
   ========================================== */

#faq {
  padding: 80px 0;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-color: #ffffffff !important;
  color: #ffffff !important;
}

#faq .container {
  width: 100%;
  max-width: 900px;
}

#faq h1,
#faq h2 {
  font-weight: 700;
  font-size: 2rem;
  color: #980000 !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
}

#faq p.text-muted {
  font-size: 1rem;
  color: #980000 !important;
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
  color: #980000 !important;
  background-color: #E2B60240 !important;
  border-color: #E2B602 !important;
}

.accordion-body {
  background-color: #fff;
  color: #555;
  line-height: 1.6;
}

/* Animasi Icon Accordion */
.accordion-button::after {
  filter: invert(30%) sepia(80%) saturate(600%) hue-rotate(330deg) brightness(85%) contrast(100%);
}

.accordion-button:not(.collapsed)::after {
  filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(0%) contrast(100%);
}

/* Pastikan card FAQ tetap putih */
#faq .card:not(.inquiry-box),
#faq .card:not(.inquiry-box) * {
  color: #2c3e50 !important;
  background-color: #ffffff !important;
}

/* ==========================================
   7. SECTION HUBUNGI (Hidden by default)
   ========================================== */

#hubungi.bg-light {
  background: #980000 !important;
}

#hubungi .contact-title {
  color: #980000 !important;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.06) !important;
}

#hubungi .contact-title::after {
  background: #980000 !important;
}

/* Contact Cards */
.contact-card {
  transition: all 0.3s ease;
  border: 1px solid rgba(0,0,0,0.05);
}

.contact-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  border-color: #E5A24745;
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

.contact-item:nth-child(1) { animation-delay: 0.1s; }
.contact-item:nth-child(2) { animation-delay: 0.2s; }
.contact-item:nth-child(3) { animation-delay: 0.3s; }
.contact-item:nth-child(4) { animation-delay: 0.4s; }
.contact-item:nth-child(5) { animation-delay: 0.5s; }
.contact-item:nth-child(6) { animation-delay: 0.6s; }

.contact-item:hover {
  background: rgba(255,255,255,0.2) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important;
  border-color: rgba(255,255,255,0.3) !important;
}

/* ==========================================
   8. FOOTER STYLES
   ========================================== */

/* Footer Title */
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

/* Contact Labels & Values */
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

/* Hours Section */
.hours-day {
  font-size: 0.85rem !important;
  font-weight: 600 !important;
}

.hours-time {
  font-size: 0.8rem !important;
  color: rgba(255,255,255,0.9) !important;
}

/* Address Section */
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

/* Footer text colours: titles black, labels black, values red */
footer .col-sm-4 .footer-title {
  color: #111111 !important;
  text-shadow: none !important;
}
footer .col-sm-4 .contact-label,
footer .col-sm-4 .hours-day,
footer .col-sm-4 .address-label {
  color: #111111 !important;
}
footer .col-sm-4 .contact-value,
footer .col-sm-4 .hours-time,
footer .col-sm-4 .address-value,
footer .copy-rights,
.footer-left-text p {
  color: #980000 !important;
}

/* footer left description as list items */
.footer-desc li {
  color: #980000 !important;
  margin-bottom: 0.5rem;
  line-height: 1.45;
}

/* specific: make the main description justified + black */
.footer-desc-text {
  color: #111111 !important;
  text-align: justify;
}
.footer-desc-welcome {
  color: #980000 !important;
}

/* left panel removed per request; left content uses .footer-left-text */
.logo-wrapper img {
  filter: none;
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

/* Phone Contact Effects */
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

/* Address Item Effects */
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

/* Loading Animation */
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

/* ==========================================
   9. BACK TO TOP BUTTON
   ========================================== */

.landing-back-top {
  background: #000000ff !important;
  border: none !important;
  box-shadow: 0 4px 15px rgba(151, 151, 151, 0.4) !important;
  transition: all 0.3s ease !important;
}

.landing-back-top:hover {
  transform: translateY(-3px) scale(1.1) !important;
  box-shadow: 0 6px 20px rgba(226, 182, 2, 0.6) !important;
}

/* ==========================================
   10. RESPONSIVE DESIGN
   ========================================== */

@media (max-width: 768px) {
  .contact-card:hover {
    transform: translateY(-4px) scale(1.01);
  }
  
  .section {
    padding: 3rem 0;
  }
}

/* ==========================================
   END OF CSS
   ========================================== */

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
        <section class="section job-hero-section bg-light pb-0" id="hero" style="padding-top:120px;">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div>
                            <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Lembaga Bimbingan Belajar Cendekia Yogyakarta</h1>
                            <p class="lead text-muted lh-base mb-4">Lembaga Bimbingan Belajar Cendekia adalah bimbingan belajar yang melayani kebutuhan belajar dengan Kurikulum Merdeka. Program pembelajaran difokuskan pada penguasaan konsep sekaligus strategi praktis dalam penyelesaian soal, serta pengembangan tipe-tipe soal untuk menghadapi asesmen daerah. Proses belajar didampingi oleh tentor senior berpengalaman yang telah menulis soal ujian nasional, baik di tingkat provinsi maupun nasional.</p>

                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-5">
                        <div class="position-relative home-img text-center mt-3 mt-lg-0">
                            <div class="card p-2 w-80 rounded shadow-lg inquiry-box fixed-left">
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
                            </div>


                            <div class="image-stack">
                              <img src="{{URL::asset('assets/images/lp-base.png')}}" alt="gambar bawah" class="img-bottom" class="user-img" style="margin-left: 25px;">
                              <img src="{{URL::asset('assets/images/lp4.png')}}" alt="gambar atas" class="img-top">
                            </div>
                      

                            {{-- Circle decoration (dinonaktifkan sementara)
                            <div class="circle-effect">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                            </div>
                            --}}
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
                            <h1 class="mb-3 ff-secondary fw-semibold lh-base">TOP 4 HASIL TRYOUT PENILAIAN AKHIR SEMESTER</h1>

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
                                <h6 class="fs-17 mb-2 fw-bold text-dark">Syakira Marsya T</h6>
                                <p class="text-muted mb-0 fs-15"> SDN 1 Godean - Total nilai: <span class="fw-bold text-success">276,67</span></p>
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
                                <h6 class="fs-17 mb-2 fw-bold text-dark">Fadlan Raya Efendi</h6>
                                <p class="text-muted mb-0 fs-15">SDN Adisucipto 1 - Total nilai: <span class="fw-bold text-success">276,66</span></p>
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
                                <h6 class="fs-17 mb-2 fw-bold text-dark">Janu Lanang P</h6>
                                <p class="text-muted mb-0 fs-15">SD Budi Utama - Total nilai: <span class="fw-bold text-success">276,66</span></p>
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

                                <h6 class="fs-17 mb-2 fw-bold text-dark">Nathanael V. T.</h6>
                                <p class="text-muted mb-0 fs-15">SD Model - Total nilai: <span class="fw-bold text-success">276,66</span></p>
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
                                <a href="https://bit.ly/WA-CENDEKIA-AFIINA" target="_blank" class="stretched-link">
                                    <h5 class="fs-17 pt-1">Whatsapp Kak Afiina</h5>
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
<div class="col-lg-4 d-flex align-items-stretch">
    <div class="card explore-box card-animate w-100">
        <div class="bookmark-icon position-absolute top-0 end-0 p-2">
            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true">
                <i class="mdi mdi-cards-heart fs-16"></i>
            </button>
        </div>

        <div class="explore-place-bid-img">
            <img 
                src="{{ $value->tryout_banner && Storage::exists($value->tryout_banner) 
                    ? Storage::url($value->tryout_banner) 
                    : asset('storage/uploads/tryout_banner/tryoutbanner-nataadibrata.jpg') }}" 
                alt="banner"
                class="card-img-top explore-img"
                style="height: 250px; object-fit: cover; width: 100%;">
            <div class="bg-overlay"></div>
        </div>

        <div class="card-body d-flex flex-column">
    <div>
        {{-- JUDUL DAN JENJANG --}}
        <h5 class="mb-1">
            <a href="apps-nft-item-details.html" class="link-dark">{{ $value->tryout_judul }}</a>
        </h5>
        <p class="text-muted mb-3">{{ $value->tryout_jenjang.' Kelas '.$value->tryout_kelas }}</p>
    </div>

    {{-- DETAIL PENTING: BATAS REGISTRASI & JENIS TRYOUT --}}
    <div class="d-flex justify-content-between align-items-center mb-3 pt-2 border-top border-top-dashed">
        <div class="d-flex align-items-center">
            <i class="mdi mdi-calendar-clock text-primary fs-4 me-2"></i>
            <div>
                <p class="text-muted mb-0 small text-uppercase">Batas Registrasi</p>
                {{-- Mengambil data dari tryout_register_due --}}
                <h6 class="fw-semibold mb-0 text-dark">
                    {{ \Carbon\Carbon::parse($value->tryout_register_due)->translatedFormat('d F Y') }}
                </h6>
            </div>
        </div>
    </div>

    {{-- DETAIL PENTING: HARGA --}}
    <div class="text-center pt-2 border-top border-top-dashed mt-auto">
        <p class="text-muted mb-1 small text-uppercase">Harga Pendaftaran</p>
        <h4 class="fw-bold mb-0 text-primary-brand-1">
            @if($value->tryout_jenis === 'Gratis')
                GRATIS
           @elseif($value->tryout_nominal > 0)
                {{-- Hasil: Rp. 20000 --}}
                Rp {{ $value->tryout_nominal }}
            @else
                Hubungi Admin
            @endif
        </h4>
    </div>
    
</div>
        
        <div class="card-footer border-top border-top-dashed mt-auto text-center">
            <a href="{{ route('daftar_tryout',$value->tryout_id) }}" class="btn btn-primary waves-effect waves-light w-100">Daftar Sekarang</a>
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
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
            Bagaimana cara mengikuti tryout?
          </button>
        </h2>
        <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
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
        <footer class="py-5 position-relative" style="background-color: #E2B602;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-4">
                <div class="logo-wrapper mb-3">
                  <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" alt="logo light" height="40" />
                </div>
                <div class="mt-4 fs-13 footer-left-text">
                  <ul class="list-unstyled footer-desc mb-2">
                    <li class="footer-desc-welcome">Selamat datang di LBB Cendekia!</li>
                    <li class="footer-desc-text">Lembaga Bimbingan Belajar Cendekia adalah bimbingan belajar yang melayani kebutuhan belajar dengan Kurikulum Merdeka. Program pembelajaran difokuskan pada penguasaan konsep sekaligus strategi praktis dalam penyelesaian soal, serta pengembangan tipe-tipe soal untuk menghadapi asesmen daerah. Proses belajar didampingi oleh tentor senior berpengalaman yang telah menulis soal ujian nasional, baik di tingkat provinsi maupun nasional.</li>
                  </ul>
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

            <div class="col-lg-8 ms-lg-auto">
                <div class="row">
                    <!-- Contact Section with Animation -->
                    <div class="col-sm-4 mt-4">
                        <h5 class="footer-title">HUBUNGI KAMI</h5>
                        
                        <!-- WhatsApp Contact 1 -->
                        <a href="https://wa.me/6281272139500" target="_blank" class="contact-item phone-contact text-decoration-none" 
                          style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; padding: 0.8rem; background: rgba(255,255,255,0.05); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: #111111;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="contact-icon" 
                                 style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                <i class="ri-whatsapp-line" style="color: #111111;"></i>
                            </div>
                            <div class="contact-info" style="flex: 1; text-align: left;">
                                <div class="contact-label" style="font-size: 0.75rem; opacity: 0.9;">WHATSAPP</div>
                                <div class="contact-value"><strong>Kak Lia : 081272139500</strong></div>
                            </div>
                        </a>

                        <!-- WhatsApp Contact 2 -->
                        <a href="https://wa.me/6282323356415" target="_blank" class="contact-item phone-contact text-decoration-none"
                          style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; padding: 0.8rem; background: rgba(255,255,255,0.05); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: #111111;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="contact-icon" 
                                 style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                <i class="ri-whatsapp-line" style="color: #111111;"></i>
                            </div>
                            <div class="contact-info" style="flex: 1; text-align: left;">
                                <div class="contact-label" style="font-size: 0.75rem; opacity: 0.9;">WHATSAPP</div>
                                <div class="contact-value"><strong>Kak Afiina : 082323356415</strong></div>
                            </div>
                        </a>
                    </div>

                    <!-- Working Hours -->
                        <div class="col-sm-4 mt-4">
                        <h5 class="footer-title">JAM KERJA</h5>
                        <div class="mt-3">
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
                                <span class="hours-time">08.00 - 16.00</span>
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
                        
                        <div class="address-list">
                          <a href="https://bit.ly/MAPS-LBBCENDEKIA" target="_blank" class="address-item text-decoration-none d-block" 
                          style="display: flex; align-items: center; gap: 0.8rem; padding: 0.8rem; background: rgba(255,255,255,0.05); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: #111111;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)'; this.style.borderColor='rgba(255,255,255,0.4)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='transparent';">
                            <div class="address-icon" 
                               style="width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; position: relative; z-index: 1;">
                              <i class="ri-map-pin-line" style="color: #111111;"></i>
                            </div>
                            <div class="address-info" style="flex: 1; text-align: left; position: relative; z-index: 1;">
                              <div class="address-label" style="font-size: 0.75rem; opacity: 0.95;">Cabang Kotagede</div>
                              <div class="address-value" style="font-size: 0.9rem; line-height: 1.4;">Jl. Ngeksigondo No. 23 (Gang Masjid Al Barokah) <br>Barat Gedung SMP N 9 Yogyakarta.</div>
                              <div class="map-hint" style="font-size: 0.7rem; opacity: 0.8; margin-top: 0.3rem;">Buka Peta</div>
                            </div>
                          </a>

                          <a href="https://bit.ly/MAPSCENDEKIACENTER" target="_blank" class="address-item text-decoration-none d-block mt-2" 
                          style="display: flex; align-items: center; gap: 0.8rem; padding: 0.8rem; background: rgba(255,255,255,0.05); border-radius: 8px; transition: all 0.3s ease; cursor: pointer; border: 2px solid transparent; position: relative; overflow: hidden; color: #111111;"
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)'; this.style.borderColor='rgba(255,255,255,0.4)';"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='transparent';">
                            <div class="address-icon" 
                               style="width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; position: relative; z-index: 1;">
                              <i class="ri-map-pin-line" style="color: #111111;"></i>
                            </div>
                            <div class="address-info" style="flex: 1; text-align: left; position: relative; z-index: 1;">
                              <div class="address-label" style="font-size: 0.75rem; opacity: 0.95;">Cabang Ketandan</div>
                              <div class="address-value" style="font-size: 0.9rem; line-height: 1.4;">Jl. Tegalsari Raya, Kalangan Baturetno, Banguntapan Bantul</div>
                              <div class="map-hint" style="font-size: 0.7rem; opacity: 0.8; margin-top: 0.3rem;">Buka Peta</div>
                            </div>
                          </a>
                        </div>
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

<script>
        document.addEventListener("DOMContentLoaded", function () {
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#navbar-example',
                offset: 70
            });

            // Optional: reinitialize on resize (buat jaga-jaga)
            window.addEventListener('resize', function () {
                bootstrap.ScrollSpy.getInstance(document.body).refresh();
            });
        });
    </script>
@endsection