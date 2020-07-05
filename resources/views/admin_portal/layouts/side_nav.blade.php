<nav class="navbar navbar-vertical navbar-expand-xl custom-light-background navbar-glass">
   <a class="navbar-brand text-left p-2" href="{{route('app_portal_provider_home')}}">
     <!-- <img src="{{asset('/images/brand/l2l-logo-svg.svg')}}" height="40" width="40" alt="LocaL2LocaL Brand Logo" class="card-1 rounded-circle p-1"> -->
     <div class="fs-1 mt-2 theme-color">Admin Portal</div>
     <span class="text-muted text-monospace fs--2">v2.0</span>
   </a>
   
   <div class="collapse navbar-collapse p-2" id="navbarVerticalCollapse">
      <span class="font-weight-bolder">Admin Menu</span>
      <ul class="navbar-nav flex-column mt-2">
         <li class="nav-item">
            <a class="nav-link {{ (request()->is('app/portal/admin/home')) ? 'theme-color' : '' }}" href="{{route('app_portal_admin_home')}}"  >
               <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                  <i class="fas fa-home"></i>
                  </span>
                  <span>Home</span>
               </div>
            </a>
         </li>
         <li class="nav-item">
            <!-- logout form -->
            <form action="{{route('logout')}}" style="display:none" method="post" id="logout_form">@csrf</form>
            <!-- end logout form -->
            <a class="nav-link text-danger-b" onclick="$('#logout_form').submit();">
               <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                  <i class="fas fa-sign-out-alt"></i>
                  </span>
                  <span>Logout</span>
               </div>
            </a>
         </li>
        
      </ul>
   </div>
</nav>