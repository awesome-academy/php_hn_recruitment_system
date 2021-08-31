@component('mail::message')
# {{ __('Hello') }} {{ $employeeName }},

{{ __('messages.thanks-for-using') }}

{{ __('messages.announcement-title') }} __{{ $jobTitle }}__ - __{{ $employerName }}__.

{{ __('messages.result') }}: __{{ __('messages.approved') }}__.

@component('mail::button', ['url' => url(route('jobs.index'))])
{{ __('messages.browser-more-jobs') }}
@endcomponent

{{ __('messages.best-regard') }},<br>
{{ config('app.name') }}
@endcomponent
