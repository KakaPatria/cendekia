 @extends('layouts.panel.master')
 @section('title') Detail Kelas @endsection
 @section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">
 <style>
     .ui-datepicker {
         z-index: 99999 !important;
     }
 </style>
 @endsection
 @section('content')
 @component('components.breadcrumb')
 @slot('li_1') Kelas Cendekia @endslot
 @slot('title') Detail @endslot
 @endcomponent

 @include('components.message')

 <div class="row">
     <div class="col-lg-6">
         <div class="card" id="">
             <div class="card-header ">
                 <div class="align-items-center d-flex">
                     <div class="flex-grow-1">
                         <h5 class="mb-3 fw-bold text-uppercase">Detail Kelas</h5>
                     </div>
                     <div class="flex-shrink-0">
                         {{-- Support both Spatie roles and legacy roles_id column (2 == Admin) --}}
                         @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                         <a href="javasript:;" class="btn rounded-pill btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKelasModal">
                             <i class="fa fa-edit"></i> Edit</a>
                         <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteKelasModal"><i class="fa fa-trash"></i> Hapus</a>
                         @endif
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <h5 class="card-title mb-2 fw-bold"> {{ $kelas_cendekia->kelas_cendekia_nama}}&nbsp;&nbsp;{!! $kelas_cendekia->status_badge !!}</h5>
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
                         @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                         <a href="#" class="btn btn-primary btn-sm btn-label waves-effect waves-light " data-bs-toggle="modal" data-bs-target="#add-materi-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Jadwal</a>
                         @endif
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
                             @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                             <th scope="col" class="text-center">Action</th>
                             @endif
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
                             @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                             <td class="text-center"> <a href="javascript:;" class="btn rounded-pill btn-warning btn-sm edit-materi-btn" data-bs-toggle="modal" data-bs-target="#edit-materi-modal" data-jadwal_cendekia_id="{{ $jadwal->jadwal_cendekia_id}}" data-ref_materi_id="{{ $jadwal->ref_materi_id}}" data-guru_id="{{ $jadwal->guru_id}}" data-jadwal_cendekia_hari="{{ $jadwal->jadwal_cendekia_hari}}" data-jadwal_mulai="{{ $jadwal->jadwal_mulai}}" data-jadwal_selesai="{{ $jadwal->jadwal_selesai}}">
                                     <i class="fa fa-edit"></i> Edit</a>
                                 <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteMateriBtn" data-bs-toggle="modal" data-bs-target="#deleteMateriModal" data-id="{{$jadwal->jadwal_cendekia_id}}" data-name="{{$jadwal->mataPelajaran->ref_materi_judul}}"><i class="fa fa-trash"></i> Hapus</a>
                             </td>
                             @endif
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
                 <div class="align-items-center d-flex">
                     <div class="flex-grow-1">
                         <h5 class="mb-3 fw-bold text-uppercase">Daftar Siswa</h5>
                     </div>
                     <div class="flex-shrink-0">
                         {{-- Support both Spatie roles and legacy roles_id column (2 == Admin) --}}
                         @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                         <a href="{{ route('panel.kelas_cendekia.addSiswa',$kelas_cendekia->kelas_cendekia_id)}}" class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Siswa</a>
                         @endif
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <table class="table table-striped">
                     <thead class="table-light">
                         <tr>
                             <th scope="col" width="1%">#</th>
                             <th scope="col">Nama siswa</th>
                             <th scope="col">Asal Sekolah</th>
                             <th scope="col">Telepon</th>
                             @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                             <th scope="col" class="text-center">Action</th>
                             @endif
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($kelas_cendekia->siswaKelas as $keysiswa => $siswa)
                         <tr>
                             <td>{{ $loop->iteration}}</td>
                             <td>{{ $siswa->siswa->name ?? ''}}</td>
                             <td>{{ $siswa->siswa->asal_sekolah ?? ''}}</td>
                             <td>{{ $siswa->siswa->telepon ?? ''}}</td>
                             @if(Auth::user()->hasRole(['Admin']) || Auth::user()->roles_id == 2)
                             <td class="text-center">
                                 <a href="javascript:;" class="btn rounded-pill btn-danger btn-sm deleteSiswaBtn" data-bs-toggle="modal" data-bs-target="#deleteSiswaModal" data-kelas_cendekia_id="{{$siswa->kelas_cendekia_id}}"
                                     data-kelas_siswa_cendekia_id="{{$siswa->kelas_siswa_cendekia_id}}" data-name="{{$siswa->siswa->name ?? ''}}"><i class="fa fa-trash"></i> Hapus</a>
                             </td>
                             @endif
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModal-label" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editKelasModal-label">Edit Kelas</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{route('panel.kelas_cendekia.update',$kelas_cendekia->kelas_cendekia_id)}}" method="POST" id="create-form" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Nama kelas</label>
                         <div class="col-md-9">
                             <input type="text" class="form-control mb-2" name="kelas_cendekia_nama" value="{{old('kelas_cendekia_nama',$kelas_cendekia->kelas_cendekia_nama)}}" />

                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jenjang</label>
                         <div class="col-md-9">
                             <select id="edit-jenjang" class="form-control" name="jenjang">
                                 <option value="">Pilih Jenjang</option>
                                 <option value="SD">SD</option>
                                 <option value="SMP">SMP</option>
                                 <option value="SMA">SMA</option>
                             </select>

                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Kelas</label>
                         <div class="col-md-9">

                             <select id="edit-kelas" class="form-control" name="kelas">
                                 <option value="">Pilih Jenjang Terlebih dahulu</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Keterangan</label>
                         <div class="col-md-9">
                             <textarea class="form-control" id="" name="kelas_cendekia_keterangan" rows="5">{{old('kelas_cendekia_keterangan',$kelas_cendekia->kelas_cendekia_keterangan)}}</textarea>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Status</label>
                         <div class="col-md-9">
                             <select id="edit-status" class="form-control" name="status">
                                 <option value="">Pilih Status</option>
                                 <option value="Aktif">Aktif</option>
                                 <option value="Tidak Aktif">Tidak Aktif</option>
                             </select>
                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="create-form" class="btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </div>


 <div class="modal fade" id="deleteKelasModal" tabindex="-1" aria-labelledby="deleteKelasModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteKelasModalLabel">Hapus Kelas</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                 </button>
             </div>
             <div class="modal-body">
                 Apakah anda yakin menghapus kelas <strong id="deleteName">{{ $kelas_cendekia->kelas_cendekia_nama}}</strong>
                 <form action="{{ route('panel.kelas_cendekia.destroy',$kelas_cendekia->kelas_cendekia_id)}}" method="POST" id="deleteKelasForm">
                     @csrf
                     @method('DELETE')
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="deleteKelasForm" class="btn btn-danger">Hapus</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="add-materi-modal" tabindex="-1" aria-labelledby="add-soal-label" aria-hidden="true">
     <div class="modal-dialog modal-lg ">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="add-invoice-label">Tambah Mata Pelajaran</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{route('panel.kelas_cendekia.addMateri')}}" id="add-materi-form" method="post" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="kelas_cendekia_id" value="{{ $kelas_cendekia->kelas_cendekia_id}}">
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Mata Pelajaran</label>
                         <div class="col-md-9">

                             <select class="form-control select-materi" id="add-select-materi" name="ref_materi_id">
                                 <option value="">-- Pilih Materi --</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Pengajar</label>
                         <div class="col-md-9">
                             <select class="form-control select-pengajar" id="add-select-pengajar" name="guru_id">
                                 <option value="">-- Pilih Pengajar --</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Hari</label>
                         <div class="col-md-9">
                             <select id="hari" name="jadwal_cendekia_hari" class="form-select" required>
                                 <option value="">-- Pilih Hari --</option>
                                 <option value="Senin">Senin</option>
                                 <option value="Selasa">Selasa</option>
                                 <option value="Rabu">Rabu</option>
                                 <option value="Kamis">Kamis</option>
                                 <option value="Jumat">Jumat</option>
                                 <option value="Sabtu">Sabtu</option>
                                 <option value="Minggu">Minggu</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jam Mulai</label>
                         <div class="col-md-9">
                             <input type="text" id="add_jadwal_mulai" name="jadwal_mulai" class="form-control addkelas-timepicker" placeholder="Pilih jam mulai">
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jam Selesai</label>
                         <div class="col-md-9">
                             <input type="text" id="add_jadwal_selesai" name="jadwal_selesai" class="form-control addkelas-timepicker" placeholder="Pilih jam selesai">
                         </div>
                     </div>

                 </form>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="add-materi-form" class="btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="edit-materi-modal" tabindex="-1" aria-labelledby="edit-soal-label" aria-hidden="true">
     <div class="modal-dialog modal-lg ">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="edit-invoice-label">Edit Mata Pelajaran</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="edit-materi-form" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <input type="hidden" name="kelas_cendekia_id" value="{{ $kelas_cendekia->kelas_cendekia_id}}">
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Mata Pelajaran</label>
                         <div class="col-md-9">

                             <select class="form-control select-materi" id="edit-select-materi" name="ref_materi_id">
                                 <option value="">-- Pilih Materi --</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Pengajar</label>
                         <div class="col-md-9">
                             <select class="form-control select-pengajar" id="edit-select-pengajar" name="guru_id">
                                 <option value="">-- Pilih Pengajar --</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Hari</label>
                         <div class="col-md-9">
                             <select id="edit-hari" name="jadwal_cendekia_hari" class="form-select" required>
                                 <option value="">-- Pilih Hari --</option>
                                 <option value="Senin">Senin</option>
                                 <option value="Selasa">Selasa</option>
                                 <option value="Rabu">Rabu</option>
                                 <option value="Kamis">Kamis</option>
                                 <option value="Jumat">Jumat</option>
                                 <option value="Sabtu">Sabtu</option>
                                 <option value="Minggu">Minggu</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jam Mulai</label>
                         <div class="col-md-9">
                             <input type="text" id="edit_jadwal_mulai" name="jadwal_mulai" class="form-control  " placeholder="Pilih jam mulai">
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jam Selesai</label>
                         <div class="col-md-9">
                             <input type="text" id="edit_jadwal_selesai" name="jadwal_selesai" class="form-control  " placeholder="Pilih jam selesai">
                         </div>
                     </div>

                 </form>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="edit-materi-form" class="btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="deleteMateriModal" tabindex="-1" aria-labelledby="deleteMateriModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteMateriModalLabel">Hapus Jadwal</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                 </button>
             </div>
             <div class="modal-body">
                 Apakah anda yakin menghapus <strong id="deleteMateriName"></strong>
                 <form action="" method="POST" id="deleteMateriForm">
                     @csrf
                     @method('DELETE')
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="deleteMateriForm" class="btn btn-danger">Hapus</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="deleteSiswaModal" tabindex="-1" aria-labelledby="deleteSiswaModalModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteSiswaModalModalLabel">Hapus Siswa</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">
                 Apakah anda yakin menghapus <strong id="deleteSiswaName"></strong>
                 <form action="" method="POST" id="deleteSiswaForm">
                     @csrf
                     @method('DELETE')
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                 <button type="submit" form="deleteSiswaForm" class="btn btn-danger">Hapus</button>
             </div>
         </div>
     </div>
 </div>

 @endsection
 @section('script')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
 <script>
     const classes = {
         SD: ['1', '2', '3', '4', '5', '6'],
         SMP: ['7', '8', '9'],
         SMA: ['10', '11', '12']
     };

     $('#edit-jenjang').change(function() {
         var schoolLevel = $(this).val();
         var $classLevel = $('#edit-kelas');
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

     $('#edit-status').val('<?= $kelas_cendekia->status ?>').trigger('change');
     $('#edit-jenjang').val('<?= $kelas_cendekia->jenjang ?>').trigger('change');
     $('#edit-kelas').val('<?= $kelas_cendekia->kelas ?>').trigger('change');

     $.ajax({
         url: '<?= route('ajax.materi-kelas') ?>',
         data: {
             kelas: '<?= $kelas_cendekia->kelas ?>',
             jenjang: '<?= $kelas_cendekia->jenjang ?>',
         },
         dataType: 'json',
         success: function(data) {
             $('#add-select-materi').empty().select2({
                 data: data.results,
                 dropdownParent: $('#add-materi-modal'),
                 placeholder: 'Pilih Materi'
             });
             $('#edit-select-materi').empty().select2({
                 data: data.results,
                 dropdownParent: $('#edit-materi-modal'),
                 placeholder: 'Pilih Materi'
             });
         }
     });

     $.ajax({
         url: '<?= route('ajax.cari-guru') ?>',
         dataType: 'json',
         success: function(data) {
             $('#add-select-pengajar').empty().select2({
                 data: data.results,
                 dropdownParent: $('#add-materi-modal'),
                 placeholder: 'Pilih Pengajar'
             });

             $('#edit-select-pengajar').empty().select2({
                 data: data.results,
                 dropdownParent: $('#edit-materi-modal'),
                 placeholder: 'Pilih Pengajar'
             });
         }
     });


     $('.edit-materi-btn').click(function() {
         var jadwal_cendekia_id = $(this).data('jadwal_cendekia_id');
         var ref_materi_id = $(this).data('ref_materi_id');
         var guru_id = $(this).data('guru_id');
         var jadwal_cendekia_hari = $(this).data('jadwal_cendekia_hari');
         var jadwal_mulai = $(this).data('jadwal_mulai');
         var jadwal_selesai = $(this).data('jadwal_selesai');
         var jadwal_cendekia_keterangan = $(this).data('jadwal_cendekia_keterangan');

         $('#edit-materi-form').attr('action', '<?php echo route('panel.kelas_cendekia.updateMateri', '') ?>/' + jadwal_cendekia_id)

         $('#edit-select-materi').val(ref_materi_id).change();
         $('#edit-select-pengajar').val(guru_id).change();
         $('#edit-hari').val(jadwal_cendekia_hari).change();
         $('#edit_jadwal_mulai').val(jadwal_mulai);
         $('#edit_jadwal_selesai').val(jadwal_selesai);

     })

     $('.deleteMateriBtn').click(function() {
         var id = $(this).data('id');
         var name = $(this).data('name');
         $('#deleteMateriForm').attr('action', '<?php echo route('panel.kelas_cendekia.destroyMateri', '') ?>/' + id)
         $('#deleteMateriName').html(name);
     })

     $('.deleteSiswaBtn').click(function() {
         var kelas_cendekia_id = $(this).data('kelas_cendekia_id');
         var kelas_siswa_cendekia_id = $(this).data('kelas_siswa_cendekia_id');
         var name = $(this).data('name');
         $('#deleteSiswaForm').attr('action', '<?php echo route('panel.kelas_cendekia.destroySiswa', ['', '']) ?>/' + kelas_cendekia_id + '/' + kelas_siswa_cendekia_id)
         $('#deleteSiswaName').html(name);
     })
 </script>

 </script>
 @endsection