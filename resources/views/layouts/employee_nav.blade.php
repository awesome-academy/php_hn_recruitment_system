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
                        <a href="">{{ __('messages.account-info') }}</a>
                    </li>
                    <li class="">
                        <a href="">{{ __('messages.language') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="ti-user"></i>
                    </span>
                    <span class="title">{{ __('messages.edit-profile') }}</span>
                    <span class="arrow">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a
                            href="{{ route('employee-profiles.edit', ['employee_profile' => Auth::user()->employeeProfile->id]) }}">
                            {{ __('messages.personal-info') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('education.index') }}">{{ __('messages.education') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('experiences.index') }}">{{ __('messages.experience') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{ route('template.cv') }}">
                    <span class="icon-holder">
                        <i class="ti-pencil-alt"></i>
                    </span>
                    <span class="title">{{ __('messages.cv') }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{ route('applied_jobs') }}">
                    <span class="icon-holder">
                        <i class="ti-list"></i>
                    </span>
                    <span class="title">{{ __('messages.applied-jobs') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->
