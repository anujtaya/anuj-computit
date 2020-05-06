@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
<style>
   body,html {
   }
   .modal-backdrop {
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 1040;
   background-color: #000!important;
   }
   .modal-backdrop.in {
   filter: alpha(opacity=50);
   }
</style>
<div class="container  text-white   mt-0 p-0">
   <div class="row  justify-content-center" >
      <div class="col-lg-4    col-md-12 p-0" style="">
         <div class="p-2 theme-color rounded shadows m-4" style="border-radisus:55px; margin-top: 0px;">
            <div class="mb-4 text-center">
               <img src="{{asset('/images/brand/l2l-logo-registered.svg')}}" class="img-fluid animated flipTop" style="height:60px;width:60px;"  alt="LocaL2LocaL - Registered Mark SVG Image">
            </div>
            <h5 class="fs-1 mb-3 text-center">Welcome to LocaL2LocaL</h5>
            <h5 class="fs-1 mb-3 text-center">Please login or Sign up</h5>
            @include('auth.forms.login-form')
         </div>
      </div>
   </div>
</div>
@endsection
<div class="modal fade" style="left:-8px!important;" id="registerDialog" tabindex="-1" role="dialog" aria-labelledby="registerDialogTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content " style=" background: rgba(76, 175, 80, 0.0); border:0px;">
         <div class="m-3 borders bg-white  rounded">
            <div class="modal-header">
               <h5 class="modal-title fs--" id="registerDialog">Create an Account</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body ">
               <p class="mb-4">What would you like to do on LocaL2LocaL?</p>
               <form id="register_option" action="{{route('guest_register')}}" method="post" class="m-0">
                  @csrf
                  <div class="radio">
                     <input id="radio-1" name="demo_type" type="radio" value="ss" checked="">
                     <label for="radio-1" class="radio-label  " style="font-size:16px;">I want work done.</label>
                  </div>
                  <div class="radio">
                     <input id="radio-2" name="demo_type" value="sp" type="radio">
                     <label for="radio-2" class="radio-label" style="font-size:16px;">I want to work.</label>
                  </div>
                  <div class="mt-4">
                     <button type="submit" class="btn theme-background-color fs--1 text-white" styles="border-radius:20px;padding-left:10px;padding-top:10px;padding-bottom:10px;" width="221px" height="47px" onclick="toggle_animation(true);">Continue</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>