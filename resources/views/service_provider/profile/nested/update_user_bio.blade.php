@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-3">
               <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a>
            </div>
            <div class="col-6 font-size-bolder text-center font-weight-bold theme-color">
                About You
            </div>
            <div class="col-3 text-right">
                <a href="{{route('service_provider_profile_nested')}}" class="theme-color font-weight-bold" onclick="toggle_animation(true);">Next</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-3">
            <div class="alert alert-info  fs--1">
                When you sign up as a Service Provider remember to tell us a little bit about yourself in the ‘About Me’ section.
                This information can include your qualifications and anything that you think will help a Service Seeker to select you.
                <p class="fs--1 mt-2">Please do not disclose personal information, e.g., Phone Number, Email, Full Name or Banking details.</p>
            </div>
           
            @if(Session::has('status'))
            <div class="alert alert-success fs--1">{{Session::pull('status')}}</div>
            @endif
            <form id="aboutMeForm" action="{{route('service_provider_profile_update_user_bio')}}" files="false" method="post" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="form-group">
                    <textarea class="form-control" type="text" name="user_bio" id="about_me_input" placeholder="Tell us about you...." rows="10">{{Auth::user()->user_bio}}</textarea>
                </div>
                <p class="fs--2">
                    Max character 2000. <span id="total_char_count"></span>
                </p>
            </form>
            <button class="btn btn-sm theme-background-color card-1 border-0" onclick="validate_reg();" id="about_me_submit">Submit</button>
        </div>
   </div>
</div>
<script>
   function validate_reg(){
          if($('#aboutMeForm')[0].checkValidity()){
             toggle_animation(true, "Updating your account..");
             document.getElementById('aboutMeForm').submit();      
          }
         else {
             toggle_animation(false);      
         }
     }
   
   $(document).ready(function(){
       $('#about_me_submit').attr('disabled',true);
         
   });
   
   $('#about_me_input').keyup(function(){
      if($(this).val().length < 4 || $(this).val().length >2000 )
               $('#about_me_submit').attr('disabled', true);
          else
               $('#about_me_submit').attr('disabled',false);
            countCharater();
         });
   function countCharater(){
       let a = $("#about_me_input").val().length.toString();
        $('#total_char_count').html('Current Count: ' + a);
   }
</script>
@endsection