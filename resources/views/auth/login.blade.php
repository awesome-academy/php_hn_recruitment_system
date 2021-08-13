@extends('layouts.main')
@section('main-content')
    <!-- jp login wrapper start -->
    <div class="login_section">
        <!-- login_form_wrapper -->
        <div class="login_form_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- login_wrapper -->
                        <h1>{{ __('Login') }}</h1>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="login_wrapper">
                                <div class="formsix-pos">
                                    <div class="form-group i-email">
                                        <input type="email" class="form-control" id="email"
                                            placeholder="{{ __('E-Mail Address') }}" name="email"
                                            value="{{ old('email') }}" autocomplete="email" autofocus>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="formsix-e">
                                    <div class="form-group i-password">
                                        <input type="password" class="form-control" id="password"
                                            placeholder="{{ __('Password') }}" name="password"
                                            autocomplete="current-password">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="login_remember_box">
                                    <label class="control control--checkbox">{{ __('Remember Me') }}
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="control__indicator"></span>
                                    </label>
                                </div>
                                <div class="login_btn_wrapper">
                                    <button id="login-submit">{{ __('Login') }}</button>
                                </div>
                                <div class="login_message">
                                    <p>{{ __('messages.have-no-account') }}<a
                                            href="{{ route('register') }}">&nbsp;{{ __('messages.register-now') }}</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                        <!-- /.login_wrapper-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login_form_wrapper-->
    </div>
    <!-- jp login wrapper end -->
@endsection
