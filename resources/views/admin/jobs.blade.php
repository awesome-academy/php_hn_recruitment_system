@extends('layouts.admin')

@section('main-content')
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="header-title">{{ __('messages.job-management') }}</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3>{{ __('messages.manage-jobs') }}</h3>
                            <input type="hidden" id="get-jobs-url" value="{{ route('admin.manage-jobs') }}">
                            <table id="jobs-table" class="table table-hover table-xl">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.title') }}</th>
                                        <th>{{ __('messages.company') }}</th>
                                        <th>{{ __('messages.job-close') }}</th>
                                        <th>{{ __('messages.status') }}</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
                                <button class="btn btn-success btn-delete-confirm" data-dismiss="modal">
                                    {{ __('messages.confirm') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/manage_jobs.js') }}"></script>
@endsection
