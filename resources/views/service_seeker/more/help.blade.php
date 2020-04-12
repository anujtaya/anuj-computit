@extends('layouts.service_seeker_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">   <a href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Help <br><span class="fs--2 text-muted font-weight-normal">Help & Support</span></div>
         </div>
      </div>
      <div class="col-lg-12  bg-white p-3 mt-2  border-d">
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
               </div>
            </div>
            <div class="form-group pl-3 pt-2 row">
               <button class="btn theme-background-color btn-sm fs--1">Submit </button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection