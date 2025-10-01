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
            <ul class="navbar-nav " id="navbar-nav">
                <li class="menu-title "><i class="ri-more-fill"></i> <span>admin</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link " href="{{route('panel.dashboard')}}" id="nav-home">
                        <i class="ri-dashboard-2-line"></i> <span>Daashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link " href="{{route('panel.tryout.index')}}" id="nav-tryout">
                        <i class="ri-file-edit-line "></i> <span>Tryout</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link " href="{{route('panel.tryout_open.index')}}" id="nav-tryout-open">
                        <i class="ri-file-paper-line"></i> <span>Tryout Umum</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link " href="{{route('panel.pendaftaran.index')}}" id="nav-tryout">
                        <i class=" ri-newspaper-line "></i> <span>Pendaftaran</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link menu-link " href="#sidebar-referensi" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-setting" id="nav-setting">
                        <i class="ri-database-line   "></i> <span>Referensi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebar-referensi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{ route('panel.bank_soal.index')}}" class="nav-link " id="nav-bank-soal">Bank Soal</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('panel.materi.index')}}" class="nav-link " id="nav-materi">Materi</a>
                            </li>
                           
                            <li class="nav-item ">
                                <a href="{{ route('panel.asal_sekolah.index')}}" class="nav-link " id="nav-asal_sekolah">Asal Sekolah</a>
                            </li>
                           
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link menu-link " href="#sidebar-user" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-setting" id="nav-setting">
                        <i class="ri-user-line  "></i> <span>Users</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebar-user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{ route('panel.user.index','rule=Siswa')}}" class="nav-link " id="nav-siswa">Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.user.index','rule=Admin')}}" class="nav-link " id="nav-admin">Admin & Pengajar</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link menu-link " href="#sidebar-setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-setting" id="nav-setting">
                        <i class="ri-settings-line "></i> <span>Setting</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebar-setting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{ route('panel.role.index')}}" class="nav-link " id="nav-role">Role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.permission.index')}}" class="nav-link " id="nav-permission">Permission</a>
                            </li>
                            
                        </ul>
                    </div>
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

<!-- Sidebar tweaks: fix hide/hover behavior -->
<style>
    /* Ensure sidebar icons remain visible when collapsed/hidden and prevent layout shift */
    .app-menu.navbar-menu { transition: width .2s ease, transform .2s ease; }
    .app-menu.navbar-menu.collapsed {
        width: 70px !important;
        overflow: visible;
    }
    .app-menu .navbar-nav .nav-link i { transition: color .12s ease, transform .12s ease; }
    /* Hover color for icons */
    .app-menu .navbar-nav .nav-link:hover i,
    .app-menu .navbar-nav .nav-link:focus i { color: #fff; transform: translateX(2px); }
    /* When sidebar is collapsed show tooltips-like look using pseudo element */
    .app-menu.navbar-menu.collapsed .nav-link span { display:none !important; }
    .app-menu.navbar-menu.collapsed .menu-title span { display:none !important; }
    /* Also hide any direct text nodes next to icons when collapsed */
    .app-menu.navbar-menu.collapsed .nav-link { white-space: nowrap; }
    .app-menu.navbar-menu.collapsed .nav-link > i + * { display:none !important; }
    .app-menu.navbar-menu.collapsed .menu-title span { display:none; }
    .app-menu .logo-lg img { max-height:36px; }
</style>

<script>
    (function(){
        // Toggle collapsed class when vertical hover button clicked - helps avoid buggy hide state
        var btn = document.getElementById('vertical-hover');
        var menu = document.querySelector('.app-menu.navbar-menu');
        if (btn && menu) {
            btn.addEventListener('click', function(e){
                e.preventDefault();
                menu.classList.toggle('collapsed');
                // ensure overlay hidden when collapsed
                var overlay = document.querySelector('.vertical-overlay');
                if (menu.classList.contains('collapsed')) {
                    overlay.style.display = 'none';
                } else {
                    overlay.style.display = '';
                }
            });
        }
            // Improve hover effect: add pointer cursor on icons
        document.querySelectorAll('.app-menu .nav-link').forEach(function(n){
            n.style.cursor = 'pointer';
        });

        // Robust collapse detection: if sidebar becomes narrow (other scripts/themes may toggle width/style),
        // add .collapsed so our CSS hides labels reliably.
        function updateCollapsedState() {
            try {
                var menu = document.querySelector('.app-menu.navbar-menu');
                if (!menu) return;
                var width = menu.getBoundingClientRect().width;
                if (width && width < 100) {
                    menu.classList.add('collapsed');
                    var overlay = document.querySelector('.vertical-overlay');
                    if (overlay) overlay.style.display = 'none';
                } else {
                    menu.classList.remove('collapsed');
                    var overlay = document.querySelector('.vertical-overlay');
                    if (overlay) overlay.style.display = '';
                }
            } catch (e) { /* ignore */ }
        }

        // Run on load
        updateCollapsedState();
        // Run on resize
        window.addEventListener('resize', updateCollapsedState);
        // Observe attribute/style changes on the menu container
        var target = document.querySelector('.app-menu.navbar-menu');
        if (target && window.MutationObserver) {
            var mo = new MutationObserver(function(mutations) { updateCollapsedState(); });
            mo.observe(target, { attributes: true, attributeFilter: ['class','style'] });
        }
    })();
</script>