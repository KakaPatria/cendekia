@extends('layouts.panel.master')
@section('title') Role @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Settings @endslot
@slot('title') Role @endslot
@endcomponent

@include('components.message') 
<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header align-items-center d-flex">
                <!-- Buttons with Label -->
                <a href="{{ route('panel.role.create') }}" class="btn btn-primary btn-label waves-effect waves-light" ><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah {{config('site.menu.role')}}</a>


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
                                @foreach ($role as $key => $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>

                                    <td><a href="{{ route('panel.role.show', $role->id) }}" class="btn rounded-pill btn-info btn-sm"> Detail</a></td>
                                    <td><a href="{{ route('panel.role.edit', $role->id) }}" class="btn rounded-pill btn-warning btn-sm">Edit</a></td>
                                    <td><a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{route('panel.role.destroy',$role->id)}}" data-name="{{$role->name}}">Hapus</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Tambah {{config('site.menu.role')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('panel.role.store')}}" method="POST" id="create-form">
                    @csrf
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" placeholder="name" name="name" value="{{old('name')}}" />

                        </div>
                    </div>

                    <label for="permissions" class="form-label">Assign Permissions</label>

                    <table class="table table-striped" id="add-persmission-table">
                        <thead>
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission'>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                        @endforeach

                    </table> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="create-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin menghapus role <strong id="deleteName"></strong>
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
    $(document).ready(function(){
        $('#nav-setting').addClass('active')
        $('#sidebar-setting').addClass('show')
        $('#nav-role').addClass('active')
 
        $('.deleteBtn').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            alert(name);
            $('#deleteForm').attr('action', id)
            $('#deleteName').html(name);
        })
    })
</script>
@endsection
