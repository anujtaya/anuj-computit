@extends('layouts.service_provider_master')
@section('content')
@push('header-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
@endpush
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
.fade {
   transition: opacity .15s linear;
}
</style>
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm-none bg-white p-0 border-d fixed-top">
         <div class="row p-3">
            <div class="col-4">  <a href="{{route('service_provider_jobs_history')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a>  </div>
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
               @endif   
            </div>
            <div class="col-12">
            @if($job->status == 'OPEN')
            @elseif($job->status == 'APPROVED')
               <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
                     @csrf
                     <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
                     <button class="btn btn-danger text-white btn-sm fs--1 card-1 float-right">Cancel Job</button>
               </form>
            @elseif($job->status == 'ONTRIP')
               <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
                     @csrf
                     <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
                     <button class="btn btn-danger text-white btn-sm fs--1 card-1 float-right">Cancel Job</button>
               </form>
            @elseif($job->status == 'ARRIVED')
               <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
                     @csrf
                     <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
                     <button class="btn btn-danger text-white btn-sm fs--1 card-1 float-right">Cancel Job</button>
               </form>
            @elseif($job->status == 'STARTED')
               <form action="{{route('service_provider_job_cancel')}}" method="POST" onsubmit="toggle_animation(true);">
                     @csrf
                     <input type="hidden" name="sp_job_cancel_id" value="{{$job->id}}" required>
                     <button class="btn btn-danger text-white btn-sm fs--1 card-1 float-right">Cancel Job</button>
               </form>
            @elseif($job->status == 'COMPLETED')
            @endif
            </div>
         </div>
         <ul class="nav nav-pills shadow-sm p-2 nav-fill m-0 fs--1 " id="myTab" role="tablist">
            <li class="nav-item ">
               <a class="nav-link active" id="joboverview-tab" data-toggle="tab" href="#joboverview" role="tab" aria-controls="joboverview" aria-selected="true">Overview</a>
            </li>
            @if($job->status != 'CANCELLED')
            <li class="nav-item ">
               <a class="nav-link " id="jobdetail-tab" data-toggle="tab" href="#jobdetail" role="tab" aria-controls="jobdetail" aria-selected="false"> Details</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link " id="jobimages-tab" data-toggle="tab" href="#jobimages" role="tab" aria-controls="jobimages" aria-selected="false">Photos</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link" id="jobhelp-tab" data-toggle="tab" href="#jobhelp" role="tab" aria-controls="jobhelp" aria-selected="false">Help</a>
            </li>
            @endif
         </ul>
      </div>
   </div>
   <div class="p-0" style="margin-top:120px;">
      <div class="tab-content  mt-3" id="myTabContent">
            <div class="tab-pane fade show active  fs--1" id="joboverview" role="tabpanel" aria-labelledby="joboverview-tab"> 
               @if($job->status == 'OPEN')
                  @include('service_provider.jobs.partial.job_overview_partial_open')
               @elseif($job->status == 'APPROVED')
                  @include('service_provider.jobs.partial.job_overview_partial_aprroved')
               @elseif($job->status == 'ONTRIP')
                  @include('service_provider.jobs.partial.job_overview_partial_ontrip')
               @elseif($job->status == 'ARRIVED')
                  @include('service_provider.jobs.partial.job_overview_partial_arrived')
               @elseif($job->status == 'STARTED')
                  @include('service_provider.jobs.partial.job_overview_partial_started')
               @elseif($job->status == 'COMPLETED')
                  @include('service_provider.jobs.partial.job_overview_partial_completed')
               @elseif($job->status == 'CANCELLED')
                  @include('service_provider.jobs.partial.job_overview_partial_cancelled')
               @endif
            </div>
            @if($job->status != 'CANCELLED')
            <div class="tab-pane fade  fs--1" id="jobdetail" role="tabpanel" aria-labelledby="jobdetail-tab">
               @include('service_provider.jobs.partial.job_description_partial')
            </div>
            <div class="tab-pane fade fs--1 " id="jobimages" role="tabpanel" aria-labelledby="jobimages-tab">
               @include('service_provider.jobs.partial.job_images_partial_list')
            </div>
            <div class="tab-pane fade  fs--1" id="jobhelp" role="tabpanel" aria-labelledby="jobhelp-tab">
               @include('service_provider.jobs.partial.job_help_partial')
            </div>
            @endif
      </div>
</div>
@endsection
