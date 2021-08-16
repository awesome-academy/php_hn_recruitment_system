@extends('layouts.admin')
@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media justify-content-between">
                                    <div>
                                        <p class="">{{ __('messages.total-jobs') }}</p>
                                        <h2 class="font-size-28 font-weight-light">{{ $cntJobs }}</h2>
                                    </div>
                                    <div class="align-self-end">
                                        <i class="fa fa-briefcase font-size-70 text-success opacity-01"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media justify-content-between">
                                    <div>
                                        <p class="">{{ __('messages.total-companies') }}</p>
                                        <h2 class="font-size-28 font-weight-light">{{ $cntCompanies }}</h2>
                                    </div>
                                    <div class="align-self-end">
                                        <i class="fa fa-building font-size-70 text-info opacity-01" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media justify-content-between">
                                    <div>
                                        <p class="">{{ __('messages.total-employees') }}</p>
                                        <h2 class="font-size-28 font-weight-light">{{ $cntEmployees }}</h2>
                                    </div>
                                    <div class="align-self-end">
                                        <i class="ti-user font-size-70 text-primary opacity-01"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.pending-companies') }}</h4>
                            </div>
                            <div class="table-overflow">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <td class="text-dark text-semibold">{{ __('messages.company-name') }}</td>
                                            <td class="text-dark text-semibold">{{ __('messages.status') }}</td>
                                            <td class="text-dark text-semibold">{{ __('messages.view') }}</td>
                                            <td class="text-dark text-semibold">{{ __('messages.unblock') }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($pendingCompanies))
                                            @foreach ($pendingCompanies as $company)
                                                <tr>
                                                    <td>
                                                        <div class="list-media">
                                                            <div class="list-item">
                                                                <div class="media-img">
                                                                    <img src="{{ $company->logo ? Storage::url("{$company->logo}") : asset(config('user.default_avt')) }}">
                                                                </div>
                                                                <div class="info">
                                                                    <span
                                                                        class="title p-t-10 text-semibold">{{ $company->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-pill badge-gradient-danger">{{ __('messages.pending') }}</span>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('employer.profiles.show', ['profile' => $company->id]) }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.change_user_status') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $company->user_id }}">
                                                            <button type="submit"
                                                                class="btn btn-gradient-success">{{ __('messages.unblock') }}</button>
                                                        </form>
                                                    </td>
                                                </tr>
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
@endsection
