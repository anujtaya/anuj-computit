<div class="p-0">
    @if($job->status != 'COMPLETED')
        @if($job->status != 'CANCELLED')
            <p>
                If you would like to cancel this job. You can do so by clicking 'Cancel Job' button.
                A $10.00 cancellation fee may apply if a job is cancelled after being approved.
                This action cannot be undone.
            </p>
            <form action="{{route('service_seeker_job_cancel')}}" method="POST" onclick="toggle_animation(true);">
                @csrf
                <input type="hidden" name="ss_job_cancel_id" value="{{$job->id}}" required>
                <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
            </form>
        @endif      
    @endif
    <p>
        If you have more questions about this job, please free to email us at help@local2local.com.au or you can visit <a href="{{route('service_seeker_more_help')}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> of this app to message us directly from app. 
    </p>
</div>