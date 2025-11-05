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
                    <a class="nav-link menu-link {{ Request::routeIs('panel.tryout.*') || Request::routeIs('panel.tryout_materi.*') ? 'active' : '' }}" href="{{route('panel.tryout.index')}}">
                        <i class="ri-file-edit-line"></i> <span>Tryout</span>
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.tryout_open.*') ? 'active' : '' }}" href="{{route('panel.tryout_open.index')}}">
                <i class="ri-file-paper-line"></i> <span>Registrasi Tryout</span>
                </a>
                </li>--}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('panel.kelas_cendekia.*') ? 'active' : '' }}" href="{{route('panel.kelas_cendekia.index')}}">
                        <i class="ri-team-line"></i> <span>Kelas Cendekia</span>
                    </a>
                </li>
                {{-- ================================= --}}
                          {{-- HANYA UNTUK ADMIN --}}
                          {{-- ================================= --}}
                          @if(auth()->user()->hasRole('Admin'))
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ Request::routeIs('panel.pendaftaran.*') ? 'active' : '' }}" href="{{route('panel.pendaftaran.index')}}">
                                    <i class="ri-newspaper-line"></i> <span>Registrasi Tryout</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ Request::routeIs('panel.invoices.*') ? 'active' : '' }}" href="{{route('panel.invoices.index')}}">
                                    <i class="ri-money-dollar-circle-line "></i> <span>Daftar Pembayaran</span>
                                </a>
                            </li>
                          @endif    
                
                          {{-- ================================= --}}
                          {{-- UNTUK ADMIN & PENGAJAR --}}
                          {{-- ================================= --}}
                          @if(auth()->user()->hasRole(['Admin', 'Pengajar']))
                            @php
                                // Variabel ini kita pindahkan ke dalam sini
                                $isReferensiActive = Request::routeIs('panel.bank_soal.*') || Request::routeIs('panel.materi.*') || Request::routeIs('panel.asal_sekolah.*');
                                $isUserActive = Request::routeIs('panel.user.*');
                            @endphp
                            
                            {{-- POIN 4: REFERENSI --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ $isReferensiActive ? 'active' : '' }}" href="#sidebar-referensi" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isReferensiActive ? 'true' : 'false' }}" aria-controls="sidebar-referensi">
                                    <i class="ri-database-line"></i> <span>Referensi</span>
                                </a>
                                <div class="collapse menu-dropdown {{ $isReferensiActive ? 'show' : '' }}" id="sidebar-referensi">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item"><a href="{{ route('panel.bank_soal.index')}}" class="nav-link {{ Request::routeIs('panel.bank_soal.*') ? 'active' : '' }}">Bank Soal</a></li>
                                        @if(auth()->check() && auth()->user()->roles_id != 3)
                                            <li class="nav-item"><a href="{{ route('panel.materi.index')}}" class="nav-link {{ Request::routeIs('panel.materi.*') ? 'active' : '' }}">Mata Pelajaran</a></li>
                                        @endif
                                    
                                        
                                        {{-- Asal Sekolah hanya untuk Admin --}}
                                        @if(auth()->user()->hasRole('Admin'))
                                            <li class="nav-item"><a href="{{ route('panel.asal_sekolah.index')}}" class="nav-link {{ Request::routeIs('panel.asal_sekolah.*') ? 'active' : '' }}">Asal Sekolah</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                
                            {{-- POIN 5: PENGGUNA --}}
                            @if(auth()->user()->hasRole('Admin'))
                                {{-- Admin melihat menu dropdown 'Pengguna' --}}
                                <li class="nav-item">
                                    <a class="nav-link menu-link {{ $isUserActive ? 'active' : '' }}" href="#sidebar-user" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isUserActive ? 'true' : 'false' }}" aria-controls="sidebar-user">
                                        <i class="ri-user-line"></i> <span>Pengguna</span>
                                    </a>
                                    <div class="collapse menu-dropdown {{ $isUserActive ? 'show' : '' }}" id="sidebar-user">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item"><a href="{{ route('panel.user.index', ['role' => 'Siswa']) }}" class="nav-link {{ request('role') == 'Siswa' ? 'active' : '' }}">Siswa</a></li>
                                            <li class="nav-item"><a href="{{ route('panel.user.index', ['role' => 'Admin']) }}" class="nav-link {{ request('role') == 'Admin' ? 'active' : '' }}">Admin & Pengajar</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @else
                                {{-- Pengajar hanya melihat link 'Siswa' --}}
                                <li class="nav-item">
                                    <a class="nav-link menu-link {{ $isUserActive ? 'active' : '' }}" href="{{ route('panel.user.index', ['role' => 'Siswa']) }}">
                                        <i class="ri-user-line"></i> <span>Siswa</span>
                                    </a>
                                </li>
                            @endif
                          @endif
                          
                          {{-- ================================= --}}
                          {{-- HANYA UNTUK ADMIN --}}
                          {{-- ================================= --}}
                          @if(auth()->user()->hasRole('Admin'))
                            @php
                                 $isSettingActive = Request::routeIs('panel.role.*') || Request::routeIs('panel.permission.*');
                            @endphp
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
                          @endif
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
        transform: translateX(calc(-100% - 5px));
        /* dorong sedikit lebih jauh ke kiri */
        overflow: hidden;
        opacity: 0;
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
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    /* === Menu utama fix === */
    #navbar-nav>.nav-item {
        width: 100%;
    }

    #navbar-nav>.nav-item>.nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: transparent !important;
        color: #452103 !important;
        padding: 10px 16px;
        margin: 6px 14px !important;
        /* jarak biar ga nempel ke tepi sidebar */
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        box-sizing: border-box;
    }

    /* Hover */
    #navbar-nav>.nav-item>.nav-link:hover {
        background-color: #f0c946 !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Aktif (kotak merah) */
    #navbar-nav>.nav-item>.nav-link.active {
        background-color: var(--primary-red) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    /* Ikon */
    #navbar-nav>.nav-item>.nav-link i {
        color: #452103 !important;
        transition: color 0.25s ease;
        font-size: 18px;
    }

    /* Hover/Aktif ikon */
    #navbar-nav>.nav-item>.nav-link:hover i,
    #navbar-nav>.nav-item>.nav-link.active i {
        color: #fff !important;
    }

    /* Submenu */
    .menu-dropdown .nav-link {
        display: block;
        color: #452103 !important;
        margin: 4px 14px !important;
        /* sama jarak kiri-kanan dengan menu utama */
        padding: 10px 16px !important;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }

    .menu-dropdown .nav-link.active {
        background-color: rgba(152, 0, 0, 0.1) !important;
        color: var(--primary-red) !important;
    }

    .menu-dropdown .nav-link:hover {
        background-color: rgba(240, 201, 70, 0.3) !important;
    }
</style>