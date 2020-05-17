@extends('market/marketMaster')
@section('title')
LocaL2LocaL – For LocaL SME businesses 
@endsection
@section('scripts')
@endsection
@section('content')
<style>
   @media screen and (min-width: 300px){   
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/market_business.jpg?v=2");
   min-height:450px;
   min-width: 350px;
   background-size: cover;
   }
   }
   @media screen and (min-width: 700px) {      
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/market_business.jpg?v=2");
   min-height:600px;
   background-size: cover;
   }
   } 
</style>
<div class="jumbotron marketing_image2">
   <div class="w3-black rounded p-3 m-1" style="opacity:0.7!important;">
      <h1 style="font-size:50px;">
         <strong>Business Class</strong></h2>
         <h3 class="lead">
         <strong>Reach out to even more customers by joining our platform...</strong>
      </h1>
   </div>
</div>
<div class="container bg-white p-4">


   <div class="row">
      <div class="col-sm p-3 ">
         <div class="row p-3 m-3  ">
            <div class="col-">
               <i class="material-icons mb-3 icon_font_large">
               place
               </i>
            </div>
            <div class="col- ">
               <h5><strong>Australia Wide</strong></h5>
               <p>The LocaL2LocaL Community extends throughout the country.</p>
            </div>
         </div>
      </div>
      <div class="col-sm p-3 ">
         <div class="row p-3 m-3  ">
            <div class="col-">
               <i class="far fa-calendar mb-3 icon_font_large"></i>
            </div>
            <div class="col- ">
               <h5><strong>Time Flexibility</strong></h5>
               <p>LocaL2LocaL has the ability to “Fill any Gaps” that may appear in a schedule by becoming active as a Service Provider or allow you to broaden your workforce if the demand increases as a Service Seeker.</p>
            </div>
         </div>
      </div>
      <div class="col-sm p-3">
         <div class="row p-3 m-3  ">
            <div class="col-">
               <i class="material-icons mb-3 icon_font_large">
               people
               </i>
            </div>
            <div class="col- ">
               <h5><strong>Available Workforce</strong></h5>
               <p>The LocaL2LocaL Business Platform gives the business owner a flexible, expansive workforce that can fluctuate according to demand.</p>
            </div>
         </div>
      </div>
      <div class="col-sm p-3">
         <div class="row p-3 m-3  ">
            <div class="col-">
               <i class="material-icons mb-3 icon_font_large">
               verified_user
               </i>
            </div>
            <div class="col-">
               <h5><strong>Fraud Protection</strong></h5>
               <p class="">We verify the information of every Service Provider that joins our team. This helps us create a fraud-free environment at LocaL2Local.</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection