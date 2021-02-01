<div class="p-0 fs--1">
   <div class=" p-3">
      <p>
         <span class="font-weight-bolder fs-2 theme-color">Repost Job</span> 
         <br><br>
         Please select date and time and tap on 'Repost Job' the job button to repost the job. If you would like to add images or change description of the job than click on description or images tab and update your job details.
      </p>
      @if(Session::has('expired_job_error'))
      <div class="alert alert-warning fs--1">
         {{Session::pull('expired_job_error')}}
      </div>
      @endif
      <form action="{{route('service_seeker_jobs_expired_prepare_job_repost_flow_set_expired_job_to_open')}}" method="post" onsubmit="toggle_animation(true);">
         @csrf
         <input type="hidden" name="job_id" value="{{$job->id}}">
         <div class="form-group">
            <label  class="font-weight-bold" for="update_job_title">Job Title</label> <br>
            <input name="update_job_title" class="form-control form-control-sm" value="{{$job->title ?: 'Unknown'}}" onchange="$('#job_detail_save_btn').show();">
         </div>
         <div class="form-group">
            <label class="font-weight-bold" for="update_job_description">Description</label> <br>
            <textarea name="update_job_description" class="form-control form-control-sm" id="update_job_description"  rows="2" onchange="$('#job_detail_save_btn').show();">{{$job->description ?: 'Unknown'}}</textarea>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">As soon as possible after this Date and Time:</label>
            <!-- <input type='datetime-local' class="form-control form-control-sm"  name="job_date_time" value="{{\Carbon\Carbon::now()->addDays(1)->format('Y-m-d\TH:i')}}" required> -->
            <div class="input-group input-group-sm mb-3">
               <input class="form-control" type="text" id="ip-de-1" name="job_date_time" value="{{\Carbon\Carbon::now()->addDays(1)->format('h:i A d/m/Y')}}" readonly="readonly" required>
               <div class="input-group-append">
                  <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="fas fa-calendar fs-1"></i> </span>
               </div>
            </div>
         </div>
         <button class="btn btn-success text-white card-1 btn-sm" type="submit">Confirm Repost Job</button>
      </form>
   </div>
</div>
<link rel="stylesheet" type="text/css" href="{{asset('/lib/anypic/anypicker-all.min.css')}}" />
<script type="text/javascript" src="{{asset('/lib/anypic/anypicker.min.js')}}"></script>
<script>
   $(document).ready(function()
    {
        $("#ip-de-1").AnyPicker(
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