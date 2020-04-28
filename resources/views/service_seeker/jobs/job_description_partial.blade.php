<div class="p-0">
   @if (Session::has('status'))
   <div class="alert alert-success fs--1" role="alert">
      {{ Session::pull('status') }}
   </div>
   @endif
   @if(Session::has('error'))
   <div class="alert alert-error fs--1" role="alert">
      {{ Session::pull('error') }}
   </div>
   @endif 
   <!-- notice section display -->
   <!-- <div class="fs--2 p-2 alert alert-warning border-0 card-1">
      Please note that the details of this job can only be changed when the job status is Open.
      Once the job is approved you will not be able to change the details of the job.
      You will need to cancel the job if you wish to change the detail of the job once its approved.
   </div> -->
   <!-- end notice section display -->
   <form action="{{route('service_seeker_job_details_update')}}" method="post" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="update_job_id" value="{{$job->id}}">
      <div class="form-group">
         <label  class="font-weight-bold" for="exampleInputEmail1">Location</label> <br>
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
            <input type='datetime-local' class="form-control form-control-sm"  id="update_job_datetime" name="update_job_datetime" value="{{\Carbon\Carbon::parse($job->job_date_time)->format('Y-m-d\TH:i:s')}}">
         </div>
      @endif
      <div class="form-group">
         <label  class="font-weight-bold" for="update_job_title">Job Title</label> <br>
         <input name="update_job_title" class="form-control form-control-sm" value="{{$job->title}}">

      </div>
      <div class="form-group">
         <label class="font-weight-bold" for="update_job_description">Description</label> <br>
         <textarea name="update_job_description" class="form-control form-control-sm" id="update_job_description"  rows="2">{{$job->description}}</textarea>
      </div>
      <div class="form-group">
            @if($job->status == 'OPEN')
               <button class="btn btn-info btn-sm fs--1 font-weight-normal" type="submit">Save Changes</button>
            @endif
            @if($job->status == 'APPROVED' || $job->status == 'INPROGRESS' || $job->status == 'ONTRIP' || $job->status == 'STARTED')
            <form action="{{route('service_seeker_job_cancel')}}" method="POST" onclick="toggle_animation(true);">
                @csrf
                <input type="hidden" name="ss_job_cancel_id" value="{{$job->id}}" required>
                <button class="btn btn-danger text-white btn-sm fs--1">Cancel Job</button>
            </form>
            @endif
      </div>
   </form>
   <!-- <div class="fixed-bottom p-2 fs--1 text-center bg-white border-top">Scroll for more <i class="fas fa-angle-double-down fs--2 mt-1"></i></div> -->
</div>
