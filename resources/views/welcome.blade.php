@extends('layouts.homepage')
@section('main-content')
    <div class="jp_counter_main_wrapper">
        <div class="container">
            <div class="gc_counter_cont_wrapper">
                <div class="count-description">
                    <span class="timer">2540</span><i class="fa fa-plus"></i>
                    <h5 class="con1">{{ __('messages.job-available') }}</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper2">
                <div class="count-description">
                    <span class="timer">7325</span><i class="fa fa-plus"></i>
                    <h5 class="con2">{{ __('messages.member') }}</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper3">
                <div class="count-description">
                    <span class="timer">1924</span><i class="fa fa-plus"></i>
                    <h5 class="con3">{{ __('messages.resume') }}</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper4">
                <div class="count-description">
                    <span class="timer">4275</span><i class="fa fa-plus"></i>
                    <h5 class="con4">{{ __('messages.companies') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="jp_first_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @if (!Auth::check())
                                <div class="jp_register_section_main_wrapper">
                                    <div class="jp_regis_left_side_box_wrapper">
                                        <div class="jp_regis_left_side_box">
                                            <img src="{{ asset('bower_components/job_light/images/content/regis_icon.png') }}"
                                                alt="icon" />
                                            <h4>{{ __('messages.i-am-employer') }}</h4>
                                            <p>{{ __('messages.employer-guide') }}</p>
                                            <ul>
                                                <li><a href="{{ route('register') }}"><i class="fa fa-plus-circle"></i>
                                                        &nbsp;{{ Str::upper(__('messages.register-now')) }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_regis_right_side_box_wrapper">
                                        <div class="jp_regis_right_img_overlay"></div>
                                        <div class="jp_regis_right_side_box">
                                            <img src="{{ asset('bower_components/job_light/images/content/regis_icon2.png') }}"
                                                alt="icon" />
                                            <h4>{{ __('messages.i-am-candidate') }}</h4>
                                            <p>{{ __('messages.employee-guide') }}</p>
                                            <ul>
                                                <li><a href="{{ route('register') }}"><i class="fa fa-plus-circle"></i>
                                                        &nbsp;{{ Str::upper(__('messages.register-now')) }}</a></li>
                                            </ul>
                                        </div>
                                        <div class="jp_regis_center_tag_wrapper">
                                            <p>{{ __('messages.or') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_hiring_slider_main_wrapper">
                                <div class="jp_hiring_heading_wrapper">
                                    <h2>{{ __('messages.top-companies') }}</h2>
                                </div>
                                <div class="jp_hiring_slider_wrapper">
                                    <div class="owl-carousel owl-theme">
                                        @foreach ($topCompanies as $company)
                                            <div class="item h-100">
                                                <div class="jp_hiring_content_main_wrapper">
                                                    <div class="jp_hiring_content_wrapper">
                                                        <img height="40"
                                                            src="{{ $company->logo ? Storage::url("{$company->logo}") : asset(config('user.default_avt')) }}">
                                                        <h4>{{ $company->name }}</h4>
                                                        <p>{{ $company->address }}</p>
                                                        <ul>
                                                            <li>
                                                                <a
                                                                    href="{{ route('employer.profiles.show', ['profile' => $company->id]) }}">
                                                                    {{ __('messages.view') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="cc_featured_product_main_wrapper">
                                <div class="jp_hiring_heading_wrapper jp_job_post_heading_wrapper">
                                    <h2>{{ __('messages.recent-job') }}</h2>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active">
                                    <div class="ss_featured_products">
                                        <div>
                                            <div class="item job-data">
                                                @include('layouts.job_data')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ajax-load text-center" style="display: none">
                                <p><img height="30"
                                        src="{{ asset('bower_components/job_light/images/loader2.gif') }}">&nbsp;&nbsp;&nbsp;Loading
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="jp_first_right_sidebar_main_wrapper">
                        <div class="row">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="jp_spotlight_main_wrapper">
                                    <div class="spotlight_header_wrapper">
                                        <h4>{{ __('messages.hot-job') }}</h4>
                                    </div>
                                    <div class="jp_spotlight_slider_wrapper">
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($topJobs as $job)
                                                <div class="item">
                                                    <div class="jp_spotlight_slider_img_Wrapper">
                                                        <img
                                                            src="{{ $job->employerProfile->logo ? Storage::url("{$job->employerProfile['logo']}") : asset(config('user.default_avt')) }}">
                                                    </div>
                                                    <div class="jp_spotlight_slider_cont_Wrapper">
                                                        <h4>{{ $job->title }}</h4>
                                                        <p>{{ $job->employerProfile->name }}</p>
                                                        <ul>
                                                            <li><i class="fa fa-cc-paypal"></i>&nbsp; {{ $job->salary }}
                                                            </li>
                                                            <li><i class="fa fa-map-marker"></i>&nbsp;
                                                                {{ $job->location }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="jp_spotlight_slider_btn_wrapper">
                                                        <div class="jp_spotlight_slider_btn">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-eye"></i>
                                                                        &nbsp;{{ Str::upper(__('messages.view')) }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="jp_spotlight_main_wrapper">
                                    <div class="jp_rightside_career_heading">
                                        <h4>{{ __('messages.recent-employees') }}</h4>
                                    </div>
                                    <div class="jp_rightside_career_main_content">
                                        <div class="jp_rightside_career_content_wrapper jp_best_deal_right_content">
                                            @foreach ($recentEmployees as $employee)
                                                <a
                                                    href="{{ route('employee-profiles.show', ['employee_profile' => $employee->id]) }}">
                                                    <div class="jp_rightside_career_img">
                                                        <img height="80"
                                                            src="{{ $employee->avatar ? asset('images/' . $employee->avatar) : asset(config('user.default_avt')) }}">
                                                    </div>
                                                    <div class="jp_rightside_career_img_cont">
                                                        <h4>{{ $employee->name }}</h4>
                                                        <p><i class="fa fa-folder-open-o"></i>
                                                            &nbsp;{{ $employee->industry }}
                                                        </p>
                                                    </div>
                                                </a>
                                            @endforeach
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
