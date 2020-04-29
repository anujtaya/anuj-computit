@extends('layouts.service_seeker_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home_starter_map.js')}}?v={{rand(1,100)}}"></script>
@endpush

<!-- page specific styles -->
<style>
   #map {
   position: relative;
   width: 100%;
   height: 90%;
   background: #eee;
   }
   #wrapper { position: relative; }
   #over_map_bottom { position: absolute; bottom: 10%; left: 0px; z-index: 99;min-width:100%;padding:10px; }
   #over_map_top { position: absolute; top: 2%; left: 0px; z-index: 99;min-width:100%;padding:10px; }
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
<!-- end style  -->
<div class="wrapper">
   <div id="map"  style="min-width:100%!important;"></div>
   <div id="over_map_bottom" class="text-center">
      <span id="user_current_saved_location" class="bg-white p-1 fs--1" style="border-radius:20px;">{{Auth::user()->user_full_address}}</span><br>
      <a class="btn btn-block btn-sm theme-background-color btn-lg fs-1 mt-2" style="border-radius:20px;" href="{{route('service_seeker_home')}}?showBooking=on" onclick="toggle_animation(true);">I want work done</a>
      <a class="btn btn-block btn-sm btn-lg fs-1  mt-2" style="border-radius:20px;background:#5D29BA!important;color:white!important;" href="{{route('service_provider_home')}}" onclick="toggle_animation(true);">I want to work.</a>
   </div>
   <div id="over_map_top" >
      @if(count($jobs) > 0)
         <div class="bg-white fs--1 card-1 theme-color p-3" style="border-radius:20px;">
            <a href="{{route('service_seeker_jobs')}}" class="text-decoration-none theme-color" onclick="toggle_animation(true);">You currently have jobs pending on your job board. Tap here to go to jobs tab <i class="fas fa-arrow-right"></i></a> 
         </div>
      @endif
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="user_location_modal_manual_popup" tabindex="-1" role="dialog" aria-labelledby="user_location_modal_manual_popup_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <!-- <i class="fas fa-exclamation-triangle display-1 text-danger"></i> -->
            <br><br>
            <p>Unable to update location automatically, please type in your address below.</p>
            <input type="text" class="form form-control" id="user_location_modal_manual_popup_input" onFocus="initAutocomplete()"/>
            <br>
            <button class="btn btn-danger text-white" style="border-radius:30px;" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
<!-- script to control the map function -->
<script>
var app_url = "{{URL::to('/')}}";
var current_suburb = "{{Auth::user()->user_city}}";
var current_lat = "{{Auth::user()->user_lat}}";
var current_lng = "{{Auth::user()->user_lng}}";
//user service provider location update url to update user current address
var seeker_update_current_location = "{{route('service_seeker_services_location_update')}}";
var update_location_on_load = false;

window.onload = function() {
   if(current_lat == '' || update_location_on_load) {
      update_user_location();
   }
}
</script>
<!-- end map control script  -->
@endsection
@include('service_seeker.bottom_navigation_bar')