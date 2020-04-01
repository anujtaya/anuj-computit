@extends('layouts.service_provider_master')
@section('content')
<div class="container mt-2">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-3 shadow-none">
                  <div class="d-flex bd-highlight mb-1">
                     <div class="p-1 theme-color bd-highlight">  
                        <span class="fs--">Step 3 of 4</span> 
                     </div>
                     <div class="p-1 ml-auto bd-highlight">
                        <a href="{{route('service_provider_register_langauges')}}"  class="font-weight-bolder theme-color" onclick="toggle_animation(true);"> Next</a>
                     </div>
                  </div>
                  @include('service_provider.certificate.add_form')
                  <div class=" mb-2 text-centers">
                        <h1 class="fs-1">Your Certificates</h1>
                     </div>
                  <ul class="list-group fs--1">
                     @foreach($certificates as $certificate)
                     <li class="list-group-item">               
                        <div class="d-flex bd-highlight">
                           <div class="p-1 flex-grow-1 bd-highlight"> {{$certificate->certificate_name}}</div>
                           <div class="p-1 bd-highlight">{{ date('d/m/Y', strtotime($certificate->certificate_expiry)) }}</div>
                           <div class="p-1 bd-highlight"> <a href="{{route('service_provider_delete_certificate', $certificate->id)}}" onclick="toggle_animation(true);" class="text-decoration-none text-danger">Remove</a> </div>
                        </div>      
                     </li>   
                     @endforeach
                  </ul>         
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="progress fixed-top rounded-0" style="height: 10px;">
  <div class="progress-bar  theme-background-color" role="progressbar" style="width:35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
    $(".progress-bar").animate({
    width: "80%"
}, 100);
</script>
@endsection
