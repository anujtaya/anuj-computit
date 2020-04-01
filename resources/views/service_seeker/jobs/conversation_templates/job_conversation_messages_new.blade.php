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