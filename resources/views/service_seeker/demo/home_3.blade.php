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
   height: 85%;
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
   z-index: 8;
   }
   .modal{
   z-index: 200;   
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
<div class="bg-white p-3 card-1" style="height:15%;">
   <div class="d-flex bd-highlight mb-2">
      <div class="bd-highlight">
         <a href="{{route('guest_service_seeker_home')}}?showBooking=on" class="theme-color" onclick="toggle_animation(true);"><i class="fas fa-arrow-left fs-1 " ></i></a>
      </div>
   </div>
   <!-- <div class="theme-color mb-2 fs--1">
      Please choose a Service Provider from the map below and make an instant job request.
      </div> -->
   <span class="fs--1" id="map_msg">The map below shows the closest 10 Service Providers near your selected job location.</span>
</div>
<div class="wrapper">
   <div id="map"  style="min-width:100%!important;"></div>
   <div id="over_map_bottom" class="">
      <button class="float-right btn btn-sm bg-white fs--1 card-1" style="border-radius:20px;" onclick="reset_map_position();"><i class="fas fa-crosshairs"></i> Reset</button> <br>
      <a class="btn btn-block  theme-background-color card-1 mt-2" id="post_to_job_board_btn" style="border-radius:20px;" onclick="$('#seeker_login_to_post_job_modal').modal('show');" href="#">Post to Job Board</a>
   </div>
</div>
<script>
   var app_url = "{{URL::to('/')}}";
   var guest_service_seeker_draft_job_proider_list_url = "{{route('guest_service_seeker_session_retrieve_session_draft_sp_list')}}";
   var guest_service_seeker_draft_job_proider_info_url = "{{route('guest_service_seeker_session_retrieve_session_draft_sp_info')}}";
   var current_job_lat = "{{$session_draft_job->job_lat}}";
   var current_job_lng = "{{$session_draft_job->job_lng}}";
   var csrf_token = "{{csrf_token()}}";
   var service_categories = @json($categories);
   
   window.onload = function() {
      //fetch_service_providers();
   }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection
<!-- seeker login to post job modal -->
<div class="modal fade" id="seeker_login_to_post_job_modal" tabindex="-1" role="dialog" aria-labelledby="seeker_login_to_post_job_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_ss_post_online.svg')}}" class="img-fluid" style="width:150px;" alt="Service Seeker - post online">
            <br>
            <br>
            <p class="text-left fs--1 mb-2">
               To post a job you will need to login or register a new account with us to enable this feature.  We will notify you when a Service Provider responds to your job with a price quote.
            </p>
            <a class="btn theme-background-color text-white card-1" href="{{route('login')}}" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Sign Up</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<!-- No user account modal -->
<div class="modal fade" id="user_no_account_message_modal" tabindex="-1" role="dialog" aria-labelledby="user_no_account_message_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_add_user_ss.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - add user">
            <br>
            <br>
            <p class="text-left fs--1 mb-2">
               You are browsing LocaL2LocaL in guest mode with limited features. Please click below if you want to login or register a new account with us to enable all LocaL2LocaL app features.
            </p>
            <a class="btn theme-background-color text-white card-1" href="{{route('login')}}" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Sign Up</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<!-- Service provider profile information details modal -->
<div class="modal fade" id="service_provider_account_information_modal" tabindex="-1" role="dialog" aria-labelledby="service_provider_account_information_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body fs--1" id="service_provider_info_container" style="min-height:300px;">
         </div>
      </div>
   </div>
</div>
<!-- end modal -->