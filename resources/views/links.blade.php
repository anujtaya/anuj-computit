@extends('layouts.app')
@section('content')
<style></style>
<div class="container">
   <div class="row">
      <div class="col-lg-4 p-3 border">
         <h1 class="fs--1">Login/Signup Pages</h1>
         <ul class="list-group fs--2">
            <li class="list-group-item p-1">
               <a href="{{url('/root')}}">Getting Started</a>
            </li>
            <li class="list-group-item p-1 p-1">
               <a href="{{url('/login')}}">Login</a>
            </li>
            <li class="list-group-item p-1 p-1">
               <a href="{{url('/register_1')}}">Register</a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{url('/register_2')}}">Phone Verification 1</a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{url('/register_3')}}">Phone Verification Confirmation</a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{url('/register_4')}}">Forgot password</a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{url('/ss_1')}}">Service Seeker - Steps</a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{url('/sp_1')}}">Service Provider - Steps</a>
            </li>
         </ul>
      </div>
      <div class="col-lg-4 p-3 border">
         <h1 class="fs--1">Service Seeker</h1>
         <ul class="list-group fs--2">
            <li class="list-group-item p-1">
               <a href="{{route('service_seeker_home')}}">   
                 Home Page
               </a>
            </li>
            <li class="list-group-item p-1">
               <a href="{{route('service_seeker_jobs')}}">   
                  Jobs Page
               </a> 
            </li>
            <li class="list-group-item p-1">
               <a href="{{route('service_seeker_profile')}}">   
                  Service Seeker Profile
               </a> 
            </li>
            <li class="list-group-item p-1">
               <a href="{{route('demo_car_map_demo')}}">   
                  Car Map Demo
               </a> 
            </li>
         </ul>
      </div>
   </div>
</div>
@endsection