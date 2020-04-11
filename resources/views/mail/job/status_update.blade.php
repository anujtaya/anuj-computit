@component('mail::message' )
# Hi there!

<p>The status of the job with id {{$job->id}} has been changed to "{{$job->status}}". Please navigate to LocaL2LocaL app to know more.</p>

@component('mail::table')
| Job ID       | Job Title         | Status  |
| ------------- |:-------------:| --------:|
| {{$job->id}}     |  {{$job->service_category_name}} - {{$job->service_subcategory_name}}      |  {{$job->status}}      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
