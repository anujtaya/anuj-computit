@extends('layouts.service_provider_master')
@section('content')
<style>
   .timeline-item {
   background: #fff;
   border: 1px solid;
   border-color: #e5e6e9 #dfe0e4 #d0d1d5;
   border-radius: 3px;
   padding: 12px;
   margin: 0 auto;
   max-width: 472px;
   min-height: 200px;
   }
   @keyframes placeHolderShimmer{
   0%{
   background-position: -468px 0
   }
   100%{
   background-position: 468px 0
   }
   }
   .animated-background {
   animation-duration: 1s;
   animation-fill-mode: forwards;
   animation-iteration-count: infinite;
   animation-name: placeHolderShimmer;
   animation-timing-function: linear;
   background: #f6f7f8;
   background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
   background-size: 800px 104px;
   height: 96px;
   position: relative;
   }
   .background-masker {
   background: #fff;
   position: absolute;
   }
   /* Every thing below this is just positioning */
   .background-masker.header-top,
   .background-masker.header-bottom,
   .background-masker.subheader-bottom {
   top: 0;
   left: 40px;
   right: 0;
   height: 10px;
   }
   .background-masker.header-left,
   .background-masker.subheader-left,
   .background-masker.header-right,
   .background-masker.subheader-right {
   top: 10px;
   left: 40px;
   height: 8px;
   width: 10px;
   }
   .background-masker.header-bottom {
   top: 18px;
   height: 6px;
   }
   .background-masker.subheader-left,
   .background-masker.subheader-right {
   top: 24px;
   height: 6px;
   }
   .background-masker.header-right,
   .background-masker.subheader-right {
   width: auto;
   left: 300px;
   right: 0;
   }
   .background-masker.subheader-right {
   left: 230px;
   }
   .background-masker.subheader-bottom {
   top: 30px;
   height: 10px;
   }
   .background-masker.content-top,
   .background-masker.content-second-line,
   .background-masker.content-third-line,
   .background-masker.content-second-end,
   .background-masker.content-third-end,
   .background-masker.content-first-end {
   top: 40px;
   left: 0;
   right: 0;
   height: 6px;
   }
   .background-masker.content-top {
   height:20px;
   }
   .background-masker.content-first-end,
   .background-masker.content-second-end,
   .background-masker.content-third-end{
   width: auto;
   left: 380px;
   right: 0;
   top: 60px;
   height: 8px;
   }
   .background-masker.content-second-line  {
   top: 68px;
   }
   .background-masker.content-second-end {
   left: 420px;
   top: 74px;
   }
   .background-masker.content-third-line {
   top: 82px;
   }
   .background-masker.content-third-end {
   left: 300px;
   top: 88px;
   }
   .progress.active .progress-bar {
   -webkit-transition: none !important;
   transition: none !important;
   }
</style>
<div class="container mt-2">
   <div class="row  justify-content-center" >
      <div class="col-lg-4  ">
         <div class="row   " >
            <div class="col-md-12 h-100  " >
               <div class="card bg-white p-3 shadow-none">
                  <div class="d-flex bd-highlight mb-1">
                     <div class="p-1 theme-color bd-highlight">  
                        <span class="fs--">Step 2 of 4</span> 
                     </div>
                     <div class="p-1 ml-auto bd-highlight">
                        <a href="{{route('service_provider_register_certificate')}}"  class="font-weight-bolder theme-color" onclick="toggle_animation(true);"> Next</a>
                     </div>
                  </div>
                  <div class="mt-2 text-centers">
                     <h1 class="fs-1">Add Your Services</h1>
                     <p>
                        In order for us to filter your best search results please fill out the work you would like to complete on this app.
                     </p>
                  </div>
                  <div class="input-group mt-2 mb-3">
                     <input type="text" class="form-control p-4 fs--1" id="user_search_input" onKeyUp="populate_services();" placeholder="Enter keywords to search categories.." value="" aria-label="Username" aria-describedby="basic-addon1" >
                     <div class="input-group-append   fs--1">
                        <span class="input-group-text bg-white " id="basic-addon1"><i class="fas text-muted  fs--1 fa-search"></i></span>
                     </div>
                  </div>
                  <!-- <li class="list-group-item">Cleaning     <button onclick="alert('item added')" class="float-right btn btn-sm fs--2 text-success"><i class="fas fa-plus"></i></button>  </li>
                     <li class="list-group-item">Cleaning     <button onclick="alert('item added')" class="float-right btn btn-sm fs--2 text-danger"><i class="fas fa-minus"></i></button>  </li> -->
                  <ul class="list-group fs--1" id="service_list_display">
                     <div class="timeline-wrapper">
                        <div class="timeline-item">
                           <div class="animated-background">
                              <div class="background-masker header-top"></div>
                              <div class="background-masker header-left"></div>
                              <div class="background-masker header-right"></div>
                              <div class="background-masker header-bottom"></div>
                              <div class="background-masker subheader-left"></div>
                              <div class="background-masker subheader-right"></div>
                              <div class="background-masker subheader-bottom"></div>
                              <div class="background-masker content-top"></div>
                              <div class="background-masker content-first-end"></div>
                              <div class="background-masker content-second-line"></div>
                              <div class="background-masker content-second-end"></div>
                              <div class="background-masker content-third-line"></div>
                              <div class="background-masker content-third-end"></div>
                           </div>
                        </div>
                     </div>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var services_fetch_url = "{{route('service_subcription_services_fetch_active')}}"
   var services_add_url = "{{route('service_subcription_services_add')}}"
   var services_remove_url = "{{route('service_subcription_services_remove')}}"
   // var temp_loader_content = '<div class="timeline-wrapper"> <div class="timeline-item"><div class="animated-background"> <div class="background-masker header-top"></div>            <div class="background-masker header-left"></div>            <div class="background-masker header-right"></div>            <div class="background-masker header-bottom"></div>            <div class="background-masker subheader-left"></div>            <div class="background-masker subheader-right"></div>            <div class="background-masker subheader-bottom"></div>            <div class="background-masker content-top"></div>            <div class="background-masker content-first-end"></div>            <div class="background-masker content-second-line"></div>            <div class="background-masker content-second-end"></div>            <div class="background-masker content-third-line"></div>            <div class="background-masker content-third-end"></div>        </div>    </div></div>'
   
   var CSRF_TOKEN = "{{csrf_token()}}"
   window.onload = function() {
       populate_services();
   }
   function populate_services(){
       var search_term = $('#user_search_input').val();
       var element = document.getElementById("service_list_display");
       //element.innerHTML = temp_loader_content;
       $.ajax({
           url: services_fetch_url,
           type: 'POST',
           data: {_token: CSRF_TOKEN, search:search_term},
           dataType: 'JSON',
           success: function (data) { 
               console.log(data);
               display_updated_service_list(data)
           }
       }); 
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
                   this.classList.remove("theme-color");
                   this.innerHTML = "<i class='fas fs-1 fa-square'></i>";       
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
   
           li.innerHTML += '<br> <span class="fs--2 text-muted"> ' + data['services'][i]['service_name'] + '</span>'
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
                   populate_services();
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
                   populate_services();
               }else if(data =='2'){
                   console.log('Service Already Added.')
               }
           }
       }); 
   }
   
</script>
<div class="progress fixed-top rounded-0" style="height: 10px;">
   <div class="progress-bar  theme-background-color" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<script>
   $(".progress-bar").animate({
   width: "35%"
   }, 100);
</script>
@endsection