<div class="p-0 fs--1">
   <!-- service provider list and map toggle controller switch  -->
   <div class="d-flex bd-highlight">
      <div class=" flex-grow-1 bd-highlight">
        
      </div>
      <div class="p-0 bd-highlight">
        
      </div>
   </div>

   <div class="mt-2" id="service_provider_map_view" >
      <!-- map div -->
      <div class="mt-2 mb-2">
         Please select from available Service Providers..
      </div>
      <div class="" id="map_controls">
         <div class="d-flex bd-highlight mb-2">
            <div class="mr-auto p-0 bd-highlight">
            </div>
            <div class="p-0 bd-highlight">
               <button   class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white" onclick="set_display_bounds();">
               <i class="fas fa-globe"></i> Overview
               </button>
               <button   class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white" onclick="find_closest_marker();">
               <i class="fas fa-arrows-alt-h"></i> Closest
               </button>
               <button   class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white" onclick="reset_map_position();">
               <i class="fas fa-crosshairs"></i> Reset
               </button>
            </div>
         </div>
      </div>
      <div id="map" class="text-center border border-light" style="min-width:900px important; min-height:550px!important; position: relative;overflow: hidden;">
      </div>
   </div>
</div>
<!-- Service provider profile information details modal -->
<div class="modal fade" id="service_provider_account_information_modal" tabindex="-1" role="dialog" aria-labelledby="service_provider_account_information_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body fs--1 p-0" id="service_provider_info_container" style="min-height:300px;">
           
         </div>
      </div>
   </div>
</div>
<script>
   var service_seeker_job_instant_proider_list_url = "{{route('service_seeker_job_instant_provider_list')}}";
   var service_seeker_job_instant_proider_info_url = "{{route('service_seeker_job_instant_provider_info')}}";
   var app_url = "{{URL::to('/')}}";
   var job_lat = "{{$job->job_lat}}";
   var job_lng = "{{$job->job_lng}}";
   var job_id = "{{$job->id}}";
   window.onload = function() {
      fetch_service_providers();
      initialize_service_provider_fetch_timer();
   }
   var provider_fetch_timer;
   function initialize_service_provider_fetch_timer(){
      provider_fetch_timer  = setInterval(function () {
         fetch_service_providers();
      }, 20000);
   }
   
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="{{asset('/js/service_seeker/service_seeker_job_instant_open_map.js')}}?v={{rand(1,100)}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=geometry&callback=initMap" async defer></script>