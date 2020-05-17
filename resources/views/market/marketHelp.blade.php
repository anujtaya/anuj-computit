@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Help and FAQ for Customers
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container bg-white p-4 ">
   <div class="p-2  m-1">
      <br>
      <br>
      <br>
      <br>
      <h3 class="w3-center"><strong>Get Help</strong></h3>
      <br><br>
      <div class="row">
         <div class="col-lg-2">
         </div>
         <div class="col-lg-8">
               @if(Session::has('status'))
                  <div class="alert alert-info fs--1">
                     {{Session::pull('status')}}
                  </div>   
               @endif
               <form action="{{route('app_services_support_send_support_email')}}" method="POST" onsubmit="toggle_animation(true);">
                  @csrf
                  <div class="form-group row">
                     <label for="support_type" class="col-md-4 col-form-label fs--1 text-md-right">Select  help type</label>
                     <div class="col-md-8">
                        <select  class="form-control form-control-sm @error('support_type') is-invalid @enderror" name="support_type" id="support_type" required>
                           <option value="General Help">General Help</option>
                           <option value="Job Help">Job Help</option>
                           <option value="Feedback">Feedback</option>
                           <option value="Payment Help">Payment Help</option>
                           <option value="Category Suggestions">Category Suggestions</option>
                           <option value="Other">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="support_message" class="col-md-4 col-form-label fs--1 text-md-right">Write your message below</label>
                     <div class="col-md-8">
                        <textarea class="form-control form-control-sm @error('support_message') is-invalid @enderror" name="support_message" id="support_message" cols="30" rows="10" required placeholder="Please type in your comments here.."></textarea>
                        @error('support_message')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br><br>
                        <button class="btn btn-primary rounded-0 ">Submit </button>
                     </div>
                  </div>
               </form>
         </div>
         <div class="col-lg-2">
         </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
   </div>
</div>
@endsection