@extends('layouts.master')

@section('main-content')
    <main class="jobs-container">
        <div class="manage-jobs-sec addscroll">
            <h3>{{ __('messages.manage-jobs') }}</h3>
            <table>
                <thead>
                    <tr>
                        <td>{{ __('messages.title') }}</td>
                        <td>{{ __('messages.applications') }}</td>
                        <td>{{ __('messages.job-close') }}</td>
                        <td>{{ __('messages.status') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr>
                            <td>
                                <div class="table-list-title">
                                    <a href="{{ route('jobs.show', ['job' => $job]) }}">
                                        <h3>{{ $job->title }}</h3>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <span class="applied-field">
                                    <a href="{{ route('jobs.candidates', ['job' => $job]) }}">
                                        {{ $job->employee_profiles_count }} {{ __('messages.applied') }}
                                    </a>
                                </span>
                            </td>
                            <td>
                                <span>{{ $job->close_at }}</span>
                            </td>
                            <td>
                                <span class="status active">
                                    {{ $job->status === config('user.job_status.hidden')
                                        ? __('messages.hidden')
                                        : __('messages.active') }}
                                </span>
                            </td>
                            <td>
                                <ul class="action_job">
                                    <li>
                                        <span>{{ __('messages.edit-job') }}</span>
                                        <a href="{{ route('jobs.edit', ['job' => $job]) }}">
                                            <i class="la la-pencil"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <span>{{ __('messages.delete') }}</span>
                                        <form
                                            action="{{ route('jobs.destroy', ['job' => $job]) }}"
                                            method="post"
                                        >
                                            @csrf
                                            <button type="submit" class="unstyled cursor-pointer">
                                                <i class="la la-trash-o"></i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
