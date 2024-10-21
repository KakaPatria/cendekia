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
@slot('title') Edit Soal Tryout @endslot
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
                <form action="{{route('panel.tryout_jawaban.update',$soal->tryout_soal_id)}}" method="post" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="step" class="tab-pane" role="tabpanel" aria-labelledby="step">
                        @if($tryout_materi->jenis_soal == 'PDF')
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
                        <div class="form-group row pt-2">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Point Nilai</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="" name="point" value="{{ $soal->point}}">
                            </div>

                        </div>
                        <table class="table table-nowrap">
                            <th>
                                <tr>
                                    <th class="col-1">Kunci Jawaban</th>
                                    <th class="col-1">Abjad</th>
                                    <th>Isi Jawaban</th>
                                </tr>
                            </th>
                            <tbody>
                                @if($soal->jawaban)
                                @foreach ($soal->jawaban as $key => $value)
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[]" value="{{$value->tryout_jawaban_prefix}}" id="opsi-jawaban-{{$value->tryout_jawaban_prefix}}"></td>
                                    <td>{{ $value->tryout_jawaban_prefix }}</td>
                                    <td><input type="text" class="form-control" name="jawaban[{{ $value->tryout_jawaban_id }}]" value="{{ $value->tryout_jawaban_isi }}"></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[]" value="A" id=""></td>
                                    <td>A.</td>
                                    <td><input type="text" class="form-control" name="jawaban[A]"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[]" value="B" id=""></td>
                                    <td>B.</td>
                                    <td><input type="text" class="form-control" name="jawaban[B]"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[]" value="C" id=""></td>
                                    <td>C.</td>
                                    <td><input type="text" class="form-control" name="jawaban[C]"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="opsi_jawaban[]" value="D" id=""></td>
                                    <td>D.</td>
                                    <td><input type="text" class="form-control" name="jawaban[D]"></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
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