<!-- bottom nav -->
<div class="fixed-bottom " style="height:10%;">
   <div class="row border-top pt-2 bg-white sticky-bottom  fs--1 text-center m-0" style="border-color:#f7f7f9!important;">
      <div class="col-3 p-3">
         <a class="{{ (request()->is('guest/service_provider/home')) ? 'theme-color' : '' }}  text-decoration-none" href="{{route('guest_service_provider_home')}}" onclick="toggle_animation(true);">        <i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home</a>
      </div>
      <div class="col-3 p-3">
         <span class="text-muteds text-muted" style="opacity:0.2;" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </sapn>
      </div>
      <div class="col-3 p-3">
         <span class="text-muteds text-muted" style="opacity:0.2;" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2  fa-briefcase mb-1"></i>
         <br>
         Jobs
         </sapn>
      </div>
      <div class="col-3 p-3  ">
         <span class="text-muteds text-muted" style="opacity:0.2;" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2 fa-plus mb-1"></i><br>
         More
         </sapn>
      </div>
   </div>
</div>
<!-- end bottom nav  -->
<!-- No user account modal -->
<div class="modal fade" id="user_no_account_message_modal" tabindex="-1" role="dialog" aria-labelledby="user_no_account_message_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_add_user_sp.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - Add User Account">
            <br>
            <br>
            <p>You are browsing LocaL2LocaL in guest mode with limited feature. Please click below if you want to login or register a new account with us to enable all LocaL2LocaL app features.</p>
            <a class="btn theme-background-color text-white" href="{{route('app_register')}}?registration_type=sp" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Signup</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->