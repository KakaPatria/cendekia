@extends('layouts.panel.master')
@section('title') Permission @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Settings @endslot
@slot('title') Permission @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->
                <form action="">
                    <div class="row g-2">
                        <div class="col-lg-auto">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah {{config('site.menu.permission')}}</a>

                        </div>
                        <div class="col-lg-3 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                       
                        <div class="col-lg-auto">
                            <a href="{{ route('panel.permission.index')}}" class="btn btn-danger "> <i class="ri-restart-line  me-1 align-bottom"></i>
                                Reset
                            </a>
                        </div>
                        <div class="col-lg-auto">
                            <button type="submit" class="btn btn-primary "> <i class="ri-search-2-line  me-1 align-bottom"></i>
                                Cari
                            </button>
                        </div>
                    </div>

                </form>

            </div><!-- end card header -->

            <div class="card-body mb-2">


                <div class="live-preview">
                    <div class="table-responsive  table-card">
                        <table class="table align-middle table-nowrap table-striped mb-2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" colspan="3" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ ($permissions->currentpage()-1) * $permissions->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $permission->name }}</td>

                                    <td><a href="javascript:;" class="btn rounded-pill btn-warning btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#edit-modal" data-route="{{ route('panel.permission.update', $permission->id) }}" data-name="{{$permission->name}}">Edit</a></td>
                                    <td><a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{route('panel.permission.destroy', $permission->id)}}" data-name="{{$permission->name}}">Hapus</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->withQueryString()->links() }}
                    </div>
                </div>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Tambah {{config('site.menu.permission')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('panel.permission.store')}}" method="POST" id="create-form">
                    @csrf
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" placeholder="name" name="name" value="" />

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

<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit {{config('site.menu.permission')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input id="edit-name" type="text" class="form-control m-b-5" placeholder="name" name="name" value="{{old('name')}}" />

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
                <h5 class="modal-title" id="deleteModalLabel">Hapus Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menghapus permission <strong id="deleteName"></strong>
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
<script>
    $(document).ready(function() {
        $('#nav-setting').addClass('active')
        $('#sidebar-setting').addClass('show')
        $('#nav-permission').addClass('active')

        $('.btn-edit').click(function() {
            var route = $(this).data('route')
            var name = $(this).data('name')

            $('#edit-form').attr('action', route)
            $('#edit-name').val(name)
        })
        $('.deleteBtn').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#deleteForm').attr('action', id)
            $('#deleteName').html(name);
        })
    })
</script>

@endsection
