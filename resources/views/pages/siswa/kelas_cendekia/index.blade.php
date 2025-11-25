@extends('layouts.siswa.master')
@section('title') Kelas Cendekia @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Daftar Kelas @endslot
@slot('title') Kelas Cendekia @endslot
@endcomponent

@include('components.message')
<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header mb-2">
            </div>
            <div class="card-body mb-2">

                <div class="table-responsive  table-card mb-2">
                    <table class="table align-middle table-nowrap table-striped mb-2">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col" colspan="4" class="text-center">Mata Pelajaran</th>
                                <th scope="col" width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas_cendekia as $key => $value)
                            @php
                            $jadwalList = $value->jadwal->take(4);
                            $total = count($jadwalList);
                            @endphp
                            <tr>
                                <td>{{ ($kelas_cendekia->currentpage()-1) * $kelas_cendekia->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $value->kelas_cendekia_nama }}</td>
                                <td>{{ $value->kelas.' '.$value->jenjang }}</td>
                                @foreach ($jadwalList as $j)
                                <td>{{ $j->mataPelajaran->ref_materi_judul ?? '' }} ({{ $j->guru->name ?? '' }}) {{$j->jadwal_mulai}}-{{$j->jadwal_selesai}}</td>
                                @endforeach
                                @for ($i = $total; $i < 4; $i++)
                                    <td>-</td>
                                    @endfor
                                    <td class="text-center">
                                        <a href="{{ route('siswa.kelas_cendekia.show',$value->kelas_cendekia_id) }}" class="btn rounded-pill btn-primary btn-sm">
                                            Detail
                                        </a>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $('#nav-kelas-cendekia').addClass('active')
</script>
@endsection