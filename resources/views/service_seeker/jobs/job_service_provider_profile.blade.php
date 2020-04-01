@extends('layouts.service_seeker_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-2"><a href="{{URL::previous()}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left fs-1" style="color:#399BDB!important"></i> </a> </div>
            <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">John Doe <br><span class="fs--2 text-muted font-weight-normal"> Service Provider Profile</span></div>
            <div class="col-2 text-right">
            </div>
         </div>
      </div>
      <div class="col-lg-12 mt-2 p-0" > 
         @include('service_seeker.jobs.job_service_provider_profile_partial')
      </div>
   </div>
</div>
@endsection