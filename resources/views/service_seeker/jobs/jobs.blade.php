@extends('layouts.service_seeker_master')
@section('content')
<style>
   .pure-material-progress-linear {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   border: none;
   height: 0.25em;
   color: rgb(var(--pure-material-primary-rgb, 33, 150, 243));
   background-color: rgba(var(--pure-material-primary-rgb, 33, 150, 243), 0.12);
   font-size: 16px;
   min-width: 100%!important;
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
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 sticky-top shadow-sm bg-white p-3  border-d">
         <div class="row">
            <div class="col-4">
               <i class="fas fa-briefcase theme-color fs-1"></i>
            </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Jobs <br><span class="fs--2 text-muted font-weight-normal ">All Jobs</span></div>
            <div class="col-4 text-right">
               <div class="dropleft">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-0">
         <!-- progress bar contianer -->
         <div id="prog-container" style="display:none;">
            <progress class="pure-material-progress-linear d-block"/>
         </div>
         <!-- end container -->   
      </div>
      <div class="col-lg-12 pl-2 mt-2 border-d">
         <div class="d-flex  bd-highlight">
            <div class="fs1 p-1 bd-highlight">
               <a class="btn theme-background-color btn-sm shadow text-white"  href="#" role="button" id="ss_jobs_filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-sort-amount-up-alt"></i> Filter
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="ALL" style="cursor: pointer"><i class="far fa-circle text-primary"></i> All</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="ONTRIP" style="cursor: pointer"><i class="far fa-circle text-primary"></i> On-Trip</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="OPEN" style="cursor: pointer"><i class="far fa-circle text-success"></i> Open</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="APPROVED" style="cursor: pointer"><i class="far fa-circle text-success"></i> Approved</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="STARTED" style="cursor: pointer"><i class="far fa-circle text-warning"></i> In-Progress</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="COMPLETED" style="cursor: pointer"><i class="far fa-circle text-dark"></i> Completed</span>
               </div>
            </div>
            <div class="fs--1 p-1 flex-fill bd-highlight">
               <a  class="btn theme-background-color btn-sm shadow text-white" href="{{route('service_seeker_jobs_full_history')}}" onclick="toggle_animation(true);">
               <i class="fas fa-history"></i> Full History
               </a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 pl-2 pr-2 mt-2 border-d">
         @include('service_seeker.jobs.jobs_templates.jobs_templates_list')
      </div>
   </div>
</div>
@include('service_seeker.bottom_navigation_bar')
<script>
   var service_seeker_jobs_filter_url = "{{route('service_seeker_jobs_filter')}}";
      
   window.onload = function() {
       setInterval(() => {
        filter_service_seeker_jobs(null);
       }, 10000);
   }
   


   function filter_service_seeker_jobs(data){
         prog_load_dis(true);
        var t;
         if(data == null) {
           t = "ALL";
        } else {
           t = data.attr('data-value');
        }
        $.ajax({
             type: "POST",
             url: service_seeker_jobs_filter_url,
             data: {
               "_token": csrf_token,
               "filter_action": t,
             },
             success: function(results){
               var myUl = $("#service_seeker_filter_ul_list");
               if(results['jobs'].length == 0){
                 myUl.html("<p class='m-2 p-2 text-warning'>No jobs found</p>");
               }else{
                 myUl.html(results['html']);
               }
               prog_load_dis(false);
               if(t != "ALL") {
                  var filterAnchorTag = document.getElementById('ss_jobs_filter');
                  filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + data.text().trim()+")</small>";
               }
             },
             error: function(results, status, err) {
                 console.log(err);
                 prog_load_dis(false);
             }
         });
      }
   

   function prog_load_dis(b){
      if(b){
         $("#prog-container").fadeIn();
      } else {
         $("#prog-container").fadeOut();
      }
   }

</script>
@endsection