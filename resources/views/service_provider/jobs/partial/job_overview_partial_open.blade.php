<div class="pl-2 pr-3 fs--1">
   <div class="" id="service_provider_list_view" style="overflow:scroll; height:600px;scroll-behavior: smooth;">
      @if($conversation != null)
      <div class="text-center m-1">
         <div class="text-left mb-2">
            @if($conversation->json != null)
               We have succesfully delivered your offering price of <b>${{number_format($conversation->json['offer'],2)}}</b> to the Service Seeker.
               Please wait while we get a response from Service Seeker directly. Look for SMS, Push notification or Email alerts sent by us.
            @else
            You haven’t made any job offers for this job. Please click the Service Seeker below to make an offer or ask a question.
            @endif
         </div>
      </div>
      <li class="list-group-item m-1 border-0 card-1 fs--2" @if($conversation_reply_count != 0 || 1 == 1)  onclick="location.href= '{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}';toggle_animation(true);" @endif>
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 mt-1 bd-highlight">
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$service_seeker_profile->profile_image_path}}" 
            onerror="this.src='data:image/png;base64,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'"   height="40" width="40" style="border-radius:50%;" alt="">
         </div>
         <div class="p-2 bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">{{$service_seeker_profile->first}} {{$service_seeker_profile->last}}</span> <br>
            <span class="text-warning">  @if($service_seeker_profile->rating == null) 5 @else {{$service_seeker_profile->rating}} @endif <i class="fas fa-star"></i></span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <span class="text-success fs-1">
            @if($conversation->json != null)
               <span class="fs--2">$</span>{{number_format($conversation->json['offer'],2)}}</span> <br>
            @else
            <span class="fs--2">No Offer Made</span>
            @endif
         </div>
      </div>
      <div class="text-muted bg-light p-2 mb-1 rounded">
         <i>{{$job->description}}</i>
      </div>
      @php
      $unread_msgs = \App\Conversation::find($conversation->conversation_id)->conversation_messages->where('is_read', false)->where('user_id', '=' ,$service_seeker_profile->id);
      @endphp
      @if(count($unread_msgs) > 0)
      <span class="text-primary font-weight-normal fs--3 p-1 text-danger animated flash infinite"><i class="fas fa-circle text-danger"></i> You have {{count($unread_msgs)}} unread @if(count($unread_msgs) == 1) message @else messages @endif</span> |
      @endif
      <span class="text-muted font-weight-normal fs--3 p-1">{{$conversation_reply_count}} messages</span>
      </li>
      <li class="list-group-item m-1 border-0 card-1 fs--2" >
         <a href="{{route('service_provider_job_conversation_mark_conversation_deleted', [$conversation->job_id, $conversation->service_provider_id])}}'" onclick="toggle_animation(true);" class=" btn theme-background-color btn-block card-1 text-white btn-sm">Delete this Job Conversation?</a>
      </li>
      @else 
      <div class="text-center">
         <span>If you are ready to submit a job offer, please tap the ‘Send Offer’ button below.</span>
         <br><br>
         @if($job->status != "APPROVED")
         <a  class="btn  theme-background-color border-0 btn-block fs--1 shadow" onclick="open_job_offer_modal();"  data-target="#job_make_offer" href="#" role="button"  aria-haspopup="true" aria-expanded="false">
         @if($conversation == null) Send Offer @else Revise Offer @endif
         </a>
         @include('service_provider.jobs.modals.job_offer_modal')
         @endif
         <br><br><br>
         <span>If you have any questions please contact the Service Seeker by tapping the button below.</span>
         <br><br>
         <form action="{{route('service_provider_job_conversation_create')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="service_provider_id" value="{{Auth::id()}}">
            <input type="hidden" name="job_id" value="{{$job->id}}">
            <button type="submit" class="btn  theme-background-color border-0 btn-block fs--1 shadow" href="#">Ask Question?</button>
         </form>  
      </div>
      @endif
   </div>
</div>
<script>
   var service_provider_offer_exists_url = "{{ route('service_provider_offer_exists')}}";
   
      function switch_view_mode(str) {
          if(str == 'MAP'){
              $("#service_provider_list_view").hide();
              $("#service_provider_map_view").show();
              $("#map_btn").hide();
              $("#list_btn").fadeIn();
              $("#list_btn").addClass('animated zoomIn');
              setTimeout(function(){  $("#list_btn").removeClass('animated zoomIn '); }, 1000);
          } else if (str == 'LIST'){
              $("#service_provider_map_view").hide();
              $("#service_provider_list_view").show();
              $("#list_btn").hide();
              $("#map_btn").fadeIn();
              $("#map_btn").addClass('animated zoomIn');
              setTimeout(function(){  $("#map_btn").removeClass('animated zoomIn '); }, 1000);
          }
      }
   
      function open_job_offer_modal(){
   	   toggle_animation(true);
   	   //check if the provider has already made an offer
   	   $.ajax({
          type: "post",
          url: service_provider_offer_exists_url,
          data: {
            "_token": csrf_token,
            "job_id": "{{$job->id}}",
          },
          success: function(results){
            if(results){
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
</script>