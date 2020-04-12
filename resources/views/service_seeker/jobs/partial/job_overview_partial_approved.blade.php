@if($conversation_current != null)
<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{number_format($conversation_current->json['offer'],2)}}</span>
         </div>
         <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('service_seeker_job_conversation', [$conversation_current->job_id, $conversation_current->service_provider_id])}}" class="fs--1 btn btn-sm btn-white theme-color card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="text-center p-3">
         <img src="{{asset('images/svg/l2l_waiting.svg')}}" alt="" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
         <br><br>
         <p>Please wait for your Service Provider to arrive at your location. We will know when he is on his way so that you can track his live location on the map. Thank you for trusting LocaL2LocaL!</p>
      </div>
</div>

<script>
//update the job status to tracking if user click on the start navigation button.`
var CSRF_TOKEN = "{{csrf_token()}}";
</script>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif