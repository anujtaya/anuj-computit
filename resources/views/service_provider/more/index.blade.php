@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">   <i class="fas  fa-info-circle theme-color m-1 fs-1" data-toggle="tooltip" data-placement="bottom" title="This page contains the list of additional features for Service Providers. To switch to a Service Seeker profile please click on 'Switch to Seeker'option." ></i> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">More <br><span class="fs--2 text-muted font-weight-normal">Extras</span></div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <div class="row m-0 text-center fs--1">
            <div class="col-6 p-0">
               <div class="border m-2  h-100 rounded  p-3">
                  <a href="{{route('service_provider_more_help')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none"><img src="{{asset('/images/service_seeker/help.svg')}}" height="100px" width="100px" alt=""> <br>
                  Help
                  </a>  
               </div>
            </div>
            <div class="col-6   p-0">
               <div class="border m-2 theme-color  rounded p-3" style="min-height:110px!important;">
                  <a href="{{route('service_provider_more_faqs')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none">
                  <img src="{{asset('/images/service_seeker/faq.svg')}}" height="100px" width="100px" alt=""> <br>
                  FAQ's
                  </a>
               </div>
            </div>
            <div class="col-6  p-0">
               <div class="border m-2  theme-color rounded p-3" style="min-height:110px!important;">
                  <a href="{{route('service_provider_more_wallet')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none">
                  <img src="{{asset('/images/service_seeker/wallet.svg')}}" height="100px" width="100px" alt=""> <br>
                     Payouts
                  </a>
               </div>
            </div>
            <div class="col-6 p-0">
               <div class="border m-2  theme-color rounded  p-3" style="min-height:110px!important;">
                  <a href="{{route('service_seeker_home')}}" onclick="toggle_animation(true);" class="theme-color text-decoration-none">
                  <img src="{{asset('/images/service_seeker/switch.svg')}}" height="100px" width="100px" alt=""> <br>
                  Switch to Seeker
                  </a>
               </div>
            </div>
            <div class="col-12 p-0">
               <div class="border m-2  theme-color  rounded  p-3" style="min-height:50px!important;">
                  <a href="{{route('logout')}}" onclick="toggle_animation(true);" class="text-danger text-decoration-none">
                     <i class="fas fa-sign-out-alt"></i>   Logout
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('service_provider.bottom_navigation_bar')
@endsection