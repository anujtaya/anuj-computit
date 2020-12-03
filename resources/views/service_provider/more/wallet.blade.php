@extends('layouts.service_provider_master')
@section('content')
@php
$paylogs = Auth::user()->service_provider_paylogs;
//dd($paylogs);
$pending_balance = 0;
if($paylogs != null) {
   $pending_balance = $paylogs->where('status', '!=', 'PAID')->sum('total_amount');
}

@endphp
<div class="container ">
<div class="row  justify-content-center" >
   <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
      <div class="row">
         <div class="col-2">   <a href="{{route('service_provider_more')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
         <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">Payouts  <br><span class="fs--2 text-muted font-weight-normal">Banking Information</span></div>
         <div class="col-2"></div>
      </div>
   </div>
   <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
      @if(Auth::user()->service_provider_payment != null)
      <div class="p-2 shadow-sm m-1"> 
         <i class="fas fa-check-circle display-4 text-success"></i><br><br>
         Your have succesfully connected your Stripe account with LocaL2LocaL. You should recieve payouts for your work. If we need more information from you in future, we will let you know.
      </div>
      @else
      <div class="p-2 shadow-sm m-1">
         <i class="fas fa-exclamation-circle display-4 text-danger"></i> <br><br>
         You do not have your Stripe Account set up. To enable payouts please visit <a class="text-primary" href="{{URL::to('/')}}/banking">{{URL::to('/')}}/banking</a> in any secure browser. 
         Once you complete your Stripe account set-up, your account details will appear here.
      </div>
      @endif
      <div class="p-2 shadow-sm m-1">
         <div class="fs-2 text-success"> 
            {{$pending_balance}}
            <span class="text-uppercase fs--1">AUD</span>
         </div>
         <span>Available Balance</span>
      </div>
   </div>
   <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
      <div class="p-2 shadow-sm m-1">
         <h1 class="fs--1">Recent Transctions</h1>
         <ul class="list-group list-group-flushd">
            <li class="list-group-item  fs--1">
               <a href="{{route('service_provider_more_help')}}" class="theme-color" onclick="toggle_animation(true);">  Help is available if you’re experiencing any payment issues related to the payouts. Please tap here to get help</a>
            </li>
            @foreach($paylogs as $log)
            <li class="list-group-item" onclick="location.hrefs='{{route('service_provider_job' , $log->job_id)}}?gobackurl={{route('service_provider_more_wallet')}}'; toggle_animation(true);"> 
               <div class="d-flex bd-highlight">
                  <div class=" flex-grow-1 bd-highlight">
                     @if($log->status == "PENDING")
                     <span class="badge badge-warning">Pending</span>
                     @elseif($log->status == "PAID")
                     <span class="badge badge-success">Paid</span>
                     @elseif($log->status == "FAILED")
                     <span class="badge badge-danger">Failed</span>
                     @endif
                  </div>
                  <div class=" bd-highlight text-success font-weight-bolder">${{number_format($log->total_amount,2)}}</div>
               </div>
               <div class="text-muted fs--2 mt-2">Date: {{date('d/m/Y h:i a', strtotime($log->created_at))}}</div>
               @if($log->status == "PENDING" || $log->status == "FAILED")
                  @php $temp = $log->job->job_payments; @endphp
                  @if($temp->status == 'PAID')
                     <div class="text-warning fs--2 mt-2">Waiting for Admin Approval.</div>
                  @else
                     <div class="text-warning fs--2 mt-2">Waiting payment from Service Seeker</div>
                  @endif
               @else
                  <div class="text-success fs--2 mt-2">Funds were transferred to your nominated bank account.</div>
               @endif
            </li>
            @endforeach
         </ul>
      </div>
   </div>
</div>
@endsection