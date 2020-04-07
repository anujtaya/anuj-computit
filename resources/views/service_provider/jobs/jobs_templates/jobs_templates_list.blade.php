<ul class="list-group fs--1" id="service_provider_filter_ul_list" style="overflow:scroll; height:640px;">
  @foreach($jobs as $job)
    @if($job->service_provider_id != null)
      @if($job->service_provider_id == Auth::id())
        <li class="list-group-item mt-2 mb-2 ml-2 mr-2 shadow-sm border-light" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
            <div class="d-flex bd-highlight">
              <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
            </div>
            <div class="d-flex bd-highlight">
              <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt"></i> {{$job->city}}, {{$job->postcode}}</div>
              <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                  @if($job->status == 'OPEN')
                  <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Open</span>
                  @elseif($job->status == 'APPROVED')
                    <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Approved</span>
                  @elseif($job->status == 'ONTRIP')
                    <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s " style="border-radius:20px!important;">On-Trip</span>
                  @elseif($job->status == 'ARRIVED')
                    <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Arrived</span>
                  @elseif($job->status == 'STARTED')
                    <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">In-Progress</span>
                  @elseif($job->status == 'COMPLETED')
                    <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Completed</span>
                  @endif 
              </div>
            </div>
            <div class="d-flex bd-highlight">
              <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
            </div>
        </li>
        @endif
      @else
        <li class="list-group-item mt-2 mb-2 ml-2 mr-2 shadow-sm border-light" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
              <div class="d-flex bd-highlight">
                <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
              </div>
              <div class="d-flex bd-highlight">
                <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt"></i> {{$job->city}}, {{$job->postcode}}</div>
                <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                    @if($job->status == 'OPEN')
                    <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Open</span>
                    @elseif($job->status == 'APPROVED')
                      <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Approved</span>
                    @elseif($job->status == 'ONTRIP')
                      <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s " style="border-radius:20px!important;">On-Trip</span>
                    @elseif($job->status == 'ARRIVED')
                      <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Arrived</span>
                    @elseif($job->status == 'STARTED')
                      <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">In-Progress</span>
                    @elseif($job->status == 'COMPLETED')
                      <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Completed</span>
                    @endif 
                </div>
              </div>
              <div class="d-flex bd-highlight">
                <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
              </div>
          </li>
      @endif 
  @endforeach
  @if(count($jobs) == 0) 
  <div class="text-center p-3">
      <img src="{{asset('images/svg/l2l_empty.svg')}}" alt="" style="opacity:0.4;"  class="img-fluid" alt="Responsive image">
      <br>
      <br>
      <span>Looks like you haven't offered any quote to Service Seeker recently. Please come back later.</span>
      <br><br>
  </div>
  @endif
</ul>