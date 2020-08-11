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
                                 You can now search for jobs within your local area. A person looking for work done 
                                 will post their job with a bit of information and any photos necessary. You can than filter this search 
                                 based upon your interests and skills provided when setting up your profile or customise it further to suit you.
                              </p>
                           </div>
                           <div class="carousel-item  p-2">
                              <img src="{{asset('/images/svg/l2l_user_laptop.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1">Make an Offer</h5>
                              <p class="fs--1  sub-text-color">
                                 Find a job you like? Its as simple as clicking on the job in our jobs board, describing why you would be great at
                                 the job and making your pricing offer on the job. This will send a message to the seeker who will be able to compare 
                                 you and your pricing, location, reviews, rating against other providers who have offered to do the job. 
                              </p>
                           </div>
                           <div class="carousel-item p-2">
                              <img src="{{asset('/images/svg/l2l_user_clock.svg')}}" style="height:200px!important;width:200px!important;" class="img-fluid m-4" alt="">
                              <h5 class="fs-1">Set your time and date and you are on your way!</h5>
                              <p class="fs--1  sub-text-color">
                                 If you have been selected to do the job, you will get a notificaion which will allow you to use our in app messaging
                                 features to negotiate the best time and date that suits you. In app map view will direct you to your assigned location and you will be able to complete the job, get paid.
                              </p>
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                           <span class="sr-only">Previous</span> 
                           <i class="fas fa-chevron-left  fs-1 theme-color" aria-hidden="true"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                           <span class="sr-only">Next</span>
                           <i class="fas fa-chevron-right  fs-1 theme-color"></i>
                        </a>
                     </div>
                    <br>
                    <a href="{{route('guest_service_provider_home')}}" onclick="toggle_animation(true);"  class="btn theme-background-color rounded-3 borders card-1 ml-4 mr-4 font-weight-normal custom_button_shadow_sp">Continue <i class="ml-2 fas fa-arrow-right"></i></a>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
