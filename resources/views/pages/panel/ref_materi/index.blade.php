@extends('layouts.panel.master')
@section('title') Materi @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Referensi @endslot
@slot('title') Materi @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                <form action="">
                    <div class="row g-2">
                        <div class="col-lg-2">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Materi</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select mb-2" id="filter-jenjang" name="jenjang">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select mb-2" id="filter-kelas" name="kelas">
                                <option value="">Pilih Kelas</option>

                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.user.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
                                Reset
                            </a>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <button type="submit" class="btn btn-primary w-100"> <i class="ri-search-line me-1 align-bottom"></i>
                                Cari
                            </button>
                        </div>
                    </div>

                </form>
            </div><!-- end card header -->

            <div class="card-body mb-2">
                <div class="live-preview">
                    <div class="table-responsive  table-card mb-2">
                        <table class="table align-middle table-nowrap table-striped mb-2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Judul Materi</th>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col" colspan="3" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materi as $data)
                                <tr>
                                    <td>{{ ($materi->currentpage()-1) * $materi->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $data->ref_materi_judul }}</td>

                                    <td>{{ $data->ref_materi_jenjang }}</td>
                                    <td>{{ $data->ref_materi_kelas }}</td>
                                    <td>
                                        <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-action="{{route('panel.materi.update', $data->ref_materi_id)}}" data-name="{{$data->ref_materi_judul}}" data-jenjang="{{$data->ref_materi_jenjang}}" data-kelas="{{$data->ref_materi_kelas}}">
                                            <i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                    <td><a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$data->ref_materi_id}}" data-name="{{$data->ref_materi_judul}}"><i class="fa fa-trash"></i> Hapus</a></td>
                                </tr>
                                @empty
                                <!-- warning Alert -->
                                <div class="alert alert-warning" role="alert">
                                    <strong> Data belum tersedia
                                </div>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $materi->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.materi.store')}}" method="POST" id="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Judul Materi</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="ref_materi_judul" value="{{old('ref_materi_judul')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select id="add-jenjang" class="form-control" name="ref_materi_jenjang">
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

                            <select id="add-kelas" class="form-control" name="ref_materi_kelas">
                                <option value="">Pilih Jenjang Terlebih dahulu</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="create-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Judul Materi</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="ref_materi_judul" id="edit-judul" value="{{old('ref_materi_judul')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select id="edit-jenjang" class="form-control" name="ref_materi_jenjang">
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

                            <select id="edit-kelas" class="form-control" name="ref_materi_kelas">
                                <option value="">Pilih Jenjang Terlebih dahulu</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="edit-form" class="btn btn-primary">Simpan</button>
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
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-referensi').addClass('active')
    $('#sidebar-referensi').addClass('show')
    $('#nav-materi').addClass('active')



    $(".multiple-select2").select2({
        placeholder: "Select a permission",
        dropdownParent: $('#create-modal')
    });

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };

    $('#filter-jenjang').change(function() {
        var schoolLevel = $(this).val();
        var $classLevel = $('#filter-kelas');
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

    <?php if ($filter_jenjang) { ?>
        $('#filter-jenjang').val('<?= $filter_jenjang ?>').change()

    <?php } ?>
    <?php if ($filter_kelas) { ?>
        $('#filter-kelas').val('<?= $filter_kelas ?>').change()
    <?php } ?>




    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteForm').attr('action', '<?php echo route('panel.materi.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
    })

    $('.editBtn').click(function() {
        var action = $(this).data('action');
        var name = $(this).data('name');
        var jenjang = $(this).data('jenjang');
        var kelas = $(this).data('kelas');
        $('#edit-form').attr('action', action)

        $('#edit-judul').val(name);
        $('#edit-jenjang').val(jenjang).change()
        $('#edit-kelas').val(kelas).change()
    })

    $('#edit-jenjang').change(function() {
        var schoolLevel = $(this).val();
        var $classLevel = $('#edit-kelas');
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
</script>
@endsection