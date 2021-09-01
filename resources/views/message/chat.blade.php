@extends('layouts.message')
@section('main-content')
    <input type="hidden" id="user-id" value="{{ Auth::id() }}">
    <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="chat chat-app row">
                    <div class="chat-list">
                        <div class="chat-user-tool">
                            <i class="search-icon mdi mdi-magnify p-r-10 font-size-20"></i>
                            <input id="search-contact" placeholder="{{ __('messages.search') }}">
                        </div>
                        <div class="chat-user-list scrollable"></div>
                    </div>
                    <div class="chat-content">
                        <div class="conversation">
                            <div class="conversation-wrapper">
                                <div class="message-content"></div>
                                <div class="conversation-footer">
                                    <button class="upload-btn">
                                        <i class="ti-face-smile"></i>
                                    </button>
                                    <form id="message-form">
                                        <input class="chat-input" type="text" placeholder="{{ __('messages.type-message') }}">
                                        <button class="sent-btn">
                                            <i class="fa fa-send-o"></i>
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
@endsection

@section('addtional_scripts')
    <script src="{{ asset('bower_components/job_light/admin/assets/js/apps/chat.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection
