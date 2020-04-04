
<div class="modal fade" id="jobConversationAcceptOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationAcceptOfferModal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content card-1 border-0">
         <div class="modal-header theme-background-color border-0">
            <span id="jobConversationAcceptOfferModal" style="color: white!important;font-size:0.9rem">Confirm job offer</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_seeker_accept_job', [$job->id, $conversation->id] )}}" method="post">
            @csrf
            <div class="modal-body fs--1">
               <div class="m-1">
                  <div class="form-group">
                     <label class="font-weight-bold" for="exampleInputEmail1">Job Date & Time</label>
                     <br>
                     <span>
                     {{ date('d/m/Y - H:i A', strtotime($job->job_date_time)) }}
                     </span>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="exampleInputEmail1">Location</label> <br>
                     <span>54 Jehson Street, Toowong</span>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="exampleInputEmail1">Job Title</label> <br>
                     <span>{{$job->title}}</span>
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold" for="exampleInputEmail1">Description</label> <br>
                     <span>
                     {{$job->description}}
                     </span>
                  </div>
               </div>
            </div>
            <div class="row m-1">
               <div class="col-6 p-1">
                  <button type="button" class="btn btn-block btn-danger fs--1 text-danger-d text-white"  data-dismiss="modal">Cancel</button>
               </div>
               <div class="col-6 p-1">
                  <button  type="submit" class="btn btn-block btn-success fs--1 text-success-d text-white" >Confirm Offer</button>
               </div>
            </div>
      </div>
      </form>
   </div>
</div>
</div>