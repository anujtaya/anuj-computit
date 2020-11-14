<div class="" >
   <div class="form-group">
      <label class="" for="service_location_line_1">Confirm Location</label>
      <div class="form-group">
         <input type="text" class="form-control form-control-sm" id="street_number" placeholder="Start typing your address here"  name="user_street_number" value="{{old('user_street_number')}}" onFocus="initAutocomplete()" data-dpmaxz-eid="10" required autocomplete="off">
      </div>
   </div>
</div>
<div class="">
   <div id="map" style="width: 100%; height: 295px!important; position: s;">
   </div>
   <p class="fs--2 mt-3">Drag and drop the marker for precise location:</p>
</div>
<script>
var app_url = "{{url('/')}}";
var job_location_update_url = "{{route('service_seeker_jobs_expired_prepare_job_repost_flow_update_location')}}";
var current_job_id = "{{$job->id}}";
var job_lat = "{{$job->job_lat}}";
var job_lng = "{{$job->job_lng}}";
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>
<script src="{{asset('/js/service_seeker/service_seeker_expired_job_location.js')}}?v={{rand(1,100)}}"></script>

