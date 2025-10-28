 @extends('layouts.panel.master')
 @section('title') Detail Kelas @endsection
 @section('css')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 @endsection
 @section('content')
 @component('components.breadcrumb')
 @slot('li_1') Kelas Cendekia @endslot
 @slot('title') Tambah Siswa @endslot
 @endcomponent

 @include('components.message')
 <div class="row">
     <div class="col-lg-12">
         <div class="card" id="">
             <div class="card-header">
                 <div class="align-items-center d-flex">
                     <div class="flex-grow-1">
                         <h5 class="mb-3 fw-bold text-uppercase">{{ $kelas_cendekia->kelas_cendekia_nama}}</h5>
                     </div>
                     <div class="flex-shrink-0">
                         <a href="{{ route('panel.kelas_cendekia.show',$kelas_cendekia->kelas_cendekia_id)}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <form id="formTambahSiswa" action="{{ route('panel.kelas_cendekia.storeSiswa', $kelas_cendekia->kelas_cendekia_id) }}" method="POST" class="mb-3">
                     @csrf
                     <table id="tabelSiswa" class="table table-bordered table-striped table-hover align-middle w-100">
                         <thead>
                             <tr>
                                 <th width="5%">
                                     <input type="checkbox" id="checkAll">
                                 </th>
                                 <th>Nama</th>
                                 <th>Email</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($siswa as $row)
                             <tr>
                                 <td>
                                     <input type="checkbox" name="siswa_ids[]" value="{{ $row->id }}">
                                 </td>
                                 <td>{{ $row->name }}</td>
                                 <td>{{ $row->email }}</td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </form>
                 <div class="text-center">
                     <button type="submit" form="formTambahSiswa" class="btn btn-primary waves-effect waves-light  ">Simpan</button>
                 </div>
             </div>

         </div>
     </div>
 </div>
 @endsection
 @section('script')
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
 <script>
     const table = $('#tabelSiswa').DataTable({
         pageLength: 10,
         order: [
             [1, 'asc']
         ],
         language: {
             search: "Cari:",
             lengthMenu: "Tampilkan _MENU_ siswa per halaman",
             zeroRecords: "Tidak ada data ditemukan",
             info: "Menampilkan _START_ - _END_ dari _TOTAL_ siswa",
             infoEmpty: "Tidak ada siswa",
             infoFiltered: "(difilter dari _MAX_ total siswa)",
         }
     });

     $('#checkAll').on('change', function() {
         const checked = $(this).is(':checked');
         $('input[name="siswa_ids[]"]').prop('checked', checked);
     });

     $(document).on('change', 'input[name="siswa_ids[]"]', function() {
         const all = $('input[name="siswa_ids[]"]').length;
         const checked = $('input[name="siswa_ids[]"]:checked').length;
         $('#checkAll').prop('checked', all === checked);
     });
 </script>
 @endsection