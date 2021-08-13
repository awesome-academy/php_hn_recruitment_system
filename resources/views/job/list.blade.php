@extends('layouts.main')
@section('main-content')
    <div class="jp_bottom_footer_Wrapper_header_img_wrapper">
        <div class="jp_slide_img_overlay"></div>
        <div class="jp_banner_heading_cont_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_job_heading_wrapper">
                            <div class="jp_job_heading">
                                <h1><span>3,000+</span> {{ __('messages.browse-job') }}</h1>
                                <p>{{ __('messages.job-welcome') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{ route('search_job') }}" method="get" autocomplete="off">
                            <div class="jp_header_form_wrapper">
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <input type="text" placeholder="{{ __('messages.search-keyword') }}" class="typeahead"
                                        name="keyword">
                                    <input type="text" class="autocompleteUrl" value="{{ route('autocomplete_job') }}"
                                        hidden>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="jp_form_btn_wrapper">
                                        <ul>
                                            <li>
                                                <a>
                                                    <button type="submit" class="job-search-btn text-dark">
                                                        <i class="fa fa-search"></i> {{ __('messages.search') }}
                                                    </button>
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp listing sidebar Wrapper Start -->
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_listing_tabs_wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="gc_causes_view_tabs_wrapper">
                                        <div class="gc_causes_view_tabs">
                                            <ul class="nav nav-pills">
                                                <li class="active"><a data-toggle="pill" href="#grid"><i
                                                            class="fa fa-th-large"></i></a></li>
                                                <li><a data-toggle="pill" href="#list"><i class="fa fa-list"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="gc_causes_search_box_wrapper gc_causes_search_box_wrapper2">
                                        <div class="gc_causes_search_box">
                                            <p><span>{{ $cntJobs }}</span>
                                                {{ trans_choice('messages.job-found', $cntJobs) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content job-data">
                                @include('layouts.job_result')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_job_location_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{ __('messages.job-type') }}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                        <div class="handyman_sec1_wrapper">
                                            <div class="content">
                                                <div class="box">
                                                    @foreach (config('user.job_type') as $type)
                                                        <p>
                                                            <input type="checkbox" id="{{ $type }}"
                                                                class="filter-selector job-type"
                                                                value="{{ $type }}">
                                                            <label for="{{ $type }}">{{ Str::ucfirst($type) }}</label>
                                                        </p>
                                                    @endforeach
                                                    <input type="text" hidden name="keyword" class="keyword"
                                                        value="{{ isset($keyword) ? $keyword : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_add_resume_wrapper jp_job_location_wrapper">
                                <div class="jp_add_resume_img_overlay"></div>
                                <div class="jp_add_resume_cont">
                                    <img src="{{ asset('bower_components/job_light/images/header/logo.png') }}">
                                    <h4>{{ __('messages.advertisement') }}</h4>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-plus-circle"></i>
                                                &nbsp;{{ __('messages.add-resume') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp listing sidebar Wrapper End -->
@endsection
