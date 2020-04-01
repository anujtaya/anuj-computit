<div class="pl-2 pr-3 fs--1">
   <div class="alert bg-success text-white shadow-sm m-1 p-2"><i class="far fa-calendar-alt"></i> This job is scheduled for 01/02/2020 10:30AM</div>
   <br>
   <li class="list-group-item m-1 border-0 shadow-sm rounded fs--1 animated" onclick="location.href= '{{route('service_seeker_job_conversation')}}';toggle_animation(true);" >
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 mt-1 bd-highlight">
            <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt=""> 
         </div>
         <div class="p-1 bd-highlight">
            <span class="theme-color" style="font-size: 0.9rem;">John Doe</span> <br>
            <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i> </span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <span class="text-success fs-2">${{rand(11,55)}}</span>
         </div>
      </div>
      <div class="text-muted bg-light p-2 mb-1 rounded">
         Happy to do the job for $50.
      </div>
      <span class="text-muted font-weight-normal fs--1 p-1">2 Replies</span> 
   </li>
   <br>
   <p class="p-2">We are waiting for Service Provider to start the job tracking so you can see his route on map. We will let you know when the tracking is availble.</p>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">