<div class="modal fade" id="jobConversationRejectOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationRejectOfferModal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm border-0">
         <div class="modal-header bg-warning border-0">
            <span id="jobConversationAcceptOfferModal" style="color: white!important;font-size:0.9rem">Cancel Job Offer</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_seeker_reject_job',[$job->id ,$conversation->id])}}" method="post" onsubmit="toggle_animation(true);">
            @csrf
            <div class="modal-body fs--1">
               <div class="">
                  Are you sure you want to reject the offer?
                  <br>
                  <br>
                  <ul class="fs--1">
                     <li class="">You won't be charged for rejecting Service Provider offer.</li>
                     <li class="">We will remove the Service Provider from you job overview map and list view.</li>
                     <li class="">We will notify the Service Provider about as soon as you reject this job offer.</li>
                  </ul>
               </div>
            </div>
            <div class="row m-1">
               <div class="col-6 p-1">
                  <button type="button" class="btn btn-block btn-secondary fs--1 text-white shadow"  data-dismiss="modal">Dismiss</button>
               </div>
               <div class="col-6 p-1">
                  <button  type="submit" class="btn btn-block btn-warning fs--1 text-white shadow">Reject Offer</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>