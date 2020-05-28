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
                       <span class="fs--">Step 1 of 4</span> 
                     </div>
                     <div class="p-1 ml-auto bd-highlight">
                        <a href="#" onclick="$('#business_info_form').submit();"  class="font-weight-bolder theme-color" onclick="toggle_animation(true);"> Next</a>
                     </div>
                  </div>
                  <div class="p-1">
                     @if(isset($current_business_info->id))
                        @include('service_provider.business.add_form_with_info')
                     @else 
                        @include('service_provider.business.add_form')
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="progress fixed-top rounded-0" style="height: 10px;">
  <div class="progress-bar  theme-background-color" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
    $(".progress-bar").animate({
    width: "5%"
}, 100);
</script>
@endsection
