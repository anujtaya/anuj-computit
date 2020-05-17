@extends('market/marketMaster')
@section('title')
LocaL2LocaL – About LocaL2LocaL
@endsection
@section('scripts')
@endsection
@section('content')
<style>
   #video-wrap {
   float: left;
   margin: 0 20px 5px 0;
   }
</style>
<div class="container bg-white p-3">
   <div class="">
      <h3 class="mt-3 mb-3">About us</h3>
   </div>
  <p>
     <div id="video-wrap">
        
         <video id="player1" poster="images/market_poster.png" class="video-edit" controls width="350px">
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/L2L+-+Welcome+480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
                 
     
         LocaL2LocaL is a mobile, web based application that has been founded on the need to 
         create a network within communities and to reach out to neighbours and LOCAL business. 
         LocaL2LocaL has been designed to connect Service Seekers and Service Providers and
         bridge the gap between the need to have a reliable, immediate service without the unknown of when they will arrive.
      </p>
      <p>
         Local2Local is not a quoting app but rather an application for fulfilling Immediate Services. 
         This means that if you need something done ‘Now’, then LocaL2LocaL provides a method to connect with a Service Provider who is available to assist. 
         There are many services currently listed including trades, cars, pet care, handyman and tutoring. 
         If you are able to assist a local, then create an account and select from the list of services you wish to provide. 
      </p>
      <p>
         In this day and age where having a full-time job or needing a second job is more necessary, 
         the LocaL2LocaL platform allows you to choose what you can benefit your community with and then, in your time,
         become an active LocaL2LocaL Service Provider and attain payment for your service.
      </p>
      <p>
         The unique tracking once a job has been accepted gives an immediate response to allow for the continuation of your day without the indefinite wait time. 
         We understand that everybody is on a deadline and when something needs to be done now, we can’t wait. 
         This App allows you to visually see who in your local area can come to your aid and help with almost anything.
      </p>
      <p>
         This is a supportive community where we can share our skills and talents and give back to the local area with these attributes and earn extra money while doing so. Locals helping Locals – 
         Neighbours helping Neighbours The ‘need it now’ motto means exactly that, if you need it now, 
         then someone local and nearby will be able to lend a hand and get the job done.   
      </p>
      <p>
         If you need it now – LocaL2LocaL it!
      </p>
   
</div>
@endsection