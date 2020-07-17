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
   <form action="{{route('service_seeker_job_details_update')}}" method="post" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="update_job_id" value="{{$job->id}}">
      <div class="form-group">
         <label  class="font-weight-bold" for="exampleInputEmail1">Job Location</label> <br>
         {{$job->street_number}} {{$job->street_name}} <br>
         {{$job->city}}<br>{{$job->state}}, {{$job->postcode}}
     
      </div>
      <div class="form-group">
         <label class="font-weight-bold" for="job_scheduled_for">Job Schedule Time</label>
         <br>
         {{ date('d/m/Y h:ia', strtotime($job->job_date_time)) }}
      </div>
      @if($job->status == 'OPEN')
      <div class="form-group">
         <label class="font-weight-bold" for="update_job_datetime">Change Schedule Time</label>
         <input type='datetime-local' class="form-control form-control-sm"  id="update_job_datetime" name="update_job_datetime" value="{{\Carbon\Carbon::parse($job->job_date_time)->format('Y-m-d\TH:i:s')}}" onchange="$('#job_detail_save_btn').show();">
      </div> 
      @endif
      <div class="form-group">
         <label  class="font-weight-bold" for="update_job_title">Job Title</label> <br>
         <input name="update_job_title" class="form-control form-control-sm" value="{{$job->title}}" onchange="$('#job_detail_save_btn').show();">
      </div>
      <div class="form-group">
         <label class="font-weight-bold" for="update_job_description">Description</label> <br>
         <textarea name="update_job_description" class="form-control form-control-sm" id="update_job_description"  rows="2" onchange="$('#job_detail_save_btn').show();">{{$job->description}}</textarea>
      </div>
      <div class="form-group">
         @if($job->status == 'OPEN')
         <button class="btn btn-info btn-sm fs--2 font-weight-normal shadow" type="submit" id="job_detail_save_btn">Save Changes</button>
         @endif
      </div>
   </form>
   @if($job->status == 'APPROVED' || $job->status == 'INPROGRESS' || $job->status == 'ONTRIP' || $job->status == 'STARTED' || $job->status == 'OPEN')
   <!-- job cancellation form  -->
   <form action="{{route('service_seeker_job_cancel')}}" method="POST" id="job_cancel_form" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="ss_job_cancel_id" value="{{$job->id}}" required>
      <a class="btn btn-danger text-white btn-sm fs--2 shadow" href="#" data-toggle="modal" data-target="#job_cancel_confirm_modal">Cancel Job</a>
   </form>
   
   <!-- job cancellation confirm dialog modal -->
   <div class="modal fade" id="job_cancel_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="job_cancel_confirm_modal_title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered-d" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <span class="fs-1">Are you sure?</span>
               <br>
               <br>
               <p>
                  A cancellation fee of $10.00 may apply if the job is cancelled after being approved.
               </p>
               <button class="fs--2 btn-sm btn-danger text-white mr-2" onclick=" $( '#job_cancel_form' ).submit()">Proceed to Cancel</button>
               <button class="fs--2 btn-sm btn-secondary text-white" data-dismiss="modal">Dismiss</button>
            </div>
         </div>
      </div>
   </div>
   @endif
</div>
