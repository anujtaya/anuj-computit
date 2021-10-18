<style>
   .relative-counter {
      position: relative;
   }

   .absolute-counter {
      position: absolute;
      top: -18px;
      right: -11px;
   }
</style>

<!-- bottom nav -->
<div class="fixed-bottom bg-white" style="height:16%!important;">
   <div class="row border-top  bg-white sticky-bottom justify-content-center fs--1 text-center m-0">

      <div class="col-12 pl-2 mb-2 pr-2">
         <a class="btn btn-block btn-sm text-white mt-2 shadow" style="background:#399BDB;"
            href="{{route('service_seeker_home')}}?showBooking=on" onclick="toggle_animation(true);">Switch to Seeker -
            I want work done</a>
      </div>
      <div class="container">
         <div class="row">
            <div class="col p-0">
               <a class="{{ (request()->is('service_provider/home')) ? 'theme-color' : '' }}  text-decoration-none text-muted"
                  href="{{route('service_provider_home')}}" onclick="toggle_animation(true);"> <i
                     class="fas  fs-2 fa-home mb-1"></i> <br>
                  Home</a>
            </div>
            <div class="col p-0">
               <a class="text-muted text-decoration-none {{ (request()->is('service_provider/profile/nested')) ? 'theme-color' : '' }} text-muted"
                  href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);">
                  <i class="fas  fs-2 fa-user mb-1"></i><br>
                  Profile
               </a>
            </div>
            <div class="col p-0">
               <a class=" text-decoration-none {{ (request()->is('service_provider/jobs/history')) ? 'theme-color' : '' }} text-muted"
                  href="{{route('service_provider_jobs_history')}}" onclick="toggle_animation(true);"> <i
                     class="fas  fs-2  fa-briefcase mb-1"></i><br>
                  Jobs
               </a>
            </div>
            <div class="col p-0">
               <a class=" text-decoration-none {{ (request()->is('service_provider/jobs/conversation')) ? 'theme-color' : '' }} text-muted"
                  href="{{route('service_provider_inbox_conversation')}}" onclick="toggle_animation(true);">
                  <span class="relative-counter">
                     <i class="fas fs-2  fa-comment-alt mb-1"></i>
                     <span class="badge badge-pill badge-danger absolute-counter" style="visibility: hidden"
                        id="unread_message_counter">0</span>
                  </span>
                  <br>
                  Messages
               </a>
            </div>
            <div class="col p-0">
               <a class=" text-decoration-none {{ (request()->is('service_provider/more')) ? 'theme-color' : '' }} text-muted"
                  href="{{route('service_provider_more')}}" onclick="toggle_animation(true);">
                  <i class="fas  fs-2 fa-plus mb-1"></i><br>
                  More
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- end bottom nav  -->

   <script>
      window.onload = () => {
         
            counter();
            setInterval(() => {
               counter()
            }, 30000); 
       
         
      }

      function counter() {
         fetch('{{route("service_provider_inbox_conversation_count")}}')
         .then((resp) => resp.json())
         .then((count) => {
            if(count.count > 0){
               $('#unread_message_counter').html(count.count);
               $('#unread_message_counter').css('visibility','visible');
            }
         })
         .catch((error) => console.log(error))
      }
   </script>