@extends('layouts.panel.master')
@section('title') Bank SOAL @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Referensi @endslot
@slot('title') Bank soal @endslot
@endcomponent

@include('components.message')
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <div class="align-items-center d-flex">
                    <div class="flex-grow-1">
                        <h6 class="mb-2 fw-bold text-uppercase">{{ $bank_soal->refMateri->ref_materi_judul}}</h6>

                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2">

                            <a href="{{ route('panel.bank_soal.index')}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted">
                    <div class="row mb-2">
                        <div class="col-2">
                            <p class="text-muted mb-1">Jenjang</p>
                            <h5 class="fs-14">{{ $bank_soal->refMateri->ref_materi_jenjang}}</h5>
                        </div>
                        <div class="col-2">
                            <p class="text-muted mb-1">Kelas</p>
                            <h5 class="fs-14">{{ $bank_soal->refMateri->ref_materi_kelas}}</h5>
                        </div>

                    </div>
                    <div class="mb-2">
                        <p>{!! $bank_soal->tryout_materi_deskripsi!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end card-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header">
                <div class="align-items-center d-flex">
                    <div class="flex-grow-1">
                        <h6 class="mb-2 fw-bold text-uppercase">Soal</h6>

                    </div>
                    @if($bank_soal->jenis_soal == 'PDF')

                    <div class="flex-shrink-0">
                        <div>
                            <a href="{{ Storage::url($bank_soal->master_soal)}}" target="_blank" class="btn btn-secondary btn-sm"><i class="ri-file-download-line   align-bottom me-1"></i> Download File</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <div class="card-body mb-2">
                <div class="live-preview">
                    @foreach($bank_soal->soal as $soal)
                    <h5 class="fs-14">{{ $soal->tryout_nomor}}</h5>

                    <div class="row">
                        @if($bank_soal->jenis_soal == 'PDF')

                        <div class="col-lg-3">

                            <a class="image-popup w-20" href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                <img class="gallery-img img-fluid mx-auto w-50 border border-dark" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                            </a>

                        </div>
                        <div class="col-lg-3">

                            <a class="image-popup w-20" href="{{ Storage::url($soal->tryout_penyelesaian) }}" title="">
                                <img class="gallery-img img-fluid mx-auto w-50 border border-dark" src="{{ Storage::url($soal->tryout_penyelesaian) }}" alt="">
                            </a>

                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="container-fluid overflow-auto">
                                {!! $soal->tryout_soal !!}

                            </div>
                        </div>
                        @endif

                        <div class="col-lg-6">
                            <div class="flex-shrink-0">


                            </div>
                            <table class="table table-responsive">
                                <tbody>
                                    @if($soal->tryout_soal_type != 'TF')
                                    <table class="table table-responsive">
                                        <tbody>
                                            @foreach($soal->jawaban as $jawaban)
                                            <tr>
                                                <td class="col-1"><input class="form-check-input" type="checkbox" name="" value="A" id="" @if(($soal->tryout_kunci_jawaban) && in_array($jawaban->tryout_jawaban_prefix,json_decode($soal->tryout_kunci_jawaban) )){{ 'checked'}}@endif disabled></td>
                                                <td class="col-1">{{$jawaban->tryout_jawaban_prefix}}.</td>
                                                <td>{{$jawaban->tryout_jawaban_isi}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    @endif
                                    @if($soal->tryout_soal_type === 'TF')
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pernyataan</th>
                                                    <th style="width: 120px;">Kunci Jawaban</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $opsi = $soal->jawaban;
                                                $kunci = json_decode($soal->tryout_kunci_jawaban, true) ?? [];
                                                $prefix = explode(',',$soal->notes);
                                                $arrayPrefix['Benar'] = $prefix[0];
                                                $arrayPrefix['Salah'] = $prefix[1];
                                                @endphp

                                                @foreach ($opsi as $index => $jawaban)
                                                <tr>
                                                    <td>{!! $jawaban->tryout_jawaban_isi !!}</td>
                                                    <td>
                                                        @php
                                                        $key = $jawaban->tryout_jawaban_prefix;
                                                        $nilai = $kunci[$key] ?? '-';
                                                        @endphp
                                                        <span class="badge 
                                {{ $nilai === 'Benar' ? 'bg-success' : 
                                   ($nilai === 'Salah' ? 'bg-danger' : 'bg-secondary') }}">
                                                            {{ $arrayPrefix[$nilai] }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-referensi').addClass('active')
    $('#sidebar-referensi').addClass('show')
    $('#nav-bank-soal').addClass('active')
</script>
@endsection