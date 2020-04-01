<!-- bottom nav -->
<div class="fixed-bottom ">
   <div class="row border-top pt-2 bg-white sticky-bottom justify-content-center fs--1 text-center m-0">
      <div class="col-3   p-2">
         <a class="{{ (request()->is('service_provider/home')) ? 'theme-color' : '' }}  text-decoration-none text-muted" href="{{route('service_provider_home')}}" onclick="toggle_animation(true);">        <i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home</a>   
      </div>
      <div class="col-3 p-2 ">
         <a class="text-muted text-decoration-none {{ (request()->is('service_provider/profile/nested')) ? 'theme-color' : '' }} text-muted" href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"> 
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </a>
      </div>
      <div class="col-3 p-2">
         <a class=" text-decoration-none {{ (request()->is('service_provider/jobs/history')) ? 'theme-color' : '' }} text-muted" href="{{route('service_provider_jobs_history')}}" onclick="toggle_animation(true);">  <i class="fas  fs-2  fa-briefcase mb-1"></i><br>
         Jobs
         </a> 
      </div>
      <div class="col-2 p-2  ">
         <a class=" text-decoration-none {{ (request()->is('service_provider/more')) ? 'theme-color' : '' }} text-muted" href="{{route('service_provider_more')}}" onclick="toggle_animation(true);"> 
            <i class="fas  fs-2 fa-plus mb-1"></i><br>
            More
         </a>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>