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
         <div class="p-3 border rounded">
            <span>Payment Methods</span> <br> <br>
            <div class="d-flex bd-highlight mb-3">
               <div class="p-2 bd-highlight"><i class="fab fa-cc-stripe fs-1 theme-color"></i></div>
               <div class="p-2 bd-highlight">************1234</div>
               <div class="p-2 ml-auto  bd-highlight">  <button class="btn btn-sm fs--2 border-0 bg-danger text-white">Delete</button>  </div>
            </div>
         </div>
         <div class="p-3 border rounded mt-2">
            <span>Payment Methods</span> <br> <br>
            <p>No Payment method available, please enter your card information below.</p>
            <form action="https://local2local.com.au/processCardPaymentSettings" class="my-form needs-validation "  method="post" id="payment-form">
               @csrf
               <div id="card-element" class="h-100 mt-1  border rounded p-2">
               </div>
               <div id="card-errors" role="alert"></div>
               <input type="hidden" name="user_id" value="46" />
               <button  class="btn btn-sm theme-background-color fs--2 mt-3 ">Add card</button>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
   var stripe_key = 'pk_test_S5iD0X5zJI2oplKwgMfHEIdE';
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
       toggleAnim(false);
       displayError.textContent = event.error.message;
     } else {
       displayError.textContent = '';
     }
   });
   
   var form = document.getElementById('payment-form');
   form.addEventListener('submit', function(event) {
     toggleAnim(true);
     event.preventDefault();
     stripe.createToken(card).then(function(result) {
       if (result.error) {
         toggleAnim(false);
         var errorElement = document.getElementById('card-errors');
         errorElement.textContent = result.error.message;
       } else {
         toggleAnim(true);
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