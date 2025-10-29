@extends('layouts.panel.master')
@section('title', 'Manajemen Jadwal Siswa')

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Data Akademik @endslot
    @slot('title') Manajemen Jadwal Siswa @endslot
@endcomponent

{{-- Menambahkan @include 'message' dari contoh --}}
@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                {{-- FORM FILTER - Sesuaikan 'action' dengan route Anda --}}
                <form action="{{-- route('panel.jadwal.index') --}}" method="GET">
                    <div class="row g-2">
                        <div class="col-lg-2">
                            {{-- Sesuaikan 'href' dengan route Anda --}}
                            <a href="{{-- route('panel.jadwal.create') --}}" class="btn btn-primary w-100"><i class="ri-add-circle-line"></i> Tambah Jadwal</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Cari Mapel/Guru..." name="keyword" value="{{ request('keyword') }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select" name="hari">
                                <option value="">Pilih Hari</option>
                                <option value="Senin" @selected(request('hari') == 'Senin')>Senin</option>
                                <option value="Selasa" @selected(request('hari') == 'Selasa')>Selasa</option>
                                <option value="Rabu" @selected(request('hari') == 'Rabu')>Rabu</option>
                                <option value="Kamis" @selected(request('hari') == 'Kamis')>Kamis</option>
                                <option value="Jumat" @selected(request('hari') == 'Jumat')>Jumat</option>
                                <option value="Sabtu" @selected(request('hari') == 'Sabtu')>Sabtu</option>
                                <option value="Minggu" @selected(request('hari') == 'Minggu')>Minggu</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                             {{-- Ganti ini dengan data dinamis dari controller Anda (cth: $daftar_kelas) --}}
                            <select class="form-select" name="kelas_id">
                                <option value="">Pilih Kelas</option>
                                <option value="1" @selected(request('kelas_id') == '1')>9 - 1</option>
                                <option value="2" @selected(request('kelas_id') == '2')>9 - 3</option>
                                <option value="3" @selected(request('kelas_id') == '3')>9 - 4</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            {{-- Sesuaikan 'href' dengan route index Anda --}}
                            <a href="{{-- route('panel.jadwal.index') --}}" class="btn btn-danger w-100"> <i class="ri-restart-line me-1 align-bottom"></i>
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
            </div><div class="card-body mb-2">
                <div class="table-responsive table-card mb-2">
                    {{-- Mengganti style tabel lama dengan style dari contoh 'Tryout' --}}
                    <table class="table align-middle table-nowrap table-striped mb-2">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="5%">No. Jadwal</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Guru</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col" width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 
                              Data statis dari file asli Anda. 
                              Ganti '$jadwals' dengan variabel dinamis dari controller Anda (cth: $jadwals)
                            --}}
                            @php
                                $jadwals = [
                                    (object)['id' => 1, 'nama_kelas' => '9 - 1', 'mapel' => 'Matematika', 'guru' => 'Pak Rofiq', 'hari' => 'Senin', 'jam_mulai' => '16:15', 'jam_selesai' => '17:45', 'jumlah_siswa' => 25],
                                    (object)['id' => 2, 'nama_kelas' => '9 - 1', 'mapel' => 'IPA', 'guru' => 'Pak Rischa', 'hari' => 'Senin', 'jam_mulai' => '16:30', 'jam_selesai' => '17:45', 'jumlah_siswa' => 22],
                                    (object)['id' => 3, 'nama_kelas' => '9 - 1', 'mapel' => 'Bahasa Indonesia', 'guru' => 'Bu Devi', 'hari' => 'Senin', 'jam_mulai' => '16:15', 'jam_selesai' => '17:45', 'jumlah_siswa' => 28],
                                    (object)['id' => 4, 'nama_kelas' => '9 - 3', 'mapel' => 'Matematika', 'guru' => 'Pak Wodo', 'hari' => 'Senin', 'jam_mulai' => '16:15', 'jam_selesai' => '17:45', 'jumlah_siswa' => 30],
                                    (object)['id' => 5, 'nama_kelas' => '9 - 3', 'mapel' => 'Bahasa Indonesia', 'guru' => 'Bu Devi', 'hari' => 'Senin', 'jam_mulai' => '16:30', 'jam_selesai' => '18:00', 'jumlah_siswa' => 29],
                                    (object)['id' => 6, 'nama_kelas' => '9 - 4', 'mapel' => 'Bahasa Inggris', 'guru' => 'Uncle', 'hari' => 'Senin', 'jam_mulai' => '18:30', 'jam_selesai' => '20:00', 'jumlah_siswa' => 15],
                                ];
                                // Ganti $jadwalLoop dengan variabel paginasi Anda jika ada
                                $jadwalLoop = $jadwals; 
                            @endphp
                            
                            @forelse($jadwalLoop as $data)
                            <tr>
                                {{-- Ganti $loop->iteration dengan logic paginasi jika perlu --}}
                                <td>{{ $loop->iteration }}</td> 
                                <td><span class="badge badge-soft-primary">{{ $data->nama_kelas }}</span></td>
                                <td>{{ $data->mapel }}</td>
                                <td>{{ $data->guru }}</td>
                                <td>{{ $data->hari }}</td>
                                <td>{{ $data->jam_mulai }}</td>
                                <td>{{ $data->jam_selesai }}</td>
                                
                                {{-- *** BAGIAN AKSI YANG DIUBAH (URUTAN DITUKAR) *** --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Ubah --}}
                                        <a href="{{-- route('panel.jadwal.edit', $data->id) --}}" class="btn rounded-pill btn-warning btn-sm">Ubah</a>
                                        {{-- Tombol Hapus --}}
                                        <a href="#" class="btn rounded-pill btn-danger btn-sm delete-btn" data-id="{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</a>
                                        {{-- Tombol Kelola Siswa --}}
                                        <a href="{{-- route('panel.jadwal.show', $data->id) --}}" class="btn rounded-pill btn-info btn-sm">
                                            <i class="ri-team-line"></i> Kelola
                                        </a>
                                    </div>
                                </td>
                                {{-- *** AKHIR BAGIAN AKSI *** --}}

                            </tr>
                            @empty
                                {{-- Menggunakan component table-empty dari contoh --}}
                                @component('components.table-empty', ['colspan' => 8, 'message' => 'Belum ada data jadwal.'])@endcomponent
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Tambahkan ini jika Anda menggunakan paginasi --}}
                {{-- {{ $jadwals->withQueryString()->links() }} --}}

            </div></div></div></div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus jadwal ini?
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
{{-- Menghapus script select2 & dependent dropdown yang tidak diperlukan --}}
<script>
    // Script untuk menangani modal hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const jadwalId = this.getAttribute('data-id');
            const deleteForm = document.getElementById('deleteForm');
            // Ganti '/panel/jadwal/' dengan URL dasar untuk menghapus jadwal Anda
            deleteForm.action = `/panel/jadwal/${jadwalId}`; 
        });
    });
</script>
@endsection