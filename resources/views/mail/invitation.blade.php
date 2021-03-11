@component('mail::message')
{{ __('You have been invited to join')}} {{config('app.name')}},


@component('mail::button', ['url' => $acceptUrl])
{{ __('Accept Invitation') }}
@endcomponent


@endcomponent
