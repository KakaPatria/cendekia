<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" id="sidebar-menu">
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
                        <i class="ri-file-edit-line"></i> <span>Tryout</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.tryout_open.*') ? 'active' : '' }}" href="{{route('panel.tryout_open.index')}}">
                        <i class="ri-file-paper-line"></i> <span>Registrasi Tryout</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.pendaftaran.*') ? 'active' : '' }}" href="{{route('panel.pendaftaran.index')}}">
                        <i class="ri-newspaper-line"></i> <span>Peserta Tryout</span>
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

<style>
:root {
    --primary-red: #980000;
    --primary-red-hover: #B92B27;
    --primary-yellow: #E2B602;
    --logo-bg: #D4B237;
}

/* === Sidebar Styling === */
.app-menu {
    background: var(--primary-yellow) !important;
    border-right: none !important;
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: transform 0.3s ease;
    z-index: 1030;
}

/* Sidebar tertutup */
.app-menu.closed {
    transform: translateX(-250px);
}

/* Scroll area */
#scrollbar {
    height: calc(100vh - 100px);
    overflow-y: auto;
    overflow-x: hidden;
    padding-bottom: 2rem;
}

/* Logo area */
.navbar-brand-box {
    background: var(--logo-bg) !important;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

/* Menu utama */
#navbar-nav > .nav-item > .nav-link {
    background-color: var(--primary-yellow) !important;
    color: #452103 !important;
    margin: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-weight: 500;
}
#navbar-nav > .nav-item > .nav-link i {
    color: #452103 !important;
    transition: all 0.3s ease;
}
#navbar-nav > .nav-item > .nav-link:hover {
    background-color: #f0c946 !important;
    color: white !important;
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
#navbar-nav > .nav-item > .nav-link.active {
    background-color: var(--primary-red) !important;
    color: white !important;
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
#navbar-nav > .nav-item > .nav-link.active i,
#navbar-nav > .nav-item > .nav-link:hover i {
    color: white !important;
}

/* Submenu */
.menu-dropdown .nav-link {
    color: #452103 !important;
    padding-left: 2rem !important;
}
.menu-dropdown .nav-link.active {
    background-color: rgba(152,0,0,0.1) !important;
    color: var(--primary-red) !important;
}
</style>


