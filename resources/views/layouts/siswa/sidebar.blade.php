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
                    <a class="nav-link menu-link text-white" href="{{route('siswa.dashboard')}}" id="nav-home">
                        <i class="ri-home-3-line"></i> <span>Home</span>
                    </a>
                </li>
                @if(Auth::user()->tipe_siswa == 'Cendekia')
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" href="{{route('siswa.kelas_cendekia.index')}}" id="nav-kelas-cendekia">
                        <i class="ri-team-line"></i> <span>Kelas Cendekia</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" href="{{route('siswa.tryout.library')}}" id="nav-home">
                        <i class="ri-book-line"></i> <span>Perpustakaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" href="{{route('siswa.tryout.index')}}" id="nav-home">
                        <i class="ri-todo-line"></i> <span>Tryout</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-white" href="{{route('siswa.invoice.index')}}" id="nav-home">
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
</style>
