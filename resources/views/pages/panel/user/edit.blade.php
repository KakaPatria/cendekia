@extends('layouts.panel.master')
@section('title') User @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') Ubah {{ $roleX }} @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('panel.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="rolex" value="{{ $roleX }}">

                    {{-- EMAIL --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" />
                        </div>
                    </div>

                    {{-- NAMA LENGKAP --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" />
                        </div>
                    </div>

                    {{-- TELEPON --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Telepon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telepon" value="{{ old('telepon', $user->telepon) }}" />
                        </div>
                    </div>

                    {{-- ASAL SEKOLAH (HANYA SISWA) --}}
                    @if($roleX == 'Siswa')
                    <div class="form-group row mb-3 align-items-center">
                        <label class="col-form-label col-md-3 mb-0">Asal Sekolah</label>
                        <div class="col-md-9">
                            <select class="form-control" name="asal_sekolah" id="asal_sekolah">
                                <option value="{{ $user->asal_sekolah }}" selected>{{ $user->asal_sekolah }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- JENJANG --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select id="add-jenjang" class="form-control" name="jenjang">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD" {{ $user->jenjang == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ $user->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ $user->jenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>
                    </div>

                    {{-- KELAS --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Kelas</label>
                        <div class="col-md-9">
                            <select id="add-kelas" class="form-control" name="kelas">
                                <option value="">Pilih Jenjang Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Alamat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $user->alamat) }}" />
                        </div>
                    </div>

                    {{-- ORANG TUA --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama Orang Tua</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_orang_tua" value="{{ old('nama_orang_tua', $user->nama_orang_tua) }}" />
                        </div>
                    </div>

                    {{-- TELEPON ORANG TUA --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Telepon Orang Tua</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telp_orang_tua" value="{{ old('telp_orang_tua', $user->telp_orang_tua) }}" />
                        </div>
                    </div>
                    @endif

                    {{-- PASSWORD --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah" />
                        </div>
                    </div>

                    {{-- ROLE DAN PERMISSION (HANYA ADMIN) --}}
                    @if(auth()->user()->hasRole('Admin'))
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Role</label>
                        <div class="col-md-9">
                            <select class="multiple-select2 form-control" multiple name="role[]">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Permission</label>
                        <div class="col-md-9">
                            <select class="multiple-select2 form-control" multiple name="permissions[]">
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}" {{ in_array($permission->name, $userPermission) ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- AVATAR --}}
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Avatar</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" name="avatar" />
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-user').addClass('active');
    $('#sidebar-user').addClass('show');
    $('#nav-{{ strtolower($roleX) }}').addClass('active');

    $(".multiple-select2").select2({ placeholder: "Select an option" });

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };

    @if($roleX == 'Siswa')
        $('#add-jenjang').on('change', function() {
            const jenjang = $(this).val();
            const $kelas = $('#add-kelas');
            $kelas.empty().append('<option value="">Pilih Kelas</option>');
            if (classes[jenjang]) {
                classes[jenjang].forEach(function(k) {
                    $kelas.append(`<option value="${k}">${k}</option>`);
                });
            }
        });

        $('#add-jenjang').val('{{ $user->jenjang }}').trigger('change');
        $('#add-kelas').val('{{ $user->kelas }}').trigger('change');

        $('#asal_sekolah').select2({
            placeholder: "Cari Asal Sekolah",
            allowClear: true,
            tags: true,
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('ajax.cari-sekolah') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({ q: params.term }),
                processResults: data => ({ results: data }),
                cache: true
            }
        });
    @endif
</script>
@endsection
