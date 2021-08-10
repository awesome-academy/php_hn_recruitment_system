<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Job Pro" />
    <meta name="keywords" content="Job Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/font-awesome.cs') }}s" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/job_light/css/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/style_II.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/css/responsive2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/intro.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/job_light/admin/assets/vendor/summernote/dist/summernote-bs4.css') }}" />
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('bower_components/job_light/images/header/favicon.ico') }}" />
</head>

<body>
    <!-- preloader -->
    <div id="preloader">
        <div id="status"><img src="{{ asset('bower_components/job_light/images/header/loadinganimation.gif') }}"
                id="preloader_image" alt="loader">
        </div>
    </div>

    @include('layouts.header')

    @yield('main-content')

    @include('layouts.footer')

    <script src="{{ asset('bower_components/job_light/js/jquery_min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/jquery.menu-aim.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/modernizr.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/custom_II.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/js/bootstrap3-typeahead.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script
        src="{{ asset('bower_components/job_light/admin/assets/vendor/selectize/dist/js/standalone/selectize.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/summernote/dist/summernote-bs4.min.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/job_light/admin/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}">
    </script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/forms/form-elements.js') }}"></script>
    <script src="{{ asset('js/create_summernote.js') }}"></script>
</body>

</html>
