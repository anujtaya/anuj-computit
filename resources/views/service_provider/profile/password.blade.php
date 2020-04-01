
<div class="row m-2">
   <div class="col-12 fs--1 p-2 ">
     <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <div class="form-group">
         <label for="for_password_change">Password</label>
         <input type="password" class="form-control form-control-sm"  id="for_password_change" value="">
      </div>
      <div class="form-group">
         <label for="for_confirm_password_change">Confirm Password</label>
         <input type="password" class="form-control form-control-sm"  id="for_confirm_password_change" value="">
      </div>
      <div class="form-group">
         <button class="btn theme-background-color btn-sm fs--1 font-weight-normal">Save Changes</button>
      </div>
    </form>
   </div>
</div>
