<!-- Top Header Wrapper Start -->
<div class="jp_top_header_main_wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="jp_top_header_left_wrapper">
                    <div class="jp_top_header_left_cont">
                        <p><i class="fa fa-phone"></i> &nbsp;{{ __('messages.phone') }} &nbsp;+1234567</p>
                        <p class=""><i class="fa fa-envelope"></i> &nbsp;{{ __('messages.email') }} :&nbsp;<a
                                href="#">ha@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="jp_top_header_right_wrapper">
                    <div class="jp_top_header_right_cont">
                        <ul>
                            <li><a href="{{ route('register') }}"><i class="fa fa-user"></i>&nbsp;
                                    {{ __('messages.register') }}</a></li>
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>&nbsp;
                                    {{ __('messages.login') }}</a></li>
                        </ul>
                    </div>
                    <div class="jp_top_header_right__social_cont">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header Wrapper End -->
<!-- Header Wrapper Start -->
<div class="jp_top_header_img_wrapper">
    <div class="gc_main_menu_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                    <div class="gc_header_wrapper">
                        <div class="gc_logo">
                            <a href="index.html"><img
                                    src="{{ asset('bower_components/job_light/images/header/logo2.png') }}" alt="Logo"
                                    title="Job Pro" class="img-responsive"></a>
                        </div>
                    </div>
                </div>

                @include('layouts.menu')

                <!-- mobile menu area end -->
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="jp_navi_right_btn_wrapper">
                        <ul>
                            <li>
                                <a href="add_postin.html">
                                    <i class="fa fa-plus-circle"></i>
                                    &nbsp; Post a job
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Wrapper End -->
