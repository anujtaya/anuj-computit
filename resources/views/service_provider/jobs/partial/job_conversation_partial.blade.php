<div class="fs--1 mt-2 p-2 " id="scroll-area" style="overflow:scroll; height:500px;scroll-behavior: smooth;">
   <small class="text-muted">Message history</small> <br> <br>
   <!-- conversation offer holder -->
   <div class="media fs--2 w-100 ml-auto  mb-1">
      <div class="media-body ml-2">
         <div class="bg-secondary text-white  py-2 px-3 mb-2 rounded">
         @if($conversation->json != null)
            You have offered to complete this job for ${{number_format($conversation->json['offer'],2)}}. Offer Description: {{$conversation->json['offer_description']}}.
         @else
            You haven’t made any job offers for this job. Please click the Change Offer button to make an offer or use our in app messaging service if you have any questions.
         @endif
         </div>
      </div>
   </div>
   <!-- first message as job description -->
   <div class="media fs--2 w-50   mb-1">
      <div class="media-body ml-2">
         <div class=" theme-background-color text-white  py-2 px-3 mb-2 rounded" style="background:#399BDB!important;color:white!important;">
            <span class="">Job Category:</span>
            <p class="text-white mb-0 "><i>{{$job->service_category_name}} - {{$job->service_subcategory_name}}</i></p>
            <span class="">Job Title:</span>
            <p class="text-white mb-0 "><i>{{$job->title}}</i></p>
            <span class="">Job Description:</span>
            <p class=" text-white mb-0 "><i>{{$job->description}}</i></p>
         </div>
         <p class="small  ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($conversation->created_at))}}</p>
      </div>
   </div>
   @foreach($msgs as $msg)
   <!-- Reciever Message  -->
   @if(Auth::user()->id == $msg->user_id)
   <div class="media fs--2 w-50 ml-auto mb-1">
      <div class="media-body">
         <div class="theme-background-color py-2 px-3 mb-2 rounded">
            <p class="text-small mb-0 text-white text-break">{{$msg->text}}</p>
         </div>
         <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
      </div>
   </div>
   @else
   <!-- sender message -->
   <div class="media fs--2 w-50 mb-1">
      <div class="media-body ml-2">
         <div class="text-white  py-2 px-3 mb-2 rounded" style="background:#399BDB!important;color:white!important;">
            <p class="text-small text-white mb-0 ">{{$msg->text}}</p>
         </div>
         <p class="small  ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
      </div>
   </div>
   @endif
   @endforeach
</div>
<div class="p-2 sticky-bottom  bg-white border-top fs--1">
   <div class="d-flex bd-highlight mb-2">
      <div class="p-2 flex-grow-1 bd-highlight"> 
         <div class="text-left" onclick="open_msg_box();"><i class="fas fa-comments theme-color"></i> Tap to message</div>
      </div>
      @if($job->status == "OPEN")
      <div class=" bd-highlight">
         <button class="btn btn-sm theme-background-color card-1 border-0 fs--1 text-white ml-2" style="border-radius:20px;" onclick="open_job_offer_modal();"  data-target="#job_make_offer" style="border-radius:20px;" href="#" role="button"  aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-exchange-alt"></i> Change Offer
         </button>
      </div>
      @endif
      @if($job->status != "OPEN")
      <div class=" bd-highlight">
         <a class="btn btn-sm theme-background-color card-1 border-0 fs--1 text-white ml-2" style="border-radius:20px;" onclick="toggle_animation(true);"  style="border-radius:20px;" href="{{route('service_provider_conversation_redirect_image',$job->id)}}">
         <i class="fas fa-camera"></i> Add Photo
         </a>
      </div>
      @endif
   </div>
</div>
<!-- add job offer modal window -->
@include('service_provider.jobs.modals.job_offer_modal')
@include('service_provider.jobs.modals.job_accepted_modal')
@include('service_provider.jobs.modals.job_msg_modal')
<script>
   var msgs = {!! json_encode($msgs) !!}; // SULTAN - HOME - ELOQUENT DATA FROM BLADE TO JAVASCRIPT
   var conversation_id = "{{$conversation->id}}";
   var service_provider_offer_exists_url = "{{ route('service_provider_offer_exists')}}";
   var service_provider_offer_accept_check_url = "{{ route('service_provider_offer_accept_check')}}";
   var job_status = "{{$job->status}}";
   var job_id = "{{$job->id}}";
   var user_id = "{{Auth::id()}}";

      $( document ).ready(function() {
        var elem = document.getElementById('scroll-area');
        elem.scrollTop = elem.scrollHeight;
      });
   
      function open_msg_box(){
         $('#job_msg_modal').modal("show");    
      }

      function close_msg_box(){
         $('#job_msg_modal').modal("hide");    
      }

      // $('#service_provider_conversation_message').on('keyup', function (event) {
      //    filter_text();
      // });

      function open_job_offer_modal(){
      	   toggle_animation(true);
      	   //check if the provider has already made an offer
      	   $.ajax({
             type: "post",
             url: service_provider_offer_exists_url,
             data: {
               "_token": csrf_token,
               "job_id":job_id,
             },
             success: function(results){
                console.log(results);
               if(results['json'] != null){
                 $("#job_offer").val(results['json']['offer']);
                 $("#job_offer_description").val(results['json']['offer_description']);
               }
               $('#job_make_offer_modal').modal("show");
      		   toggle_animation(false);
             },
             error: function(results, status, err) {
                 console.log(err);
             }
         });
         }
   
   let src = '{{asset('/sounds/soft_notification.mp3')}}';
   let audio = new Audio(src);
</script>