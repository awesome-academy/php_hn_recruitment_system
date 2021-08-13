<!-- Header Wrapper Start -->
<div class="jp_top_header_img_wrapper">
    <div class="jp_slide_img_overlay"></div>
    <div class="gc_main_menu_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                    <div class="gc_header_wrapper">
                        <div class="gc_logo">
                            <a href="{{ route('home') }}"><img
                                    src="{{ asset('bower_components/job_light/images/header/logo.png') }}"
                                    class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 center_responsive">
                    <div class="header-area hidden-menu-bar stick" id="sticker">
                        <div class="mainmenu">
                            <div class="gc_right_menu">
                                <ul>
                                    <li id="search_button">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_3" x="0px"
                                            y="0px" viewBox="0 0 451 451" style="enable-background:new 0 0 451 451;"
                                            xml:space="preserve">
                                            <g>
                                                <path id="search"
                                                    d="M447.05,428l-109.6-109.6c29.4-33.8,47.2-77.9,47.2-126.1C384.65,86.2,298.35,0,192.35,0C86.25,0,0.05,86.3,0.05,192.3   s86.3,192.3,192.3,192.3c48.2,0,92.3-17.8,126.1-47.2L428.05,447c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4   C452.25,441.8,452.25,433.2,447.05,428z M26.95,192.3c0-91.2,74.2-165.3,165.3-165.3c91.2,0,165.3,74.2,165.3,165.3   s-74.1,165.4-165.3,165.4C101.15,357.7,26.95,283.5,26.95,192.3z"
                                                    fill="#23c0e9" />
                                            </g>
                                        </svg>
                                    </li>
                                    <li>
                                        <div id="search_open" class="gc_search_box">
                                            <input type="text" placeholder="Search here">
                                            <button><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <ul class="float_left">
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('home') }}" class="gc_main_navigation">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('jobs.index') }}" class="gc_main_navigation">
                                        {{ __('messages.job') }}
                                    </a>
                                </li>
                                <li class="parent gc_main_navigation">
                                    <a href="#" class="gc_main_navigation">
                                        {{ __('messages.companies') }}
                                    </a>
                                </li>
                                <li class="has-mega gc_main_navigation">
                                    <a href="#" class="gc_main_navigation">
                                        {{ __('messages.candidate') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- mainmenu end -->
                        <!-- mobile menu area start -->
                        <header class="mobail_menu">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="gc_logo">
                                            <a href="{{ route('home') }}"><img
                                                    src="{{ asset('bower_components/job_light/images/header/logo.png') }}"></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="cd-dropdown-wrapper">
                                            <a class="house_toggle" href="#0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                    x="0px" y="0px" viewBox="0 0 31.177 31.177"
                                                    style="enable-background:new 0 0 31.177 31.177;"
                                                    xml:space="preserve" width="25px" height="25px">
                                                    <g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z"
                                                                fill="#ffffff" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                            <nav class="cd-dropdown">
                                                <h2><a href="#">Job<span>Pro</span></a></h2>
                                                <a href="#0" class="cd-close">Close</a>
                                                <ul class="cd-dropdown-content">
                                                    <li>
                                                        <form class="cd-search">
                                                            <input type="search" placeholder="Search...">
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('home') }}">{{ __('messages.home') }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('jobs.index') }}">{{ __('messages.job') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">{{ __('messages.company') }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">{{ __('messages.candidate') }}</a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
                <!-- mobile menu area end -->
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="jp_navi_right_btn_wrapper">
                        <ul>
                            <li>
                                <a href="{{ route('register') }}"><i class="fa fa-user"></i>&nbsp;
                                    {{ __('messages.register') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>&nbsp;
                                    {{ __('messages.login') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Wrapper End -->
