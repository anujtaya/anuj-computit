<!-- bottom nav -->
<div class="fixed-bottom ">
   <div class="row border-top pt-2 bg-white sticky-bottom  fs--1 text-center m-0">
      <div class="col-2 p-3">
         <a class="{{ (request()->is('service_seeker/home')) ? 'theme-color' : '' }}  text-decoration-none text-muted" href="{{route('service_seeker_home')}}" onclick="toggle_animation(true);">        <i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home</a>
      </div>
      <div class="col-2 p-3">
         <a class="text-muted text-decoration-none {{ (request()->is('service_seeker/profile')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_profile')}}" onclick="toggle_animation(true);">
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </a>
      </div>
      <div class="col-2 p-3">
         <a class=" text-decoration-none {{ (request()->is('service_seeker/jobs')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);">  <i class="fas  fs-2  fa-briefcase mb-1"></i><br>
         Jobs
         </a>
      </div>
      <div class="col-3 p-3">
         <a class=" text-decoration-none {{ (request()->is('service_seeker/messages')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_messages')}}" onclick="toggle_animation(true);"> <i class="fas fs-2 fa-envelope mb-1"></i> <br>
         Messages
         </a>
      </div>
      <div class="col-2 p-3  ">
         <a class=" text-decoration-none {{ (request()->is('service_seeker/more')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">
            <i class="fas  fs-2 fa-plus mb-1"></i><br>
            More
         </a>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
