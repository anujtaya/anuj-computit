@extends('layouts.service_provider_guest_master')
@section('content')
@stack('header-script')
<script src="{{asset('/js/service_provider/service_provider_home_renderer_list_demo.js')}}?v={{rand(1,1000)}}"></script>
<script src="{{asset('/js/service_provider/service_provider_home_map_list_view.js')}}?v={{rand(1,1000)}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="{{asset('/js/third/pulltorefresh.umd.js')}}"></script>
@stack('header-style')
<link rel="stylesheet" href="{{asset('css/common/preloader.css')}}?v=8"/>
<style>
   .modal-backdrop {
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 10;
   background-color:transparent!important;
   }
   .pac-container {
   background-color: #FFF;
   z-index: 20;
   position: fixed;
   display: inline-block;
   float: left;
   }
   .modal{
   z-index: 20;   
   }
</style>
<div class="row m-0" style="height:100%;">
   <div class="col-lg-12 theme-background-color shadow-sm bg-white p-0 border-d" style="z-index:19!important;height:10%!important;">
      <div class="row m-0">
         <div class="col-8 pl-2 pt-3 pb-3">
            <div class="p-0 bd-highlight">
               <a class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" href="{{route('guest_service_provider_home')}}">
               <i class="fas fa-globe"></i> Map View
               </a>
            </div>
         </div>
         <div class="col-4 pl-2 pt-3 pb-3 text-right">
            <div class="p-0 bd-highlight">
               <a class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" href="{{route('login')}}" onclick="toggle_animation(true);">
                  Login
               </a>
            </div>
            <!-- <div class="nav-item dropdown">
               <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img src="data:image/png;base64,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"  class="" 
                  height="40" width="40" style="border-radius:50%;" 
                  alt="Sevrice Provider profile image.">
               </a>
               <div class="dropdown-menu dropdown-menu-right shadow-sm py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white py-1">
                     <span class="dropdown-item theme-color" href="#" onclick="$('#user_no_account_message_modal').modal('show');" >Profile</span>
                     <span class="dropdown-item theme-color" href="#" onclick="$('#user_no_account_message_modal').modal('show');" >Notifications</span>
                     <span class="dropdown-item theme-color" href="#" onclick="$('#user_no_account_message_modal').modal('show');" >Job History</span>
                     <span class="dropdown-item theme-color" href="#" onclick="$('#user_no_account_message_modal').modal('show');">Help</span>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
   </div>
   <div class="col-lg-12 bg-white p-0" style="height:18%!important;z-index:2;">
      <div class="row mb-0 m-0 border-bottom">
         <!-- location update  -->
         <div class="col-12 p-0 border-bottom bg-white">
            <div class="d-flex fs--2 bd-highlight">
               <div class="p-2 bd-highlight"  onclick="handle_automatc_loc_update_failure();" id="user_current_saved_location">
                  Fetching your location...
               </div>
               <div class="ml-auto p-2 bd-highlight"> 
               </div>
            </div>
         </div>
         <div class="col-12 fs--2 pt-1 pb-1 pr-1 pl-1 text-muted bg-white">
            <div class="d-flex bd-highlight">
               <div class="flex-grow-1 bd-highlight">
                  <a class="btn btn-sm theme-color border fs--2" href="#" role="button" id="sp_jobs_filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-sort-amount-up-alt"></i> Sort
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <span class="dropdown-item" onclick="filter_service_provider_jobs('DISTANCE',true);" style="cursor: pointer">DISTANCE</span>
                     <span class="dropdown-item" onclick="filter_service_provider_jobs('RECENT',true);" style="cursor: pointer">RECENT</span>
                  </div>
               </div>
               <div class=" bd-highlight">
                  <span class="float-left">
                  Updated <span id="update_refresh_counter_el">0</span> sec ago.
                  </span>
               </div>
            </div>
         </div>     
         <div class="col-12 fs--2 pt-1 pb-1 pr-1 pl-1 text-muted bg-white">
            <div class="input-group">
               <input type="text" class="form-control form-control-sm" placeholder="Enter keywords.." aria-label="Sort result by string search" aria-describedby="basic-search-1" id="basic-search-1" onkeyup="filter_service_provider_jobs(current_filter_choice);">
               <div class="input-group-append">
                  <span class="input-group-text fs--2" id="basic-search-1" onclick="$('#basic-search-1').val('')">Clear</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-12 pl-1 pr-1" style="height:50%!important;">
      <!-- job list contianer display  -->
      <ul class="list-group fs--2" style="overflow:scroll;height:100%;" id="job_list_display">
         <!-- autopupulate area  -->
      </ul>
   </div>
   <div  class="col-lg-12 p-0" style="height:18%!important;">
      @include('service_provider.demo.bottom_navigation_bar')
   </div>
</div>
<div class="modal fade" id="map_job_detail_modal_popup"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow">
         <div class="modal-body">
            <div class="pb-1 w-100 bd-highlight  font-weight-bold theme-color cjtfs" id="map_job_detail_modal_title">
               --
            </div>
            <div class="pb-1 flex-shrink-1 fs--2" id="map_job_detail_modal_category">
               --
            </div>
            <div class="fs--2">
               <i class="fas fa-map-marker-alt"></i> <span id="map_job_detail_modal_location">--</span>
            </div>
            <div class="fs--2">
               <i class="far fa-calendar-alt"></i> <span id="map_job_detail_modal_datetime">--</span>
            </div>
            <div class="text-muted font-italic bg-light p-2 mb-1 mt-1 fs--2 rounded"  id="map_job_detail_modal_description">
               --
            </div>
         </div>
         <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm fs--1 btn-secondary text-white" data-dismiss="modal">Dismiss</button> -->
            <a id="map_job_detail_modal_link" onclick="toggle_animation(true);" class="btn theme-background-color fs--1  shadow-lg btn-block">Open Job</a>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="user_location_modal_manual_popup" tabindex="-1" role="dialog" aria-labelledby="user_location_modal_manual_popup_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow">
         <div class="modal-body" style="min-height:300px;">
            <i class="fas fa-map-marker-alt display-1 text-danger"></i>
            <br><br>
            <p>Please provide your current location: </p>
            <input type="text" class="form form-control form-control-sm" id="user_location_modal_manual_popup_input" onFocus="initAutocomplete()" placeholder="Enter your location here.."/>
            <br>
            <span>Or</span>
            <br>
            <br>
            <button class="btn btn-sm  theme-background-color border-0 fs--1 shadow" onclick="update_sp_location();"><i class="fas fa-location-arrow"></i> Use Device Location</button>
         </div>
      </div>
   </div>
</div>
<div id="map" style="display:none;">
</div>
<script>
   var app_url = "{{URL::to('/')}}";
   var service_provider_jobs_fetch_url = "{{route('guest_service_provider_jobs_fetch_all')}}";
   var jobs = [];
   var CSRF_TOKEN = "{{csrf_token()}}"
   var preloader_container =  document.getElementById("preloader_display");
   var job_list_container = document.getElementById("job_list_display");
   var update_refresh_count = 0;
   var update_interval;
   var current_suburb = "";
   var current_lat = "";
   var current_lng = "";
   var enable_geocoder = false;
   var current_filter_choice = 'RECENT';


   window.onload = function() {
      update_interval =  setInterval(function(){ filter_service_provider_jobs(current_filter_choice) }, 25000);
      setInterval(update_refresh_count_display, 5000);
      //initialize the service provider location setup
      if(current_lat == '') {
         update_sp_location();
      } else {
         filter_service_provider_jobs(current_filter_choice);
      }
   }
   
   var filter_settings = {
      'distance_filter' : true,
      'ratings_filter' : false,
      'date_filter' : true
   }

   //pull to refresh code
   PullToRefresh.init({
   mainElement: '#job_list_display', // above which element?
   onRefresh: function (done) {
      done(); 
      filter_service_provider_jobs(current_filter_choice);   
   }
   });
</script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection