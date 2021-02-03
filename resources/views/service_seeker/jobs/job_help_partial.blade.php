<div class="p-0">
    @if($job->status != 'COMPLETED')
        @if($job->status != 'CANCELLED')
            <p>
                If you have more questions about this job, please free to email us at help@local2local.com.au or you can visit the <a href="{{route('service_seeker_more_help')}}?gobackurl={{route('service_seeker_job',$job->id)}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> of this app to message us directly.
            </p>
        @endif
    @else 
    <p>
    If you have more questions about this job, please free to email us at help@local2local.com.au or you can visit the <a href="{{route('service_seeker_more_help')}}?gobackurl={{route('service_seeker_job',$job->id)}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> of this app to message us directly.
    </p>      
    @endif
    
</div>