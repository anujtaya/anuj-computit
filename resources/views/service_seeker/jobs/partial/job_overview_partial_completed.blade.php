@if($conversation_current != null)
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
<div class="fs--1">
   <div class="p-2">
      @if(Session::has('status'))
         <div class="alert alert-info">
            {{Session::pull('status')}}
         </div>
      @endif
      @php
         $job_payment = $job->job_payments;
      @endphp
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
         <div class="ml-auto p-2 bd-highlight"> ${{$job_payment->gst_fee_value}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Payment Mode</div>
         <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_method}}</div>
      </div>
      <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
         <div class="p-2 bd-highlight">Payment Reference Number</div>
         <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_reference_number}}</div>
      </div>
   </div>
   <div class="p-2">
      <span class="font-weight-bolder">Rate Your Service Provider</span> <br> <br>
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
         <button class="btn theme-background-color text-white card-1 fs--1"><i class="fas fa-redo fs--2"></i> Update Rating</button>
      </form>
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
    $('#ss_rating_start_value').val(ratingValue);
  });
});
function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif