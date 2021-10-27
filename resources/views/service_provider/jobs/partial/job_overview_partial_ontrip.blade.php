<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{$conversation->json['offer']}}</span>
         </div>
         <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}" class="btn btn-sm theme-background-color text-white card-1 fs--1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   @if($job->service_category_id == 9)
   <div class="text-center-d p-0">
      <span>
         This is a delivery type job. Please click on Pick Up Address button to pick Seeker item on timely basis.<br> <br>
         <!-- <br><br> -->
         <div class="bordered text-left">
            <span class="font-weight-bolder">Pick Up Address</span>
            <br>
            <span class="">{{$job->street_number_pickup}} {{$job->street_name_pickup}} {{$job->city_pickup}} {{$job->state_pickup}} {{$job->postcode_pickup}}</span>  
      </span>
      <br> <br>
      </div>
      @if($job->status != 'OPEN')
      <?php
         //detect user mobile agnet
         $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
         $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
         $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
         $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
         $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
         ?>
      @if($iPhone)
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat_pickup}},{{$job->job_lng_pickup}})">Get Pick Up Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @elseif($iPad)
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat_pickup}},{{$job->job_lng_pickup}})">Get Pick Up Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @else
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng2({{$job->job_lat_pickup}},{{$job->job_lng_pickup}})">Get Pick Up Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @endif
      @endif
   </div>
   @else
   <div class="text-center-d p-0">
      <img src="{{asset('images/svg/l2l_order_ride.svg')}}" alt="" style="opacity:0.4;"  width="150px" class="img-fluid" alt="Responsive image">
      <br>
      <br>
      <span>You are now on your way to your Service Seeker's location. Please be there on time. <br> <br>
      @if($job->status != 'OPEN')
      <?php
         //detect user mobile agnet
         $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
         $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
         $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
         $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
         $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
         ?>
      @if($iPhone)
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}})">Get Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @elseif($iPad)
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng3({{$job->job_lat}},{{$job->job_lng}})">Get Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @else
      <button class="btn btn-sm fs--1 theme-background-color card-1" onclick="geocodeLatLng2({{$job->job_lat}},{{$job->job_lng}})">Get Directions <i class="fas fa-location-arrow fs--2"></i></button>
      @endif
      @endif
   </div>
   @endif
   <div class="mt-2">
      <button class="btn btn-sm btn-danger border-0 card-1 fs--1 text-white delay-2s mr-2" onclick="job_cancel_ontrip();">Cancel Trip <i class="fas fa-ban fs--2"></i></butotn>
      <button class="btn btn-sm btn-success border-0 card-1 fs--1 text-white delay-2s" onclick="job_mark_arrived();">Mark Arrived <i class="far fa-check-circle"></i></button> <br> <br>
   </div>
</div>
<script>
   var app_url_job_update_cancelontrip ="{{route('service_provider_job_update_status_cancelontrip')}}";
   var app_url_job_update_mark_arrived ="{{route('service_provider_job_update_status_mark_arrived')}}";
   var CSRF_TOKEN = "{{csrf_token()}}";
   
   function job_cancel_ontrip(){
      //update the job status to ONTRIP
      toggle_animation(true);
      $.ajax({
         type: "POST",
         url: app_url_job_update_cancelontrip,
         data: {
            '_token' : CSRF_TOKEN,
            'job_id': "{{$job->id}}",
         },
         success: function(results) {
               toggle_animation(false);
               if(results == true) {
                  location.reload();
               } else {
                  console.log(false);
               }
         },
         error: function(result, status, err) {
            toggle_animation(false);
            console.log(err);
         }
         });
   }
   
   function job_mark_arrived(){
      //update the job status to ONTRIP
      toggle_animation(true);
      $.ajax({
         type: "POST",
         url: app_url_job_update_mark_arrived,
         data: {
            '_token' : CSRF_TOKEN,
            'job_id': "{{$job->id}}",
         },
         success: function(results) {
               toggle_animation(false);
               if(results == true) {
                  location.reload();
               } else {
                  console.log(false);
               }
         },
         error: function(result, status, err) {
            toggle_animation(false);
            console.log(err);
         }
         });
   }
   
   
</script>