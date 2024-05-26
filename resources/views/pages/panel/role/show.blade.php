@extends('layouts.panel.master')
@section('title') Role @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@slot('li_1') Settings @endslot
@slot('title') Role @endslot
@include('components.message')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <!-- Buttons with Label -->


            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('panel.role.update',$role->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" placeholder="name" name="name" value="{{$role->name}}" />

                        </div>
                    </div>

                    <label for="permissions" class="form-label">Assign Permissions</label>

                    <table class="table table-striped">
                        <thead> 
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach($role->permissions as $permission)
                        <tr>
                             
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-persmission-table').DataTable();

        $('#all_permission').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $('.check_permission').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check_permission').each(function() {
                    this.checked = false;
                });
            }
        });
    })
</script>
@endsection