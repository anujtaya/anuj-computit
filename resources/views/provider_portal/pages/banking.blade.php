@extends('provider_portal.layout.provider_master')
@section('title', 'Provider Portal Homepage')
@section('content')
<div class="row">
   @if(Session::has('banking_alert'))
   <div class="col-lg-12 pl-2 pr-2 pt-2">
      <div class="alert alert-info">
         {{Session::pull('banking_alert')}}
      </div>
   </div>
   @endif
   @if(Auth::user()->service_provider_payment != null)
   <div class="col-lg-4 pl-2 pr-2 pt-2">
      <div class="card shadow-none border h-100" >
         <div class="card-header bg-secondary  rounded-0">
            <h6 class=" fs--1 text-white">About Your Stripe Account</h6>
         </div>
         <div class="card-body fs--1">
            <i class="fas fa-check-circle display-4 text-success"></i> <br> <br>
            Your have succesfully connected your Stripe account with LocaL2LocaL. You should recieve payouts for your work. If we need more information from you in future, we will let you know. To know full
            information about Stripe Account, please <a href="{{route('app_portal_provider_banking')}}?full_stripe_info=true">click here</a>.
         </div>
      </div>
   </div>
   @if(isset($stripe_record))
   <div class="col-lg-4 pl-2 pr-2 pt-2">
      <div class="card shadow-none border h-100" >
         <div class="card-header bg-secondary  rounded-0">
            <h6 class=" fs--1 text-white">Stripe Account Summary</h6>
         </div>
         <div class="card-body fs--1">
            <table class="table table-striped table-sm fs--1">
               <tbody>
                  <tr>
                     <th>Email</th>
                     <td>{{$stripe_record->email}}</td>
                  </tr>
                  <tr>
                     <th>Payouts Enabled</th>
                     <td class="text-uppercase">
                        @if(!$stripe_record->payouts_enabled)
                        NO
                        @else 
                        Yes
                        @endif
                     </td>
                  </tr>
                  <tr>
                     <th>Account Type</th>
                     <td class="text-uppercase">{{$stripe_record->type}}</td>
                  </tr>
                   <tr>
                     <th>Available Balance</th>
                     <td class="">
                        {{number_format($stripe_balance->available[0]->amount/100,2)}} 
                        <span class="text-uppercase">
                         {{$stripe_balance->available[0]->currency}}
                         </span>
                     </td>
                  </tr>
                   <tr>
                     <th>Pending Balance</th>
                     <td class="">
                        {{$stripe_balance->pending[0]->amount}} 
                        <span class="text-uppercase">
                        
                         {{$stripe_balance->pending[0]->currency}}
                         </span>
                     </td>
                  </tr>
                   <tr>
                     <th>Stripe Single Sign on</th>
                     <td class="">
                        <a href="{{route('app_portal_provider_banking_single_on_link')}}" target="_blank">
                           Login to Dashboard
                        </a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   @endif
   @else 
   <div class="col-lg-4 pl-2 pr-2 pt-2">
      <div class="card border h-100" >
         <div class="card-header bg-secondary  rounded-0">
            <h6 class=" fs--1 text-white">Connect to using Stripe Express</h6>
         </div>
         <div class="card-body">
            <p class="fs--1 mt-2">
               LocaL2LocaL uses Stripe payment gateway to process all our Service Provider Payouts.
               If you all the information ready it will only take less than 2 minutes to set-up up your LocaL2LocaL stripe connect account.
               You can complete this step at any time but we recommend you to set up you Stripe Express account as soon as you complete your first job.
               Click the link below to connect your Stripe express accoumnt.
            </p>
            <a href="https://connect.stripe.com/express/oauth/authorize?redirect_uri={{route('app_portal_provider_banking_stripe_onboarding')}}&client_id=ca_CrfR8KbSh1WCjtNAhblWc9NCjpgiqo8a&state={STATE_VALUE}&stripe_user[business_type]=individual&stripe_user[email]={{Auth::user()->email}}&stripe_user[country]=AU&stripe_user[phone_number]={{substr('000000000000',2)}}&stripe_user[first_name]={{Auth::user()->first}}&stripe_user[last_name]={{Auth::user()->last}}" class="">
            <img src="{{asset('images/stripe/light-on-dark@3x.png')}}" class="img-fluid" style="width:200px;" alt="Stripe Connect Button Image">
            </a>
         </div>
      </div>
   </div>
   @endif
</div>
@endsection