@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Marketing - Home</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            Marketing - Home - Actions
         </div>
         <div class="card-body">
            <form action="{{route('app_portal_admin_marketing_generate_user_list')}}" method="post">
               @csrf
               <button class="btn btn-sm btn-primary">Generate User List CSV file for Marketing</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection