@extends('layouts.panel.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" /> <!-- 'classic' theme -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Admin @endslot
@slot('title') Tryout @endslot
@endcomponent

@include('components.message')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit Tryout</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('panel.tryout.update',$tryout->tryout_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h4 class="card-title mb-0">Detail Tryout</h4>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Judul Tryout</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" placeholder="" name="tryout_judul" value="{{ old('tryout_judul',$tryout->tryout_judul)}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Deskripsi</label>
                        <div class="col-md-9">
                            <textarea name="tryout_deskripsi" id="editor" class="form-control">{{ old('tryout_deskripsi',$tryout->tryout_deskripsi)}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select id="add-jenjang" class="form-control" name="tryout_jenjang">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Kelas</label>
                        <div class="col-md-9">

                            <select id="add-kelas" class="form-control" name="tryout_kelas">
                                <option value="">Pilih Jenjang Terlebih dahulu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Tanggal Pendaftaran Ditutup</label>
                        <div class="col-md-9">

                            <input type="text" class="form-control mb-2" data-provider="flatpickr" data-date-format="d-M-Y" name="tryout_register_due" value="{{ old('tryout_register_due',$tryout->tryout_register_due) }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Foto Banner</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control mb-2" placeholder="" name="tryout_banner" value="{{ old('tryout_banner')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select id="add-status" class="form-control" name="tryout_status">
                                <option value="">Pilih Jenjang</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenis</label>
                        <div class="col-md-9">
                            <select id="add-jenis" class="form-control" name="tryout_jenis">
                                <option value="">Pilih Jenis</option>
                                <option value="Gratis">Gratis</option>
                                <option value="Berbayar">Berbayar</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Umum</label>
                        <div class="col-md-9">
                            <select id="add-is-open" class="form-control" name="is_open">
                                <option value="">Pilih Jenis</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Biaya</label>

                        <div class="col-md-9">
                            <div class="input-group ">
                                <span class="input-group-text" id="">Rp</span>
                                <input type="text" class="form-control mb-2" placeholder="" name="tryout_nominal" id="tryout-nominal" value="{{ old('tryout_nominal',$tryout->tryout_nominal)}}" />


                            </div>
                        </div>

                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dynamic-form.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>


<script>
    $('#nav-tryout').addClass('active')
    $('#tryout-nominal').on('change', function() {

        $('#tryout-nominal').val(formatRupiah($(this).val()))
    })

    function formatRupiah(angka) {
        console.log(angka)
        var numberString = angka.replace(/[^,\d]/g, '').toString(),
            split = numberString.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }


    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    $('form').on('submit', function() {
        // Dapatkan data dari CKEditor dan simpan ke textarea
        $('#editor').val(editorInstance.getData());
    });

    // Sinkronisasi konten CKEditor sebelum submit
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        });
    });

    $('#add-kelas').on('change', function() {
        var kelas = $('#kelas').val();
        // Fetch materi data via AJAX
        $.ajax({
            url: '<?= route('ajax.materi-tryout') ?>',
            data: {
                kelas: kelas
            },
            dataType: 'json',
            success: function(data) {
                $('.select-materi').empty().select2({
                    data: data.results,
                    placeholder: 'Pilih Materi'
                });
            }
        });

    });

    function selectRefresh() {
        $(".select2").select2({});
        $(".select-materi").select2({});
    }

    $(".btn-tambah").on('click', function() {
        selectRefresh();
    });

    $(document).on('click', '.btn-tambah', function() {
        selectRefresh();
    });

    var dynamic_form = $("#dynamic_form").dynamicForm("#dynamic_form", "#plus5", "#minus5", {
        limit: 10,
        formPrefix: "materi_data",
        normalizeFullForm: false
    });

    $("#dynamic_form #minus5").on('click', function() {
        var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
        if (initDynamicId === 2) {
            $(this).closest('#dynamic_form').next().find('#minus5').hide();
        }
        $(this).closest('#dynamic_form').remove();
    });

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };

    $('#add-jenis').change(function() {
        var jenis = $(this).val();
        if (jenis == 'Gratis') {
            $('#tryout-nominal').val(0);
        }
    });

    $('#add-jenjang').change(function() {
        var schoolLevel = $(this).val();
        var $classLevel = $('#add-kelas');
        $classLevel.empty().append('<option value="">Pilih Kelas</option>'); // Reset class level options
        if (schoolLevel) {
            $classLevel.prop('disabled', false);
            classes[schoolLevel].forEach(function(classItem) {
                $classLevel.append('<option value="' + classItem + '">' + classItem + '</option>');
            });
        } else {
            $classLevel.prop('disabled', true);
        }
        $classLevel.trigger('change'); // Trigger change to update select2
    });

    $('#add-jenjang').val('<?= $tryout->tryout_jenjang ?>').change()
    $('#add-kelas').val('<?= $tryout->tryout_kelas ?>').change()
    $('#add-jenis').val('<?= $tryout->tryout_jenis ?>').change()
    $('#add-status').val('<?= $tryout->tryout_status ?>').change()
    $('#add-is-open').val('<?= $tryout->is_open ?>').change()
</script>
@endsection