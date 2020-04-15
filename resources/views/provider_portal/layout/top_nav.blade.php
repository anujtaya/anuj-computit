<nav class="navbar custom-light-background navbar-glass fs--1 font-weight-semi-bold row navbar-top sticky-kit navbar-expand">
    <button class="navbar-toggler text-primary collapsed" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" ></span>
    </button>
    <a class="navbar-brand text-left ml-3" href="../index.html">
       <div class="d-flex align-items-center theme-color fs-1">Provider Portal</div>
    </a>
    <div class="collapse navbar-collapse  mt-2" id="navbarNavDropdown1">
       <ul class="navbar-nav align-items-center ml-auto">
          <li class="nav-item dropdown">
             <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar theme-color avatar-xl">
                   <span class="fas fa-user-circle fs-3"></span>
                </div>
             </a>
             <div class="dropdown-menu dropdown-menu-right rounded-0 border shadow-none bg-white py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white rounded-soft py-2">
                     <a class="dropdown-item">Hi {{Auth::user()->first}}!</a>
                     <a class="dropdown-item text-danger" onclick="$('#logout_form').submit();">Logout</a>
                  </div>
             </div>
          </li>
       </ul>
    </div>
 </nav>
