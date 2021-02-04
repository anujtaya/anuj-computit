<div class="p-0 fs--1">
    <div class="text-center p-3">
        <img src="{{asset('images/svg/l2l_ss_towing.svg')}}" alt="Job removed from job board" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
        <br><br>
        <p>
            <span class="font-weight-bolder fs-2 theme-color">Job Expired</span> 
            <br><br>
            We are really sorry that Service Providers didn't respond to your job on time. We provided you an option to repost your job and all details will be pre-filled for your job.
            <br><br>
            Please proceed by clicking the button below to repost your job.
        </p>
        <form action="{{route('service_seeker_jobs_expired_prepare_job_repost_flow', $job->id)}}" method="get" onsubmit="toggle_animation(true);">
            @csrf
            <button class="btn btn-success text-white card-1 animated swing btn-sm delay-3s btn-block" type="submit">Repost Job</button>
        </form>
        <a class="btn btn-danger text-white btn-sm fs--1 card-1 btn-block" href="#" data-toggle="modal" data-target="#job_cancel_confirm_modal">Cancel Job</a>
    </div>
</div>
<script>
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">