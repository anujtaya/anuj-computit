@extends('layouts.service_seeker_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home_map_selector_demo.js')}}?v={{rand(1,100)}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
@endpush
<style>
   #map {
   position: relative;
   width: 100%;
   height: 80%;
   background: #eee;
   }
   #wrapper { position: relative; margin-top:20%;}
   #over_map_bottom { position: absolute; bottom: 2%; left: 0px; z-index: 99;min-width:100%;padding:10px; }
   .modal-backdrop {
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 10;
   }
   .modal{
   z-index: 20;   
   }
</style>
<div class="bg-white p-3 card-1" style="height:20%;">
   <div class="d-flex bd-highlight mb-2">
      <div class="bd-highlight">
         <a href="{{route('guest_service_seeker_home')}}?showBooking=on" class="theme-color" onclick="toggle_animation(true);"><i class="fas fa-arrow-left fs-1 " ></i></a>
      </div>
   </div>
   <div class="theme-color mb-2 fs--1">
      Please choose a Service Provider from the map below and make an instant job request.
   </div>
   <span class="fs--1" id="map_msg"></span>
</div>
<div class="wrapper">
   <div id="map"  style="min-width:100%!important;"></div>
   <div id="over_map_bottom" class="">
      <button class="float-right btn btn-sm bg-white fs--1 card-1" style="border-radius:20px;" onclick="reset_map_position();"><i class="fas fa-crosshairs"></i> Reset</button> <br>
      <a class="btn btn-block btn-sm btn-lg theme-background-color card-1 mt-2" id="post_to_job_board_btn" style="border-radius:20px;" href="{{route('guest_service_provider_home')}}?showBooking=on" onclick="toggle_animation(true);">Post to Job Board Instead</a>
   </div>
</div>

  

<script>
var app_url = "{{URL::to('/')}}";
var guest_service_seeker_draft_job_proider_list_url = "{{route('guest_service_seeker_session_retrieve_session_draft_sp_list')}}";
var current_job_lat = "{{$session_draft_job->job_lat}}";
var current_job_lng = "{{$session_draft_job->job_lng}}";

window.onload = function() {
   fetch_service_providers();
}

</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection


