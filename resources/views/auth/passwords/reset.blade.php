@extends('layouts.app')
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
      <div class="col-lg-4   col-md-12 p-0" style="">
         <div class="p-4  theme-color rounded  m-4" style="border-radisus:55px; margin-top: 0px;">
            <div class="mb-4 text-dark fs-1">Reset Password</div>
            @if (session('status'))
            <div class="alert alert-success fs--1" role="alert">
               {{ session('status') }} 
            </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
               @csrf
               <input type="hidden" name="token" value="{{ $token }}">
               <div class="form-group">
                  <label for="email" class="">{{ __('E-Mail Address') }}</label>
                  <div class="">
                     <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group ">
                  <label for="password" >{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="password-confirm">{{ __('Confirm Password') }}</label>
                  <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
               </div>
               <div class="form-group row mb-0">
                  <button type="submit" class="btn theme-background-color btn-sm fs--1 text-white custom_button_shadow m-3 mb-1">
                  {{ __('Done') }}
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection