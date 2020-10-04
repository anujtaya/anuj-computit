@extends('layouts.service_seeker_master')
@section('content')
<style>
.carousel-indicators li {
   /* background-color: #399BDB; */
  background-color:#389BDB;
  border-radius: 50%;
  width:15px;
  height:15px;
}

.sub-text-color {
   color:#B4B4B4!important;
}

h5 {
   font-weight:bold!important;
}

</style>
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-0 text-center shadow-none">
                  <div class="borders  bg-darks text-center">
                     <div id="carouselExampleIndicators" class="carousel slide" style="min-height:470px!important;" data-ride="carousel">
                        <ol class="carousel-indicators" style="margin-top:50px!important;">
                           <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active p-2 text-center">
                              <img src="{{asset('/images/svg/l2l_ss_relaxing_at_home.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Select a Service</h5>
                              <p class="fs--1 mt-2 sub-text-color">                      
                                 Pick from over 200 categories, describe your job, set a time and we'll connect.
                              </p>
                           </div>
                           <div class="carousel-item  p-2 text-center">
                              <img src="{{asset('/images/svg/l2l_ss_meeting.svg')}}" style="height:200px!important;width:200px!important;"  class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Pick a Service Provider</h5>
                              <p class="fs--1 mt-2 sub-text-color">
                                 Now that your job has been requested, Service Providers will be notified instantly and are able to accept or decline the job depending on their
                                 preference.
                              </p>
                           </div>
                           <div class="carousel-item p-2">
                              <img src="{{asset('/images/svg/l2l_ss_time_management.svg')}}" style="height:200px!important;width:200px!important;"  class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Set your time and date</h5>
                              <p class="fs--1 mt-2 sub-text-color">
                              Our in app messaging also allows you to contact the selected provider to negotiate a time that suits you both.

                              </p>
                           </div>
                           <div class="carousel-item p-2">
                              <img src="{{asset('/images/svg/l2l_ss_location_tracking.svg')}}" style="height:200px!important;width:200px!important;"  class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Live Tracking</h5>
                              <p class="fs--1 mt-2 sub-text-color">
                                 Our live geo tracking technology allows you to see your provider arriving at your location in real time.
                              </p>
                           </div>
                        </div>
                        <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                           <span class="sr-only">Previous</span> 
                           <i class="fas fa-chevron-left  fs-1 theme-color" aria-hidden="true"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                           <span class="sr-only">Next</span>
                           <i class="fas fa-chevron-right  fs-1 theme-color"></i>
                        </a> -->
                     </div>
                    <br>
                    <a href="{{route('guest_service_seeker_home')}}?showBooking=on" onclick="toggle_animation(true);"  class="btn theme-background-color rounded-3 borders card-1 ml-4 mr-4 custom_button_shadow font-weight-normal">Continue <i class="ml-2 fas fa-arrow-right"></i></a>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
