@extends('layouts.master-without-nav')
@section('title')
@lang('translation.coming-soon')
@endsection
@section('content')

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 pt-4 mb-4">
                        <div class="mb-sm-5 pb-sm-4 pb-5">
                            <img src="{{ URL::asset('assets/images/comingsoon.png') }}" alt="" height="120" class="move-animation">
                        </div>
                        <div class="mb-5">
                            <h1 class="display-2 coming-soon-text">Pendaftaran Tryout Berhasil</h1>
                        </div>
                        <div>

                            <div class="mt-5">
                                <p class="text-muted">Periksa email untuk melihat detail pendafataran anda</p>
                            </div>

                            <div class=" text-center">

                                <a href="/" class="btn btn-primary" type="button" id="button-email">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->

    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/coming-soon.init.js') }}"></script>
@endsection