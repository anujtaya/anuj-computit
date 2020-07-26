@extends('layouts.service_seeker_master')
@section('content')
@php
$job_payment = $job->job_payments;
@endphp
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-2"><a href="{{route('service_seeker_job', $job->id)}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left fs-1" style="color:#399BDB!important"></i> </a> </div>
            <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">Job Checkout<br><span class="fs--2 text-muted font-weight-normal">Mode {{$payment_method}}</div>
            <div class="col-2 text-right">
            </div>
         </div>
      </div>
      <div class="col-lg-12 mt-2 p-0" >
         <div class="p-2">
            @if($job_payment->status == 'PAID')
                <div class="text-center">
                    <br><br>
                    <i class="far fa-check-circle display-2 text-success"></i>  
                    <br><br>
                    This job has been paid for. Please visit the job summary window to know more.
                </div>
            @else
                @if($payment_method == 'STRIPE')
                    @include('service_seeker.jobs.partial.job_payment_process_mode_stripe')
                @endif
            @endif
         </div>
      </div>
   </div>
</div>
@endsection