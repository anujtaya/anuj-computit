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


<div class="fixed-bottom bg-white " @if(request()->is('service_seeker/home')) style="height:11%" @endif>
   <div class="row border-top sticky-bottom  fs--1 text-center m-0" style="border-color:#f7f7f9!important;">
      @if(request()->is('service_seeker/home') || request()->is('service_seeker/more'))
      <div class="container pt-2">
         @else
         <div class="col-12 mb-2 p-2">
            <a class="btn btn-block btn-sm text-white mt-2 shadow"
               style="background:#5D29BA!important;color:white!important;" href="{{route('service_provider_home')}}"
               onclick="toggle_animation(true);">Switch to Provider - I want to work</a>
         </div>
         <div class="container">
            @endif

            <div class="row">
               <div class="col p-0">
                  @if(!(request()->is('service_seeker/home')) || request()->has('showBooking'))
                  <a class="{{ (request()->is('service_seeker/home')) ? 'theme-color' : '' }}  text-muted  text-decoration-none"
                     href="{{route('service_seeker_home')}}" onclick="toggle_animation(true);"><i
                        class="fas  fs-2 fa-home mb-1"></i> <br>
                     Home
                  </a>
                  @else
                  <span class="{{ (request()->is('service_seeker/home')) ? 'theme-color' : '' }}  text-decoration-none"
                     onclick="update_user_location();"><i class="fas  fs-2 fa-home mb-1"></i> <br>
                     Home
                  </span>
                  @endif
               </div>
               <div class="col p-0">
                  <a class="text-muted text-decoration-none {{ (request()->is('service_seeker/profile')) ? 'theme-color' : '' }} text-muted"
                     href="{{route('service_seeker_profile')}}" onclick="toggle_animation(true);">
                     <i class="fas  fs-2 fa-user mb-1"></i><br>
                     Profile
                  </a>
               </div>
               <div class="col p-0">
                  <a class=" text-decoration-none {{ (request()->is('service_seeker/jobs/history')) ? 'theme-color' : '' }} text-muted"
                     href="{{route('service_seeker_jobs')}}" onclick="toggle_animation(true);">
                     <i class="fas  fs-2  fa-briefcase mb-1"></i>
                     <br>
                     Jobs
                  </a>
               </div>
               <div class="col p-0">
                  <a class=" text-decoration-none {{ (request()->is('service_seeker/jobs/conversation')) ? 'theme-color' : '' }} text-muted"
                     href="{{route('service_seeker_inbox_conversation')}}" onclick="toggle_animation(true);">
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
                  <a class=" text-decoration-none {{ (request()->is('service_seeker/more')) ? 'theme-color' : '' }} text-muted"
                     href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">
                     <i class="fas  fs-2 fa-plus mb-1"></i><br>
                     More
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>


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