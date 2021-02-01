@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Reports - Job Analytics')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"> <a href="{{route('app_portal_admin_reports_all')}}">Reports/Analytics</a></li>
            <li class="breadcrumb-item active" aria-current="page">Job Analytics</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-3 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header ">
            Total Jobs Created Today
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->jobs_today}}</span>
           
         </div>
      </div>
   </div>
   <div class="col-lg-3  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Total Jobs Completed
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->jobs_completed}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-3  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Total Jobs
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->jobs_total}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-3  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Total Jobs Open
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->jobs_open}}</span>
         </div>
      </div>
   </div>
</div>
<div class="row m-2">
   <div class="col-lg-8 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Reports List - Job Analytics
         </div>
         <div class="card-body">
         <table class="table table-sm table-bordered table-hover" id="users-datatable">
               <thead class="bg-light">
                  <tr>
                     <th>ID</th>
                     <th>Status</th>
                     <th>SeekerID</th>
                     <th>ProviderID</th>
                     <th>Title</th>
                     <th>Created on</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($jobs as $job)
                  <tr>
                     <td>{{$job->id}}</td>
                     <td>
                        @if($job->status == 'OPEN')
                           <span class="badge badge-success font-weight-normal">Open</span>
                        @elseif($job->status == 'APPROVED')
                           <span class="badge badge-success font-weight-normal">Approved</span>
                        @elseif($job->status == 'ONTRIP')"
                           <span class="badge badge-warning font-weight-normal ">On-Trip</span>
                        @elseif($job->status == 'ARRIVED')
                           <span class="badge badge-secondary font-weight-normal ">Arrived</span>
                        @elseif($job->status == 'STARTED')
                           <span class="badge badge-warning font-weight-normal ">In-Progress</span>
                        @elseif($job->status == 'COMPLETED')
                           <span class="badge badge-secondary font-weight-normal ">COMPLETED</span>
                        @elseif($job->status == 'EXPIRED')
                           <span class="badge badge-secondary font-weight-normal ">EXPIRED</span>
                        @elseif($job->status == 'CANCELLED')
                           <span class="badge badge-danger font-weight-normal">CANCELLED</span>
                        @endif    
                     </td>
                     <td><a href="{{route('app_portal_admin_users_profile', $job->service_seeker_id)}}">{{$job->service_seeker_id}}</a></td>
                     <td>
                        @if($job->service_provider_id != null)
                           <a href="{{route('app_portal_admin_users_profile', $job->service_provider_id)}}">{{$job->service_provider_id}}</a>
                        @endif
                     </td>
                     <td>{{$job->title}}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($job->created_at)) }}</td>
                     <td>
                     <a href="{{route('app_portal_admin_jobs_job', $job->id)}}">View</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $jobs->links() }}
         </div>
      </div>
   </div>
</div>
@endsection