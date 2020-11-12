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
<div class="d-flex bd-highlight mb-2">
   <div class="p-0 bd-highlight font-weight-bolder">Job Summary</div>
   <div class="ml-auto p-0 bd-highlight"> 
      <a href="{{route('service_seeker_job_email_invoice', $job->id)}}" onclick="toggle_animation(true);"  class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white">
      <i class="fas fa-paper-plane"></i> Email Invoice
      </a>
   </div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Total Job Price</div>
   <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->job_price, 2)}}</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">GST Included</div>
   <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->gst_fee_value,2)}}</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Payment Mode</div>
   <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_method}}</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Payment Processing Fee</div>
   <div class="ml-auto p-2 bd-highlight"> {{number_format($job_payment->payment_processing_fee,2)}}</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Payment Ref. Number</div>
   <div class="ml-auto p-2 bd-highlight fs--2 text-monospace"> {{substr($job_payment->payment_reference_number,0,15)}}...</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Total Price Paid Price</div>
   <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->job_price + $job_payment->payment_processing_fee, 2)}}</div>
</div>
<br>
<span class="font-weight-bolder">Rate Your Service Provider</span> <br> <br>
<div class="d-flex bd-highlight mb-3">
   <div class="p-0 bd-highlight">
      <div class='rating-stars'>
         <ul id='' class="fs--1">
            <li class='star @if($job->service_seeker_rating > 0) selected @endif' title='Poor' data-value='1'>
               <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star @if($job->service_seeker_rating > 1) selected @endif' title='Fair' data-value='2'>
               <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star @if($job->service_seeker_rating > 2) selected @endif' title='Good' data-value='3'>
               <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star @if($job->service_seeker_rating > 3) selected @endif' title='Excellent' data-value='4'>
               <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star @if($job->service_seeker_rating > 4) selected @endif' title='WOW!!!' data-value='5'>
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
   <span class="font-weight-bolder">Comments</span> <br>
   <p class="p-2 border"><i>{{$job->service_seeker_comment}}</i></p>
</div>
<div class="p-0 bd-highlight text-center">
   <form action="{{route('service_seeker_job_notify_job_completion')}}" method="POST">
      @csrf
      <input type="hidden" name="job_id" value="{{$job->id}}">
      <input type="hidden" name="user_type" value="SS">
      <button href="{{route('service_seeker_home')}}" onclick="toggle_animation(true);" type="submit" class="btn btn-success btn-sm  card-1  fs--1 text-white btn-block">Finish Job</button>
   </form>
</div>
<div class="modal fade" id="editjobratingmodal" tabindex="-1" role="dialog" aria-labelledby="editjobratingmodal" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content shadow-sm  border-0 p-3">
         <div class="mb-3">
            <span style="font-size:1.2rem">Job Feedback</span>
            <button type="button" class="close" data-dismiss="modal" style="color: white!important;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('service_seeker_job_update_rating')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf 
            <input type="hidden" value="{{$job->id}}" name="rating_job_id" required>
            <input type="hidden" value="{{$job->service_seeker_rating}}" id="ss_rating_start_value" name="ss_rating_start_value" required>
            <div class="form-group">
               <label for="">Select Rating Star</small></label>
               <div class='rating-stars'>
                  <ul id='stars' class="fs-2">
                     <li class='star @if($job->service_seeker_rating > 0) selected @endif' title='Poor' data-value='1'>
                        <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_seeker_rating > 1) selected @endif' title='Fair' data-value='2'>
                        <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_seeker_rating > 2) selected @endif' title='Good' data-value='3'>
                        <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_seeker_rating > 3) selected @endif' title='Excellent' data-value='4'>
                        <i class='fa fa-star fa-fw'></i>
                     </li>
                     <li class='star @if($job->service_seeker_rating > 4) selected @endif' title='WOW!!!' data-value='5'>
                        <i class='fa fa-star fa-fw'></i>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="form-group">
               <label for="ss_rating_description_value">Write Comments Below</label>
               <textarea class="form-control form-control-sm" id="ss_rating_description_value" rows="3" name="ss_rating_description_value" placeholder="Thank you for your services.">{{$job->service_seeker_comment}}</textarea>
            </div>
            <button class="btn theme-background-color text-white card-1 fs--1">Save Rating</button>
            <a class="btn btn-secondary text-white card-1 fs--1" href="#" data-dismiss="modal">Dismiss</a>
         </form>
      </div>
   </div>
</div>


{{-- Code for display rating modal if rating is not provided by Service Seeker --}}
   @if($job->service_seeker_rating ==  null)
   <script>
      $(function() {
         show_rating_modal();
      });
   </script>
   @endif
{{-- end rating modal display code --}}


{{-- Code for sending invoice if the is_invoice_sent varibale is set to false. Runs Automatically --}}
   @if(!$job->is_invoice_sent)
   <script>
      $(function() {
         generate_invoices();
      });
   </script>
   @endif
{{-- end invoice auto send code --}}


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
       $('#ss_rating_start_value').val(ratingValue);
     });
   });
   function responseMessage(msg) {
     $('.success-box').fadeIn(200);  
     $('.success-box div.text-message').html("<span>" + msg + "</span>");
   }
   
   function show_rating_modal(){
      $('#editjobratingmodal').modal('show');
   }

   //below function is called automatically if the invoice hasn't been sent to seeker already
   function generate_invoices(){
      //open modal notification until the invoice is delivered
      $('#invoiceJobDeliveryNotification').modal('show');
      console.log('Invoice deliver method triggered automatically.')
      send_seeker_invoice();
      send_provider_invoice();
   }

   function send_provider_invoice(){
      $.ajax({
         type: "GET",
         url: "{{route('service_provider_job_email_invoice', $job->id)}}",
         success: function(results) {
            //console.log('Provider Invoice Sent.')
            $('#invoiceJobDeliveryNotification').modal('hide');
         },
         error: function(result, status, err) {
            console.log('Provider Invoice: ' + err);
         }
      });
   }

   function send_seeker_invoice(){
      $.ajax({
         type: "GET",
         url: "{{route('service_seeker_job_email_invoice', $job->id)}}",
         success: function(results) {
            //console.log('Seeker Invoice Sent.')
         },
         error: function(result, status, err) {
            console.log('Seeker Invoice: ' + err);
         }
      });
   }

   function redirect_user_to_seeker_home(){
      toggle_animation(true);
      location.href = "{{route('service_seeker_home')}}";
   }
</script>