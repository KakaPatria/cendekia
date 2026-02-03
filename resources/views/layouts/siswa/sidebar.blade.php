<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" style="background-color: #DBB83E;">
    <div id="scrollbar">
        <div class="container-fluid">
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
    display: block;
    position: relative;
}

/* NAVBAR LIST */
#navbar-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 22px;
    padding-left: 0;
    margin: 0;
    flex-wrap: wrap;
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

/* ============================
   RESPONSIVE MOBILE
   ============================ */
@media (max-width: 991px) {
    .app-menu.navbar-menu {
        position: fixed;
        top: -100%;
        left: 0;
        right: 0;
        width: 100%;
        max-height: calc(100vh - 70px);
        z-index: 1001;
        transition: top 0.3s ease;
        overflow-y: auto;
        padding: 0;
        margin: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .app-menu.navbar-menu.show {
        top: 70px;
    }
    
    .container-fluid {
        padding: 15px;
    }
    
    #navbar-nav {
        flex-direction: column;
        gap: 8px;
        padding: 0;
        margin: 0;
    }
    
    #navbar-nav .nav-link {
        width: 100%;
        justify-content: flex-start;
        padding: 12px 20px;
        border-radius: 8px;
    }
    
    .vertical-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .vertical-overlay.show {
        display: block;
        opacity: 1;
    }
}

/* Desktop */
@media (min-width: 992px) {
    .app-menu.navbar-menu {
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: auto !important;
        display: block !important;
    }
    
    .vertical-overlay {
        display: none !important;
    }
    
    #topnav-hamburger-icon {
        display: none !important;
    }
    
    #navbar-nav {
        flex-direction: row !important;
        padding: 0 !important;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('topnav-hamburger-icon');
    const sidebar = document.querySelector('.app-menu.navbar-menu');
    const overlay = document.querySelector('.vertical-overlay');
    
    if (hamburger && sidebar && overlay) {
        hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            
            const icon = this.querySelector('.hamburger-icon');
            if (icon) {
                icon.classList.toggle('open');
            }
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            
            const icon = hamburger.querySelector('.hamburger-icon');
            if (icon) {
                icon.classList.remove('open');
            }
        });
        
        const navLinks = document.querySelectorAll('#navbar-nav .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 991) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    
                    const icon = hamburger.querySelector('.hamburger-icon');
                    if (icon) {
                        icon.classList.remove('open');
                    }
                }
            });
        });
    }
});
</script>
