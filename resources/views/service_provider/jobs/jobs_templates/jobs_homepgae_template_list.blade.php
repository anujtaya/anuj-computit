<!-- board job types -->
@foreach($jobs as $job)
<li class="list-group-item   border-0 rounded-0  shadow-sm p-0"  style="border-left: 2px solid #5D29BA!important;cursor:pointer;margin-bottom:0.2em;" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">  
    <div class="d-flex bd-highlight pl-2 pr-2 pt-2">
        <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
    </div>
    <div class="d-flex pl-2 pr-2 bd-highlight">
        <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}} {{$job->city}} {{$job->postcode}}</div>
        <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
            <span class="badge bg-white theme-color  p-2 fs--2 font-weight-normal border font-weight-bolder" style="border-radius:20px!important;">{{ number_format($job->distance,2)}} kms</span>
        </div>
    </div>
    <div class="d-flex pl-2 pr-2 pb-2 bd-highlight">
        <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
    </div>
</li>
@endforeach
@if(count($jobs) == 0) 
<div class="text-center p-3 fs--1">
      <!-- <i class="fas fa-circle-notch fs-2 theme-color fa-spin"></i>
      <br>
      <br> -->
      <span>There are no jobs available in your area. Please come back later.</span>
      <br><br>
  </div>
@endif