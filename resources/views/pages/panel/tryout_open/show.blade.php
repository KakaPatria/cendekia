@extends('layouts.panel.master')
@section('title') Tryout @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Admin @endslot
@slot('title') Tryout Open @endslot
@endcomponent

@include('components.message')

<div class="row g-4 mb-3">
    <div class="col-sm">
        <div class="d-flex justify-content-sm-end gap-2">
            <div>
                <a href="{{ route('panel.tryout_open.index')}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="flex-grow-1">
                    <h6 class="mb-3 fw-bold text-uppercase">Detial Identitas</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-card mb-2">
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Email Aktif</td>
                                <td colspan="2">{{ $pendaftaran->top_email}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Nama Lengkap Siswa</td>
                                <td colspan="2">{{ $pendaftaran->top_nama_siswa}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Sekolah</td>
                                <td colspan="2">{{ $pendaftaran->top_asal_sekolah}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Nomor HP Siswa</td>
                                <td colspan="2">{{ $pendaftaran->top_telpon_siswa}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Nama Orang Tua / Wali</td>
                                <td colspan="2">{{ $pendaftaran->top_nama_orang_tua}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Telepon Tua / Wali</td>
                                <td colspan="2">{{ $pendaftaran->top_telpon_orang_tua}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <!--end table-->
                </div>

            </div>
        </div>

    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="flex-grow-1">
                    <h6 class="mb-3 fw-bold text-uppercase">Detial Pembayaran</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-card mb-2">
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Tanggal Bayar</td>
                                <td colspan="2">{{ $pendaftaran->tanggal_bayar_format}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Pembayaran Via</td>
                                <td colspan="2">{{ $pendaftaran->top_jenis_bayar}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Pembayaran Atas Nama</td>
                                <td colspan="2">{{ $pendaftaran->top_nama_bayar}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Bukti Bayar</td>
                                <td colspan="2"> <a class="image-popup" href="{{ Storage::url($pendaftaran->top_bukti_bayar) }}" title="">
                                        <img class="gallery-img img-fluid mx-auto " src="{{ Storage::url($pendaftaran->top_bukti_bayar) }}" alt="">
                                    </a></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                </div>
                @if($pendaftaran->top_status == 'Pending')
                <form action="{{ route('panel.tryout_open.update',$pendaftaran->top_id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- Base Buttons -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Konfrimasi</button>
                    </div>
                </form>
                @endif

            </div>
        </div>

    </div>
    <!--end col-->

</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-tryout-open').addClass('active')
</script>
@endsection