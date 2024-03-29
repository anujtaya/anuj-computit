<div class=" fs--1 ">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" accept="image/*" />
      <input type="hidden" name="current_job_id" value="{{$job->id}}" id="current_job_id" />
   </form>
   <br />
   <!-- <span id="uploaded_image"></span> -->
   <div class="m-0">
      @if($job->service_provider_id == Auth::id())
         @if($job->status != 'COMPLETED')
            <span class="d-block">Please select only one photo for each upload.</span>
            <button class="btn mt-1 theme-color btn-sm  border fs--1 bg-white" id="trigger_image"><i class="fas fa-camera"></i> Add Photo </button>
         @endif
      @else
      <span class="d-none" id="trigger_image"></span>
      @endif
      <div class="row m-0 text-center" id="image-container">
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal bg-white fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content border-0">
         <div class="modal-body">
            <div class="text-danger p-2 text-center fs--2" id="img-error-display"></div>
            <div class="fixed-bottom p-2 border border-light text-center bg-white">
               <div class="row">
                  <!-- <div class="col-4 text-left">
                     <a class="fs--1 btn btn-sm btn-white text-secondary card-1" href="#carouselExampleIndicators" onclick="$('#img-error-display').html('');" role="button" data-slide="prev">
                     <i class="fas fa-arrow-left fs-1"></i>
                     </a>   
                  </div> -->
                  <div class="col-12 text-center" id="img-delete-btn-container">
                     <button class="fs--1 btn btn-sm theme-background-color card-1" type="button" class="close" data-dismiss="modal" aria-label="Close">Exit</button>
                  </div>
                  <!-- <div class="col-4 text-right">
                     <a class="fs--1 btn btn-sm btn-white text-secondary card-1" onclick="$('#img-error-display').html('');" href="#carouselExampleIndicators" role="button" data-slide="next">
                     <i class="fas fa-arrow-right fs-1"></i>
                     </a>
                  </div> -->
               </div>
            </div>
            <div class="m-0">
               <div id="carouselExampleIndicators" class="carousel slide text-center" data-interval="false"  style="min-height:400px!important;" data-ride="carousel">
                  <div class="carousel-inner" id="model-container">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var CSRF_TOKEN = "{{csrf_token()}}"
   var job_id = "{{$job->id}}";
   var current_selected_image = null;
   var app_job_image_url = "{{url('/')}}";
   var user_id = "{{Auth::id()}}"
   
   $('#image-container').on('slid.bs.carousel', function (e) {
      var src = $('.active').find('img').attr('src');
      current_selected_image = src;
      console.log(current_selected_image);
    });
   
   $(document).ready(function(){
     load_images(job_id);
     $('#upload_form').on('submit', function(event){
         event.preventDefault();
         $.ajax({
            url:"{{ route('imageservice_images_upload') }}",
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
                  load_images(job_id);
               }
            }
         })
     });
   });
   
   //propmt user to select a file from device
   document.getElementById('trigger_image').onclick = function() {
      document.getElementById('file').click();
   };
   
   function display_image_model(id) {
      var children = document.getElementById("model-container").children; //get container element children.
      for (var i = 0, len = children.length ; i < len; i++) {
         children[i].classList.remove("active"); //change child class name.
      }
      var el = document.getElementById("sid" +id.substring(4)  );
      el.className  += " active";
      $('#imagePreviewModal').modal('show');
   }
   
   function load_images(job_id){
     //console.log('Loading images...')
     //console.log(job_id);
     $.ajax({
         url: "{{route('imageservice_images_fetch')}}",
         type: 'POST',
         data: {_token: CSRF_TOKEN, job_id:job_id},
         dataType: 'JSON',
         success: function (data) {
            //console.log(data);
            var element = document.getElementById("image-container");
            var element2 = document.getElementById("model-container");
            element.innerHTML = "";
            element2.innerHTML = "";
            if( data.length != 0 ) {
            $('.carousel').carousel('pause');
            element.innerHTML = "";
            element2.innerHTML = "";
            for(var i=0;i<data.length;i++) {
               var col = document.createElement('div');
               col.classList = "col-xm-3 bd-highlight";
               var img  = document.createElement('img')
               img.src = app_job_image_url + '/fetch/job_attachments/' + data[i]['id'];
               img.classList = "pb-0 ml-1 mt-1 p-1   shadow-sm float-center";
               img.style.height = "90px";
               img.style.width = "90px";
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
               img2.src =  app_job_image_url + '/fetch/job_attachments/' + data[i]['id'];
               img2.classList = "img-fluid p-2 border border-light";
               //img2.style.width = "220px";
               slide1.appendChild(img2);
               if(data[i]['upload_user_id'] == user_id) {
                  var btn = document.createElement('button')
                  btn.classList ="fs--1 btn btn-sm btn-danger text-white card-1 btn-block mb-2";
                  btn.id = 'imgdel-' + data[i]['id'];
                  btn.addEventListener('click', function (e) {
                     image_remove(this.id);
                  });
                  btn.innerHTML= "Delete Image";
                  slide1.appendChild(btn);
               }
               element2.appendChild(slide1);
            }
            }else{
            $("#message").css("display", "none");
            element.innerHTML = "No Images Found. Any image attachement will appear here.";
            }
         }
      });
   }
   
   function image_remove(id){
      console.log('Image delete request made.');
      $.ajax({
         url: "{{route('imageservice_images_delete')}}",
         type: 'POST',
         data: {_token: CSRF_TOKEN, job_attachment_id:id.substr(7)},
         dataType: 'JSON',
         success: function (data) {
            if(data == true) {
            $('#imagePreviewModal').modal('hide');
            $("#img-error-display").html('');
            load_images(job_id);
            } else {
            $("#img-error-display").html('Unable to delete image.');
            }
         },
         error: function(results, status, err) {
            $("#img-error-display").html('Unable to delete image due to server error.');
         }
      });
   }
</script>