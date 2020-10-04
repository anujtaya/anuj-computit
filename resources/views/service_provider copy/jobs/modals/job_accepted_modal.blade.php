<!-- Modal -->
<div class="modal fade" id="job_accepted_modal" tabindex="-1" role="dialog" aria-labelledby="job_accepted_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white rounded-0" style="border-bottom: none;">
        <h5 class="modal-title text-white" id="exampleModalLabel">Congratulations!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Your offer has been accepted by the Service Seeker. Tap the button below to visit the job overview page to start the job.</p>
        <a href="{{route('service_provider_job',$conversation->job_id)}}" onclick="toggle_animation(true);" class="btn btn-success text-white shadow"> Start Job </a>
      </div>
        
    </div>
  </div>
</div>
