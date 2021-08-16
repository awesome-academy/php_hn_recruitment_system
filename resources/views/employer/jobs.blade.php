@extends('layouts.master')

@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.my-jobs') }}</h2>
                </div>
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
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
                                                <td>{{ __('messages.title') }}&nbsp;
                                                    <i class="fa fa-sort-alpha-asc text-info" aria-hidden="true"></i>
                                                </td>
                                                <td>{{ __('messages.created-at') }}&nbsp;
                                                    <i class="fa fa-sort text-info" aria-hidden="true"></i>
                                                </td>
                                                <td>{{ __('messages.status') }}</td>
                                                <td>{{ __('messages.applications') }}</td>
                                                <td width="30%"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($jobs))
                                                @foreach ($jobs as $job)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('jobs.show', ['job' => $job]) }}"
                                                                class="sub-title">
                                                                <span class="title">{{ $job->title }}</span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <span>{{ $job->created_at }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-pill {{ $job->status === config('user.job_status.hidden') ? 'badge-gradient-danger' : 'badge-gradient-success' }}">
                                                                {{ $job->status === config('user.job_status.hidden') ? __('messages.hidden') : __('messages.active') }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="applied-field">
                                                                <a
                                                                    href="{{ route('jobs.candidates', ['job' => $job]) }}">
                                                                    {{ $job->employee_profiles_count }}
                                                                    {{ __('messages.applied') }}
                                                                </a>
                                                            </span>
                                                        </td>
                                                        <td class="text-center font-size-18">
                                                            <ul class="action_job">
                                                                <li>
                                                                    <span>{{ __('messages.edit-job') }}</span>
                                                                    <a href="{{ route('jobs.edit', ['job' => $job]) }}"
                                                                        class="text-primary m-r-15"><i
                                                                            class="ti-pencil"></i></a>
                                                                </li>
                                                                <li>
                                                                    @if ($job->status == config('user.job_status.active'))
                                                                        <span>{{ __('messages.close') }}</span>
                                                                        <a href="#" class="text-danger" data-toggle="modal"
                                                                            data-target="#modal-{{ $job->id }}">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    @else
                                                                        <span>{{ __('messages.open') }}</span>
                                                                        <a href="#" class="text-info" data-toggle="modal"
                                                                            data-target="#modal-{{ $job->id }}">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="modal-{{ $job->id }}">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <h4 class="m-b-15">
                                                                        {{ __('messages.confirmation') }}
                                                                    </h4>
                                                                    <p>{{ __('messages.sure-confirm') }}</p>
                                                                    <div class="m-t-20 text-right">
                                                                        <form action="{{ route('jobs.change_status') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $job->id }}">
                                                                            <button class="btn btn-default"
                                                                                data-dismiss="modal">
                                                                                {{ __('messages.cancel') }}
                                                                            </button>
                                                                            <button class="btn btn-success" data-dismiss=""
                                                                                type="submit">{{ __('messages.confirm') }}
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
