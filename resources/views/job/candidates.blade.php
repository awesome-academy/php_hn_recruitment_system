@extends('layouts.master')

@section('main-content')
    <main class="candidates-container">
        <h3 class="job-title">{{ $job->title }}</h3>
        <ul class="candidates-list">
            @foreach ($candidates as $candidate)
                <li class="candidate-item">
                    <div class="avatar">
                        <img
                            src="{{ asset("images/{$candidate->avatar}") }}"
                            onerror="this.src = '{{ asset('bower_components/job_light/images/avatar.png') }}'"
                        >
                    </div>
                    <div class="candidate-info">
                        <div class="name">
                            {{ $candidate->name }}
                        </div>
                        <div class="address">
                            <i class="mdi mdi-map-marker"></i>
                            {{ $candidate->address }}
                        </div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('employee-profiles.show', ['employee_profile' => $candidate]) }}">
                            <button class="btn btn-success view-cv">
                                {{ __('messages.view-profile') }}
                            </button>
                        </a>
                        <button
                            id="view-cv"
                            class="btn btn-info"
                            value="{{ asset("images/{$candidate->application->cv}") }}"
                        >
                            {{ __('messages.view-cv') }}
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="cv-container hidden">
            <div class="cv-overlay"></div>
            <embed class="cv-viewer" type="application/pdf" >
        </div>
    </main>
@endsection

@section('addtional_scripts')
    <script src="{{ asset('js/candidates.js') }}"></script>
@endsection
