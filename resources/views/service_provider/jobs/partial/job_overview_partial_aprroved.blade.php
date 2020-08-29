<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{$conversation->json['offer']}}</span>
         </div>
         <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}"  class="btn btn-sm theme-background-color text-white card-1 fs--1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="text-center p-3">
         <img src="{{asset('images/svg/l2l_map_dark.svg')}}" alt="" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
         <br>
         <br>
         <span>Congratulations! Your offer was accepted by The Service Seeker.You can use the button below to get directions to your Seekers Location. Click the button below to get started.</span>
         <br><br>
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
            <button class="btn bg-success card-1 fs--1 text-white animated headShake slow infinite" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}}); start_job_tracking();"><i class="fas fa-location-arrow"></i> Start Trip</button>
            @elseif($iPad)
            <button class="btn bg-success card-1 fs--1 text-white animated headShake slow infinite" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}}); start_job_tracking();"><i class="fas fa-location-arrow"></i> Start Trip</button>
            @else
            <button class="btn bg-success card-1 fs--1 text-white animated headShake slow infinite" onclick="geocodeLatLng2({{$job->job_lat}},{{$job->job_lng}}); start_job_tracking();">Start Trip <i class="fas fa-play fs--2"></i></button>
            @endif
         @endif
      </div>
</div>

<script>
//update the job status to tracking if user click on the start navigation button.`
var app_url_job_update_ontrip ="{{route('service_provider_job_update_status_ontrip')}}";
var CSRF_TOKEN = "{{csrf_token()}}";

function start_job_tracking(){
   //update the job status to ONTRIP
   console.log('Job Status updated to ONTRIP');
   toggle_animation(true);
   $.ajax({
      type: "POST",
      url: app_url_job_update_ontrip,
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
