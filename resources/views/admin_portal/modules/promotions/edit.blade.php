@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="{{route('app_portal_admin_promotion_home')}}">Promotions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit: #{{$promotion->id}}</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            Promotion Edit: #{{$promotion->id}}
         </div>
         <div class="card-body">
               <form action="{{route('app_portal_admin_promotion_update')}}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{$promotion->id}}">
                  <div class="form-group">
                     <label  class="font-weight-bold" for="code">Code</label> <br>
                     <input name="code" class="form-control form-control-sm" type="text" value="{{$promotion->code}}" readonly>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="value">Value</label> <br>
                     <input name="value" class="form-control form-control-sm" type="number" value="{{$promotion->value}}" required>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="expires_on">Expires On</label> <br>
                     <input name="expires_on" class="form-control form-control-sm" type="datetime-local" value="{{\Carbon\Carbon::parse($promotion->expires_on)->format('Y-m-d\Th:m:s')}}" required>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="type">Type</label> <br>
                     <select  class="form-control form-control-sm @error('type') is-invalid @enderror" name="type" id="type" required>
                        <option value="FIXED" @if($promotion->type == 'FIXED') selected @endif>Fixed Discount</option>
                        <option value="PERCENTAGE" @if($promotion->type == 'PERCENTAGE') selected @endif>Percentage Discount</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="status">Status</label> <br>
                     <select  class="form-control form-control-sm @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="ENABLED" @if($promotion->status == 'ENABLED') selected @endif>ENABLED</option>
                        <option value="DISABLED" @if($promotion->status == 'DISABLED') selected @endif>DISABLED</option>
                     </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Update Promotion</button>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection