<div class="pl-3 pr-3">
    <p>
        As a Service Provider you may be eligible to receive a cancellation fee if a Service Seeker cancels a 
        job booking after 10 minutes of you accepting the job offer.
        This applies to all services offered on the  LocaL2LocaL platform
    </p>
    <p>
        If for some reason you are not able to do a job, press the cancel button below,
        and the Service Seeker won't be charged a cancellation fee.
    </p>
    <p>
        If you have more questions about this job, please free to email us
        at help@local2local.com.au or you can visit <a href="{{route('service_provider_more_help')}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> 
        of this app to message us directly from app. 
    </p>
    @if($job->status == 'OPEN')
    @elseif($job->status == 'APPROVED')
        <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
            <textarea name="reason" id="" cols="" rows="3"  class="form-control form-control-sm" placeholder="Please tell us why you are cancelling this job.." required></textarea><br>
            <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
        </form>
    @elseif($job->status == 'ONTRIP')
        <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
            <textarea name="reason" id="" cols="" rows="3"  class="form-control form-control-sm" placeholder="Please tell us why you are cancelling this job.." required></textarea><br>
            <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
        </form>
    @elseif($job->status == 'ARRIVED')
        <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
            <textarea name="reason" id="" cols="" rows="3"  class="form-control form-control-sm" placeholder="Please tell us why you are cancelling this job.." required></textarea><br>
            <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
        </form>
    @elseif($job->status == 'STARTED')
        <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
            <textarea name="reason" id="" cols="" rows="3"  class="form-control form-control-sm" placeholder="Please tell us why you are cancelling this job.." required></textarea><br>
            <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
        </form>
    @elseif($job->status == 'COMPLETED')
    @endif
</div>