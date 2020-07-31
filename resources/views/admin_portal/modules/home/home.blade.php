@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Homepage')
@section('content')
@php
   $all_count = DB::table('users')->count();
   $sp_count = DB::table('users')->where('user_type', 1)->count();
   $ss_count = DB::table('users')->where('user_type', 2)->count();
@endphp
<div class="row m-2  ">
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header ">
            Service Provider 
         </div>
         <div class="card-body">
            <span class="display-4">{{$sp_count}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-4  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Service Seeker 
         </div>
         <div class="card-body">
            <span class="display-4">{{$ss_count}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-4  p-1">
      <div class="card h-100 rounded-0 bg-white">
         <div class="card-header ">
            Total (Inc. Admin)
         </div>
         <div class="card-body">
            <span class="display-4">{{$all_count}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-6  p-1">
      <div class="card h-100 rounded-0 bg-white">
         <div class="card-header ">
            Registration Trend Monthly
         </div>
         <div class="card-body">
            @include('admin_portal.modules.charts.reg_treng_partial_monthly')
         </div>
      </div>
   </div>
   <div class="col-lg-6  p-1">
      <div class="card h-100 rounded-0 bg-white">
         <div class="card-header ">
           All Time Registration Trend
         </div>
         <div class="card-body">
            @include('admin_portal.modules.charts.reg_treng_partial_all_time')
         </div>
      </div>
   </div>
</div>

<script>
 window.onload = function() {
        chart_fetch(s_d,e_d);
        chart_fetch_monthly(s_d_m,e_d_m);
    };
</script>
@endsection
