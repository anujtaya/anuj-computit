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
      <div class="col-lg-12 shadow-sm-none fixed-top bg-white p-0 border-d">
         <div class="row p-3">
            <div class="col-4">  <a href="{{route('guest_service_provider_home')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a>  </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Job <br><span class="fs--2 text-muted font-weight-normal">#JB-{{$job->id}}</span></div>
            <div class="col-4 text-right">
                  <span class="badge  badge-success  p-2 fs--2 font-weight-normal animated rubberBand delay-1s" style="border-radius:20px!important;">Open</span>
            </div>
         </div>
         <ul class="nav nav-pills shadow-sm p-2 nav-fill m-0 fs--1 " id="myTab" role="tablist">
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
         <div class="tab-content pl-3 pr-3 mt-3" id="myTabContent">
            <div class="tab-pane fade show active  fs--1" id="joboverview" role="tabpanel" aria-labelledby="joboverview-tab"> 
               @include('service_provider.demo.jobs.partial.job_overview_partial_open')
            </div>
            <div class="tab-pane fade  fs--1" id="jobdetail" role="tabpanel" aria-labelledby="jobdetail-tab">
               @include('service_provider.demo.jobs.partial.job_description_partial')
            </div>
            <div class="tab-pane fade fs--1 " id="jobimages" role="tabpanel" aria-labelledby="jobimages-tab">
               @include('service_provider.demo.jobs.partial.job_images_partial_list') 
            </div>
            <div class="tab-pane fade  fs--1" id="jobhelp" role="tabpanel" aria-labelledby="jobhelp-tab">
               @include('service_provider.demo.jobs.partial.job_help_partial')
            </div>
         </div>
      </div>
   </div>
</div>
<!-- No user account modal -->
<div class="modal fade" id="user_no_account_message_modal" tabindex="-1" role="dialog" aria-labelledby="user_no_account_message_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_add_user_sp.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - Add User Account">
            <br>
            <br>
            <p>You are browsing LocaL2LocaL in guest mode with limited feature. Please click below if you want to login or register a new account with us to enable all LocaL2LocaL app features.</p>
            <a class="btn theme-background-color text-white" href="{{route('app_register')}}?registration_type=sp" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Signup</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
@endsection
