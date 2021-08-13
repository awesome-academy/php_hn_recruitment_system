<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job Pro</title>
    <link rel="apple-touch-icon"
        href="{{ asset('bower_components/job_light/admin/assets/images/logo/apple-touch-icon.html') }}">
    <link rel="shortcut icon" href="{{ asset('bower_components/job_light/admin/assets/images/logo/favicon.png') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/bootstrap/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/PACE/themes/blue/pace-theme-minimal.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}" />
    <link href="{{ asset('bower_components/job_light/admin/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/materialdesignicons.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="app header-default side-nav-dark">
        <div class="layout">
            @include('layouts.employee_header')
            @include('layouts.employee_nav')
            @yield('main-content')
        </div>
    </div>

    <script src="{{ asset('bower_components/job_light/admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/datatables/media/js/jquery.dataTables.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/job_light/admin/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/tables/data-table.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
