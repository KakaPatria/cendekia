@extends('layouts.panel.master')
@section('title') Beranda @endsection
@section('css')
@endsection
@section('content')

@include('components.message')

<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            @if($is_admin)
                                <h4 class="fs-16 mb-1">Welcome Admin Cendekia</h4>
                            @else
                                <h4 class="fs-16 mb-1">Welcome Pengajar, {{ Auth::user()->name }}!</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

 
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        @if($is_admin)
                                            Jumlah Siswa
                                        @else
                                            Jumlah Siswa Anda
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$jumlah_siswa}}">{{ $jumlah_siswa}}</span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="ri-user-line   text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div></div></div>{{-- Sekolah Terdaftar (Hanya Admin) --}}
                @if($is_admin)
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Sekolah Terdaftar</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$jumlah_sekolah}}">{{ $jumlah_sekolah}}</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                        <i class="ri-building-2-line  text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        @if($is_admin)
                                            Tryout Aktif
                                        @else
                                            Tryout Aktif Anda
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$jumlah_tryout}}">{{$jumlah_tryout}}</span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="ri-file-edit-line  text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div></div></div><div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    {{-- PERUBAHAN LABEL (Poin 3 meeting) --}}
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        @if($is_admin)
                                            Materi
                                        @else
                                            Mata Pelajaran Diampu
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$jumlah_materi}}">{{$jumlah_materi}}</span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="ri-database-line    text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div></div></div></div> {{-- GRAFIK & SEKOLAH (HANYA UNTUK ADMIN) --}}
            @if($is_admin)
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body p-0 pb-2">
                            <div class="w-100">
                                <div id="jenjang-chart"></div>
                            </div>
                        </div></div></div><div class="col-xl-4 col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sekolah dengan murid terbanyak</h4>
                        </div><div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col" style="width: 62;">Nama Sekolah</th>
                                            <th scope="col">Jumlah Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($top_sekolah as $skolah)
                                        <tr>
                                            <td>{{ $skolah['nama']}}</td>
                                            <td class="text-center"> {{ $skolah['jumlah']}}</td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- TABEL JADWAL BARU (HANYA UNTUK PENGAJAR) --}}
            @if(!$is_admin)
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Jadwal yang Anda Ampu</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Nama Kelas</th>
                                            <th scope="col">Mata Pelajaran</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Jam Mulai</th>
                                            <th scope="col">Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jadwal_diampu as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->kelas->kelas_cendekia_nama ?? 'N/A' }}</td>
                                            <td>{{ $jadwal->mataPelajaran->ref_materi_judul ?? 'N/A' }}</td>
                                            <td>{{ $jadwal->jadwal_cendekia_hari }}</td>
                                            <td>{{ $jadwal->jadwal_mulai }}</td>
                                            <td>{{ $jadwal->jadwal_selesai }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Anda belum memiliki jadwal mengajar.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div> </div> </div>

@endsection
@section('script')
@{{-- app.min.js loaded globally in layouts.vendor-scripts --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script>
    // Hanya jalankan grafik jika $is_admin true
    @if($is_admin)
    Highcharts.chart('jenjang-chart', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Grafik Siswa Berdasarkan Jenjang',
            align: 'left'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
                name: 'Siswa',
                data: {!! $data_jenjang !!} 
            },
        ],
        drilldown: {
            breadcrumbs: {
                position: {
                    align: 'right'
                }
            },
            series: {!! $data_kelas !!}
        }
    });
    @endif
</script>
@endsection