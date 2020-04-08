@if($conversation_current != null)
<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{number_format($conversation_current->json['offer'],2)}}</span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <a href="{{route('service_seeker_job_conversation', [$conversation_current->job_id, $conversation_current->service_provider_id])}}" class="fs--1 btn btn-sm btn-white theme-color card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="text-center p-3">
         <img src="{{asset('images/svg/l2l_welcome.svg')}}" alt="" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
         <br><br>
         <p>
            Your Service Provider notified us that he has reached your Job location. 
            Please treat each other with respect.
            He will require a Job Pin from you in order to start the job. If you can't locate him
            please contact him using the messages section of this job. 
         </p>
         <div>
         <span class="border text-monospace fs-1  p-2">
         Job Pin: 
         {{$job->job_pin}}</span>
         </div>
      </div>
</div>
<script>
   //update the job status to tracking if user click on the start navigation button.`
   var CSRF_TOKEN = "{{csrf_token()}}";
   //tracking service code goes here

</script>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif