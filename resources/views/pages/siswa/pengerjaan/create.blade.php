@extends('layouts.siswa.master-pengerjaan')
@section('title')
Tryout
@endsection
@section('css')
<link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">

@endsection
@section('content')
<div class="align-items-center d-flex mb-2">
    <div class="flex-grow-1">

        <div class="text-center">
            <h3 class="">{{$tryout_materi->tryoutMaster->tryout_judul}}</h2>
                <h3 class="mb-2"> <small class="text-muted">{{$tryout_materi->refMateri->ref_materi_judul}}</small></h2>

                    {{-- <p>Anda akan dialihkan dalam <span id="timer"></span>.</p> --}}
        </div>
    </div>
    <div class="flex-shrink-0">
        {{--<div>
            <a href="javascript:;" id="back-btn" class="btn btn-success btn-sm"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Keluar</a>
        </div>--}}
    </div>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div id="smartwizard">
                    <ul class="nav d-none">
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

                            <div class="align-items-center d-flex mb-2">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2  d-block"> Soal Nomor {{ $soal->tryout_nomor}}</h4>
                                </div>
                                <div class="flex-shrink-0">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    @if($tryout_materi->jenis_soal == 'PDF')
                                    <div class="overflow-auto">
                                        <div class="d-flex mb-2 text-center border border-dark" style="height: 300px;">
                                            <a class="image-popup " href="{{ Storage::url($soal->tryout_soal) }}" title="">
                                                <img class="gallery-img img-fluid mx-auto  border border-dark" src="{{ Storage::url($soal->tryout_soal) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="overflow-auto h-5 border border-dark p-3" style="height: 300px;">
                                        {!! $soal->tryout_soal !!}
                                    </div>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="w-100">
                                            <div class="list-group">
                                                <form action="{{ route('siswa.tryout.pengerjaan.jawab',$tryout_nilai->tryout_nilai_id) }}" id="form-{{ $key}}">
                                                    @csrf
                                                    <input type="hidden" name="tryout_materi_id" value="{{$tryout_materi->tryout_materi_id}}">
                                                    <input type="hidden" name="soal_nomor" value="{{$soal->tryout_nomor}}">
                                                    <input type="hidden" name="tryout_soal_id" value="{{$soal->tryout_soal_id}}">
                                                    @if($soal->tryout_soal_type == 'SC')

                                                    @foreach($soal->jawaban as $jawaban)
                                                    <label class="list-group-item">
                                                        <input class="form-check-input me-1" id="jawaban-{{ $soal->tryout_soal_id}}-{{ $jawaban->tryout_jawaban_prefix}}" name="jawaban" type="radio" value="{{$jawaban->tryout_jawaban_prefix}}" required>
                                                        {{ $jawaban->tryout_jawaban_prefix}}. {{ $jawaban->tryout_jawaban_isi}}
                                                        <div class="invalid-feedback">Pilih salah satu jawaban</div>
                                                    </label>
                                                    @endforeach
                                                    @endif

                                                    @if($soal->tryout_soal_type == 'MCMA')
                                                    @foreach($soal->jawaban as $jawaban)
                                                    <label class="list-group-item">
                                                        <input class="form-check-input me-1"
                                                            id="jawaban-{{ $soal->tryout_soal_id }}-{{ $jawaban->tryout_jawaban_prefix }}"
                                                            name="jawaban[]"
                                                            type="checkbox"
                                                            value="{{ $jawaban->tryout_jawaban_prefix }}">
                                                        {{ $jawaban->tryout_jawaban_prefix }}. {{ $jawaban->tryout_jawaban_isi }}
                                                    </label>
                                                    @endforeach
                                                    @endif

                                                    @if($soal->tryout_soal_type == 'TF')
                                                    @php
                                                    $prefixTf = explode(',', $soal->notes);
                                                    $notes = explode(',', ('Benar,Salah'));
                                                    @endphp
                                                    <table class="table table-bordered align-middle text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Opsi</th>
                                                                <th>Jawaban</th>
                                                                @foreach ($prefixTf as $prefix)
                                                                <th>{{ $prefix }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($soal->jawaban as $jawaban)
                                                            <tr>
                                                                <td>{{ $jawaban->tryout_jawaban_prefix }}</td>
                                                                <td class="text-start">{{ $jawaban->tryout_jawaban_isi }}</td>
                                                                @foreach ($notes as $n)
                                                                <td>
                                                                    <input id="jawaban-{{ $soal->tryout_soal_id }}-{{ $jawaban->tryout_jawaban_prefix }}-{{$n}}"
                                                                        type="radio"
                                                                        name="jawaban[{{ $jawaban->tryout_jawaban_prefix }}]"
                                                                        value="{{ $n }}"
                                                                        required>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-center">
                                @if($loop->last)
                                <button type="button" class="btn rounded-pill btn-warning back-btn">Kembali</button>
                                <button type="button" class="btn rounded-pill btn-primary " id="selesai-btn">Selesai</button>
                                @else
                                <button type="button" class="btn rounded-pill btn-warning back-btn">Kembali</button>
                                <button type="button" class="btn rounded-pill btn-success next-btn">Selanjutnya</button>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Include optional progressbar HTML -->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    <h4> <span class="badge badge-outline-secondary">Sisa Waktu : <span id="countdown" class="countdown-time ms-1">00:00:00</span></span></h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-5">
                    @foreach($tryout_materi->soal as $key => $soal)
                    <div class="col mb-2">
                        <a href="javascript:;" data-index="{{ $key}}" class="btn-nomor">
                            <div class="avatar-m  p-1 py-2 h-auto bg-light rounded-3" id="nomor-soal-{{ $key}}">
                                <div class="text-center">
                                    <p class="mb-0 fs-5" data-index="{{ $key}}">{{ $soal->tryout_nomor}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<audio id="alert-sound" src="{{ URL::asset('/assets/alert.mp3') }}" preload="auto" playsinline></audio>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SmartWizard JavaScript -->
<script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>


<script>
    $('#smartwizard').smartWizard({
        theme: 'dots',
        toolbar: {
            showNextButton: false, // show/hide a Next button
            showPreviousButton: false, // show/hide a Previous button
        }
    });

    $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        // Validate only on forward movement  
        if (stepDirection == 'forward') {
            let form = document.getElementById('form-' + (currentStepIdx));
            if (form) {
                var data = $('#form-' + (currentStepIdx)).serialize();
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        const el = $('#nomor-soal-' + currentStepIdx); // misal kembalian ajax ada key soal

                        // hapus semua class bg-* lama
                        el.removeClass(function(i, c) {
                            return (c.match(/\bbg-\S+/g) || []).join(' ');
                        });

                        // tambahkan class sesuai hasil
                        if (response.success) {
                            el.addClass('bg-success');
                        } else {
                            el.addClass('bg-warning');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error: ' + error);
                    }
                });
            }
        }
    });

    <?php foreach ($tryout_materi->soal as $key => $soal) { ?>

        <?php if ($soal->pengerjaan && $soal->tryout_soal_type != 'TF') { ?>
            <?php $jawaban = json_decode($soal->pengerjaan->tryout_jawaban); ?>
            <?php foreach ($jawaban as $key => $valueJawaban) { ?>
                $('#jawaban-{{ $soal->tryout_soal_id}}-{{ $valueJawaban}}').prop('checked', true);
            <?php  } ?>
        <?php  } ?>
        <?php if ($soal->pengerjaan && $soal->tryout_soal_type == 'TF') { ?>
            <?php $jawaban = json_decode($soal->pengerjaan->tryout_jawaban); ?>
            <?php foreach ($jawaban as $key => $valueJawaban) { ?>
                $('#jawaban-{{ $soal->tryout_soal_id}}-{{ $key}}-{{ $valueJawaban}}').prop('checked', true);
            <?php  } ?>
        <?php  } ?>
        <?php if ($soal->pengerjaan) { ?>
            $('#smartwizard').smartWizard("next");
        <?php  } ?>
    <?php  } ?>


    $('.btn-nomor').click(function() {
        var index = $(this).data('index'); 
        $("#smartwizard").smartWizard("goToStep", index);

    })
    $('.back-btn').click(function() {
        $('#smartwizard').smartWizard("prev");
    })

    const audioPlayer = $('#alert-sound')[0];
    $('.next-btn').click(function() {
        audioPlayer.muted = false;
        $('#smartwizard').smartWizard("next");

    })

    $('#selesai-btn').click(function() {
        let form = document.getElementById('form-{{ $tryout_materi->soal->count() - 1 }}');
        var data = $('#form-{{ $tryout_materi->soal->count() - 1 }}').serialize();
        $.ajax({
            url: form.action,
            type: 'POST',
            data: data,
            success: function(response) {

            },
            error: function(xhr, status, error) {
                console.log('AJAX error: ' + error);
            }
        });
        Swal.fire({
            title: "Selesai tryout !",
            text: "Apakah anda yakin sudah menyelesaikannya ?",
            icon: "success",
            showCancelButton: true,
            cancelButtonText: "kembali",
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Ya !",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.replace("{{ route('siswa.tryout.pengerjaan.selesai',[$tryout_nilai->tryout_nilai_id,$tryout_peserta_id] )}}");
            }
        });
    })

    function startCountdown(duration) {
        var timer = duration,
            hours, minutes, seconds;
        var timerInterval = setInterval(function() {
            hours = Math.floor((timer / 3600));
            minutes = Math.floor((timer % 3600) / 60);
            seconds = timer % 60;

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            // 🔹 tampilkan hasilnya di HTML
            $('#countdown').text(hours + ":" + minutes + ":" + seconds);

            if (--timer < 0) {
                clearInterval(timerInterval);
                window.location.replace("{{ route('siswa.tryout.pengerjaan.leave',[$tryout_nilai->tryout_nilai_id,$tryout_peserta_id,'type=1']) }}");
            }
        }, 1000);
    }

    window.onload = function() {
        <?php if ($sisa_waktu) { ?>
            var batasWaktu = parseInt('<?= $sisa_waktu ?>');
            startCountdown(batasWaktu);
        <?php } else { ?>
            document.getElementById('timer').textContent = 'Tidak ada batas waktu.';
        <?php } ?>
    };

    $('#back-btn').click(function() {
        Swal.fire({
            title: "Tinggalkan tryout ??",
            text: "Apakah anda yakin meninggalakn tryout ?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "kembali",
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Ya !",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.replace("{{ route('siswa.tryout.pengerjaan.leave',[$tryout_nilai->tryout_nilai_id,$tryout_peserta_id] )}}");
            }
        });
    })

    $(window).on('popstate', function(event) {
        Swal.fire({
            title: "Tinggalkan tryout ??",
            text: "Apakah anda yakin meninggalakn tryout ?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "kembali",
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Ya !",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.replace("{{ route('siswa.tryout.pengerjaan.leave',[$tryout_nilai->tryout_nilai_id,$tryout_peserta_id] )}}");
            }
        });
    });
    <?php if ($tryout_materi->safe_mode) { ?>
        const audioEl = document.getElementById('alert-sound');
        if (audioEl) {
            audioEl.loop = true;
        }

        let audioUnlocked = false;
        let violationActive = false;

        const unlockAudio = () => {
            if (!audioEl || audioUnlocked) return;

            // "Warm up" audio playback to satisfy autoplay policies.
            const prevMuted = audioEl.muted;
            audioEl.muted = true;
            const p = audioEl.play();
            if (p && typeof p.then === 'function') {
                p.then(() => {
                    audioEl.pause();
                    audioEl.currentTime = 0;
                    audioEl.muted = prevMuted;
                    audioUnlocked = true;
                }).catch(() => {
                    // If blocked, we'll try again on the next interaction.
                    audioEl.muted = prevMuted;
                });
            } else {
                // Older browsers: best effort.
                try {
                    audioEl.pause();
                    audioEl.currentTime = 0;
                    audioEl.muted = prevMuted;
                    audioUnlocked = true;
                } catch (e) {
                    audioEl.muted = prevMuted;
                }
            }
        };

        // Unlock audio as soon as the user interacts on the page.
        document.addEventListener('click', unlockAudio, { once: true, capture: true });
        document.addEventListener('keydown', unlockAudio, { once: true, capture: true });
        document.addEventListener('touchstart', unlockAudio, { once: true, capture: true });

        const showWarning = (message) => {
            // Avoid stacking multiple modals.
            if (!Swal.isVisible()) {
                Swal.fire({
                    title: "Peringatan !!",
                    text: message,
                    icon: "warning",
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    confirmButtonText: "Lanjutkan",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            }
        };

        const startAlarm = () => {
            if (!audioEl) return;
            try {
                audioEl.currentTime = 0;
                const p = audioEl.play();
                if (p && typeof p.catch === 'function') {
                    p.catch(() => {
                        // If play is blocked, it will work after user interaction.
                    });
                }
            } catch (e) {
                // ignore
            }
        };

        const stopAlarm = () => {
            if (!audioEl) return;
            try {
                audioEl.pause();
                audioEl.currentTime = 0;
            } catch (e) {
                // ignore
            }
        };

        const isSplitScreen = () => {
            // Heuristic: window is significantly smaller than available screen.
            // Works well for Windows split-screen; also catches non-fullscreen.
            const availW = window.screen?.availWidth || window.screen?.width || 0;
            const availH = window.screen?.availHeight || window.screen?.height || 0;
            if (!availW || !availH) return false;

            const w = window.outerWidth || window.innerWidth;
            const h = window.outerHeight || window.innerHeight;

            const widthRatio = w / availW;
            const heightRatio = h / availH;

            return widthRatio < 0.85 || heightRatio < 0.85;
        };

        const triggerViolation = (message) => {
            if (violationActive) return;
            violationActive = true;
            showWarning(message);
            startAlarm();
        };

        const clearViolation = () => {
            violationActive = false;
            stopAlarm();
        };

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                triggerViolation('Jangan meninggalkan halaman tryout');
            } else if (!isSplitScreen() && document.hasFocus()) {
                clearViolation();
            }
        });

        window.addEventListener('blur', () => {
            triggerViolation('Jangan berpindah aplikasi saat mengerjakan tryout');
        });

        window.addEventListener('focus', () => {
            if (!document.hidden && !isSplitScreen()) {
                clearViolation();
            }
        });

        const checkSplit = () => {
            if (isSplitScreen()) {
                triggerViolation('Jangan menggunakan split screen saat mengerjakan tryout');
            } else if (!document.hidden && document.hasFocus()) {
                clearViolation();
            }
        };

        window.addEventListener('resize', checkSplit);
        window.addEventListener('orientationchange', checkSplit);
        setInterval(checkSplit, 1000);
        checkSplit();
    <?php } ?>
</script>
@endsection