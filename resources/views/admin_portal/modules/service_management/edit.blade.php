@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Service Managment')
@section('content')
<div class="row m-2">
<div class="col-lg-6  p-3">
      <div class="card rounded-0  h-100 bg-white">
         <div class="card-header">
            Add major category
         </div>
         <div class="card-body">
            <form form action="{{route('app_portal_admin_add_category')}}"  method="post" enctype="multipart/form-data">
               <br style="clear:both">
               {{csrf_field()}}
               <p>Enter a major category name:</p>
               <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Example - Bike repairs" required>
               </div>
               <button type="submit"  class="btn btn-sm btn-success" data-loading-text="<i class='fa fa-cog fa-spin'></i> Please Wait....">Submit</button>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-6  p-3">
      <div class="card rounded-0  h-100 bg-white">
         <div class="card-header">
            Add Minor Category
         </div>
         <div class="card-body">
            <form  action="{{route('app_portal_admin_add_sub_category')}}"  method="post" enctype="multipart/form-data">
               <p class="w3-margin-top">Select a major-category.</p>
               {{csrf_field()}}
               <select class="form-control form-control-sm" name="majorCat" required >
                  <option class ="" value="" disabled selected>Select Main Category</option>
                  @foreach($major_categories as $serve)
                  <option value="{{$serve->id}}">{{$serve->service_name}}</option>
                  @endforeach
               </select>
               <p class="w3-margin-top">Enter a minor category name:</p>
               <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="minor_name" name="minor_name" placeholder="Example - electrical heater fitting" required>
               </div>
               <button type="submit"  class="btn btn-sm btn-success" data-loading-text="<i class='fa fa-cog fa-spin'></i> Please Wait....">Submit</button>
            </form>
         </div>
      </div>
   </div>
   <!-- service category editor -->
   <div class="col-lg-12  p-3">
      <div class="card rounded-0  h-100 bg-white rounded-0 ">
         <div class="card-header">
            Manage Service Categories
         </div>
         <div class="card-body p-0">
            @include('admin_portal.modules.service_management.editor')
         </div>
      </div>
   </div>
   <!-- end service category editor -->

</div>
@endsection