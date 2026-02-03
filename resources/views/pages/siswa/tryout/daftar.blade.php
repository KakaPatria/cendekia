@extends('layouts.siswa.master')
@section('title') Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tryout @endslot
@slot('title') Daftar Tryout @endslot
@endcomponent

@include('components.message')
<div class="card">

    <div class="card-body">
        <form action="{{ route('siswa.tryout_peserta.store')}}" class="" autocomplete="off" method="POST">
            @csrf
            <input type="hidden" name="tryout_id" id="" value="{{ $tryout->tryout_id}}">
            <div class="text-center pt-3 pb-4 mb-1">
                <h5>Periksa Kembali Data Anda</h5>
            </div>
            <hr>
            <div class="mb-4">
                <div>
                    <h5 class="mb-1">Detial Tryout</h5>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Nama Tryout</label>
                <input type="text" class="form-control bg-light" id="address2" value="{{ $tryout->tryout_judul}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-username-input">Jenjang</label>
                <input type="text" class="form-control bg-light" id="gen-info-username-input" value="{{ $tryout->tryout_jenjang}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-password-input">Kelas</label>
                <input type="text" class="form-control bg-light" id="" value="{{ $tryout->tryout_kelas}}" readonly>

            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-password-input">Biaya</label>
                <input type="text" class="form-control bg-light" id="" value="{{ $tryout->tryout_harga_jual_formatted}}" readonly>

            </div>
            <hr>
            <div class="mb-4">
                <div>
                    <h5 class="mb-1">Detial Siswa</h5>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Nama Siswa</label>
                <input type="text" class="form-control bg-light" id="address2" name="name" value="{{ old('name',$user->name)}}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-username-input">Email</label>
                <input type="text" class="form-control " id="gen-info-username-input" name="email" value="{{ old('email',$user->email)}}" >
            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-password-input">Telepon</label>
                <input type="text" class="form-control " id="" name="telepon" value="{{ old('telepon',$user->telepon)}}"  >

            </div>
            <div class="mb-3">
                <label class="form-label" for="gen-info-password-input">Alamat</label>
                <input type="text" class="form-control " id="" name="alamat" value="{{ old('alamat',$user->alamat)}}"  >

            </div>
            <div class="m-2 p-2">
                <button type="submit" class="btn btn-danger w-100" >
                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/pages/form-wizard.init.js') }}"></script>
<script>
    $('#nav-tryout').addClass('active');
    
    // Auto reload setelah form submit
    // $('form').on('submit', function(e) {
    //     // Biarkan form submit normal
    //     // Setelah redirect sukses, halaman akan reload otomatis
        
    //     // Atau jika ingin reload paksa setelah beberapa detik (backup)
    //     setTimeout(function() {
    //         location.reload();
    //     }, 2000);
    // });
</script>
@endsection