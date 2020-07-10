@extends('layouts.service_seeker_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 sticky-top shadow-sm bg-white p-3  border-d">
      <div class="row">
            <div class="col-4">  <a href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Job History <br><span class="fs--2 text-muted font-weight-normal">Full History</span></div>
            <div class="col-4 text-right"></div>
         </div>
      </div>
      <div class="col-lg-12 pl-2 pr-2 mt-2 border-d">
         <ul class="list-group fs--1" style="overflow:scroll; height:640px;">
           @foreach($service_seeker_jobs as $job)
            <li class="list-group-item mb-2 ml-1 mr-1 border-0 shadow-sm p-0" onclick="location.href= app_url + '/service_seeker/jobs/job/{{$job->id}}';toggle_animation(true);" style="cursor:pointer;">
               <div class="d-flex pl-2 pr-2 bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{ucfirst($job->title)}}</div>
               </div>
               <div class="d-flex pl-2 pr-2 fs--2 bd-highlight">
                  <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt"></i> {{$job->city}}, {{$job->postcode}}</div>
                  <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                     @if($job->status == 'APPROVED')
                        <span class="badge  badge-success pl-2 pr-2 fs--2 font-weight-normal " style="border-radius:20px!important;">Approved</span>
                     @elseif($job->status == 'ONTRIP')
                        <span class="badge  badge-warning pl-2 pr-2 fs--2 font-weight-normal  " style="border-radius:20px!important;">On-Trip</span>
                     @elseif($job->status == 'ARRIVED')
                        <span class="badge  badge-secondary pl-2 pr-2 fs--2 font-weight-normal " style="border-radius:20px!important;">Arrived</span>
                     @elseif($job->status == 'STARTED')
                        <span class="badge  badge-warning pl-2 pr-2 fs--2 font-weight-normal " style="border-radius:20px!important;">In-Progress</span>
                     @elseif($job->status == 'COMPLETED')
                        <span class="badge  badge-secondary pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Completed</span>
                     @elseif($job->status == 'CANCELLED')
                     <span class="badge  badge-danger pl-2 pr-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Cancelled</span>
                     @endif 
                  </div>
               </div>
               <div class="d-flex pl-2 pr-2 bd-highlight">
                  <div class="p-0 w-100 fs--2 bd-highlight"><i class="far fa-calendar-alt"></i> {{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</div>
               </div>
            </li>
            @endforeach
            @if(count($service_seeker_jobs) == 0) 
            <div class="text-center p-3">
               <img src="{{asset('images/svg/l2l_ss_no_data.svg')}}" alt="" style="opacity:0.4;"  class="img-fluid" alt="Responsive image">
               <br>
               <br>
               <span>Oh no! It seems all empty here. You do not have any completed jobs.</span>
               <br><br>
            </div>
            @endif
      </div>
   </div>
</div>
@endsection
