<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JobPro</title>
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
        href="{{ asset('bower_components/job_light/admin/assets/vendor/selectize/dist/css/selectize.default.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/summernote/dist/summernote-bs4.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" />
    <link href="{{ asset('bower_components/job_light/admin/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="app header-default side-nav-dark">
        <div class="layout">
            @include('layouts.user_header')
            @yield('main-content')
        </div>
    </div>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/dashboard/analytical.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/moment/min/moment.min.js') }}"></script>
    <script
        src="{{ asset('bower_components/job_light/admin/assets/vendor/selectize/dist/js/standalone/selectize.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/summernote/dist/summernote-bs4.min.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/job_light/admin/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}">
    </script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/forms/form-elements.js') }}"></script>
</body>

</html>
