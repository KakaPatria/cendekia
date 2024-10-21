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
                <form action="{{route('panel.tryout_jawaban.update',$soal->tryout_soal_id)}}" method="post" id="form-soal" enctype="multipart/form-data">
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
                        <textarea name="soal" id="editor_soal" class="form-control">{{ $soal->tryout_soal}}</textarea>

                        @endif
                        <div class="form-group row pt-2">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Point Nilai</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="" name="point" value="{{ $soal->point}}">

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
<script src="https://cdn.tiny.cloud/1/nbw604ybayer8g6kfspfwkndpm3tz6lngp2nkdwwzctcc70x/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>



<script>
    $('#nav-tryout').addClass('active')

    tinymce.init({
        selector: '#editor_soal',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });

    $('#form-soal').on('submit', function(e) {
        var myContent = tinymce.get("editor_soal").getContent();
        $('#editor_soal').html(myContent)

    })
</script>
@endsection