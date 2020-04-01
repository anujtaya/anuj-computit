@extends('layouts.app')
@section('content')
<style>
   @media (min-width:320px)  {
   /* smartphones, iPhone, portrait 480x320 phones */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   left: calc(100% - 71%);
   }
   #containerdivid{
   position:absolute;
   margin-right: 15px;
   }
   }
   @media (min-width:350px)  {
   /* smartphones, iPhone, portrait 480x320 phones */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   left: calc(100% - 60%);
   }
   #containerdivid{
   position:absolute;
   margin-right: 15px;
   }
   }
   @media (min-width:400px)  {
   /* smartphones, iPhone, portrait 480x320 phones */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   left: calc(100% - 62%);
   }
   #containerdivid{
   position:absolute;
   margin-right: 15px;
   }
   }
   @media (min-width:481px)  {
   /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   margin-left: calc(100% - 60%);
   }
   #containerdivid{
   position:absolute;
   }
   }
   @media (min-width:641px)  {
   /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   margin-left: calc(100% - 90%);
   }
   #containerdivid{
   position:absolute;
   }
   }
   @media (min-width:961px)  {
   /* tablet, landscape iPad, lo-res laptops ands desktops */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   margin-left: calc(100% - 105%);
   }
   #containerdivid{
   position:absolute;
   }
   }
   @media (min-width:1025px) {
   /* big landscape tablets, laptops, and desktops */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   margin-left: calc(100% - 102%);
   }
   #containerdivid{
   position:absolute;
   }
   }
   @media (min-width:1281px) {
   /* hi-res laptops and desktops */
   #loginimage{
   display:block;
   position:relative;
   margin-top: -83px;
   margin-left: calc(100% - 97%);
   }
   #containerdivid{
   position:absolute;
   }
   }
   .custom-header {
   background-image: url('{{asset('/images/brand/bg-2.png')}}');
   /* background-attachment: fixed; */
   background-size: cover;
   }
</style>
<div class="container borderes mt-0 p-0">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  col-md-12 p-0">
         <div class="row  m-0 " >
            <div class="col-lg-12 border  p-0" >
               <div class="custom-header" >
                  <br><br><br><br><br>
               </div>
               <div  class="card bg-white bordere p-4 shadow-none  " style="border-radisus:55px; margin-top: 0px;">
                  <div class="card-header text-center">
                     <img id="loginimage" src="{{asset('/images/svg/l2l-logo.svg')}}" class="mb-2 bg-white p-1 card-2 rounded-circle" height="70px" width="70px" alt="LocaL2LocaL - Getting Started SVG Image">
                  </div>
                  <div class="row m-0 text-center">
                     <div class="col-6 p-1  border-bottom border-info" id="container_login">
                        <a href="#"  style="text-decoration: none; " onclick="signup_to_login();" class="text-info  p-2 fs-1 font-weight-boldera" id="btn_login">Login</a>
                     </div>
                     <div class="col-6 p-1" id="container_signup">
                        <a href="#"  style="text-decoration: none; " onclick="login_to_signup();" class="text-muted fs-1 font-weight-boldera" id="btn_signup">Signup</a>
                     </div>
                  </div>
                  <div class="holder-main mt-4 pt-3">
                     <div class="p-1 text-center"  id="view_login" style="min-height:350px;">
                        @include('auth.forms.login-form')
                     </div>
                     <div class="p-1 "  id="view_signup" style="display:none;min-height:350px;">
                        <h3 class=" text-centers" style="font-size:16px;">What would like to do on LocaL2LocaL?</h3>
                        <br>
                        <form action="#" class="m-0">
                           <div class="radio">
                              <input id="radio-1" name="radio" type="radio" checked>
                              <label for="radio-1" class="radio-label  " style="   font-size:16px;">I want work done.</label>
                           </div>
                           <div class="radio">
                              <input id="radio-2" name="radio" type="radio">
                              <label  for="radio-2" class="radio-label"  style="    font-size:16px;">I want to work.</label>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-info rounded-3 mt-3  card-2 " style="width: 200px!important;" width="221px" height="47px" id="" onclick='main_btn_status(this.id);$("#login_form").submit();'>
                              {{ __('Signup') }}
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="col-lg-12 text-center p-0">
               <img src="{{asset('/images/svg/undraw_suburbs_8b83.svg')}}" class="img-fluid" height="100px" alt="">
               
               </div>
               -->
         </div>
      </div>
   </div>
</div>
<script>
   function login_to_signup(){
             $( "#btn_login" ).addClass( "text-muted" );
             $( "#btn_login" ).removeClass( "text-info" );
             $( "#container_login" ).removeClass( "border-bottom border-info" );
             $( "#container_signup" ).addClass( "border-bottom border-info" );
             $( "#btn_signup" ).removeClass( "text-muted" );
             $( "#btn_signup" ).addClass( "text-info" );
             $( "#view_login" ).hide();
             $( "#view_signup" ).show();
   }
   
   function signup_to_login(){
             $( "#btn_signup" ).addClass( "text-muted" );
             $( "#btn_signup" ).removeClass( "text-info" );
             $( "#container_signup" ).removeClass( "border-bottom border-info" );
             $( "#container_login" ).addClass( "border-bottom border-info" );
             $( "#btn_login" ).removeClass( "text-muted" );
             $( "#btn_login" ).addClass( "text-info" );
             $( "#view_login" ).show();
             $( "#view_signup" ).hide();
   }
</script>
@endsection