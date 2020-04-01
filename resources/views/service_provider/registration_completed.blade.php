@extends('layouts.service_provider_master')
@section('content')
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-3 text-center shadow-none">
                  <img src="{{asset('images/svg/undraw_confirmed_81ex.svg')}}" style="max-height:200px" class="img-fluid m-4" alt="">
                  <span>You are now a registered Service Provider on LocaL2LocaL platform. </span><br>
                     <ul class="list-group fs--1 text-left">
                        <li class="list-group-item"> <i class="far fa-check-circle text-success"></i> Get Job Alerts</li>
                        <li class="list-group-item"> <i class="far fa-check-circle text-success"></i> View Nearby Jobs</li>
                        <li class="list-group-item"> <i class="far fa-check-circle text-success"></i> Offer Quote to Service Seeker</li>
                        <li class="list-group-item"> <i class="far fa-check-circle text-success"></i> Get Weekly & Monthly News letters</li>
                     </ul>
                     <br>
                     <a href="{{route('service_provider_home')}}" class="btn btn-sms fs--1 theme-background-color" onclick="toggle_animation(true);">Go to Dashboard <i class="fas fa-arrow-right"></i></a>
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
</script>
@endsection
