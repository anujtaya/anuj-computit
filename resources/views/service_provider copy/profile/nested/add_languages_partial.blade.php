@extends('layouts.service_provider_master')
@section('content')
@push('header-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('header-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endpush
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
         <div class="col-3">
               <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a>
            </div>
            <div class="col-6 font-size-bolder text-center font-weight-bold theme-color">
                Add Languages
            </div>
            <div class="col-3 text-right">
                <a href="{{route('service_provider_profile_nested')}}" class="theme-color font-weight-bold" onclick="toggle_animation(true);">Next</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-3">
         <div class="p-1">     
            <div class="mt-2 text-centers">
               <h1 class="fs-1">Select your language skills</h1>
               <p class="fs--1">If English isn't your first language please pick from the following below</p>
            </div>
            @include('service_provider.language.add_form')
            <ul class="list-group fs--1">
               @foreach($current_languages as $language)
               <li class="list-group-item">               
                  <div class="d-flex bd-highlight">
                     <div class="p-1 flex-grow-1 bd-highlight"> {{$language->language_name}}</div>
                     <div class="p-1 bd-highlight"> <a href="{{route('service_provider_delete_language', $language->id)}}" onclick="toggle_animation(true);" class="text-decoration-none text-danger">Remove</a> </div>
                  </div>      
               </li>   
               @endforeach
            </ul>         
         </div>
      </div>
   </div>
</div>

<script>

$(document).ready(function() { $("#language-select").select2(); });

</script>
@endsection