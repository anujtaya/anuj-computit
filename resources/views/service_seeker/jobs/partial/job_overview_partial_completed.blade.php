@if($conversation_current != null)
<div class="fs--1 p-2">
   <div class="mb-2 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <a href="{{route('service_seeker_job_conversation', [$conversation_current->job_id, $conversation_current->service_provider_id])}}"  class="btn theme-background-color btn-sm  card-1 ml-2 fs--1   text-white" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
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