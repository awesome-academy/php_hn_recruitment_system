<!-- Header START -->
<div class="header navbar">
    <div class="header-container">
        <div class="nav-logo">
            <a href="index.html">
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
                <input class="form-control" type="text" placeholder="Type to search...">
                <div class="search-predict">
                    <div class="search-wrapper scrollable">
                        <div class="m-h-20 border top"></div>
                        <div class="p-v-10">
                            <span class="display-block m-v-5 p-h-20 text-gray">
                                <i class="ti-user p-r-5"></i>
                                <span>Members</span>
                            </span>
                            <ul class="list-media">
                                <li class="list-item">
                                    <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                                        <div class="media-img">
                                            <img
                                                src="{{ asset('bower_components/job_light/admin/assets/images/avatars/thumb-3.jpg') }}">
                                        </div>
                                        <div class="info">
                                            <span class="title p-t-10">Debra Stewart</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="search-footer">
                        <span>You are Searching for '<b class="text-dark"><span
                                    class="serach-text-bind"></span></b>'</span>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="nav-right">
            <li class="notifications dropdown dropdown-animated scale-left">
                <span class="counter">2</span>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-bell-ring-outline"></i>
                </a>
            </li>
            <li class="user-profile dropdown dropdown-animated scale-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="profile-img img-fluid"
                        src="{{ asset('bower_components/job_light/admin/assets/images/avatars/thumb-13.jpg') }}">
                </a>
                <ul class="dropdown-menu dropdown-md p-v-0">
                    <li>
                        <ul class="list-media">
                            <li class="list-item p-15">
                                <a href="">
                                    <div class="media-img">
                                        <img
                                            src="{{ asset('bower_components/job_light/admin/assets/images/avatars/thumb-13.jpg') }}">
                                    </div>
                                    <div class="info">
                                        <span class="title text-semibold">Marshall Nichols</span>
                                        <span class="sub-title">{{ __('messages.profile') }}</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="#">
                            <i class="ti-settings p-r-10"></i>
                            <span>{{ __('messages.setting') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ti-pencil p-r-10"></i>
                            <span>{{ __('messages.edit-profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ti-email p-r-10"></i>
                            <span>{{ __('messages.cv') }}</span> </a>
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

@include('layouts.employee_nav');
