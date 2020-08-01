@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row m-2">
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            Search Job Using Unique ID
         </div>
         <div class="card-body">
            <form action="{{route('app_portal_admin_jobs_search')}}" method="POST">
               @csrf
               <div class="row">
                  <div class="col-6">
                     <label for="search_job_id">Job ID</label>
                     <input id="search_job_id" type="text" class="form-control" value="{{old('search_job_id')}}" name="search_job_id" placeholder="Enter job id here">
                  </div>
               </div>
               <br>
               <button type="submit" class="btn btn-primary btn-sm rounded-0">Search</button>
               <a href="{{route('app_portal_admin_jobs')}}" class="btn btn-primary btn-sm rounded-0">Reset</a>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-6 p-1">
   </div>
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Jobs
         </div>
         <div class="card-body">
            @if(count($jobs) > 0)
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
                        @elseif($job->status == 'CANCELLED')
                           <span class="badge badge-danger font-weight-normal">CANCELLED</span>
                        @endif    
                     </td>
                     <td>{{$job->service_seeker_id}}</td>
                     <td>{{$job->service_provider_id}}</td>
                     <td>{{$job->title}}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($job->created_at)) }}</td>
                     <td>
                     <a href="{{route('app_portal_admin_jobs_job', $job->id)}}">View</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
               @if(request()->is('app/portal/admin/jobs'))
               {{ $jobs->links() }}
               @endif
            </table>
            @else
            <span class="text-danger">No Jobs Found.</span>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection