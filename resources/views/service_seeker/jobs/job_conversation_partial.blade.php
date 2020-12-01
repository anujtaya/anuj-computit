<div class="fs--1  p-1 " id="scroll-area" style="overflow:scroll; height:500px;scroll-behavior: smooth;">
   <small class="text-muted">Message History</small> <br> <br>
   <!-- conversation offer holder -->
   <div class="media fs--2 w-100 ml-auto ">
      <div class="media-body ml-2">
         <div class="bg-secondary text-white  py-2 px-3 mb-2 rounded" style="color:white!important;">
            @if($conversation->json != null)
               Service Provider {{$conversation->service_provider_profile->first}} has offered to complete this job for ${{number_format($conversation->json['offer'],2)}}.
               Offer Description: {{$conversation->json['offer_description']}}.
            @else
               It looks like Service Provider {{$conversation->service_provider_profile->first}} is interested in doing this job but hasn't made any offer. You can send him messages and ask any questions that 
               you might have.
            @endif
         </div>
      </div>
   </div>
   <!-- first message as job description -->
   <div class="media fs--2 w-50 ml-auto ">
      <div class="media-body ml-2">
         <div class=" text-white  py-2 px-3 mb-2 rounded theme-background-color">
            <span class="">Job Category:</span>
            <p class="text-white mb-0 "><i>{{$job->service_category_name}} - {{$job->service_subcategory_name}}</i></p>
            <span class="">Job Title:</span>
            <p class="text-white mb-0 "><i>{{$job->title}}</i></p>
            <span class="">Job Description:</span>
            <p class=" text-white mb-0 "><i>{{$job->description}}</i></p>
         </div>
         <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($conversation->created_at))}}</p>
      </div>
   </div>
   @foreach($msgs as $msg)
   <!-- Reciever Message  -->
   @if(Auth::user()->id == $msg->user_id)
   <div class="media fs--2 w-50 ml-auto">
      <div class="media-body">
         <div class="theme-background-color  py-2 px-3 mb-2 rounded" >
            <p class=" mb-0 text-white text-break">{{$msg->text}}</p>
         </div>
         <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
      </div>
   </div>
   @else
   <!-- sender message -->
   <div class="media fs--2 w-50">
      <div class="media-body ml-2">
         {{-- text message --}}
         <div class=" py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;" >
            <p class=" mb-0 text-white">{{$msg->text}}</p>
         </div>
         <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
      </div>
   </div>
   @endif
   @endforeach
</div>
@include('service_seeker.jobs.modals.job_msg_modal')
<div class="p-2 sticky-bottom  bg-white border-top fs--1">
   <div class="d-flex bd-highlight mb-2">
      <div class="p-2 flex-grow-1 bd-highlight"> 
            <div class="text-left" onclick="open_msg_box();"><i class="fas fa-comments theme-color"></i> Tap here to send message</div>
      </div>
   </div>
</div>
<script>
   var msgs = {!! json_encode($msgs) !!};
   var conversation_id = "{{$conversation->id}}";

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

   let src = '{{asset('/sounds/soft_notification.mp3')}}';
   let audio = new Audio(src);
</script>