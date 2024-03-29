@extends('layouts.service_seeker_guest_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home_demo.js')}}?v={{rand(1,100)}}"></script>
@endpush
@push('header-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<style>
   .modal-backdrop {
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: -1;
   background-color:transparent!important;
   }
   .modal{
   z-index: 2000000!important;   
   }
</style>
@endpush
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-4 p-0 border-d"  id="view_box_1"   >
           @include('service_seeker.demo.partial.main_view')
      </div>
      <div class="col-lg-4 p-0 border-d bg-white"  id="view_box_2" style="display:none;z-index:10000;">
           @include('service_seeker.demo.partial.service_wizard')
      </div>
   </div>
</div>
@include('service_seeker.demo.bottom_navigation_bar')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection


