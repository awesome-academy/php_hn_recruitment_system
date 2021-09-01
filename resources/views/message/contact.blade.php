<div class="m-b-30 m-t-20">
    <ul class="list-media">
        @foreach ($conversations as $conversation)
            <li class="list-item unread-msg" id="{{ $conversation->contact->id }}" conversation="{{ $conversation->id }}">
                <input type="hidden" id="conversation-id" value="{{ $conversation->id }}">
                <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                    <div class="media-img">
                        @if ($conversation->contact->isEmployee())
                            <img
                                src="{{ $conversation->contact->employeeProfile->avatar ? asset('images/' . $conversation->contact->employeeProfile->avatar) :
                                    asset(config('user.default_avt')) }}">
                        @else
                            <img
                                src="{{ $conversation->contact->employerProfile->logo ? Storage::url($conversation->contact->employerProfile->logo) :
                                    asset(config('user.default_avt')) }}">
                        @endif
                        <span class="status success"></span>
                    </div>
                    <div class="info">
                        <span class="title">
                            {{ $conversation->contact->isEmployee() ? $conversation->contact->employeeProfile->name :
                                $conversation->contact->employerProfile->name }}
                        </span>
                        <span class="sub-title">
                            @php($message = $conversation->last_message->content)
                            {{ Str::length($message) <= config('user.message_max_length') ? $message :
                                Str::substr($message, 0, config('user.message_max_length')) . '...'}}
                        </span>
                        @if ($conversation->unreadNumber > 0)
                            <div class="float-item">
                                <span class="chat-counter">{{ $conversation->unreadNumber }}</span>
                            </div>
                        @endif
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
