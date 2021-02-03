<style>
   .switch {
   display: inline-block;
   height: 28px!important;
   position: relative;
   width: 55px!important;
   }
   .switch input {
   display:none;
   }
   .slider {
   background-color: #ccc;
   bottom: 0;
   cursor: pointer;
   left: 0;
   position: absolute;
   right: 0;
   top: 0;
   transition: .4s;
   }
   .slider:before {
   background-color: #fff;
   bottom: 4px;
   content: "";
   height: 20px;
   left: 4px;
   position: absolute;
   transition: .4s;
   width: 20px;
   }
   input:checked + .slider {
   background-color: #5d29ba7a!important;
   }
   input:checked + .slider:before {
   transform: translateX(26px);
   }
   .slider.round {
   border-radius: 34px;
   }
   .slider.round:before {
   border-radius: 50%;
   }
</style>

<form method="POST" action="{{ route('login') }}" id="login_form" onsubmit="toggle_animation(true);">
   @csrf
   <div class="form-group row">
      <div class="col-md-12 pl-3 pr-3 pb-2">
         <label for="email">Email</label>
         <input id="email" type="search" class="@error('email') is-invalid @enderror form-control text " style="border-radiuss:20px!important;" name="email" value="{{ old('email') }}" required  autocomplete="email" placeholder="Email" >
         @error('email')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 pl-3 pr-3 pb-2">
         <label for="password">Password</label>
         <input id="password" type="password" class="@error('password') is-invalid @enderror form-control text " style="border-radiuss:20px!important;" name="password" required placeholder="Password" >
         @error('password')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>


      <div class="col-lg-12 pl-3 pr-3 pb-2">
         <label for="remember">Remember me?</label>
         <br>
         <label class="switch" for="checkbox">
            <input type="checkbox" id="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <div class="slider round"></div>
         </label>
      </div>

      <div class="col-md-12 text-left pl-3 pr-3">
         <button class="btn theme-background-color fs--1 text-white custom_button_shadow" styles="border-top-left-radius:20px;border-bottom-left-radius:20px;padding-left:10px;padding-top:15px;padding-bottom:15px;">Login</button>
         <br><br>
         <a href="{{route('password.request')}}" class="text-decoration-none theme-color" onclick="toggle_animation(true);"> Forgot Password</a>
         <br>
         <span class="text-dark">Don't have an account?</span>   
         <a class="theme-color" style="cursor:pointer" href="{{route('app_register')}}" onclick="toggle_animation(true);">
            Sign Up
         </a>
         <br><br>
         <a class="theme-color text-decoration-none" href="{{route('guest_service_seeker_home')}}" onclick="toggle_animation(true);">Try our app in guest mode.</a>
      </div>
      </span>
   </div>
</form>