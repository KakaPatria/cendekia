<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" style="background-color: #DBB83E;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="17">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="17">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" 
                        href="{{route('siswa.dashboard')}}" 
                        id="menu-dashboard">
                        <i class="ri-home-3-line"></i> <span>Home</span>
                    </a>
                </li>

                @if(Auth::user()->tipe_siswa == 'Cendekia')
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" 
                        href="{{route('siswa.kelas_cendekia.index')}}" 
                        id="menu-kelas-cendekia">
                        <i class="ri-team-line"></i> <span>Kelas Cendekia</span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link text-white" 
                        href="{{route('siswa.tryout.library')}}" 
                        id="menu-perpustakaan">
                        <i class="ri-book-line"></i> <span>Perpustakaan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white" 
                        href="{{route('siswa.tryout.index')}}" 
                        id="menu-tryout">
                        <i class="ri-todo-line"></i> <span>Tryout</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white" 
                        href="{{route('siswa.invoice.index')}}" 
                        id="menu-pembayaran">
                        <i class="ri-wallet-3-fill"></i> <span>Pembayaran</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<style>
/* Ratakan menu ke tengah secara aman */
.app-menu #navbar-nav {
    display: flex;
    justify-content: center;   /* Pusatkan semua item menu */
    align-items: center;
    gap: 30px;                 /* Jarak antar menu */
    width: 100%;
    margin: 0 auto;            /* Supaya posisinya benar-benar tengah */
    padding-left: 0;           /* Hilangkan padding default Bootstrap */
}

/* Biar icon dan teks sejajar & rapi */
.app-menu .navbar-nav .nav-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: white;
}

/* Hindari tabrakan logo */
.navbar-brand-box {
    text-align: center;
    width: 100%;
}

.app-menu.navbar-menu {
    background: linear-gradient(90deg, #DBB83E, #E6C96B);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-right: none;
}

.app-menu .navbar-nav .nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    border-radius: 15px;
    padding: 12px 16px;
    margin: 6px 12px;
    font-size: 17px;
    font-weight: 550;
    color: white;
    transition: 0.25s ease;
}

.app-menu .navbar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(2px);
    transform: translateX(3px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.12);
}

.app-menu .navbar-nav .nav-link.active {
    background: rgba(255,255,255,0.25);
    border: 1px solid rgba(255,255,255,0.35);
}

.navbar-brand-box {
    display: flex;
    justify-content: center;
    padding: 16px 0;
}

/* ======= Active pill (neumorphism) ======= */
.navbar-nav .nav-link {
  transition: all 0.25s ease;
  border-radius: 28px; /* default pill shape */
  padding: 8px 18px;
}

/* Active state: pill + soft shadow */
.navbar-nav .nav-link.active,
.navbar-nav .nav-link:focus {
  background: linear-gradient(180deg, #f1f6f4 0%, #e9efeb 50%); /* light pill */
  color: #980000 !important; /* teks warna aktif, ganti sesuai palette */
  box-shadow:
    6px 6px 16px rgba(231, 231, 231, 0.14),
    -6px -6px 16px rgba(231, 231, 231, 0.14);
  transform: translateY(-2px);
}

/* Jika mau tampilan mirip contohmu (pill hijau lembut) */
.navbar-nav .nav-link.active .dot-indicator{
  display:none;
}

/* hover effect (non-active) */
.navbar-nav .nav-link:hover:not(.active) {
  background: rgba(255,255,255,0.09);
  color: #111;
  transform: translateY(-2px);
}

/* Untuk navbar di landing page: pusatkan nav (opsional) */
#navbar-example { display:flex; gap:36px; align-items:center; }

.nav-link.active {
    background-color: rgba(255, 255, 255, 0.25);
    border-radius: 8px;
    padding: 6px 10px;
}

.app-menu .navbar-nav .nav-link {
    height: 42px;
    display: flex;
    align-items: center;
    gap: 8px;
}

</style>
