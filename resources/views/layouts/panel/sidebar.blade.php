<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('panel.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('panel.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="22">
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
            <ul class="navbar-nav" id="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.dashboard') ? 'active' : '' }}" href="{{route('panel.dashboard')}}">
                        <i class="ri-apps-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.tryout.*') ? 'active' : '' }}" href="{{route('panel.tryout.index')}}">
                        <i class="ri-file-edit-line"></i> <span>Tryout Umum</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.tryout_open.*') ? 'active' : '' }}" href="{{route('panel.tryout_open.index')}}">
                        <i class="ri-file-paper-line"></i> <span>Tryout Bimbel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.pendaftaran.*') ? 'active' : '' }}" href="{{route('panel.pendaftaran.index')}}">
                        <i class="ri-newspaper-line"></i> <span>Pendaftaran</span>
                    </a>
                </li>

                @php
                    $isReferensiActive = Request::routeIs('panel.bank_soal.*') || Request::routeIs('panel.materi.*') || Request::routeIs('panel.asal_sekolah.*');
                    $isUserActive = Request::routeIs('panel.user.*');
                    $isSettingActive = Request::routeIs('panel.role.*') || Request::routeIs('panel.permission.*');
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $isReferensiActive ? 'active' : '' }}" href="#sidebar-referensi" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isReferensiActive ? 'true' : 'false' }}" aria-controls="sidebar-referensi">
                        <i class="ri-database-line"></i> <span>Referensi</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isReferensiActive ? 'show' : '' }}" id="sidebar-referensi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('panel.bank_soal.index')}}" class="nav-link {{ Request::routeIs('panel.bank_soal.*') ? 'active' : '' }}">Bank Soal</a></li>
                            <li class="nav-item"><a href="{{ route('panel.materi.index')}}" class="nav-link {{ Request::routeIs('panel.materi.*') ? 'active' : '' }}">Mata Pelajaran</a></li>
                            <li class="nav-item"><a href="{{ route('panel.asal_sekolah.index')}}" class="nav-link {{ Request::routeIs('panel.asal_sekolah.*') ? 'active' : '' }}">Asal Sekolah</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $isUserActive ? 'active' : '' }}" href="#sidebar-user" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isUserActive ? 'true' : 'false' }}" aria-controls="sidebar-user">
                        <i class="ri-user-line"></i> <span>Pengguna</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isUserActive ? 'show' : '' }}" id="sidebar-user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('panel.user.index','rule=Siswa')}}" class="nav-link {{ request('rule') == 'Siswa' ? 'active' : '' }}">Siswa</a></li>
                            <li class="nav-item"><a href="{{ route('panel.user.index','rule=Admin')}}" class="nav-link {{ request('rule') == 'Admin' ? 'active' : '' }}">Admin & Pengajar</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $isSettingActive ? 'active' : '' }}" href="#sidebar-setting" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isSettingActive ? 'true' : 'false' }}" aria-controls="sidebar-setting">
                        <i class="ri-settings-line"></i> <span>Pengaturan</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isSettingActive ? 'show' : '' }}" id="sidebar-setting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('panel.role.index')}}" class="nav-link {{ Request::routeIs('panel.role.*') ? 'active' : '' }}">Peran</a></li>
                            <li class="nav-item"><a href="{{ route('panel.permission.index')}}" class="nav-link {{ Request::routeIs('panel.permission.*') ? 'active' : '' }}">Izin</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<style>
    /* === IMPROVEMENT STYLING SESUAI DESAIN === */
    :root {
        --primary-red: #980000;
        --primary-red-hover: #B92B27;
        --primary-yellow: #E2B602;
        --logo-bg: #D4B237;
    }

    /* Latar Belakang Sidebar */
    .app-menu {
        background: var(--primary-yellow) !important;
        border-right: none !important;
    }
    
    /* Area Logo */
    .navbar-brand-box {
        background: var(--logo-bg) !important;
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    #navbar-nav .menu-title {
        display: none;
    }

    /* Tombol Menu Utama */
    #navbar-nav > .nav-item > .nav-link {
        background-color: var(--primary-red) !important;
        color: rgba(255, 255, 255, 0.9) !important;
        margin: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    #navbar-nav > .nav-item > .nav-link i {
        color: rgba(255, 255, 255, 0.9) !important;
        transition: all 0.3s ease;
    }
    #navbar-nav > .nav-item > .nav-link:hover,
    #navbar-nav > .nav-item > .nav-link.active {
        background-color: var(--primary-red-hover) !important;
        color: white !important;
        transform: scale(1.03);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    #navbar-nav > .nav-item > .nav-link:hover i,
    #navbar-nav > .nav-item > .nav-link.active i {
        color: white !important;
    }
    
    /* [IMPROVEMENT] Area Menu Dropdown */
    .collapse.menu-dropdown {
        /* background-color: rgba(0,0,0,0.05); Dihapus agar menyatu */
        background-color: transparent;
        border-radius: 0.5rem;
        padding: 0.25rem 0; /* Mengurangi padding vertikal */
        margin: -0.25rem 1rem 0.5rem 1rem;
    }
    .menu-dropdown .nav-link {
        background-color: transparent !important;
        margin: 0.1rem 0;
        color: #452103 !important; /* Warna teks lebih gelap agar kontras */
        font-weight: 500;
        border-radius: 0.3rem;
        padding-left: 2rem !important; /* Indentasi submenu */
        position: relative;
    }

    /* [IMPROVEMENT] Indikator strip di kiri submenu */
    .menu-dropdown .nav-link::before {
        content: "—";
        position: absolute;
        left: 0.8rem;
        color: var(--primary-red);
        opacity: 0.6;
        transition: all 0.3s ease;
    }

    .menu-dropdown .nav-link:hover,
    .menu-dropdown .nav-link.active {
        background-color: rgba(152, 0, 0, 0.1) !important; /* Latar merah transparan */
        color: var(--primary-red) !important;
        transform: none;
        box-shadow: none;
    }
    .menu-dropdown .nav-link:hover::before,
    .menu-dropdown .nav-link.active::before {
        opacity: 1;
        transform: scaleX(1.2);
    }
</style>

