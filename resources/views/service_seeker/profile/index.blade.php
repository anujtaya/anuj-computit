@extends('layouts.service_seeker_master')
@section('content')
<style>
   .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
   color: #fff!important;
   background-color: #2c7be5;
   }
</style>
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">    <i class="fas fa-user theme-color m-1 fs-1"></i> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">My Profile <br><span class="fs--2 text-muted font-weight-normal">{{Auth::user()->first}} {{Auth::user()->last}}</span></div>
            <div class="col-4 text-right">
            <a href="{{ secure_url('logout')}}" class="text-danger fs--1">Logout</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <ul class="nav nav-pills nav-fill m-2 fs--1 " id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link active" id="userbasic-tab" data-toggle="tab" href="#userbasic" role="tab" aria-controls="userbasic" aria-selected="true">Basic Info</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="usersecurity-tab" data-toggle="tab" href="#usersecurity" role="tab" aria-controls="usersecurity" aria-selected="false"> Security</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="userrating-tab" data-toggle="tab" href="#userrating" role="tab" aria-controls="userrating" aria-selected="false">Rating</a>
            </li>
         </ul>
         <div class="tab-content mt-2 " id="myTabContent">
            <div class="tab-pane fade show active  fs--1" id="userbasic" role="tabpanel" aria-labelledby="userbasic-tab">
               @include('service_seeker.profile.basic')
            </div>
            <div class="tab-pane fade  fs--1" id="usersecurity" role="tabpanel" aria-labelledby="usersecurity-tab">
               @include('service_seeker.profile.password')
            </div>
            <div class="tab-pane fade fs--1" id="userrating" role="tabpanel" aria-labelledby="userrating-tab">
               @include('service_seeker.profile.ratings')
            </div>
         </div>
      </div>
      <div class="col-lg-12 pl-3 pr-3 mt-4 border-d">
      </div>
   </div>
</div>



<!-- end service selector -->
@include('service_seeker.bottom_navigation_bar')
@endsection
