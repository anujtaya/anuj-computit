@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Download for iOS and Andorid devices
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container bg-white p-4">
   <div class="jumbotron bg-white">
      <h3 class="w3-center mb-5 mt-5"><strong>Download App</strong></h3>
      <div class="w3-row">
         <div class="w3-col s6 border-right p-3">
            <span class="w3-right">
            <a href="https://apps.apple.com/app/id1367359034/">
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/apple_badge.svg" height="46px" width="153px" alt="Apple Store App Store Badge Icon"/> 
            </a> 
            </span>
         </div>
         <div class="w3-col s6 p-3">
            <a href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US>">
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/android_badge.png"    alt="Play Store  Badge Icon" /> 
            </a>
         </div>
      </div>
   </div>
   <p>
       Important information: if the above link doesn't work, please search for LocaL2LocaL Australia in App store and LocaL2LocaL in Google Play store. If you encounter any problem while installing the app, please contact support at any time.
   </p>
</div>
@endsection