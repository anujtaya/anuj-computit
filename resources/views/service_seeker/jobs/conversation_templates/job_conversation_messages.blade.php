@foreach($msgs as $msg)
{{-- Reciever Message --}}
@if(Auth::user()->id == $msg->user_id)
  <div class="media w-50 ml-auto mb-1">
     <div class="media-body">
        <div class="theme-background-color  py-2 px-3 mb-2 rounded" >
           <p class="text-small mb-0 text-white text-break">{{$msg->text}}</p>
        </div>
        <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->created_at))}}</p>

     </div>
  </div>
@else
 {{-- Sender Message --}}
 <div class="media w-50 mb-1">
    <div class="media-body ml-2">
       <div class=" py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;">
          <p class="text-small text-white mb-0">{{$msg->text}}</p>
       </div>
       <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->created_at))}}</p>
    </div>
 </div>
 @endif
@endforeach