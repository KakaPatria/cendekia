@extends('layouts.panel.master')
@section('title') Asal Sekolah @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Referensi @endslot
@slot('title') Asal Sekolah @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                <form action="">
                    <div class="row g-2">
                        <div class="col-lg-3">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Asal Sekolah</a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="btn btn-outline-success btn-label waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#import-modal"><i class="ri-upload-cloud-2-line label-icon align-middle fs-16 me-2"></i> Import Data</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div> 
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.asal_sekolah.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
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
                                    <th scope="col">Nama Sekolah</th> 
                                    <th scope="col" colspan="3" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($asal_sekolah as $data)
                                <tr>
                                    <td>{{ ($asal_sekolah->currentpage()-1) * $asal_sekolah->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $data->nama_sekolah }}</td> 
                                    <td>
                                        <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-action="{{route('panel.asal_sekolah.update', $data->nama_sekolah)}}" data-name="{{$data->nama_sekolah}}" >
                                            <i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                    <td><a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$data->nama_sekolah}}" data-name="{{$data->nama_sekolah}}"><i class="fa fa-trash"></i> Hapus</a></td>
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

                {{ $asal_sekolah->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Tambah Asal Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.asal_sekolah.store')}}" method="POST" id="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Asal sekolah</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="nama_sekolah" value="{{old('nama_sekolah')}}" />

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

            <!-- Import Modal -->
            <div class="modal fade" id="import-modal" tabindex="-1" aria-labelledby="import-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="import-modal-label">Import Asal Sekolah (Excel/CSV)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('panel.asal_sekolah.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
                                @csrf
                                <div class="mb-3">
                                    <label for="import_file" class="form-label">Pilih file (.xlsx, .xls, .csv)</label>
                                    <input class="form-control" type="file" id="import_file" name="import_file" accept=".xlsx,.xls,.csv" required>
                                </div>
                                <div class="alert alert-info">Pastikan file memiliki kolom nama sekolah pada kolom pertama. Baris header (jika ada) akan dideteksi dan dilewati.</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="import-form" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </div>
            </div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Asal Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Sekolah</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="nama_sekolah" id="edit-judul" value="{{old('nama_sekolah')}}" />

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
                <h5 class="modal-title" id="deleteModalLabel">Hapus Asal Sekolah</h5>
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
    $('#nav-asal_sekolah').addClass('active')



   

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
 




    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteForm').attr('action', '<?php echo route('panel.asal_sekolah.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
    })

    $('.editBtn').click(function() {
        var action = $(this).data('action');
        var name = $(this).data('name'); 
        $('#edit-form').attr('action', action)

        $('#edit-judul').val(name); 
    })

    // optional: preview selected filename
    $('#import_file').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $(this).next('.form-label').text('Pilih file (.xlsx, .xls, .csv) — ' + fileName);
        }
    });

    
</script>
@endsection