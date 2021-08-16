@extends($user->isAdministrator() ? 'layouts.admin' : 'layouts.master')

@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2>{{ __('messages.account-info') }}</h2>
                    <p>{{ __('messages.update-email-password') }}</p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('account_info.update') }}" method="post" class="m-t-30">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ __('messages.email') }}
                                            </label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}">
                                            @error('email')
                                                <p class="alert alert-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ __('messages.current-password') }}*
                                            </label>
                                            <input type="password" class="form-control" name="current_password">
                                            @error('current_password')
                                                <p class="alert alert-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ __('messages.password') }}
                                            </label>
                                            <input type="password" class="form-control" name="new_password">
                                            @error('new_password')
                                                <p class="alert alert-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ __('messages.confirm-password') }}
                                            </label>
                                            <input type="password" class="form-control" name="new_password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="text-sm-right">
                                                    <button class="btn btn-gradient-success">
                                                        {{ __('messages.update') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
