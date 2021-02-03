@extends('layouts.service_seeker_master')
@section('content')
<style>
.carousel-indicators li {
   background-color: #399BDB;
}
</style>
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-0 text-center shadow-none">
                  <div class="d-flex bd-highlight m-2">
                     <div class="p-1 theme-color bd-highlight">  
                        
                     </div>
                     <div class="p-2 ml-auto bd-highlight">
                        <a href="{{route('service_seeker_home')}}"  class="font-weight-bolder theme-color" onclick="toggle_animation(true);"> Done</a>
                     </div>
                  </div>
                  <div class="mt-4 borders  bg-darks text-center">
                     <div id="carouselExampleIndicators" class="carousel slide" style="min-height:500px!important;" data-ride="carousel">
                     <ol class="carousel-indicators mt-5">
                           <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active p-3">
                              <img src="{{asset('/images/svg/l2l_user_laptop.svg')}}" style="width:250;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Select a Service</h5>
                              <p class="fs--1 mt-2">                      
                                 Pick from over 200 categories, describe your job, set a time and we'll connect.
                              </p>
                           </div>
                           <div class="carousel-item  p-3">
                              <img src="{{asset('/images/svg/l2l_service_provider.svg')}}" style="width:250;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Pick a Service Provider</h5>
                              <p class="fs--1 mt-2">
                                 Now that your job has been requested, Service Providers will be notified instantly and are able to accpet or decline the job depending on their
                                 preference.
                              </p>
                           </div>
                           <div class="carousel-item p-3">
                              <img src="{{asset('/images/svg/l2l_user_clock.svg')}}" style="width:250;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Set your time and date</h5>
                              <p class="fs--1 mt-2">
                                 Once accepted, we hoe to have your job completed ASAP. You can scheule the time for immediately or sometime in the future. Our in app messaging
                                 also allows you to contact the selected provider to negotiate a time that suits you both.
                              </p>
                           </div>
                           <div class="carousel-item p-3">
                              <img src="{{asset('/images/svg/l2l_girl_phone.svg')}}" style="width:250;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Live Tracking</h5>
                              <p class="fs--1 mt-2">
                                 Our live tracking feature allows you to tune in live and watch your provider exact location adn ETA.
                              </p>
                           </div>
                        </div>
                        {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                           <span class="sr-only">Previous</span> 
                           <i class="fas fa-chevron-left  fs-1 theme-color" aria-hidden="true"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                           <span class="sr-only">Next</span>
                           <i class="fas fa-chevron-right  fs-1 theme-color"></i>
                        </a> --}}
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="progress fixed-top rounded-0" style="height: 10px;">
  <div class="progress-bar  theme-background-color" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
$(".progress-bar").animate({
   width: "100%"
}, 100);
$(document).ready(function() {
   $('.carousel').carousel({
      interval: 12000
   })
});

</script>
@endsection
