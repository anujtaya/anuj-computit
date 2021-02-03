<!-- bottom nav -->
<div class="fixed-bottom" >
   <div class="row border-top bg-white justify-content-center fs--1 text-center m-0">
      <div class="col-12  p-2">
            <a class="btn btn-block btn-sm text-white mt-2 shadow" style="background:#399BDB;" href="{{route('guest_service_seeker_home')}}?showtutorial=true" onclick="toggle_animation(true);">Switch to Seeker - I want work done</a>
      </div>
      <div class="col-3 p-2">
         <a class="{{ (request()->is('guest/service_provider/home')) ? 'theme-color' : 'text-muted' }}  text-decoration-none" href="{{route('guest_service_provider_home')}}" onclick="toggle_animation(true);">        <i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home</a>
      </div>
      <div class="col-3 p-2">
         <span class="text-muteds text-muted" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </sapn>
      </div>
      <div class="col-3 p-2">
         <span class="text-muteds text-muted" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2  fa-briefcase mb-1"></i>
         <br>
         My Jobs
         </sapn>
      </div>
      <div class="col-3 p-2">
         <a class="{{ (request()->is('guest/service_provider/more')) ? 'theme-color' : 'text-muted' }}" href="{{route('guest_service_provider_more')}}" onclick="toggle_animation(true);">
            <i class="fas  fs-2 fa-plus mb-1"></i><br>
            More
         </a>
      </div>
   </div>
</div>
<!-- end bottom nav  -->
<!-- No user account modal -->
<div class="modal fade" id="user_no_account_message_modal" tabindex="-1" role="dialog" aria-labelledby="user_no_account_message_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_add_user_sp.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - Add User Account">
            <br>
            <br>
            <p class="fs--1">You are browsing LocaL2LocaL in guest mode with limited features. Please click below if you want to login or register a new account with us to enable all LocaL2LocaL app features.</p>
            <a class="btn theme-background-color text-white shadow-lg" href="{{route('login')}}" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Signup</a>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->