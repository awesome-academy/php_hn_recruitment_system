@if (!empty($jobs))
    @foreach ($jobs as $job)
        <div class="jp_job_post_main_wrapper_cont jp_job_post_main_wrapper_cont2">
            <div class="jp_job_post_main_wrapper">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="jp_job_post_side_img">
                            <img class="company-logo-img"
                                src="{{ $job->employerProfile->logo ? Storage::url("{$job->employerProfile['logo']}") : asset(config('user.default_avt')) }}">
                        </div>
                        <div class="jp_job_post_right_cont">
                            <h4>{{ $job->title }}</h4>
                            <p>{{ $job->employerProfile->name }}</p>
                            <ul>
                                <li><i class="fa fa-cc-paypal"></i>&nbsp;{{ $job->salary }}</li>
                                <li><i class="fa fa-map-marker"></i>&nbsp;{{ $job->location }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="jp_job_post_right_btn_wrapper">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart-o"></i></a>
                                </li>
                                <li><a href="#">{{ $job->job_type }}</a></li>
                                <li>
                                    <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                        {{ __('messages.view') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jp_job_post_keyword_wrapper">
                <ul>
                    <li><i class="fa fa-tags"></i>{{ __('messages.field') }} :</li>
                    <li><a href="#">{{ $job->field->name }}</a></li>
                </ul>
            </div>
        </div>
    @endforeach
@endif
