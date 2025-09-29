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
                @if(Auth::user()->hasRole(['Admin']))
                
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
                        <i class="ri-database-line   "></i>Referensi</span>
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
                        <i class="ri-user-line  "></i>Users</span>
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
                        <i class="ri-settings-line "></i>Setting</span>
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
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>