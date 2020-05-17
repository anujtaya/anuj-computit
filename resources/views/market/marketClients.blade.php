@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Service Seeker Registration information
@endsection
@section('scripts')
@endsection
@section('content')
<style>
   @media screen and (min-width: 300px){   
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/market_sk_01.jpg");
   min-height:450px;
   min-width: 350px;
   background-size: cover;
   }
   }
   @media screen and (min-width: 700px) {      
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/market_sk_01.jpg");
   min-height:600px;
   background-size: cover;
   }
   } 
</style>

<div class="jumbotron marketing_image2 ">
   <div class="bg-dark rounded p-3 m-1 text-white " style="opacity:0.7!important;">
      <h1 class="display-3"><strong>Service Seeker Guide</strong></h1>
      <p class="lead">Join our growing community of Service Seekers. </p>
      <p>We understand that everybody is on a deadline, so when a job needs to be actioned immediately,
         Local2Local allows you to visually see who in your area can come
         to your aid and help with almost anything!
      </p>
   </div>
</div>
<div class="container p-4 bg-white">


   <div class="row Service Seeker_marketing_image">
      <div class="col-sm w3-padding">
         <div class="row p-3 m-3  ">
            <div class="col-">
               <i class="material-icons icon_font_large w3-text-black">
               mobile_friendly
               </i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>On-demand Service</strong></p>
               <p>As a Service Seeker, you can book the services you need, anytime, anywhere. Subject to Service Provider availablity.</p>
            </div>
         </div>
      </div>
      <div class="col-sm p-3">
         <div class="row p-3 m-3   ">
            <div class="col-">
               <i class="material-icons icon_font_large w3-text-black">
               person_pin_circle
               </i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Real-time tracking</strong></p>
               <p>Track your Service Provider, live, using our Smart App. All you need is a location enabled device.</p>
            </div>
         </div>
      </div>
      <div class="col-sm w3-padding">
         <div class="row p-3  m-3  ">
            <div class="col-">
               <i class="material-icons icon_font_large w3-text-black">
               people
               </i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Select your Service Provider</strong></p>
               <p>As a Service Seeker, you can select a Service Provider and look at their profile before booking services.</p>
            </div>
         </div>
      </div>
      <div class="col-sm w3-padding">
         <div class="row p-3 m-3   ">
            <div class="col-">
               <i class="material-icons icon_font_large w3-text-black">
               rate_review
               </i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Rate your Services</strong></p>
               <p>By rating your Service Provider it helps us to improve our LocaL2LocaL standards.</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection