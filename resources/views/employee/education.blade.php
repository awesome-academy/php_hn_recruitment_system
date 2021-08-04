@extends('layouts.master')
@section('main-content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-11">
                        <div class="card-body">
                            <div class="table-overflow">
                                <table id="dt-opt" class="table table-hover table-xl">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.school') }}</th>
                                            <th>{{ __('messages.degree') }}</th>
                                            <th>{{ __('messages.field-of-study') }}</th>
                                            <th>{{ __('messages.start-date') }}</th>
                                            <th>{{ __('messages.end-date') }}</th>
                                            <th>{{ __('messages.grade') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="list-media">
                                                    <div class="list-item">
                                                        <div class="media-img">
                                                            <img src="assets/images/avatars/thumb-2.jpg" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <span class="title"></span>
                                                            <span class="sub-title"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-gradient-success"></span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center font-size-18">
                                                <a href="#" class="text-gray m-r-15"><i class="ti-pencil"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#modal-sm"
                                                    class="text-gray"><i class="ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modal-sm">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="m-b-15">{{__('messages.confirmation')}}</h4>
                                                <p>{{__('messages.delete-sure')}}</p>
                                                <div class="m-t-20 text-right">
                                                    <button class="btn btn-default" data-dismiss="modal">
                                                        {{__('messages.cancel')}}
                                                    </button>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="btn btn-primary" data-dismiss="modal"
                                                            type="submit">{{__('messages.confirm')}}
                                                        </button>
                                                    </form>
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
        </div>
    </div>
@endsection
