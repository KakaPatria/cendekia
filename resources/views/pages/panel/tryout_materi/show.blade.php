@extends('layouts.panel.master')
@section('title') Materi Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Detail @endslot
@slot('title') Materi Tryout @endslot
@endcomponent

@include('components.message')
<div class="row g-4 mb-3">
    <div class="col-sm">
        <div class="d-flex justify-content-sm-end gap-2">
            <div>
                <a href="{{ route('panel.tryout.show',$tryout_materi->tryout_id)}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <div class="align-items-center d-flex mb-2">

                        <div class="flex-grow-1">
                            <h6 class="mb-3 fw-bold text-uppercase">{{ $tryout_materi->refMateri->ref_materi_judul}}</h6>

                        </div>
                        <div class="flex-shrink-0">
                            <a href="javascript:;" class="btn rounded-pill btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit-materi-modal">
                                <i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$tryout_materi->tryout_materi_id}}" data-name="{{$tryout_materi->refMateri->ref_materi_judul}}"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                    </div>
                    {!! $tryout_materi->tryout_materi_deskripsi!!}
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="align-items-center d-flex mb-2">

                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0 flex-grow-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab-saol" role="tab" aria-selected="false" tabindex="-1">
                                    Soal
                                </a>
                            </li>

                        </ul>
                        <!--end nav-->
                        <div class="flex-shrink-0">

                            @if($tryout_materi->soal->count() ==0)
                            <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#add-soal-modal">
                                <i class="fa fa-edit"></i> Tambah Soal</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-saol" role="tabpanel">
                        @foreach($tryout_materi->soal as $soal)

                        <div class="row">
                            <div class="col-lg-6">
                                @if($tryout_materi->jenis_soal == 'PDF')

                                <a class="image-popup w-20" href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                    <img class="gallery-img img-fluid mx-auto w-50 border border-dark" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                                </a>
                                @endif

                            </div>
                            <div class="col-lg-6">
                                <div class="flex-shrink-0">

                                    <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm edit-jawaban-btn" data-bs-toggle="modal" data-bs-target="#edit-jawaban-modal" data-id="{{ $soal->tryout_soal_id}}" data-action="{{route('panel.tryout_materi.updateJawaban',$soal->tryout_soal_id)}}">
                                        <i class="fa fa-edit"></i> Edit Jawaban</a>
                                </div>
                                <table class="table table-responsive">
                                    <tbody>
                                        @foreach($soal->jawaban as $jawaban)
                                        <tr>
                                            <td class="col-1"><input class="form-check-input" type="radio" name="" value="A" id="" @if ($soal->tryout_kunci_jawaban == $jawaban->tryout_jawaban_prefix){{ 'checked'}}@endif disabled></td>
                                            <td class="col-1">{{$jawaban->tryout_jawaban_prefix}}.</td>
                                            <td>{{$jawaban->tryout_jawaban_isi}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <hr>
                        @endforeach

                    </div>
                    <!--end tab-pane-->

                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
</div>

<div class="modal fade" id="edit-jawaban-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-invoice-label">Edit Jawaban</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-jawaban-form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div id="edit-soal-element"></div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="edit-jawaban-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-soal-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-invoice-label">Tambah Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.tryout_materi.store')}}" id="add-spk-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tyout_materi_id" value="{{ $tryout_materi->tryout_materi_id}}">

                    <div class="form-group  mb-3">
                        <label class="form-label ">Jenis Soal</label>
                        <div class="">
                            <select class="form-control select2" name="soal_jenis" id="soal-jenis">
                                <option value="">-- Pilih Jenis Soal --</option>
                                <option value="PDF">PDF</option>
                                <option value="FORM">FORM</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3 d-none" id="file-soal-input">
                        <label class="col-form-label ">File Soal</label>
                        <div class="">
                            <input type="file" class="form-control mb-2" name="soal" id="file-soal">
                        </div>
                    </div>
                    <div class="form-group  mb-3">
                        <label class="form-label">Periode Mulai</label>
                        <div class="">
                            <input type="text" class="form-control mb-2" data-provider="flatpickr" data-date-format="Y-m-d" name="periode_mulai" value="">
                        </div>
                    </div>
                    <div class="form-group  mb-3">
                        <label class="form-label">Periode Selesai</label>
                        <div class="">
                            <input type="text" class="form-control mb-2" data-provider="flatpickr" data-date-format="Y-m-d" name="periode_selesai" value="">
                        </div>
                    </div>
                    <div class="form-group  mb-3">
                        <label class="form-label ">Safe Mode</label>
                        <div class="">
                            <select class="form-control select2" name="safe_mode" id="soal-jenis">

                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>

                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="add-spk-form" class="btn btn-primary">Simpan</button>
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

<div class="modal fade" id="edit-materi-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-invoice-label">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.tryout.editMateri',$tryout_materi->tryout_materi_id)}}" id="edit-materi-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Materi</label>
                        <div class="col-md-9">

                            <select class="form-control select-materi" id="edit-select-materi" name="materi_id">
                                <option value="">-- Pilih Materi --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Pengajar</label>
                        <div class="col-md-9">
                            <select class="form-control " id="edit-select-pengajar" name="pengajar_id">
                                <option value="">-- Pilih Pengajar --</option>
                                @foreach($pengajar as $value)
                                <option value="{{ $value->id}}">{{ $value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="" name="tryout_materi_deskripsi" rows="5">{{ $tryout_materi->tryout_materi_deskripsi}}</textarea>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="edit-materi-form" class="btn btn-primary">Simpan</button>
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


    $('#edit-select-pengajar').select2({
        dropdownParent: $('#edit-materi-modal'),
    })
    $('#edit-select-pengajar').val('<?= $tryout_materi->pengajar_id ?>').change()
    $.ajax({
        url: '<?= route('ajax.materi-tryout') ?>',
        data: {
            kelas: '<?= $tryout_materi->tryoutMaster->tryout_kelas ?? '' ?>'
        },
        dataType: 'json',
        success: function(data) {
            $('#edit-select-materi').empty().select2({
                data: data.results,
                dropdownParent: $('#edit-materi-modal'),
                placeholder: 'Pilih Materi'
            });
            $('#edit-select-materi').val('<?= $tryout_materi->materi_id ?>').change()

        }
    });

    $('#soal-jenis').change(function() {
        var val = $(this).val()
        console.log(val)
        if (val == 'PDF') {
            $('#file-soal-input').removeClass('d-none');
        } else {
            $('#file-soal-input').addClass('d-none');
        }
    })

    $('.edit-jawaban-btn').click(function() {

        var id = $(this).data('id')
        var action = $(this).data('action')

        $('#edit-jawaban-form').attr('action', action);
        $.ajax({
            url: '<?= route('ajax.get-jawaban') ?>',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $('#edit-soal-element').html(data);
            },
            cache: true
        });
    })
    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteForm').attr('action', '<?php echo route('panel.tryout_materi.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
    })
</script>
@endsection