@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 sticky-top shadow-sm bg-white p-3  border-d">
      <div class="row">
            <div class="col-4">  <a href="{{route('service_provider_jobs_history')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">My Profile <br><span class="fs--2 text-muted font-weight-normal">Full History</span></div>
            <div class="col-4 text-right"></div>
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
                     @if($job->status == 'COMPLETED')
                        <span class="badge  badge-secondary  p-2 fs--2 font-weight-normal" style="border-radius:20px!important;">Completed</span>
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
               <span>Oh no! It seems all empty here. You do not have any completed jobs.</span>
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
