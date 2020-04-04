<div class="fs--1 mt-2 p-2 " id="scroll-area" style="overflow:scroll; height:500px;scroll-behavior: ssmooth;">
   <small class="text-muted">Conversation Log History</small> <br> <br>
   @foreach($msgs as $msg)

   {{-- Reciever Message --}}
   @if(Auth::user()->id == $msg->user_id)
     <div class="media w-50 ml-auto mb-3">
        <div class="media-body">
           <div class="text-right">
              <img src="https://i.pravatar.cc/300" height="25" class="rounded-circle mb-1 " width="25" alt="">
           </div>
           <div class="bg-secondary py-2 px-3 mb-2" style="border-radius:20px">
              <p class="text-small mb-0 text-white text-break">{{$msg->text}}</p>
           </div>
           <!-- <p class="small text-muted">12:00 PM | Aug 13</p> -->
           <p class="small text-muted">{{$msg->msg_created_at}}</p>

        </div>
     </div>
   @else

    {{-- Sender Message --}}
    <div class="media w-50 mb-3">
       <div class="media-body ml-2">
          <img src="https://i.pravatar.cc/301" height="25" class="rounded-circle mb-1" width="25" alt="">
          <span class="pl-2">{{$msg->first}} {{$msg->last}}</span>
          {{-- text message --}}
          <div class="bg-light  py-2 px-3 mb-2" style="border-radius:20px">
             <p class="text-small mb-0 ">{{$msg->text}}</p>
          </div>
          <!-- <p class="small text-muted">12:00 PM | Aug 13</p> -->
          <p class="small text-muted">{{$msg->msg_created_at}}</p> {{-- needs to be converted to the time format above (use carbon) --}}
       </div>
    </div>
    @endif

   @endforeach
<div class="p-2 sticky-bottom  bg-white border-top">
   <div class="d-flex bd-highlight mb-2">
      <div class="p-2 flex-grow-1 bd-highlight">  <label for="">Reply</label></div>
      <div class=" bd-highlight">
         <button class="btn btn-sm theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="send_message({{$conversation->id}});">
         <i class="fas fa-paper-plane"></i> Send
         </button>
      </div>
      <div class="pl-2 bd-highlight"><button class="btn btn-sm theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="alert('Message sent!');">
         <i class="far fa-image"></i> Add Photo
         </button>
      </div>
   </div>
   <div class="form-group m-2" >
      <textarea type="text" class="form-control form-control-sm" rows="3" id="service_seeker_conversation_message" ></textarea>
   </div>
</div>
<script>
var msgs = {!! json_encode($msgs) !!}; // SULTAN - HOME - ELOQUENT DATA FROM BLADE TO JAVASCRIPT
var conversation_id = "{{$conversation->id}}";

   $( document ).ready(function() {
     var elem = document.getElementById('scroll-area');
     elem.scrollTop = elem.scrollHeight;
   });
</script>
