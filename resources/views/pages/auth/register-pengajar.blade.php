@extends('layouts.master-without-nav')

@section('title')
    Pendaftaran Akun Pengajar
@endsection

@section('content')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay" style="background-color : #fff7cc;"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                             <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay" style="background: linear-gradient(90deg,#e2b602,#f5e38f);opacity: .9;"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="#" class="d-block">
                                                <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="" height="50">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Daftar Akun Pengajar</h5>
                                        <p class="text-muted">Isi data di bawah untuk mendaftar.</p>
                                    </div>

                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('register.pengajar') }}">
                                            @csrf
                                            <div class="mb-3"><label for="name" class="form-label">Nama Lengkap</label><input type="text" class="form-control" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required></div>
                                            <div class="mb-3"><label for="email" class="form-label">Email</label><input type="email" class="form-control" name="email" placeholder="Masukkan email aktif" value="{{ old('email') }}" required></div>
                                            <div class="mb-3"><label for="telepon" class="form-label">Nomor Telepon/WhatsApp</label><input type="text" class="form-control" name="telepon" placeholder="Contoh: 08123456789" value="{{ old('telepon') }}" required></div>
                                            <div class="mb-3"><label for="lulusan_universitas" class="form-label">Lulusan Universitas</label><input type="text" class="form-control" name="lulusan_universitas" placeholder="Contoh: Universitas Gadjah Mada" value="{{ old('lulusan_universitas') }}"></div>
                                            <div class="mb-3"><label for="jurusan" class="form-label">Jurusan</label><input type="text" class="form-control" name="jurusan" placeholder="Contoh: S1 Pendidikan Matematika" value="{{ old('jurusan') }}"></div>
                                            <div class="mb-3"><label class="form-label" for="password">Password</label><input type="password" class="form-control" name="password" placeholder="Masukkan password" required></div>
                                            <div class="mb-3"><label class="form-label" for="password_confirmation">Ulangi Password</label><input type="password" class="form-control" name="password_confirmation" placeholder="Ketik ulang password" required></div>
                                            <div class="mt-4"><button class="btn btn-danger w-100" type="submit">Daftar</button></div>
                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Masuk</a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection