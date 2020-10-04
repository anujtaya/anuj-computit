<ul class="list-group fs--1" id="service_provider_filter_ul_list" style="overflow:scroll; height:640px;">
   <!-- board job type -->
  @foreach($jobs as $job)
    @if($job->service_provider_id != null)
        @if($job->service_provider_id == Auth::id())
        <li class="list-group-item mb-2 ml-2 mr-2 border p-0" style="cursor:pointer;" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);"> 
            <div class="d-flex bd-highlight pl-2 pr-2 pt-2">
              <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
            </div>
            <div class="d-flex pl-2 pr-2 bd-highlight">
              <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}} {{$job->city}} {{$job->postcode}}</div>
              <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                  @if($job->status == 'OPEN')
                  <span class="badge  badge-success  p-2  fs--2 font-weight-normal " style="border-radius:20px!important;">Open</span>
                  @elseif($job->status == 'APPROVED')
                    <span class="badge  badge-success  p-2  fs--2 font-weight-normal " style="border-radius:20px!important;">Approved</span>
                  @elseif($job->status == 'ONTRIP')
                    <span class="badge  badge-warning  p-2  fs--2 font-weight-normal  " style="border-radius:20px!important;">On-Trip</span>
                  @elseif($job->status == 'ARRIVED')
                    <span class="badge  badge-secondary  p-2  fs--2 font-weight-normal " style="border-radius:20px!important;">Arrived</span>
                  @elseif($job->status == 'STARTED')
                    <span class="badge  badge-warning  p-2 fs--2 font-weight-normal " style="border-radius:20px!important;">In-Progress</span>
                  @elseif($job->status == 'COMPLETED')
                    <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Completed</span>
                  @endif 
              </div>
            </div>
            <div class="d-flex pl-2 pr-2 pb-2 bd-highlight">
              <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
            </div>
        </li>
        @endif
      @else
        <li class="list-group-item mb-2 ml-2 mr-2 border p-0" style="cursor:pointer;" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
              <div class="d-flex bd-highlight pl-2 pr-2 pt-2">
                <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
              </div>
              <div class="d-flex pl-2 pr-2 bd-highlight">
                <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}} {{$job->city}} {{$job->postcode}}</div>
                <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                    @if($job->status == 'OPEN')
                    <span class="badge  badge-success  p-2  fs--2 font-weight-normal " style="border-radius:20px!important;">Open</span>
                    @endif 
                </div>
              </div>
              <div class="d-flex pl-2 pr-2 pb-2 bd-highlight">
                <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
              </div>
          </li>
      @endif 
  @endforeach
  @if(count($jobs) == 0) 
  <div class="text-center p-3">
      <img src="{{asset('images/svg/l2l_empty.svg')}}" alt="" style="opacity:0.4;height:150px;" class="img-fluid" alt="Service provider empty jobs image art">
      <br>
      <br>
      <span>Looks like you haven’t offered any quotes to eligible Service Seekers in your area. Please engage in a job and come back later.</span>
      <br><br>
  </div>
  @endif
</ul>