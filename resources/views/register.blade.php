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
                                    <form action="" method="post" id="employee-register">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="name" value=""
                                                    placeholder="{{ __('messages.name') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.email') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="field-name" value=""
                                                    placeholder=" {{ __('messages.password') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="field-name" value=""
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
                                        <p>{{ __('messages.already-member') }} <a href="">
                                                {{ __('messages.login-here') }} </a> </p>
                                    </div>
                                </div>

                                <div class="tab-pane fade register_left_form" id="contentOne-2">
                                    <form action="" method="post" id="employer-register">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.company-name') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value="" placeholder="Email*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                                <input type="password" name="field-name" value=""
                                                    placeholder="{{ __('messages.password') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                                <input type="password" name="field-name" value=""
                                                    placeholder="{{ __('messages.confirm-password') }}*">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.phone') }}">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.website') }}">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.address') }}">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="field-name" value=""
                                                    placeholder="{{ __('messages.industry') }}">
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
                                            <a href="">{{ __('messages.login-here') }}</a>
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
