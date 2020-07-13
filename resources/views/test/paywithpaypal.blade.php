@extends('layouts.app')
@section('content')
<div class="row justify-content-center" style="margin-block-top:55px;">
   <div class="col-lg-6 p-2">
      <div class="card shadow-none  bg-white  shadow">
         <div class="card-header border-bottom bg-light">
            <b>Checkout Demo </b>
         </div>
         <div class="card-body">
            @if ( Session::has('success'))
            <div class="alert alert-success">{{ Session::pull('success')}}</div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::pull('error')}}</div>
            @endif
            <form class="" method="POST" id="payment-form"
               action="{!! URL::to('paypal') !!}">
               @csrf
               <label class="">Enter Amount</label>
               <input class="form-control form-control-sm rounded-0" id="amount" type="text" name="amount" required>
               <br>
               <button class="btn theme-background-color btn-sm rounded-0">Pay with PayPal</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection