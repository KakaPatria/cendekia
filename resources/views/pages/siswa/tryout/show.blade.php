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
                                <td class="fw-medium">Jenjang</td>
                                <td>{{ $tryout->tryout_jenjang.' kelas '.$tryout->tryout_kelas}}</td>
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
                    @if(!$tryout->isTerdaftar($tryout->tryout_id))
                    <div class="m-2 p-2">
                        <a href="{{route('siswa.tryout.daftar',$tryout->tryout_id)}}" class="btn btn-danger w-100" oncli>
                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                            Daftar
                        </a>
                    </div>
                    @else
                    <div class="m-2 p-2">
                        <a href="button" class="btn btn-danger w-100 disabled" oncli>
                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                            Anda sudah terdaftar
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-header">
                <div class="align-items-center d-flex mb-2">
                    <div class="flex-grow-1">
                        <h6 class=" fw-bold text-uppercase">{{ $tryout->tryout_judul}}</h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div>
                            <a href="javascript:history.back()" id="back-btn" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted"> 
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#tryout-peserta" role="tab" aria-selected="false" tabindex="-1">
                                Peserta ({{ $tryout->peserta->count()}})
                            </a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tryout-hasil-summary" role="tab" aria-selected="false" tabindex="-1">
                                Rangking Rata Rata
                            </a>
                        </li>
                        @foreach($tryout->materi as $materi)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tryout-hasil-{{ $materi->tryout_materi_id}}" role="tab" aria-selected="false" tabindex="-1">
                                Rangking {{ $materi->refMateri->ref_materi_judul}}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tryout-peserta" role="tabpanel">
                        <h5 class="card-title mb-4">Daftar Peserta</h5>
                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Asal Sekolah</th>
                                        <th scope="col">Jenjang</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Tanggal Pendaftaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($tryout->peserta as $peserta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($peserta->siswa)->name ?? $peserta->tryout_peserta_name ?? 'Nama tidak tersedia' }}</td>
                                    <td>{{ optional($peserta->siswa)->asal_sekolah ?? '-' }}</td>
                                    <td>{{ optional($peserta->siswa)->jenjang ?? '-' }}</td>
                                    <td>{{ optional($peserta->siswa)->kelas ?? '-' }}</td>
                                    <td>{{ $peserta->tanggal_daftar ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada peserta.</td>
                                </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
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
                                        <td>{{ round($value['average'],2)}}</td>
                                        @foreach($tryout->materi as $materi)
                                        <td>
                                            @if(isset($value['list'][$materi->tryout_materi_id]))
                                            {{ round($value['list'][$materi->tryout_materi_id]['nilai'],2) }}
                                            @endif
                                        </td>
                                        @endforeach
                                        <td>{{ round($value['sum'],2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @foreach($tryout->materi as $materi)
                    <div class="tab-pane " id="tryout-hasil-{{$materi->tryout_materi_id}}" role="tabpanel">
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
                                        <td>{{ round($value->nilai,2)}}</td>

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
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Hapus</a></li>
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
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Hapus</a></li>
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
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Hapus</a></li>
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
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Hapus</a></li>
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