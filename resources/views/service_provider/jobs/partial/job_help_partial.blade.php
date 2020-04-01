<div class="pl-3 pr-3">
    <p>
        As Service Provider you may be eligible to recieve a cancellation fee 
        if a Service Provider cancel a job booking after 10 minutes of accepting the job offer. 
        This applies to all services offered at LocaL2LocaL platform. 
    </p>
    <p>
        If for some reason you are not able to do a a job, 
        please press the cancel button below and the Service Seeker won't be charged a cancellation fee.
    </p>
    <p>
        If you have more questions about this job, please free to email us at help@local2local.com.au or you can visit <a href="{{route('service_provider_more_help')}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> of this app to message us directly from app. 
    </p>
    @if($job->status == 'OPEN')
    @elseif($job->status == 'APPROVED')
    <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
    @elseif($job->status == 'ONTRIP')
    <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
    @elseif($job->status == 'ARRIVED')
    <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
    @elseif($job->status == 'STARTED')
    <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
    @elseif($job->status == 'COMPLETED')
    @endif
</div>