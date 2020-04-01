<!-- Modal -->
<div class="modal fade" id="jobConversationRejectOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationRejectOfferModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none!important; background-color: #5D29BA!important;">
        <h5 class="modal-title" id="jobConversationRejectOfferModal" style="color: white!important;">Confirm job offer</h5>
        <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('service_seeker_reject_job',[$job->id ,$conversation->id])}}" method="post">
        @csrf
      <div class="modal-body">
        <div class="pl-3 pr-3">
          <span>Are you sure you want to reject the offer?</span>
        </div>
      </div>
      <div class="modal-footer" style="border-top: none!important">
        <button type="button" class="btn btn-danger"  data-dismiss="modal" style="color: white!important; width: 50%;">Cancel</button>
        <button type="submit" class="btn btn-success" style="color: white!important; width: 50%">Reject Offer</button>
      </div>
    </form>
    </div>
  </div>
</div>
