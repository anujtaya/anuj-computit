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
      <div class="media fs--2 w-50 mb-1">
         <div class="media-body">
            <div class=" py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;" >
               <p class=" mb-0 text-white">{{$msg->text}}</p>
            </div>
            <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
         </div>
      </div>
      @endif
@endforeach