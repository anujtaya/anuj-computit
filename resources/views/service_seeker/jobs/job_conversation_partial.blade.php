<div class="fs--1 mt-2 p-2 " id="scroll-area" style="overflow:scroll; height:500px;scroll-behavior: smooth;">
   <small class="text-muted">Message History</small> <br> <br>
   <!-- conversation offer holder -->
   <div class="media fs--2 w-100 ml-auto  mb-3">
      <div class="media-body ml-2">
         <div class=" theme-background-color text-white  py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;">
            Service Provider {{$conversation->service_provider_profile->first}} has offered to complete this job for ${{number_format($conversation->json['offer'],2)}}.
            <b>Offer Description:</b> {{$conversation->json['offer_description']}}.
         </div>
      </div>
   </div>
   <!-- first message as job description -->
   <div class="media fs--2 w-50 ml-auto mb-2">
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
   <div class="media fs--2 w-50 ml-auto mb-2">
      <div class="media-body">
         <div class="theme-background-color  py-2 px-3 mb-2 rounded" >
            <p class=" mb-0 text-white text-break">{{$msg->text}}</p>
         </div>
         <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
      </div>
   </div>
   @else
   <!-- sender message -->
   <div class="media fs--2 w-50 mb-1">
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
<div class="p-2 sticky-bottom  bg-white border-top">
   <div class="d-flex bd-highlight mb-2">
      <div class="p-2 flex-grow-1 bd-highlight">
         <label for="">Reply</label>
      </div>
      <div class=" bd-highlight">
         <button class="btn btn-sm theme-background-color  card-1 border-0 fs--1 text-white " style="border-radius:20px;" id="map_btn" onclick="send_message({{$conversation->id}});">
         <i class="fas fa-paper-plane"></i> Send
         </button>
      </div>
   </div>
   <div class="form-group m-2" >
      <textarea type="text" class="form-control form-control-sm" rows="3" id="service_seeker_conversation_message" ></textarea>
   </div>
</div>
<script>
   var msgs = {!! json_encode($msgs) !!};
   var conversation_id = "{{$conversation->id}}";
      $( document ).ready(function() {
        var elem = document.getElementById('scroll-area');
        elem.scrollTop = elem.scrollHeight;
      });
   let src = '{{asset('/sounds/soft_notification.mp3')}}';
   let audio = new Audio(src);
</script>