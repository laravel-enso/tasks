@component('mail::message')
@component('mail::title')
@lang('Task Reminder')
@endcomponent

@lang('This is a reminder for the following task:')

@component('mail::box', ['variant' => 'warning'])
**{{ $name }}**

{{ $description }}
@endcomponent

@component('mail::button', ['url' => $url])
@lang('View Task')
@endcomponent

@component('mail::signature')
@endcomponent
@endcomponent
