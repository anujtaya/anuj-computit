@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card">
            <div class="card-header">
               <a class="navbar-brand" href="{{route('guest_home')}}">{{config('app.short_name')}}</a>
               <br>
               {{ __('Login') }}
            </div>
            <div class="card-body border-top border-bottom">
               <form method="POST" action="{{ route('login') }}" id="login_form">
                  @csrf
                  <div class="form-group row">
                     <label for="email" class="col-md-4 col-form-label fs--1 text-md-right">{{ __('E-Mail Address') }}</label>
                     <div class="col-md-6">
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-md-4 col-form-label fs--1 text-md-right">{{ __('Password') }}</label>
                     <div class="col-md-6">
                        <input id="password" type="password" class="form-control form-control-sm  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                           <label class="form-check-label" for="remember">
                           {{ __('Remember Me') }}
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row mb-0">
                     <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-falcon-primary shadow-none border btn-sm mr-1 mb-1" id="login_btn" onclick='main_btn_status(this.id);$("#login_form").submit();'>
                        {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                        <a class="btn btn-falcon-link btn-sm shadow-none border mr-1 mb-1" href="{{ route('password.request') }}" id="forgot_password_btn" onclick='main_btn_status(this.id)'>
                        {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                        <br>
                        <br>
                     </div>
                  </div>
               </form>
               <!-- <div class="dropdown-divider"></div> -->
               <a class="btn btn-falcon-primary shadow-none border btn-sm mr-1 mb-1" href="{{ route('register') }}" id="register_btn" onclick='main_btn_status(this.id)'>
               <i class="fas fa-plus"></i> {{ __('Create an account') }}
               </a>
               <a class="btn btn-falcon-primary shadow-none border btn-sm mr-1 mb-1" href="{{ route('guest_home') }}" id="home_btn" onclick='main_btn_status(this.id)'>
               <i class="fas fa-home"></i> {{ __('Home') }}
               </a>
               <a class="btn btn-falcon-primary shadow-none border btn-sm mr-1 mb-1" href="mailto:tayaanuj@gmail.com" id="contact_us_btn" onclick='main_btn_status(this.id)'>
               <i class="fas fa-envelope"></i> {{ __('Contact Us') }}
               </a>
            </div>
            <div class="card-footer">
               <p class="mb-0 text-600 fs--1"></span><br class="d-sm-none"> ©{{date('Y')}}  {{config('app.short_name')}} </p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
