@extends('layouts.admin')
@section('main-content')
<div class="page-container">
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('messages.job-statistic') }}</h2>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border bottom">
                            <h4 class="card-title">{{ __('messages.job-total') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="m-t-25">
                                <canvas class="chart" id="gradient-chart" style="height: 270px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border bottom">
                            <h4 class="card-title">{{ __('messages.job-type') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="m-t-25">
                                <canvas class="chart" id="bar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('bower_components/job_light/admin/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
