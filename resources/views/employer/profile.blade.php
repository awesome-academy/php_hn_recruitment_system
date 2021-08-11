@extends('layouts.main')

@section('main-content')
    <div class="jp_tittle_main_wrapper jp_cs_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>{{ $profile['name'] }}</h2>
                        </div>
                    </div>
                </div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- TODO: write css for cover photo and logo -->
					<div class="image_info">
                        <div class="cover_photo">
                            <img
                                src="{{ Storage::url("{$profile['cover_photo']}") }}"
                                alt="cover"
                            >
                        </div>
						<div class="logo">
							<img
                                src="{{ Storage::url("{$profile['logo']}") }}"
                                alt="job_img"
                            >
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
    <div class="jp_listing_single_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_listing_left_sidebar_wrapper">
                        <div class="jp_job_des">
                            <h2>{{ __('messages.description') }}</h2>
                            <div class="description">{{ $profile['description'] }}</div>
                            <dl class="employer_info">
                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.website') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    <a href="{{ $profile['website'] }}" target="_blank">
                                        {{ $profile['website'] }}
                                    </a>
                                </dd>

                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.phone') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    {{ $profile['phone_number'] }}
                                </dd>

                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.industry') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    {{ $profile['industry'] }}
                                </dd>

                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.company-size') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    {{ $profile['company_size'] }}
                                </dd>

                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.company-type') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    {{ $profile['company_type'] }}
                                </dd>

                                <dt class="col-lg-4 col-md-4 col sm-6 col-xs-6">
                                    {{ __('messages.address') }}
                                </dt>
                                <dd class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    {{ $profile['address'] }}
                                </dd>

                            </dl>
                        </div>
                    </div>
                </div>
                <div class="recent-jobs col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="jp_job_des recent-jobs-header">
                        <h2>{{ __('messages.recent-jobs') }}</h2>
                    </div>
                    <ul class="recent-jobs-list">
                        @foreach ($recentJobs as $job)
                            <li class="job-item">
                                <a href="{{ route('jobs.show', ['job' => $job]) }}">
                                    <div class="job-title">{{ $job->title }}</div>
                                    <div class="job-location">
                                        <i class="mdi mdi-map-marker"></i>
                                        {{ $job->location }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="jp_listing_right_bar_btn_wrapper">
                        <div class="jp_listing_right_bar_btn">
                            <ul>
                                <li>
                                    <a href="{{ route('search_job', ['keyword' => $profile->name]) }}">
                                        {{ __('messages.more') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
