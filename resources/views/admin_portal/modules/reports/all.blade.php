@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Reports/Analytics</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Reports List
         </div>
         <div class="card-body">
            <div class="list-group">
               <a href="{{route('app_portal_admin_reports_user_login_analytics')}}" class="list-group-item list-group-item-action">
                  User Login Analytics
               </a>
               <a href="{{route('app_portal_admin_reports_jobs_analytics')}}" class="list-group-item list-group-item-action">
                  Jobs Analytics
               </a>
               <a href="{{route('app_portal_admin_reports_messagepolicybreaches')}}" class="list-group-item list-group-item-action">
                  Message Policy Breach Data
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection