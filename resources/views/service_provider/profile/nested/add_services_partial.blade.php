@extends('layouts.service_provider_master')
@push('header-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('header-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endpush
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm  bg-white p-3 border-d">
         <div class="row">
            <div class="col-3">
               <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a>
            </div>
            <div class="col-6 font-size-bolder text-center font-weight-bold theme-color">
                Add Services
            </div>
            <div class="col-3 text-right">
                <a href="{{route('service_provider_profile_nested')}}" class="theme-color font-weight-bold" onclick="toggle_animation(true);">Next</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-3">
         <div class="input-group sticky-top mb-3">
            <div class="mb-2">Select a major service category from the dropdown list below.</div>
       
            <select class="form-control p-2" style="padding-left:8px;padding-right:8px;" name="user_select_input" id="user_select_input" onchange="user_major_service_selection_handler(this.value);">
                <option value="" disabled selected>Please Select a Main Category..</option>
                @foreach($service_categories as $service_categorie)
                <option value="{{$service_categorie->id}}">{{$service_categorie->service_name}}</option>
                @endforeach
            </select>
            </div>
            <ul class="list-group fs--1" id="service_list_display">
                <div class="text-center">
                    <img src="{{asset('images/svg/select-service.svg')}}" class="img-fluid" alt="Service Select Infographic">
                </div>
            </ul>
            <!-- <input type="text" class="form-control p-4 fs--1" id="user_search_input" onKeyUp="populate_services();" placeholder="Enter keywords to search categories.." value="" aria-label="Username" aria-describedby="basic-addon1" >
            <div class="input-group-append   fs--1">
               <span class="input-group-text bg-white " id="basic-addon1"><i class="fas text-muted  fs--1 fa-search"></i></span>
            </div> -->
         
        
      </div>
   </div>
</div>
<script>
   var services_fetch_url = "{{route('service_subcription_services_fetch_active')}}"
   var services_add_url = "{{route('service_subcription_services_add')}}"
   var services_remove_url = "{{route('service_subcription_services_remove')}}";
   var current_major_category_selection = null;
   //var temp_loader_content = '<div class="timeline-wrapper"> <div class="timeline-item"><div class="animated-background"> <div class="background-masker header-top"></div>            <div class="background-masker header-left"></div>            <div class="background-masker header-right"></div>            <div class="background-masker header-bottom"></div>            <div class="background-masker subheader-left"></div>            <div class="background-masker subheader-right"></div>            <div class="background-masker subheader-bottom"></div>            <div class="background-masker content-top"></div>            <div class="background-masker content-first-end"></div>            <div class="background-masker content-second-line"></div>            <div class="background-masker content-second-end"></div>            <div class="background-masker content-third-line"></div>            <div class="background-masker content-third-end"></div>        </div>    </div></div>'
   
   var CSRF_TOKEN = "{{csrf_token()}}"
   window.onload = function() {
       //populate_services();
   }



   $(document).ready(function() { $("#user_select_input").select2(); });

   function user_major_service_selection_handler(service_cat_id) {
        current_major_category_selection = service_cat_id;
        populate_services(current_major_category_selection);

   }
   function populate_services(a){
        if(a != null) {
            // var element = document.getElementById("service_list_display");
            // element.innerHTML = temp_loader_content;
            $.ajax({
                url: services_fetch_url,
                type: 'POST',
                data: {_token: CSRF_TOKEN, service_cat_id:a},
                dataType: 'JSON',
                success: function (data) { 
                    console.log(data);
                    display_updated_service_list(data)
                }
            }); 
        }
   }
   
   var user_current_services = null;

   
   function display_updated_service_list(data) {
       user_current_services = null;
       user_current_services = data['user_services'];
       var element = document.getElementById("service_list_display");
       element.innerHTML = "";
       for(var i=0;i<data['services'].length;i++) {
           var li = document.createElement('li')
           var btn = document.createElement('button')
           
   
           var response = check_existing_service(data['services'][i]['minor_cat_id']);
           if(response) {
                btn.innerHTML = "<i class='fas fs-1 fa-check-square'></i>";
                btn.classList = "float-right btn btn-sm fs--2 theme-color";
                btn.id="sid-"+ data['services'][i]['minor_cat_id'];
                btn.addEventListener("click", function() {
                    remove_service(this.id);
                    this.innerHTML = "<i class='fas fs-1 fa-square'></i>";    
                    this.classList.add("text-muted");
                    this.classList.remove("theme-color");
                });
           } else {
                btn.innerHTML = "<i class='far fs-1 fa-square'></i>";
                btn.classList = "float-right btn btn-sm fs--2 text-muted";
                btn.id="sid-"+ data['services'][i]['minor_cat_id'];
                btn.addEventListener("click", function() {
                    add_service(this.id);
                    this.classList.add("theme-color");
                    this.innerHTML = "<i class='fas fs-1 fa-check-square'></i>";
                });
           }
         
           li.classList = "list-group-item mb-1"
           li.innerHTML = data['services'][i]['service_minor_name'];
           //li.innerHTML += '<br> <span class="fs--2 text-muted"> ' + data['services'][i]['service_name'] + '</span>'
           li.appendChild(btn);
           element.appendChild(li)
       }
   }
   
   function check_existing_service(temp_id){
       var resposne = false;
       for(var i=0; i<user_current_services.length; i++) {
          
              if(user_current_services[i]['service_cat_id'] === temp_id ) {
               resposne = true;
                  break;
              }
       }
       return resposne;
   }
   
   
   function add_service(service_id){
       $.ajax({
           url: services_add_url,
           type: 'POST',
           data: {_token: CSRF_TOKEN, service_id:service_id.substring(4)},
           dataType: 'JSON',
           success: function (data) { 
               if(data == true) {
                   populate_services(current_major_category_selection);
               } else if(data == 2){
                   console.log('Service Already Added.')
               }
           }
       }); 
   }
   
   function remove_service(service_id){
       $.ajax({
           url: services_remove_url,
           type: 'POST',
           data: {_token: CSRF_TOKEN, service_id:service_id.substring(4)},
           dataType: 'JSON',
           success: function (data) { 
               if(data == true) {
                   populate_services(current_major_category_selection);
               }else if(data =='2'){
                   console.log('Service Already Added.')
               }
           }
       }); 
   }
   
</script>
@endsection