<div id="grid" class="tab-pane fade in active">
    <div class="row">
        @if (!empty($jobs))
            @foreach ($jobs as $job)
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                        <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="jp_job_post_side_img">
                                        <img class="company-logo-img"
                                            src="{{ $job->employerProfile->logo ? Storage::url("{$job->employerProfile['logo']}") : asset(config('user.default_avt')) }}">
                                    </div>
                                    <div class="jp_job_post_right_cont jp_job_post_grid_right_cont">
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
                                    <div class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-heart-o"></i></a>
                                            </li>
                                            <li><a href="#">{{ $job->job_type }}</a></li>
                                            <li><a
                                                    href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ __('messages.view') }}</a>
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
