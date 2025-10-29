@extends('layouts.panel.master')
@section('title', 'Manajemen Siswa')

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Data Akademik @endslot
    @slot('title') Manajemen Siswa @endslot
@endcomponent

<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Jadwal Kelas & Pengelompokan Siswa</h5>
        <button class="btn btn-primary btn-sm">
            <i class="ri-add-line"></i> Tambah Jadwal
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-warning">
                    <tr>
                        <th>No. Jadwal</th>
                        <th>Nama Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>9 - 1</td><td>Matematika</td><td>Pak Rofiq</td><td>Senin</td><td>16:15</td><td>17:45</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                    <tr><td>2</td><td>9 - 1</td><td>IPA</td><td>Pak Rischa</td><td>Senin</td><td>16:30</td><td>17:45</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                    <tr><td>3</td><td>9 - 1</td><td>Bahasa Indonesia</td><td>Bu Devi</td><td>Senin</td><td>16:15</td><td>17:45</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                    <tr><td>4</td><td>9 - 3</td><td>Matematika</td><td>Pak Wodo</td><td>Senin</td><td>16:15</td><td>17:45</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                    <tr><td>5</td><td>9 - 3</td><td>Bahasa Indonesia</td><td>Bu Devi</td><td>Senin</td><td>16:30</td><td>18:00</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                    <tr><td>6</td><td>9 - 4</td><td>Bahasa Inggris</td><td>Uncle</td><td>Senin</td><td>18:30</td><td>20:00</td>
                        <td><button class="btn btn-sm btn-info">Kelola Siswa</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
