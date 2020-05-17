@extends('market/marketMaster')
@section('scripts')
@endsection
@section('content')
<style>
   @media screen and (min-width: 300px){   
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_sp_small.jpg");
   min-height:450px;
   min-width: 350px;
   background-size: cover;
   }
   }
   @media screen and (min-width: 700px) {      
   .marketing_image2 {
   background: url("https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/a.jpg");
   min-height:600px;
   background-size: cover;
   }
   } 
</style>
<div class="jumbotron marketing_image2">
      <div class="w3-black  p-3 m-1 " style="opacity:0.7!important;">
         <h1 class=" w3-text-white" style="font-size:50px;">
            <strong>Service Provider Guide</strong></h2>
            <h3 class="lead">
            <strong>Read through this page to learn more about becoming a LocaL2LocaL Service Provider. </strong>
         </h1>
      </div>
   </div>
<div class="container bg-white  p-4">
   
   <div class="row m-1">
      <div class="col-sm  ">
         <div class="row">
            <div class="col-">
               <i class="far fa-clock w3-xxxlarge w3-text-black mb-3"></i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Be Your Own Boss</strong></p>
               <p>Earn extra money by using your skills or interests when you want. Not only can you “Be your own Boss”, but you can help somebody nearby.</p>
            </div>
         </div>
      </div>
      <div class="col-sm">
         <div class="row">
            <div class="col-">
               <i class="fas fa-hand-holding-usd w3-xxxlarge w3-text-black mb-3"></i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Get Paid</strong></p>
               <p>Once you enter your bank details and you have completed a job your earnings are transferred via our secure Stripe Payment Gateway*</p>
            </div>
         </div>
      </div>
      <div class="col-sm  ">
         <div class="row">
            <div class="col-">
               <i class="far fa-handshake w3-xxxlarge w3-text-black mb-3 "></i>
            </div>
            <div class="col- ">
               <p class="font_title_small"><strong>Creating Community</strong></p>
               <p>By being available in your local community with your skills or hobbies you bring neighbours closer and build a local network.</p>
            </div>
         </div>
      </div>
   </div>
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
   <div class="row border-top pl-2 pr-2 pb-4 pt-4">
      <div class="col-">
         <p class="font_title_small "><strong>Your Ratings</strong></p>
         <p class="font_title_small "><i class="fas fa-star w3-xxxlarge w3-text-black"></i></p>
         <div class="w3-row  ">
            <p>These are purely an average from the Service Seekers rating you on a job well done. These are visible to the Service Seekers and may affect their choice of Service Provider based on higher ratings. Please note: To dispute a rating by a Service Seeker please go to the help tab in the Local2Local App Menu.</p>
         </div>
      </div>
      <div class="col-  w3-margin-top ">
         <p class="font_title_small"><strong>Your Rankings</strong></p>
         <p class="font_title_small"><i class="fas fa-trophy  w3-text-black w3-xxxlarge"></i></p>
         <div class="w3-row ">
            <p>Service provider rankings are different to Ratings in that they are accumulated over the month depending on how many jobs you perform in relation to other Service Providers. There are five Ranking levels:</p>
            <ol>
               <li>Diamond</li>
               <li>Ruby</li>
               <li>Emerald</li>
               <li>Saphire</li>
               <li>Opal</li>
            </ol>
            <p>These rankings are visible to the Service Seeker by the colour of your icon on the map or by clicking on your profile. They give confidence to the Service Seeker by showing you are a regular LocaL2LocaL Service Provider.</p>
         </div>
      </div>
   </div>
   <div class="row  border-top pl-2 pr-2 pb-4 pt-4 ">
      <div class="col-sm mt-3">
         <p class="font_title_small "><strong>Insure yourself</strong></p>
         <i class="fas fa-people-carry icon_font_large w3-text-black"></i>
         <div class="mt-3">
            <a href="{{secure_url('sp_insurance')}}" target="_blank">Click Here</a> to fill in details and have a quote sent to you for easy and quick coverage* T’s & C’s Apply
            </br>
            <br>
            Please login to request an insurance quote.
            <p class="mt-3">
               <a class="w3-btn w3-black w3-tiny"  href="{{secure_url('sp_insurance')}}" target="_blank">Request a Quote</a>
            </p>
         </div>
      </div>
   </div>
   <div class="border-top pl-2 pr-2 pb-4 pt-4">
      <p class="font_title_small w3-padding"><strong>It's easy to become a Service Provider</strong></p>
      <div class="w3-margin  w3-padding  ">
         <p class="font_title_small"> <strong>Step 1 </strong> </p>
         <p>Create your account and sign in as a Service Provider. Complete the basic information and upload any relevant documents (optional) Verify your account using a code sent to your mobile number.</p>
      </div>
      <div class="w3-margin   w3-padding ">
         <p class="font_title_small"><strong>Step 2 </strong>  </p>
         <p>Enter your bank details into Payment Settings so your payment for your job can be securely transferred once your job is complete <small>* May take up to 48 hours</small></p>
      </div>
      <div class="w3-margin  w3-padding ">
         <p class="font_title_small"> <strong>Step 3 </strong>  </p>
         <p>Remember to set the radius in your account settings, then when you are ready ”Flick” the Homepage” to “Online” and get ready for your neighbours/Community to request your services.</p>
      </div>
   </div>
</div>
@endsection