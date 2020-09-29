@extends('layouts.service_seeker_guest_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home_starter_map_demo.js')}}?v={{rand(1,1000)}}"></script>
@endpush
<!-- page specific styles -->
<style>
   #map {
   position: relative;
   width: 100%;
   height: 89%;
   background: #eee;
   }
   #wrapper { position: relative; }
   #over_map_bottom { position: absolute; bottom: 15%; left: 0px; z-index: 99;min-width:100%;padding:5px; }
   #over_map_top { position: absolute; top:1%; left: 0px; z-index: 99;min-width:100%;padding: 5px; }
   .modal-backdrop {
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 10;
   /* background-color:transparent!important; */
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
   .gm-style .gm-style-iw-c {
   background-color: #5D29BA!important;
   color: white!important;
   padding: 14px!important;
   -webkit-box-shadow: 0 1rem 4rem rgba(0, 0, 0, .175)!important;
   box-shadow: 0 1rem 4rem rgba(0, 0, 0, .175)!important;
   }
   .gm-style .gm-style-iw-t::after {
   background: #5D29BA!important;
   box-shadow: none!important;
   }
   .gm-style .gm-style-iw-d + button  {
   margin: 5px!important;
   }
   .gm-style .gm-style-iw-d + button::after  {
   content:"X"!important;
   color:white!important;
   }
   .gm-style .gm-style-iw-d + button > img  {
   display: none!important;
   }
</style>
<!-- end style  -->
<div class="wrapper">
   <div id="map"  style="min-width:100%!important;"></div>
   <div id="over_map_bottom" class="text-center">
      <span id="user_current_saved_location" class="bg-white p-1 fs--2"></span><br>
      <a class="btn btn-block btn-sm theme-background-color card-1 mt-2" href="{{route('guest_service_seeker_home')}}?showBooking=on&showtutorial=true" onclick="toggle_animation(true);">Service Seeker - I want work done</a>
      <a class="btn btn-block btn-sm card-1 mt-2" style="background:#5D29BA!important;color:white!important;" href="{{route('guest_service_provider_home')}}?showtutorial=true" onclick="toggle_animation(true);">Service Provider - I want to work.</a>
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
   var current_suburb = null;
   var current_lat = null;
   var current_lng = null;
   var update_location_on_load = true;
   var service_categories = @json($categories);
   var enable_geocoder = false;
   
   window.onload = function() {
     if(update_location_on_load) {
         update_user_location();
      }
   }
</script>
<!-- end map control script  -->
@endsection
@include('service_seeker.demo.bottom_navigation_bar')