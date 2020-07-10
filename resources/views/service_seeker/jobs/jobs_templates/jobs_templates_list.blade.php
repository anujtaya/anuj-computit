<ul id="service_seeker_filter_ul_list" class="list-group fs--2" style="overflow:scroll; height:640px;">
   @foreach($jobs as $job)
   <li class="list-group-item mb-2 ml-1 mr-1 border-0 shadow-sm p-0" onclick="location.href= app_url + '/service_seeker/jobs/job/{{$job->id}}';toggle_animation(true);" style="cursor:pointer;">
      <div class="d-flex pl-2 pr-2 pt-2 bd-highlight">
         <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{ucfirst($job->title)}}</div>
      </div>
      <div class="d-flex pl-2 pr-2 bd-highlight">
         <div class="p-0 bd-highlight" style="min-width:60%!important;">
            <span class="d-block">
            <i class="fas fa-map-marker-alt mr-1"></i>{{$job->suburb}}, {{$job->city}} {{$job->postcode}}
            </span>
            <span class="d-block">
            <i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}
            </span>
         </div>
         <div class="p-0 bd-highlight text-secondary">
            @if($job->status == 'OPEN')
            <span class="badge  badge-success pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Open</span>
            <span class="badge  badge-danger pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">{{$job->conversations}} @if($job->conversations == 1) Offer @else Offers @endif</span>
            @elseif($job->status == 'APPROVED')
            <span class="badge  badge-success pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Approved</span>
            @elseif($job->status == 'ONTRIP')
            <span class="badge  badge-warning pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">On-Trip</span>
            @elseif($job->status == 'ARRIVED')
            <span class="badge  badge-secondary pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Arrived</span>
            @elseif($job->status == 'STARTED')
            <span class="badge  badge-warning pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">In-Progress</span>
            @elseif($job->status == 'COMPLETED')
            <span class="badge  badge-secondary pl-2 pr-2 fs--2 font-weight-normal " style="border-radius:20px!important;">Completed</span>
            @endif      
         </div>
      </div>
   </li>
   @endforeach
</ul>