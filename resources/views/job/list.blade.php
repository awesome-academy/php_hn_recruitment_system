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
                        <div class="jp_header_form_wrapper">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <input type="text" placeholder="{{ __('messages.job-keyword') }}">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="jp_form_btn_wrapper">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-search"></i> {{ __('messages.search') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_banner_main_jobs_wrapper">
                            <div class="jp_banner_main_jobs">
                                <ul>
                                </ul>
                            </div>
                        </div>
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
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @if (!empty($jobs))
                                            @foreach ($jobs as $job)
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div
                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                        <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="jp_job_post_side_img">
                                                                        <img class="company-logo-img"
                                                                            src="{{ asset('images/' . $job->employerProfile->logo) }}">
                                                                    </div>
                                                                    <div
                                                                        class="jp_job_post_right_cont jp_job_post_grid_right_cont">
                                                                        <h4>{{ $job->title }}</h4>
                                                                        <p>{{ $job->employerProfile->name }}</p>
                                                                        <ul>
                                                                            <li><i class="fa fa-cc-paypal"></i>&nbsp;
                                                                                {{ $job->salary }}</li>
                                                                            <li><i class="fa fa-map-marker"></i>&nbsp;
                                                                                {{ $job->location }}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div
                                                                        class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper">
                                                                        <ul>
                                                                            <li><a href="#"><i
                                                                                        class="fa fa-heart-o"></i></a>
                                                                            </li>
                                                                            <li><a href="#">{{ $job->job_type }}</a></li>
                                                                            <li><a
                                                                                    href="#">{{ __('messages.view') }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jp_job_post_keyword_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <i class="fa fa-tags"></i>{{ __('messages.field') }}:
                                                                </li>
                                                                <li><a href="">{{ $job->field->name }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                            <div class="pager_wrapper gc_blog_pagination">
                                                <ul class="pagination">
                                                    {{ $jobs->links('layouts.pagination') }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @if (!empty($jobs))
                                            @foreach ($jobs as $job)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div
                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                        <div class="jp_job_post_main_wrapper">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                    <div class="jp_job_post_side_img">
                                                                        <img class="company-logo-img"
                                                                            src="{{ asset('images/' . $job->employerProfile->logo) }}">
                                                                    </div>
                                                                    <div class="jp_job_post_right_cont">
                                                                        <h4>{{ $job->title }}</h4>
                                                                        <p></p>
                                                                        <ul>
                                                                            <li><i
                                                                                    class="fa fa-cc-paypal"></i>&nbsp;{{ $job->salary }}
                                                                            </li>
                                                                            <li><i class="fa fa-map-marker"></i>&nbsp;
                                                                                {{ $job->location }}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="jp_job_post_right_btn_wrapper">
                                                                        <ul>
                                                                            <li><a href="#"><i
                                                                                        class="fa fa-heart-o"></i></a></li>
                                                                            <li><a href="#">{{ $job->job_type }}</a></li>
                                                                            <li><a
                                                                                    href="#">{{ __('messages.view') }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jp_job_post_keyword_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <i class="fa fa-tags"></i>{{ __('messages.field') }}:
                                                                </li>
                                                                <li><a href="">{{ $job->field->name }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                            <div class="pager_wrapper gc_blog_pagination">
                                                <ul class="pagination">
                                                    {{ $jobs->links('layouts.pagination') }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                        <input type="checkbox" id="c136" name="{{ $type }}">
                                                        <label for="c136">{{ $type }}</label>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a
                                                    href="#">{{ __('messages.show') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_job_location_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{ __('messages.salary') }}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c125" name="cb">
                                                    <label for="c125">$500 - 1k</label>

                                                <p>
                                                    <input type="checkbox" id="c126" name="cb">
                                                    <label for="c126">$1k - 2k</label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c127" name="cb">
                                                    <label for="c127">$2k - 3k</label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a
                                                    href="#">{{ __('messages.show') }}</a>
                                            </li>
                                        </ul>
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
