@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Data Import/Export')
@section('content')
<div class="row m-2  ">
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header ">
            Import Users
         </div>
         <div class="card-body">
            <form action="{{route('app_portal_admin_data_import_users')}}" method="POST">
                  @csrf
                  <div class="form-group col-md-12">
                     <button type="submit" class="btn btn-primary btn-sm mt-3 rounded-0">Upload Users</button>
                  </div>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection
