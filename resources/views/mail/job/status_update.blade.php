@component('mail::message' )
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hi there!')
@endif
@endif

<p>The status of the job with id {{$job->id}} has been changed to "{{$job->status}}". Please navigate to LocaL2LocaL app to know more.</p>

@component('mail::table')
| Job ID       | Job Title         | Status  |
| ------------- |:-------------:| --------:|
| {{$job->id}}     |  {{$job->service_category_name}} - {{$job->service_subcategory_name}}      |  {{$job->status}}      |
@endcomponent


@component('mail::button', ['url' => url('/').'/service_seeker/jobs/job/'.$job->id])
View Job
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
