<!-- Header START -->
@php
$employerProfile = Auth::user()->employerProfile;
@endphp
<div class="header navbar">
    <div class="header-container">
        <div class="nav-logo">
            <a href="{{ route('home') }}">
                <div class="logo logo-dark"
                    style="background-image: url('{{ asset('bower_components/job_light/images/header/logo2.png') }}')">
                </div>
            </a>
        </div>
        <ul class="nav-left">
            <li>
                <a class="sidenav-fold-toggler" href="javascript:void(0);">
                    <i class="mdi mdi-menu"></i>
                </a>
                <a class="sidenav-expand-toggler" href="javascript:void(0);">
                    <i class="mdi mdi-menu"></i>
                </a>
            </li>
            <li class="search-box">
                <a class="search-toggle" href="javascript:void(0);">
                    <i class="search-icon mdi mdi-magnify"></i>
                    <i class="search-icon-close mdi mdi-close-circle-outline"></i>
                </a>
            </li>
            <li class="search-input">
                <input class="form-control" id="search-member" type="text" placeholder="Type to search...">
                <input class="form-control" id="search-member-url" value="{{ route('search_user') }}" type="hidden">
                <div class="search-predict">
                    <div class="search-wrapper scrollable">
                        <div class="m-h-20 border top"></div>
                        <div class="p-v-10">
                            <span class="display-block m-v-5 p-h-20 text-gray">
                                <i class="ti-user p-r-5"></i>
                                <span>{{ __('messages.member') }}</span>
                            </span>
                            <ul class="list-media" id="list-user">
                            </ul>
                        </div>
                    </div>
                    <div class="search-footer">
                        <span>{{ __('messages.searching-for') }} '<b class="text-dark"><span
                                    class="serach-text-bind"></span></b>'</span>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="nav-right">
            <li class="work scale-left">
                <a href="{{ route('jobs.index') }}">
                    <i class="mdi mdi-briefcase"></i>
                </a>
            </li>
            <li class="notifications dropdown dropdown-animated scale-left">
                <span class="counter">2</span>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-bell-ring-outline"></i>
                </a>
            </li>
            <li class="user-profile dropdown dropdown-animated scale-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="profile-img img-fluid"
                        src="{{ $employerProfile->logo ? Storage::url("{$employerProfile['logo']}") : asset(config('user.default_avt')) }}">
                </a>
                <ul class="dropdown-menu dropdown-md p-v-0">
                    <li>
                        <ul class="list-media">
                            <li class="list-item p-15">
                                <a href="{{ route('employer.profiles.show', ['profile' => $employerProfile]) }}">
                                    <div class="media-img">
                                        <img
                                            src="{{ $employerProfile->logo ? Storage::url("{$employerProfile['logo']}") : asset(config('user.default_avt')) }}">
                                    </div>
                                    <div class="info">
                                        <span class="title text-semibold">{{ $employerProfile->name }}</span>
                                        <span class="sub-title">{{ __('messages.profile') }}</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('change-language', ['locale' => 'vi']) }}">
                            <img src="{{ asset('bower_components/job_light/images/vn_flag.png') }}" class="flag-img"
                                alt="">{{ __('messages.vietnamese') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('change-language', ['locale' => 'en']) }}">
                            <img src="{{ asset('bower_components/job_light/images/en_flag.png') }}" class="flag-img"
                                alt="">{{ __('messages.english') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('account_info.show') }}">
                            <i class="ti-settings p-r-10"></i>
                            <span>{{ __('messages.setting') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employer.profiles.edit', ['profile' => $employerProfile]) }}">
                            <i class="ti-pencil p-r-10"></i>
                            <span>{{ __('messages.edit-profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employer.jobs', ['profile' => $employerProfile]) }}">
                            <i class="ti-briefcase p-r-10"></i>
                            <span>{{ __('messages.my-jobs') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="logout-btn">
                            <i class="ti-power-off p-r-10"></i>
                            <span>{{ __('messages.logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Header END -->
