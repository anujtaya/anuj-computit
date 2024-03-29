@extends('layouts.service_seeker_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">   <a href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Wallet</div>
         </div>
      </div>
      <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
         @if(Session::has('success'))
         <div class="alert alert-success fs--1">
            {{Session::pull('success')}}
         </div>
         @endif
         @if(Session::has('error'))
         <div class="alert alert-danger fs--1">
            {{Session::pull('error')}}
         </div>
         @endif
         <div class="p-2 shadow-sm rounded">
            <h6 class=""><strong>Payment Source</strong></h6>
            <div class="m-1">
               <h6>Stripe</h6>
               <!-- source list with default selection  -->
               <div class="m-1">
                  <ul class="list-group">
                     @php
                     $stripe_payment_source = Auth::user()->service_seeker_stripe_payment;
                     $card_sources = [];
                     if($stripe_payment_source != null) {
                     $card_sources = $stripe_payment_source->sss_payment_sources;
                     }
                     @endphp
                     @foreach($card_sources as $source)
                        <li class="list-group-item">
                           @if($source->brand == 'Visa') <i class="fab fa-cc-visa"></i> @elseif($source->brand == 'MasterCard') <i class="fab fa-cc-mastercard"></i> @else <i class="far fa-credit-card"></i>@endif**{{$source->last_4}} Expires:{{date('m/Y', strtotime($source->expiry))}}
                              @if($source->is_default)
                              <br>
                              <span class="theme-color" ><i class="fas fs--1 fa-check-square"></i> Default</span>
                              @else
                              <form action="{{route('service_seeker_more_wallet_stripe_change_customer_default_card')}}" id="form-{{$source->id}}" class="m-0"  method="POST">
                                 @csrf
                                 <input type="hidden" name="source_id" value="{{$source->id}}">
                                 <span class="theme-color"  onclick="$('#form-'+ {{$source->id}}).submit();toggle_animation(true);"><i class='far fs--1 fa-square'></i> Make Default</span>
                              </form>
                              @endif
                              @if(!$source->is_default)
                              <a href="{{route('service_seeker_more_wallet_stripe_delete_customer_card', $source->id)}}" class="text-danger" onclick="return confirm('Are you sure you want to remove this card?')"><i class="far fa-square"></i> Remove</a>
                              @endif
                        </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="p-2 shadow-sm rounded mt-2">
            <span>Add new Credit/Debit Source</span> <br> <br>
            <form action="{{route('service_seeker_more_wallet_stripe_create_customer')}}" class="my-form needs-validation"  method="post" id="payment-form">
               @csrf
               <div id="card-element" class="mt-1 border rounded p-2">
               </div>
               <div id="card-errors" role="alert"></div>
               <input type="hidden" name="user_id" value="46" />
               <button  class="btn btn-sm theme-background-color fs--2 mt-3 shadow">Add card</button>
            </form>
         </div>
         @if(request()->has('job_id') && request()->has('sp_id'))
           
           
            <div class="p-2 shadow-sm bg-warning text-white rounded mt-2" onclick="location.href='{{route('service_seeker_job_conversation', [ request()->job_id, request()->sp_id])}}?triggermodal=true'" >
               Continue to Job offer confirmation window <i class="fas fa-arrow-circle-right fs-1 float-right"></i>
               <br>
               <br>
               You have a job offer confirmation pending from your previous visit. Please tap here once you added a payment source to your account.
            </div>
         @endif
      </div>
   </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
   var stripe_key = "{{config('app.stripe_public_key')}}";
   var stripe = Stripe(stripe_key);
   var elements = stripe.elements();
   var style = {
     base: {
       color: '#32325d',
       lineHeight: '18px',
       fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
       fontSmoothing: 'antialiased',
       fontSize: '16px',
       '::placeholder': {
         color: '#aab7c4'
       }
     },
     invalid: {
       color: '#fa755a',
       iconColor: '#fa755a'
     }
   };
   var card = elements.create('card', {style: style});
   card.hidePostalCode = true;
   card.mount('#card-element');
   card.addEventListener('change', function(event) {
     var displayError = document.getElementById('card-errors');
     if (event.error) {
      toggle_animation(false);
       displayError.textContent = event.error.message;
     } else {
       displayError.textContent = '';
     }
   });
   
   var form = document.getElementById('payment-form');
   form.addEventListener('submit', function(event) {
     toggle_animation(true);
     event.preventDefault();
     stripe.createToken(card).then(function(result) {
       if (result.error) {
        toggle_animation(false);
         var errorElement = document.getElementById('card-errors');
         errorElement.textContent = result.error.message;
       } else {
         toggle_animation(true);
         stripeTokenHandler(result.token);
       }
     });
   });
   
   function stripeTokenHandler(token) {
     var form = document.getElementById('payment-form');
     var hiddenInput = document.createElement('input');
     hiddenInput.setAttribute('type', 'hidden');
     hiddenInput.setAttribute('name', 'stripeToken');
     hiddenInput.setAttribute('value', token.id);
     form.appendChild(hiddenInput);
     form.submit();
   }
   
</script>
@endsection