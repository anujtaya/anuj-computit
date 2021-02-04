@extends('layouts.service_provider_guest_master')
@section('content')
@stack('header-script')
<script src="{{asset('/js/service_provider/service_provider_home_renderer_demo.js')}}?v={{rand(1,1000)}}"></script>
<script src="{{asset('/js/service_provider/service_provider_home_map_demo.js')}}?v={{rand(1,1000)}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
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
   .modal{
   z-index: 20!important;   
   }
</style>
<div class="row m-0" style="height:100%;">
   <div class="col-lg-12 theme-background-color shadow-sm bg-white p-0 border-d" style="z-index:19!important;height:10%!important;">
      <div class="row m-0">
         <div class="col-8 pl-2 pt-3 pb-3">
            <div class="p-0 bd-highlight">
               <a class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" href="{{route('guest_service_provider_home')}}?listview=true">
                  <i class="fas fa-list-ol"></i> List View
               </a>
            </div>
         </div>
         <div class="col-4 pl-2 pt-3 pb-3 text-right">
            <div class="p-0 bd-highlight">
               <a class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" href="{{route('login')}}" onclick="toggle_animation(true);">
                  Login
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-12 bg-white p-0" style="height:5%!important;z-index:2;">
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
         <div class="col-12 fs--2 pt-2 pb-2 pr-2 text-right text-muted bg-white">
            Updated <span id="update_refresh_counter_el">0</span> sec ago.
            <button   class="btn theme-color btn-sm  border fs--2 bg-white text-muted" onclick="set_display_bounds();filter_service_provider_jobs(current_filter_choice,false);" id="map_reset_btn"  >
            <i class="fas fa-redo-alt"></i> Update
            </button>
         </div>
      </div>
   </div>
   <div class="col-lg-12 p-0" style="height:69%!important;">
         <div id="map" style=" width: 100%;height: 100%;">
         </div>
   </div>
   <div  class="col-lg-12 p-0" style="height:16%!important;">
     
   </div> 
 
</div>
@include('service_provider.demo.bottom_navigation_bar')
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
     
      filter_service_provider_jobs(current_filter_choice,false);
      update_interval = setInterval(function(){ filter_service_provider_jobs(current_filter_choice,false) }, 25000);
      setInterval(update_refresh_count_display, 5000);
      //initialize the service provider location setup    
      if(current_lat == '') {
         update_sp_location();
      } else {
         //filter_service_provider_jobs(current_filter_choice,false);
         //update_sp_location();
      }


      // update_interval =  setInterval(function(){ filter_service_provider_jobs(null,false) }, 25000);
      // setInterval(update_refresh_count_display, 5000);
      // //initialize the service provider location setup
      // if(current_lat == '') {
      //    update_sp_location();
      // } else {
      //    filter_service_provider_jobs(null,true);
      // }
      
   }
   
   var filter_settings = {
      'distance_filter' : true,
      'ratings_filter' : false,
      'date_filter' : true
   }
   
</script>
{{-- @include('service_provider.demo.bottom_navigation_bar') --}}
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection