@extends('layouts.panel.master')
@section('title') Soal Tryout @endsection
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
<link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
<link rel="stylesheet" href="https://cdn.quilljs.com/1.2.2/quill.snow.css">

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Detail @endslot
@slot('title') Ubah Soal Tryout @endslot
@endcomponent

@include('components.message')
<div class="row g-4 mb-3">
    <div class="col-sm">
        <div class="d-flex justify-content-sm-end gap-2">
            <div>
                <a href="{{ route('panel.tryout_materi.show',$tryout_materi->tryout_materi_id)}}" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-bold text-uppercase">{{ $tryout_materi->refMateri->ref_materi_judul}}</h6>
                    {!! $tryout_materi->tryout_materi_deskripsi!!}
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-body">
                <form action="{{route('panel.tryout_jawaban.update',$soal->tryout_soal_id)}}" method="post" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="step" class="tab-pane" role="tabpanel" aria-labelledby="step">
                        <div class="row">
                            <div class="col lg-6">
                                <h4 class="card-title mb-2 flex-grow-1">Pertanyaan</h4>
                                @if($tryout_materi->jenis_soal == 'PDF')
                                <div class="overflow-auto">
                                    <div class="d-flex mb-2 text-center border border-dark" style="height: 300px;">
                                        <a class="image-popup " href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                            <img class="gallery-img img-fluid mx-auto  border border-dark" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group mb-3 " id="file-soal-input">
                                    <label class="col-form-label ">File Soal</label>
                                    <div class="">
                                        <input type="file" class="form-control mb-2" name="soal" id="file-soal">
                                    </div>
                                </div>
                                @else
                                {{--<textarea name="soal" id="editor_soal" class="form-control"></textarea>--}}
                                <div id="editor_soal" style="height:300px" class="mb-2">
                                    {!! $soal->tryout_soal !!}
                                </div>
                                <input type="hidden" name="soal" id="soal">

                                @endif
                            </div>
                            <div class="col-lg-6 soal-container" data-soal-id="{{ $soal->tryout_soal_id }}">
                                <h4 class="card-title mb-2 flex-grow-1">Jawaban</h4>

                                {{-- Point Nilai --}}
                                <div class="form-group row mb-2 pt-2">
                                    <label class="col-sm-2 col-form-label">Point Nilai</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="point"
                                            value="{{ old('point', $soal->point) }}">
                                    </div>
                                </div>

                                {{-- Jenis Soal --}}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Soal</label>
                                    <div class="col-sm-10">
                                        <select class="form-select mb-3 jenis-soal" name="jenis_soal">
                                            <option value="">--Pilih Jenis Soal--</option>
                                            <option value="SC" @selected($soal->tryout_soal_type == 'SC')>Single Choice</option>
                                            <option value="MCMA" @selected($soal->tryout_soal_type == 'MCMA')>Multiple Choice</option>
                                            <option value="TF" @selected($soal->tryout_soal_type == 'TF')>Pilihan Ganda Kompleks Kategori</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Jenis Jawaban khusus TF --}}
                                <div class="form-group row {{ $soal->tryout_soal_type == 'TF' ? '' : 'd-none' }}" id="jenis-jawaban">
                                    <label class="col-sm-2 col-form-label">Jenis Jawaban</label>
                                    <div class="col-sm-10">
                                        <select class="form-select mb-3" name="notes">
                                            <option value="">--Pilih Jenis Jawaban--</option>
                                            <option value="Benar,Salah" @selected($soal->notes == 'Benar,Salah')>Benar, Salah</option>
                                            <option value="Setuju,Tidak setuju" @selected($soal->notes == 'Setuju,Tidak setuju')>Setuju, Tidak setuju</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Tabel Jawaban --}}
                                <table class="table table-nowrap jawaban-table">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Abjad</th>
                                            <th>Isi Jawaban</th>
                                            <th class="col-2">Kunci Jawaban</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $jenis = $soal->tryout_soal_type;
                                        $jawabanKunci = $soal->tryout_kunci_jawaban ? json_decode($soal->tryout_kunci_jawaban, true) : [];
                                        $opsiJawabanMCMA = $jawabanKunci ?? []; // untuk MCMA
                                        @endphp

                                        @foreach (['A', 'B', 'C', 'D'] as $abjad)
                                        @php
                                        $jawabanIsi = optional($soal->jawaban->firstWhere('tryout_jawaban_prefix', $abjad))->tryout_jawaban_isi;
                                        @endphp
                                        <tr>
                                            <td>{{ $abjad }}.</td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="jawaban[{{ $abjad }}]"
                                                    value="{{ old('jawaban.'.$abjad, $jawabanIsi) }}">
                                            </td>

                                            {{-- Kunci Jawaban: tipe dinamis --}}
                                            <td class="opsi-cell">
                                                <select class="form-select {{ $soal->tryout_soal_type == 'TF' ? '' : 'd-none' }}" name="opsi_jawaban_tf[{{ $abjad }}]">
                                                    <option value="">--Pilih--</option>
                                                    <option value="Benar" @selected(($opsiJawabanMCMA[$abjad] ?? '' )=='Benar' )>Benar</option>
                                                    <option value="Salah" @selected(($opsiJawabanMCMA[$abjad] ?? '' )=='Salah' )>Salah</option>
                                                </select>

                                                <input class="form-check-input opsi-checkbox {{ $soal->tryout_soal_type == 'TF' ? 'd-none' : '' }}"
                                                    type="checkbox"
                                                    name="opsi_jawaban[]"
                                                    value="{{ $abjad }}"
                                                    id="opsi-jawaban-{{ $abjad }}"
                                                    @checked(in_array($abjad, $jawabanKunci ?? []))>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="overflow-auto">

                            <div class="text-center mt-2">
                                <button type="submit" class="btn rounded-pill btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end card-->
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SmartWizard JavaScript -->
<script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.quilljs.com/1.2.2/quill.min.js"></script>
<script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>


<script>
    $('#nav-tryout').addClass('active')


    <?php if ($tryout_materi->jenis_soal != 'PDF') { ?>

        var quill = new Quill('#editor_soal', {
            theme: 'snow',
            modules: {
                imageResize: {
                    displaySize: true
                },
                toolbar: [
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                    ['link', 'image'],

                    ['clean']
                ]
            }
        });

        $('form').on('submit', function(e) {
            e.preventDefault(); // Mencegah submit form langsung
            $('#soal').val(quill.root.innerHTML)
            setTimeout(function() {
                $('form').off('submit').submit(); // Submit form setelah delay
            }, 500); //
        });

        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = function() {
                const file = input.files[0];

                if (/^image\//.test(file.type)) {
                    uploadImage(file);
                } else {
                    console.warn('Hanya gambar yang diizinkan');
                }
            };
        }

        // Upload gambar ke server
        function uploadImage(file) {
            const formData = new FormData();
            formData.append('upload', file);

            fetch('<?= route('ajax.upload-img-soal') ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        // Tambahkan gambar ke editor Quill
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.image_url);
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        }
        quill.getModule('toolbar').addHandler('image', imageHandler);
    <?php } ?>

    $('.jenis-soal').on('change', function() {
        const jenis = $(this).val();
        const container = $(this).closest('.soal-container');
        const tbody = container.find('.jawaban-table tbody');

        // Reset tampilan
        container.find('#jenis-jawaban').addClass('d-none');
        tbody.find('.opsi-cell').html('');

        if (jenis === 'SC' || jenis === 'MCMA') {
            // Buat checkbox
            tbody.find('tr').each(function() {
                const abjad = $(this).find('td:first').text().replace('.', '').trim();
                $(this).find('.opsi-cell').html(`
                <input class="form-check-input opsi-checkbox" type="checkbox" name="opsi_jawaban[]" value="${abjad}">
            `);
            });

            // Single Choice hanya 1 boleh dipilih
            if (jenis === 'SC') {
                container.find('.opsi-checkbox').off('change').on('change', function() {
                    if (this.checked) container.find('.opsi-checkbox').not(this).prop('checked', false);
                });
            }

        } else if (jenis === 'TF') {
            // Tampilkan pilihan jenis jawaban
            container.find('#jenis-jawaban').removeClass('d-none');
            tbody.find('tr').each(function() {
                const abjad = $(this).find('td:first').text().replace('.', '').trim();
                $(this).find('.opsi-cell').html(`
                <select class="form-select" name="opsi_jawaban_tf[${abjad}]">
                    <option value="">--Pilih--</option>
                    <option value="Benar">Benar</option>
                    <option value="Salah">Salah</option>
                </select>
            `);
            });
        }
    });

    <?php if ($soal->tryout_soal_type == 'SC') { ?>
        $('.jenis-soal').val('<?= $soal->tryout_soal_type ?>').trigger('change');
    <?php } ?>

    <?php
    if ($soal->tryout_kunci_jawaban) {
        foreach (json_decode($soal->tryout_kunci_jawaban) as $key => $value) {
    ?>
            $('#opsi-jawaban-<?= $value ?>').prop('checked', true);
    <?php
        }
    } ?>
</script>
@endsection