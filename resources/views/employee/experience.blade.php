@extends('layouts.master')
@section('main-content')
    <div class="main-content form-content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-11">
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
                                            <th>{{ __('messages.position') }}</th>
                                            <th>{{ __('messages.employment-type') }}</th>
                                            <th>{{ __('messages.start-date') }}</th>
                                            <th>{{ __('messages.end-date') }}</th>
                                            <th>{{ __('messages.company') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($experienceList as $experience)
                                            <tr>
                                                <td>{{ $experience->position }}</td>
                                                <td>{{ $experience->employment_type }}</td>
                                                <td>{{ $experience->start_date->format('d/m/Y') }}</td>
                                                <td>
                                                    {{ $experience->end_date ? $experience->end_date->format('d/m/Y') : 'Now' }}
                                                </td>
                                                <td>{{ $experience->company }}</td>
                                                <td class="text-center font-size-18">
                                                    <a href="" data-toggle="modal" data-target="#edit-modal-l"
                                                        class="text-gray m-r-15"><i class="ti-pencil"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#modal-sm"
                                                        class="text-gray"><i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- Delete Confirmation Modal --}}
                                            <div class="modal fade" id="modal-sm">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h4 class="m-b-15">{{ __('messages.confirmation') }}</h4>
                                                            <p>{{ __('messages.delete-sure') }}</p>
                                                            <div class="m-t-20 text-right">
                                                                <form
                                                                    action="{{ route('experiences.destroy', ['experience' => $experience->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button class="btn btn-default" data-dismiss="modal">
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
                                            {{-- Edit Experience Modal --}}
                                            <div class="modal modal-left fade " id="edit-modal-l">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="side-modal-wrapper">
                                                            <div class="vertical-align">
                                                                <div class="table-cell">
                                                                    <div class="modal-body">
                                                                        <div class="p-h-15">
                                                                            <form
                                                                                action="{{ route('experiences.update', ['experience' => $experience->id]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method("PUT")
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                        class="form-control @error('position') is-invalid @enderror"
                                                                                        name="position"
                                                                                        value="{{ $experience->position }}"
                                                                                        placeholder="{{ __('messages.position') }}*">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="control-label">{{ __('messages.employment-type') }}*</label>
                                                                                    <select
                                                                                        class="form-control @error('employment_type') is-invalid @enderror"
                                                                                        name="employment_type"
                                                                                        value="{{ $experience->employment_type }}">
                                                                                        @foreach (config('user.employment_type') as $type)
                                                                                            <option
                                                                                                value="{{ $type }}">
                                                                                                {{ $type }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
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
                                                                                            value="{{ $experience->start_date->format('Y-m-d') }}">
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
                                                                                            value="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                        class="form-control @error('company') is-invalid @enderror"
                                                                                        name="company"
                                                                                        value="{{ $experience->company }}"
                                                                                        placeholder="{{ __('messages.company') }}">
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
                                    <i class="ti-plus"></i>&nbsp ADD
                                </button>
                                {{-- Create Experience Modal --}}
                                <div class="modal modal-right fade " id="side-modal-r">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="side-modal-wrapper">
                                                <div class="vertical-align">
                                                    <div class="table-cell">
                                                        <div class="modal-body">
                                                            <div class="p-h-15">
                                                                <form action="{{ route('experiences.store') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                            class="form-control @error('position') is-invalid @enderror"
                                                                            name="position"
                                                                            placeholder="{{ __('messages.position') }}*">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="control-label">{{ __('messages.employment-type') }}*</label>
                                                                        <select
                                                                            class="form-control @error('employment_type') is-invalid @enderror"
                                                                            name="employment_type">
                                                                            @foreach (config('user.employment_type') as $type)
                                                                                <option value="{{ $type }}">
                                                                                    {{ $type }}</option>
                                                                            @endforeach
                                                                        </select>
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
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                            class="form-control @error('company') is-invalid @enderror"
                                                                            name="company"
                                                                            placeholder="{{ __('messages.company') }}">
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
@endsection
