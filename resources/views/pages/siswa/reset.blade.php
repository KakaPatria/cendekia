@extends('layouts.master-without-nav')
@section('title')
Reset Password
@endsection
@section('content')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay" style="background-color : #fff7cc;"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay" style="background: linear-gradient(90deg,#e2b602,#f5e38f);opacity: .9;"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="index.html" class="d-block">
                                                <img src="{{ asset('assets/images/logo-cendikia.png')}}" alt="" height="50">
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Atur Ulang Password</h5>
                                    </div>

                                    @include('components.message')

                                    <div class="mt-4">
                                        <form action="{{ route('siswa.do.password.reset')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <input type="hidden" name="email" value="{{ $email }}">
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="mb-3">

                                                <label class="form-label" for="password-input">Ulangi Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password_confirmation">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-danger w-100" type="submit">Simpan</button>
                                            </div>



                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="mb-0"><a href="{{ route('login')}}" class="fw-semibold text-primary text-decoration-underline"> Kembali</a> </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> LBB CENDEKIA
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#asal_sekolah').select2({
            placeholder: "Cari Asal Sekolah",
            allowClear: true,
            tags: true,
            minimumInputLength: 1,
            ajax: {
                url: '<?= route('ajax.cari-sekolah') ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },

        });

        const classes = {
            SD: ['1', '2', '3', '4', '5', '6'],
            SMP: ['7', '8', '9'],
            SMA: ['10', '11', '12']
        };

        $('#jenjang').change(function() {
            var schoolLevel = $(this).val();
            var $classLevel = $('#kelas');
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
    });
</script>
@endsection