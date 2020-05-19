<!-- board job types -->
@foreach($jobs as $job)
<li class="list-group-item mt-2 mb-2 ml-2 mr-2 card-1 border-0  fs--1 p-0"  style="cursor:pointer;" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
    @if($job->job_type == 'INSTANT')
      <div class="bg-warning text-white ml-auto  fs--2 p-2 card-1" style="border-bottom-left-radius:10px;width:30%;">Instant Job</div>
    @elseif($job->job_type == 'BOARD')
      <div class="theme-background-color ml-auto  fs--2 p-2 card-1" style="border-bottom-left-radius:10px;width:40%;">Posted to Job Board</div>
    @endif
    <div class="d-flex bd-highlight pl-2 pr-2 pt-2">
        <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
    </div>
    <div class="d-flex pl-2 pr-2 bd-highlight">
        <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}} {{$job->city}} {{$job->postcode}}</div>
        <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
            <span class="badge bg-white theme-color  p-2 fs--2 font-weight-normal animated zoomIn card-1 font-weight-bolder" style="border-radius:20px!important;">{{ number_format($job->distance,2)}} kms</span>
        </div>
    </div>
    <div class="d-flex pl-2 pr-2 pb-2 bd-highlight">
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