@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 sticky-top shadow-sm bg-white p-3  border-d">
         <div class="row">
            <div class="col-4">
               <i class="fas fa-briefcase theme-color fs-1"></i>
            </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Jobs <br><span class="fs--2 text-muted font-weight-normal ">Current Jobs</span></div>
            <div class="col-4 text-right">
               <div class="dropleft">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-12 pl-3 pr-3 mt-3 border-d">
         <div class="d-flex  bd-highlight">
            <div class="fs--1 p-1 bd-highlight">
               <a class="btn theme-color btn-sm  border fs--1 bg-white shadow-sm" style="border-radius:20px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-sort-amount-up-alt"></i> Filter
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-primary"></i> Pending</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-success"></i> Approved</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-warning"></i> In-Progress</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-dark"></i> Completed</a>
               </div>
            </div>
            <div class="fs--1 p-1 flex-fill bd-highlight">
               <a class="btn theme-color btn-sm  border fs--1 bg-white shadow-sm" style="border-radius:20px;" href="{{route('service_provider_jobs_full_history')}}" onclick="toggle_animation(true);">
                  <i class="fas fa-history"></i> Full History
               </a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 pl-2 pr-2 mt-2 border-d">
         <ul class="list-group fs--1" style="overflow:scroll; height:640px;">
           @foreach($service_provider_jobs as $job)
            <li class="list-group-item mt-2 mb-2 ml-2 mr-2 shadow-sm border-light" onclick="location.href= app_url + '/service_provider/jobs/job/{{$job->id}}';toggle_animation(true);">
               <div class="d-flex bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
               </div>
               <div class="d-flex bd-highlight">
                  <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt"></i> {{$job->city}}, {{$job->postcode}}</div>
                  <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
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
                     @endif 
                  </div>
               </div>
               <div class="d-flex bd-highlight">
                  <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> 28/02/2020 10:30AM</div>
               </div>
            </li>
            @endforeach
            @if(count($service_provider_jobs) == 0) 
            <div class="text-center p-3">
               <img src="{{asset('images/svg/l2l_empty.svg')}}" alt="" style="opacity:0.4;"  class="img-fluid" alt="Responsive image">
               <br>
               <br>
               <span>Looks like you haven't offered any quote to Service Seeker recently. Please come back later.</span>
               <br><br>
            </div>
            @endif
      </div>
   </div>
</div>

<script>
var app_url = "{{URL::to('/')}}";
</script>

@include('service_provider.bottom_navigation_bar')
@endsection
