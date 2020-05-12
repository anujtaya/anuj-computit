<ul id="service_seeker_filter_ul_list" class="list-group fs--1" style="overflow:scroll; height:640px;">
  @foreach($jobs as $job)
  <li class="list-group-item mt-2 mb-2 ml-2 mr-2 card-1 border-0  p-0" onclick="location.href= app_url + '/service_seeker/jobs/job/{{$job->id}}';toggle_animation(true);" style="cursor:pointer;">
    @if($job->job_type == 'INSTANT')
      <div class="bg-warning text-white w-50 ml-auto  fs--2 p-2" style="border-bottom-left-radius:10px;">Instant Job</div>
    @elseif($job->job_type == 'BOARD')
      <div class="theme-background-color w-50 ml-auto  fs--2 p-2" style="border-bottom-left-radius:10px;">Posted to Job Board</div>
    @endif
    <div class="d-flex pl-2 pr-2 pt-2 bd-highlight">
      <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{ucfirst($job->title)}}</div>
    </div>
    <div class="d-flex pl-2 pr-2 bd-highlight">
      <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}}, {{$job->city}} {{$job->postcode}}</div>
      <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
          @if($job->status == 'OPEN')
          <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s card-1" style="border-radius:20px!important;">Open</span>
          @elseif($job->status == 'APPROVED')
            <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s card-1" style="border-radius:20px!important;">Approved</span>
          @elseif($job->status == 'ONTRIP')
            <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s card-1" style="border-radius:20px!important;">On-Trip</span>
          @elseif($job->status == 'ARRIVED')
            <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated rubberBand delay-1s card-1" style="border-radius:20px!important;">Arrived</span>
          @elseif($job->status == 'STARTED')
            <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s card-1" style="border-radius:20px!important;">In-Progress</span>
          @elseif($job->status == 'COMPLETED')
            <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal card-1" style="border-radius:20px!important;">Completed</span>
          @endif 
      </div>
    </div>
    <div class="d-flex pl-2 pr-2 pb-2 bd-highlight">
      <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
    </div>
  </li>
   @endforeach
 </ul>

