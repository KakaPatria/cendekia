<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-layout="vertical" data-topbar="light" data-sidebar="light"
      data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8"/>
    <title>@yield('title') | LBB CENDEKIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show

<style>
    /* ==== COPY DARI SCRIPT KEDUA (layout vertical + responsive) ==== */
    body { transition: background-color 0.2s ease; }
    .main-content {
        margin-left: 250px;
        transition: margin-left 0.25s cubic-bezier(.4,0,.2,1);
    }
    #page-topbar {
        position: fixed; top: 0; left: 250px;
        width: calc(100% - 250px);
        transition: left 0.25s ease, width 0.25s ease;
        z-index: 1100;
    }
    body.sidebar-collapsed #page-topbar { left:0; width:100%; }
    #sidebar-menu { width: 250px; transition: transform .3s ease; }
    #sidebar-menu.closed { transform: translateX(-100%); }
    @media (max-width:992px){
        .main-content { margin-left: 0 !important; }
        #page-topbar { left:0 !important; width:100% !important; }
    }
    html[data-layout="vertical"] .main-content { margin-left: 250px !important; }
    html[data-layout="vertical"] body.sidebar-collapsed .main-content { margin-left: 0 !important; }
</style>

<body>

<div id="layout-wrapper">
    {{-- ✅ Tetap menggunakan menu/topbar dari script asli siswa --}}
    @include('layouts.siswa.topbar')
    @include('layouts.siswa.sidebar')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

@include('layouts.vendor-scripts')

<script>
    // === COPY dari script kedua (toggle sidebar) ===
    document.addEventListener("DOMContentLoaded", function() {
        const hamburger = document.getElementById("topnav-hamburger-icon");
        const sidebar = document.getElementById("sidebar-menu");
        try {
            const saved = localStorage.getItem('cendekia.sidebar.closed');
            if (saved === 'true') {
                sidebar.classList.add('closed');
                document.body.classList.add('sidebar-collapsed');
            }
        } catch (e) {}

        if (hamburger && sidebar) {
            const isClosed = sidebar.classList.contains('closed');
            hamburger.setAttribute('aria-expanded', (!isClosed).toString());
            hamburger.addEventListener("click", function() {
                sidebar.classList.toggle("closed");
                document.body.classList.toggle("sidebar-collapsed");
                const nowClosed = sidebar.classList.contains('closed');
                hamburger.setAttribute('aria-expanded', (!nowClosed).toString());
                localStorage.setItem('cendekia.sidebar.closed', nowClosed ? 'true' : 'false');
            });
        }
    });
</script>

</body>
</html>
