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
               <a class="btn btn-sm theme-background-color border-0 fs--1 card-1" style="border-radius:20px;" href="#" role="button" id="sp_jobs_filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-sort-amount-up-alt"></i> Filter
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="ALL" style="cursor: pointer"><i class="far fa-circle text-primary"></i> All</span>
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="ONTRIP" style="cursor: pointer"><i class="far fa-circle text-primary"></i> On-Trip</span>
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="OPEN" style="cursor: pointer"><i class="far fa-circle text-success"></i> Open</span>
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="APPROVED" style="cursor: pointer"><i class="far fa-circle text-success"></i> Approved</span>
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="STARTED" style="cursor: pointer"><i class="far fa-circle text-warning"></i> In-Progress</span>
                  <span class="dropdown-item" onclick="filter_service_provider_jobs($(this));" data-value="COMPLETED" style="cursor: pointer"><i class="far fa-circle text-dark"></i> Completed</span>
               </div>
            </div>
            <div class="fs--1 p-1 flex-fill bd-highlight">
               <a class="btn btn-sm theme-background-color border-0 fs--1 card-1" style="border-radius:20px;" href="{{route('service_provider_jobs_full_history')}}" onclick="toggle_animation(true);">
                  <i class="fas fa-history"></i> All History
               </a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 pl-2 pr-2 mt-2 border-d">
         @include('service_provider.jobs.jobs_templates.jobs_templates_list')
      </div>
   </div>
</div>
@include('service_provider.bottom_navigation_bar')

<script>
var app_url = "{{URL::to('/')}}";
var service_provider_jobs_filter_url = "{{route('service_provider_jobs_filter')}}";

   function filter_service_provider_jobs(data){
     toggle_animation(true);
     $.ajax({
          type: "POST",
          url: service_provider_jobs_filter_url,
          data: {
            "_token": csrf_token,
            "filter_action": data.attr('data-value'),
          },
          success: function(results){
            var myUl = $("#service_provider_filter_ul_list");
            if(results['jobs'].length == 0){
              myUl.html("<p class='m-2 p-2 text-warning'>No jobs found</p>");
            }else{
              myUl.html(results['html']);
            }
            toggle_animation(false);
			var filterAnchorTag = document.getElementById('sp_jobs_filter');
			filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + data.text().trim()+")</small>";
          },
          error: function(results, status, err) {
              console.log(err);
          }
      });
   }
</script>
@endsection
