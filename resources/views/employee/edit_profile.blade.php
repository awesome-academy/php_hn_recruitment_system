@extends('layouts.master')
@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.personal-info') }}</h2>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="avt-model">
                            <img class="avt-img"
                                src="{{ $profile->avatar ? asset('images/' . $profile->avatar) : asset(config('user.default_avt')) }}"
                                alt="">
                            <div class="m-t-25">
                                <button data-toggle="modal" data-target="#modal-lg"
                                    class="btn btn-info avt-upload-btn">{{ __('messages.select-image') }}</button>
                            </div>

                            <!-- Modal START-->
                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg modal-content-container" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="wrapper">
                                                    <div class="image">
                                                        <img src="{{ asset('images/' . $profile->avatar) }}"
                                                            class="avt-upload-image">
                                                    </div>
                                                    <div class="content">
                                                        <div class="icon">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                        </div>
                                                        <div class="text">
                                                            {{ __('messages.no-file') }}
                                                        </div>
                                                    </div>
                                                    <div id="cancel-btn">
                                                        <i class="fas fa-times"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        {{ __('messages.filename-here') }}
                                                    </div>
                                                </div>
                                                <button id="custom-btn">{{ __('messages.choose-file') }}</button>
                                                <form method="post" enctype="multipart/form-data"
                                                    action="{{ route('change-image', ['image' => 'avatar', 'id' => $profile->id]) }}">
                                                    @csrf
                                                    <input id="default-btn" name="avatar" type="file" hidden>
                                                    <div>
                                                        <button class="btn btn-cancel"
                                                            data-dismiss="modal">{{ __('messages.cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-save">{{ __('messages.save') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-h-10">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @error('avatar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <form class="m-t-15" method="POST"
                                action="{{ route('employee-profiles.update', ['employee_profile' => $profile->id]) }}">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.name') }}*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="{{ __('messages.name') }}" value="{{ $profile->name }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.phone') }}</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" placeholder="{{ __('messages.phone') }}"
                                            value="{{ $profile->phone_number }}" name="phone_number">
                                        @error('phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.gender') }}</label>
                                    <div class="col-sm-10">
                                        <div class="m-t-10">
                                            <div class="radio d-inline m-r-15">
                                                <input id="horizontalFormRadio1" type="radio"
                                                    {{ $profile->gender == config('user.gender.male') ? 'checked' : '' }}
                                                    value="{{ config('user.gender.male') }}" name="gender">
                                                <label for="horizontalFormRadio1">{{ __('messages.male') }}</label>
                                            </div>
                                            <div class="radio d-inline m-r-15">
                                                <input id="horizontalFormRadio2" type="radio"
                                                    {{ $profile->gender == config('user.gender.female') ? 'checked' : '' }}
                                                    value="{{ config('user.gender.female') }}" name="gender">
                                                <label for="horizontalFormRadio2">{{ __('messages.female') }}</label>
                                            </div>
                                            @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.dob') }}</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="birthday"
                                            value="{{ $profile->birthday ? $profile->birthday->format('Y-m-d') : '' }}">
                                        @error('birthday')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.address') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('messages.address') }}" value="{{ $profile->address }}"
                                            name="address">
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.description') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $profile->description }}"
                                            placeholder="{{ __('messages.description') }}" name="description">
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.skill') }}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="skills" id="exampleFormControlTextarea1"
                                            rows="3">{{ $profile->skills }}</textarea>
                                        @error('skills')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.certification') }}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="certifications"
                                            id="exampleFormControlTextarea1"
                                            rows="3">{{ $profile->certifications }}</textarea>
                                        @error('certifications')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.industry') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('messages.industry') }}"
                                            value="{{ $profile->industry }}" name="industry">
                                        @error('industry')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-sm-right">
                                    <button class="btn btn-default">{{ __('messages.reset') }}</button>
                                    <button class="btn btn-gradient-success">{{ __('messages.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
