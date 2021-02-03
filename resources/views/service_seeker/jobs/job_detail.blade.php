@extends('layouts.service_seeker_master')
@section('content')
<style>
   .modal-backdrop {
   position:;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 0;
   background-color:transparent;
   }
   .modal {
   z-index:9000;
   }
   .fade {
   transition: opacity .15s linear;
   }
   .pure-material-progress-linear {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   border: none;
   height: 0.25em;
   color: rgb(var(--pure-material-primary-rgb, 33, 150, 243));
   background-color: rgba(var(--pure-material-primary-rgb, 33, 150, 243), 0.12);
   font-size: 16px;
   min-width: 100%;
   }
   .pure-material-progress-linear::-webkit-progress-bar {
   background-color: transparent;
   }
   /* Determinate */
   .pure-material-progress-linear::-webkit-progress-value {
   background-color: currentColor;
   transition: all 0.2s;
   }
   .pure-material-progress-linear::-moz-progress-bar {
   background-color: currentColor;
   transition: all 0.2s;
   }
   .pure-material-progress-linear::-ms-fill {
   border: none;
   background-color: currentColor;
   transition: all 0.2s;
   }
   /* Indeterminate */
   .pure-material-progress-linear:indeterminate {
   background-size: 200% 100%;
   background-image: linear-gradient(to right, transparent 50%, currentColor 50%, currentColor 60%, transparent 60%, transparent 71.5%, currentColor 71.5%, currentColor 84%, transparent 84%);
   animation: pure-material-progress-linear 2s infinite linear;
   }
   .pure-material-progress-linear:indeterminate::-moz-progress-bar {
   background-color: transparent;
   }
   .pure-material-progress-linear:indeterminate::-ms-fill {
   animation-name: none;
   }
   @keyframes pure-material-progress-linear {
   0% {
   background-size: 200% 100%;
   background-position: left -31.25% top 0%;
   }
   50% {
   background-size: 800% 100%;
   background-position: left -49% top 0%;
   }
   100% {
   background-size: 400% 100%;
   background-position: left -102% top 0%;
   }
   }
</style>
<!-- custom nav style based on job status  -->
@if($job->status == 'APPROVED' || $job->status == 'ONTRIP' || $job->status == 'ARRIVED' || $job->status == 'STARTED' || $job->status == 'COMPLETED')
<style>
   .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
   color: #fff!important;
   background-color: rgb(0, 185, 92)!important;
   box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
   transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
   }
</style>
@else 
<style>
   .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
   color: #fff!important;
   background-color: #2c7be5;
   box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
   transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
   }
</style>
@endif
<!-- end custom styles  -->
<!-- php code to detect current tab  -->
@if(Session::has('current_tab'))
@php
$currentUserTab = Session::pull('current_tab');
@endphp
@else
@php
$currentUserTab = 'joboverview';
@endphp
@endif
<!-- end php code to detect current tab  -->
<div class="container ">
   <div class="row justify-content-center" >
      <div class="col-lg-12 shadow-sm-none bg-white p-0 border-d fixed-top">
         <div class="row pl-2 pr-2 pb-1 pt-3">
            <div class="col-4">  <a href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a>  </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Job <br><span class="fs--2 text-muted font-weight-normal">Unique ID #{{$job->id}}</span></div>
            <div class="col-4 text-right">
               @if($job->status == 'OPEN')
               <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Open</span>
               @elseif($job->status == 'APPROVED')
               <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Approved</span>
               @elseif($job->status == 'ONTRIP')
               <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s " style="border-radius:20px!important;">On-Trip</span>
               @elseif($job->status == 'ARRIVED')
               <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Arrived</span>
               @elseif($job->status == 'STARTED')
               <span class="badge  badge-warning  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">In-Progress</span>
               @elseif($job->status == 'COMPLETED')
               <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated headShake delay-1s" style="border-radius:20px!important;">COMPLETED</span>
               @elseif($job->status == 'EXPIRED')
               <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal animated headShake delay-1s" style="border-radius:20px!important;">EXPIRED</span>
               @elseif($job->status == 'CANCELLED')
               <span class="badge  badge-danger  p-2 fs--2 font-weight-normal animated headShake delay-1s" style="border-radius:20px!important;">CANCELLED</span>
               @endif 
            </div>
            <div class="col-12">
               @if($job->status == 'APPROVED' || $job->status == 'INPROGRESS' || $job->status == 'ONTRIP' || $job->status == 'STARTED' || $job->status == 'OPEN')
               <!-- job cancellation form  -->
               <a class="btn btn-danger text-white btn-sm fs--1 card-1 float-right" href="#" data-toggle="modal" data-target="#job_cancel_confirm_modal">Cancel Job</a>
               @endif
            </div>
         </div>
         <ul class="nav nav-pills shadow-sm pl-2 pr-2 pb-1 nav-fill m-0 fs--1" id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'joboverview') active @endif" id="joboverview-tab" data-toggle="tab" href="#joboverview" role="tab" aria-controls="joboverview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link @if($currentUserTab  == 'jobdetail') active @endif"" id="jobdetail-tab" data-toggle="tab" href="#jobdetail" role="tab" aria-controls="jobdetail" aria-selected="false"> Details</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="jobimages-tab" data-toggle="tab" href="#jobimages" role="tab" aria-controls="jobimages" aria-selected="false">Photos</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link" id="jobhelp-tab" data-toggle="tab" href="#jobhelp" role="tab" aria-controls="jobhelp" aria-selected="false">Help</a>
            </li>
         </ul>
         <!-- progress bar contianer -->
         <div id="prog-container" style="display:none;">
            <progress class="pure-material-progress-linear d-block"/>
         </div>
         <!-- end container -->
      </div>
   </div>
   <div class="p-0" style="margin-top:140px;">
      <div class="tab-content  mt-3" id="myTabContent">
         <div class="tab-pane fade @if($currentUserTab  == 'joboverview')show active @endif  fs--1" id="joboverview" role="tabpanel" aria-labelledby="joboverview-tab">
            @if($job->status == 'OPEN')
            @include('service_seeker.jobs.partial.job_overview_partial_open')
            @elseif($job->status == 'EXPIRED')
            @include('service_seeker.jobs.partial.job_overview_partial_expired')
            @elseif($job->status == 'APPROVED')
            @include('service_seeker.jobs.partial.job_overview_partial_approved')
            @elseif($job->status == 'ONTRIP')
            @include('service_seeker.jobs.partial.job_overview_partial_ontrip')
            @elseif($job->status == 'ARRIVED')
            @include('service_seeker.jobs.partial.job_overview_partial_arrived')
            @elseif($job->status == 'STARTED')
            @include('service_seeker.jobs.partial.job_overview_partial_started')
            @elseif($job->status == 'COMPLETED')
            @include('service_seeker.jobs.partial.job_overview_partial_completed')
            @elseif($job->status == 'CANCELLED')
            @include('service_seeker.jobs.partial.job_overview_partial_cancelled')
            @endif
         </div>
         <div class="tab-pane fade @if($currentUserTab  == 'jobdetail')show active @endif fs--1" id="jobdetail" role="tabpanel" aria-labelledby="jobdetail-tab">
            @include('service_seeker.jobs.job_description_partial')
         </div>
         <div class="tab-pane fade fs--1" id="jobimages" role="tabpanel" aria-labelledby="jobimages-tab">
            @include('service_seeker.jobs.job_images_partial_list')
         </div>
         <div class="tab-pane fade  fs--1" id="jobhelp" role="tabpanel" aria-labelledby="jobhelp-tab">
            @include('service_seeker.jobs.job_help_partial')
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="job_cancel_confirm_modal" tabindex="4" role="dialog" aria-labelledby="job_cancel_confirm_modal_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <span class="fs-1">Are you sure?</span>
            <br>
            <br>
            <p>
               <!-- A cancellation fee of $10.00 may apply if the job is cancelled after being approved. -->
            </p>
            <button class="fs--2 btn-sm btn-danger text-white mr-2" onclick=" $( '#job_cancel_form' ).submit()">Proceed to Cancel</button>
            <button class="fs--2 btn-sm btn-secondary text-white" data-dismiss="modal">Dismiss</button>
         </div>
      </div>
   </div>
</div>
@if($job->status == 'APPROVED' || $job->status == 'ONTRIP' || $job->status == 'ARRIVED' || $job->status == 'STARTED') 
<script>
   var job_status_check_route_url = "{{route('service_seeker_job_request_status_updte')}}";
   var current_status = "{{$job->status}}";
   window.onload = function() {
      setInterval(() => {
      check_job_status_update();
      }, 15000);
   }
   
   function check_job_status_update(){
      prog_load_dis(true);
      $.ajax({
            type: "POST",
            url: job_status_check_route_url,
            data: {
            "_token": csrf_token,
            "job_id": "{{$job->id}}"
            },
            success: function(results){
               if(results != current_status) {
                  location.reload();
               } else {
                  console.log('Job status unchanged.');
               }
               prog_load_dis(false);
            },
            error: function(results, status, err) {
               console.log(err);
               prog_load_dis(false);
            }
      });
   }
</script>
@endif
<script>
   function prog_load_dis(b){
        if(b){
           $("#prog-container").fadeIn();
        } else {
           $("#prog-container").fadeOut();
        }
     }
</script>
@endsection