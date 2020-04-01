<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{$conversation->json['offer']}}</span>
         </div>
         <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}" class="fs--1 btn btn-sm btn-white theme-color card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="text-center p-3">
         <img src="{{asset('images/svg/l2l_order_ride.svg')}}" alt="" style="opacity:0.4;"  width="150px" class="img-fluid" alt="Responsive image">
         <br>
         <br>
         <span>You are now on your way to Service Seeker location. Please be there on time. <br> <br>
         {{$job->street_number}} {{$job->street_name}}  ,{{$job->city}} ,{{$job->state}} {{$job->postcode}}
          </span> <br> <br>
         <button class="btn btn-sm text-danger border-0 card-1  fs--1 bg-white  delay-2s mr-2" onclick="job_cancel_ontrip();">Cancel Trip <i class="fas fa-ban fs--2"></i></butotn>
         <button class="btn btn-sm text-success border-0 card-1  fs--1 bg-white  delay-2s" onclick="job_mark_arrived();">Mark Arrived <i class="far fa-check-circle"></i></button> <br> <br>
         @if($job->status != 'OPEN')
         <?php
            //detect user mobile agnet
            $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
            $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
            $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
            ?>
         @if($iPhone)
         <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}})"><i class="far fa-location-arrow fs--1"></i> Get Directions</button>
         @elseif($iPad)
         <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}})"><i class="far fa-location-arrow fs--1"></i> Get Directions</button>
         @else
         <button class="btn btn-sm fs--1 text-dark bg-white card-1" onclick="geocodeLatLng2({{$job->job_lat}},{{$job->job_lng}})">Get Directions <i class="fas fa-location-arrow fs--2"></i></button>
         @endif
         @endif
      </div>
</div>

<script>
var app_url_job_update_cancelontrip ="{{route('service_provider_job_update_status_cancelontrip')}}";
var app_url_job_update_mark_arrived ="{{route('service_provider_job_update_status_mark_arrived')}}";
var CSRF_TOKEN = "{{csrf_token()}}";

function job_cancel_ontrip(){
   //update the job status to ONTRIP
   toggle_animation(true);
   $.ajax({
      type: "POST",
      url: app_url_job_update_cancelontrip,
      data: {
         '_token' : CSRF_TOKEN,
         'job_id': "{{$job->id}}",
      },
      success: function(results) {
            toggle_animation(false);
            if(results == true) {
               location.reload();
            } else {
               console.log(false);
            }
      },
      error: function(result, status, err) {
         toggle_animation(false);
         console.log(err);
      }
      });
}

function job_mark_arrived(){
   //update the job status to ONTRIP
   toggle_animation(true);
   $.ajax({
      type: "POST",
      url: app_url_job_update_mark_arrived,
      data: {
         '_token' : CSRF_TOKEN,
         'job_id': "{{$job->id}}",
      },
      success: function(results) {
            toggle_animation(false);
            if(results == true) {
               location.reload();
            } else {
               console.log(false);
            }
      },
      error: function(result, status, err) {
         toggle_animation(false);
         console.log(err);
      }
      });
}


</script>
