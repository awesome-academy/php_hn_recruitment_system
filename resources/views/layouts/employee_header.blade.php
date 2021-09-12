<!-- Header START -->
@php
    $employeeProfile = Auth::user()->employeeProfile;
    $role = Auth::user()->role;
@endphp
<input type="hidden" name="user-id" value="{{ auth()->id() }}">

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
            <li>
                <a href="{{ route('jobs.index') }}">
                    <i class="mdi mdi-briefcase"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('chat') }}">
                    <i class="mdi mdi-message-processing"></i>
                </a>
            </li>
            @include('layouts.notifications')
            <li class="user-profile dropdown dropdown-animated scale-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if ($role == config('user.employee'))
                        <img class="profile-img img-fluid"
                            src="{{ $employeeProfile->avatar ? asset('images/' . $employeeProfile->avatar) : asset(config('user.default_avt')) }}">
                    @else
                        <img class="profile-img img-fluid" src="{{ asset(config('user.default_avt')) }}">
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-md p-v-0">
                    <li>
                        <ul class="list-media">
                            <li class="list-item p-15">
                                @if ($role == config('user.employee'))
                                    <a
                                        href="{{ route('employee-profiles.show', ['employee_profile' => $employeeProfile]) }}">
                                        <div class="media-img">
                                            <img
                                                src="{{ $employeeProfile->avatar ? asset('images/' . $employeeProfile->avatar) : asset(config('user.default_avt')) }}">
                                        </div>
                                        <div class="info">
                                            <span class="title text-semibold">{{ $employeeProfile->name }}</span>
                                            <span class="sub-title">{{ __('messages.profile') }}</span>
                                        </div>
                                    </a>
                                @else
                                    <div class="media-img">
                                        <img src="{{ asset(config('user.default_avt')) }}">
                                    </div>
                                    <div class="info">
                                        <span class="h3">ADMIN</span>
                                    </div>
                                @endif
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
                    @if ($role == config('user.employee'))
                        <li>
                            <a href="{{ route('account_info.show') }}">
                                <i class="ti-settings p-r-10"></i>
                                <span>{{ __('messages.setting') }}</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route('employee-profiles.edit', ['employee_profile' => Auth::user()->employeeProfile->id]) }}">
                                <i class="ti-pencil p-r-10"></i>
                                <span>{{ __('messages.edit-profile') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('template.cv') }}">
                                <i class="ti-email p-r-10"></i>
                                <span>{{ __('messages.cv') }}</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('applied_jobs') }}">
                                <i class="ti-briefcase p-r-10"></i>
                                <span>{{ __('messages.applied-jobs') }}</span> </a>
                        </li>
                    @endif
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
