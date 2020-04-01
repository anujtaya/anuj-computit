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
         <form action="">
            <div class="form-group row">
               <label for="first" class="col-md-4 col-form-label fs--1 text-md-right">Select  help type</label>
               <div class="col-md-8">
                  <select  class="form-control form-control-sm @error('first') is-invalid @enderror" id="exampleFormControlSelect2">
                     <option>General Help</option>
                     <option>Job Help</option>
                     <option>Feedback</option>
                     <option>Payment Help</option>
                     <option>Other</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="last" class="col-md-4 col-form-label fs--1 text-md-right">Write your message below</label>
               <div class="col-md-8">
                  <textarea name="" class="form-control form-control-sm @error('first') is-invalid @enderror" id="" cols="30" rows="10"></textarea>
                  @error('last')
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