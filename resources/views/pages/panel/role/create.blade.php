@extends('layouts.panel.master')
@section('title') Role @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Settings @endslot
@slot('title') Role @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <!-- Buttons with Label -->


            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('panel.role.store')}}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" placeholder="name" name="name" value="{{old('name')}}" />

                        </div>
                    </div>

                    <label for="permissions" class="form-label">Assign Permissions</label>

                    <table class="table table-striped">
                        <thead>
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission" id="checkAll"></th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission check-item'>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>


                </form>
            </div>

        </div><!-- end card -->
    </div><!-- end col -->
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-persmission-table').DataTable();

        $('#checkAll').click(function() {
            $('.check-item').prop('checked', this.checked);
        });
    })
</script>
@endsection