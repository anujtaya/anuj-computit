@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Reports - Job Analytics')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"> <a href="{{route('app_portal_admin_reports_all')}}">Reports/Analytics</a></li>
            <li class="breadcrumb-item active" aria-current="page">Message Policy Breach Records</li>
         </ol>
      </nav>
   </div>
</div>
<div class="row m-2">
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Reports List - Message Policy Breach Records
         </div>
         <div class="card-body">
         <table class="table table-sm table-bordered table-hover">
               <thead class="bg-light">
                  <tr>
                     <th>Status</th>
                     <th>Conversation ID</th>
                     <th>Created on</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($logs as $log)
                  <tr>
                     <td>
                        @if($log->status == 'OPEN')
                           <span class="badge badge-success font-weight-normal">OPEN</span>
                        @elseif($log->status == 'CLOSED')
                           <span class="badge badge-secondary font-weight-normal">CLOSED</span>
                        @endif    
                     </td>
                     <td>{{$log->conversation_id}}</td>
                    
                     <td>{{ date('d/m/Y h:iA', strtotime($log->created_at)) }}</td>
                     <td>
                     <a href="{{route('app_portal_admin_reports_messagepolicybreachinfo', $log->id)}}">View Conversation Info</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $logs->links() }}
         </div>
      </div>
   </div>
</div>
@endsection