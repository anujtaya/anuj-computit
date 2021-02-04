@extends('layouts.app')
@section('title', 'Password Reset Success')
@section('content')
<div class="container  text-white   mt-4 p-0">
   <div class="row" >
      <div class="col-lg-4 col-md-12 p-0" style="">
         <div class="p-2 theme-color rounded shadows m-4" style="border-radisus:55px; margin-top: 0px;">
            <div class="mt-4 mb-4">
               <img src="{{asset('/images/brand/l2l-logo-registered.svg')}}" class="img-fluid animated flipTop" style="height:60px;width:60px;"  alt="LocaL2LocaL - Registered Mark SVG Image">
            </div>
            <h5 class="fs-1 mb-3" style="font-family:'Varela Round'!important;font-size:35px;">Password Reset Completed</h5>
            <div class="p-0">
               <h2></h2>
               <p class="">Dear @if(Auth::check()){{Auth::user()->first}}!@else LocaL2LocaL User!@endif, Your password reset was completed succesfully. Please close this window and go to you LocaL2LocaL app to sign in with your new password.</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection