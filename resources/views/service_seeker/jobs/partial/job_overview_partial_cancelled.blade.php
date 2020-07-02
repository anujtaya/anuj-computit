<div class="fs--1">
   <div class="text-center p-3">
      <img src="{{asset('images/svg/l2l_delete.svg')}}" alt="" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
      <br><br>
      <p>
         No more action needed. This job is safely marked as cancelled. Detail of callation fee charge will appear below if applicable.
      </p>
      <p>
         If you have more questions about this job, please free to email us at help@local2local.com.au or you can visit <a href="{{route('service_seeker_more_help')}}" onclick="toggle_animation(true);" class="theme-color font-weight-bolder">help section</a> of this app to message us directly from app. 
      </p>
   </div>
</div>

<!-- show job payment transation either for refund or $10 cancellation charge -->
@php
$job_payment  = $job->job_payments;
@endphp
@if($job_payment != null) 
   @if($job_payment->status == "REFUNDED")
      <div class="shadow-sm rounded p-3 m-2 bg-secondary text-white">
         A refund has been made to account. The total refund amount is ${{ number_format( $job_payment->payable_job_price ,2)}}.
         <br>
         <small class="text-muted">Ref no: {{$job_payment->payment_reference_number}}</small>  
      </div>
   @endif 
@endif
