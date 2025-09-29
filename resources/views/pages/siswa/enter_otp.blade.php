@extends('layouts.master-without-nav')
@section('title', 'Verifikasi OTP')
@section('content')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Masukkan Kode OTP</h5>
                            @include('components.message')

                            <form action="{{ route('siswa.verifyOtp') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="mb-3">
                                    <label class="form-label">Kode OTP</label>
                                    <input type="text" name="otp" class="form-control" placeholder="Masukkan 6 digit kode" required>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-danger">Verifikasi</button>
                                </div>
                            </form>
                            <div class="mt-3 text-muted small">Jika tidak menerima email, coba lagi atau periksa folder spam.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
