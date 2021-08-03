@extends('layouts.master')
@section('main-content')
    <div class="main-content">
        <div class="card">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="avt-model">
                        <img src="{{ asset('bower_components/job_light/images/content/blog_client_img.jpg') }}" alt="">
                        <div class="m-t-25">
                            <button data-toggle="modal" data-target="#modal-lg"
                                class="btn btn-info avt-upload-btn">{{ __('messages.select-image') }}</button>
                        </div>
                        <!-- Modal START-->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="container">
                                        <div class="wrapper">
                                            <div class="image">
                                                <img src="" class="avt-upload-image">
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <div class="text">
                                                    {{ __('messages.no-file') }}
                                                </div>
                                            </div>
                                            <div id="cancel-btn">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="file-name">
                                                {{ __('messages.filename-here') }}
                                            </div>
                                        </div>
                                        <button id="custom-btn">{{ __('messages.choose-file') }}</button>
                                        <input id="default-btn" type="file" hidden>
                                        <div class="modal-btn">
                                            <button class="btn btn-cancel"
                                                data-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <button class="btn btn-save"
                                                data-dismiss="modal">{{ __('messages.save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-h-10">
                        <form class="m-t-15" method="POST" action="">
                            @csrf
                            @method("PATCH")
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('messages.name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.phone') }}</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="{{ __('messages.phone') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.gender') }}</label>
                                <div class="col-sm-10">
                                    <div class="m-t-10">
                                        <div class="radio d-inline m-r-15">
                                            <input id="horizontalFormRadio1" name="horizontalForm" type="radio" checked="">
                                            <label for="horizontalFormRadio1">{{ __('messages.male') }}</label>
                                        </div>
                                        <div class="radio d-inline m-r-15">
                                            <input id="horizontalFormRadio2" name="horizontalForm" type="radio">
                                            <label for="horizontalFormRadio2">{{ __('messages.female') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.dob') }}</label>
                                <div class="col-sm-10">
                                    <div class="input-daterange" data-plugin="datepicker">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="icon-input">
                                                    <i class="mdi mdi-calendar"></i>
                                                    <input type="text" class="form-control" name="start">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.address') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('messages.address') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.description') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        placeholder="{{ __('messages.description') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.skill') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.certification') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 col-form-label control-label text-sm-right">{{ __('messages.industry') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('messages.industry') }}">
                                </div>
                            </div>
                            <div class="text-sm-right">
                                <button class="btn btn-default">{{ __('messages.reset') }}</button>
                                <button class="btn btn-gradient-success">{{ __('messages.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
