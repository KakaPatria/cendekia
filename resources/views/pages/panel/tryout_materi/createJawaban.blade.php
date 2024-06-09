@extends('layouts.panel.master')
@section('title') Soal Tryout @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
<link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">

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
                                    <div class="num">{{ $soal->tryout_nomor}}</div>
                                    No. {{ $soal->tryout_nomor}}
                                </a>
                            </li>
                            @endforeach

                        </ul>

                        <div class="tab-content">
                            @foreach($tryout_materi->soal as $key => $soal)
                            <div id="step-{{ $key }}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{ $key }}">
                                @if($tryout_materi->jenis_soal == 'PDF')
                                <a class="image-popup w-50" href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                    <img class="gallery-img img-fluid mx-auto w-50" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                                </a>
                                @else
                                <textarea name="soal[{{$soal->tryout_soal_id}}]" id="editor-{{ $key}}" class="form-control"></textarea>

                                @endif
                                <div class="overflow-auto">
                                    <h4 class="card-title mb-0 flex-grow-1">Jawaban Soal No. {{ $soal->tryout_nomor}}</h4>
                                    <table class="table table-nowrap">
                                        <th>
                                            <tr>
                                                <th class="col-1">Kunci Jawaban</th>
                                                <th class="col-1">Abjad</th>
                                                <th>Isi Jawaban</th>
                                            </tr>
                                        </th>
                                        <tbody>
                                            <tr>
                                                <td><input class="form-check-input" type="radio" name="opsi_jawaban[{{$soal->tryout_soal_id}}]" value="A" id=""></td>
                                                <td>A.</td>
                                                <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][A]"></td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-check-input" type="radio" name="opsi_jawaban[{{$soal->tryout_soal_id}}]" value="B" id=""></td>
                                                <td>B.</td>
                                                <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][B]"></td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-check-input" type="radio" name="opsi_jawaban[{{$soal->tryout_soal_id}}]" value="C" id=""></td>
                                                <td>C.</td>
                                                <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][C]"></td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-check-input" type="radio" name="opsi_jawaban[{{$soal->tryout_soal_id}}]" value="D" id=""></td>
                                                <td>D.</td>
                                                <td><input type="text" class="form-control" name="jawaban[{{$soal->tryout_soal_id}}][D]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
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

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>


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
        ClassicEditor
            .create(document.querySelector('#editor-<?= $key?>'), {
                ckfinder: {
                    uploadUrl: '<?= route('ajax.upload-img-soal', ['_token' => csrf_token()]) ?>'
                }
            })
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    <?php } ?>
</script>
@endsection