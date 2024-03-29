@php
   //calculte the final job price payable if paid using paypal.
   $paypal_fixed_fee = 0.30;
   $paypal_fixed_percentage = 2.60;
   $job_price = $job_payment->job_price;
   $job_orignal_price = $job_payment->actual_job_price;
   //payable job price id promotion is applied
   ////find the promotion if any
   $promotion = DB::table('promotions')->where('id', $job->promocode)->first();
   $promotion_discount_discription = '';
   $promotion_price = 0.00;

   if($promotion != null) {
      if($promotion->type == 'FIXED') {
         $promotion_price = round($job_orignal_price - $promotion->value);
      } else {
         $promotion_price = round(($promotion->value/100)*($job_orignal_price),2);
      }
   }
   //since there is no charge on gst on card processing fee. We will exclude it below
   $paypal_job_price = $job_payment->job_price - $job_payment->gst_fee_value;

   $credit_card_processing_fee =  round(($paypal_fixed_percentage/100)*($paypal_job_price),2);                    
   $credit_card_processing_fee += $paypal_fixed_fee;
   $final_payable_amount = $job_price + $credit_card_processing_fee;
@endphp

<table class="table table-sm  fs--1 table-borderless">
   <tr>
      <td class="theme-color" >Payment Method: </td>
      <td class="text-right"> Card</td>
   </tr>
   @if($promotion != null)
   <tr>
      <td class="theme-color">Job Price: </td>
      <td class="text-right"> ${{number_format($job_orignal_price, 2)}} </td>
   </tr>
   <tr>
      <td class="theme-color">Promotion discount ({{$promotion->code}}): </td>
      <td class="text-right"> ${{number_format($promotion_price, 2)}} </td>
   </tr>
   @endif
   <tr>
      <td class="theme-color">Total Job Price: </td>
      <td class="text-right"> ${{number_format($job_price, 2)}} </td>
   </tr>
   <tr>
      <td class="theme-color">GST Included (if applicable): </td>
      <td class="text-right"> ${{number_format($job_payment->gst_fee_value,2)}}</td>
   </tr>
   <tr>
      <td class="theme-color">Processing Fee: <br><small>({{$paypal_fixed_percentage}}% + {{number_format($paypal_fixed_fee,2)}}) (Excluding GST component) </small> </td>
      <td class="text-right"> ${{number_format($credit_card_processing_fee, 2)}} </td>
   </tr>
   <tr>
      <td class="theme-color">Total Payable Price: </td>
      <td class="text-right"> ${{number_format($final_payable_amount, 2)}} </td>
   </tr>
</table>
<div class="m-1">
   <div class="p-2  fs--1 mt-2">
  
   </div>
</div>
<!-- payment button  -->
<div class="m-1">
      @if ( Session::has('success'))
      <div class="alert alert-success">{{ Session::pull('success')}}</div>
      @endif
      @if (Session::has('error'))
      <div class="alert alert-danger">{{ Session::pull('error')}}</div>
      @endif
   <form action="{{route('service_seeker_process_job_payment_pay_with_paypal')}}" method="POST" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="paypal_payment_job_id" value="{{$job->id}}">
      <button type="submit" class="btn btn-primary btn-block shadow text-white mt-4" >Checkout with PayPal ${{number_format($final_payable_amount, 2)}}</button>
      <br>
      <span class="text-muted fs--2">You will be redirected to Paypal Checkout Page once clicked on the Confirm Payment button.</span> 
      <br><br>
      <img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_payments_by_pp_2line.png" alt="How PayPal Works" />    
   </form>
</div>