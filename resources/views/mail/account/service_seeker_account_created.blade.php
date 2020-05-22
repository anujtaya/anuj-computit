@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello there!')
@endif
@endif
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach
<p>
   Welcome to the LocaL2LocaL Community. Thank you for taking the time to update your profile and verify your account. You can now start making service requests.
</p>
@component('mail::button', ['url' => $url1])
Watch intro video
@endcomponent
<p>
   Please take a moment to watch these additional videos to learn more about LocaL2LocaL.
</p>
@component('mail::button', ['url' =>$url2])
Watch additional videos
@endcomponent
We look forward to a future where you can earn extra money in your spare time or find a local to assist immediately when you require any service.
{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>LocaL2LocaL Team
@endif
@endcomponent