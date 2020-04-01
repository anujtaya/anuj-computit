@extends('layouts.app')
@section('content')
<style>
.carousel-indicators li {
   background-color: #399BDB;
}

</style>
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row borders  " >
            <div class="col-lg-12 h-100  " >
               <div class="card  p-2  shadow-none">
                  <div class="d-flex bd-highlight mb-1">
                     <div class="p-2 bd-highlight">
                        <!-- <i class="fas fa-arrow-left text-muted fs-2"></i> -->
                     </div>
                     <div class="p-2 bd-highlight">
                     </div>
                     <div class="ml-auto p-2 bd-highlight">
                        <a class=" theme-color border-bottom border-theme-color link-no-underline p-2" href="">Skip</a> 
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
                              <img src="{{asset('/images/svg/l2l_user_laptop.svg')}}" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Select a Service</h5>
                              <p class="fs--1 mt-2">
                                 Pick from over 200 categories, describe your job, set a time and we'll connect 
                              </p>
                           </div>
                           <div class="carousel-item  p-3">
                              <img src="{{asset('/images/svg/l2l_service_provider.svg')}}" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Pick a Service Provider</h5>
                              <p class="fs--1 mt-2">                      
                                 Now that your job has been requested, Service Providers will be notified instantly and are able to accept or decline the job depending on their preference. 
                              </p>
                           </div>
                           <div class="carousel-item p-3">
                              <img src="{{asset('/images/svg/l2l_user_clock.svg')}}" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Set your time and date</h5>
                              <p class="fs--1 mt-2">
                                 Once accepted, we hope to have your job completed asap. You can schedule the time for immediately or sometime in the future. Our in app messaging also allows you to contact the selected provider to negotiate a time that suits you both. 
                              </p>
                           </div>
                           <div class="carousel-item p-3">
                              <img src="{{asset('/images/svg/l2l_girl_phone.svg')}}" class="img-fluid m-4" alt="">
                              <h5 class="fs-1 mt-2">Watch your provider coming to you LIVE</h5>
                              <p class="fs--1 mt-2">
                                 Our live tracking feature allows you to tune in live and watch your provider exact location as they
                              </p>
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection