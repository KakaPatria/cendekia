@yield('css')
<!-- Layout config Js -->
<script src="{{ URL::asset('assets/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('assets/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .auth-one-bg .bg-overlay-new {
        background: linear-gradient(90deg, #e2b602, #e2b602);
        opacity: .9;
    }
</style>
{{-- @yield('css') --}}
<!-- SweetAlert2 CSS -->
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* Ensure SweetAlert2 appears on top */
    .swal2-container {
        z-index: 9999 !important;
    }
</style>
