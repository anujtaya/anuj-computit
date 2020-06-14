<!-- Modal -->
<div class="modal fade" id="job_make_offer_modal" tabindex="-1" role="dialog" aria-labelledby="job_make_offer_modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <h5 class="modal-title" id="exampleModalLabel">Send Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="{{ route('service_provider_job_make_offer')}}" method="post" onsubmit="toggle_animation(true);">
		  @csrf
		  <div class="modal-body">
			<input type="hidden" name="job_id" value="{{$job->id}}">
      <label class="pb-2">Set your price</label>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1" style="border-top-left-radius: 10px!important; border-bottom-left-radius: 10px!important; background-color: #5D29BA!important; color: white">$</span>
        </div>
        <input type="number" id="job_offer" name="job_offer" value="" class="form-control" style="border-top-right-radius: 10px!important; border-bottom-right-radius: 10px!important;" aria-label="job_offer" aria-describedby="basic-addon1" required>
      </div>
      <label class="pb-2">Your response to job</label>
			<textarea type="text" class="form-control form-control-sm"rows="4" id="job_offer_description" name="job_offer_description" style="/* border: 1px solid #5D29BA!important */" placeholder=""></textarea>
		  </div>

      <div class="modal-footer" style="text-align: center!important; border-top: none">
        <!-- <button type="button" class="btn btn-secondary" style="background-color: red!important; color: white!important" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary btn-sm card-1" style="background-color: #5D29BA!important; color: white!important; margin:auto ;display:block;">Send offer</button>
      </div>
	  </form>
    </div>
  </div>
</div>
