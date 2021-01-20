@extends('layouts.service_seeker_guest_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4"><i class="fas fa-theater-masks theme-color m-1 fs-1"></i></div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">More <br><span class="fs--2 text-muted font-weight-normal">Extras</span></div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <div class="row m-0 text-center fs--1">
            <div class="col-12 p-0">
               <div class="border m-2 rounded p-3">
                  <a href="{{route('guest_service_seeker_more_faqs')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none">           
                     FAQ's
                  </a>  
               </div>
            </div>
            <div class="col-12 p-0">
               <div class="border m-2 rounded p-3">
                  <a href="{{route('guest_partial_mobile_privacy_policy')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none">
                     
                     View Our Privacy Policy
                  </a>  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@include('service_seeker.demo.bottom_navigation_bar')