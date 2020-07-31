<table class="table table-sm  fs--1 table-borderless">
   <tr>
      <td class="theme-color" >Payment Method: </td>
      <td class="text-right"> Card</td>
   </tr>
   <tr>
      <td class="theme-color">Total Payable Price: </td>
      <td class="text-right"> ${{number_format($job_payment->job_price, 2)}} </td>
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
   <form action="{{route('service_seeker_process_job_payment_pay_with_paypal')}}" method="POST">
      @csrf
      <input type="hidden" name="paypal_payment_job_id" value="{{$job->id}}">
      <button type="submit" class="btn btn-primary btn-block shadow text-white mt-4" >Checkout with PayPal ${{number_format($job_payment->job_price, 2)}}</button>
      <br>
      <span class="text-muted fs--2">You will be redirected to Paypal Checkout Page once clicked on the Confirm Payment button.</span> 
      <br><br>
      <img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_payments_by_pp_2line.png" alt="How PayPal Works" />    
   </form>
</div>