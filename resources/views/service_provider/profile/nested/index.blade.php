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
<div class="container " style="margin-bottom:40%;">
   <div class="row  justify-content-center" >
   <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <ul class="nav nav-pills nav-fill m-2 fs--1 " id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'userbasic') active @endif" id="userbasic-tab" data-toggle="tab" href="#userbasic" role="tab" aria-controls="userbasic" aria-selected="true">Basic Info</a>
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
           
         </div>
      </div>
      <div class="col-lg-12 mt-2 p-0" style="overflow:scroll; min-height:1200px;"> 
         @include('service_provider.profile.nested.service_provider_profile_partial')
      </div>
   </div>
</div>
<!-- end service selector -->
@include('service_provider.bottom_navigation_bar')
@endsection
