@extends('layouts.service_seeker_master')
@section('content')
@push('header-script')
<script src="{{asset('/js/service_seeker/service_seeker_home.js')}}?v=51"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/lib/anypic/anypicker-all.min.css')}}" />
<script type="text/javascript" src="{{asset('/lib/anypic/anypicker.min.js')}}"></script>
@endpush
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-4 p-0 border-d"  id="view_box_1">
         @include('service_seeker.main_view')
      </div>
      <div class="col-lg-4 p-0 border-d"  id="view_box_2" style="display:none;">
         @include('service_seeker.service_wizard')
      </div>
   </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection