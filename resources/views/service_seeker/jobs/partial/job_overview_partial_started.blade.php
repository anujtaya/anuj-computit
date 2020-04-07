@if($conversation_current != null)
<style>
   .modal-backdrop {
   position:;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 0;
   background-color:transparent;
   }
   .fade {
      transition: opacity .15s linear;
   }
</style>
<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1"><span class="fs--1">$</span>{{number_format($job_price,2)}}</span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <a href="{{route('service_seeker_job_conversation', [$conversation_current->job_id, $conversation_current->service_provider_id])}}" class="fs--1 btn btn-sm btn-white theme-color card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="p-0 mt-2">
      <ul class="list-group fs--1 border-light border" style="overflow:scroll; height:440px;">
         @foreach($job_extras as $extra)
            <li class="list-group-item mb-1-0  border" style="border-style:dashed!important;">
               <div class="d-flex bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color">
                     {{$extra->quantity}} ×  {{$extra->name}}
                  </div>
                  <div class="pb-2 ml-auto"><span class="fs--2">$</span>{{number_format(($extra->quantity * $extra->price),2)}}</div>
               </div>
               <div class="d-flex bd-highlight fs--2">
                  <div class="pb-2 bd-highlight">{{$extra->description}}</div>
               </div>
            </li>
         @endforeach
         @if(count($job_extras) == 0)
            <span class="text-warning m-2">No job extras currently assigned to this job.</span>
         @endif 
      </ul>
   </div>
</div>
<script>
   var app_url_job_update_completed ="{{route('service_provider_job_update_status_cancelontrip')}}";
   var CSRF_TOKEN = "{{csrf_token()}}";
</script>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif