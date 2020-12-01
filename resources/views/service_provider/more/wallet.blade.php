@extends('layouts.service_provider_master')
@section('content')
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
         Your have succesfully connected your Stripe account with LocaL2LocaL. You should recieve payouts for your work. If we need more information from you in future, we will let you know. To know full
         information about Stripe Account.
      </div>
      <div class="p-2 shadow-sm m-1">
         <div class="fs-2 text-success"> 
            {{number_format($stripe_balance->available[0]->amount/100,2)}} 
            <span class="text-uppercase fs--1">
            {{$stripe_balance->available[0]->currency}}
            </span>
         </div>
         <span>Available Balance</span>
      </div>
      <div class="p-2 shadow-sm m-1">
         <div class="fs-2 text-success"> 
            {{number_format($stripe_balance->pending[0]->amount/100,2)}} 
            <span class="text-uppercase fs--1">
            {{$stripe_balance->pending[0]->currency}}
            </span>
         </div>
         <span>Pending Balance</span>
      </div>
      @else
      <div class="p-2 shadow-sm m-1">
         <i class="fas fa-exclamation-circle display-4 text-danger"></i> <br><br>
         You do not have your Stripe Account set up. To enable payout please visit <a class="text-primary" href="{{URL::to('/')}}/banking">{{URL::to('/')}}/banking</a> in any secure browser. 
         Once you complete your Stripe account set-up, your account details will appear here.
      </div>
      @endif
   </div>
   <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
      <div class="p-2 shadow-sm m-1">
         <h1 class="fs--1">Recent Transctions</h1>
         <ul class="list-group list-group-flushd">
            <li class="list-group-item bg-info fs--1">
               <a href="{{route('service_provider_more_help')}}" class="text-white" onclick="toggle_animation(true);">  Help is available if you're experiencing any payment issue related to the payouts. Please tap here and get the help.</a>
            </li>
            @foreach(Auth::user()->service_provider_paylogs as $log)
            <li class="list-group-item">
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
               <div class="text-muted fs--2 mt-2">Date: {{date('d/m/Y h:i a', strtotime($log->updted_at))}}</div>
            </li>
            @endforeach
         </ul>
      </div>
   </div>
</div>
@endsection