<!-- Side Nav START -->
<div class="side-nav expand-lg">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="ti-settings"></i>
                    </span>
                    <span class="title">{{ __('messages.setting') }}</span>
                    <span class="arrow">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('account_info.show') }}">{{ __('messages.account-info') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('messages.language') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="dropdown-toggle"
                    href="{{ route('employer.profiles.edit', ['profile' => Auth::user()->employerProfile]) }}"
                >
                    <span class="icon-holder">
                        <i class="ti-pencil-alt"></i>
                    </span>
                    <span class="title">{{ __('messages.edit-profile') }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="dropdown-toggle"
                    href="{{ route('employer.jobs', ['profile' => Auth::user()->employerProfile]) }}"
                >
                    <span class="icon-holder">
                        <i class="mdi mdi-briefcase"></i>
                    </span>
                    <span class="title">{{ __('messages.my-jobs') }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{ route('jobs.create') }}">
                    <span class="icon-holder">
                        <i class="mdi mdi-plus-box"></i>
                    </span>
                    <span class="title">{{ __('messages.create-job') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->
