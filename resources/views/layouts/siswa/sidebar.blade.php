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

/* Container navbar */
.app-menu.navbar-menu {
    background: linear-gradient(90deg, #DBB83E, #E6C96B);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    padding: 8px 0;
    transition: background .25s ease, box-shadow .25s ease;
}

/* Logo */
.navbar-brand-box {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 0 12px;
}

/* NAVBAR LIST → tetap HORIZONTAL */
#navbar-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 22px;
    padding-left: 0;
    margin: 0;
}

/* NAV ITEM */
#navbar-nav .nav-item { 
    list-style: none;
}

/* NAV LINK */
/* Kuncikan tinggi stabil agar tidak loncat */
#navbar-nav .nav-link {
    padding: 10px 16px;
    border: 1px solid transparent;
    border-radius: 10px;
    transition: background .25s ease,
                box-shadow .25s ease,
                transform .20s ease,
                color .20s ease;
    will-change: transform, background; /* biar smooth */
}

/* Hover → kecilin hover movement biar gak bikin loncat */
#navbar-nav .nav-link:hover {
    background: rgba(255,255,255,0.15);
    box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    transform: translateY(-1px);  /* Dikecilkan */
}

/* ACTIVE → HARUS SAMA persis dgn hover supaya NO JUMP */
#navbar-nav .nav-link.active {
    background: rgba(255,255,255,0.25);
    border-color: rgba(255,255,255,0.35);
    color: #6d0000 !important;
    font-weight: 600;
    transform: translateY(-1px); /* SAMA dgn hover */
    box-shadow: 0 3px 10px rgba(0,0,0,0.20);
}

/* Fix extra jump when clicking (browser default focus) */
#navbar-nav .nav-link:focus {
    outline: none;
    box-shadow: 0 0 0 0 rgba(0,0,0,0);
}
#navbar-nav .nav-link {
    min-width: 110px; /* bikin semua tab punya lebar minimal sama */
    text-align: center;
    display: inline-block;
}

</style>
