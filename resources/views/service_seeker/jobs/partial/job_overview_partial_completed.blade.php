@if($conversation_current != null)
<div class="fs--1 p-2">
   @php
      $job_payment = $job->job_payments;
   @endphp
   @if($job_payment->status == 'UNPAID')
      @include('service_seeker.jobs.partial.job_partial_unpaid_template')
   @else
      @include('service_seeker.jobs.partial.job_partial_paid_template')
   @endif
</div>
@else
<div class="fs--1 m-3">
   Something went wrong. Please go back to jobs page to resole this error.
</div>
@endif