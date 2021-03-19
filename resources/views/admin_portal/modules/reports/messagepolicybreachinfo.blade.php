@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Reports - Job Analytics')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="{{route('app_portal_admin_reports_all')}}">Reports/Analytics</a></li>
            <li class="breadcrumb-item"><a href="{{route('app_portal_admin_reports_messagepolicybreaches')}}">Message Policy Breach Records</a></li>
            <li class="breadcrumb-item active" aria-current="page">Record #{{$log->id}}</li>
         </ol>
      </nav>
   </div>
</div>
<div class="row m-2">
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            @if($log->status == 'OPEN')
            <span class="badge badge-success font-weight-normal">OPEN</span>
            @elseif($log->status == 'CLOSED')
            <span class="badge badge-secondary font-weight-normal">CLOSED</span>
            @endif   
            Message Policy Breach ID #{{$log->id}}
            <a href="{{route('app_portal_admin_jobs_job', $log->conversation->job_id)}}" target="_blank" class="float-right">Naviagate to Job</a>
         </div>
         <div class="card-body">
            <!-- conversation messages info  -->
            @php 
            $conversation = $log->conversation;
            $job = $conversation->job;
            @endphp
            <ul class="list-group">
            <li class="list-group-item card-1 mt-3 rounded border-0 p-0" onclick="location.href= app_url + '/service_seeker/jobs/job/{{$job->id}}';toggle_animation(true);">
               <div class="p-2">
                  Conversation Status: 
                  @if($conversation->status == 'OPEN')
                  <span class="badge badge-success font-weight-normal p-2">OPEN</span>
                  @elseif($conversation->status == 'CLOSED')
                  <span class="badge badge-danger font-weight-normal p-2">CLOSED/DELETED</span>
                  @endif  
               </div>
               <div class="d-flex pl-2 pr-2 pt-2 bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold">
                     <h4> Service Provider: {{$conversation->service_provider_profile->first}} {{$conversation->service_provider_profile->last}}</h4>
                  </div>
               </div>
               <div class=" p-2" >
                  @if($conversation->json != null)
                  {{$conversation->service_provider_profile->first}} has offered to complete this job for ${{number_format($conversation->json['offer'],2)}}. Offer Description: {{$conversation->json['offer_description']}}.
                  @else
                  {{$conversation->service_provider_profile->first}} hasn’t made any job offers for this job.
                  @endif
               </div>
               <div class="p-2">
                  <span>Conversation information: </span> <br><br>
                  @php  
                  $msgs = $conversation->conversation_messages;
                  @endphp
                  @foreach($msgs as $msg)
                  <!-- Reciever Message  -->
                  @if($job->service_seeker_id == $msg->user_id)
                  <div class="media fs--2 w-50 ml-auto">
                     <div class="media-body">
                        <div class="py-2 px-3 mb-2 rounded" style="background:#399BDB!important;color:white!important;" >
                           <p class=" mb-0 text-white text-break">{{$msg->text}}</p>
                        </div>
                        <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
                     </div>
                  </div>
                  @else
                  <!-- sender message -->
                  <div class="media fs--2 w-50 mb-1">
                     <div class="media-body">
                        <div class=" py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;" >
                           <p class=" mb-0 text-white">{{$msg->text}}</p>
                        </div>
                        <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
                     </div>
                  </div>
                  @endif
                  @endforeach
               </div>
            </li>
            <!-- end conversation messages info  -->
         </div>
      </div>
   </div>
</div>
@endsection