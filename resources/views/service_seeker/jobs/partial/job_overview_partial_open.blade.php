<div class="p-0 fs--1">
   <!-- service provider list and map toggle controller switch  -->
   <div class="d-flex bd-highlight">
      <div class=" flex-grow-1 bd-highlight">
         <div class="dropleft">
            <a class="btn theme-color card-1 border-d fs--1 bg-white text-muted" href="#" role="button" id="ss_job_filter_offer_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort-amount-up-alt"></i> Filter
            </a>
            <div class="dropdown-menu" aria-labelledby="ss_job_filter_offer_dropdown">
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers($(this));" id="PRICEHL" data-jobOfferFilter="PRICEHL" style="cursor: pointer">Price High - Low</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers($(this));" id="PRICELH" data-jobOfferFilter="PRICELH"  style="cursor: pointer">Price Low - High</span>
            </div>
         </div>
      </div>
      <div class="p-0 bd-highlight">
         <button class="btn theme-color  card-1 border-0 fs--1 bg-white text-muted" id="map_btn" onclick="switch_view_mode('MAP')">
         <i class="fas fa-globe-asia"></i> Map View
         </button>
         <button class="btn theme-color card-1 border-0 fs--1 bg-white text-muted" style="display:none;" id="list_btn" onclick="switch_view_mode('LIST')">
         <i class="fas fa-list-ol"></i> List View
         </button>
      </div>
   </div>
   <div class="mt-2" id="service_provider_list_view" style="overflow:scroll; height:600px;scroll-behavior: smooth;">
      @include('service_seeker/jobs/jobs_templates/job_filter_offer')
   </div>
   <div class="mt-2" id="service_provider_map_view" style="display:none;">
      <!-- map div -->
      <div class="" id="map_controls">
         <div class="d-flex bd-highlight mb-2">
            <div class="mr-auto p-0 bd-highlight">
            </div>
            <div class="p-0 bd-highlight">
               <button   class="btn theme-color btn-sm  card-1 border-0 ml-2 fs--1 bg-white text-muted" onclick="set_display_bounds();">
               <i class="fas fa-globe"></i> Overview
               </button>
               <button   class="btn theme-color btn-sm  card-1 border-0 ml-2 fs--1 bg-white text-muted" onclick="find_closest_marker();">
               <i class="fas fa-arrows-alt-h"></i> Closest
               </button>
               <button   class="btn theme-color btn-sm  card-1 border-0 ml-2 fs--1 bg-white text-muted" onclick="reset_map_position();">
               <i class="fas fa-crosshairs"></i> Reset
               </button>
            </div>
         </div>
      </div>
      <div id="map" class="text-center border border-light" style="min-width:900px important; min-height:550px!important; position: relative;overflow: hidden;">
      </div>
      <!-- end map div  -->
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="map_con_modal_popup" tabindex="-1" role="dialog" aria-labelledby="map_con_modal_popupTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border">
         <div class="modal-body">
            <div class="d-flex bd-highlight mb-2">
               <div class="p-0 mt-1 bd-highlight">
                  <img src="" id="map_con_modal_popup_image" onerror="this.src='data:image/png;base64,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'" class="p-1 border" id="trigger_image" height="40" width="40" style="border-radius:50%;" alt="">
               </div>
               <div class="p-2 bd-highlight">
                  <span class="theme-color" style="font-size: 0.8rem;" id="map_con_modal_popup_name"></span> <br>
                  <span class="" id="map_con_modal_popup_rating"></span> <i class="fas fa-star fs--2 text-warning"></i>
               </div>
               <div class="ml-auto p-0 bd-highlight">
                  <span class="text-success fs-1"><span class="fs--1">$</span><span id="map_con_modal_popup_offer_price"></span></span> <br>
               </div>
            </div>
            <div class="text-muted bg-light p-2 mb-1 fs--2 rounded">
               <i id="map_con_modal_popup_offer_description"></i>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm fs--1 btn-secondary text-white" data-dismiss="modal">Dismiss</button>
            <a href=""  class="btn btn-sm fs--1 theme-background-color" onclick="toggle_animation(true);" id="map_con_modal_popup_conversation_link">Open Messages</a>
         </div>
      </div>
   </div>
</div>
<!-- end model -->
<script>
   var service_seeker_job_offer_filter_url = "{{route('service_seeker_job_offer_filter', $job->id)}}";
   var service_seeker_job_offer_map_data_url = "{{route('service_seeker_job_offer_map_data', $job->id)}}";
   var app_url = "{{URL::to('/')}}";
   var job_lat = "{{$job->job_lat}}";
   var job_lng = "{{$job->job_lng}}";
   
   window.onload = function() {
       //switch view to map for testing
       switch_view_mode('MAP');
       load_conversation_map_data();
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
   
   function filter_service_seeker_job_offers(data){
      toggle_animation(true);
      $.ajax({
            type: "POST",
            url: service_seeker_job_offer_filter_url,
            data: {
            "_token": csrf_token,
            "filter_action": data.attr('data-jobOfferFilter'),
            },
            success: function(results){
            var myUl = $("#service_seeker_job_filter_offer_ul");
               myUl.html(results['html']);
            toggle_animation(false);
            var filterAnchorTag = document.getElementById('ss_job_filter_offer_dropdown');
            filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + data.text()+")</small>";
            },
            error: function(results, status, err) {
               console.log(err);
            }
      });
   }
   
   
   function load_conversation_map_data(){
      $.ajax({
            type: "POST",
            url: service_seeker_job_offer_map_data_url,
            data: {
            "_token": csrf_token,
            },
            success: function(results){
               populate_conversation_map_data(results);
               console.log(results);
            },
            error: function(results, status, err) {
               console.log(err);
            }
      });
   }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="{{asset('/js/service_seeker/service_seeker_job_open_map.js')}}?v={{rand(1,100)}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=geometry&callback=initMap" async defer></script>