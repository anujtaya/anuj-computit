<div class=" fs--1 ">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" accept="image/*" />
      <input type="hidden" name="current_job_id" id="current_job_id" />
   </form>
   <br />
   <!-- <span id="uploaded_image"></span> -->
   <div >
      <button class="btn theme-color btn-sm  border fs--1 bg-white text-muted m-1" id="trigger_image"><i class="fas fa-upload"></i> Add Photo </button>
      <div class="row  m-1 text-center" id="image-container">
      </div>
   </div>
</div>





<script>
   $(document).ready(function(){

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
                 //console.log(data);
                 $('#message').css('display', 'block');
                 $('#message').html(data.message);
                 $('#message').addClass(data.class_name);
                 if(data.uploaded_image != "") {
                   load_images(1);
                 }
               }
         })
     });
   });

  

   //propmt user to select a file from device
   document.getElementById('trigger_image').onclick = function() {
      document.getElementById('file').click();
   };

   var CSRF_TOKEN = "{{csrf_token()}}"

   function load_images(job_id){
     $.ajax({
           url: "{{route('imageservice_images_fetch')}}",
           type: 'POST',
           data: {_token: CSRF_TOKEN, job_id:current_job_draft_id},
           dataType: 'JSON',
           success: function (data) {
             //console.log(data);
             var element = document.getElementById("image-container");
             element.innerHTML = "";
             if( data.length != 0 ) {
               $('.carousel').carousel('pause');
               element.innerHTML = "";
               for(var i=0;i<data.length;i++) {
                  var col = document.createElement('div');
                  col.classList = "col-xm-3 bd-highlight";
                  var img  = document.createElement('img')
                  img.src =  app_url + '//storage/job_attachments/' + data[i]['path'];
                  img.classList = "pb-0 ml-1 mt-1 p-1 shadow-sm float-center";
                  img.style.height = "67px";
                  img.style.width = "67px";
                  col.appendChild(img);
                  element.appendChild(col);
               }
             }else{
               $("#message").css("display", "none");
             }
           }
       });
   }
</script>
