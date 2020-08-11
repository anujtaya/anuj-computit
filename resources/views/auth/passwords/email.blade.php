@extends('layouts.app')
@section('content')
<div class="container text-white mt-0 p-0">
   <div class="row justify-content-center" >
      <div class="col-lg-12  sticky-top bg-white p-0">
         <div class="row ml-4 mt-4">
            <div class="col-4 pl-4"><a href="{{route('login')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a> </div>
         </div>
      </div>
      <div class="col-lg-4    col-md-12 p-0" style="">
         <div class="p-4  theme-color rounded  m-4" style="border-radisus:55px; margin-top: 0px;">
            <div class="mb-4 text-dark fs-1">Forgot Password</div>
            <img src="{{asset('/images/svg/l2l_verification_image.svg')}}" class="img-fluid mb-4"  alt="LocaL2LocaL - Getting Started SVG Image">

            @if (session('status'))
            <div class="alert alert-success fs--1" role="alert">
               {{ session('status') }} 
            </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" onsubmit="toggle_animation(true);">
               @csrf
               <div class="form-group">
                  <label for="email" class="" style="color:#686464!important;">{{ __('Enter email address associated with your account') }}</label>
                  <div class="">
                     <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-0">
                  <button type="submit" class="btn theme-background-color btn-sm fs--1 text-white ml-3 custom_button_shadow mb-1">
                     <i class="fas fa-paper-plane"></i> {{ __('Done') }}
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection