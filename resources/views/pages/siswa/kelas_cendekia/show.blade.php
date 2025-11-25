@extends('layouts.siswa.master')
@section('title') Kelas Cendekia @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Detail Kelas @endslot
@slot('title') Kelas Cendekia @endslot
@endcomponent

@include('components.message')
<div class="row">
   <div class="col-lg-6">
         <div class="card" id="">
             <div class="card-header ">
                  <h5 class="card-title mb-2 fw-bold"> {{ $kelas_cendekia->kelas_cendekia_nama}}&nbsp;&nbsp;{!! $kelas_cendekia->status_badge !!}</h5>
             </div>
             <div class="card-body">
                
                 <ul class="list-inline mb-2">
                     <li class="list-inline-item"><i class="ri-building-line text-success align-middle me-1"></i> {{ $kelas_cendekia->jenjang}} Kelas {{ $kelas_cendekia->kelas}}</li>
                 </ul>
                 <p class="mb-4">{!! $kelas_cendekia->kelas_cendekia_keterangan !!}</p>
                 <hr>
                 <div class="align-items-center d-flex mb-2">
                     <div class="flex-grow-1">
                         <h6 class="card-title mb-2 fw-bold">Daftar Jadwal</h6>
                     </div>
                     <div class="flex-shrink-0">
                         
                     </div>
                 </div>
                 <table class="table table-striped">
                     <thead class="table-light">
                         <tr>
                             <th scope="col" width="1%">#</th>
                             <th scope="col">Mata Pelajaran</th>
                             <th scope="col">Guru</th>
                             <th scope="col">Jam Mulai</th>
                             <th scope="col">Jam Selesai</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($kelas_cendekia->jadwal as $keyJadwal => $jadwal)
                         <tr>
                             <td>{{ $loop->iteration}}</td>
                             <td>{{ $jadwal->mataPelajaran->ref_materi_judul ?? ''}}</td>
                             <td>{{ $jadwal->guru->name ?? ''}}</td>
                             <td>{{ $jadwal->jadwal_mulai}}</td>
                             <td>{{ $jadwal->jadwal_selesai}}</td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
   <div class="col-lg-6">
         <div class="card" id="">
             <div class="card-header ">
                  <h5 class="mb-3 fw-bold text-uppercase">Nilai</h5>
             </div>
             <div class="card-body">
                  
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