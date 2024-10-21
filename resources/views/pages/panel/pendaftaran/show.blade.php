@extends('layouts.panel.master')
@section('title') Pendaftaran @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Detail @endslot
@slot('title') Pendaftaran Tryout @endslot
@endcomponent

@include('components.message')
<div class="d-flex justify-content-sm-end gap-2 ">
    <div>
        <a href="{{ route('panel.pendaftaran.index')}}" class="btn btn-success btn-sm mb-2"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <div class="align-items-center d-flex mb-2">

                        <div class="flex-grow-1">

                            <h6 class="mb-3 fw-bold text-uppercase">Detial Peserta</h6>
                        </div>
                        <div class="flex-shrink-0">
                            @if(!$peserta->tryout_peserta_status)
                            <a href="javascript:;" class="btn rounded-pill btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#approva-peserta-modal">
                                <i class="fa fa-edit"></i> Terima</a>
                            @endif
                        </div>

                    </div>
                    <div class="table-card mb-2">
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">Nama</td>
                                    <td colspan="2">{{ $peserta->tryout_peserta_name}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Telepon</td>
                                    <td>{{ $peserta->tryout_peserta_telpon}}</td>
                                    <td class="text-end">
                                        @if($peserta->tryout_peserta_status)
                                        <a href="{{ $wa_link}}" target="_blank" class="btn rounded-pill btn-success btn-sm" >
                                            <i class="fa fa-edit"></i> Kirim Konfrimasi</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Email</td>
                                    <td colspan="2">{{ $peserta->tryout_peserta_email}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Alamat</td>
                                    <td colspan="2">{{ $peserta->tryout_peserta_alamat}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Status</td>
                                    <td colspan="2">{!! $peserta->status_badge !!}</td>
                                </tr>

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <div class="align-items-center d-flex mb-2">

                        <div class="flex-grow-1">

                            <h6 class="mb-3 fw-bold text-uppercase">{{ $peserta->masterTryout->tryout_judul}}</h6>
                        </div>

                    </div>

                    <div class="mb-2">
                        {!! $peserta->masterTryout->tryout_deskripsi!!}

                    </div>
                    <div class="table-card mb-2">
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">Pendaftaran Dibuka s/d</td>
                                    <td>{{ $peserta->masterTryout->tryout_register_due}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Status</td>
                                    <td>{{ $peserta->masterTryout->tryout_status}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Jenis</td>
                                    <td>{{ $peserta->masterTryout->tryout_jenis}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Biaya</td>
                                    <td>{{ $peserta->masterTryout->tryout_nominal}}</td>
                                </tr>

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <h6 class=" fw-bold text-uppercase">Materi</h6>
                    <ul class="list-group">
                        @foreach($peserta->masterTryout->materi as $materi)

                        <li class="list-group-item"><i class="ri-file-copy-2 align-middle me-2"></i> {{ $materi->refMateri->ref_materi_judul}}</li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="approva-peserta-modal" tabindex="-1" aria-labelledby="approva-peserta-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approva-peserta-modalLabel">Terima Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menerima pendaftaran <strong id="deleteName">{{ $peserta->tryout_peserta_name}}</strong>
                <form action="{{ route('panel.pendaftaran.approve',$peserta->tryout_peserta_id)}}" method="POST" id="approve-form">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="approve-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
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