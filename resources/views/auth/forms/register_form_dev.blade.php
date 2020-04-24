<form method="POST" action="{{ route('guest_register_user') }}" onsubmit="toggle_animation(true);">
   @csrf
   <div class="form-group mt-3 row">
      <div class="col-md-12 mb-2 text-canter">
         <h1 class="fs-1">Start Connecting with your Locals</h1>
      </div>
      <div class="col-md-12 mb-3">
         <label for="first">First Name</label>
         <input id="first" type="text" class="form-control form-control-sm  @error('first') is-invalid @enderror" name="first" value="Anuj" required autocomplete="first" placeholder="" autofocus>
         @error('first')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="last">Last Name</label>
         <input id="first" type="text" class="form-control form-control-sm  @error('last') is-invalid @enderror" name="last" value="Taya" required autocomplete="last" placeholder="" autofocus>
         @error('last')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="email">Email</label>
         <input id="email" type="email" class="form-control form-control-sm  @error('email') is-invalid @enderror" name="email" value="john{{ rand(20,50)}}doe@gmail.com" required autocomplete="email" placeholder="" autofocus>
         @error('email')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="phone">Mobile No.</label>
         <div class="input-group mb-3">
            <div class="input-group-prepend ">
               <span class="input-group-text fs--1 form-control-sm text-muted" style="padding:0.86rem 1rem!important;" id="basic-addon1">+61</span>
            </div>
            <input id="phone" type="tel" class="form-control  form-control-sm @error('phone') is-invalid @enderror" style="border-top-left-radius:0px!important;border-bottom-left-radius:0px!important;" name="phone" value="0452610116" required autocomplete="phone" placeholder="" autofocus>
         </div>
         @error('phone')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="password">Password</label>
         <input id="password" type="password" class="form-control  form-control-sm @error('password') is-invalid @enderror" name="password" value="12346578" required autocomplete="password" placeholder="" autofocus>
         @error('password')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="password_confirmation">Confirm Password</label>
         <input id="password_confirmation" type="password" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="12346578" required autocomplete="password" placeholder="" autofocus>
      </div>
      <div class="col-md-12 text-centerw mb-0">
         <p class="text-centerw fs--1">By signing up, I agree to Local2local Terms and Conditions</p>
         <button type="submit" class="btn  theme-background-color fs--1 text-white  font-weight-normal mt-2" width="221px" height="47px" id="" onclick='main_btn_status(this.id);$("#login_form").submit();'>
         {{ __('Continue') }}
         </button>
         <a  class="btn btn-secondary fs--1 text-white font-weight-normal mt-2" width="221px" height="47px" href="{{route('login')}}" onclick="toggle_animation(true);"> Cancel</a>
      </div>
   </div>
</form>