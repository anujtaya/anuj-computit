@php
   //calculte the final job price payable if paid using stripe.
   $stripe_fixed_fee = 0.30;
   $stripe_fixed_percentage = 1.75;
   $job_price = $job_payment->job_price;
   $credit_card_processing_fee =  round(($stripe_fixed_percentage/100)*($job_price),2);                    
   $credit_card_processing_fee += $stripe_fixed_fee;
   $final_payable_amount = $job_price + $credit_card_processing_fee;
@endphp

<table class="table table-sm  fs--1 table-borderless">
   <tr>
      <td class="theme-color" >Payment Method: </td>
      <td class="text-right"> Card</td>
   </tr>
   <tr>
      <td class="theme-color">Total Job Price: </td>
      <td class="text-right"> ${{number_format($job_price, 2)}} </td>
   </tr>
   <tr>
      <td class="theme-color">Stripe Processing Fee: <small>({{$stripe_fixed_percentage}}% + {{number_format($stripe_fixed_fee,2)}}) </small> </td>
      <td class="text-right"> ${{number_format($credit_card_processing_fee, 2)}} </td>
   </tr>
   <tr>
      <td class="theme-color">Total Payable Price: </td>
      <td class="text-right"> ${{number_format($final_payable_amount, 2)}} </td>
   </tr>
</table>
<div class="m-1">
   <div class="p-2 border rounded fs--1 mt-2">
      <span>Select a Card to pay from</span> <br> <br>
      <ul class="list-group">
         @php
         $stripe_payment_source = Auth::user()->service_seeker_stripe_payment;
         $card_sources = [];
         if($stripe_payment_source != null) {
         $card_sources = $stripe_payment_source->sss_payment_sources;
         }
         @endphp
         @if(count($card_sources) > 0)
         @foreach($card_sources as $source)
         <li class="list-group-item fs--2">
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
         @else
         <span class="text-warning">No cards found. Please add a card using the form below.</span> 
         @endif
      </ul>
      <br><br>
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
</div>
<!-- payment button  -->
<div class="m-1">
   <form action="{{route('service_seeker_process_job_payment_pay_with_stripe')}}" method="POST" onsubmit="toggle_animation(true);">
      @csrf
      <input type="hidden" name="stripe_payment_job_id" value="{{$job->id}}">
      <button type="submit" class="btn btn-success btn-block shadow text-white mt-4"   @if(count($card_sources) == 0) disabled @endif >Confirm Payment ${{number_format($final_payable_amount, 2)}}</button>
      <br>
      <span class="text-warning fs--2">Your default card will be used to process the payment. Please refer to our privacy policy to know more.</span> 
   </form>
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