@extends('layouts.siswa.master')
@section('title') Profile @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('components.message')


<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <div class="bg-overlay" style="background-color : #f5e38f;"></div>
        <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
    </div>
</div>
<div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
    <div class="row g-4">
        <div class="col-auto">

            <div class="text-center">
                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                    <img src="@if (Auth::user()->avatar != '') {{ Storage::url( Auth::user()->avatar) }}@else{{ URL::asset('assets/images/users/user-dummy-img.jpg') }} @endif" class="  rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image" id="profile-img-file">

                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1">{{ Auth::user()->name}}</h3>
                <p class="text-white-75">Kelas {{ Auth::user()->kelas.' '.Auth::user()->jenjang}}
                    <br> Telepon : {{ Auth::user()->telepon}}
                    <br> Email : {{ Auth::user()->email}}
                    <br> Nama Orangtua : {{ Auth::user()->nama_orang_tua}}
                    <br> Telepon Orangtua : {{ Auth::user()->tlp_orang_tua}}
                </p> 
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ Auth::user()->alamat}}</div>
                    <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>{{ Auth::user()->asal_sekolah}}
                    </div>
                </div>
            </div>
        </div>

        <!--end col-->

    </div>
    <!--end row-->
</div>

<div class="row">
    <div class="col-lg-12">
        <div>
            <div class="d-flex">
                <!-- Nav tabs -->
                {{--<ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                            <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">About</span>
                        </a>
                    </li>
                     
                </ul>--}}
                <div></div>
                <div class="flex-shrink-0">
                    <a href="{{ route('siswa.profile.edit')}}" class="btn btn-warning"><i class="ri-edit-box-line align-bottom"></i> Ubah Profil</a>
                </div>
            </div>
            <!-- Tab panes -->
            {{--<div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                 
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">About</h5>
                                   
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-user-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Designation :</p>
                                                    <h6 class="text-truncate mb-0">Lead Designer /
                                                        Developer</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-md-4">
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-global-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Website :</p>
                                                    <a href="#" class="fw-semibold">www.velzon.com</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div><!-- end card -->

                           
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>

                <!--end tab-pane-->
            </div>--}}
            <!--end tab-content-->
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection