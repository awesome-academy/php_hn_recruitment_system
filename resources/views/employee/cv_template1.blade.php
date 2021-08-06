@extends('layouts.cv')
@section('main-content')
    <div id="editor" class="tab-show">
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Job Pro</title>
            <link rel="stylesheet"
                href="{{ asset('bower_components/job_light/my-cv/cv-template/style_CV_template_1.css') }}">
            <link href="{{ asset('bower_components/job_light/admin/assets/css/themify-icons.css') }}" rel="stylesheet">
        </head>

        <body>
            <div class="wrapper">
                <div class="resume">
                    <div class="left">
                        <div class="img_holder">
                            <img
                                src="{{ $profile->avatar ? asset('images/' . $profile->avatar) :
                                    asset('bower_components/job_light/images/avatar.png') }}">
                        </div>
                        <div class="contact_wrap pb">
                            <div class="title">
                                {{ __('messages.contact') }}
                            </div>
                            <div class="contact">
                                <ul>
                                    <li>
                                        <div class="li_wrap">
                                            <div class="icon"><i class="ti-mobile" aria-hidden="true"></i></div>
                                            <div class="text">{{ $profile->phone_number }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="li_wrap">
                                            <div class="icon"><i class="ti-email" aria-hidden="true"></i></div>
                                            <div class="text">{{ $user->email }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="li_wrap">
                                            <div class="icon"><i class="ti-location-pin" aria-hidden="true"></i></div>
                                            <div class="text">{{ $profile->address }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="skills_wrap pb">
                            <div class="title">
                                {{ __('messages.skill') }}
                            </div>
                            <div class="contact">
                                <ul>
                                    <li>
                                        <div class="li_wrap">
                                            <div class="text">{{ $profile->skills }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="skills_wrap pb">
                            <div class="title">
                                {{ __('messages.certification') }}
                            </div>
                            <div class="contact">
                                <ul>
                                    <li>
                                        <div class="li_wrap">
                                            <div class="text">{{ $profile->certifications }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="header">
                            <div class="name_role">
                                <div class="name">
                                    {{ $profile->name }}
                                </div>
                                <div class="role">
                                    {{ $profile->industry }}
                                </div>
                            </div>
                            <div class="about">
                                {{ $profile->description }}
                            </div>
                        </div>
                        <div class="right_inner">
                            <div class="exp">
                                <div class="title">
                                    {{ __('messages.experience') }}
                                </div>
                                <div class="exp_wrap">
                                    <ul>
                                        @if (!empty($experienceList))
                                            @foreach ($experienceList as $experience)
                                                <li>
                                                    <div class="li_wrap">
                                                        <div class="date">
                                                            {{ $experience->start_date }} -
                                                            {{ $experience->end_date ? $experience->end_date : __('messages.present') }}
                                                        </div>
                                                        <div class="info">
                                                            <p class="info_title">
                                                                {{ $experience->position }}
                                                            </p>
                                                            <p class="info_cont">
                                                                {{ $experience->company }}
                                                            </p>
                                                            <p class="info_com">
                                                                {{ $experience->employment_type }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="education">
                                <div class="title">
                                    {{ __('messages.education') }}
                                </div>
                                <div class="education_wrap">
                                    <ul>
                                        @if (!empty($educationList))
                                            @foreach ($educationList as $education)
                                                <li>
                                                    <div class="li_wrap">
                                                        <div class="date">
                                                            {{ $education->start_date }} -
                                                            {{ $education->end_date ? $education->end_date : __('messages.present') }}
                                                        </div>
                                                        <div class="info">
                                                            <p class="info_title">
                                                                {{ $education->field_of_study }}
                                                            </p>
                                                            <p class="info_cont">
                                                                {{ $education->school }}
                                                            </p>
                                                            <p class="info_com">
                                                                {{ $education->degree }} - {{ $education->grade }}
                                                            </p>
                                                        </div>
                                                    </div>
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
        </body>

        </html>
    </div>
@endsection
