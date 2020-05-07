@extends('layouts.app')
@section('content')
<script src="{{asset('/car_map_demo.js')}}?v={{rand(1,100)}}"></script>
<style>
   .hover-shadow:hover {
   -webkit-box-shadow: 0px 5px 2px -1px rgba(194,194,194,0.96)!important;
   -moz-box-shadow: 0px 5px 2px -1px rgba(194,194,194,0.96)!important;
   box-shadow: 0px 5px 2px -1px rgba(194,194,194,0.96)!important;
   background:#D3D3D3!important;
   color:black!important;
   }
   .hover-shadow:active {
   -webkit-box-shadow: 0px -5px 2px -1px rgba(194,194,194,0.96)!important;
   -moz-box-shadow: 0px -5px 2px -1px rgba(194,194,194,0.96)!important;
   box-shadow: 0px -5px 2px -1px rgba(194,194,194,0.96)!important;
   background:#D3D3D3!important;
   color:black!important;
   }
   .hover-shadow:link{
   box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
   transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
   background:#D3D3D3!important;
   color:black!important;
   }
</style>
<div class="container fs--1 p-3">
   <div class="row centered">
      <div class="col-lg-12 p-3">
         <h5>Links with theme background colors: </h5>
         <a href="#" class="btn btn-sm m-2 theme-background-color text-white card-1">Link Theme (Shadow)</a>
         <a href="#" class="btn btn-sm m-2 theme-background-color text-white card-2">Link Theme (Big Shadow)</a>
         <a href="#" class="btn btn-sm m-2 theme-background-color text-white card-3">Link Theme (Jumbo Shadow)</a>
         <a href="#" class="btn btn-sm m-2 theme-background-color text-white ">Link Theme (No Shadow)</a>
      </div>
      <div class="col-lg-12 p-3">
         <h5>Links with theme text-colors colors: </h5>
         <a href="#" class="btn btn-sm m-2 theme-color">Link Theme (No Shadow)</a>
         <a href="#" class="btn btn-sm m-2 bg-white hover-shadow">Link Theme (Shadow)</a>
      </div>
   </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection