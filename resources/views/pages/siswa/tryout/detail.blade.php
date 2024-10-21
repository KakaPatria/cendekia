@extends('layouts.siswa.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

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
                    <div class="mb-2">
                        {!! $tryout->tryout_deskripsi!!}
                    </div>
                    <h6 class="mb-2 fw-bold text-uppercase">Materi</h6>


                    <!-- Base Example -->
                    <div class="row">
                        @foreach($tryout->materi as $materi)
                        <div class="col-xxl-3 col-sm-6 project-card">
                            <div class="card card ribbon-box border ribbon-fill shadow-none right mb-lg-0">
                                <div class="card-body">
                                    @if($materi->nilaiUser && $materi->nilaiUser->status == 'Selesai')
                                    <h5 class="ribbon ribbon-info">Selesai</h5>
                                    @endif
                                    <div class="d-flex flex-column h-100">
                                        <div class="d-flex mb-2">

                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fs-16"><a href="apps-projects-overview.html" class="text-dark">{{ $materi->refMateri->ref_materi_judul}}</a></h5>
                                                <p class="text-muted text-truncate-two-lines mb-3">{{ $materi->tryout_materi_deskripsi}}</p>
                                                <div>
                                                    <p class="text-muted mb-1">Pengajar</p>
                                                    <h5 class="fs-14">{{ $materi->pengajar->name ?? ''}}</h5>
                                                </div>
                                                <div>
                                                    <p class="text-muted mb-1">Periode Pengerjaan</p>
                                                    <h5 class="fs-14">{{ $materi->periode}}</h5>
                                                </div>
                                                @if($materi->periode_mulai && $tryout)
                                                <div>
                                                    <p class="text-muted mb-1">Jam Pengerjaan</p>
                                                    <h5 class="fs-14">{{ $materi->waktu}}</h5>
                                                </div>
                                                @endif
                                                @if($materi->durasi)
                                                <div>
                                                    <p class="text-muted mb-1">Durasi Pengerjaan</p>
                                                    <h5 class="fs-14">{{ $materi->durasi / 60}} Menit</h5>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($materi->nilaiUser)
                                        <div class="mt-auto">
                                            <div class="d-flex mb-2">
                                                <div class="flex-grow-1">
                                                    <div>Progres</div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div><i class="ri-list-check align-bottom me-1 text-muted"></i> {{ $materi->nilaiUser->soal_dijekerjakan .'/'.$materi->nilaiUser->soal_total}}</div>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm animated-progress">
                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $materi->nilaiUser->progres_persen}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $materi->nilaiUser->progres_persen}}%;"></div><!-- /.progress-bar -->
                                            </div><!-- /.progress -->
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                <!-- end card body -->
                                <div class="card-footer bg-transparent border-top-dashed py-2">
                                    <div class="text-center">

                                        @if($tryout->tryout_status == 'Aktif')
                                        @if(!$materi->in_periode)
                                        <div class="alert alert-danger mb-xl-0" role="alert">
                                            Tidak dalam periode tryout
                                        </div>
                                        @else
                                        @if($materi->nilaiUser)
                                        @if($materi->nilaiUser->status == 'Proses')
                                        <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm lanjutkan-btn" data-action="{{ route('siswa.tryout.pengerjaan.create',$materi->tryout_materi_id)}}">
                                            <i class="fa fa-edit"></i> Lanjutkan
                                        </a>
                                        @endif
                                        @else
                                        <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm kerjakan-btn" data-action="{{ route('siswa.tryout.pengerjaan.create',$materi->tryout_materi_id)}}">
                                            <i class="fa fa-edit"></i> Kerjakan
                                        </a>
                                        @endif
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                <!-- end card footer -->
                            </div>
                            <!-- end card -->
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#tryout-hasil-summary" role="tab" aria-selected="false" tabindex="-1">
                                Rangking Rata Rata
                            </a>
                        </li>
                        @foreach($tryout->materi as $kMateri => $materi)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tryout-hasil-{{ $materi->tryout_materi_id}}" role="tab" aria-selected="false" tabindex="{{ $kMateri}}">
                                Hasil {{ $materi->refMateri->ref_materi_judul}}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active show " id="tryout-hasil-summary" role="tabpanel">
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
                                        <th>Total Point</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tryout->getAverageNilai() as $value)
                                    @if($value['siswa'])
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
                                        <td>{{ round($value['total_point'],2)}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @foreach($tryout->materi as $materi)
                    <div class="tab-pane " id="tryout-hasil-{{$materi->tryout_materi_id}}" role="tabpanel">
                        <h5 class="card-title mb-4">Analisa Pengerjaan {{ $materi->refMateri->ref_materi_judul}}</h5>
                        @if($materi->nilaiUser && $materi->nilaiUser->status == 'Selesai')

                        <div class="row p-2">
                            <div class="col-3">
                                <div>
                                    <p class="text-muted mb-1">Total Point</p>
                                    <h5 class="fs-14">{{$materi->nilaiSiswa->total_point}}</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <p class="text-muted mb-1">Nilai</p>
                                    <h5 class="fs-14">{{round($materi->nilaiSiswa->nilai,2)}}</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <p class="text-muted mb-1">Jumlah Benar</p>
                                    <h5 class="fs-14">{{$materi->nilaiSiswa->jumlah_benar}}</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <p class="text-muted mb-1">Jumlah Salah</p>
                                    <h5 class="fs-14">{{$materi->nilaiSiswa->jumlah_salah}}</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <p class="text-muted mb-1">Lama Pengerjaan</p>
                                    <h5 class="fs-14">{{$materi->nilaiSiswa->durasi_pengerjaan}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-2">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Jawaban </th>
                                        <th scope="col">Kunci Jawaban</th>
                                        <th scope="col">Point</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materi->soal as $soal)
                                    <tr>

                                        <td>{{ $soal->tryout_nomor}}</td>
                                        <td>{{ $soal->pengerjaan->tryout_jawaban ?? ''}}</td>
                                        <td>{{ implode(', ', json_decode($soal->tryout_kunci_jawaban))}}</td>
                                        <td>{{ $soal->point}}</td>
                                        <td>{!! $soal->pengerjaan->status_badge ?? '' !!}</td>
                                        <td>
                                            @if($soal->pengerjaan)
                                            <a href="{{ route('siswa.tryout.pengerjaan.analisa',$soal->pengerjaan->tryout_pengerjaan_id) }}" class="btn rounded-pill btn-info btn-sm">
                                                <i class="fa fa-edit"></i> Detail
                                            </a>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        @else
                        <div class="alert alert-warning" role="alert">
                            Tryout belum dikerjakan
                        </div>
                        @endif
                    </div>
                    @endforeach


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
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>


<script>
    $('#nav-tryout').addClass('active')

    $('.lanjutkan-btn').click(function() {
        var action = $(this).data('action')
        Swal.fire({
            title: "Siap lanjutkan tryout?",
            text: "Persiapkan diri anda dan berdoa",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "kembali",
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Mulai!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.href = action;
            }
        });
    })
    $('.kerjakan-btn').click(function() {
        var action = $(this).data('action')
        Swal.fire({
            title: "Siap memulai tryout?",
            text: "Persiapkan diri anda dan berdoa",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "kembali",
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Mulai!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.href = action;
            }
        });
    })
</script>
@endsection