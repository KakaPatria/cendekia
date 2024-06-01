@extends('layouts.siswa.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tryout @endslot
@slot('title') Detail Tryout @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xxl-3">

        <div class="card mb-3">
            <div class="card-body">

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
                    @if($tryout_peserta->tryout_peserta_status)
                    <div class="m-2 p-2">
                        <!-- Primary Alert -->
                        <div class="alert alert-primary" role="alert">
                            Anda sudah terdaftar selihkan mengerjakan tryout!
                        </div>

                    </div>
                    @else
                    <div class="m-2 p-2">
                        <!-- warning Alert -->
                        <div class="alert alert-warning" role="alert">
                            Anda belum menyelesaikan pendaftaran silahkan selesaikan <strong><a href="{{ route('siswa.invoice.show',$tryout_peserta->invoice->inv_id)}}">disini</a></strong>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
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
                            <h2 class="accordion-header" id="heading-{{$materi->tryout_materi_id}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $materi->refMateri->ref_materi_judul}}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="heading-{{$materi->tryout_materi_id}}" data-bs-parent="#default-accordion-example">
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
                        <li class="nav-item " role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tryout-soal" role="tab" aria-selected="false" tabindex="-1">
                                Daftar Tryout
                            </a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tryout-hasil-summary" role="tab" aria-selected="false" tabindex="-1">
                                Rangking Rata Rata
                            </a>
                        </li>
                        @foreach($tryout->materi as $materi)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tryout-hasil-{{ $materi->materi_tryout_id}}" role="tab" aria-selected="false" tabindex="-1">
                                Hasil {{ $materi->refMateri->ref_materi_judul}}
                            </a>
                        </li>
                        @endforeach
                        {{--<li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab" aria-selected="false" tabindex="-1">
                                Attachments File (4)
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">
                                Time Entries (9 hrs 13 min)
                            </a>
                        </li>--}}
                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tryout-soal" role="tabpanel">
                        <h5 class="card-title mb-4">Daftar Tryout yang perlu dikerjakan</h5>
                        <ul class="list-group list-group-flush border-dashed">
                            @foreach($tryout->materi as $materi)

                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">25</h5>
                                                <div class="text-muted">Tue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-reset fs-14 mb-0">{{ $materi->refMateri->ref_materi_judul}}</a>
                                        <h5 class="text-muted mt-0 mb-1 fs-13">Jumlah Soal (10)</h5>
                                    </div>
                                    <div class="col-sm-auto">

                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            @endforeach

                        </ul>
                    </div>
                    <div class="tab-pane " id="tryout-hasil-summary" role="tabpanel">
                        <h5 class="card-title mb-4">Rangking Rata Rata</h5>
                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Asal Sekolah </th>
                                        <th scope="col">Rata-Rata</th>
                                        @foreach($tryout->materi as $materi)
                                        <th scope="col">{{ $materi->refMateri->ref_materi_judul}}</th>
                                        @endforeach
                                        <th>Total Nilai</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tryout->getAverageNilai() as $value)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $value['siswa']->name}}</td>
                                        <td>{{ $value['siswa']->asal_sekolah}}</td>
                                        <td>{{ $value['average']}}</td>
                                        @foreach($value['list'] as $list)
                                        <td>{{ $list->nilai}}</td>
                                        @endforeach
                                        <td>{{ $value['sum']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @foreach($tryout->materi as $materi)
                    <div class="tab-pane " id="tryout-hasil-{{$materi->materi_tryout_id}}" role="tabpanel">
                        <h5 class="card-title mb-4">Rangking {{ $materi->refMateri->ref_materi_judul}}</h5>
                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Asal Sekolah </th>
                                        <th scope="col">Nilai </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materi->nilai->sortByDesc('nilai') as $value)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $value->siswa->name}}</td>
                                        <td>{{ $value->siswa->asal_sekolah}}</td>
                                        <td>{{ $value->nilai}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <!--end tab-pane-->
                    {{-- <div class="tab-pane" id="messages-1" role="tabpanel">
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
                    <div class="tab-pane " id="profile-1" role="tabpanel">
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
                    </div>--}}
                    <!--edn tab-pane-->

                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

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