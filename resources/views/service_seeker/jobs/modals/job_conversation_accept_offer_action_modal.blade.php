<div class="modal fade" id="jobConversationAcceptOfferModal" tabindex="-1" role="dialog" aria-labelledby="jobConversationAcceptOfferModal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm  border-0">
         <div class="modal-header bg-success border-0">
            <span id="jobConversationAcceptOfferModal" style="color: white!important;font-size:0.9rem">Confirm job offer</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_seeker_accept_job', [$job->id, $conversation->id] )}}" method="post">
            @csrf
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
               <div class="rounded mt-3">
                  <h6 class=""><strong>Select a Payment Source</strong>  </h6>
                  @php
                  $stripe_payment_source = Auth::user()->service_seeker_stripe_payment;
                  $card_sources = [];
                  if($stripe_payment_source != null) {
                   $card_sources = $stripe_payment_source->sss_payment_sources;
                  }
                  @endphp
                  <div class="m-0">
                     @if(count($card_sources) != 0)
                     <h6>Stripe</h6>
                     <!-- source list with default selection  -->
                     <div class="m-0">
                        <ul class="list-group mb-2">
                           @foreach($card_sources as $source)
                           <li class="list-group-item fs--1 p-0">
                              <div class="radio">
                                 <input type="radio" id="radio-{{$source->id}}" name="stripe_payment_source_id" value="{{$source->id}}"  @if($source->is_default) checked @endif>     
                                 <label for="radio-{{$source->id}}" class="radio-label fs--1 " > {{$source->brand}} **{{$source->last_4}} Expires:{{date('m/Y', strtotime($source->expiry))}}</label>
                              </div>
                           </li>
                           @endforeach
                        </ul>
                        <a href="{{route('service_seeker_more_wallet')}}?job_id={{$job->id}}&sp_id={{$conversation->service_provider_id}}" class="theme-color mt-2" onclick="toggle_animation(true)">Add/Remove Credit</a>
                     </div>
                     @else
                     <span class="text-danger">Oh Snap! You don't have a payment source set up for your account. Please tap here to set-up a payment source. We will need a payment source before you can accept Service Provider offers.</span>
                     <br> <br>
                     <a href="{{route('service_seeker_more_wallet')}}?job_id={{$job->id}}&sp_id={{$conversation->service_provider_id}}" class="theme-color mt-2" onclick="toggle_animation(true)">Add/Remove Credit</a>
                     @endif
                  </div>
               </div>
               <div class="row mt-3 ml-0 mr-0">
                  <div class="col-12 mb-2 p-0">
                     By clicking the button "Confirm to Prceed" you agree to LocaL2LocaL offer acceptance T&Cs. To view our T&C, please tap here.
                  </div>
                  <div class="col-12 mt-2 p-0">
                     @if(count($card_sources) != 0)
                     <button  type="submit" class="btn btn-block btn-success fs--1 text-white shadow">Confirm to Proceed</button>
                     @else
                     <button  type="submit" class="btn btn-block btn-secondary fs--1 text-white shadow" disabled>Confirm to Proceed</button>
                     @endif
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