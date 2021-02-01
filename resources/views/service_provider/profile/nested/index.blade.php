@extends('layouts.service_provider_master')
@section('content')
<div class="container " style="margin-bottom:40%;">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 mt-2 p-0" style="overflow:scroll; min-height:1200px;"> 
         @include('service_provider.profile.nested.service_provider_profile_partial')
      </div>
   </div>
</div>
<!-- end service selector -->
@include('service_provider.bottom_navigation_bar')
@endsection
