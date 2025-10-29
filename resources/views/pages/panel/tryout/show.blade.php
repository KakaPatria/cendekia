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
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <div class="align-items-center d-flex mb-2">

                        <div class="flex-grow-1">

                            <h6 class="mb-3 fw-bold text-uppercase">{{ $tryout->tryout_judul}} <b>{{ $tryout->is_open == 'Ya'? '(Umum)' : ''}}</b></h6>
                        </div>
                        <div class="flex-shrink-0">
                            {{-- Support both Spatie roles and legacy roles_id column (2 == Admin) --}}
                            @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)

                            <a href="{{ route('panel.tryout.exportPeserta',$tryout->tryout_id)}}" class="btn rounded-pill btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Export Data</a>
                            <a href="{{ route('panel.tryout.edit',$tryout->tryout_id)}}" class="btn rounded-pill btn-info btn-sm">
                                <i class="fa fa-edit"></i> Edit tryout</a>
                            <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$tryout->tryout_id}}" data-name="{{$tryout->tryout_judul}}"><i class="fa fa-trash"></i> Hapus</a>
                            @endif
                        </div>
                    </div>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><i class="ri-building-line text-success align-middle me-1"></i> {{ $tryout->tryout_jenjang.' Kelas '.$tryout->tryout_kelas}}</li>
                    </ul>
                    {!! $tryout->tryout_deskripsi!!}

                    <!-- Base Example -->
                    <div class="align-items-center d-flex mb-2">
                        <div class="flex-grow-1">
                            <h6 class="mb-3 fw-bold text-uppercase">Mata Pelajaran</h6>
                        </div>
                        <div class="flex-shrink-0">

                            {{-- Support both Spatie roles and legacy roles_id column (2 == Admin) --}}
                            @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                            <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#add-materi-modal">
                                <i class="fa fa-edit"></i> Tambah Mata Pelajaran
                            </a>
                            @endif
                        </div>

                    </div>

                    <div class="accordion" id="accordion-materi">
                        @foreach($tryout->materi as $keyMateri => $materi)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{$materi->tryout_materi_id}}">

                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-materi-{{$keyMateri}}" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $materi->refMateri->ref_materi_judul}}
                                </button>
                            </h2>
                            <div id="collapse-materi-{{$keyMateri}}" class="accordion-collapse collapse show" aria-labelledby="heading-{{$materi->tryout_materi_id}}" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                    <div class="row mb-2">
                                        <div class="col-2">
                                            <p class="text-muted mb-1">Pengajar</p>
                                            <h5 class="fs-14">{{ $materi->pengajar->name ?? ''}}</h5>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-muted mb-1">Durasi Pengerjaan</p>
                                            <h5 class="fs-14">
                                                @if($materi->durasi)
                                                {{ $materi->durasi}} Menit
                                                @else
                                                Tidak ada batan waktu
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-muted mb-1">Safe Mode</p>
                                            <h5 class="fs-14">{{ $materi->safe_mode ? 'Ya' : 'Tidak'}}</h5>
                                        </div>
                                    </div>
                                    <div class="align-items-center d-flex mb-2">
                                        <div class="flex-grow-1 mr-2">

                                            {{ $materi->tryout_materi_deskripsi}}
                                        </div>
                                        <div class="flex-shrink-0">

                                            <a href="{{ route('panel.tryout_materi.show',$materi->tryout_materi_id)}}" class="btn rounded-pill btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Detail</a>
                                            @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)

                                            <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteMateriBtn" data-bs-toggle="modal" data-bs-target="#deleteMateriModal" data-id="{{$materi->tryout_materi_id}}" data-name="{{$materi->refMateri->ref_materi_judul}}"><i class="fa fa-trash"></i> Hapus</a>
                                            @endif

                                        </div>
                                    </div>
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
                    <div class="align-items-center d-flex mb-2">

                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0 flex-grow-1" role="tablist">
                            <li class="nav-item " role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tryout-soal" role="tab" aria-selected="false" tabindex="-1">
                                    Daftar Peserta
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
                                    Hasil {{ $materi->refMateri->ref_materi_judul}}
                                </a>
                            </li>
                            @endforeach

                        </ul>
                        <!--end nav-->
                        <div class="flex-shrink-0">

                            {{-- Support both Spatie roles and legacy roles_id column (2 == Admin) --}}
                            @if((Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2) && $tryout->is_open == 'Cendekia')

                            <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#add-peserta-modal">
                                <i class="fa fa-edit"></i> Tambah Peserta
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tryout-soal" role="tabpanel">
                        <div class="align-items-center d-flex mb-2">
                            <h5 class="card-title mb-4">Daftar Peserta</h5>

                        </div>


                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Asal Sekolah</th>
                                        <th scope="col">Jenjang</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Tanggal Pendaftaran</th>
                                        <th scope="col">Status Pembayaran</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tryout->peserta as $peserta)
                                    <tr>

                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $peserta->siswa->name}}</td>
                                        <td>{{ $peserta->siswa->email}}</td>
                                        <td>{{ $peserta->siswa->asal_sekolah}}</td>
                                        <td>{{ $peserta->siswa->jenjang}}</td>
                                        <td>{{ $peserta->siswa->kelas}}</td>
                                        <td>{{ $peserta->tanggal_daftar}}</td>
                                        <td>{!! $peserta->status_badge !!}</td>
                                        <td class="text-center">
                                            @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                                            <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deletePesertaBtn" data-bs-toggle="modal" data-bs-target="#deletePesertaModal" data-id="{{$peserta->tryout_peserta_id }}" data-name="{{$peserta->siswa->name}}">
                                                <i class="fa fa-edit"></i> Hapus</a>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
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
                                        <th>Total Point</th>

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
                                        <td>{{ $value['total_point']}}</td>
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
                                        <th scope="col">Point </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materi->nilai->sortByDesc('nilai') as $value)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $value->siswa->name}}</td>
                                        <td>{{ $value->siswa->asal_sekolah}}</td>
                                        <td>{{ round($value->nilai,2)}}</td>
                                        <td>{{ $value->total_point}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <!--end tab-pane-->


                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-lg-3">
        <div class="row g-4 mb-3">
            <div class="col-sm">
                <div class="d-flex justify-content-sm-end gap-2">
                    <div>
                        <a href="{{ route('panel.tryout.index')}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-4">
                    @if($tryout->tryout_banner)
                    <a class="image-popup" href="{{ Storage::url($tryout->tryout_banner) }}" title="">
                        <img class="gallery-img img-fluid mx-auto " src="{{ Storage::url($tryout->tryout_banner) }}" alt="">
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
                                <td class="fw-medium">Umum</td>
                                <td>{{ $tryout->is_open}}</td>
                            </tr>
                            @if($tryout->tryout_jenis == 'Berbayar')
                            <tr>
                                <td class="fw-medium">Jenis</td>
                                <td>{{ $tryout->tryout_jenis}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Biaya</td>
                                <td>Rp. {{ $tryout->tryout_nominal}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Diskon</td>
                                <td>{{ $tryout->tryout_diskon}}%</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Harga Jual</td>
                                <td>Rp. {{ $tryout->tryout_harga_jual_formatted }}</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>

    </div>
    <!---end col-->
</div>

<div class="modal fade" id="add-materi-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-invoice-label">Tambah Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.tryout.addMateri',$tryout->tryout_id)}}" id="add-materi-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Mata Pelajaran</label>
                        <div class="col-md-9">

                            <select class="form-control select-materi" id="add-select-materi" name="materi_id">
                                <option value="">-- Pilih Materi --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Pengajar</label>
                        <div class="col-md-9">
                            <select class="form-control " id="add-select-pengajar" name="pengajar_id">
                                <option value="">-- Pilih Pengajar --</option>
                                @foreach($pengajar as $value)
                                <option value="{{ $value->id}}">{{ $value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="form-label col-md-3">Durasi Pengerjaan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="" name="durasi">
                                <span class="input-group-text" id="basic-addon2">Menit</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="form-label col-md-3">Safe Mode</label>
                        <div class="col-md-9">
                            <select class="form-control select2" name="safe_mode" id="add-safe-mode">

                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="" name="tryout_materi_deskripsi" rows="5"></textarea>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="add-materi-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-peserta-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-invoice-label">Tambah Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.tryout.addPeserta',$tryout->tryout_id)}}" id="add-peserta-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Siswa</label>
                        <div class="col-md-9">

                            <select id="add-siswa-tryout" class="form-control" name="siswa[]" multiple>
                                <option value="">Pilih Siswa</option>
                            </select>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="add-peserta-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menghapus <strong id="deleteName"></strong>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePesertaModal" tabindex="-1" aria-labelledby="deletePesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePesertaModalLabel">Hapus Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menghapus <strong id="deletePesertName"></strong>
                <form action="" method="POST" id="deletePesertForm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deletePesertForm" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMateriModal" tabindex="-1" aria-labelledby="deleteMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMateriModalLabel">Hapus Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menghapus <strong id="deleteMateriName"></strong>
                <form action="" method="POST" id="deleteMateriForm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteMateriForm" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>
@{{-- app.min.js loaded globally in layouts.vendor-scripts --}}


<script>
    $('#nav-tryout').addClass('active')

    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteForm').attr('action', '<?php echo route('panel.tryout.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
    })
    $('#add-select-pengajar').select2({
        dropdownParent: $('#add-materi-modal'),
    })
    $.ajax({
        url: '<?= route('ajax.materi-tryout') ?>',
        data: {
            kelas: '<?= $tryout->tryout_kelas ?>',
            jenjang: '<?= $tryout->tryout_jenjang ?>',
            tryout_id: '<?= $tryout->tryout_id ?>'
        },
        dataType: 'json',
        success: function(data) {
            $('#add-select-materi').empty().select2({
                data: data.results,
                dropdownParent: $('#add-materi-modal'),
                placeholder: 'Pilih Materi'
            });
        }
    });

    $('#add-siswa-tryout').select2({
        placeholder: "Cari Siswa",
        allowClear: true,
        tags: true,
        dropdownParent: $('#add-peserta-modal'),
        minimumInputLength: 1,
        ajax: {
            url: '<?= route('ajax.cari-siswa') ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    list: '<?= $tryout->peserta->pluck('user_id') ?>'
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },


    });
    $('.deletePesertaBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deletePesertForm').attr('action', '<?php echo route('panel.tryout.deletePeserta', '') ?>/' + id)
        $('#deletePesertName').html(name);
    })

    $('.deleteMateriBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteMateriForm').attr('action', '<?php echo route('panel.tryout_materi.destroy', '') ?>/' + id)
        $('#deleteMateriName').html(name);
    })
</script>
@endsection