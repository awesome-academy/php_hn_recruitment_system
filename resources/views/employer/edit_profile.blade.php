@extends('layouts.master')

@section('main-content')
    <div class="row" style="margin-top: 65px">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center">{{ __('messages.edit-profile') }}</h1>
            <form
                action="{{ route('employer.profiles.update', ['profile' => $profile]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @method('put')
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">
                        {{ __('messages.name') }}*
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') ? old('name') : $profile['name'] }}"
                        >
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="website" class="col-sm-3 col-form-label">
                        {{ __('messages.website') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="website"
                            type="text"
                            name="website"
                            value="{{ old('website') ? old('website') : $profile['website'] }}"
                        >
                        @error('website')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="industry" class="col-sm-3 col-form-label">
                        {{ __('messages.industry') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="industry"
                            type="text"
                            name="industry"
                            value="{{ old('industry') ? old('industry') : $profile['industry'] }}"
                        >
                        @error('industry')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_size" class="col-sm-3 col-form-label">
                        {{ __('messages.company-size') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="company_size"
                            type="text"
                            name="company_size"
                            value="{{ old('company_size') ? old('company_size') : $profile['company_size'] }}"
                        >
                        @error('company_size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_type" class="col-sm-3 col-form-label">
                        {{ __('messages.company-type') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="company_type"
                            type="text"
                            name="company_type"
                            value="{{ old('company_type') ? old('company_type') : $profile['company_type'] }}"
                        >
                        @error('company_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">
                        {{ __('messages.address') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            class="form-control"
                            id="address"
                            type="text"
                            name="address"
                            value="{{ old('address') ? old('address') : $profile['address'] }}"
                        >
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone_number" class="col-sm-3 col-form-label">
                        {{ __('messages.phone') }}
                    </label>
                    <div class="col-sm-9">
                    <input
                            class="form-control"
                            id="phone_number"
                            type="text"
                            name="phone_number"
                            value="{{ old('phone_number') ? old('phone_number') : $profile['phone_number'] }}"
                        >
                        @error('phone_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row description">
                    <label class="col-sm-3 col-form-label">
                        {{ __('messages.description') }}
                    </label>
                    <div class="col-sm-9">
                        <textarea
                            id="summernote-custom"
                            name="description"
                        >{{ old('description') ? old('description') : $profile['description'] }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="logo">
                        {{ __('messages.logo') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            id="logo"
                            type="file"
                            name="logo"
                        >
                        @error('logo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cover_photo">
                        {{ __('messages.cover-photo') }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            id="cover_photo"
                            type="file"
                            name="cover_photo"
                        >
                        @error('cover_photo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="login_btn_wrapper">
                    <button type="submit" id="login-submit">{{ __('messages.edit-profile') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
