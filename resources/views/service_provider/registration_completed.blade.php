@extends('layouts.service_provider_master')
@section('content')
<style>
.carousel-indicators li {
   /* background-color: #5D29BA; */
   background-color:#7131A1;
   border-radius: 50%;
   width:15px;
   height:15px;
}

.sub-text-color {
   color:#B4B4B4!important;
   font-size:12px!important;
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
                  <div class=" borders  bg-darks text-center">
                     <div id="carouselExampleIndicators" class="carousel slide" style="min-height:470px!important;" data-ride="carousel">
                     <ol class="carousel-indicators mt-5">
                           <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active p-2">
                              <img src="{{asset('/images/svg/l2l_service_provider.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 ">Search for jobs</h5>
                              <p class="fs--1  sub-text-color">                      
                                It's never been easier to search for jobs to do in your local area. <br>
                                It's as simple as setting up your profile, filtering your search based on your interests and skills
                                and your ready to get started.
                              </p>
                           </div>
                           <div class="carousel-item  p-2">
                              <img src="{{asset('/images/svg/l2l_user_laptop.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1">Make an Offer</h5>
                              <p class="fs--1  sub-text-color">
                                 Once you find the job for you, it's time to make an offer. Start by describing why you would be the right one 
                                 for the job by adding your skills and qualitifications.
                              </p>
                           </div>
                           <div class="carousel-item p-2">
                              <img src="{{asset('/images/svg/l2l_user_clock.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1">Set your time and date and you are on your way!</h5>
                              <p class="fs--1  sub-text-color">
                                 Once selected you're ready to negotiate a time that suits you both, our live map will direct you to your assigned location, sending 
                                 notifications to your Seeker. On completion our in app invoicing will take care of payments keeping things simple for everyone. 
                              </p>
                           </div>
                        </div>
                     </div>
                    <br>
                    <a href="{{route('service_provider_home')}}" onclick="toggle_animation(true);"  class="btn theme-background-color rounded-3 borders card-1 ml-4 mr-4 font-weight-normal custom_button_shadow_sp">Continue <i class="ml-2 fas fa-arrow-right"></i></a>
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
