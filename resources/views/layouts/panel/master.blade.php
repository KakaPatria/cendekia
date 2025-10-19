<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')| LBB CENDEKIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
<style>
    /* === Layout Responsif Sidebar === */
    body {
        transition: background-color 0.2s ease;
    }

    .main-content {
        margin-left: 250px; /* Lebar sidebar saat terbuka */
        transition: margin-left 0.25s cubic-bezier(.4,0,.2,1);
    }

    /* Make topbar shift horizontally when sidebar opens/closes.
       When sidebar is open: topbar is offset to the right by the sidebar width (250px).
       When sidebar is collapsed: topbar sits at left:0 and becomes full width again. */
    #page-topbar {
        position: fixed;
        top: 0;
        left: 250px; /* align with main-content when sidebar is open */
        width: calc(100% - 250px);
        transition: left 0.25s ease, width 0.25s ease;
        z-index: 1100; /* pastikan topbar di atas sidebar */
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        will-change: left, width;
    }

    /* Saat sidebar ditutup: kembalikan topbar ke kiri (full width) */
    body.sidebar-collapsed #page-topbar {
        left: 0;
        width: 100%;
    }

    /* Pastikan elemen dalam topbar tidak ikut bergeser/animated untuk menghindari flicker */
    #page-topbar .header-item, #page-topbar .topbar-user, #page-topbar .navbar-header {
        will-change: transform, opacity;
        backface-visibility: hidden;
        transform: translateZ(0);
    }

    /* Sidebar animasi */
    #sidebar-menu {
        width: 250px;
        transition: transform 0.3s ease;
        transform: translateX(0);
    }

    #sidebar-menu.closed {
        transform: translateX(-100%);
    }

    /* Logo horizontal pada panel topbar (menyeragamkan dengan master) */
    .navbar-brand-box.horizontal-logo {
        display: flex;
        align-items: center;
        margin-right: 0.5rem;
    }

    /* Biar overlay tidak menghalangi klik */
    .vertical-overlay {
        display: none !important;
        pointer-events: none;
    }

    /* Responsif: pada layar kecil (HP/tablet) */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0 !important;
        }
        /* Pada layar kecil topbar tidak perlu bergeser */
        #page-topbar {
            left: 0 !important;
            width: 100% !important;
            transition: none !important;
        }
    }

    /* Make wrapper/layout-width follow sidebar closed state so overall master layout aligns */
    body.sidebar-collapsed #layout-wrapper {
        /* Optional: reduce left offset/padding if any theme added it */
        padding-left: 0 !important;
    }

    body.sidebar-collapsed .layout-width {
        margin-left: 0 !important;
        padding-left: 0 !important;
    }

    /* Stronger, more specific overrides to beat vendor CSS that targets
       [data-layout=vertical] and layout-width. These ensure the master
       layout elements follow the sidebar-collapsed state. */
    html[data-layout="vertical"] .main-content {
        margin-left: 250px !important;
    }

    html[data-layout="vertical"] body.sidebar-collapsed .main-content {
        margin-left: 0 !important;
    }

    html[data-layout="vertical"] #page-topbar {
        left: 250px !important;
        width: calc(100% - 250px) !important;
    }

    html[data-layout="vertical"] body.sidebar-collapsed #page-topbar {
        left: 0 !important;
        width: 100% !important;
    }

    html[data-layout="vertical"] body.sidebar-collapsed #layout-wrapper {
        padding-left: 0 !important;
        margin-left: 0 !important;
        max-width: none !important;
    }

    html[data-layout="vertical"] body.sidebar-collapsed .layout-width {
        margin-left: 0 !important;
        padding-left: 0 !important;
        max-width: 100% !important;
    }
</style>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.panel.topbar')
        @include('layouts.panel.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.getElementById("topnav-hamburger-icon");
    const sidebar = document.getElementById("sidebar-menu");
    // Restore sidebar state from localStorage if available
    try {
        const saved = localStorage.getItem('cendekia.sidebar.closed');
        if (sidebar) {
            if (saved === 'true') {
                sidebar.classList.add('closed');
                document.body.classList.add('sidebar-collapsed');
            } else if (saved === 'false') {
                sidebar.classList.remove('closed');
                document.body.classList.remove('sidebar-collapsed');
            } else {
                // default: open
                sidebar.classList.remove('closed');
                document.body.classList.remove('sidebar-collapsed');
            }
        }
    } catch (e) {
        // localStorage may be disabled; ignore silently
        console.warn('localStorage not available for sidebar state persistence', e);
    }

    // Toggle sidebar saat klik hamburger (hanya jika kedua elemen ada)
    if (hamburger && sidebar) {
        // initialize aria-expanded based on sidebar presence
        const isClosed = sidebar.classList.contains('closed');
        hamburger.setAttribute('aria-expanded', (!isClosed).toString());

        hamburger.addEventListener("click", function() {
            sidebar.classList.toggle("closed");
            document.body.classList.toggle("sidebar-collapsed");
            const nowClosed = sidebar.classList.contains('closed');
            // aria-expanded should be true when sidebar is visible
            hamburger.setAttribute('aria-expanded', (!nowClosed).toString());
            // persist to localStorage
            try {
                localStorage.setItem('cendekia.sidebar.closed', nowClosed ? 'true' : 'false');
            } catch (e) {
                // ignore storage errors (privacy mode, etc.)
            }
        });
    }
});
</script>


</body>

</html>
