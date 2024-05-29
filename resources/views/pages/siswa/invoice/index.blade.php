@extends('layouts.siswa.master')
@section('title') Invoice @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Invoice @endslot
@slot('title') Daftar Invoice @endslot
@endcomponent

@include('components.message')
<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                {{--<form action="">
                    <div class="row g-2">
                        <div class="col-lg-2">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Materi</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
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
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.user.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
                                Reset
                            </a>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <button type="submit" class="btn btn-primary w-100"> <i class="ri-search-line me-1 align-bottom"></i>
                                Cari
                            </button>
                        </div>
                    </div>

                </form>--}} 
            </div><!-- end card header -->

            <div class="card-body mb-2">
                <div class="live-preview">
                    <div class="table-responsive  table-card mb-2">
                        <table class="table align-middle table-nowrap table-striped mb-2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tenggat Waktu </th>
                                    <th scope="col" colspan="3" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $inv)
                                <tr>
                                    <td><a href="{{ route('siswa.invoice.show',$inv->inv_id)}}" class="fw-medium link-primary">#{{ $inv->inv_id}}</a></td>

                                    <td>{{ $inv->amount }}</td>

                                    <td>{{ $inv->status }}</td>
                                    <td>{{ $inv->due_date }}</td>
                                    <td>
                                        <a href="{{ route('siswa.invoice.show',$inv->inv_id)}}" class="btn rounded-pill btn-primary btn-sm editBtn">
                                            <i class="fa fa-edit"></i> Detail</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $invoices->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

@endsection
@section('script')

<script>
    $('#nav-tryout').addClass('active')
</script>
@endsection