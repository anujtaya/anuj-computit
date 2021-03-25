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
   <div class="col-lg-12 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Reports List - Message Policy Breach Records
         </div>
         <div class="card-body">
         <table class="table table-sm table-bordered table-hover">
               <thead class="bg-light">
                  <tr>
                     <th>Status</th>
                     <th>Source</th>
                     <th>Conversation ID</th>
                     <th>User Id</th>
                     <th>Message</th>
                     <th>Created on</th>
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
                     <td>{{$log->source}}</td>
                     <td>
                        @if($log->conversation_id != null)
                           <a href="{{route('app_portal_admin_reports_messagepolicybreachinfo', $log->id)}}" target="_blank">{{$log->conversation_id}}</a>
                        @else
                           NA
                        @endif
                     </td>
                     <td>
                        @if($log->user_id != null)
                           <a href="{{route('app_portal_admin_users_profile', $log->user_id)}}" target="_blank">{{$log->user_id}}</a>                         
                        @else
                           NA
                        @endif
                     </td>
                     <td>
                        {{$log->reported_message_text}}
                     </td>
                     <td>{{ date('d/m/Y h:iA', strtotime($log->created_at)) }}</td>
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