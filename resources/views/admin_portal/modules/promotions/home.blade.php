@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Promotions - Home</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-6 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            Promotions - Home
         </div>
         <div class="card-body">
               <form action="{{route('app_portal_admin_promotion_create')}}" method="POST">
                  @csrf
                  <div class="form-group">
                     <label  class="font-weight-bold" for="code">Code</label> <br>
                     <input name="code" class="form-control form-control-sm" type="text" value="{{old('code')}}" required>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="value">Value</label> <br>
                     <input name="value" class="form-control form-control-sm" type="number" value="{{old('value')}}" required>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="expires_on">Expires On</label> <br>
                     <input name="expires_on" class="form-control form-control-sm" type="datetime-local" value="{{old('expires_on')}}" required>
                  </div>
                  <div class="form-group">
                     <label  class="font-weight-bold" for="type">Type</label> <br>
                     <select  class="form-control form-control-sm @error('type') is-invalid @enderror" name="type" id="type" required>
                        <option value="FIXED">Fixed Discount</option>
                        <option value="PERCENTAGE">Percentage Discount</option>
                     </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Create Promotion</button>
               </form>
         </div>
      </div>
   </div>
   <div class="col-lg-12 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Promotions
         </div>
         <div class="card-body">
            <table class="table table-bordered table-sm">
               <thead class="bg-light">
                  <th>Id</th>
                  <th>Code</th>
                  <th>Value</th>
                  <th>Expires On</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
               </thead>
               <tbody>
                  @foreach($promotions as $promotion)
                  <tr>
                     <td>{{$promotion->id}}</td>
                     <td>{{$promotion->code}}</td>
                     <td>{{$promotion->value}}</td>
                     <td>
                        @if(Carbon\Carbon::parse($promotion->expires_on)->isPast()) 
                           <span class="text-danger">{{date('d/m/Y h:ia', strtotime($promotion->expires_on))}}</span>
                        @else 
                           <span class="text-success">{{date('d/m/Y h:ia', strtotime($promotion->expires_on))}}</span>
                        @endif
                     </td>
                     <td>
                        @if($promotion->status == 'ENABLED')   
                           <span class="badge badge-success">{{$promotion->status}}</span>
                        @else
                           <span class="badge badge-danger">{{$promotion->status}}</span>
                        @endif
                    </td>
                     <td>{{$promotion->type}}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($promotion->created_at)) }}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($promotion->updated_at)) }}</td>
                     <td><a href="{{route('app_portal_admin_promotion_edit', $promotion->id)}}">Edit</a></td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection