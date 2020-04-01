<!-- Modal -->
<div class="modal fade" id="jobConversationAcceptOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationAcceptOfferModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none!important; background-color: #5D29BA!important;">
        <h5 class="modal-title" id="jobConversationAcceptOfferModal" style="color: white!important;">Confirm job offer</h5>
        <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('service_seeker_accept_job', [$job->id, $conversation->id] )}}" method="post">
        @csrf
      <div class="modal-body">
        <div class="pl-3 pr-3">
           <!-- <span id="job_title" class="fs-1">4 Curtains to Clean</span>
              <br><br> -->
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
      <div class="modal-footer" style="border-top: none!important">
        <button type="button" class="btn btn-danger"  data-dismiss="modal" style="color: white!important; width: 50%;">Cancel</button>
        <button type="submit" class="btn btn-success" style="color: white!important; width: 50%">Confirm Offer</button>
      </div>
    </form>
    </div>
  </div>
</div>
