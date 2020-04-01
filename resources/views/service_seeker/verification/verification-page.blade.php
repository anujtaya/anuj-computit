<!DOCTYPE html>
<html>
   <head>
      <title>User | Mobile Phone Verification</title>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
         html,body {
         height: 100%!important;
         font-family: 'Arimo', sans-serif;
         letter-spacing: 1px;
         font-size:15px;
         }
      </style>
   </head>
   <body class="bg-light">
      <div class="container p-3">
         <div class="row m-1 justify-content-md-center">
            <div class="col-lg-4 bg-white border shadows ">
               <div class="row">
                  <div class="col-12 p-3 bg-primary border-bottom "> <a href="{{url('clientAccount')}}" class="font-weight-bolder text-white"> <i class="fas fa-arrow-left" style="font-size:20px;csolor:#5e6e82;"></i></a> </div>
                  <div class="col-12 p-3"> <span class="font-weight-bolder" style="font-size:20px;color:#5e6e82;">  Verify Account</span></div>
               </div>
               <div class="row">
                  @if(Auth::user()->is_verified != 1 )
                  <div class="col-12 p-3">
                     <form action="{{route('user_phone_number_verification_submitcode')}}" method="post" onsubmit="return validateForm()">
                        @csrf
                        <label for="phone_number">Phone Number</label>
                        <input class="form-control rounded-0" type="tel" id="phone_number" name="phone_number" value="{{Auth::user()->phone}}" required>
                        <a onclick="generate_request_code()">
                            <span class="text-primary" style="margin-top:.25rem;font-size: 80%;">Click here to request a new code</span>
                        </a>
                        <br>
                        @if(Session::has('status'))
                           <div class="alert alert-success rounded-0 mt-3"> {{Session::pull('status')}}</div>
                        @endif
                        @if(Session::has('error'))
                           <div class="alert alert-danger rounded-0 mt-3"> {{Session::pull('error')}}</div>
                        @endif
                        <br>
                        <label  for="verification_code">Verification Code</label>
                        <input class="form-control rounded-0 @error('verification_code') is-invalid @enderror" type="number" name="verification_code" id="verification_code" placeholder="------" value="{{old('verification_code')}}" required>
                        @error('verification_code')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        <button class="btn btn-primary rounded-0">Verify</button>
                     </form>
                  </div>
                  @else
                  <div class="col-l1 p-3">
                     <div class="alert alert-success rounded-0"> No Action required. Your mobile number {{Auth::user()->phone}} is verified.</div>
                  </div>
                  @endif
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
                document.getElementById("request-code-form").submit();

            } else {
                alert(response);
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
   </body>
</html>
