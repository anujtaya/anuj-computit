@extends('admin_portal.layouts.master')
@push('header-script')
<script type="text/javascript" src="{{asset('js/admin/heatmap.js')}}?v=12"></script>
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
            Map View <button class="btn btn-danger btn-sm float-right ml-2" onclick="resetLocation()">Reset Location</button>
         </div>
         <div class="card-body">
           
            <div class="m-2">
                <div class="slidecontainer">
                    <input type="range" min="1" max="1000" value="50" class="slider" id="myRange">
                    <p>Range (in kms): <span id="demo"></span></p>
                </div>
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
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
var heatmap_fetch_api_url = "{{route('app_portal_admin_maps_heatmap_api_fetch')}}";
var map_user_icon_dot_image = "{{asset('images/map/dot.svg')}}";
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML =  this.value;
  radius =  this.value;
  find_nearby(currentUserMarker.getPosition());
}
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>


@endsection