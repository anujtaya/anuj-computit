<div class="fixed-bottom bg-white" style="height:11%;">
   <div class="row border-top sticky-bottom  fs--1 text-center m-0" style="border-color:#f7f7f9!important;">
      <div class="col-3 p-3">
         <span class="{{ (request()->is('guest/service_seeker/home')) ? 'theme-color' : '' }}  text-decoration-none"  onclick="update_user_location();">        <i class="fas  fs-2 fa-home mb-1"></i> <br>
         Home</span>
      </div>
      <div class="col-3 p-3">
         <span class="text-muted" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2 fa-user mb-1"></i><br>
         Profile
         </sapn>
      </div>
      <div class="col-3 p-3">
         <span class="text-muted" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2  fa-briefcase mb-1"></i>
         <br>
         My Jobs
         </sapn>
      </div>
      <div class="col-3 p-3  ">
         <span class="text-muted" onclick="$('#user_no_account_message_modal').modal('show');">
         <i class="fas  fs-2 fa-plus mb-1"></i><br>
         More
         </sapn>
      </div>
   </div>
</div>
<div class="modal fade" id="user_no_account_message_modal" tabindex="-1" role="dialog" aria-labelledby="user_no_account_message_title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered-d" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-body text-center" style="min-height:300px;">
            <img src="{{asset('/images/svg/l2l_add_user_ss.svg')}}" class="img-fluid" style="width:250px;" alt="Service Seeker - Add User Account">
            <br>
            <br>
            <p>You are browsing LocaL2LocaL in guest mode with limited features. Please click below if you want to login or register a new account with us to enable all LocaL2LocaL app features.</p>
            <a class="btn theme-background-color text-white" href="{{route('login')}}" style="border-radius:30px;" onclick="toggle_animation(true);">Login or Sign Up</a>
         </div>
      </div>
   </div>
</div>