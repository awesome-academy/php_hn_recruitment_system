@extends('layouts.master')
@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.application-from') }}</h2>
                </div>
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                            @endif
                            <div class="p-h-10">
                                <form class="m-t-15" method="POST" enctype="multipart/form-data"
                                    action="{{ route('apply_jobs.store', ['jobId' => $job->id]) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.job-title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{ $job->title }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.company-name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control"
                                                value="{{ $job->employerProfile->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.cover-letter') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="cover_letter"
                                                id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.attach-cv') }}*</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="myfile" name="cv">
                                            @error('cv')
                                                <p class="text-danger">{{ Str::title($message) }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-sm-right">
                                        <button type="reset" class="btn btn-default">{{ __('messages.reset') }}</button>
                                        <button type="submit"
                                            class="btn btn-gradient-success">{{ __('messages.save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
