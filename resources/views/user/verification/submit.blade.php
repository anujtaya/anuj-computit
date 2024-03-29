@extends('layouts.app')
@section('content')
<style></style>
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-12  sticky-top bg-white p-0">
         <div class="row ml-2">
            <div class="col-4 p-3"><a href="{{route('user_verify_phone_send')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a> </div>
         </div>
      </div>
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-4 shadow-none">
                  <!-- page main title -->
                  <div class="text-center mt-4">
                     <h1 class="fs-1">Enter the PIN sent to: <br> <br>
                     <span class="fs--1 text-muted">+{{Auth::user()->phone}}  <br><br> <a class="fs--1" style="color:#1DC2FF!important;" href="{{ route('user_verify_phone_send')}}" onclick="toggle_animation(true);">(Change)</a></span></h1>
                    
                     <br>
                     @if(Session::has('status'))
                     <div class="alert alert-success fs--1 mt-2"> {{Session::pull('status')}}</div>
                     @endif
                     @if(Session::has('error'))
                     <div class="alert alert-success fs--1 mt-3"> {{Session::pull('error')}}</div>
                     @endif
                  </div>
                  <!-- start page illustrator -->
                  <form action="{{route('user_phone_number_verification_submitcode')}}" method="post" onsubmit="toggle_animation(true)">
                     @csrf
                     <div class="mt-2">
                        <input class="form-control rounded-0" type="tel" id="phone_number" name="phone_number" value="{{Auth::user()->phone}}" required hidden>
                        <input type="number" id="verification_code" name="verification_code" class="form-control text-center  @error('verification_code') is-invalid @enderror" placeholder="6 digits code" aria-label="mobile_number" aria-describedby="mobile_number">
                        @error('verification_code')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <!-- start page footer -->
                     <div class="text-center mt-4">
                        <button type="submit" class="btn rounded-3 mt-3 text-white fs--1" style="background-color:#2E92D1;-webkit-box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46);-moz-box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46); box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46);"  width="221px" height="47px" id="">
                        {{ __('Verify') }}
                        </button>
                        <a href="#" onclick="generate_request_code();" class="btn mt-3 text-white fs--1" style="background-color:#1DC2FF;-webkit-box-shadow: 0px 17px 33px -8px rgba(29, 194, 255, 0.46);-moz-box-shadow: 0px 17px 33px -8px rgba(29, 194, 255, 0.46); box-shadow: 0px 17px 33px -8px rgba(29, 194, 255, 0.46);" >Resend Code</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- hidden verification code request form -->
<form action="{{route('user_phone_number_verification_requestcode')}}" id="request-code-form" method="post">
   @csrf
   <input type="hidden" name="target_phone_number" id="target_phone_number">
</form>
<!-- end form -->
<script>
   $.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
   function generate_request_code(){
      var x = document.getElementById('phone_number');
      var y = document.getElementById('target_phone_number');
      var response = validate_australian_number(x.value);
      if(response.substr(0,1) == '+') {
          console.log(response);
          y.value  = response;
          toggle_animation(true);
          document.getElementById("request-code-form").submit();
   
      } else {
         $("#verification_code").addClass("is-invalid");
         //alert(response);
      }
   }
   
   function validateForm() {
      var x = document.getElementById('phone_number');
      var response = validate_australian_number(x.value);
      if(response.substr(0,1) == '+') {
          console.log(response);
          x.value  = response;
          return true;
   
      } else {
          console.log(response);
          return false;
      }
   }
   
   function validate_australian_number(number){
       var formatted_number = 'The number should contain one of the sting format [0,61,+61] and must be atleast 10 digits.';
       switch( number.length) {
          case 10:
              if(number.substr(0,1) == 0) {
                  formatted_number = '+61' + number.substr(1);
              } else {
                  number_format_error_exception('case 10');
              }
   
              break;
          case 11:
              if(number.substr(0,2) == '61') {
                  formatted_number = '+' + number.substr(0);
              } else {
                  number_format_error_exception('case 11');
              }
              break;
          case 12:
              if(number.substr(0,3) == '+61') {
                  formatted_number =  number.substr(0);
              } else {
                  number_format_error_exception('case 12');
              }
              break;
          default:
          number_format_error_exception();
          }
   
          return formatted_number
   }
   
   function number_format_error_exception(msg){
       console.log('The number should contain one of the sting format [0,61,+61] and must be atleast 10 digits. Details:' + msg)
   }
</script>
<!-- <div class="progress fixed-top rounded-0" style="height: 10px;">
   <div class="progress-bar theme-background-color" role="progressbar" style="width:50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
   $(".progress-bar").animate({
   width: "80%"
   }, 100);
</script> -->
@endsection