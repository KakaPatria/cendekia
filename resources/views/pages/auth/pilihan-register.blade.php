@extends('layouts.master-without-nav')

@section('title')
    Pilih Jenis Pendaftaran
@endsection

@section('content')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay" style="background-color : #fff7cc;"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden mt-5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="mb-4">
                                    <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="Logo Cendekia" height="50">
                                </div>
                                <h5 class="text-primary">Selamat Datang di LBB Cendekia!</h5>
                                <p class="text-muted">Pilih jenis pendaftaran yang sesuai dengan Anda.</p>
                            </div>

                            <div class="p-2 mt-4">
                                <div class="d-grid gap-3">
                                    {{-- Tombol untuk Siswa, disamakan dengan warna tombol Daftar --}}
                                    <a href="{{ route('register.siswa') }}" class="btn btn-danger btn-lg">
                                        Daftar sebagai Siswa
                                    </a>

                                    {{-- Tombol untuk Pengajar, bisa disesuaikan warnanya --}}
                                    <a href="{{ route('register.pengajar') }}" class="btn btn-warning btn-lg">
                                        Daftar sebagai Pengajar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="mt-4 text-center">
                        <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Masuk di sini</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection