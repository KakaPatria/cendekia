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

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                <form action="">
                    <div class="row g-2">
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <select class="form-select mb-2" id="filter-tryout" name="tryout">
                                <option value="">Cari Tryout</option>
                                @foreach($list_tryout as $value)
                                <option value="{{ $value->tryout_id}}">{{ $value->tryout_judul}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.tryout_open.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
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
                        <table class="table align-middle table-nowrap table-striped mb-2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Judul Tryout</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Asal Sekolah</th>
                                    <th scope="col">Nama Orangtua</th> 
                                    <th scope="col">Status</th>
                                    <th scope="col" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftar as $key => $value)
                                <tr>
                                    <td>{{ ($pendaftar->currentpage()-1) * $pendaftar->perpage() + $loop->index + 1 }}</td>
                                    <td>{{ $value->tryoutMaster->tryout_judul ?? ''}}</td>
                                    <td>{{ $value->top_nama_siswa}}</td>
                                    <td>{{ $value->top_asal_sekolah}}</td>
                                    <td>{{ $value->top_nama_orang_tua}}</td>
                                    <td>{!! $value->status_badge !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('panel.tryout_open.show',$value->top_id)}}" class="btn rounded-pill btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $pendaftar->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>



@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-tryout-open').addClass('active')

    $('#filter-tryout').select2()
    <?php if ($filter_tryout) { ?>
        $('#filter-tryout').val('<?= $filter_tryout ?>').change()
    <?php } ?>
</script>
@endsection