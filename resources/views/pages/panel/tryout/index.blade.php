@extends('layouts.panel.master')
@section('title') Tryout @endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Admin @endslot
@slot('title') Tryout @endslot
@endcomponent

@include('components.message')

<div class="row">
    <div class="col-xl-12">
        <div class="card px-3">
            <div class="card-header ">
                <!-- Buttons with Label -->

                <form action="">
                    <div class="row g-2">
                        <div class="col-lg-2">
                            <a href="{{ route('panel.tryout.create')}}" class="btn btn-primary w-100"><i class="ri-add-circle-line"></i> Tambah Tryout</a>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="search-task-options" placeholder="Search ..." name="keyword" value="{{ $keyword }}">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select mb-2" id="filter-jenjang" name="jenjang">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select mb-2" id="filter-kelas" name="kelas">
                                <option value="">Pilih Kelas</option>

                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <a href="{{ route('panel.tryout.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
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
                                    <th scope="col">Judul Materi</th>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Umum</th>
                                    <th scope="col">Materi</th>
                                    <th scope="col">Dibuka Sampai</th>
                                    <th scope="col" width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tryout as $data)
                                <tr>
                                    <td>{{ ($tryout->currentpage()-1) * $tryout->perpage() + $loop->index + 1 }}</td>

                                    <td>{{ $data->tryout_judul }}</td>

                                    <td>{{ $data->tryout_jenjang }}</td>
                                    <td>{{ $data->tryout_kelas }}</td>
                                    <td>{{ $data->tryout_jenis }}</td>
                                    <td>{{ $data->is_open }}</td>
                                    <td>
                                        <div class="hstack flex-wrap gap-2 fs-16">
                                            @foreach($data->materi as $materi)
                                            <div class="badge fw-medium badge-soft-info">{{ $materi->refMateri->ref_materi_judul}}</div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ $data->tryout_register_due }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('panel.tryout.show',$data->tryout_id)}}" class="btn rounded-pill btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Detail</a>
                                    </td>
                                </tr>
                                    @empty
                                    @component('components.table-empty', ['colspan' => 9, 'message' => 'Belum ada data tryout.'])@endcomponent
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $tryout->withQueryString()->links() }}

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>



@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#nav-tryout').addClass('active')



    $(".multiple-select2").select2({
        placeholder: "Select a permission",
        dropdownParent: $('#create-modal')
    });

    const classes = {
        SD: ['1', '2', '3', '4', '5', '6'],
        SMP: ['7', '8', '9'],
        SMA: ['10', '11', '12']
    };

    $('#filter-jenjang').change(function() {
        var schoolLevel = $(this).val();
        var $classLevel = $('#filter-kelas');
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




    <?php if ($filter_jenjang) { ?>
        $('#filter-jenjang').val('<?= $filter_jenjang ?>').change()

    <?php } ?>
    <?php if ($filter_kelas) { ?>
        $('#filter-kelas').val('<?= $filter_kelas ?>').change()
    <?php } ?>
</script>
@endsection