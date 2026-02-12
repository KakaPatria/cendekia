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
  /*transform: translateY(-5px) scale(1.03) !important;*/
  box-shadow: 0 15px 40px rgba(37, 211, 102, 0.6) !important;
  background: linear-gradient(135deg, #128C7E 0%, #075E54 100%) !important;
}

/* Tambahkan di dalam tag <style> Anda */
.btn-warning.btn-lg {
    transition: all 0.3s ease !important;
}

.btn-warning.btn-lg:hover {
    transform: translateY(-2px) scale(1.03); /* Sedikit naik dan membesar saat hover */
    box-shadow: 0 8px 25px rgba(226, 182, 2, 0.8) !important; /* Efek shadow lebih kuat */
    background: #FFD700 !important; /* Warna emas lebih cerah saat hover */
    color: #980000 !important;
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

/* Styling untuk Trophy Icon dan Badge */
#informasi .trophy-icon {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

#informasi .card.border-success {
  border-width: 3px !important;
  border-color: #198754 !important;
}

#informasi .card.border-primary {
  border-width: 3px !important;
  border-color: #0d6efd !important;
}

#informasi .card.border-danger {
  border-width: 3px !important;
  border-color: #dc3545 !important;
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
#tryout .card:not(.inquiry-box) {
  color: #128C7E !important;
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

/* Button Daftar Sekarang - Hijau */
#tryout .card-footer a.w-100 {
  background-color: #2c3e50 !important;
  border-color: #2c3e50 !important;
  color: #ffffff !important;
}

#tryout .card-footer a.w-100:hover {
  background-color: #128C7E !important;
  border-color: #128C7E !important;
}

/* ==========================================
<<<<<<< HEAD
   6. SECTION FAQ (redesigned)
=======
   TREASURE MAP STYLES
   ========================================== */

.treasure-map-container {
  position: relative;
  width: 100%;
  max-width: 1000px;
  margin: 4rem auto;
  padding: 2rem;
  background: linear-gradient(135deg, rgba(226, 182, 2, 0.05), rgba(152, 0, 0, 0.05));
  border-radius: 20px;
  border: 3px solid #E2B602;
}

.treasure-map-svg {
  width: 100%;
  height: auto;
  filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));
}

.treasure-step {
  cursor: pointer;
  transition: all 0.3s ease;
}

.treasure-step:hover circle {
  filter: drop-shadow(0 0 15px rgba(255, 215, 0, 1));
}

.treasure-card {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative;
  overflow: hidden;
  border: none !important;
  background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,0.98)) !important;
  margin-top: 2rem;
  border-radius: 15px !important;
}

.treasure-card:hover {
  transform: translateY(-12px) scale(1.04) !important;
  box-shadow: 0 20px 40px rgba(226, 182, 2, 0.25), 0 0 30px rgba(152, 0, 0, 0.15) !important;
}

.treasure-badge {
  display: inline-block;
  width: 70px;
  height: 70px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  font-weight: bold;
  color: white;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
  animation: float 3s ease-in-out infinite;
  border: 3px solid white;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-15px) rotate(5deg);
  }
}

.treasure-badge-1 { background: linear-gradient(135deg, #FF6B6B, #EE5A6F); }
.treasure-badge-2 { background: linear-gradient(135deg, #4CAF50, #45A049); animation-delay: 0.1s; }
.treasure-badge-3 { background: linear-gradient(135deg, #25D366, #22BA57); animation-delay: 0.2s; }
.treasure-badge-4 { background: linear-gradient(135deg, #2196F3, #1976D2); animation-delay: 0.3s; }
.treasure-badge-5 { background: linear-gradient(135deg, #9C27B0, #7B1FA2); animation-delay: 0.4s; }
.treasure-badge-6 { background: linear-gradient(135deg, #FF9800, #E68900); animation-delay: 0.5s; }

/* ==========================================
   6. SECTION FAQ
>>>>>>> baae564ecbf72fa779d5e20468589445eacd0778
   ========================================== */

#faq {
  padding-top: 160px;
  padding-bottom: 160px;
  background-color: #ffffff !important; /* match #informasi */
  color: #111111 !important;
}

#faq .container {
  width: 100%;
  max-width: 900px;
}

/* Left intro */
.faq-intro .badge-faq {
  display: inline-block;
  background: rgba(226,182,2,0.08); /* pale yellow */
  color: #980000; /* brand red */
  font-weight: 600;
  padding: 6px 10px;
  border-radius: 999px;
  font-size: 0.8rem;
  margin-bottom: 1rem;
}

.faq-intro h2 {
  font-size: 2.25rem;
  line-height: 1.05;
  font-weight: 800;
  color: #222;
  margin-bottom: 0.75rem;
}

.faq-intro h2 .accent {
  color: #980000; /* highlight 'questions' with brand red */
}

.faq-intro p {
  color: #555;
  max-width: 480px;
}

/* Reusable title style (match FAQ heading) */
.section-title-faq {
  font-size: 2.25rem !important;
  line-height: 1.05 !important;
  font-weight: 800 !important;
  color: #222 !important;
  margin-bottom: 0.75rem !important;
}

.section-title-faq .accent {
  color: #980000;
}

/* Accordion column */
.faq-accordion .accordion-item {
  border: 0;
  margin-bottom: 14px;
}

.faq-accordion .accordion-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #ffffff;
  border: 1px solid rgba(152,0,0,0.08); /* soft red border */
  border-radius: 12px;
  padding: 18px 18px;
  box-shadow: 0 6px 20px rgba(152,0,0,0.03);
  font-weight: 700;
  color: #222;
}

.faq-accordion .accordion-button:not(.collapsed) {
  background: linear-gradient(90deg, rgba(226,182,2,0.06), rgba(152,0,0,0.02));
  border-color: rgba(152,0,0,0.22);
}

/* Replace default chevron with circular red/yellow icon */
.faq-accordion .accordion-button::after {
  content: '';
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(135deg,#980000,#E2B602);
  mask: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path fill='%23fff' d='M7.41 8.59 12 13.17l4.59-4.58L18 10l-6 6-6-6z'/></svg>") center/60% no-repeat;
  -webkit-mask: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path fill='%23fff' d='M7.41 8.59 12 13.17l4.59-4.58L18 10l-6 6-6-6z'/></svg>") center/60% no-repeat;
  border: none;
  transform: rotate(0deg);
}

.faq-accordion .accordion-button:not(.collapsed)::after {
  transform: rotate(180deg);
}

.faq-accordion .accordion-body {
  background: #fff;
  border: 1px solid rgba(0,0,0,0.04);
  border-radius: 12px;
  margin-top: 8px;
  padding: 16px;
  color: #444;
  line-height: 1.6;
}

/* Keep nested cards white and readable */
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
   10. TREASURE MAP STYLES
   ========================================== */

/* Treasure Map Container */
.treasure-map-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 20px;
  background: linear-gradient(180deg, rgba(152, 0, 0, 0.05) 0%, rgba(226, 182, 2, 0.05) 100%);
  border-radius: 20px;
  margin: 30px auto;
  max-width: 1000px;
}

/* Treasure Map SVG */
.treasure-map-svg {
  width: 100%;
  max-width: 1000px;
  height: auto;
  filter: drop-shadow(0 4px 15px rgba(0, 0, 0, 0.1));
}

/* Treasure Card Styling */
.treasure-card {
  background: white;
  border-radius: 15px;
  padding: 25px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  height: 100%;
  position: relative;
  overflow: hidden;
}

.treasure-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #FFD700, #FFA500);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.treasure-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 12px 30px rgba(152, 0, 0, 0.2);
}

.treasure-card:hover::before {
  opacity: 1;
}

/* Treasure Badge (Circle with Icon) */
.treasure-badge {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  margin: 0 auto 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Pulse Animation */
@keyframes pulse {
  0%, 100% {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    transform: scale(1);
  }
  50% {
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
    transform: scale(1.05);
  }
}

/* Float Animation */
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* Treasure Chest Animation */
.treasure-chest {
  animation: float 3s ease-in-out infinite;
}

/* SVG Text Animation */
.decorative-stars {
  animation: twinkle 2s ease-in-out infinite;
}

@keyframes twinkle {
  0%, 100% { opacity: 0.6; }
  50% { opacity: 1; }
}

.compass-rose {
  animation: rotate 20s linear infinite;
}

@keyframes rotate {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* ==========================================
   11. RESPONSIVE DESIGN
   ========================================== */

@media (max-width: 768px) {
  .contact-card:hover {
    transform: translateY(-4px) scale(1.01);
  }
  
  .section {
    padding: 3rem 0;
  }

  .treasure-map-svg {
    max-width: 100%;
    height: auto;
  }

  .treasure-card {
    margin-bottom: 15px;
  }

  .treasure-badge {
    width: 70px;
    height: 70px;
    font-size: 2.5rem;
  }
}

@media (max-width: 480px) {
  .treasure-badge {
    width: 60px;
    height: 60px;
    font-size: 2rem;
  }

  .treasure-card h5 {
    font-size: 0.95rem;
  }

  .treasure-card p {
    font-size: 0.85rem;
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
        <section class="section job-hero-section bg-light pb-0" id="hero" style="padding-top:115px; position: relative;">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div>
                    <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Lembaga Bimbingan Belajar Cendekia Yogyakarta</h1>
                    <p class="lead text-muted lh-base mb-4">Lembaga Bimbingan Belajar Cendekia adalah bimbingan belajar yang melayani kebutuhan belajar dengan Kurikulum Merdeka. Program pembelajaran difokuskan pada penguasaan konsep sekaligus strategi praktis dalam penyelesaian soal, serta pengembangan tipe-tipe soal untuk menghadapi asesmen daerah. Proses belajar didampingi oleh tentor senior berpengalaman yang telah menulis soal ujian nasional, baik di tingkat provinsi maupun nasional.</p>
                    <div class="mb-4"> 
                        <a href="https://lbbcendekia.com/" target="_blank" class="btn btn-warning btn-lg waves-effect waves-light shadow-lg" style="font-weight: 600; background: #E2B602 !important; border: none !important; color: #980000 !important; box-shadow: 0 4px 15px rgba(226, 182, 2, 0.4) !important;">
                            <i class="ri-globe-line align-bottom me-2 fs-5"></i> KUNJUNGI WEBSITE RESMI CENDEKIA
                        </a>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-5">
                <div class="position-relative home-img text-center mt-3 mt-lg-0">
                    <div class="image-stack">
                        <img src="{{URL::asset('assets/images/lp-base.png')}}" alt="gambar bawah" class="img-bottom" class="user-img" style="margin-left: 25px;">
                        <img src="{{URL::asset('assets/images/lp4.png')}}" alt="gambar atas" class="img-top" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

    <!-- Button Hubungi Kami yang bisa di-drag di hero section -->
    <div id="draggable-wa" class="card p-2 rounded shadow-lg inquiry-box" style="position: absolute; bottom: 100px; right: 20px; top: auto; left: auto; transform: none; cursor: grab; touch-action: none; user-select: none; z-index: 999; width: auto; transition: all 0.4s ease;">
        <div class="d-flex align-items-center">
            <div class="avatar-sm flex-shrink-0 me-3">
                <div class="avatar-title bg-success text-white rounded fs-18">
                    <i class="ri-whatsapp-line"></i>
                </div>
            </div>
            <a href="https://bit.ly/WA-CENDEKIA-LIA" target="_blank" class="text-dark text-decoration-none">
                <h5 class="fs-15 lh-base mb-0">Hubungi Kami</h5>
            </a>
        </div>
    </div>

    <script>
        const box = document.getElementById("draggable-wa");
        const heroSection = document.getElementById("hero");
        let isDragging = false;
        let offsetX, offsetY;
        let isInHeroMode = true; // Track mode: hero atau fixed
        let userDraggedPosition = null; // Simpan posisi yang di-drag user

        // Posisi default di hero section (kanan bawah)
        const heroPosition = {
            position: 'absolute',
            bottom: '100px',
            right: '20px',
            top: 'auto',
            left: 'auto',
            transform: 'none'
        };

        // Posisi fixed di bawah (di atas back to top button)
        const fixedPosition = {
            position: 'fixed',
            bottom: '80px',
            right: '20px',
            top: 'auto',
            left: 'auto',
            transform: 'none'
        };

        // Fungsi untuk cek apakah hero section terlihat
        function isHeroVisible() {
            const heroRect = heroSection.getBoundingClientRect();
            return heroRect.bottom > 0; // Hero masih terlihat di viewport
        }

        // Fungsi untuk apply posisi
        function applyPosition(positionObj) {
            Object.keys(positionObj).forEach(key => {
                box.style[key] = positionObj[key];
            });
        }

        // Handle scroll event
        function handleScroll() {
            if (isDragging) return; // Jangan ubah posisi saat sedang drag

            const heroVisible = isHeroVisible();

            if (heroVisible && !isInHeroMode) {
                // Kembali ke hero section
                isInHeroMode = true;
                box.style.transition = 'all 0.4s ease';
                
                if (userDraggedPosition) {
                    // Kembali ke posisi yang di-drag user
                    applyPosition(userDraggedPosition);
                } else {
                    // Kembali ke posisi default
                    applyPosition(heroPosition);
                }
            } else if (!heroVisible && isInHeroMode) {
                // Pindah ke mode fixed di bawah
                isInHeroMode = false;
                box.style.transition = 'all 0.4s ease';
                applyPosition(fixedPosition);
            }
        }

        // Event listener untuk scroll
        window.addEventListener("scroll", handleScroll);

        // Mouse drag events
        box.addEventListener("mousedown", (e) => {
            // Jangan drag jika klik pada link atau sedang dalam mode fixed
            if (e.target.closest('a') || !isInHeroMode) return;
            
            isDragging = true;
            const rect = box.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
            box.style.cursor = "grabbing";
            box.style.transition = "none";
        });

        document.addEventListener("mousemove", (e) => {
            if (!isDragging || !isInHeroMode) return;
            
            const heroRect = heroSection.getBoundingClientRect();
            const boxRect = box.getBoundingClientRect();
            
            // Hitung posisi baru relatif terhadap hero section
            let newLeft = e.clientX - heroRect.left - offsetX;
            let newTop = e.clientY - heroRect.top - offsetY;
            
            // Batasi agar tidak keluar dari hero section
            newLeft = Math.max(0, Math.min(newLeft, heroRect.width - boxRect.width));
            newTop = Math.max(0, Math.min(newTop, heroRect.height - boxRect.height));
            
            box.style.left = newLeft + "px";
            box.style.top = newTop + "px";
            box.style.right = 'auto';
            box.style.bottom = 'auto';
            box.style.transform = "none";
            
            // Simpan posisi yang di-drag user
            userDraggedPosition = {
                position: 'absolute',
                top: newTop + 'px',
                left: newLeft + 'px',
                transform: 'none',
                bottom: 'auto',
                right: 'auto'
            };
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
                box.style.cursor = "grab";
            }
        });

        // Touch events untuk mobile
        box.addEventListener("touchstart", (e) => {
            if (e.target.closest('a') || !isInHeroMode) return;
            
            isDragging = true;
            const touch = e.touches[0];
            const rect = box.getBoundingClientRect();
            offsetX = touch.clientX - rect.left;
            offsetY = touch.clientY - rect.top;
            box.style.transition = "none";
            e.preventDefault();
        });

        box.addEventListener("touchmove", (e) => {
            if (!isDragging || !isInHeroMode) return;
            
            const touch = e.touches[0];
            const heroRect = heroSection.getBoundingClientRect();
            const boxRect = box.getBoundingClientRect();
            
            let newLeft = touch.clientX - heroRect.left - offsetX;
            let newTop = touch.clientY - heroRect.top - offsetY;
            
            newLeft = Math.max(0, Math.min(newLeft, heroRect.width - boxRect.width));
            newTop = Math.max(0, Math.min(newTop, heroRect.height - boxRect.height));
            
            box.style.left = newLeft + "px";
            box.style.top = newTop + "px";
            box.style.right = 'auto';
            box.style.bottom = 'auto';
            box.style.transform = "none";
            
            userDraggedPosition = {
                position: 'absolute',
                top: newTop + 'px',
                left: newLeft + 'px',
                transform: 'none',
                bottom: 'auto',
                right: 'auto'
            };
            
            e.preventDefault();
        });

        box.addEventListener("touchend", () => {
            if (isDragging) {
                isDragging = false;
            }
        });

        // Initial setup - pastikan posisi sudah benar dari awal
        applyPosition(heroPosition);
        
        // Delay sedikit untuk memastikan layout sudah ready
        setTimeout(() => {
            handleScroll();
        }, 100);
    </script>
</section>
<!-- end hero section -->

<section class="section" id="informasi" style="padding-top:160px; padding-bottom:160px; background-color: #ffffff;"> 
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h1 class="fw-bold fs-1 text-danger">SISWA TERBAIK TRYOUT PENILAIAN AKHIR SEMESTER</h1>
                    <p class="text-muted fs-5 mt-3">Peringkat 1 Setiap Jenjang Pendidikan</p>
                </div>
            </div>
        </div>

        <!-- Top Students Cards -->
        <div class="row justify-content-center mb-5 pb-5">
            @foreach(['SD' => 'success', 'SMP' => 'primary', 'SMA' => 'danger'] as $jenjang => $color)
                @if(isset($topScoresByJenjang[$jenjang]))
                    @php
                        $student = $topScoresByJenjang[$jenjang];
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-lg border-{{ $color }} h-100">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <span class="badge bg-{{ $color }} fs-5 px-4 py-2">
                                        <i class="ri-graduation-cap-line me-2"></i>{{ $jenjang }}
                                    </span>
                                </div>
                                <div class="trophy-icon mb-3">
                                    <i class="ri-trophy-line text-{{ $color }}" style="font-size: 3rem;"></i>
                                </div>
                                <h1 class="fw-bold display-6 ff-secondary mb-3 text-{{ $color }}">
                                    <span>#1</span>
                                </h1>
                                <h5 class="fw-bold text-dark mb-2">{{ $student->name }}</h5>
                                <p class="text-muted mb-3">{{ $student->asal_sekolah }}</p>
                                <div class="mt-3 pt-3 border-top">
                                    <p class="mb-0 fs-14 text-muted">Total Nilai</p>
                                    <h3 class="fw-bold text-{{ $color }} mb-0">{{ number_format($student->total_nilai, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        
        <hr class="mb-5 mt-5">

        <!-- Treasure Map Section -->
        <div class="row justify-content-center pt-5">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h2 class="fw-bold fs-1 text-primary">ALUR PENDAFTARAN TRY OUT CENDEKIA</h2>
                </div>
            </div>
        </div>

        <!-- SVG Treasure Map Visualization -->
        <!-- Treasure Cards Section -->
<div class="row justify-content-center mt-5">
    <div class="col-lg-10">
        <div class="row">
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="treasure-card h-100 p-4 d-flex flex-column" style="border-left: 5px solid #FFB6C1;">
                    <div class="treasure-badge mx-auto mb-3" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
                        <i class="ri-user-line fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mt-3 text-dark text-center">1. Masuk/Daftar Akun</h5>
                    <p class="text-muted fs-14 flex-grow-1" style="text-align: justify;">
                        Buat akun baru atau masuk menggunakan akun Cendekia yang sudah Anda miliki untuk memulai proses pendaftaran.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="treasure-card h-100 p-4 d-flex flex-column" style="border-left: 5px solid #87CEEB;">
                    <div class="treasure-badge mx-auto mb-3" style="background: linear-gradient(135deg, #E2B602 0%, #FFD700 100%);">
                        <i class="ri-book-open-line fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mt-3 text-dark text-center">2. Pilih Tryout</h5>
                    <p class="text-muted fs-14 flex-grow-1" style="text-align: justify;">
                        Telusuri daftar Tryout yang tersedia di dashboard dan pilih Tryout yang sesuai dengan kebutuhan Anda (misalnya: Try Out ASPD SD).
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="treasure-card h-100 p-4 d-flex flex-column" style="border-left: 5px solid #98FB98;">
                    <div class="treasure-badge mx-auto mb-3" style="background: linear-gradient(135deg, #980000 0%, #7A0000 100%);">
                        <i class="ri-bank-card-line fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mt-3 text-dark text-center">3. Melakukan Pembayaran</h5>
                    <p class="text-muted fs-14 flex-grow-1" style="text-align: justify;">
                        Lakukan pembayaran sesuai dengan biaya yang tertera untuk Tryout yang Anda pilih melalui transfer bank atau metode lain yang tersedia.
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div> 

<div class="row justify-content-center mt-0">
    <div class="col-lg-10">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="treasure-card h-100 p-4 d-flex flex-column" style="border-left: 5px solid #FFD700;">
                    <div class="treasure-badge mx-auto mb-3" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);">
                        <i class="ri-check-line fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mt-3 text-dark text-center">4. Konfirmasi Admin</h5>
                    <p class="text-muted fs-14 flex-grow-1" style="text-align: justify;">
                        Tunggu konfirmasi dari pihak admin Cendekia yang meliputi proses verifikasi pembayaran dan aktivasi akses Tryout ke akun Anda.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="treasure-card h-100 p-4 d-flex flex-column" style="border-left: 5px solid #DDA0DD;">
                    <div class="treasure-badge mx-auto mb-3" style="background: linear-gradient(135deg, #ee5a24 0%, #ff6b6b 100%);">
                        <i class="ri-file-edit-line fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mt-3 text-dark text-center">5. Mengerjakan Tryout</h5>
                    <p class="text-muted fs-14 flex-grow-1" style="text-align: justify;">
                        Setelah akun terkonfirmasi, Anda akan mendapatkan akses penuh ke soal-soal Tryout dan dapat mulai mengerjakannya sesuai jadwal.
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
<div class="text-center mt-5 pt-4">
    <a href="https://bit.ly/WA-CENDEKIA-LIA" target="_blank" class="btn btn-success btn-lg waves-effect waves-light shadow-lg">
        <i class="ri-whatsapp-line align-bottom me-2 fs-5"></i> BUTUH BANTUAN? WHATSAPP KAK LIA
    </a>
</div>
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
                            <h1 class="fw-bold fs-1 text-dark">TRYOUT</h1>
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
            @if($value->tryout_banner)
                <img 
                    src="{{ asset('storage/' . $value->tryout_banner) }}" 
                    alt="{{ $value->tryout_judul }}"
                    class="card-img-top explore-img"
                    style="height: 250px; object-fit: cover; width: 100%;"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/400x250/980000/ffffff?text=Tryout+Banner';">
            @else
                <img 
                    src="https://via.placeholder.com/400x250/980000/ffffff?text=Tryout+Banner" 
                    alt="{{ $value->tryout_judul }}"
                    class="card-img-top explore-img"
                    style="height: 250px; object-fit: cover; width: 100%;">
            @endif
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
            <a href="{{ route('login')}}" class="btn btn-primary waves-effect waves-light w-100">Daftar Sekarang</a>
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

<section id="faq" class="section">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-4">
                <div class="faq-intro">
                    <div class="badge-faq">FAQ</div>
                    <h2 class="fw-bold display-5">Frequently Asked <span class="accent">Questions</span></h2>
                    <p class="mt-3 fs-5 text-muted">Pertanyaan yang sering diajukan seputar pendaftaran, akses tryout, dan masalah akun. Jika pertanyaanmu belum tercantum, silakan hubungi admin melalui WA.</p>
                    
                    </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-accordion">
                    <div class="accordion" id="faqAccordion">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    <span class="fw-semibold">1. Bagaimana cara mengikuti tryout?</span>
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kamu bisa mendaftar akun terlebih dahulu melalui website kami, lalu pilih tryout yang tersedia di menu dashboard, lakukan pembayaran (jika berbayar), dan tunggu konfirmasi admin.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    <span class="fw-semibold">2. Apakah Tryout bisa diakses gratis?</span>
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Beberapa tryout (seperti sesi demo atau tryout periodik tertentu) disediakan gratis, sedangkan versi premium dengan analisis lengkap dan soal eksklusif bisa diakses setelah login dan berlangganan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    <span class="fw-semibold">3. Bagaimana jika lupa password akun?</span>
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Gunakan fitur “Lupa Password” di halaman login untuk mengatur ulang kata sandi kamu menggunakan email yang terdaftar. Jika masih kesulitan, hubungi admin.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    <span class="fw-semibold">4. Kapan hasil tryout akan keluar?</span>
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Hasil tryout akan langsung keluar setelah kamu menyelesaikan pengerjaan. Untuk analisis ranking dan pembahasan, biasanya akan tersedia 1x24 jam setelah periode tryout berakhir.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- Start footer -->
        <footer class="py-5 position-relative" style="background-color: #E2B602;">
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