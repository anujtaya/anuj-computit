<div class="pl-3 pr-3">
  @if (session('status'))
  <div class="alert alert-success fs--1" role="alert">
     {{ session('status') }}
  </div>
  @endif
  @if (session('error'))
  <div class="alert alert-error fs--1" role="alert">
     {{ session('error') }}
  </div>
  @endif
   <!-- <span id="job_title" class="fs-1">4 Curtains to Clean</span>
      <br><br> -->
  <form action="{{route('service_seeker_job_details_update')}}" method="post" >
    @csrf
    <input type="hidden" name="job_id" value="{{$job->id}}">
   <div class="form-group">
      <label class="font-weight-bold" for="job_date_time">Job Date & Time</label>
      <input type='datetime-local' class="form-control form-control-sm"  id="job_date_time" name="job_date_time" value="">
   </div>
   <div class="form-group">
      <label  class="font-weight-bold" for="exampleInputEmail1">Location</label> <br>
      {{-- Location needs to be converted from latitude and longitude --}}
      <span>54 Jehson Street, Toowong</span>

   </div>
   <div class="form-group">
      <label  class="font-weight-bold" for="exampleInputEmail1">Job Title</label> <br>
      <input name="job_title" class="form-control form-control-sm" value="{{$job->title}}">

   </div>
   <div class="form-group">
      <label class="font-weight-bold" for="exampleInputEmail1">Description</label> <br>
       <input name="job_description" class="form-control form-control-sm" value="{{$job->description}}">


   </div>
   <div class="form-group">
      <button class="btn btn-info btn-sm fs--1 font-weight-normal" type="submit">Save Changes</button>
   </div>
 </form>
</div>
