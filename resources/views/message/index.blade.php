<div class="conversation-header">
    <span class="recipient">
        {{ $receiver->isEmployee() ? $receiver->employeeProfile->name : $receiver->employerProfile->name }}
    </span>
    <ul class="tools">
        <li>
            <a class="text-gray" href="javascript:void(0)">
                <i class="mdi mdi-dots-vertical"></i>
            </a>
        </li>
        <li class="d-md-none">
            <a class="text-gray conversation-toggler" href="javascript:void(0)">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    </ul>
</div>
<div class="conversation-body scrollable overflow-auto">
    @foreach ($messages as $message)
        @if ($message->from_id === Auth::id())
            <div class="msg msg-sent">
                <div class="bubble">
                    <div class="bubble-wrapper">
                        <span>{{ $message->content }}</span>
                    </div>
                </div>
            </div>
        @else
            <div class="msg msg-recipient">
                <div class="user-img">
                    @if ($receiver->isEmployee())
                        <img
                            src="{{ $receiver->employeeProfile->avatar ? asset('images/' . $receiver->employeeProfile->avatar) :
                                        asset(config('user.default_avt')) }}">
                    @else
                        <img
                            src="{{ $receiver->employerProfile->logo ? Storage::url($receiver->employerProfile->logo) :
                                        asset(config('user.default_avt')) }}">
                    @endif
                </div>
                <div class="bubble">
                    <div class="bubble-wrapper">
                        <span>{{ $message->content }}</span>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
