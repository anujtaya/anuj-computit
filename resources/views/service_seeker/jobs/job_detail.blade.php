@extends('layouts.service_seeker_master')
@section('content')
<style>
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff!important;
    background-color: #2c7be5;
}
</style>
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">  <a href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a>  </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Job <br><span class="fs--2 text-muted font-weight-normal">#345678</span></div>
            <div class="col-4 text-right">

              @if($job->status == 'APPROVED')
                <span class="badge p-2 fs--2 font-weight-normal" style="border-radius:20px!important; background-color: #00B95C; color: white">{{$job->status}}</span>
              @elseif($job->status == 'PENDING')
                <span class="badge p-2 fs--2 font-weight-normal" style="border-radius:20px!important; background-color: #EB88A0; color: white">{{$job->status}}</span>
              @elseif($job->status == 'OPEN')
                <span class="badge  badge-success p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">{{$job->status}}</span>
              @elseif($job->status == 'WORK-IN-PROGRESS')
                <span class="badge  badge-success p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">{{$job->status}}</span>
              @endif

            </div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
         <ul class="nav nav-pills nav-fill m-2 fs--1 " id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link active" id="joboverview-tab" data-toggle="tab" href="#joboverview" role="tab" aria-controls="joboverview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="jobdetail-tab" data-toggle="tab" href="#jobdetail" role="tab" aria-controls="jobdetail" aria-selected="false"> Details</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="jobimages-tab" data-toggle="tab" href="#jobimages" role="tab" aria-controls="jobimages" aria-selected="false">Photos</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link" id="jobhelp-tab" data-toggle="tab" href="#jobhelp" role="tab" aria-controls="jobhelp" aria-selected="false">Help</a>
            </li>
         </ul>
         <div class="tab-content mt-4 " id="myTabContent">
            <div class="tab-pane fade show active  fs--1" id="joboverview" role="tabpanel" aria-labelledby="joboverview-tab">
                @include('service_seeker.jobs.job_overview_partial')
            </div>
            <div class="tab-pane fade  fs--1" id="jobdetail" role="tabpanel" aria-labelledby="jobdetail-tab">
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
      <div class="col-lg-12 pl-3 pr-3 mt-4 border-d">
      </div>
   </div>
</div>
@endsection
