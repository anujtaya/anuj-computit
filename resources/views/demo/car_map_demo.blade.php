@extends('layouts.app')
@section('content')
<script src="{{asset('/car_map_demo.js')}}?v={{rand(1,100)}}"></script>
<style></style>
<div class="container fs--1">
   <div class="form-group">
      <label for="exampleInputEmail1">Start Address</label>
      <input type="text" class="form-control" id="start_address" aria-describedby="emailHelp" value="">
   </div>
   <div class="form-group">
      <label for="exampleInputEmail1">End Address</label>
      <input type="text" class="form-control" id="end_address">
   </div>
   <button onclick="animate_marker();" class="btn btn-primary text-white">Submit</button>
   <!-- map div -->
   <div id="map" class="text-center " style="min-width:900px important; min-height:440px!important; position: relative;overflow: hidden;"></div>
   <!-- end map div  -->
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
@endsection