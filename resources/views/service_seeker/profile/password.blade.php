
<div class="row m-2">
   <div class="col-12 fs--1 p-2 ">
     <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <div class="form-group">
         <label for="exampleInputEmail1">Password</label>
         <input type="password" class="form-control form-control-sm"  id="service_job_title" value="">
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Confirm Password</label>
         <input type="password" class="form-control form-control-sm"  id="service_job_title" value="">
      </div>
      <div class="form-group">
         <button class="btn btn-info btn-sm fs--1 font-weight-normal">Save Changes</button>
      </div>
    </form>
   </div>
</div>
