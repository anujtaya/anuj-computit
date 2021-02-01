<div class="p-0 fs--1">
   <!-- service provider list and map toggle controller switch  -->
   <div class="d-flex bd-highlight">
      <div class=" flex-grow-1 bd-highlight">
         <div class="dropleft">
            <a class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white" href="#" role="button" id="ss_job_filter_offer_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort-amount-up-alt"></i> Filter
            </a>
            <div class="dropdown-menu">
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers('NONE');" style="cursor: pointer">None</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers('RATING');" style="cursor: pointer">Rating</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers('DISTANCE');" style="cursor: pointer">Distance</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers('PRICEHL');" style="cursor: pointer">Price High - Low</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers('PRICELH');" style="cursor: pointer">Price Low - High</span>
            </div>
         </div>
      </div>
      <div class="p-0 bd-highlight">
         <button class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white"  style="display:none;"id="map_btn" onclick="switch_view_mode('MAP')">
         <i class="fas fa-globe-asia"></i> Map View
         </button>
         <button class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white"  id="list_btn" onclick="switch_view_mode('LIST')">
         <i class="fas fa-list-ol"></i> List View
         </button>
      </div>
   </div>
   <div class="mt-2" id="service_provider_list_view" style="overflow:scroll;display:none;height:550px;scroll-behavior: smooth;">
      @include('service_seeker/jobs/jobs_templates/job_filter_offer')
   </div>
   <div class="mt-2" id="service_provider_map_view" >
      <!-- map div -->
      <div class="" id="map_controls">
         <!-- <div class="d-flex bd-highlight mb-2 ">
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
         </div> -->
      </div>
      <div id="map" class="text-center border border-light" style="min-width:900px important; min-height:550px!important; position: relative;overflow: hidden;">
      </div>
      <!-- end map div  -->
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="map_con_modal_popup" tabindex="-1" role="dialog" aria-labelledby="map_con_modal_popupTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border-0 shadow-sm">
         <div class="modal-body" id="map_sp_info_container">
            
         </div>
      </div>
   </div>
</div>
<!-- end model -->
<script>
   var service_seeker_job_offer_filter_url = "{{route('service_seeker_job_offer_filter')}}";
   var service_seeker_job_offer_map_data_url = "{{route('service_seeker_job_offer_map_data', $job->id)}}";
   var service_seeker_job_request_provider_info_url = "{{route('service_seeker_job_request_provider_info')}}";
   var app_url = "{{URL::to('/')}}";
   var job_lat = "{{$job->job_lat}}";
   var job_lng = "{{$job->job_lng}}";
   var job_id = "{{$job->id}}";
   var first_load = true;
   
   window.onload = function() {
       //switch view to map for testing
       //switch_view_mode('MAP');
       load_conversation_map_data();
       filter_service_seeker_job_offers(null);
       setInterval(() => {
          load_conversation_map_data();
       }, 5000);
   }
   
   function switch_view_mode(str) {
         if(str == 'MAP'){
            $("#service_provider_list_view").hide();
            $("#service_provider_map_view").show();
            $("#map_btn").hide();
            $("#list_btn").fadeIn();
            $("#list_btn").addClass('animated zoomIn');
            setTimeout(function(){  $("#list_btn").removeClass('animated zoomIn '); }, 1000);
         } else if (str == 'LIST'){
            $("#service_provider_map_view").hide();
            $("#service_provider_list_view").show();
            $("#list_btn").hide();
            $("#map_btn").fadeIn();
            $("#map_btn").addClass('animated zoomIn');
            setTimeout(function(){  $("#map_btn").removeClass('animated zoomIn '); }, 1000);
         }
   }


   var current_filter = 'NONE';
   function filter_service_seeker_job_offers(data){
      if(data == null) {
         current_filter = 'NONE';
      } else {
         current_filter = data;
      }
      //console.log(current_filter);
      prog_load_dis(true);
      $.ajax({
            type: "POST",
            url: service_seeker_job_offer_filter_url,
            data: {
            "_token": csrf_token,
            "filter_action": current_filter,
            "job_id" : job_id,
            "job_lat" : job_lat,
            "job_lng" : job_lng
            },
            success: function(results){
               //console.log(results);
               var myUl = $("#service_seeker_job_filter_offer_ul");
               myUl.html(results['html']);
               prog_load_dis(false);
               var filterAnchorTag = document.getElementById('ss_job_filter_offer_dropdown');
               filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + current_filter +")</small>";
            },
            error: function(results, status, err) {
               console.log(err);
               prog_load_dis(false);
            }
      });
   }
   
   
   function load_conversation_map_data(){
      prog_load_dis(true);
      $.ajax({
            type: "POST",
            url: service_seeker_job_offer_map_data_url,
            data: {
            "_token": csrf_token,
            },
            success: function(results){
               populate_conversation_map_data(results);
               prog_load_dis(false);
            },
            error: function(results, status, err) {
               console.log(err);
               prog_load_dis(false);
            }
      });
   }


  
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="{{asset('/js/service_seeker/service_seeker_job_open_map.js')}}?v={{rand(1,1000)}}"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=geometry&places&callback=initMap" async defer></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>