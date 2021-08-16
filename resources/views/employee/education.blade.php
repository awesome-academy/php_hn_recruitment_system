@extends('layouts.master')
@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.education') }}</h2>
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
                                                <th>{{ __('messages.school') }}</th>
                                                <th>{{ __('messages.degree') }}</th>
                                                <th>{{ __('messages.field-of-study') }}</th>
                                                <th>{{ __('messages.start-date') }}</th>
                                                <th>{{ __('messages.end-date') }}</th>
                                                <th>{{ __('messages.grade') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($educationList as $education)
                                                <tr>
                                                    <td>{{ $education->school }}</td>
                                                    <td>{{ $education->degree }}</td>
                                                    <td>{{ $education->field_of_study }}</td>
                                                    <td>{{ $education->start_date->format('d/m/Y') }}</td>
                                                    <td>
                                                        {{ $education->end_date ? $education->end_date->format('d/m/Y') : 'Now' }}
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-pill badge-gradient-success">
                                                            {{ $education->grade }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center font-size-18">
                                                        <a href="" data-toggle="modal"
                                                            data-target="#edit-modal-{{ $education->id }}"
                                                            class="text-info"><i class="ti-pencil"></i></a>
                                                        <a href="" data-toggle="modal"
                                                            data-target="#modal-sm-{{ $education->id }}"
                                                            class="text-danger"><i class="ti-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                {{-- Delete Confirmation Modal --}}
                                                <div class="modal fade" id="modal-sm-{{ $education->id }}">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h4 class="m-b-15">{{ __('messages.confirmation') }}</h4>
                                                                <p>{{ __('messages.delete-sure') }}</p>
                                                                <div class="m-t-20 text-right">
                                                                    <form
                                                                        action="{{ route('education.destroy', ['education' => $education->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method("DELETE")
                                                                        <button class="btn btn-default"
                                                                            data-dismiss="modal">
                                                                            {{ __('messages.cancel') }}
                                                                        </button>
                                                                        <button class="btn btn-success"
                                                                            type="submit">{{ __('messages.confirm') }}
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Edit Education Modal --}}
                                                <div class="modal modal-left fade " id="edit-modal-{{ $education->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="side-modal-wrapper">
                                                                <div class="vertical-align">
                                                                    <div class="table-cell">
                                                                        <div class="modal-body">
                                                                            <div class="p-h-15">
                                                                                <form
                                                                                    action="{{ route('education.update', ['education' => $education->id]) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method("PUT")
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control @error('school') is-invalid @enderror"
                                                                                            name="school"
                                                                                            value="{{ $education->school }}"
                                                                                            placeholder="{{ __('messages.school') }}*">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control @error('degree') is-invalid @enderror"
                                                                                            name="degree"
                                                                                            value="{{ $education->degree }}"
                                                                                            placeholder="{{ __('messages.degree') }}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control @error('field_of_study') is-invalid @enderror"
                                                                                            name="field_of_study"
                                                                                            value="{{ $education->field_of_study }}"
                                                                                            placeholder="{{ __('messages.field-of-study') }}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control @error('grade') is-invalid @enderror"
                                                                                            name="grade"
                                                                                            value="{{ $education->grade }}"
                                                                                            placeholder="{{ __('messages.grade') }}">
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label control-label text-sm-left">
                                                                                            {{ __('messages.start-date') }}*
                                                                                        </label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="date"
                                                                                                class="form-control @error('start_date') is-invalid @enderror"
                                                                                                name="start_date"
                                                                                                value="{{ $education->start_date->format('Y-m-d') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label control-label text-sm-left">
                                                                                            {{ __('messages.end-date') }}
                                                                                        </label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="date"
                                                                                                class="form-control @error('end_date') is-invalid @enderror"
                                                                                                name="end_date"
                                                                                                value="{{ $education->end_date ? $education->end_date->format('Y-m-d') : '' }}">
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
                                    <button class="btn btn-success" data-toggle="modal" data-target="#side-modal-r">
                                        <i class="ti-plus"></i>&nbsp;{{ __('messages.add') }}
                                    </button>
                                    {{-- Create Education Modal --}}
                                    <div class="modal modal-right fade " id="side-modal-r">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="side-modal-wrapper">
                                                    <div class="vertical-align">
                                                        <div class="table-cell">
                                                            <div class="modal-body">
                                                                <div class="p-h-15">
                                                                    <form action="{{ route('education.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control @error('school') is-invalid @enderror"
                                                                                name="school"
                                                                                placeholder="{{ __('messages.school') }}*">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control @error('degree') is-invalid @enderror"
                                                                                name="degree"
                                                                                placeholder="{{ __('messages.degree') }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control @error('field_of_study') is-invalid @enderror"
                                                                                name="field_of_study"
                                                                                placeholder="{{ __('messages.field-of-study') }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control @error('grade') is-invalid @enderror"
                                                                                name="grade"
                                                                                placeholder="{{ __('messages.grade') }}">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label
                                                                                class="col-sm-4 col-form-label control-label text-sm-left">
                                                                                {{ __('messages.start-date') }}*
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="date"
                                                                                    class="form-control @error('start_date') is-invalid @enderror"
                                                                                    name="start_date">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label
                                                                                class="col-sm-4 col-form-label control-label text-sm-left">
                                                                                {{ __('messages.end-date') }}
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="date"
                                                                                    class="form-control @error('end_date') is-invalid @enderror"
                                                                                    name="end_date">
                                                                            </div>
                                                                        </div>
                                                                        <div class="m-t-20 text-right">
                                                                            <button type="reset" class="btn btn-default">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
