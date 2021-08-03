@extends('layouts.main')
@section('main-content')
    <!-- jp career Wrapper Start -->
    <div class="jp_career_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_hiring_slider_main_wrapper">
                        <div class="jp_career_slider_heading_wrapper">
                            <h2>{{ __('messages.hot-job') }}</h2>
                        </div>
                        <div class="jp_career_slider_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item jp_recent_main">
                                    <div class="jp_career_main_box_wrapper">
                                        <div class="jp_career_img_wrapper">
                                            <img src="{{ asset('bower_components/job_light/images/content/car_img1.jpg') }}"
                                                alt="career_img" />
                                        </div>
                                        <div class="jp_career_cont_wrapper">
                                            <p><i class="fa fa-calendar"></i>&nbsp;&nbsp; <a href="#">20 OCT, 2017</a></p>
                                            <h3><a href="#">Hey Seeker, It’s Time</a></h3>
                                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                                bibendum auctor, nisi elit consequat.</p>
                                        </div>
                                    </div>
                                    <div class="jp_career_slider_bottom_cont">
                                        <ul>
                                            <li><img src="{{ asset('bower_components/job_light/images/content/blog_small_img.jpg') }}"
                                                    alt="small_img" class="img-circle">&nbsp;&nbsp; <a href="#">Jhon Doe</a>
                                            </li>
                                        </ul>
                                        <p><a href="#"><i class="fa fa-comments"></i></a></p>
                                    </div>
                                </div>
                                <div class="item jp_recent_main">
                                    <div class="jp_career_main_box_wrapper">
                                        <div class="jp_career_img_wrapper">
                                            <img src="{{ asset('bower_components/job_light/images/content/car_img2.jpg') }}"
                                                alt="career_img" />
                                        </div>
                                        <div class="jp_career_cont_wrapper">
                                            <p><i class="fa fa-calendar"></i>&nbsp;&nbsp; <a href="#">20 OCT, 2017</a></p>
                                            <h3><a href="#">Hey Seeker, It’s Time</a></h3>
                                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                                bibendum auctor, nisi elit consequat.</p>
                                        </div>
                                    </div>
                                    <div class="jp_career_slider_bottom_cont">
                                        <ul>
                                            <li><img src="images/content/blog_small_img.jpg" alt="small_img"
                                                    class="img-circle">&nbsp;&nbsp; <a href="#">Jhon Doe</a></li>
                                        </ul>
                                        <p><a href="#"><i class="fa fa-comments"></i></a></p>
                                    </div>
                                </div>
                                <div class="item jp_recent_main">
                                    <div class="jp_career_main_box_wrapper">
                                        <div class="jp_career_img_wrapper">
                                            <img src="{{ asset('bower_components/job_light/images/content/car_img3.jpg') }}"
                                                alt="career_img" />
                                        </div>
                                        <div class="jp_career_cont_wrapper">
                                            <p><i class="fa fa-calendar"></i>&nbsp;&nbsp; <a href="#">20 OCT, 2017</a></p>
                                            <h3><a href="#">Hey Seeker, It’s Time</a></h3>
                                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                                bibendum auctor, nisi elit consequat.</p>
                                        </div>
                                    </div>
                                    <div class="jp_career_slider_bottom_cont">
                                        <ul>
                                            <li><img src="{{ asset('bower_components/job_light/images/content/blog_small_img.jpg') }}"
                                                    alt="small_img" class="img-circle">&nbsp;&nbsp; <a href="#">Jhon Doe</a>
                                            </li>
                                        </ul>
                                        <p><a href="#"><i class="fa fa-comments"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp career Wrapper End -->

    <!-- jp counter Wrapper Start -->
    <div class="jp_counter_main_wrapper">
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
                <h5 class="con4">{{ __('messages.company') }}</h5>
            </div>
        </div>
    </div>
    <!-- jp counter Wrapper End -->

    <div class="jp_best_deal_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_best_deal_heading_wrapper">
                        <div class="jp_best_deal_heading">
                            <h4>{{ __('messages.best-offer') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="jp_best_deal_main_cont_wrapper">
                        <div class="jp_best_deal_icon_sec">
                            <i class="flaticon-magnifying-glass"></i>
                        </div>
                        <div class="jp_best_deal_cont_sec">
                            <h4><a href="#">{{ __('messages.search-job') }}</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="jp_best_deal_main_cont_wrapper">
                        <div class="jp_best_deal_icon_sec">
                            <i class="flaticon-users"></i>
                        </div>
                        <div class="jp_best_deal_cont_sec">
                            <h4><a href="#">{{ __('messages.apply-job') }}</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="jp_best_deal_main_cont_wrapper jp_best_deal_main_cont_wrapper2">
                        <div class="jp_best_deal_icon_sec">
                            <i class="flaticon-shield"></i>
                        </div>
                        <div class="jp_best_deal_cont_sec">
                            <h4><a href="#">{{ __('messages.make-cv') }}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp best deal Wrapper End -->

    <!-- jp downlord Wrapper Start -->
    <div class="jp_downlord_main_wrapper">
        <div class="jp_downlord_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="jp_down_mob_img_wrapper">
                        <img src="{{ asset('bower_components/job_light/images/content/mobail.png') }}"
                            alt="mobail_img" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="ss_download_wrapper_details">
                        <h1><span>Download</span><br>Job Pro App</h1>
                        <a href="#" class="ss_appstore"><span><i class="fa fa-apple" aria-hidden="true"></i></span> App
                            Store</a>
                        <a href="#" class="ss_playstore"><span><i class="fa fa-android" aria-hidden="true"></i></span> Play
                            Store</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 visible-sm visible-xs">
                    <div class="jp_down_mob_img_wrapper">
                        <img src="{{ asset('bower_components/job_light/images/content/mobail.png') }}"
                            class="img-responsive" alt="mobail_img" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp downlord Wrapper End -->
@endsection
