@extends('layouts.cv')
@section('main-content')
    <div id="editor" class="tab-show">
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet"
                href="{{ asset('bower_components/job_light/my-cv/cv-template/style_CV_template_2.css') }}">
        </head>

        <body>
            <div class="resume">
                <div class="resume_left">
                    <div class="resume_profile">
                        <img src="{{ $profile->avatar ? asset('images/' . $profile->avatar) :
                            asset('bower_components/job_light/images/avatar.png') }}">
                    </div>
                    <div class="resume_content">
                        <div class="resume_item resume_info">
                            <div class="title">
                                <p class="bold">{{ $profile->name }}</p>
                                <p class="regular">{{ $profile->industry }}</p>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('bower_components/job_light/images/maps-and-flags.png') }}">
                                    </div>
                                    <div class="data">
                                        {{ $profile->address }}
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('bower_components/job_light/images/phone-call.png') }}">
                                    </div>
                                    <div class="data">
                                        {{ $profile->phone_number }}
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('bower_components/job_light/images/email.png') }}" alt="">
                                    </div>
                                    <div class="data">
                                        {{ $user->email }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="resume_item resume_skills">
                            <div class="title">
                                <p class="bold">{{ __('messages.skill') }}</p>
                            </div>
                            <ul>
                                <li>
                                    <div class="skill_name">
                                        {{ $profile->skills }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="resume_item resume_social">
                            <div class="title">
                                <p class="bold">Social</p>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('bower_components/job_light/images/facebook.png') }}" alt="">
                                    </div>
                                    <div class="data">
                                        <p class="semi-bold">Facebook</p>
                                        <p></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('bower_components/job_light/images/linkedin.png') }}" alt="">
                                    </div>
                                    <div class="data">
                                        <p class="semi-bold">Linkedin</p>
                                        <p></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="resume_right">
                    <div class="resume_item resume_about">
                        <div class="title">
                            <p class="bold">About me</p>
                        </div>
                        <p>{{ $profile->description }}</p>
                    </div>
                    <div class="resume_item resume_work">
                        <div class="title">
                            <p class="bold">{{ __('messages.experience') }}</p>
                        </div>
                        <ul>
                            @if (!empty($experienceList))
                                @foreach ($experienceList as $experience)
                                    <li>
                                        <div class="date">{{ $experience->start_date }} -
                                            {{ $experience->end_date ? $experience->end_date : __('messages.present') }}
                                        </div>
                                        <div class="info">
                                            <p class="">{{ $experience->position }}.</p>
                                            <p>{{ $experience->company }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="resume_item resume_education">
                        <div class="title">
                            <p class="bold">{{ __('messages.education') }}</p>
                        </div>
                        <ul>
                            @if (!empty($educationList))
                                @foreach ($educationList as $education)
                                    <li>
                                        <div class="date">{{ $education->start_date }} -
                                            {{ $education->end_date ? $education->end_date : __('messages.present') }}
                                        </div>
                                        <div class="info">
                                            <p>{{ $education->school }}</p>
                                            <p>{{ $education->field_of_study }} - {{ $education->degree }} -
                                                {{ $education->grade }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="resume_item resume_education">
                        <div class="title">
                            <p class="bold">{{ __('messages.certification') }}</p>
                        </div>
                        <ul>
                            <li>
                                <div class="info">
                                    <p class="semi-bold">{{ $profile->certifications }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </body>

        </html>
    </div>
@endsection
