@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
               
                <div class="card-header">
               <a class="navbar-brand" href="{{route('guest_home')}}">{{config('app.short_name')}}</a>
               <br>
               {{ __('Verify Your Email Address') }}
            </div>
                <div class="card-body fs--1 border-top border-bottom">
                    @if (session('resent'))
                        <div class="alert alert-success fs--1" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <i class="fas fa-hand-paper fs-5 text-warning"></i>
                    <br>
                    <br>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-link p-0 m-0 align-baseline fs--1">{{ __('click here to request another') }}</button>.
	                </form>
                    <div class="dropdown-divider"></div>
               <p class="font-weight-normal fs--1 ">Always choose your password carefully. Do not share your password with anyone.</p>
               <a class="btn btn-falcon-primary btn-sm mr-1 mb-1" href="{{ route('login') }}" id="login_btn" onclick='main_btn_status(this.id)'>
               <i class="fas fa-user-lock"></i> {{ __('Login') }}
               </a>
               <a class="btn btn-falcon-primary btn-sm mr-1 mb-1" href="{{ route('guest_home') }}" id="home_btn" onclick='main_btn_status(this.id)'>
               <i class="fas fa-home"></i> {{ __('Home') }}
               </a>
               <a class="btn btn-falcon-primary btn-sm mr-1 mb-1" href="{{ route('guest_home') }}" id="contact_us_btn" onclick='main_btn_status(this.id)'>
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
