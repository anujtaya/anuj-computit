@extends('layouts.app')
@section('content')
<style></style>
<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-4">
         <div class="row" >
            <div class="col-md-12 h-100" >
               <div class="card bg-white p-4 shadow-none">
                  @if(app()->isLocal())
                     @include('auth.forms.register_form_dev')
                  @else
                     @include('auth.forms.register_form')
                  @endif
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
    width: "10%"
}, 100);
</script>
@endsection
