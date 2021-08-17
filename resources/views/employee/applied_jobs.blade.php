@extends('layouts.master')
@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.applied-jobs') }}</h2>
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ Str::ucfirst($error) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <table id="dt-opt" class="table table-hover table-xl">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.job-title') }}</th>
                                                <th>{{ __('messages.company-name') }}</th>
                                                <th>{{ __('messages.attach-cv') }}</th>
                                                <th>{{ __('messages.applied-date') }}</th>
                                                <th>{{ __('messages.status') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobs as $job)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                                            {{ $job->title }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('employer.profiles.show', ['profile' => $job->employer_profile_id]) }}">
                                                            {{ $job->employerProfile->name }}
                                                        </a>
                                                    </td>
                                                    <td><a href="{{ asset('images/' . $job->application->cv) }}"
                                                            download>{{ $job->application->cv }}</a></td>
                                                    <td>
                                                        {{ $job->created_at }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $statusBadge = '';
                                                            if ($job->application->status == config('user.application_form_status.pending')) {
                                                                $statusBadge = 'badge-secondary';
                                                            } elseif ($job->application->status == config('user.application_form_status.accepted')) {
                                                                $statusBadge = 'badge-gradient-success';
                                                            } else {
                                                                $statusBadge = 'badge-gradient-danger';
                                                            }
                                                        @endphp
                                                        <span class="badge badge-pill {{ $statusBadge }}">
                                                            @foreach (config('user.application_form_status') as $key => $value)
                                                                @if ($job->application->status == $value)
                                                                    {{ Str::title($key) }}
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </td>
                                                    <td class="text-center font-size-18">
                                                        <a href="" data-toggle="modal"
                                                            data-target="#edit-modal-{{ $job->id }}"
                                                            class="text-info"><i class="ti-pencil"></i></a>
                                                        <a href="" data-toggle="modal"
                                                            data-target="#modal-{{ $job->id }}" class="text-danger"><i
                                                                class="ti-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                {{-- Delete Confirmation Modal --}}
                                                <div class="modal fade" id="modal-{{ $job->id }}">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h4 class="m-b-15">{{ __('messages.confirmation') }}</h4>
                                                                <p>{{ __('messages.delete-sure') }}</p>
                                                                <div class="m-t-20 text-right">
                                                                    <form
                                                                        action="{{ route('apply_jobs.destroy', ['jobId' => $job->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method("DELETE")
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
                                                {{-- Edit Application Form Modal --}}
                                                <div class="modal modal-left fade " id="edit-modal-{{ $job->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="side-modal-wrapper">
                                                                <div class="vertical-align">
                                                                    <div class="table-cell">
                                                                        <div class="modal-body">
                                                                            <div class="p-h-15">
                                                                                <form
                                                                                    action="{{ route('apply_jobs.update', ['jobId' => $job->id]) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method("PUT")
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            class="col-form-label control-label text-sm-right">{{ __('messages.cover-letter') }}</label>
                                                                                        <div>
                                                                                            <textarea class="form-control"
                                                                                                name="cover_letter"
                                                                                                id="exampleFormControlTextarea1"
                                                                                                rows="3">{{ $job->application->cover_letter }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            class="col-form-label control-label text-sm-right">{{ __('messages.attach-cv') }}*</label>
                                                                                        <div>
                                                                                            <input type="file"
                                                                                                class="form-control @error('cv') is-invalid @enderror"
                                                                                                id="myfile" name="cv">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="m-t-20 text-right">
                                                                                        <button type="reset"
                                                                                            class="btn btn-default">
                                                                                            {{ __('messages.reset') }}
                                                                                        </button>
                                                                                        <button class="btn btn-success"
                                                                                            type="submit">{{ __('messages.save') }}
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
