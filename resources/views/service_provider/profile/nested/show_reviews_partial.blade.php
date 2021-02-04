@extends('layouts.service_provider_master')
@section('content')
<style>
   .first-new-container{
   background-color:#F8F8F8;
   }
   .font-new-size{
   font-size:14px;
   font-weight:600;
   border-left-style: solid; 
   border-color:rgb(93, 41, 186);
   border-width:5px;
   padding-top: 20px;
   padding-bottom: 20px;
   padding-left: 5px;
   }
   .card-body-bgcolor-new{
   background-color:#FCFDFF!important;
   padding-left:10px;
   }
   .mb-2{
   margin-bottom: 0.7rem!important;
   }
</style>
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">   <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">All Reviews <br><span class="fs--2 text-muted font-weight-normal"></span></div>
         </div>
      </div>
      <div class="col-lg-12 fs--1 bg-white p-2 mt-2  border-d">
      @foreach($stats->rating_records->take(100) as $r)
         <div class="shadow-sm m-2 p-2">
            <div class="d-flex bd-highlight mb-2">
               <div class="p-1 bd-highlight">
                  {{$r->service_seeker_profile->first.' '.$r->service_seeker_profile->last}}
               </div>
               <div class="p-1 ml-auto bd-highlight">
                  @for($i=0;$i<intval($r->service_seeker_rating);$i++)
                  <i class="fas fa-star text-warning"></i> 
                  @endfor
               </div>
            </div>
            </span>
            <i class="text-muted">{{$r->service_seeker_comment}}</i>
            </span>
         </div>
         @endforeach   
      </div>
   </div>

@endsection