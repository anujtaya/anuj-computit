<style>
/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
}
.hover {
   color:#FFCC36; 
}
.selected {
  color:#FF912C;
}
</style>

<div class="fs--1" style="overflow:scroll; scroll-behavior: smooth;">
   <div class="border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}"  class="btn btn-sm theme-background-color border-0 fs--1 card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="p-2">
      @if(Session::has('status'))
         <div class="alert alert-info">
            {{Session::pull('status')}}
         </div>
      @endif

      @php
         $job_payment = $job->job_payments;
      @endphp

      @if($job_payment->status == 'UNPAID')
      <div class="alert alert-danger">
            We are currently waiting for Service Seeker approval for this job invoice. Once the Service Seeker approves the invoice we will transfer the money in to your nominated bank account.  
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Total Job Price</div>
         <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->actual_job_price, 2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">GST Included (if applicable)</div>
         <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->actual_job_price/11,2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Service Fee ({{number_format($job_payment->service_fee_percentage,0)}}%)</div>
         <div class="ml-auto p-2 bd-highlight text-danger"> ${{number_format($job_payment->service_fee_price, 2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">You Get</div>
         <div class="ml-auto p-2 bd-highlight text-success"> ${{number_format($job_payment->service_provider_gets, 2)}}</div>
      </div>
      <!-- refresh the page every 20 seconds -->
      <script>
            window.onload = function() {
               setTimeout(function(){ location.reload(); }, 15000);
            };
      </script>
      @else
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 bd-highlight font-weight-bolder">Job Summary</div>
         <div class="ml-auto p-0 bd-highlight"> 
            <a href="{{route('service_provider_job_email_invoice', $job->id)}}" onclick="toggle_animation(true);" class="btn btn-sm theme-background-color text-white card-1 fs--1">
               <i class="fas fa-paper-plane"></i> Email Invoice
            </a>
         </div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Total Job Price</div>
         <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->job_price, 2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">GST Included (if applicable)</div>
         <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->gst_fee_value,2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Service Fee ({{number_format($job_payment->service_fee_percentage,0)}}%)</div>
         <div class="ml-auto p-2 bd-highlight text-danger"> ${{number_format($job_payment->service_fee_price, 2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">You Get</div>
         <div class="ml-auto p-2 bd-highlight text-success"> ${{number_format($job_payment->service_provider_gets, 2)}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Payment Mode</div>
         <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_method}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Payment Reference Number</div>
         <div class="ml-auto p-2 bd-highlight">{{substr($job_payment->payment_reference_number,0,15)}}...</div>
      </div>
      <br>
      <span class="font-weight-bolder">Rate Your Service Seeker</span> <br> <br>
      <div class="d-flex bd-highlight mb-3">
         <div class="p-0 bd-highlight">
            <div class='rating-stars'>
               <ul id='' class="fs--1">
                  <li class='star @if($job->service_provider_rating > 0) selected @endif' title='Poor' data-value='1'>
                     <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star @if($job->service_provider_rating > 1) selected @endif' title='Fair' data-value='2'>
                     <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star @if($job->service_provider_rating > 2) selected @endif' title='Good' data-value='3'>
                     <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star @if($job->service_provider_rating > 3) selected @endif' title='Excellent' data-value='4'>
                     <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star @if($job->service_provider_rating > 4) selected @endif' title='WOW!!!' data-value='5'>
                     <i class='fa fa-star fa-fw'></i>
                  </li>
               </ul>
            </div>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <button  class="btn theme-background-color btn-sm  card-1 ml-2 fs--1 text-white" onclick="show_rating_modal();">
            Edit Rating
            </button>
         </div>
      </div>
      <div class="p-0 mb-2 bd-highlight">
         <span class="font-weight-bolder">Comments</span> <br><br>
         <p class="p-2 border"><i>{{$job->service_provider_comment}}</i></p>
      </div>
      <div class="p-0 bd-highlight text-center">
         <form action="{{route('service_provider_job_notify_job_completion')}}" method="POST">
            @csrf
            <input type="hidden" name="job_id" value="{{$job->id}}">
            <input type="hidden" name="user_type" value="SP">
            <button onclick="toggle_animation(true);" type="submit" class="btn btn-success btn-sm  card-1  fs--1 text-white btn-block">Finish Job</button>
         </form>
      </div>
      {{-- Code for display rating modal if rating is not provided by Service Provider --}}
         @if($job->service_provider_rating ==  null)
         <script>
            window.onload = function() {
               show_rating_modal();
            };
         </script>
         @endif
      {{-- end rating modal display code --}}


      @endif
   </div>  
</div>
<div class="modal fade" id="editjobratingmodal" tabindex="-1" role="dialog" aria-labelledby="editjobratingmodal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm  border-0 p-3">
         <div class="mb-3">
            <span style="font-size:1.2rem">Edit Job Rating</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_provider_job_update_rating')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf 
            <input type="hidden" value="{{$job->id}}" name="rating_job_id" required>
            <input type="hidden" value="{{$job->service_provider_rating}}" id="sp_rating_start_value" name="sp_rating_start_value" required>
            <div class="form-group">
               <label for="extra_description">Select Rating Star</small></label>
               <div class='rating-stars'>
                  <ul id='stars' class="fs-2">
                     <li class='star @if($job->service_provider_rating > 0) selected @endif' title='Poor' data-value='1'>
                     <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_provider_rating > 1) selected @endif' title='Fair' data-value='2'>
                     <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_provider_rating > 2) selected @endif' title='Good' data-value='3'>
                     <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_provider_rating > 3) selected @endif' title='Excellent' data-value='4'>
                     <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_provider_rating > 4) selected @endif' title='WOW!!!' data-value='5'>
                     <i class='fa fa-star fa-fw'></i>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="form-group">
               <label for="extra_description">Write Comments Below</label>
               <textarea class="form-control form-control-sm" id="extra_description" rows="3" name="sp_rating_description_value" placeholder="It was great helping you out.">{{$job->service_provider_comment}}</textarea>
            </div>
            <button class="btn btn-sm theme-background-color text-white card-1 fs--1"><i class="fas fa-redo fs--2"></i> Save Rating</button>
            <a class="btn btn-secondary text-white card-1 fs--1" href="#" data-dismiss="modal" >Dismiss</a>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="invoiceJobDeliveryNotification" tabindex="-1" role="dialog" aria-labelledby="invoiceJobDeliveryNotification" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm  border-0 p-3">
         <div class="mb-3">
            <span style="font-size:1.2rem">Processing Job Invoice</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <p>
            We are preaparing invoice for this job and it will be delivered to Service Seeker and your nominated email address. We will let you know once the invoice is delivered.
         </p>
         <a class="btn btn-secondary text-white card-1 fs--1" href="#" data-dismiss="modal">Dismiss</a>
         </form>
      </div>
   </div>
</div>
<script>
$(document).ready(function(){ 
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    $('#sp_rating_start_value').val(ratingValue);
  });
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

function show_rating_modal(){
   $('#editjobratingmodal').modal('show');
}



function redirect_user_to_provider_home(){
      toggle_animation(true);
      location.href = "{{route('service_provider_home')}}";
   }
</script>