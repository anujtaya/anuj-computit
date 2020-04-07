
<div class="row m-2">
   <div class="col-12 fs--1 p-2 ">
     <form method="POST" action="{{ route('app_user_update_password_information')}}" onsubmit="toggle_animation(true);">
      @csrf
      <div class="form-group">
         <label for="exampleInputEmail1">Password</label>
         <input type="password" class="form-control form-control-sm @error('password') border border-danger is-invald  @enderror"  id="password_input" name="password" autocomplete="off">
         @error('password')
         <span class="invalid-feedback text-danger" style="display:block;" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Confirm Password</label>
         <input type="password" class="form-control form-control-sm"  id="password_confirm" name="password_confirmation" value="">
      </div>
      <div class="form-group">
         <button class="btn theme-background-color btn-sm fs--1 font-weight-normal card-1">Save Changes</button>
      </div>
    </form>
   </div>
</div>
