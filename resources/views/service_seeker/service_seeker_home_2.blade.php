@extends('layouts.service_seeker_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home.js')}}?v={{rand(1,100)}}"></script>
<script src="{{asset('/js/service_seeker/service_seeker_home_map.js')}}?v={{rand(1,100)}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<link rel="stylesheet" href="{{asset('/css/third/flatpickr.min.css')}}">
<script src="{{asset('/js/third/flatpickr.js')}}"></script>
@endpush
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-4 p-0 border-d"  id="view_box_1"   >
         @include('service_seeker.main_view')
      </div>
      <div class="col-lg-4 p-0 border-d"  id="view_box_2" style="display:none;">
         @include('service_seeker.service_wizard')
      </div>
   </div>
</div>
<!-- job booking option type modal -->
<div class="modal fade" id="job_booking_option_type_modal" tabindex="-1" role="dialog" aria-labelledby="job_booking_option_type_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <h1 class="fs-1">Almost there!</h1>
            <p class="fs--1 mb-2">
               Post your job on job board so Service providers can contact you with quote prices. We will let you know when someone replies to your job with a quote pricing.
               <br><br>
               <button class="btn theme-background-color text-white card-1" onclick="job_book_via_board();" style="border-radius:30px;">Post to Job Board</button>
            </p>
            Or
            <p class="fs--1 mb-2">
               Find online Service providers and get a response with a quote in less than 5 minutes. Subject to Service Provider availbility in your area.
               <br><br>
               <button class="btn theme-background-color text-white card-1" onclick="job_book_via_instant_selection();" style="border-radius:30px;">Look for Service Providers Now</button>
            </p>
         </div>
      </div>
   </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection