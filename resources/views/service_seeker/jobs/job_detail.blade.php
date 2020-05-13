@extends('layouts.service_seeker_master')
@section('content')
<style>
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
   color: #fff!important;
   background-color: #2c7be5;
   box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
   transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
}
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
</style>
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
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Job <br><span class="fs--2 text-muted font-weight-normal">#JB-{{$job->id}}</span></div>
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
               @elseif($job->status == 'CANCELLED')
                  <span class="badge  badge-danger  p-2 fs--2 font-weight-normal animated headShake delay-1s" style="border-radius:20px!important;">CANCELLED</span>
               @endif   
            </div>
            @if($job->job_type == 'INSTANT')
               <div class="col-12 text-right">
                  <span class="badge  badge-warning  p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Instant Job</span> 
               </div>
            @endif
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
      </div>
   </div>
   <div class="p-0" style="margin-top:130px;">
         <div class="tab-content  mt-3" id="myTabContent">
            <div class="tab-pane fade @if($currentUserTab  == 'joboverview')show active @endif  fs--1" id="joboverview" role="tabpanel" aria-labelledby="joboverview-tab">
               @if($job->job_type == 'INSTANT')
                  @include('service_seeker.jobs.partial.job_overview_partial_instant_open')
               @elseif($job->job_type == "BOARD")
                  @if($job->status == 'OPEN')
                     @include('service_seeker.jobs.partial.job_overview_partial_open')
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
@endsection
