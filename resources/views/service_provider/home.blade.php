@extends('layouts.service_provider_master')
@section('content')
@stack('header-script')
<!-- <script src="{{asset('js/service_provider/service_provider_home.js')}}?v={{rand(1,1000)}}"></script> -->
<script src="{{asset('/js/service_provider/service_provider_home_renderer.js')}}?v={{rand(1,1000)}}"></script>
<script src="{{asset('/js/service_provider/service_provider_home_map.js')}}?v={{rand(1,1000)}}"></script>
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
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 theme-background-color card-1 shadow-sms fixed-top bg-white pl-3 pr-3 border-d" style="z-index:19!important;">
         <div class="row">
            <div class="col-8 pl-2 pt-3 pb-3">
               <div class="p-0 bd-highlight">
                  <button class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="switch_view_mode('MAP')">
                  <i class="fas fa-globe-asia"></i> Map View
                  </button>
                  <button class="btn theme-color  shadow-sm border-0 fs--1 bg-white text-muted" style="border-radius:20px;display:none;" id="list_btn" onclick="switch_view_mode('LIST')">
                  <i class="fas fa-list-ol"></i> List View
                  </button>
               </div>
            </div>
            <div class="col-4 text-right">
               <div class="nav-item dropdown">
                  <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="{{url('/')}}/storage/images/profile/{{Auth::user()->profile_image_path}}"  class="" id="trigger_image" 
                     height="40" width="40" style="border-radius:50%;" 
                     alt="Sevrice Provider profile image."
                     onerror="this.src='data:image/png;base64,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'" >
                  </a>
                  <div class="dropdown-menu dropdown-menu-right card-1 py-0" aria-labelledby="navbarDropdownUser">
                     <div class="bg-white py-1">
                        <a class="dropdown-item theme-color" href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);">Profile</a>
                        <a class="dropdown-item theme-color" href="{{route('service_provider_more_help')}}"  onclick="toggle_animation(true);">Notifications</a>
                        <a class="dropdown-item theme-color"  href="{{route('service_provider_jobs_history')}}"  onclick="toggle_animation(true);">Job History</a>
                        <a class="dropdown-item theme-color" href="{{route('service_provider_more_help')}}" onclick="toggle_animation(true);">Help</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- job list view window -->
   <div class="col-lg-12 p-0" style="margin-top:60px!important;">
      <div class="row mb-0  border-bottom">
         <!-- location update  -->
         <div class="col-12 p-0 border-bottom">
            <div class="d-flex fs--2 bd-highlight">
               <div class="p-2 bd-highlight" id="user_current_saved_location">
                  @if(Auth::user()->user_lat != null)
                  Location set to: <span class="theme-color">{{Auth::user()->user_city}}, {{Auth::user()->user_state}}</span> 
                  @else
                  <span class="text-danger">Please update your service location.</span>
                  @endif      
               </div>
               <div class="ml-auto p-2 bd-highlight"> 
                  <button   class="btn theme-color btn-sm  border fs--2 bg-white text-muted" onclick="update_sp_location();"  style="border-radius:20px;" >
                  <i class="fas fa-redo-alt"></i> Update
                  </button>
               </div>
            </div>
         </div>
         <!-- end location update div -->
         <div class="col-7 pl-2 pt-2 pb-2">
            <a class="btn theme-color btn-sm  border fs--2 bg-white" style="border-radius:20px;" href="#" role="button" id="sp_jobs_filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort-amount-up-alt"></i> Filter
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <span class="dropdown-item" onclick="filter_service_provider_jobs($(this),true);" data-value="Rating" style="cursor: pointer">Rating</span>
               <span class="dropdown-item" onclick="filter_service_provider_jobs($(this),true);" data-value="Distance" style="cursor: pointer">Distance</span>
            </div>
            <a  id="map_refresh_btn" class="btn theme-color btn-sm  border fs--2 bg-white text-muted" onclick="filter_service_provider_jobs(null,false);" style="border-radius:20px; cursor: pointer" >
            <i class="fas fa-redo-alt"></i> Refresh
            </a>
         </div>
         <div class=" col-5 fs--2 pt-2 pb-2 pr-2 text-right text-muted">
            <span id="update_refresh_counter_el">0</span> sec ago.
            <button   class="btn theme-color btn-sm  border fs--2 bg-white text-muted" onclick="reset_map_position();"  style="border-radius:20px;" >
            <i class="fas fa-crosshairs"></i> Reset
            </button>
         </div>
      </div>
      <!-- preloader container display  -->
      <ul class="list-group fs--1 mt-1" id="preloader_display">
         <div class="timeline-wrapper">
            @for($i=0;$i<6;$i++)
            <div class="timeline-item card-1 m-1 border-0">
               <div class="animated-background">
                  <div class="background-masker header-top"></div>
                  <div class="background-masker header-left"></div>
                  <div class="background-masker header-right"></div>
                  <div class="background-masker header-bottom"></div>
                  <div class="background-masker subheader-left"></div>
                  <div class="background-masker subheader-right"></div>
                  <div class="background-masker subheader-bottom"></div>
                  <div class="background-masker content-top"></div>
                  <div class="background-masker content-first-end"></div>
                  <div class="background-masker content-second-line"></div>
                  <div class="background-masker content-second-end"></div>
                  <div class="background-masker content-third-line"></div>
                  <div class="background-masker content-third-end"></div>
               </div>
            </div>
            @endfor
         </div>
      </ul>
      <!-- job list contianer display  -->
      <ul class="list-group m-0 " style="overflow:scroll; height:640px;" id="job_list_display">
         <!-- autopupulate area  -->
      </ul>
   </div>
</div>
<div id="map_view_display" class="" style="display:none;margin-bottom:60px">
   <div id="map" class="text-center " style="min-width:100%!important; min-height:75%!important; overflow: hidden;">
   </div>
</div>
<!-- bootstrap job modal -->
<!-- Modal -->
<div class="modal fade" id="map_job_detail_modal_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border-0 card-2">
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
            <a id="map_job_detail_modal_link" onclick="toggle_animation(true);" class="btn bg-white fs--1 theme-color card-1 btn-block">Open Job</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<!-- Modal -->
<div class="modal fade" id="user_location_modal_manual_popup" tabindex="-1" role="dialog" aria-labelledby="user_location_modal_manual_popup_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:500px;">
            <i class="fas fa-exclamation-triangle display-1 text-danger"></i>
            <br><br>
            <p>Unable to update location automatically, please type in your address below.</p>
            <input type="text" class="form form-control" id="user_location_modal_manual_popup_input" onFocus="initAutocomplete()"/>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<script>
   var app_url = "{{URL::to('/')}}";
   var service_provider_location_update_url = "{{route('service_provider_services_location_update')}}";
   var service_provider_jobs_fetch_url = "{{route('service_provider_jobs_fetch_all')}}";
   var jobs = [];
   var CSRF_TOKEN = "{{csrf_token()}}"
   var preloader_container =  document.getElementById("preloader_display");
   var job_list_container = document.getElementById("job_list_display");
   var update_refresh_count = 0;
   var update_interval;
   var current_suburb = "{{Auth::user()->user_city}}";
   var current_lat = "{{Auth::user()->user_lat}}";
   var current_lng = "{{Auth::user()->user_lng}}";
   
   window.onload = function() {
      //update_interval =  setInterval(fetch_all_jobs, 25000);
      //setInterval(update_refresh_count_display, 5000);
      //initialize the service provider location setup
      if(current_lat == '') {
         update_sp_location();
      } else {
         filter_service_provider_jobs(null,true);
      }
   }
   
   var filter_settings = {
      'distance_filter' : true,
      'ratings_filter' : false,
      'date_filter' : true
   }
   
</script>
@include('service_provider.bottom_navigation_bar')
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection