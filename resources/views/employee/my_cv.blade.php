@extends('layouts.master')
@section('main-content')
    <div class="main-content">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9 cv-list-container">
                    <div class="cv-list-title">
                        <h1>{{ __('messages.choose-cv') }}</h1>
                    </div>
                    <div class="cv-list">
                        <a href="{{ route('edit.cv', ['template' => 'cv_template1']) }}"><img class="cv-img"
                                src="{{ asset('bower_components/job_light/images/cv1.png') }}"></a>
                        <a href="{{ route('edit.cv', ['template' => 'cv_template2']) }}"><img class="cv-img"
                                src="{{ asset('bower_components/job_light/images/cv2.png') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
