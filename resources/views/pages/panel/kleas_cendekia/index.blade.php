@extends('layouts.panel.master')
@section('title') Kelas Cendekia @endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<style>
    /* CSS untuk menyamakan tinggi semua elemen filter */
    .select2-container--bootstrap-5 .select2-selection--single {
        height: 38px !important;
        min-height: 38px !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
        padding-left: 12px !important;
        /* Tambahan: Agar teks di kotak input tidak tumpah tapi jadi titik-titik */
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }

    /* === BARU: PAKSA TEKS DI DROPDOWN TURUN KE BAWAH (WRAPPED) === */
    .select2-container--bootstrap-5 .select2-dropdown .select2-results__option {
        white-space: normal !important;      /* Mengizinkan baris baru */
        word-wrap: break-word !important;   /* Memutus kata jika kepanjangan */
        line-height: 1.4 !important;        /* Jarak baris agar tidak rapat */
        padding: 8px 12px !important;       /* Ruang napas teks */
    }

    .form-control,
    .form-select {
        height: 38px !important;
    }

    .btn-new {
        height: 38px !important;
        line-height: 1 !important;
        padding: 0.375rem 0.75rem !important;
    }

    .search-box .form-control {
        height: 38px !important;
    }
</style>

@section('content')
@component('components.breadcrumb')
@slot('li_1') Kelas @endslot
@slot('title') Kelas Cendekia @endslot
@endcomponent

@include('components.message')


<div class="row">
    <div class="col-lg-12">
        <div class="card" id="">
            <div class="card-header">
                <form action="">
                    <div class="row g-2">

                        @if(Auth::user()->hasRole('Admin'))
                        {{-- TATA LETAK UNTUK ADMIN (6 item, 12 col) --}}
                        <div class="col-lg-2 col-sm-4">
                            <a href="#" class="btn btn-primary btn-label waves-effect waves-light w-100 h-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#create-modal">
                                <i class="ri-add-circle-line label-icon align-middle fs-16 me-2"></i> Tambah Kelas
                            </a>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Cari Nama/Jenjang..." name="keyword" value="{{ $keyword ?? '' }}" style="height: 38px;">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select" name="jenjang" style="height: 38px;">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD" {{ ($filter_jenjang_dipilih ?? '') == 'SD' ? 'selected' : ''}}>SD</option>
                                <option value="SMP" {{ ($filter_jenjang_dipilih ?? '') == 'SMP' ? 'selected' : ''}}>SMP</option>
                                <option value="SMA" {{ ($filter_jenjang_dipilih ?? '') == 'SMA' ? 'selected' : ''}}>SMA</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select" name="kelas" style="height: 38px;">
                                <option value="">Pilih Kelas</option>
                                <option value="1" {{ ($filter_kelas_dipilih ?? '') == 1 ? 'selected' : ''}}>Kelas 1</option>
                                <option value="2" {{ ($filter_kelas_dipilih ?? '') == 2 ? 'selected' : ''}}>Kelas 2</option>
                                <option value="3" {{ ($filter_kelas_dipilih ?? '') == 3 ? 'selected' : ''}}>Kelas 3</option>
                                <option value="4" {{ ($filter_kelas_dipilih ?? '') == 4 ? 'selected' : ''}}>Kelas 4</option>
                                <option value="5" {{ ($filter_kelas_dipilih ?? '') == 5 ? 'selected' : ''}}>Kelas 5</option>
                                <option value="6" {{ ($filter_kelas_dipilih ?? '') == 6 ? 'selected' : ''}}>Kelas 6</option>
                                <option value="7" {{ ($filter_kelas_dipilih ?? '') == 7 ? 'selected' : ''}}>Kelas 7</option>
                                <option value="8" {{ ($filter_kelas_dipilih ?? '') == 8 ? 'selected' : ''}}>Kelas 8</option>
                                <option value="9" {{ ($filter_kelas_dipilih ?? '') == 9 ? 'selected' : ''}}>Kelas 9</option>
                                <option value="10" {{ ($filter_kelas_dipilih ?? '') == 10 ? 'selected' : ''}}>Kelas 10</option>
                                <option value="11" {{ ($filter_kelas_dipilih ?? '') == 11 ? 'selected' : ''}}>Kelas 11</option>
                                <option value="12" {{ ($filter_kelas_dipilih ?? '') == 12 ? 'selected' : ''}}>Kelas 12</option>
                            </select>
                        </div>
                        @if(!(Auth::user() && Auth::user()->roles_id == 3))
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select select-pengajar" id="cari-pengajar" name="guru">
                                <option value="">Pilih Pengajar</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-lg-2 btn-filter-group d-flex gap-1">
                            <button type="submit" class="btn btn-primary waves-effect waves-light flex-fill">
                                <i class="ri-search-line align-middle"></i> Cari
                            </button>
                            <a href="{{ route('panel.kelas_cendekia.index') }}" class="btn btn-danger waves-effect waves-light flex-fill">
                                <i class="ri-restart-line align-middle"></i> Reset
                            </a>
                        </div>

                        @else
                        {{-- TATA LETAK UNTUK PENGAJAR (5 item, 12 col) --}}
                        <div class="col-lg-3 col-sm-4">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Cari Nama/Jenjang..." name="keyword" value="{{ $keyword ?? '' }}" style="height: 38px;">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select" name="jenjang" style="height: 38px;">
                                <option value="">Pilih Jenjang</option>
                                <option value="SD" {{ ($filter_jenjang_dipilih ?? '') == 'SD' ? 'selected' : ''}}>SD</option>
                                <option value="SMP" {{ ($filter_jenjang_dipilih ?? '') == 'SMP' ? 'selected' : ''}}>SMP</option>
                                <option value="SMA" {{ ($filter_jenjang_dipilih ?? '') == 'SMA' ? 'selected' : ''}}>SMA</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select" name="kelas" style="height: 38px;">
                                <option value="">Pilih Kelas</option>
                                <option value="1" {{ ($filter_kelas_dipilih ?? '') == 1 ? 'selected' : ''}}>Kelas 1</option>
                                <option value="2" {{ ($filter_kelas_dipilih ?? '') == 2 ? 'selected' : ''}}>Kelas 2</option>
                                <option value="3" {{ ($filter_kelas_dipilih ?? '') == 3 ? 'selected' : ''}}>Kelas 3</option>
                                <option value="4" {{ ($filter_kelas_dipilih ?? '') == 4 ? 'selected' : ''}}>Kelas 4</option>
                                <option value="5" {{ ($filter_kelas_dipilih ?? '') == 5 ? 'selected' : ''}}>Kelas 5</option>
                                <option value="6" {{ ($filter_kelas_dipilih ?? '') == 6 ? 'selected' : ''}}>Kelas 6</option>
                                <option value="7" {{ ($filter_kelas_dipilih ?? '') == 7 ? 'selected' : ''}}>Kelas 7</option>
                                <option value="8" {{ ($filter_kelas_dipilih ?? '') == 8 ? 'selected' : ''}}>Kelas 8</option>
                                <option value="9" {{ ($filter_kelas_dipilih ?? '') == 9 ? 'selected' : ''}}>Kelas 9</option>
                                <option value="10" {{ ($filter_kelas_dipilih ?? '') == 10 ? 'selected' : ''}}>Kelas 10</option>
                                <option value="11" {{ ($filter_kelas_dipilih ?? '') == 11 ? 'selected' : ''}}>Kelas 11</option>
                                <option value="12" {{ ($filter_kelas_dipilih ?? '') == 12 ? 'selected' : ''}}>Kelas 12</option>
                            </select>
                        </div>
                        @if(!(Auth::user() && Auth::user()->roles_id == 3))
                        <div class="col-lg-2 col-sm-4">
                            <select class="form-select select-pengajar" id="cari-pengajar" name="guru" style="height: 38px;">
                                <option value="">Pilih Pengajar</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-lg-3 col-sm-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary waves-effect waves-light flex-fill" style="height: 38px;">
                                <i class="ri-search-line align-middle me-1"></i> Cari
                            </button>
                            <a href="{{ route('panel.kelas_cendekia.index') }}" class="btn btn-danger waves-effect waves-light flex-fill" style="height: 38px;">
                                <i class="ri-restart-line align-middle me-1"></i> Reset
                            </a>
                        </div>
                        @endif

                    </div>
                </form>
            </div>
            {{-- --- AKHIR BLOK FORM YANG DIPERBAIKI --- --}}

            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="1%">#</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Jenjang</th>
                            <th scope="col" colspan="4" class="text-center">Mata Pelajaran</th>
                            <th scope="col">Jumlah Siswa</th>
                            <th scope="col">Status</th>
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

                                <td>{{ $value->siswa_kelas_count }}</td>
                                <td>{{ $value->status }}</td>
                                <td class="text-center">
                                    @if(Auth::user()->hasRole('Admin'))
                                    <a href="{{ route('panel.kelas_cendekia.show',$value->kelas_cendekia_id) }}" class="btn rounded-pill btn-info btn-sm">
                                        Kelola Siswa
                                    </a>
                                    <a href="{{ route('panel.kelas_cendekia.edit', $value->kelas_cendekia_id) }}" class="btn rounded-pill btn-warning btn-sm">
                                        Edit Kelas
                                    </a>
                                    @else
                                    <a href="{{ route('panel.kelas_cendekia.show',$value->kelas_cendekia_id) }}" class="btn rounded-pill btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> Detail
                                    </a>
                                    @endif
                                </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="ri-information-line fs-4 d-block mb-2"></i>
                                Tidak ada data kelas ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $kelas_cendekia->withQueryString()->links() }}

            </div>
        </div>
    </div>
</div>

{{-- ... (Kode Modal Anda tetap sama) ... --}}
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

    // === PERBAIKAN SELECT2 FILTER PENGAJAR ===

    // Ambil ID guru yang dipilih dari Controller
    var selectedGuru = "{{ $filter_guru_dipilih ?? '' }}";

    $.ajax({
        url: '<?= route('ajax.cari-guru') ?>',
        dataType: 'json',
        success: function(data) {
            var $select = $('#cari-pengajar');

            // PERBAIKAN 1: Tambahkan opsi default "Pilih Pengajar"
            var options = [{
                id: '',
                text: 'Pilih Pengajar'
            }];

            // Gabungkan dengan data dari server
            if (data.results && data.results.length > 0) {
                options = options.concat(data.results);
            }

            // Hapus Select2 yang lama jika ada
            if ($select.hasClass("select2-hidden-accessible")) {
                $select.select2('destroy');
            }

            // PERBAIKAN 2: Inisialisasi Select2 dengan data lengkap
            $select.empty().select2({
                data: options,
                theme: 'bootstrap-5',
                placeholder: 'Pilih Pengajar',
                allowClear: true,
                width: 'resolve',
                dropdownAutoWidth: false,
                minimumResultsForSearch: 5, // Tampilkan search box jika ada 5+ item
                containerCssClass: 'select-pengajar-container',
                dropdownCssClass: 'select-pengajar-dropdown'
            });

            // PERBAIKAN 3: Set nilai yang dipilih setelah inisialisasi
            if (selectedGuru && selectedGuru !== '') {
                // Pastikan value ada di dalam options
                var valueExists = options.some(function(opt) {
                    return opt.id == selectedGuru;
                });

                if (valueExists) {
                    $select.val(selectedGuru).trigger('change');
                } else {
                    // Jika value tidak ditemukan, reset ke empty
                    $select.val('').trigger('change');
                    console.warn('Selected guru ID not found in options:', selectedGuru);
                }
            } else {
                // Set ke empty string untuk menampilkan placeholder
                $select.val('').trigger('change');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading guru data:', error);

            // Fallback jika gagal load data
            var $select = $('#cari-pengajar');
            $select.empty().select2({
                data: [{
                    id: '',
                    text: 'Pilih Pengajar'
                }],
                theme: 'bootstrap-5',
                placeholder: 'Pilih Pengajar',
                allowClear: true,
                width: '100%'
            });

            // Tetap set nilai jika ada, untuk menghindari kehilangan filter
            if (selectedGuru && selectedGuru !== '') {
                $select.append(new Option('Guru ID: ' + selectedGuru, selectedGuru, true, true));
                $select.trigger('change');
            }
        }
    });

    // === AKHIR PERBAIKAN SELECT2 ===
</script>

@endsection