<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
    <link href="{{ asset('bower_components/job_light/admin/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/materialdesignicons.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <div class="container">
                <div class="row full-height align-items-center">
                    <div class="col-12">
                        <div class="text-center p-t-50">
                            <h1 class="font-size-100 text-secondary font-weight-light text-opacity ls-2">
                                {{ __('messages.inactivated-account') }}</h1>
                            <h2 class="font-weight-light font-size-30">{{ __('messages.wait-activated') }}</h2>
                            <a
                                class="btn btn-gradient-success btn-lg m-t-30 logout-btn text-light">
                                {{ __('messages.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
