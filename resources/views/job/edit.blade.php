@extends('layouts.main')

@section('main-content')
    <!-- jp Tittle Wrapper Start -->
    <div class="jp_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>{{ __('messages.edit-job') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp Tittle Wrapper End -->

    <!-- jp ad post Wrapper Start -->
    <div class="jp_adp_main_section_wrapper">
        <div class="container">
            <form action="{{ route('jobs.update', ['job' => $job]) }}" method="post">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="jp_adp_form_wrapper">
                            <label for="title">{{ __('messages.title') }}*</label>
                            <input id="title" type="text" name="title"
                                value="{{ old('title') ? old('title') : $job->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="jp_adp_form_wrapper">
                            <label for="location">{{ __('messages.location') }}*</label>
                            <input id="location" type="text" name="location"
                                value="{{ old('location') ? old('location') : $job->location }}">
                            @error('location')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="jp_adp_form_wrapper">
                            <label for="salary">{{ __('messages.salary') }}*</label>
                            @php
                                $salary = str_replace('$', '', $job->salary);
                                $salary = str_replace(',', '', $salary);
                            @endphp
                            <input id="salary" type="text" name="salary"
                                value="{{ old('salary') ? old('salary') : $salary }}">
                            @error('salary')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="jp_adp_form_wrapper">
                            <label for="contact_email">{{ __('messages.contact-email') }}*</label>
                            <input id="contact_email" type="text" name="contact_email"
                                value="{{ old('contact_email') ? old('contact_email') : $job->contact_email }}">
                            @error('contact_email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bottom_line_Wrapper">
                        <div class="jp_adp_form_wrapper">
                            <label for="field">{{ __('messages.field') }}*</label>
                            <select id="field" name="field_id">
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id }}"
                                        {{ $job->field->id === $field->id ? 'selected' : '' }}>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('field_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="jp_adp_form_wrapper">
                            <label for="type">{{ __('messages.job-type') }}*</label>
                            <select id="type" name="job_type">
                                @foreach ($jobTypes as $key => $jobType)
                                    <option value="{{ $key }}" {{ $job->job_type === $key ? 'selected' : '' }}>
                                        {{ $jobType }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="jp_adp_form_wrapper">
                            <label for="quantity">{{ __('messages.quantity') }}*</label>
                            <input id="quantity" type="text" name="quantity"
                                value="{{ old('quantity') ? old('quantity') : $job->quantity }}">
                            @error('quantity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mt-4">{{ __('messages.description') }}*</label>
                        <textarea id="description" class="summernote"
                            name="description">{{ old('description') ? old('description') : $job->description }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>{{ __('messages.requirement') }}*</label>
                        <textarea id="requirement" name="requirement"
                            class="summernote">{{ old('requirement') ? old('requirement') : $job->requirement }}</textarea>
                        @error('requirement')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>{{ __('messages.benefit') }}*</label>
                        <textarea id="benefit" name="benefit"
                            class="summernote">{{ old('benefit') ? old('benefit') : $job->benefit }}</textarea>
                        @error('benefit')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_adp_choose_resume">
                            <button type="submit" class="custom-input" style="all: unset;">
                                <span><i class="fa fa-edit"></i> &nbsp;{{ __('messages.edit-job') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- jp ad post Wrapper End -->
@endsection
