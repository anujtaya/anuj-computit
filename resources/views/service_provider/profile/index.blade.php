@extends('layouts.service_provider_master')
@section('content')
<!-- php code to detect current tab  -->
@if(Session::has('current_tab'))
@php
$currentUserTab = Session::pull('current_tab');
@endphp
@else
@php
$currentUserTab = 'userbasic';
@endphp
@endif
<!-- end php code to detect current tab  -->
<div class="container ">
   <div class="row  justify-content-center" >
   <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4"><a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">My Profile <br><span class="fs--2 text-muted font-weight-normal">{{Auth::user()->first}} {{Auth::user()->last}}</span></div>
            <div class="col-4 text-right">
            <a href="{{ secure_url('logout')}}" onclick="toggle_animation(true);" class="text-danger fs--1">Logout</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <ul class="nav nav-pills nav-fill m-2 fs--1 " id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'userbasic') active @endif" id="userbasic-tab" data-toggle="tab" href="#userbasic" role="tab" aria-controls="userbasic" aria-selected="true">Basic Info</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'userbusiness') active @endif " id="userbusiness-tab" data-toggle="tab" href="#userbusiness" role="tab" aria-controls="userbusiness" aria-selected="false">Business Info</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'usersecurity') active @endif " id="usersecurity-tab" data-toggle="tab" href="#usersecurity" role="tab" aria-controls="usersecurity" aria-selected="false"> Security</a>
            </li>
         </ul>
         <div class="tab-content mt-2 " id="myTabContent">
            <div class="tab-pane fade fs--1 @if($currentUserTab  == 'userbasic') show active @endif " id="userbasic" role="tabpanel" aria-labelledby="userbasic-tab">
               @include('service_provider.profile.basic')
            </div>
            <div class="tab-pane fade fs--1 @if($currentUserTab  == 'usersecurity') show active @endif" id="usersecurity" role="tabpanel" aria-labelledby="usersecurity-tab">
               @include('service_provider.profile.password')
            </div>
            <div class="tab-pane fade fs--1 @if($currentUserTab  == 'userbusiness') show active @endif" id="userbusiness" role="tabpanel" aria-labelledby="userbusiness-tab">
               @include('service_provider.profile.businessinfo')
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
