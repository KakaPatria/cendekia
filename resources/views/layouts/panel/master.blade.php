<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')| LBB CENDEKIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.panel.topbar')
        @include('layouts.panel.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')

    <!-- SweetAlert2 for confirmations -->
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // Global confirmation for all form submits and critical links in panel
        $(document).ready(function() {
            // For forms
            $('form').on('submit', function(e) {
                var form = this;
                var action = $(form).attr('action') || '';
                var method = $(form).attr('method') || 'POST';

                // Skip confirmation for GET forms or specific actions if needed
                if (method.toUpperCase() === 'GET') {
                    return true;
                }

                // Check if form has data-no-confirm attribute
                if ($(form).attr('data-no-confirm')) {
                    return true;
                }

                e.preventDefault();

                var title = "Konfirmasi Tindakan";
                var text = "Apakah Anda yakin ingin melanjutkan tindakan ini?";

                // Customize message based on action
                if (action.includes('delete') || action.includes('destroy')) {
                    title = "Konfirmasi Hapus";
                    text = "Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.";
                } else if (action.includes('approve') || action.includes('confirm') || action.includes('update')) {
                    title = "Konfirmasi";
                    text = "Apakah Anda yakin ingin menyimpan perubahan ini?";
                }

                Swal.fire({
                    title: title,
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    confirmButtonText: "Ya, Lanjutkan!",
                    buttonsStyling: false,
                    showCloseButton: true,
                    backdrop: true,
                    allowOutsideClick: false
                }).then(function(result) {
                    if (result.value) {
                        form.submit();
                    }
                });
            });

            // For critical links (delete, reset, etc.)
            $('a').on('click', function(e) {
                var link = this;
                var href = $(link).attr('href') || '';

                // Skip if no href or has data-no-confirm
                if (!href || $(link).attr('data-no-confirm')) {
                    return true;
                }

                // Check for critical actions
                if (href.includes('delete') || href.includes('destroy') || href.includes('reset') || $(link).hasClass('btn-danger')) {
                    e.preventDefault();

                    var title = "Konfirmasi Tindakan";
                    var text = "Apakah Anda yakin ingin melanjutkan tindakan ini?";

                    if (href.includes('delete') || href.includes('destroy')) {
                        title = "Konfirmasi Hapus";
                        text = "Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.";
                    } else if (href.includes('reset')) {
                        title = "Konfirmasi Reset";
                        text = "Apakah Anda yakin ingin mereset semua filter?";
                    }

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Batal",
                        confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                        cancelButtonClass: 'btn btn-danger w-xs mt-2',
                        confirmButtonText: "Ya, Lanjutkan!",
                        buttonsStyling: false,
                        showCloseButton: true,
                        backdrop: true,
                        allowOutsideClick: false
                    }).then(function(result) {
                        if (result.value) {
                            window.location.href = href;
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
