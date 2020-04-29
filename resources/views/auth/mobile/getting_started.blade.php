@extends('layouts.app')
@section('title', 'Getting Started')
@section('content')
<div class="container ">
   <div class="row mt-4s justify-content-center">
      <div class="col-md-4 borders">
         <div class="card shadow-none p-3 text-center">
            <h5 class="fs-1 mt-4 borders" style="margin-top:55px!important;">Start Connecting with Locals</h5>
            <p class="fs--1 mt-4 ">   
               This is a great place to share you skills and talents, whilst giving back to 
               your local community.
            </p>
            <a class="btn btn-info rounded-3 borders card-1 ml-4 mr-4 mt-4 font-weight-normal"  href="{{route('login')}}" onclick="toggle_animation(true);">Let's Get Started <i class="ml-2 fas fa-arrow-right"></i></a>
            <img src="{{asset('/images/svg/l2l-getting-started.svg')}}" class="img-fluid animated rubberBand slow" style="margin-top:90px;" alt="LocaL2LocaL - Getting Started SVG Image">
         </div>
      </div>
   </div>
</div>
@endsection
