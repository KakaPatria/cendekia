@extends('layouts.panel.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Detail @endslot
@slot('title') Tryout @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-bold text-uppercase">{{ $tryout->tryout_judul}}</h6>
                    {!! $tryout->tryout_deskripsi!!}

                    <h6 class="mb-3 fw-bold text-uppercase">Materi</h6>


                    <!-- Base Example -->
                    <div class="accordion" id="default-accordion-example">
                        @foreach($tryout->materi as $materi)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $materi->refMateri->ref_materi_judul}}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                    {{ $materi->tryout_materi_deskripsi}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>


                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false" tabindex="-1">
                                Comments (5)
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab" aria-selected="false" tabindex="-1">
                                Attachments File (4)
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">
                                Time Entries (9 hrs 13 min)
                            </a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane" id="home-1" role="tabpanel">
                        <h5 class="card-title mb-4">Comments</h5>
                        <div data-simplebar="init" style="height: 508px;" class="px-3 mx-n3 mb-2">
                            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content" style="padding: 0px 16px;">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15"><a href="pages-profile.html">Joseph Parker</a> <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                        <p class="text-muted">I am getting message from customers that when they place order always get error message .</p>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0">
                                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-15"><a href="pages-profile.html">Tonya Noble</a> <small class="text-muted">22 Dec 2021 - 02:32PM</small></h5>
                                                                <p class="text-muted">Please be sure to check your Spam mailbox to see if your email filters have identified the email from Dell as spam.</p>
                                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15"><a href="pages-profile.html">Thomas Taylor</a> <small class="text-muted">24 Dec 2021 - 05:20PM</small></h5>
                                                        <p class="text-muted">If you have further questions, please contact Customer Support from the “Action Menu” on your <a href="javascript:void(0);" class="text-decoration-underline">Online Order Support</a>.</p>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15"><a href="pages-profile.html">Tonya Noble</a> <small class="text-muted">26 min ago</small></h5>
                                                        <p class="text-muted">Your <a href="javascript:void(0)" class="text-decoration-underline">Online Order Support</a> provides you with the most current status of your order. To help manage your order refer to the “Action Menu” to initiate return, contact Customer Support and more.</p>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-lg-1 col-sm-2 col-6">
                                                                <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                                            </div>
                                                            <div class="col-lg-1 col-sm-2 col-6">
                                                                <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid rounded">
                                                            </div>
                                                        </div>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0">
                                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-15"><a href="pages-profile.html">Nancy Martino</a> <small class="text-muted">8 sec ago</small></h5>
                                                                <p class="text-muted">Other shipping methods are available at checkout if you want your purchase delivered faster.</p>
                                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                            </div>
                        </div>
                        <form class="mt-4">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Leave a Comments</label>
                                    <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" placeholder="Enter comments"></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></button>
                                    <a href="javascript:void(0);" class="btn btn-success">Post Comments</a>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">File Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Upload Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                        <i class="ri-file-zip-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0)" class="link-secondary">App pages.zip</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Zip File</td>
                                        <td>2.22 MB</td>
                                        <td>21 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                        <i class="ri-file-pdf-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="link-secondary">Velzon admin.ppt</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>PPT File</td>
                                        <td>2.24 MB</td>
                                        <td>25 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                        <i class="ri-folder-line"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="link-secondary">Images.zip</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>ZIP File</td>
                                        <td>1.02 MB</td>
                                        <td>28 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="link-secondary">Bg-pattern.png</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>PNG File</td>
                                        <td>879 KB</td>
                                        <td>02 Nov 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane active show" id="profile-1" role="tabpanel">
                        <h6 class="card-title mb-4 pb-2">Time Entries</h6>
                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Member</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Timer Idle</th>
                                        <th scope="col">Tasks Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                <div class="flex-grow-1 ms-2">
                                                    <a href="pages-profile.html" class="fw-medium link-secondary">Thomas Taylor</a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>02 Jan, 2022</td>
                                        <td>3 hrs 12 min</td>
                                        <td>05 min</td>
                                        <td>Apps Pages</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                <div class="flex-grow-1 ms-2">
                                                    <a href="pages-profile.html" class="fw-medium link-secondary">Tonya Noble</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>28 Dec, 2021</td>
                                        <td>1 hrs 35 min</td>
                                        <td>-</td>
                                        <td>Profile Page Design</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                <div class="flex-grow-1 ms-2">
                                                    <a href="pages-profile.html" class="fw-medium link-secondary">Tonya Noble</a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>27 Dec, 2021</td>
                                        <td>4 hrs 26 min</td>
                                        <td>03 min</td>
                                        <td>Ecommerce Dashboard</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--edn tab-pane-->

                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3">

        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-4">
                    @if($tryout->tryout_banner)
                    <a class="image-popup" href="{{ Storage::url($tryout->tryout_banner) }}" title="">
                        <img class="gallery-img img-fluid mx-auto" src="{{ Storage::url($tryout->tryout_banner) }}" alt="">
                    </a>
                    @endif
                </div>
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Pendaftaran Dibuka s/d</td>
                                <td>{{ $tryout->tryout_register_due}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Status</td>
                                <td>{{ $tryout->tryout_status}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Jenis</td>
                                <td>{{ $tryout->tryout_jenis}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Biaya</td>
                                <td>{{ $tryout->tryout_nominal}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>

    </div>
    <!---end col-->

</div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>


<script>
    $('#nav-tryout').addClass('active')
</script>
@endsection