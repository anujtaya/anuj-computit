@extends('layouts.service_seeker_master')
@section('content')
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

      <div class="col-lg-12 pl-3 pr-3 mt-3 border-d">
         <div class="d-flex  bd-highlight">
            <div class="fs1 p-1 bd-highlight">
               <a class="btn theme-color btn-sm  border fs1 bg-white shadow-sm text-muted" style="border-radius:20px;" href="#" role="button" id="ss_jobs_filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-sort-amount-up-alt"></i> Filter
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                 <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="ALL" style="cursor: pointer"><i class="far fa-circle text-primary"></i> All</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="PENDING" style="cursor: pointer"><i class="far fa-circle text-primary"></i> Pending</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="APPROVED" style="cursor: pointer"><i class="far fa-circle text-success"></i> Approved</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="IN-PROGRESS" style="cursor: pointer"><i class="far fa-circle text-warning"></i> In-Progress</span>
                  <span class="dropdown-item" onclick="filter_service_seeker_jobs($(this));" data-value="COMPLETED" style="cursor: pointer"><i class="far fa-circle text-dark"></i> Completed</span>
               </div>
            </div>
            <div class="fs--1 p-1 flex-fill bd-highlight">
               <a class="btn theme-color btn-sm  border fs--1 bg-white shadow-sm" style="border-radius:20px;" href="{{route('service_seeker_jobs_full_history')}}" onclick="toggle_animation(true);">
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

   function filter_service_seeker_jobs(data){
     toggle_animation(true);
     $.ajax({
          type: "POST",
          url: service_seeker_jobs_filter_url,
          data: {
            "_token": csrf_token,
            "filter_action": data.attr('data-value'),
          },
          success: function(results){
            var myUl = $("#service_seeker_filter_ul_list");
            if(results['jobs'].length == 0){
              myUl.html("<p class='m-2 p-2 text-warning'>No jobs found</p>");
            }else{
              myUl.html(results['html']);
            }
            toggle_animation(false);
			var filterAnchorTag = document.getElementById('ss_jobs_filter');
			filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + data.text().trim()+")</small>";
          },
          error: function(results, status, err) {
              console.log(err);
          }
      });
   }
</script>
@endsection
