<div class="border-bottom  p-3">
   <span>Your Account: </span>
   <br>
   <br>
   <img class="rounded p-1" src="{{url('/')}}/storage/images/profile/{{Auth::user()->profile_image_path}}"   width="60px" height="60px"/>
   <br>
   <br>
   <span>{{Auth::user()->firstName}} {{Auth::user()->lastName}} <a href="{{route('service_provider_home')}}" target="_blank">(Edit in LocaL2LocaL App)</a> </span>
   <br>
</div>
<br>
<div class="p-3">
   <span>Service Menu: </span>
   <br>
   <br>
   <div class="list-group " >
      <a class="list-group-item  animation_redirect {{ request()->is('app/portal/admin/home') ? 'active' : '' }}" href="{{route('app_portal_admin_home')}}">
      <i class="fas fa-home p-1" style="min-width:30px!important;"></i> Home
      </a>
      <a  class="list-group-item animation_redirect {{ request()->is('app/portal/admin/users/all') ? 'active' : '' }} {{ request()->is('app/portal/admin/users/*') ? 'active' : '' }}" href="{{route('app_portal_admin_users_all')}}">
      <i class="fas fa-users p-1" style="min-width:30px!important;"></i> User Management
      </a>
      <a  class="list-group-item animation_redirect {{ request()->is('portal/admin/jobs/') ? 'active' : '' }}"  href="{{route('app_portal_admin_jobs')}}">
      <i class="fas fa-history p-1" style="min-width:30px!important;"></i> Job History
      </a>
      <a class="list-group-item animation_redirect {{ request()->is('admin/service_managment') ? 'active' : '' }}" >
      <i class="fas fa-tasks p-1" style="min-width:30px!important;"></i> Service Management
      </a>
      <a  class="list-group-item animation_redirect {{ request()->is('admin/maps/*') ? 'active' : '' }}" href="{{route('app_portal_admin_maps_heatmap')}}">
      <i class="fas fa-map-pin p-1" style="min-width:30px!important;"></i> Heat Maps
      </a>
      <form action="{{route('logout')}}" style="display:none" method="post" id="logout_form">@csrf</form>
      <a class="list-group-item text-danger animation_redirect" href="#" onclick="$('#logout_form').submit();">
      <i class="fas fa-sign-out-alt p-1" style="min-width:30px!important;"></i> Logout
      </a>
   </div>
</div>