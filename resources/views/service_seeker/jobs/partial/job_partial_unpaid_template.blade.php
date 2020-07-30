<div class="alert alert-info">
   Service Provider has completed the job. Please pay the job total amount. You can choose to pay via Debit/Card, Paypal or ZipPay.   
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">Total Job Price</div>
   <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->job_price, 2)}}</div>
</div>
<div class="d-flex border bd-highlight" style="border-style:dotted!important;">
   <div class="p-2 bd-highlight">GST Included</div>
   <div class="ml-auto p-2 bd-highlight"> ${{$job_payment->gst_fee_value}}</div>
</div>
<br>
<form class="fs--1" action="{{route('service_seeker_process_job_payment')}}" method="get" class="m-0" onsubmit="toggle_animation(true);">
   <input type="hidden" name="payment_job_id" value="{{$job->id}}">
   <div class="radio">
      <input id="radio-1" name="payment_mode" type="radio" value="STRIPE" checked="">
      <label for="radio-1" class="radio-label  fs--1" >Credit/Debit Card</label>
   </div>
   <div class="radio">
      <input id="radio-2" name="payment_mode" value="PAYPAL" type="radio">
      <label for="radio-2" class="radio-label">Paypal</label>
   </div>
   <div class="radio">
      <input id="radio-2" name="payment_mode" value="ZIPPAY" type="radio" disabled>
      <label for="radio-2" class="radio-label">ZipPay</label>
   </div>
   <!-- <div class="radio">
      <input id="radio-2" name="type" value="CASH" type="radio" disabled>
      <label for="radio-2" class="radio-label">Cash</label>
   </div> -->
   <div class="mt-4">
      <button class="btn btn-lg btn-success btn-block shadow text-white">Pay <small>$</small>{{number_format($job_payment->job_price, 2)}}</button>                  
   </div>
</form>