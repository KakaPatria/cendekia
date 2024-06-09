@extends('layouts.siswa.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tryout {{ $pengerjaan->soal->materi->refMateri->ref_materi_judul}} @endslot
@slot('title') Analisa @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col">

        <div class="card mb-3">
            <div class="card-header">
                <div class="align-items-center d-flex mb-2">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Analisa Soal Nomor {{ $pengerjaan->soal->tryout_nomor}}</h5>
                    </div>
                    <div class="flex-shrink-0">
                    <a href="javascript:history.back()" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    @if($pengerjaan->soal->materi->jenis_soal == 'PDF')

                    <div class="col-lg-3">
                        <h5 class="mb-2"> <small class="text-muted">Soal</small></h5>

                        <div class="text-center">
                            <a class="image-popup w-20" href="{{ Storage::url($pengerjaan->soal->tryout_soal) }}" title="">
                                <img class="gallery-img img-fluid mx-auto w-50 border border-dark" src="{{ Storage::url($pengerjaan->soal->tryout_soal) }}" alt="">
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h5 class="mb-2"> <small class="text-muted">Penyelesain</small></h5>
                        <div class="text-center">
                            <a class="image-popup w-20" href="{{ Storage::url($pengerjaan->soal->tryout_penyelesaian) }}" title="">
                                <img class="gallery-img img-fluid mx-auto w-50 border border-dark" src="{{ Storage::url($pengerjaan->soal->tryout_penyelesaian) }}" alt="">
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="container-fluid overflow-auto">
                        {!! $pengerjaan->soal->tryout_soal !!}

                    </div>
                    @endif


                    <div class="col-lg-6">
                        <h5 class="mb-2"> <small class="text-muted">Jawaban</small></h5>
                        <h5 class="mb-2"> <small class=" ">Jawaban Anda {{ $pengerjaan->tryout_jawaban}}</small></h5>
                        <table class="table table-responsive">
                            <tbody>
                                @foreach($pengerjaan->soal->jawaban as $jawaban)
                                <tr>
                                    <td class="col-1"><input class="form-check-input" type="radio" name="" value="A" id="" @if ($pengerjaan->soal->tryout_kunci_jawaban == $jawaban->tryout_jawaban_prefix){{ 'checked'}}@endif disabled></td>
                                    <td class="col-1">{{$jawaban->tryout_jawaban_prefix}}.</td>
                                    <td>{{$jawaban->tryout_jawaban_isi}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
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