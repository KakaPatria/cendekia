@extends('layouts.panel.master')
@section('title') Pendafataran @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Cari ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <select class="form-select" id="selct-tryout" name="tryout">
                                <option value=""></option>
                                @foreach($tryout as $key=> $value)
                                <option value="{{ $key}}">{{ $value}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg-2 col-auto">
                            <select class="form-control select2" name="asal_sekolah" id="asal_sekolah">
                            </select>

                        </div>
                        <div class="col-lg-2 col-auto">
                            <select id="jenjang" class="form-control" name="jenjang">
                                <option value="">Cari Jenjang</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                            </select>

                        </div>
                        <div class="col-lg-2 col-auto">
                            <select id="kelas" class="form-control" name="kelas">
                                <option value="">Pilih Jenjang Terlebih dahulu</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.pendaftaran.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
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
                                    <td>{{ $data->masterTryout->tryout_judul ?? '' }}</td>
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
    $('#selct-tryout').select2({
        placeholder: 'Cari judul Tryout',
    })
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
</script>
@endsection