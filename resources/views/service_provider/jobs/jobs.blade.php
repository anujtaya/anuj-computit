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
            <div class="fs--1 flex-fill bd-highlight">
               <a class="btn theme-color btn-sm  border fs--1 bg-white text-muted" style="border-radius:20px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-sort-amount-up-alt"></i> Filter
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-primary"></i> Pending</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-success"></i> Approved</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-warning"></i> In-Progress</a>
                  <a class="dropdown-item" href="#"><i class="far fa-circle text-dark"></i> Completed</a>
               </div>
            </div>
         </div>
         <!-- button group for different jobs type -->
      </div>
      <div class="col-lg-12 pl-2 pr-2 mt-2 border-d">
         <ul class="list-group fs--1" style="overflow:scroll; height:640px;">
           @foreach($jobs as $job)
            <li class="list-group-item mt-2 border mb-2 ml-2 mr-2 shadow-sm" onclick="location.href='./jobs/job/{{$job->id}}'; toggle_animation(true);">
               <div class="d-flex bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
               </div>
               <div class="d-flex bd-highlight">
                  <div class="p-0 w-100 bd-highlight"><i class="fas fa-map-marker-alt"></i> {{$job->city}}</div>
                  <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
                     <span class="badge  theme-background-color p-2 font-weight-normal" style="border-radius:20px!important;">
                       {{$job->status}}
                     </span>
                  </div>
               </div>
               <div class="d-flex bd-highlight">
                  <div class="p-0 w-100 bd-highlight"><i class="far fa-calendar-alt"></i> 28/02/2020 10:30AM</div>
               </div>
            </li>
            @endforeach
      </div>
   </div>
</div>
@include('service_seeker.bottom_navigation_bar')
<script>
   function fetch_jobs(type) {
      switch(type) {
         case 'PENDING':
            // code block
            $("#btn_pending").addClass("btn-info");
            $("#btn_pending").removeClass("border");
            $("#btn_approved").removeClass("btn-info");
            $("#btn_approved").addClass("border");
            $("#btn_inprogress").removeClass("btn-info");
            $("#btn_inprogress").addClass("border");
            console.log('Pending selected');
            break;
         case 'APPROVED':
            $("#btn_approved").addClass("btn-info");
            $("#btn_approved").removeClass("border");
            $("#btn_pending").removeClass("btn-info");
            $("#btn_pending").addClass("border");
            $("#btn_inprogress").removeClass("btn-info");
            $("#btn_inprogress").addClass("border");
            console.log('Approved selected');
         // code block
            break;
         case 'INPROGRESS':
            $("#btn_inprogress").addClass("btn-info");
            $("#btn_inprogress").removeClass("border");
            $("#btn_pending").removeClass("btn-info");
            $("#btn_pending").addClass("border");
            $("#btn_approved").removeClass("btn-info");
            $("#btn_approved").addClass("border");
            console.log('In-progress selected');
            break;
         default:
            // code block
         }
   }
</script>
@endsection
