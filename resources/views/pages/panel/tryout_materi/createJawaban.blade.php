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
@slot('title') Soal Tryout @endslot
@endcomponent

@include('components.message')

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
                <form action="{{route('panel.tryout_materi.storeJawaban',$tryout_materi->tryout_materi_id)}}" method="post">
                    @csrf
                    <div id="smartwizard">
                        <ul class="nav">
                            @foreach($tryout_materi->soal as $key => $soal)
                            <li class="nav-item">
                                <a class="nav-link" href="#step-{{ $key }}">
                                    No. {{ $soal->tryout_nomor}}
                                </a>
                            </li>
                            @endforeach

                        </ul>

                        <div class="tab-content overflow-auto">
                            @foreach($tryout_materi->soal as $key => $soal)
                            <div id="step-{{ $key }}" class="tab-pane overflow-auto" role="tabpanel" aria-labelledby="step-{{ $key }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="card-title mb-2 flex-grow-1">Pertanyaan</h4>

                                        @if($tryout_materi->jenis_soal == 'PDF')
                                        <a class="image-popup w-50" href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                            <img class="gallery-img img-fluid mx-auto w-50" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                                        </a>
                                        @else
                                        <div id="editor-{{ $key}}" style="height:300px" class="mb-2">
                                        </div>
                                        <input type="hidden" name="soal[{{$soal->tryout_soal_id}}]" id="soal-{{ $key}}">
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <h4 class="card-title">Jawaban</h4>
                                            <div class="form-group row mb-2">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Point Nilai</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" placeholder="" value="1" name="point[{{$soal->tryout_soal_id}}]">
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Jawaban</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select mb-3" aria-label="Default select" name="jenis_soal[{{$soal->tryout_soal_id}}]">
                                                        <option value="SC">Single Choice</option>
                                                        <option value="MC">Multiple Choice</option>
                                                        <option value="MCMA">Multiple Choice Multiple Answer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th class="col-1">Abjad</th>
                                                        <th>Isi Jawaban</th>
                                                        <th class="col-1">Kunci Jawaban</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>A.</td>
                                                        <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][A]"></td>
                                                        <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[{{$soal->tryout_soal_id}}][]" value="A" id=""></td>

                                                    </tr>
                                                    <tr>
                                                        <td>B.</td>
                                                        <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][B]"></td>
                                                        <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[{{$soal->tryout_soal_id}}][]" value="B" id=""></td>

                                                    </tr>
                                                    <tr>
                                                        <td>C.</td>
                                                        <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][C]"></td>
                                                        <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[{{$soal->tryout_soal_id}}][]" value="C" id=""></td>

                                                    </tr>
                                                    <tr>
                                                        <td>D.</td>
                                                        <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][D]"></td>
                                                        <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[{{$soal->tryout_soal_id}}][]" value="D" id=""></td>

                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="text-center ">
                                        @if ($loop->last)
                                        <button type="button" class="btn rounded-pill btn-warning  back-btn">Kembali</button>
                                        <button type="submit" class="btn rounded-pill btn-primary ">Simpan</button>
                                        @else
                                        <button type="button" class="btn rounded-pill btn-warning back-btn">Kembali</button>
                                        <button type="button" class="btn rounded-pill btn-success next-btn">Selanjutnya</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <!-- Include optional progressbar HTML -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
<script src="https://cdn.quilljs.com/1.2.2/quill.min.js"></script>
<script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>



<script>
    $('#nav-tryout').addClass('active')
    $('#smartwizard').smartWizard({
        toolbar: {
            showNextButton: false, // show/hide a Next button
            showPreviousButton: false, // show/hide a Previous button
        }
    });

    $('.back-btn').click(function() {
        $('#smartwizard').smartWizard("prev");

    })
    $('.next-btn').click(function() {
        $('#smartwizard').smartWizard("next");

    })

    <?php foreach ($tryout_materi->soal as $key => $soal) { ?>
        var quill<?= $key ?> = new Quill('#editor-<?= $key ?>', {
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

        quill<?= $key ?>.getModule('toolbar').addHandler('image', imageHandlerquill<?= $key ?>);

        function imageHandlerquill<?= $key ?>() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = function() {
                const file = input.files[0];

                if (/^image\//.test(file.type)) {
                    uploadImage(file, quill<?= $key ?>);
                } else {
                    console.warn('Hanya gambar yang diizinkan');
                }
            };
        }
    <?php } ?>

    $('form').on('submit', function(e) {
        e.preventDefault(); // Mencegah submit form langsung
        <?php foreach ($tryout_materi->soal as $key => $soal) { ?>
            $('#soal-<?= $key ?>').val(quill<?= $key ?>.root.innerHTML)
        <?php } ?>


        setTimeout(function() {
            $('form').off('submit').submit(); // Submit form setelah delay
        }, 500); //
    });

    $('select[name^="jenis_soal"]').on('change', function() {
        const soalId = $(this).attr('name').match(/\[(.*?)\]/)[1];
        const jenis = $(this).val();
        const checkboxes = $(`input[name="opsi_jawaban[${soalId}][]"]`);

        checkboxes.prop('checked', false);

        if (jenis === 'SC') {
            // Hanya boleh satu checkbox dicentang
            checkboxes.off('change').on('change', function() {
                if (this.checked) {
                    checkboxes.not(this).prop('checked', false);
                }
            });
        } else {
            // Boleh lebih dari satu
            checkboxes.off('change');
        }
    });
    $('select[name^="jenis_soal"]').trigger('change');

    // Upload gambar ke server
    function uploadImage(file, quilKey) {
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
                    const range = quilKey.getSelection();
                    quilKey.insertEmbed(range.index, 'image', result.image_url);
                }
            })
            .catch(error => {
                console.log('Error:', error);
            });
    }
</script>
@endsection