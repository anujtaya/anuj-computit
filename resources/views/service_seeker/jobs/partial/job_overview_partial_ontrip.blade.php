@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_job_ontrip_map.js')}}?v={{rand(1,1000)}}"></script>
@endpush
@if($conversation_current != null)

<style>
#map_info_window {
   color:blue;
   padding:10px!important;
}

</style>

<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{number_format($conversation_current->json['offer'],2)}}</span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <a href="{{route('service_seeker_job_conversation', [$conversation_current->job_id, $conversation_current->service_provider_id])}}" class="fs--1 btn btn-sm theme-background-color text-white card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div>
      <!-- service provider information -->
      <div class="d-flex bd-highlight mb-3 card-1 rounded">
         <div class="p-2 bd-highlight">  
            <img  src="{{url('/')}}/storage/images/profile/{{$conversation_current->service_provider_information->profile_image_path}}"  
                  onerror="this.src='data:image/png;base64,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'"
                  class="border p-1"  height="45" width="45" style="border-radius:50%;" alt="Service Seeker Profile Image 40*40" type="button" id="dropDownImageBox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         </div>
         <div class="pl-2 pr-2 pt-3 fs--1 bd-highlight">   
              {{$conversation_current->service_provider_information->first}} is on the way to job location. Track him using the Google map below.
          </div>
      </div>
      <!-- live tracking stats  -->
      <div class="d-flex bd-highlight mb-3">
         <div class="p-0 bd-highlight">
            <span class="badge border-0 text-danger fs--1 card-1"><i class="fas fa-circle animated infinite fadeIn fs--2 "></i> Live</span></div>
         <div class="ml-auto p-0 bd-highlight">   <span class="badge theme-color fs--1 card-1" id="service_provider_eta">----</span>   </div>
      </div>
      <!-- map div -->
      <div id="map" class="text-center m-0 rounded card-1" style="min-width:900px important; min-height:400px!important; position: relative;overflow: hidden;"></div>
      <!-- end map div  -->
   </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
<script>
   var service_seeker_job_tracking_url = "{{route('service_seeker_job_tracking_info', $job->service_provider_id)}}";
   var app_url = "{{URL::to('/')}}";
   var job_lat = "{{$job->job_lat}}";
   var job_lng = "{{$job->job_lng}}";
   var service_provider_lat = "{{$conversation_current->service_provider_information->user_lat}}";
   var service_provider_lng = "{{$conversation_current->service_provider_information->user_lng}}";
   var service_provider_loc_update_interval = null;
   var enable_eta = true;
   $( document ).ready(function() {
      load_service_provider_cordinates();
      service_provider_loc_update_interval = setInterval(load_service_provider_cordinates, 20000);
});
  
   function load_service_provider_cordinates(){
      $.ajax({
            type: "POST",
            url: service_seeker_job_tracking_url,
            data: {
               "_token": CSRF_TOKEN,
            },
            success: function(results){
               //console.log(results);
               if(results != false) {
                  update_service_provider_location(results);
               }
            },
            error: function(results, status, err) {
               console.log(err);
            }
      });
   }



</script>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif