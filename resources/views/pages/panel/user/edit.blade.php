@extends('layouts.panel.master')
@section('title') User @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') Edit {{ $roleX}} @endslot
@endcomponent

@include('components.message')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('panel.user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control mb-2" placeholder="Enter email" name="email" value="{{ old('email',$user->email)}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="name" value="{{old('name',$user->name)}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Telepon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="telepon" value="{{old('telepon',$user->telepon)}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Asal Sekolah</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="asal_sekolah" value="{{old('asal_sekolah',$user->asal_sekolah)}}" />

                        </div>
                    </div>
                    @if($roleX == 'Siswa')
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select id="add-jenjang" class="form-control" name="jenjang">
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

                            <select id="add-kelas" class="form-control" name="kelas">
                                <option value="">Pilih Jenjang Terlebih dahulu</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control mb-2" placeholder="Password" name="password" />

                        </div>
                    </div>
                    @if(auth()->user()->hasRole(['Admin']))

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Role</label>
                        <div class="col-md-9">
                            <select class="multiple-select2 form-control" multiple="multiple" name="role[]">
                                <option value="">Select role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Permission</label>
                        <div class="col-md-9">
                            <select class="multiple-select2 form-control" multiple="multiple" name="permissions[]">
                                <option value="">Select Permission</option>
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->name}}" {{ in_array($permission->name, $userPermission)
                            ? 'selected'
                            : '' }}>{{ $permission->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Avatar</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control mb-2" name="avatar" value="{{old('avatar')}}" />

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>


                </form>





            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-user').addClass('active')
    $('#sidebar-user').addClass('show')
    $('#nav-<?= strtolower($roleX) ?>').addClass('active')

    $(".multiple-select2").select2({
        placeholder: "Select a permission"
    });

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };
    <?php if ($roleX == 'Siswa') { ?>

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
        $('#add-jenjang').val('<?= $user->jenjang ?>').change()

        $('#add-kelas').val('<?= $user->kelas ?>').change()
    <?php } ?>
</script>
@endsection