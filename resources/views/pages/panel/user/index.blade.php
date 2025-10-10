@extends('layouts.panel.master')
@section('title') User @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Users @endslot
@slot('title') {{ $roleX == 'Siswa' ? 'Siswa' : "Admin & Pengajar"}} @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                <form action="">
                    <input type="hidden" name="rule" value="{{ $roleX }}">
                    <div class="row g-2">
                        <div class="col-auto">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah {{ $roleX == 'Siswa' ? 'Siswa' : "Admin & Pengajar"}}</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Cari ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        @if($roleX == 'Siswa')
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
                        @endif
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.user.index', 'rule=' . $roleX) }}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
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
                        <table class="table align-middle   table-striped mb-2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Asal Sekolah</th>
                                    @if($roleX == 'Siswa')
                                    <th scope="col">Jenjang</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nama Orangtua</th>
                                    <th scope="col">Telepon Orangtua</th>
                                    @endif
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" colspan="3" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->telepon }}</td>
                                    <td>{{ $user->asal_sekolah }}</td>
                                    @if($roleX == 'Siswa')
                                    <td>{{ $user->jenjang }}</td>
                                    <td>{{ $user->kelas }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->nama_orang_tua }}</td>
                                    <td>{{ $user->telp_orang_tua }}</td>
                                    @endif
                                    <td>
                                        <div class="flex-shrink-0">
                                            @if($user->avatar)
                                            <img src="{{ Storage::url($user->avatar) }}" alt="" class="avatar-xs rounded-circle" />
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            // Determine which roles to display depending on current tab
                                            $displayRoles = collect();
                                            if ($user->roles->isNotEmpty()) {
                                                if ($roleX == 'Siswa') {
                                                    $displayRoles = $user->roles->filter(function($r){ return $r->name == 'Siswa'; });
                                                } else {
                                                    $displayRoles = $user->roles->filter(function($r){ return in_array($r->name, ['Admin','Pengajar']); });
                                                }
                                            }
                                        @endphp

                                        @if($displayRoles->isNotEmpty())
                                            @foreach($displayRoles as $role)
                                            <span class="label label-primary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            @php
                                                // Fallback to legacy roles_id if needed, but only show if it matches current tab
                                                $roleName = null;
                                                if ($user->roles_id == 1 && $roleX == 'Siswa') $roleName = 'Siswa';
                                                if ($user->roles_id == 2 && $roleX != 'Siswa') $roleName = 'Admin';
                                                if ($user->roles_id == 3 && $roleX != 'Siswa') $roleName = 'Pengajar';
                                            @endphp
                                            @if($roleName)
                                                <span class="label label-primary">{{ $roleName }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $user->status}}</td>
                                    {{-- <td><a href="{{ route('panel.user.show', $user->id) }}" class="btn rounded-pill btn-info btn-sm"><i class="fa fa-search-plus"></i> Detail</a></td> --}}
                                    <td><a href="{{ route('panel.user.edit', ['user'=>$user->id,'roleX'=>$roleX]) }}" class="btn rounded-pill btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a></td>
                                    <td><a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$user->id}}" data-name="{{$user->name}}"><i class="fa fa-trash"></i> Hapus</a></td>
                                    <td><a href="{{ route('panel.user.show', $user->id) }}" class="btn rounded-pill btn-info btn-sm"><i class="fa fa-search-plus"></i> Detail</a></td>
                                </tr>
                                @empty
                                <tr>
                                    @php
                                        // count total columns to set proper colspan
                                        $colspan = 7; // default columns for Admin & Pengajar
                                        if ($roleX == 'Siswa') {
                                            // email, name, telepon, asal_sekolah, jenjang, kelas, alamat, nama_orang_tua, telp_orang_tua, avatar, roles, status, actions
                                            $colspan = 13;
                                        }
                                    @endphp
                                    <td colspan="{{ $colspan }}" class="text-center text-muted">Belum ada data untuk {{ $roleX }}.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $users->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Tambah {{ $roleX == 'Siswa' ? 'Siswa' : "Admin & Pengajar"}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.user.store')}}" method="POST" id="create-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="rolex" value="{{ $roleX}}">
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="email" value="{{old('email')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="name" value="{{old('name')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Telepon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="telepon" value="{{old('telepon')}}" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Asal Sekolah</label>
                        <div class="col-md-9">
                            <select class="form-control"   name="asal_sekolah" id="asal_sekolah">
                            </select>
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
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Alamat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="alamat" value="{{old('alamat')}}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Orangtua</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="nama_orang_tua" value="{{old('nama_orang_tua')}}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Telepon Orangtua</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-2" name="telp_orang_tua" value="{{old('telp_orang_tua')}}" />
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control mb-2" name="password" value="{{old('password')}}" />

                        </div>
                    </div>

                    @if($roleX != 'Siswa')

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Role</label>
                        <div class="col-md-9">
                            <select class="form-control" name="role">
                                <option value="">Select role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $role->name == old('role') 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Permission</label>
                        <div class="col-md-9">
                            <select class="multiple-select2 form-control" multiple name="permissions[]">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name}}</option>
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
                <h5 class="modal-title" id="deleteModalLabel">Hapus User</h5>
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
    $('#nav-user').addClass('active')
    $('#sidebar-user').addClass('show')
    $('#nav-<?= strtolower($roleX) ?>').addClass('active')



    $(".multiple-select2").select2({
        placeholder: "Select a permission",
        dropdownParent: $('#create-modal')
    });

    <?php if ($roleX == 'Admin') { ?>
        $('#filter-role').val('<?= $filter_role ?>').change()

    <?php } else { ?>
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

    <?php } ?>


    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteForm').attr('action', '<?php echo route('panel.user.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
    })

    $('#asal_sekolah').select2({
        placeholder: "Cari Asal Sekolah",
        allowClear: true,
        tags: true,
        dropdownParent: $('#create-modal'),
        minimumInputLength: 1,
        ajax: {
            url: '<?= route('ajax.cari-sekolah') ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },

    });
</script>
@endsection