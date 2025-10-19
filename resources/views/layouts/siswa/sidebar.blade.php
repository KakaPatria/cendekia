<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" id="sidebar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo -->
        <a href="{{ route('siswa.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo -->
        <a href="{{ route('siswa.dashboard') }}" class="logo logo-light">
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

                <!-- MENU ASLI DARI SISWA -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('siswa.dashboard') ? 'active' : '' }}" href="{{route('siswa.dashboard')}}">
                        <i class="ri-home-3-line"></i> <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('siswa.tryout.library') ? 'active' : '' }}" href="{{route('siswa.tryout.library')}}">
                        <i class="ri-book-line"></i> <span>Perpustakaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('siswa.tryout.index') ? 'active' : '' }}" href="{{route('siswa.tryout.index')}}">
                        <i class="ri-todo-line"></i> <span>Tryout</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('siswa.invoice.index') ? 'active' : '' }}" href="{{route('siswa.invoice.index')}}">
                        <i class="ri-wallet-3-fill"></i> <span>Pembayaran</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<div class="vertical-overlay"></div>

<!-- ================= STYLE SIDEBAR ================= -->
<style>
:root {
    --primary-red: #980000;
    --primary-red-hover: #B92B27;
    --primary-yellow: #E2B602;
    --logo-bg: #D4B237;
}

/* Sidebar utama */
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

/* Scroll area */
#scrollbar {
    height: calc(100vh - 100px);
    overflow-y: auto;
    overflow-x: hidden;
    padding-bottom: 2rem;
}

/* Area logo */
.navbar-brand-box {
    background: var(--logo-bg) !important;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

/* Link utama menu */
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
</style>
