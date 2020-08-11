@extends('layouts.app')
@section('content')
<style></style>
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-4">
         <div class="row" >
            <div class="col-md-12 h-100" >
               <div class="card bg-white p-4 shadow-none">
               <div class="d-flex bd-highlight mb-3">
                  <div class="p-2 bd-highlight">
                     <!-- <i class="fas fa-arrow-left text-muted fs-2"></i> -->
                  </div>
                  <div class="p-2 bd-highlight">
                  </div>
                  <div class="ml-auto p-2 bd-highlight">
                     <!-- <i class="fas fa-arrow-right fs-2"></i> -->
                  </div>
               </div>
                  <!-- page main title -->
                  <div class="text-center">
                     <h1 class="fs-1">Verify your mobile number</h1>
                  </div>
                  <!-- start page illustrator -->
                  <div class="text-center">
                     <img src="{{asset('/images/svg/l2l_verification_image.svg')}}" alt="">
                     <p class="text-center fs--1 mt-3">Enter your number so we know you're you</p>
                  </div>
                  <div>
                     <div class="input-group mt-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text text-muted form-control-sm fs--1" style="padding:0.86rem 1rem!important;" id="basic-addon1">+61</span>
                        </div>
                        <input id="phone_number" type="number" class="form-control form-control-sm  @error('mobile_number') is-invalid @enderror" value="{{Auth::user()->phone}}" placeholder="" aria-label="mobile_number" aria-describedby="mobile_number">
                        <span id="phone_number_error" class="text-danger fs--2"></span>
                     </div>
                  </div>
                  <!-- start page footer -->
                  <div class="text-center mt-3">
                     <button type="submit" class="btn rounded-3 mt-3 text-white fs--1" style="background-color:#2E92D1;-webkit-box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46);-moz-box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46); box-shadow: 0px 17px 33px -8px rgba(34, 94, 132, 0.46);"  width="221px" height="47px" id="">
                     {{ __('Continue') }}
                     </button>
                  </div>
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
          $("#phone_number").removeClass("is-invalid"); //alert(response);
          $("#phone_number_error").html("");
          console.log(response);
          y.value  = response;
          toggle_animation(true);
          document.getElementById("request-code-form").submit();

      } else {
         $("#phone_number").addClass("is-invalid"); //alert(response);
         $("#phone_number_error").html(response);
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


<!-- 
<div class="progress fixed-top rounded-0" style="height: 10px;">
  <div class="progress-bar theme-background-color" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
    $(".progress-bar").animate({
    width: "50%"
}, 100); -->
</script>
@endsection
