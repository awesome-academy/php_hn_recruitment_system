@extends('layouts.main')
@section('main-content')
    <!-- jp register wrapper start -->
    <div class="register_section">
        <!-- register_form_wrapper -->
        <div class="register_tab_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul id="tabOne" class="nav register-tabs">
                                <li class="active">
                                    <a href="#contentOne-1" data-toggle="tab">
                                        {{ __('messages.personal-account') }}
                                        <br><span>{{ __('messages.personal-title') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#contentOne-2" data-toggle="tab">
                                        {{ __('messages.company-account') }}
                                        <br> <span>{{ __('messages.company-title') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active register_left_form" id="contentOne-1">
                                    <form action="{{ route('register.employee') }}" method="post" id="employee-register">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    placeholder="{{ __('messages.name') }}*">
                                                @error('name', 'employee_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="email" value="{{ old('email') }}"
                                                    placeholder="{{ __('messages.email') }}*">
                                                @error('email', 'employee_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="password" value="{{ old('password') }}"
                                                    placeholder=" {{ __('messages.password') }}*">
                                                @error('password', 'employee_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="password_confirmation" value=""
                                                    placeholder="{{ __('messages.confirm-password') }}*">
                                            </div>

                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="check-box text-center">
                                                    <input type="checkbox" name="shipping-option" id="account-option_1">
                                                    &ensp;
                                                    <label for="account-option_1">{{ __('messages.agree') }} <a href="#"
                                                            class="check_box_anchr">{{ __('messages.term') }}</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login_btn_wrapper">
                                            <button id="login-submit">{{ __('messages.register') }}</button>
                                        </div>
                                    </form>
                                    <div class="login_message">
                                        <p>
                                            {{ __('messages.already-member') }}
                                            <a href="{{ route('login') }}"> {{ __('messages.login-here') }} </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab-pane fade register_left_form" id="contentOne-2">
                                    <form action="{{ route('register.employer') }}" method="post" id="employer-register">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    placeholder="{{ __('messages.company-name') }}*">
                                                @error('name', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="email" value="{{ old('email') }}"
                                                    placeholder="{{ __('messages.email') }}*">
                                                @error('email', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="password" value="{{ old('password') }}"
                                                    placeholder="{{ __('messages.password') }}*">
                                                @error('password', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="password_confirmation" value=""
                                                    placeholder="{{ __('messages.confirm-password') }}*">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                                    placeholder="{{ __('messages.phone') }}">
                                                @error('phone_number', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="website" value="{{ old('website') }}"
                                                    placeholder="{{ __('messages.website') }}">
                                                @error('website', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="address" value="{{ old('address') }}"
                                                    placeholder="{{ __('messages.address') }}">
                                                @error('address', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="industry" value="{{ old('industry') }}"
                                                    placeholder="{{ __('messages.industry') }}">
                                                @error('industry', 'employer_registration')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="check-box text-center">
                                                    <input type="checkbox" name="shipping-option" id="account-option_2">
                                                    &ensp;
                                                    <label for="account-option_2">{{ __('messages.agree') }} <a href=""
                                                            class="check_box_anchr">{{ __('messages.term') }}</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login_btn_wrapper">
                                            <button id="login-submit">{{ __('messages.register') }}</button>
                                        </div>
                                    </form>
                                    <div class="login_message">
                                        <p>{{ __('messages.already-member') }}
                                            <a href="{{ route('login') }}">{{ __('messages.login-here') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jp register wrapper end -->
@endsection
