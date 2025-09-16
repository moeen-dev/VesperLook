<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Admin Dashboard </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/backend/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/dropify/css/dropify.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/modules/codemirror/theme/duotone-dark.css') }}">
    <!-- DataTables CSS (Bootstrap 4) -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

    <link rel="shortcut icon" href="{{ url('assets/backend/assets/img/vesper_look.jpg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">

        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('backend.partials.nav')
            @include('backend.partials.side')

            <!-- Main Content -->

            @yield('content')


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2025 | Vesper Look <div class="bullet"></div>
                    Developed By-
                    <a target="_blank" href="https://www.facebook.com/mdmoeenuddinn">Moeen Uddin</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/backend/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('assets/backend/assets/js/page/index-0.js') }}"></script> --}}
    <script src="{{ asset('assets/backend/assets/js/page/features-setting-detail.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/backend/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/js/alert.js') }}"></script>

    <script src="{{ asset('assets/backend/assets/modules/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/js/page/modules-toastr.js') }}"></script>

    <script src="{{ asset('assets/backend/assets/modules/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('assets/backend/assets/modules/codemirror/mode/javascript/javascript.js') }}"></script>

    <!-- DataTables JS (Bootstrap 4) -->
    <script src="{{ asset('assets/backend/assets/modules/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>


    <!-- custom js -->
    <script>
        // Dropify Image
        $('.form-image').dropify();

        // Alert Notification
        window.flashMessages = {
            success: @json(session('success')),
            error: @json(session('error')),
            info: @json(session('info')),
            warning: @json(session('warning')),
        };

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50, 100],
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "info": true
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
