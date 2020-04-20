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
      <div class="p-2 card-1 m-1"> 
         <i class="fas fa-check-circle display-4 text-success"></i><br><br>
         Your have succesfully connected your Stripe account with LocaL2LocaL. You should recieve payouts for your work. If we need more information from you in future, we will let you know. To know full
         information about Stripe Account.
      </div>
      <div class="p-2 card-1 m-1">
         <div class="fs-2 text-success"> 
            {{number_format($stripe_balance->available[0]->amount/100,2)}} 
            <span class="text-uppercase fs--1">
               {{$stripe_balance->available[0]->currency}}
            </span>
         </div> 
         <span>Available Balance</span>
      </div>
      <div class="p-2 card-1 m-1">
         <div class="fs-2 text-success"> 
            {{number_format($stripe_balance->pending[0]->amount/100,2)}} 
            <span class="text-uppercase fs--1">
               {{$stripe_balance->pending[0]->currency}}
            </span>
         </div> 
         <span>Pending Balance</span>
      </div>
      @else
      <div class="p-2 card-1 m-1">
         <i class="fas fa-exclamation-circle display-4 text-danger"></i> <br><br>
         Your do not have Stripe account set up with us. To enable payout please visit <a class="text-primary" href="{{URL::to('/')}}/banking">{{URL::to('/')}}/banking</a> in any secure browser. 
         Once you complete your Stripe account set-up, your account details will appear here.
      </div>
      @endif
   </div>
</div>
@endsection