@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-3">
               <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a>
            </div>
            <div class="col-6 font-size-bolder text-center font-weight-bold theme-color">
                Add Certificates
            </div>
            <div class="col-3 text-right">
                <a href="{{route('service_provider_profile_nested')}}" class="theme-color font-weight-bold" onclick="toggle_animation(true);">Next</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-3">
         @include('service_provider.profile.nested.add_certificate_form')
         <div class=" mb-2 text-centers">
            <h1 class="fs--1">Your Certificates</h1>
         </div>
         <ul class="list-group fs--2">
            @foreach($certificates as $certificate)
            <li class="list-group-item">
               <div class="d-flex bd-highlight">
                  <div class="p-1 flex-grow-1 bd-highlight"> {{$certificate->certificate_name}}</div>
                  <div class="p-1 bd-highlight">{{ date('d/m/Y', strtotime($certificate->certificate_expiry)) }}</div>
                  <div class="p-1 bd-highlight"> <a href="{{route('service_provider_delete_certificate', $certificate->id)}}" onclick="toggle_animation(true);" class="text-decoration-none text-danger">Remove</a> </div>
               </div>
            </li>
            @endforeach
         </ul>
      </div>
   </div>
</div>
@endsection