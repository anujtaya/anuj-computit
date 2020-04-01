@extends('layouts.app')
@section('content')
<div class="container fs--1 p-4">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" />
   </form>
   <br />
   <!-- <span id="uploaded_image"></span> -->
   <div >
      <button class="btn m-1 theme-background-color shadow-sm card-2  btn-sm" id="trigger_image"><i class="fas fa-upload"></i> Upload </button>
      <div class="row  m-1 text-center" id="image-container">
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title fs-1" id="imagePreviewCenterModalTitle">Image Preview</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body p-2">
            <div class="m-2">
               <div id="carouselExampleIndicators" class="carousel slide" style="min-height:500px!important;" data-ride="carousel">
                  <div class="carousel-inner" id="model-container">
                  </div>
               </div>
            </div>
            <div class="d-flex bd-highlight m-1">
               <div class="p-2 bd-highlight">
                  <a class="" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <i class="fas fa-arrow-left fs-1"></i>      
                  </a>
               </div>
               <div class="ml-auto p-2 bd-highlight">
                  <a class="" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <i class="fas fa-arrow-right fs-1"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function(){
     load_images(1);
     $('#upload_form').on('submit', function(event){
         event.preventDefault();
         $.ajax({
               url:"{{ route('demo_image_upload') }}",
               method:"POST",
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               {
                 console.log(data);
                 $('#message').css('display', 'block');
                 $('#message').html(data.message);
                 $('#message').addClass(data.class_name);
                 // $('#uploaded_image').html(data.uploaded_image);
                 if(data.uploaded_image != "") {
                   load_images(1);
                 }
               }
         })
     });
   });
      
   function display_image_model(id) {
      var children = document.getElementById("model-container").children; //get container element children.
      for (var i = 0, len = children.length ; i < len; i++) {
         children[i].classList.remove("active"); //change child class name.
      }
      var el = document.getElementById("sid" +id.substring(4)  );
      el.className  += " active";
      $('#imagePreviewModal').modal('show');
   }
      
   //propmt user to select a file from device
   document.getElementById('trigger_image').onclick = function() {
      document.getElementById('file').click();
   };
   
   var CSRF_TOKEN = "{{csrf_token()}}"
   
   function load_images(job_id){
     console.log('Loading images...')
     $.ajax({
           url: "{{route('demo_images_fetch')}}",
           type: 'POST',
           data: {_token: CSRF_TOKEN, job_id:'1'},
           dataType: 'JSON',
           success: function (data) { 
             console.log(data);
             if( data.length != 0 ) {
               var element = document.getElementById("image-container");
               var element2 = document.getElementById("model-container");
               $('.carousel').carousel('pause');
               element.innerHTML = "";
               element2.innerHTML = "";
               for(var i=0;i<data.length;i++) {
                  var col = document.createElement('div');
                  col.classList = "col-xm-3 bd-highlight";
                  var img  = document.createElement('img')
                  img.src =  'http://192.168.1.137/Working/public//storage/job_attachments/' + data[i]['path']; 
                  img.classList = "pb-0 ml-1 mt-1 p-1 shadow-sm float-center";
                  img.style.height = "67px";
                  img.style.width = "67px";
                  img.id = 'img-' + data[i]['id'];

                  img.addEventListener('click', function (e) {
                  display_image_model(this.id);
                  });    
                  col.appendChild(img);
                  element.appendChild(col);
                  //prepare images to be pused into model
                  var slide1 = document.createElement('div');
                  slide1.id = 'sid' + data[i]['id'];
                  if(i == 0) {
                     slide1.classList = "carousel-item p-2";
                  } else {
                     slide1.classList = "carousel-item p-2";
                  }
                  var img2  = document.createElement('img')
                  img2.src =  'http://192.168.1.137/Working/public//storage/job_attachments/' + data[i]['path']; 
                  img2.classList = "img-fluid ";
                  slide1.appendChild(img2);
                  element2.appendChild(slide1);
               }
             
             }
           }
       }); 
   }
</script>
@endsection