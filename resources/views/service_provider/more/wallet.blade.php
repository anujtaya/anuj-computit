@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-2">   <a href="{{route('service_provider_more')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
            <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">Payouts  <br><span class="fs--2 text-muted font-weight-normal">Banking Information</span></div>
            <div class="col-2"></div>
         </div>
      </div>
      <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
         
      </div>
   </div>
</div>
@endsection