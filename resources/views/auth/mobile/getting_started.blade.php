@extends('layouts.app')
@section('title', 'Getting Started')
@section('content')
<div class="container ">
   <div class="row mt-4s justify-content-center">
      <div class="col-md-4 borders">
         <div class="card shadow-none p-1 text-center">
            <div class="text-center mt-4">
               <img src="{{asset('/images/brand/l2l-logo-registered.svg')}}" class="img-fluid animated flipTop" style="height:60px;width:60px;"  alt="LocaL2LocaL - Registered Mark SVG Image">
            </div>
            <h5 class="fs-1 mt-4" style="font-family: Verdana!important;font-weight: bold;color:#575757!important;">Start Connecting with Locals</h5>
            <p class="fs--1 mt-4">   
               This is a great place to share you skills and talents, whilst giving back to 
               your local community.
            </p>
            <a class="btn btn-info rounded-3 borders custom_button_shadow ml-4 mr-4 mt-4 font-weight-normal"  href="{{route('guest_service_seeker_home')}}" onclick="toggle_animation(true);">Let's Get Started <i class="ml-2 fas fa-arrow-right"></i></a>
            <img src="{{asset('/images/svg/l2l-getting-started.svg')}}" class="img-fluid animated rubberBand slow" style="margin-top:90px;" alt="LocaL2LocaL - Getting Started SVG Image">
         </div>
      </div>
   </div>
</div>
@endsection
