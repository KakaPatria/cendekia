@extends('layouts.siswa.master')
@section('title') Profile @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('components.message')

<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <div class="bg-overlay" style="background-color : #f5e38f;"></div>

        <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">

    </div>
</div>

<form action="{{ route('siswa.profile.update')}}" method="POST" id="edit-profile-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="@if ($user->avatar != '') {{ Storage::url( $user->avatar) }}@else{{ URL::asset('assets/images/users/user-dummy-img.jpg') }} @endif" class="  rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image" id="profile-img-file">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="avatar">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{ $user->name}}</h5>
                        <p class="text-muted mb-0">{{ $user->asal_sekolah}}</p>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <div class="mb-3">
                                <label for="nama " class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control bg-light" id="nama" name="name" placeholder="Masukan Nama Lengkap" required value="{{ old('name',$user->name) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control bg-light" id="email" name="email" placeholder="Masukan Email" required value="{{ old('email',$user->email) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Masukan Telepon" required value="{{ old('telepon',$user->telepon) }}">
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat" required value="{{ old('alamat',$user->alamat) }}">
                            </div>

                            <div class="mb-3">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <select class="form-control select2" name="asal_sekolah" id="asal_sekolah">
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jenjang" class="form-label">Jenjang</label>
                                <select id="jenjang" class="form-control" name="jenjang">
                                    <option value="">Pilih Jenjang</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select id="kelas" class="form-control" name="kelas">
                                    <option value="">Pilih Jenjang Terlebih dahulu</option>
                                </select>
                            </div>


                            <div class="mb-3">

                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password">
                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <div class="mb-3">

                                <label class="form-label" for="password-input">Ulangi Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password_confirmation">
                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-danger">Updates</button>
                                    <a href="{{ route('siswa.dashboard')}}" class="btn btn-soft-success">Cancel</a>
                                </div>
                            </div>


                        </div>
                        <!--end tab-pane-->

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script>
    $('#profile-img-file-input').change(function() {
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-img-file').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
        }
    });

    $('#asal_sekolah').select2({
        placeholder: "Cari Asal Sekolah",
        allowClear: true,
        tags: true,
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
    var data = {
        id: '<?= $user->asal_sekolah ?>',
        text: '<?= $user->asal_sekolah ?>',
    };

    var newOption = new Option(data.text, data.id, false, false);
    $('#asal_sekolah').append(newOption).trigger('change');

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };

    $('#jenjang').change(function() {
        var schoolLevel = $(this).val();
        var $classLevel = $('#kelas');
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

    $('#jenjang').val('<?= $user->jenjang ?>').change()
    $('#kelas').val('<?= $user->kelas ?>').change()
</script>
@endsection