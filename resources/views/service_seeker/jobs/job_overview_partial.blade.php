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
               <!-- 
			   <span class="dropdown-item" onclick="filter_service_seeker_job_offers($(this));" data-jobOfferFilter="RATINGHL" style="cursor: pointer">Rating High - Low</span>
               <span class="dropdown-item" onclick="filter_service_seeker_job_offers($(this));" data-jobOfferFilter="RATINGLH" style="cursor: pointer">Rating Low - High</span>

			   <span class="dropdown-item" >Closest</span> -->
            </div>
         </div>
      </div>
      <div class="p-0 bd-highlight">
         <button class="btn theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="switch_view_mode('MAP')">
         <i class="fas fa-globe-asia"></i> Map View
         </button>
         <button class="btn theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;display:none;" id="list_btn" onclick="switch_view_mode('LIST')">
         <i class="fas fa-list-ol"></i> List View
         </button>
      </div>
   </div>
   <div class="mt-3" id="service_provider_list_view" style="overflow:scroll; height:600px;scroll-behavior: smooth;">
      @include('service_seeker/jobs/jobs_templates/job_filter_offer')
   </div>
   <div class="mt-3" id="service_provider_map_view" style="display:none;">
      <!-- map div -->
      <div id="map" class="text-center shadow-sm" style="min-width:900px important; min-height:550px!important; position: relative;overflow: hidden;">
      </div>
      <!-- end map div  -->
   </div>
</div>
<script>
var service_seeker_job_offer_filter_url = "{{route('service_seeker_job_offer_filter', $job->id)}}";
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
            if(results['conversations'].length == 0){
              myUl.html("No conversations found");
            }else{
              myUl.html(results['html']);
            }
            toggle_animation(false);
			var filterAnchorTag = document.getElementById('ss_job_filter_offer_dropdown');
			filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter (" + data.text()+")";
          },
          error: function(results, status, err) {
              console.log(err);
          }
      });
   }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="{{asset('/js/service_seeker/service_seeker_home_map.js')}}?v={{rand(1,100)}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
