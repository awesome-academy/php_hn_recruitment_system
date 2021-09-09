@extends('layouts.master')

@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.candidate') }} - {{ $job->title }}</h2>
                </div>
                <input type="hidden" id="jobId" value="{{ $job->id }}">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <canvas class="chart" id="donut-chart" ></canvas>
                    </div>
                    <div class="col-sm-3"></div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-overflow">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <table id="dt-opt" class="table table-hover table-xl">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.name') }}&nbsp;
                                            <i class="fa fa-sort-alpha-asc text-info" aria-hidden="true"></i>
                                        </th>
                                        <th>{{ __('messages.applied-date') }}&nbsp;
                                            <i class="fa fa-sort text-info" aria-hidden="true"></i>
                                        </th>
                                        <th>{{ __('messages.status') }}</th>
                                        <th>{{ __('messages.view-cv') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <td>
                                                <div class="list-media">
                                                    <a
                                                        href="{{ route('employee-profiles.show', ['employee_profile' => $candidate]) }}">
                                                        <div class="list-item">
                                                            <div class="media-img">
                                                                <img
                                                                    src="{{ $candidate->avatar ? asset("images/{$candidate->avatar}") : asset(config('user.default_avt')) }}">
                                                            </div>
                                                            <div class="info">
                                                                <span class="title">{{ $candidate->name }}</span>
                                                                <span
                                                                    class="sub-title">{{ $candidate->phone_number }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </td>
                                            @php
                                                $status = $candidate->application->status;
                                            @endphp
                                            <td>{{ $candidate->application->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($status == config('user.application_form_status.pending'))
                                                    <span class="badge badge-pill badge-secondary">
                                                        {{ __('messages.pending') }}
                                                    </span>
                                                @elseif ($status == config('user.application_form_status.accepted'))
                                                    <span class="badge badge-pill badge-gradient-success">
                                                        {{ __('messages.approved') }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">
                                                        {{ __('messages.rejected') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#modal-lg-{{ $candidate->id }}">
                                                    <i class="fa fa-eye text-light" aria-hidden="true"></i>
                                                </button>
                                                <div class="modal fade" id="modal-lg-{{ $candidate->id }}">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <embed
                                                                    src="{{ asset("images/{$candidate->application->cv}") }}"
                                                                    width="100%" height="600" type="application/pdf">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center font-size-18" id="application-action">
                                                @if ($status == config('user.application_form_status.pending'))
                                                    <form
                                                        action="{{ route('employer.change_application_status', ['employeeProfile' => $candidate]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="jobId" value="{{ $job->id }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ config('user.application_form_status.accepted') }}">
                                                        <button type="submit"
                                                            class="btn btn-info btn-outline">{{ __('messages.approve') }}</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('employer.change_application_status', ['employeeProfile' => $candidate]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="jobId" value="{{ $job->id }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ config('user.application_form_status.rejected') }}">
                                                        <button type="submit"
                                                            class="btn btn-danger btn-outline">{{ __('messages.reject') }}</button>
                                                    </form>
                                                @elseif ($status == config('user.application_form_status.accepted'))
                                                    <form
                                                        action="{{ route('employer.change_application_status', ['employeeProfile' => $candidate]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="jobId" value="{{ $job->id }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ config('user.application_form_status.rejected') }}">
                                                        <button type="submit"
                                                            class="btn btn-danger btn-outline">{{ __('messages.reject') }}</button>
                                                    </form>
                                                @else
                                                    <form
                                                        action="{{ route('employer.change_application_status', ['employeeProfile' => $candidate]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="jobId" value="{{ $job->id }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ config('user.application_form_status.accepted') }}">
                                                        <button type="submit"
                                                            class="btn btn-info btn-outline">{{ __('messages.approve') }}</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('addtional_scripts')
        <script src="{{ asset('js/candidates.js') }}"></script>
    @endsection
@endsection

<div class="modal fade" id="modal-confirm" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="padding:10px;">
                <h4 class="text-center">{{ __('messages.sure-confirm') }}</h4>
                <div class="text-center">
                    <button id="btn-confirm" class="btn btn-gradient-success">Confirm</button>
                    <button id="btn-cancel" class="btn btn-default btn-no">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
