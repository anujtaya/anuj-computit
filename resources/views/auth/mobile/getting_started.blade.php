@extends('layouts.app')
@section('content')
<div class="container ">
   <div class="row mt-4s justify-content-center">
      <div class="col-md-4 borders">
         <div class="card shadow-none p-3 text-center">
         <h5 class="fs-1 mt-4 borders" style="margin-top:55px!important;">   Start Connecting with Locals</h5>
          <p class="fs--1 mt-4 ">This is a great place to have so much of your work done and get connected to your locals. This is a great place to have so much of your work done and get connected to your locals.</p>
          <a class="btn btn-info rounded-3 borders card-2 ml-4 mr-4 mt-4"  href="{{route('login')}}" >Let's Get Started <i class="ml-2 fas fa-arrow-right"></i></a>
          <img src="{{asset('/images/svg/l2l-getting-started.svg')}}" class="img-fluid " style="margin-top:90px;" alt="LocaL2LocaL - Getting Started SVG Image">
         </div>
      </div>
   </div>
</div>
@endsection