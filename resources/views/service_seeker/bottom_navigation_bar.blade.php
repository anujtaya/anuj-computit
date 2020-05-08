<div class="fixed-bottom"  @if(request()->is('service_seeker/home')) style="height:10%" @endif>
   <div class="row border-top pt-2 bg-white sticky-bottom  fs--1 text-center m-0" style="border-color:#f7f7f9!important;">
      @if(request()->is('service_seeker/home')  || request()->is('service_seeker/more') )

      @else
         <div class="col-12 mb-2  p-2">
            <a class="btn btn-block btn-sm text-white mt-2 card-1" style="border-radius:20px;background:#5D29BA!important;color:white!important;" href="{{route('service_provider_home')}}" onclick="toggle_animation(true);">Switch to Provider - I want to done</a>
         </div>
      @endif
      <div class="col-3 p-2">
      @if(!(request()->is('service_seeker/home')))
      <a class="{{ (request()->is('service_seeker/home')) ? 'theme-color' : '' }}  text-muted  text-decoration-none"  href="{{route('service_seeker_home')}}" onclick="toggle_animation(true);"><i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home
      </a>
      @else
      <span class="{{ (request()->is('service_seeker/home')) ? 'theme-color' : '' }}  text-decoration-none"  onclick="update_user_location();"><i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home
      </span>
      @endif
      </div>
      <div class="col-3 p-2">
         <a class="text-muted text-decoration-none {{ (request()->is('service_seeker/profile')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_profile')}}" onclick="toggle_animation(true);">
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </a>
      </div>
      <div class="col-3 p-2">
         <a class=" text-decoration-none {{ (request()->is('service_seeker/jobs/history')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);">
           <i class="fas  fs-2  fa-briefcase mb-1"></i>
           <br>
         Jobs
         </a>
      </div>
      <div class="col-3 p-2">
         <a class=" text-decoration-none {{ (request()->is('service_seeker/more')) ? 'theme-color' : '' }} text-muted" href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">
            <i class="fas  fs-2 fa-plus mb-1"></i><br>
            More
         </a>
      </div>
   </div>
</div>