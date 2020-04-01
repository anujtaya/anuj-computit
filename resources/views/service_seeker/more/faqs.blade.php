@extends('layouts.service_seeker_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">   <a href="{{route('service_seeker_more')}}" onclick="toggle_animation(true);">  <i class="fas theme-color fa-arrow-left fs-1"></i></a> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">FAQ's <br><span class="fs--2 text-muted font-weight-normal"></span></div>
         </div>
      </div>
      <div class="col-lg-12 fs--1 bg-white p-1 mt-2  border-d">
         <div class="accordion" id="accordionExample">
            <div class="card shadow-none mb-2">
               <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                     <button class="btn btn-sm fs--1 theme-color" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     1.  Who is a Service Seeker?
                     </button>
                  </h2>
               </div>
               <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="pl-4 pr-4 m-1 pt-0">
                     A person who post a job and is actively looking for service providers to get the work done.
                  </div>
               </div>
            </div>
            <div class="card shadow-none mb-2">
               <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                     <button class="btn btn-sm fs--1 theme-color collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     2.  Who is a Service Provider?
                     </button>
                  </h2>
               </div>
               <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="pl-4 pr-4 m-1 pt-0">
                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
               </div>
            </div>
            <div class="card shadow-none mb-2">
               <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                     <button class="btn btn-sm fs--1 theme-color collapsed"type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     3.  What is LocaL2LocaL?
                     </button>
                  </h2>
               </div>
               <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="pl-4 pr-4 m-1 pt-0">
                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection