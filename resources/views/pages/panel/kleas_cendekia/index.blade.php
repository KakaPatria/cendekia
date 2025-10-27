 @extends('layouts.panel.master')
 @section('title') Pendafataran @endsection
 @section('css')

 @endsection
 @section('content')
 @component('components.breadcrumb')
 @slot('li_1') Kelas @endslot
 @slot('title') Kelas Cendekia @endslot
 @endcomponent

 @include('components.message')

 <div class="row">
     <div class="col-lg-12">
         <div class="card" id="">
             <div class="card-header ">
                 <form action="">
                     <div class="row g-2">
                         <div class="col-lg-2 col-sm-4">
                             <a href="#" class="btn btn-primary btn-label waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="ri-add-circle-line  label-icon align-middle fs-16 me-2"></i> Tambah Kelas</a>
                         </div>
                         <div class="col-lg-2 col-sm-4">
                             <div class="search-box">
                                 <input type="text" class="form-control search w-100" id="search-task-options" placeholder="Cari ..." name="keyword" value="{{ $keyword }}">
                                 <i class="ri-search-line search-icon"></i>
                             </div>
                         </div>
                         <div class="col-lg-2 col-sm-4 ">
                             <button type="submit" class="btn btn-primary btn-label waves-effect waves-light"><i class="ri-search-line  label-icon align-middle fs-16 me-2"></i> Cari</button>
                             <a href="{{ route('panel.kelas_cendekia.index', ) }}" class="btn btn-danger btn-label waves-effect waves-light">
                                 <i class="ri-restart-line label-icon align-middle fs-16 me-2"></i> Reset
                             </a>
                         </div>
                     </div>

                 </form>
             </div>
             <div class="card-body">
                 <table class="table table-striped">
                     <thead class="table-light">
                         <tr>
                             <th scope="col" width="1%">#</th>
                             <th scope="col">Nam Kelas</th>
                             <th scope="col">Jenjang</th>
                             <th scope="col" colspan="4" class="text-center">Mata Pelajaran</th>
                             <th scope="col">Jumlah Siswa</th>
                             <th scope="col">Status</th>
                             <th scope="col" width="10%" class="text-center">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($kelas_cendekia as $key => $value)
                         @php
                         $jadwalList = $value->jadwal->take(4); // ambil maksimal 4 jadwal
                         $total = count($jadwalList);
                         @endphp
                         <tr>
                             <td>{{ ($kelas_cendekia->currentpage()-1) * $kelas_cendekia->perpage() + $loop->index + 1 }}</td>
                             <td>{{ $value->kelas_cendekia_nama}}</td>
                             <td>{{ $value->kelas.' '.$value->jenjang}}</td>

                             {{-- loop jadwal yang ada --}}
                             @foreach ($jadwalList as $j)
                             <td>{{ $j->mataPelajaran->ref_materi_judul ?? '' }} ({{ $j->guru->name ?? '' }}) {{$j->jadwal_mulai}}-{{$j->jadwal_selesai}}</td>
                             @endforeach

                             {{-- isi sisa kolom biar tetap 4 --}}
                             @for ($i = $total; $i < 4; $i++)
                                 <td>-</td>
                                 @endfor
                                 <td>{{ $value->siswa_kelas_count }}</td>
                                 <td>{{ $value->status }}</td>
                                 <td class="text-center"><a href="{{ route('panel.kelas_cendekia.show',$value->kelas_cendekia_id) }}" class="btn rounded-pill btn-primary btn-sm"><i class="fa fa-edit"></i> detail</a></td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
                 {{ $kelas_cendekia->withQueryString()->links() }}

             </div>
         </div>
     </div>
 </div>


 <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="create-modal-label">Tambah Kelas</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{route('panel.kelas_cendekia.store')}}" method="POST" id="create-form" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Nama kelas</label>
                         <div class="col-md-9">
                             <input type="text" class="form-control mb-2" name="kelas_cendekia_nama" value="{{old('kelas_cendekia_nama')}}" />

                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Jenjang</label>
                         <div class="col-md-9">
                             <select id="add-jenjang" class="form-control" name="jenjang">
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

                             <select id="add-kelas" class="form-control" name="kelas">
                                 <option value="">Pilih Jenjang Terlebih dahulu</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Keterangan</label>
                         <div class="col-md-9">
                             <textarea class="form-control" id="" name="kelas_cendekia_keterangan" rows="5">{{old('kelas_cendekia_keterangan')}}</textarea>
                         </div>
                     </div>
                     <div class="form-group row mb-3">
                         <label class="col-form-label col-md-3">Status</label>
                         <div class="col-md-9">
                             <select id="add-status" class="form-control" name="status">
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

 @endsection
 @section('script')

 <script>
     const classes = {
         SD: ['1', '2', '3', '4', '5', '6'],
         SMP: ['7', '8', '9'],
         SMA: ['10', '11', '12']
     };

     $('#add-jenjang').change(function() {
         var schoolLevel = $(this).val();
         var $classLevel = $('#add-kelas');
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