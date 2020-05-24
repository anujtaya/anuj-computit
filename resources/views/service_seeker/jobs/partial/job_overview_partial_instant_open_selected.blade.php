<div class="p-0 fs--1">
   <!-- service provider info -->
   <div class="d-flex  theme-background-color rounded  text-white bd-highlight  card-1">
      <div class="p-2 bd-highlight">
         <img src="{{url('/')}}/guest/storage/images/profile/{{$job->service_provider_profile->profile_image_path}}" class="bg-white p-1 card-1" height="50" width="50"  style="border-radius:50%;" alt="Service Provider profile image" onerror="this.src='data:image/png;base64,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'" >
      </div>
      <div class="p-3 bd-highlight">
         <span>{{$job->service_provider_profile->first}} {{$job->service_provider_profile->last}}</span> <br>
         <span class="fs--1 text-white">Member Since: {{date('Y', strtotime($job->service_provider_profile->created_at))}}</span>
      </div>
   </div>
   <!-- service provider resonse time counter -->
   @php
   $conversation = $job->conversations->where('service_provider_id', $job->service_provider_id)->first();
   @endphp
   @if($conversation != null)
   <div class="text-center mt-4">
      <p>
         Your Service provider <b>{{$job->service_provider_profile->first}}</b> has offered to this job for <b>${{number_format($conversation->json['offer'],2)}}</b>.
         Please click on the Messages button below to accept the offer or contact {{$job->service_provider_profile->first}}  
      </p>
      <a href="{{route('service_seeker_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}" class="btn mt-4 theme-background-color card-1 btn-block bg-white fs--1"  onclick="toggle_animation(true);">
      <i class="fas fa-comments-dollar"></i> Messages
      </a>
   </div>
   <div id="switch_provider_modal_trigger" class="fs--1">
      <button class="btn mt-4 theme-background-color card-1 btn-block bg-white fs--1" onclick="$('#switch_provider_modal_form').submit();">Select a different Service Provider</button>
      <button class="btn mt-4 theme-background-color card-1 btn-block bg-white fs--1" onclick="$('#job_posttojobboard_form').submit();">Post to Job Board</button>
   </div>
   @else 
   <div class="alert alert-info fs--1">
      Waiting for Service Provider Response. We will let you know when Service Provider responds to you Job request. If the Service Provider does not respond in next 20 minutes the timer will expire and you may choose a different Service provider.
   </div>
   <div id="tcc"  class="col-lg-12 mt-4 text-center">
      <span class="fs-2 text-muted" style="font-size:36px;"><span id="time">--:--</span> Minutes</span>
   </div>
   <div id="switch_provider_modal_trigger" style="display:none;">
      <button class="btn mt-4 theme-background-color card-1 btn-block bg-white" onclick="$('#switch_provider_modal_form').submit();">Select a different Service Provider</button>
      <button class="btn mt-4 theme-background-color card-1 btn-block bg-white" onclick="$('#job_posttojobboard_form').submit();">Post to Job Board</button>
   </div>
   @endif
</div>
<!-- choose a different service provider modal dialog -->
<div class="modal fade" id="switch_provider_dialog_modal" tabindex="-1" role="dialog" aria-labelledby="switch_provider_dialog_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centereds" role="document">
      <div class="modal-content border">
         <div class="modal-body">
            <!-- option to select a different service provider  -->
            <div class="text-center" id="job_instant_switch_provider_div">
               <img src="{{asset('/images/svg/l2l_ss_error.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - add user">
               <br>
               <br>
               <p class="fs--1 mb-2">
                  Your Service Provider didn't respond to the job within the defined time limit.
                  You can either select a different Service Provider or Post the job on to Job Board so the Service Provider in your area can respond to you with a price quote on your job. 
                  Select an option from below to continue.
               </p>
               <form class="mb-2" action="{{route('service_seeker_job_instant_reset_job')}}" method="POST" id="switch_provider_modal_form" onsubmit="toggle_animation(true);">
                  @csrf
                  <input type="hidden" name="job_instant_sp_selector_job_id" value="{{$job->id}}" required>
                  <button type="submit" class="btn mt-4 theme-background-color card-1 btn-block bg-white">Choose another Service Provider</button>
               </form>
               Or <br>
               <button class="btn theme-background-color card-1 btn-block bg-white" onclick="$('#job_posttojobboard_form').submit();">Post to Job Board</button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end dialog model -->
@if($conversation != null)
<script>
   window.onload = function() {
      }
   
</script>
@else 
<script>
   window.onload = function() {
      initialize_timer();
      initialize_conversation_check_timer();
      }
</script>
@endif
<script>
   var service_seeker_job_instant_proider_list_url = "{{route('service_seeker_job_instant_provider_list')}}";
   var service_seeker_job_instant_proider_info_url = "{{route('service_seeker_job_instant_provider_info')}}";
   var service_seeker_job_instant_proider_check_conversation_exists =  "{{route('service_seeker_job_instant_provider_check_conversation_exists')}}";
   var app_url = "{{URL::to('/')}}";
   var job_lat = "{{$job->job_lat}}";
   var job_lng = "{{$job->job_lng}}";
   var job_id = "{{$job->id}}";
   var service_provider_id = "{{$job->service_provider_id}}";
   var job_sp_selector_date_time = "{{$job->job_sp_selector_date_time}}";
   var current_time = "{{\Carbon\Carbon::now()}}";
   
   
   function initialize_timer(){
   var js_sp_selector_date_time = new Date(job_sp_selector_date_time);
   var js_current_time = new Date(current_time).getTime();
   var js_seconds_diff =(js_current_time - js_sp_selector_date_time) / 1000;
   var js_diff_minutes = js_seconds_diff / 60;
   var time_left =  (20 - js_diff_minutes) * 60; 
   display = document.querySelector('#time');
   startTimer(time_left, display);
   console.log(time_left);
   }
   var conversation_check_timer;
   function initialize_conversation_check_timer(){
      conversation_check_timer  = setInterval(function () {
         check_conversation_exists();
      }, 5000);
   }
   
   function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var x  = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
   
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
   
    
   
        if (--timer < 0) {
           clearInterval(x);
           clearInterval(conversation_check_timer);
           $("#tcc").fadeOut();
           $("#switch_provider_modal_trigger").show();
           $("#switch_provider_dialog_modal").modal('show');
           // timer = duration;
        } else {
          display.textContent = minutes + ":" + seconds;
        }
   
    }, 1000);
   }
   
   
   function check_conversation_exists(){
      $.ajax({
            type: "POST",
            url: service_seeker_job_instant_proider_check_conversation_exists,
            data: {
               "_token": CSRF_TOKEN,
               "job_id": job_id,
               "service_provider_id": service_provider_id
            },
            success: function(results){
               //console.log(results);
               if(results  == false) {
                  console.log('conversation does not exists');
                  
               } else {
                  location.reload();
                  console.log('conversation exits');
               }
            },
            error: function(results, status, err) {
               console.log(err);
            }
      });
   }
   
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">