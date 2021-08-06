<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Pro</title>
    <link rel="stylesheet" href="//unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/job_light/my-cv/resources/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('bower_components/job_light/my-cv/resources/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/my-cv/resources/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/my-cv/resources/grapes.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/my-cv/resources/grapesjs-preset-newsletter.min.js') }}"></script>
    <script src="{{ asset('bower_components/job_light/my-cv/resources/html2pdf.bundle.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style_cv.css') }}" />
</head>

<body>
    <div id="navbar" class="sidenav d-flex flex-column overflow-scroll">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <a href=""><img class="logo"
                        src="{{ asset('bower_components/job_light/images/header/logo2.png') }}"></a>
            </div>
        </nav>
        <div class="my-2 d-flex flex- btn-download">
            <button type="button" id="download-cv" class="btn btn-outline-secondary btn-sm mb-2 mx-2">
                <i class="ti-download"></i>{{ __('messages.cv-download') }}
            </button>
        </div>
        <div class="">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#block"
                        type="button" role="tab" aria-controls="block" aria-selected="true">
                        <i class="ti-layout-grid3"></i>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="style-tab" data-bs-toggle="tab" data-bs-target="#style" type="button"
                        role="tab" aria-controls="style" aria-selected="false">
                        <i class="ti-brush"></i>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="layer-tab" data-bs-toggle="tab" data-bs-target="#layer" type="button"
                        role="tab" aria-controls="layer" aria-selected="false">
                        <i class="ti-list"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="block" role="tabpanel" aria-labelledby="block-tab">
                    <div id="blocks"></div>
                </div>
                <div class="tab-pane fade" id="style" role="tabpanel" aria-labelledby="style-tab">
                    <div id="styles-container"></div>
                </div>
                <div class="tab-pane fade" id="layer" role="tabpanel" aria-labelledby="layer-tab">
                    <div id="layers-container"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <div class="panel__devices"></div>
                <div class="panel__basic-actions"></div>
            </div>
        </nav>

        @yield('main-content')

    </div>
    <script type="text/javascript" src="{{ asset('js/my_cv.js') }}"></script>
</body>

</html>
