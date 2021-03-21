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
<div class="container " style="max-height: calc(100% - 60em);">
   <div class="row  justify-content-center" >
   
      <div class="col-lg-12 mt-2 p-0" style="overflow:scroll;min-height:3000px;"> 

       
         @include('service_provider.profile.nested.service_provider_profile_partial')
      </div>
   </div>
</div>
<!-- end service selector -->
@include('service_provider.bottom_navigation_bar')
@endsection
