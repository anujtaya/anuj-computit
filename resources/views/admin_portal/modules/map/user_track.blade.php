@extends('admin_portal.layouts.master')
@push('header-script')
<script type="text/javascript" src="{{asset('js/admin/user_track.js')}}?v={{rand(1,1000)}}"></script>
@endpush
@section('title', 'Admin Portal User Managment -  Edit User')
@section('content')
<Style>
.slidecontainer {
  width: 100%;
}
.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 10px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}
</Style>
<div class="row m-2">
<div class="col-lg-12  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            User trcking map view
         </div>
         <div class="card-body">
           
            <div class="m-2">
                <input type="number" class="form-control" id="user_id" value="" placeholder="Enter user id.."><br>
                <button class="btn btn-primary" onclick="find_user_location();">Fetch Location</button> <br><br>
                Location Activity:
                <div style="overflow-y: scroll; height:100px;" id="scroll_div">
                <ul class="list-group" id="activity" sty>
                 
               </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-12  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            User Location
         </div>
         <div class="card-body">
           
            <div class="m-2">
                <div id="map" class="" style="min-width:900px important; min-height:800px!important;">
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
$.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
         });
var output = document.getElementById("activity");
var heatmap_fetch_api_url = "{{route('app_portal_admin_maps_user_track_api_fetch')}}";


    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>


@endsection