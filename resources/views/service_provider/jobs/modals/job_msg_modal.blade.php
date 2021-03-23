<!-- Modal -->
<div class="modal fade" style="z-index:10000!important;" id="job_msg_modal" tabindex="-1" role="dialog" aria-labelledby="job_msg_modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <h5 class="modal-title" id="exampleModalLabel">Write Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border:none">
        <p class="fs--1">Please do not disclose personal information, e.g., Phone Number, Email, Full Name or Banking details.</p>
        <textarea type="text" class="form-control form-control-sm" rows="3" id="service_provider_conversation_message"></textarea>
      </div>
      <div class="modal-footer" style="text-align: center!important; border-top: none">
        <button class="btn btn-sm theme-background-color  card-1 border-0 fs--1 text-white" onclick="send_message_provider({{$conversation->id}});">
        <i class="fas fa-paper-plane"></i> Send
        </button>
      </div>
    </div>
  </div>
</div>
