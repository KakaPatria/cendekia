@extends('layouts.panel.master')
@section('title') Role @endsection
@section('css')
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
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission" id="all_permission"></th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission check_permission' {{ in_array($permission->name, $rolePermissions) 
                                    ? 'checked'
                                    : '' }}>
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
<script>
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
</script>
@endsection