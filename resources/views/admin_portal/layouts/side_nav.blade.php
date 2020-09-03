<div class="border-bottom  p-3">
   <span>Your Account: </span>
   <br>
   <br>
   <img class="rounded p-1" src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{Auth::user()->profile_image_path}}" onerror="this.src='data:image/png;base64,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'"  width="60px" height="60px"/>
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
      <a class="list-group-item {{ request()->is('app/portal/admin/home') ? 'active' : '' }}" href="{{route('app_portal_admin_home')}}">
      <i class="fas fa-home p-1" style="min-width:30px!important;"></i> Home
      </a>
      <a  class="list-group-item {{ request()->is('app/portal/admin/users/all') ? 'active' : '' }} {{ request()->is('app/portal/admin/users/*') ? 'active' : '' }}" href="{{route('app_portal_admin_users_all')}}">
      <i class="fas fa-users p-1" style="min-width:30px!important;"></i> User Management
      </a>
      <a  class="list-group-item {{ request()->is('app/portal/admin/jobs/*') ? 'active' : '' }}"  href="{{route('app_portal_admin_jobs')}}">
      <i class="fas fa-history p-1" style="min-width:30px!important;"></i> Job History
      </a>
      <a class="list-group-item {{ request()->is('app/portal/admin/service_management/*') ? 'active' : '' }}" href="{{route('app_portal_admin_service_management')}}">
      <i class="fas fa-tasks p-1" style="min-width:30px!important;"></i> Service Management
      </a>
      <a class="list-group-item {{ request()->is('app/portal/admin/data/*') ? 'active' : '' }}" href="{{route('app_portal_admin_data_import_index')}}">
      <i class="fas fa-tasks p-1" style="min-width:30px!important;"></i> Data Import/Export
      </a>
      <a  class="list-group-item {{ request()->is('app/portal/admin/maps/*') ? 'active' : '' }}" href="{{route('app_portal_admin_maps_heatmap')}}">
      <i class="fas fa-map-pin p-1" style="min-width:30px!important;"></i> Heat Maps
      </a>
      <form action="{{route('logout')}}" style="display:none" method="post" id="logout_form">@csrf</form>
      <a class="list-group-item text-danger" href="#" onclick="$('#logout_form').submit();">
      <i class="fas fa-sign-out-alt p-1" style="min-width:30px!important;"></i> Logout
      </a>
   </div>
</div>
