<div class="modal fade" id="jobConversationAcceptOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationAcceptOfferModal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm  border-0">
         <div class="modal-header bg-success border-0">
            <span id="jobConversationAcceptOfferModal" style="color: white!important;font-size:0.9rem">Confirm job offer</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_seeker_accept_job')}}" method="post" onsubmit="toggle_animation(true);">
            @csrf
            <input type="hidden" name="accept_job_id" value="{{$job->id}}" required>
            <input type="hidden" name="accept_conversation_id" value="{{$conversation->id}}" required>

            <div class="modal-body fs--1">
               <div class="fs--1">

              
                  <div class="form-group mb-1">
                     <label class="font-weight-bold mb-0" for="exampleInputEmail1">Offer Price</label>
                     <br>
                     <span>
                     ${{number_format($conversation->json['offer'],2)}}
                     </span>
                  </div>
                  <div class="form-group mb-1">
                     <label class="font-weight-bold mb-0" for="exampleInputEmail1">Offer Description</label>
                     <br>
                     <span>
                     {{$conversation->json['offer_description']}}
                     </span>
                  </div>
                  <div class="form-group mb-1">
                     <label class="font-weight-bold mb-0" for="exampleInputEmail1">Job Date & Time</label>
                     <br>
                     <span>
                     {{ date('d/m/Y - h:i A', strtotime($job->job_date_time)) }}
                     </span>
                  </div>
                  <div class="form-group mb-1">
                     <label  class="font-weight-bold mb-0" for="exampleInputEmail1">Location</label> <br>
                     {{$job->street_number}} {{$job->street_name}} 
                     {{$job->city}} {{$job->state}}, {{$job->postcode}}
                  </div>
                  <div class="form-group mb-1">
                     <label  class="font-weight-bold mb-0" for="exampleInputEmail1">Job Title</label> <br>
                     <span>{{$job->title}}</span>
                  </div>
                  <div class="form-group mb-1">
                     <label class="font-weight-bold mb-0" for="exampleInputEmail1">Description</label> <br>
                     <span>
                     {{$job->description}}
                     </span>
                  </div>
               </div>
               <div class="row mt-3 ml-0 mr-0">
                  <div class="col-12 mb-2 p-0">
                     By clicking the button "Confirm to Proceed" you agree to LocaL2LocaL offer acceptance T&Cs.
                  </div>
                  <div class="col-12 mt-2 p-0">
                     <button  type="submit" class="btn btn-block btn-success fs--1 text-white shadow">Confirm to Proceed</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

@if(request()->has('triggermodal'))
<script>
// display modal if the request contains the triggermodal data input
$( document ).ready(function() {
   $('#jobConversationAcceptOfferModal').modal('show');
});

</script>
@endif