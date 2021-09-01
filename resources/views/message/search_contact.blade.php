<div class="m-b-30 m-t-20">
    <ul class="list-media">
        @foreach ($contacts as $contact)
            <li class="list-item unread-msg" id="{{ $contact->user_id }}" conversation="{{ $contact->conversation->id ?? ''}}">
                <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                    <div class="media-img">
                        @if (isset($contact->logo))
                            <img
                                src="{{ $contact->logo ? Storage::url($contact->logo) :
                                    asset(config('user.default_avt')) }}">
                        @else
                            <img
                                src="{{ $contact->avatar ? asset('images/' . $contact->avatar) :
                                    asset(config('user.default_avt')) }}">
                        @endif
                        <span class="status success"></span>
                    </div>
                    <div class="info">
                        <span class="title">
                            {{ $contact->name }}
                        </span>
                        <span class="sub-title">
                            {{ $contact->industry }}
                        </span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
