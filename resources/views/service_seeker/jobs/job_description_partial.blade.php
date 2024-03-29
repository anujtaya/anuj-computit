<div class="p-0">
   @if (Session::has('status'))
   <div class="alert alert-success fs--1" role="alert" onclick="this.style.display = 'none';">
      {{ Session::pull('status') }}
   </div>
   @endif
   @if(Session::has('error'))
   <div class="alert alert-error fs--1" role="alert" onclick="this.style.display = 'none';">
      {{ Session::pull('error') }}
   </div>
   @endif 
   <!-- notice section display -->
   @if($job->status == 'OPEN')
   <div class="fs--2 p-2 alert alert-warning border-0">
      Please note that the details of this job can still be changed while the job status is Open. Once the job is approved you will not be able to change the details of the job.
   </div>
   @else
   <div class="fs--2 p-2 alert alert-warning border-0">
      Please note that this job is now approved and cannot be altered. If you need to change anything, you can cancel this job and create a new one.
   </div>
   @endif
   <!-- end notice section display -->
  
  
   @if($job->service_category_id == 9)
      <!--pickup job location -->
      @if($job->status == 'OPEN')
      <br>
      <form action="{{route('service_seeker_job_location_update_pickup')}}" method="post" onsubmit="toggle_animation(true);" method="POST">
         @csrf
         <input type="hidden" name="update_location_pickup_job_id" value="{{$job->id}}">
         <div class="form-group">
            <label for="location_input_pickup">Change Pick-up Location?</label>
            <input type="text" class="form-control form-control-sm" id="location_input_pickup" name="location_input_pickup" onFocus="initAutocompletePickUp()" required/>
         </div>
         <input type="hidden" value="" id="json_location_object_pickup" name="json_location_object_pickup" required>
         <button class="btn btn-sm fs--2 theme-background-color shadow" type="submit">Update Pickup Location</button>
      </form>
      <br>
      <form action="{{route('service_seeker_job_location_update_dropoff')}}" method="post" onsubmit="toggle_animation(true);" method="POST">
         @csrf
         <input type="hidden" name="update_location_dropoff_job_id" value="{{$job->id}}">
         <div class="form-group">
            <label for="location_input_dropoff">Change Drop-off Location?</label>
            <input type="text" class="form-control form-control-sm" id="location_input_dropoff" name="location_input_dropoff" onFocus="initAutocompleteDropOff()" required/>
         </div>
         <input type="hidden" value="" id="json_location_object_dropoff" name="json_location_object_dropoff" required>
         <button class="btn btn-sm fs--2 theme-background-color shadow" type="submit">Update Drop-off Location</button>
      </form>
      @endif
   @else
      <!--drop-off job location -->
      @if($job->status == 'OPEN')
      <br>
      <form action="{{route('service_seeker_job_location_update')}}" method="post" onsubmit="toggle_animation(true);" method="POST">
         @csrf
         <input type="hidden" name="update_location_job_id" value="{{$job->id}}">
         <div class="form-group">
            <label for="location_input">Change Location?</label>
            <input type="text" class="form-control form-control-sm" id="location_input" name="location_input" onFocus="initAutocomplete()" required/>
         </div>
         <input type="hidden" value="" id="json_location_object" name="json_location_object" required>
         <button class="btn btn-sm fs--2 theme-background-color shadow" type="submit">Update Location</button>
      </form>
      @endif
   @endif








   <form action="{{route('service_seeker_job_details_update')}}" method="post" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="update_job_id" value="{{$job->id}}">
      <!-- show pick up address and drop off address if job is delivery job -->
      @if($job->service_category_id == 9)
      <div class="bordered text-left">
         <span class="font-weight-bolder">Pick Up Address</span>
         <br>
         <span class="">{{$job->street_number_pickup}} {{$job->street_name_pickup}} {{$job->city_pickup}} {{$job->state_pickup}} {{$job->postcode_pickup}}</span>  
         </span>
      </div>
      <div class="bordered text-left mt-2">
         <span class="font-weight-bolder">Drop-off Address</span>
         <br>
         <span class="">{{$job->street_number_dropoff}} {{$job->street_name_dropoff}} {{$job->city_dropoff}} {{$job->state_dropoff}} {{$job->postcode_dropoff}}</span>  
         </span>
      </div>
      @else
      <div class="form-group">
         <label  class="font-weight-bold" for="exampleInputEmail1">Job Location</label> <br>
         {{$job->street_number}} {{$job->street_name}}
         {{$job->city ?: ''}} {{$job->state ?: ''}} {{$job->postcode ?: ''}}
      </div>
      @endif
      <div class="form-group mt-2">
         <label class="font-weight-bold" for="job_scheduled_for">Job Schedule Time</label>
         <br>
         {{ date('d/m/Y h:ia', strtotime($job->job_date_time))}}
      </div>
      @if($job->status == 'OPEN')
      <div class="form-group mt-2">
         <label class="font-weight-bold" for="update_job_datetime">Change Schedule Time</label>
         <input type='text' class="form-control form-control-sm"  id="update_job_datetime" name="update_job_datetime" value="{{\Carbon\Carbon::parse($job->job_date_time)->format('h:i A d/m/Y')}}" readonly="readonly" required  onchange="$('#job_detail_save_btn').show();">
      </div>
      <link rel="stylesheet" type="text/css" href="{{asset('/lib/anypic/anypicker-all.min.css')}}" />
      <script type="text/javascript" src="{{asset('/lib/anypic/anypicker.min.js')}}"></script>
      <script>
         $(document).ready(function()
         {
            $("#update_job_datetime").AnyPicker(
            {
               mode: "datetime",
               showComponentLabel: true,
               dateTimeFormat: "hh:mm AA d/M/yyyy",
               onChange: function(iRow, iComp, oSelectedValues)
               {
                     //console.log("Changed Value : " + iRow + " " + iComp + " " + oSelectedValues);
               },
               theme: "Android"
            });
         
         });
      </script>
      @endif
      <div class="form-group">
         <label  class="font-weight-bold" for="update_job_title">Job Title</label> <br>
         <input name="update_job_title" class="form-control form-control-sm" value="{{$job->title ?: 'Unknown'}}" onchange="$('#job_detail_save_btn').show();" @if($job->status != 'OPEN') readonly @endif>
      </div>
      <div class="form-group">
         <label class="font-weight-bold" for="update_job_description">Description</label> <br>
         <textarea name="update_job_description" class="form-control form-control-sm" id="update_job_description"  rows="2" onchange="$('#job_detail_save_btn').show();" @if($job->status != 'OPEN') readonly @endif>{{$job->description ?: 'Unknown'}}</textarea>
      </div>
      <div class="form-group">
         @if($job->status == 'OPEN')
         <button class="btn btn-info btn-sm fs--2 font-weight-normal shadow" type="submit" id="job_detail_save_btn">Save Changes</button>
         @else
         <span class="d-block text-muted fs--2 mt-2">Job details cannot be changed if the job status is not marked as OPEN on job board.</span>
         @endif
      </div>
   </form>
   @if($job->status == 'APPROVED' || $job->status == 'INPROGRESS' || $job->status == 'ONTRIP' || $job->status == 'STARTED' || $job->status == 'OPEN' || $job->status == 'EXPIRED')
   <!-- job cancellation form  -->
   <form action="{{route('service_seeker_job_cancel')}}" method="POST" id="job_cancel_form" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="ss_job_cancel_id" value="{{$job->id}}" required>
      <a class="btn btn-danger text-white btn-sm fs--2 shadow" href="#" data-toggle="modal" data-target="#job_cancel_confirm_modal">Cancel Job</a>
   </form>
   <!-- job cancellation confirm dialog modal -->
   @endif
</div>