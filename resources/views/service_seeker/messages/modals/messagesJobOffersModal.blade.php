<!-- Modal -->

<div class="modal fade" id="serviceSeekerMessagesOfferModal" tabindex="-1" role="dialog" aria-labelledby="serviceSeekerMessagesOfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none!important; background-color: #399BDB!important; display: flex; align-items: center; justify-content: center;">
        <h5 class="modal-title text-center" id="serviceSeekerMessagesOfferModal" style="color: white!important;">Service Provider</h5>
        <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        @csrf
      <div class="modal-body">
        <div class="pl-3 pr-3">
          <div class="d-flex bd-highlight mb-2">
        	   <div class="p-0 mt-1 bd-highlight">
        		  <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="70" width="70" style="border-radius:50%;" class="mr-2 border" alt="">
        	   </div>
        	   {{-- Conversation name --}}
        	   <div class="p-1 bd-highlight">
        		  <span id="message_offer_service_provider_name" class="theme-color" style="font-size: 0.9rem;"></span><br>
              <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star"></i>  <i class="fas fa-star-half-alt"></i> </span>
        	   </div>

        	   {{-- Conversation price --}}
        	   <div class="ml-auto p-0 bd-highlight">
        		  <span id="message_offer_service_provider_price" class="fs-1"></span> <br>
        	   </div>
        	</div>
        </div>
        <div class="ml-4">
          <i class="fas fa-edit p-3 text-mute" style="font-size: 20px;"></i><span>Description</span>
          <div class="d-flex flex-column bd-highlight">
            <div class="bd-highlight">
              <span class="ml-4 p-4" id="message_offer_service_provider_description" style="font-size: 0.9rem;"></span>
            </div>
            <br>
          </div>

          <i class="fas fa-map-marker p-3" style="font-size: 20px;"></i><span>Location</span>
          <div class="d-flex flex-column bd-highlight mb-2">
            <div class="bd-highlight">
              <span class="ml-4 p-4" id="message_offer_service_provider_location" style="font-size: 0.9rem;"></span>
            </div>
            <br>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top: none!important; display: flex; align-items: center; justify-content: center;">
        <button type="button" class="btn" onclick="show_job_offer_conversation();" style="background-color: #399BDB!important; color: white!important"  style="color: white!important; width: 50%;">
          Message
          <i class="fas fa-location-arrow pl-3"></i>
        </button>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
