@extends('layouts.service_provider_master')
@section('content')
@push('header-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('header-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endpush
<div class="container mt-2">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-3 shadow-none">
                  <div class="d-flex bd-highlight mb-1">
                     <div class="p-1 theme-color bd-highlight">  
                        <span class="fs--">Step 4 of 4</span> 
                     </div>
                     <div class="p-1 ml-auto bd-highlight">
                        <a href="{{route('service_provider_register_completed')}}"  class="font-weight-bolder theme-color" onclick="toggle_animation(true);"> Finish</a>
                     </div>
                  </div> 
                  <div class="mt-2 text-centers">
                     <h1 class="fs-1">Select your language skills</h1>
                     <p class="fs--1">Other than English, select which language you are most fluent in.</p>
                  </div>

                  <div class="p-0">
                     @include('service_provider.language.add_form')
                     <div class=" mb-2 text-centers">
                        <h1 class="fs-1">Saved Languages</h1>
                     </div>
                     <ul class="list-group fs--1">
                        @foreach($current_languages as $language)
                        <li class="list-group-item">               
                           <div class="d-flex bd-highlight">
                              <div class="p-1 flex-grow-1 bd-highlight"> {{$language->language_name}}</div>
                              <div class="p-1 bd-highlight"> <a href="{{route('service_provider_delete_language', $language->id)}}" onclick="toggle_animation(true);" class="text-decoration-none text-danger">Remove</a> </div>
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
</div>

<div class="progress fixed-top rounded-0" style="height: 10px;">
  <div class="progress-bar  theme-background-color" role="progressbar" style="width:80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
    $(".progress-bar").animate({
    width: "95%"
}, 100);

$(document).ready(function() { $("#language-select").select2(); });

</script>
@endsection
