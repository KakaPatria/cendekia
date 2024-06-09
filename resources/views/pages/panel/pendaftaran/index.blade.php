@extends('layouts.panel.master')
@section('title') Pendafataran @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tryout @endslot
@slot('title') Pendafataran @endslot
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Asal Sekolah</th>
                                    <th scope="col">Tryout</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peserta as $data)
                                <tr>
                                    <td>{{ ($peserta->currentpage()-1) * $peserta->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $data->tryout_peserta_name }}</td>

                                    <td>{{ $data->siswa->kelas }}</td>
                                    <td>{{ $data->siswa->asal_sekolah }}</td>
                                    <td>{{ $data->masterTryout->tryout_judul }}</td>
                                    <td>{!! $data->status_badge !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('panel.pendaftaran.show',$data->tryout_peserta_id)}}" class="btn rounded-pill btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Belum ada data pendaftaran tryout
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $peserta->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>



@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-pendaftaran').addClass('active')

</script>
@endsection