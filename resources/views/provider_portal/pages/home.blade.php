@extends('provider_portal.layout.provider_master')
@section('title', 'Provider Portal Homepage')
@section('content')
<nav aria-label="breadcrumb" class="mb-3 p-0">
   <ol class="breadcrumb p-0 m-0">
      <li class="breadcrumb-item active" aria-current="page">Home</li>
   </ol>
</nav>
<div class="row">
   <div class="col-lg-4 pl-2 pr-2 pt-2">
      <div class="card shadow-none border h-100" >
         <div class="card-body">
            <h6 class="mb-3 fs-1">Performance Stats</h6>
          
               <div class="fs--1 bd-highlight">
                  <span class="fs-1">{{$stats->percentage}}%</span> <br>
                  Completion Rate
               </div>
               <hr>
               <div class="fs--1 bd-highlight">
                  <span class="fs-1">{{$stats->rating}} </span> <br>
                  <span class="text-warning">
                  @for($i=0;$i<intval($stats->rating);$i++)
                        <i class="fas fa-star mt-0"></i> 
                  @endfor
                  </span>
               </div>
          
         </div>
      </div>
   </div>
   <div class="col-lg-4 pl-2 pr-2 pt-2">
      <div class="card shadow-none border  h-100" >
         <div class="card-body">
            <h6 class="mb-3 fs-1">Welcome to Provider Portal {{Auth::user()->first}}!</h6>
            <p class="fs--1">
               The provider portal will help you access resources dedicated to LocaL2LocaL Service Providers. Please 
               use the portal to update your account information and banking details. You can also download invoices for all your jobs on this portal.
            </p>
         </div>
      </div>
   </div>
</div>
@endsection
