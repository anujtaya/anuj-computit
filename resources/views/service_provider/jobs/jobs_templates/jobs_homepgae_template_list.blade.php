@foreach($jobs as $job)
<li class="list-group-item m-1 card-1 border-0 fs--2" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
    <div class="d-flex bd-highlight">
        <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
    </div>
    <div class="d-flex bd-highlight">
        <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}} {{$job->city}} {{$job->postcode}}</div>
        <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
            @if($job->status == 'OPEN')
            <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated zoomIn" style="border-radius:20px!important;">Open</span>
            @endif 
        </div>
    </div>
    <div class="d-flex bd-highlight">
        <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
    </div>
</li>
@endforeach
@if(count($jobs) == 0) 
<div class="text-center p-3 fs--1">
      <!-- <img src="{{asset('images/svg/l2l_empty.svg')}}" alt="" style="opacity:0.4;width:200px"  class="img-fluid" alt="Responsive image"> -->
      <i class="fas fa-circle-notch fs-2 theme-color fa-spin"></i>
      <br>
      <br>
      <span>We are still looking for Job that matches your profile. Please stay tuned..</span>
      <br><br>
  </div>
@endif