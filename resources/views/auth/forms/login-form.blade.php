<form method="POST" action="{{ route('login') }}" id="login_form" onsubmit="toggle_animation(true);">
   @csrf
   <div class="form-group row">
      <div class="col-md-12 p-3">
         <label for="email">Email</label>
         <input id="email" type="email" class="@error('email') is-invalid @enderror form-control text " style="border-radiuss:20px!important;" name="email" value="{{ old('email') }}" required  placeholder="Email" >
         @error('email')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 p-3">
         <label for="password">Password</label>
         <input id="password" type="password" class="@error('password') is-invalid @enderror form-control text " style="border-radiuss:20px!important;" name="password" required placeholder="Password" >
         @error('password')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 text-left p-3">
         <button class="btn theme-background-color fs--1 text-white" styles="border-top-left-radius:20px;border-bottom-left-radius:20px;padding-left:10px;padding-top:15px;padding-bottom:15px;"><i class="fas fa-lock"></i> Login </button>
         <br><br>
         <a href="{{route('password.request')}}" class="text-decoration-none theme-color" onclick="toggle_animation(true);"> Forgot Password</a>
         <br>
         <span class="text-dark">Don't have an account?</span>   
         <a class="theme-color" style="cursor:pointer" data-toggle="modal" data-target="#exampleModalCenter">
         Sign up
         </a>
      </div>
      </span>
   </div>
</form>