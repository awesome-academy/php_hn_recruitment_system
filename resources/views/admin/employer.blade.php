@extends('layouts.admin')
@section('main-content')
    <!-- Page Container START -->
    <div class="page-container">
        <!-- Content Wrapper START -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.company-account') }}</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <input hidden value="{{ route('admin.employer-profiles.index') }}" id="companyData">
                            <input hidden value="{{ route('admin.change_user_status') }}" id="changeStatus">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select data-column="6" class="form-control filter-selector">
                                        <option value="">{{ __('messages.status') }}</option>
                                        <option value="{{ __('messages.active') }}">{{ __('messages.active') }}</option>
                                        <option value="{{ __('messages.inactive') }}">{{ __('messages.inactive') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select data-column="5" class="form-control filter-selector">
                                        <option value="">{{ __('messages.industry') }}</option>
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry }}">{{ $industry }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <table id="company_table" class="table table-hover table-xl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.logo') }}</th>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>{{ __('messages.website') }}</th>
                                        <th>{{ __('messages.industry') }}</th>
                                        <th>{{ __('messages.status') }}</th>
                                        <th>{{ __('messages.view') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                            </table>

                            {{-- Block Confirmation Modal --}}
                            <div class="modal fade" id="modal-sm">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h4 class="m-b-15">{{ __('messages.confirmation') }}</h4>
                                            <p>{{ __('messages.sure-confirm') }}</p>
                                            <div class="m-t-20 text-right">
                                                <button class="btn btn-default" data-dismiss="modal">
                                                    {{ __('messages.cancel') }}
                                                </button>
                                                <button class="btn btn-success btn-block-confirm" data-dismiss="modal">
                                                    {{ __('messages.confirm') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Wrapper END -->
    </div>
    <!-- Page Container END -->
@endsection
