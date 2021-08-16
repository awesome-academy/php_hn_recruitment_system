<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Job Pro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="CreativeLayers">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/job_light/jobhunt/css/bootstrap-grid.css') }}" />
    <link rel="stylesheet" href="{{ asset('bower_components/job_light/jobhunt/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/job_light/jobhunt/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/jobhunt/css/style.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/job_light/jobhunt/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/job_light/jobhunt/css/chosen.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/job_light/jobhunt/css/colors/colors.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/job_light/jobhunt/css/bootstrap.css') }}" />
    <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/intro.css') }}" rel="stylesheet">
</head>

<body>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header">
            <div class="responsive-menubar">
                <div class="res-logo">
                    <a href="{{ route('home') }}" title="">
                        <img src="{{ asset('bower_components/job_light/images/header/logo2.png') }}">
                    </a>
                </div>
            </div>
        </div>

        <section class="overlape">
            <div class="block no-padding">
                <img class="cover-photo-box"
                    src="{{ $profile->cover_photo ? asset('images/' . $profile->cover_photo) : asset('bower_components/job_light/images/cover.png') }}">
                @if (Auth::user() !== null && Auth::user()->id == $profile->user->id)
                    <a class="signin-popup upload-cover-photo" title=""><i class="ti-camera"></i></a>
                @endif
            </div>
        </section>

        <section class="overlape">
            <div class="block remove-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cand-single-user">
                                <div class="share-bar circle">
                                </div>
                                <div class="can-detail-s">
                                    <div class="cst">
                                        <img
                                            src="{{ $profile->avatar ? asset('images/' . $profile->avatar) : asset('bower_components/job_light/images/avatar.png') }}">
                                    </div>
                                    <h3>{{ $profile->name }}</h3>
                                    <span><i>{{ $profile->industry }}</i></span>
                                    <p>{{ $profile->user->email }}</p>
                                    <p>{{ $profile->phone_number }}</p>
                                    <p><i class="la la-map-marker"></i>{{ $profile->address }}</p>
                                </div>
                                <div class="share-bar circle">
                                </div>
                            </div>
                            <ul class="cand-extralink">
                                <li><a href="#about" title="">{{ __('messages.about') }}</a></li>
                                <li><a href="#education" title="">{{ __('messages.education') }}</a></li>
                                <li><a href="#experience" title="">{{ __('messages.experience') }}</a></li>
                                <li><a href="#skills" title="">{{ __('messages.skill') }}</a></li>
                                <li><a href="#awards" title="">{{ __('messages.certification') }}</a></li>
                            </ul>
                            <div class="cand-details-sec">
                                <div class="row">
                                    <div class="col-lg-8 column">
                                        <div class="cand-details">
                                            <div class="edu-history-sec" id="about">
                                                <h2>{{ __('messages.about') }}</h2>
                                                <p>{{ $profile->description }}</p>
                                            </div>
                                            <div class="edu-history-sec" id="education">
                                                <h2>{{ __('messages.education') }}</h2>
                                                @if (!empty($educationList))
                                                    @foreach ($educationList as $education)
                                                        <div class="edu-history">
                                                            <i class="la la-graduation-cap"></i>
                                                            <div class="edu-hisinfo">
                                                                <h3>{{ $education->school }}</h3>
                                                                <i>{{ $education->start_date }} -
                                                                    {{ $education->end_date ? $education->end_date : __('messages.present') }}</i>
                                                                <span>{{ $education->field_of_study }}<i>{{ $education->degree }}</i></span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="edu-history-sec" id="experience">
                                                <h2>{{ __('messages.experience') }}</h2>
                                                @if (!empty($experienceList))
                                                    @foreach ($experienceList as $experience)
                                                        <div class="edu-history">
                                                            <i class="ti-bag"></i>
                                                            <div class="edu-hisinfo">
                                                                <h3><span>{{ $experience->company }}</span></h3>
                                                                <i>{{ $education->start_date }} -
                                                                    {{ $education->end_date ? $education->end_date : __('messages.present') }}</i>
                                                                <p>{{ $experience->position }} -
                                                                    {{ $experience->employment_type }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="progress-sec" id="skills">
                                                <h2>{{ __('messages.skill') }}</h2>
                                                <div class="edu-history style2">
                                                    <i></i>
                                                    <div class="edu-hisinfo">
                                                        <h3>{{ $profile->skills }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edu-history-sec" id="awards">
                                                <h2>{{ __('messages.certification') }}</h2>
                                                <div class="edu-history style2">
                                                    <i></i>
                                                    <div class="edu-hisinfo">
                                                        <h3>{{ $profile->certifications }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 column">
                                        <div class="job-overview">
                                            <h3>{{ __('messages.people-may-know') }}</h3>
                                            <ul>
                                                @if (!empty($userList))
                                                    @foreach ($userList as $user)
                                                        <li>
                                                            <a
                                                                href="{{ route('employee-profiles.show', ['employee_profile' => $user->employeeProfile->id]) }}">
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <img class="user-pic"
                                                                            src="{{ $user->employeeProfile->avatar ? asset('images/' . $user->employeeProfile->avatar) : asset('bower_components/job_light/images/avatar.png') }}">
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <h3>{{ $user->employeeProfile->name }}</h3>
                                                                        <span>{{ $user->employeeProfile->industry }}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Cover photo modal --}}
        <div class="account-popup-area signin-popup-box">
            <div class="account-popup">
                <span class="close-popup"><i class="la la-close"></i></span>
                <div class="container">
                    <div class="wrapper">
                        <div class="image">
                            <img src="{{ asset('images/' . $profile->cover_photo) }}" class="avt-upload-image">
                        </div>
                        <div class="content">
                            <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text">
                                {{ __('messages.no-file') }}
                            </div>
                        </div>
                        <div id="cancel-btn">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="file-name">
                            {{ __('messages.filename-here') }}
                        </div>
                    </div>
                    <button id="custom-btn">{{ __('messages.choose-file') }}</button>
                    <form method="post" enctype="multipart/form-data"
                        action="{{ route('change-image', ['image' => 'cover_photo', 'id' => $profile->id]) }}">
                        @csrf
                        <input id="default-btn" name="avatar" type="file" hidden>
                        <div class="">
                            <button type="submit" class="btn btn-save">{{ __('messages.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/modernizr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/wow.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/parallax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/select-chosen.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/job_light/jobhunt/js/jquery.scrollbar.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('js/upload.js') }}"></script>
</body>

</html>
