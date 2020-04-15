<nav class="navbar navbar-vertical navbar-expand-xl custom-light-background navbar-glass">
   <a class="navbar-brand text-left p-1" href="#">
   
     <img src="{{asset('/images/brand/l2l-logo-svg.svg')}}" height="50" width="50" alt="">
   
     <!-- <span class="fs--1">Serice Provider Portal</span> -->
   </a>
   
   <div class="collapse navbar-collapse p-2" id="navbarVerticalCollapse">
      <hr>
      <span class="font-weight-bolder">Menu</span>
      <ul class="navbar-nav flex-column mt-2">
         <li class="nav-item">
            <a class="nav-link {{ (request()->is('app/portal/driver/home')) ? 'theme-color' : '' }}" href="{{route('app_portal_driver_home')}}"  >
               <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                  <span class="fas fa-home"></span>
                  </span>
                  <span>Dashboard</span>
               </div>
            </a>
            <a class="nav-link {{ (request()->is('app_portal_driver_home')) ? 'active' : '' }}" href="{{route('app_portal_driver_home')}}"  >
               <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                  <span class="fas fa-money-check-alt"></span>
                  </span>
                  <span>Payouts</span>
               </div>
            </a>
            <a class="nav-link {{ (request()->is('app_portal_driver_home')) ? 'active' : '' }}" href="{{route('app_portal_driver_home')}}"  >
               <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                  <span class="fas fa-receipt"></span>
                  </span>
                  <span>Tax Invoices</span>
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
                  <span class="fas fa-power-off"></span>
                  </span>
                  <span>Logout</span>
               </div>
            </a>
         </li>
      </ul>
   </div>
</nav>