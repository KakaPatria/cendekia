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
/* ============================
   NAVBAR HORIZONTAL (RAPI)
   ============================ */

.app-menu.navbar-menu {
    background: linear-gradient(90deg, #DBB83E, #E6C96B);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    padding: 8px 0;
    transition: background .25s ease, box-shadow .25s ease;
}

/* LOGO */
.navbar-brand-box {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 0 12px;
}

/* NAVBAR LIST */
#navbar-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 22px;
    padding-left: 0;
    margin: 0;
}

#navbar-nav .nav-item {
    list-style: none;
}

/* ============================
   NAV LINK (IKON + TEKS SEJAJAR)
   ============================ */
#navbar-nav .nav-link {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;      /* ikon & teks sejajar */
    justify-content: center !important;  /* tetap 1 baris */
    gap: 8px !important;                 /* jarak ikon-teks */
    white-space: nowrap !important;      /* cegah turun ke baris baru */
    padding: 12px 18px;
    border: 1px solid transparent;
    border-radius: 12px;
    min-width: 120px;                    /* semua lebar stabil */
    height: 46px;                        /* tinggi DIKUNCI → anti loncat */
    box-sizing: border-box;
    text-align: center;
    
    transition: background .20s ease,
                box-shadow .20s ease,
                transform .20s ease;
}

/* ============================
   ICON FIX
   ============================ */
#navbar-nav .nav-link i {
    font-size: 20px;
    width: 20px;
    height: 20px;

    display: flex !important;
    align-items: center !important;
    justify-content: center !important;

    line-height: 1 !important;
    position: relative;
    top: 0 !important;      /* ICON TIDAK TURUN */
}

/* ============================
   TEXT FIX
   ============================ */
#navbar-nav .nav-link span {
    line-height: 1 !important;
    display: flex;
    align-items: center;    /* teks sejajar dengan icon */
    position: relative;
    top: 0 !important;
}

/* ============================
   HOVER
   ============================ */
#navbar-nav .nav-link:hover {
    background: rgba(255,255,255,0.18);
    box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    transform: translateY(-1px);
}

/* ============================
   ACTIVE
   ============================ */
#navbar-nav .nav-link.active {
    background: rgba(255,255,255,0.25);
    border-color: rgba(255,255,255,0.25);
    color: #6d0000 !important;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(0,0,0,0.25);
    transform: translateY(-1px);
}

/* ============================
   FOCUS FIX
   ============================ */
#navbar-nav .nav-link:focus {
    outline: none;
    box-shadow: none;
}

/* Khusus Home jika sebelumnya berbeda */
#menu-dashboard i {
    top: 0 !important;
}

</style>
