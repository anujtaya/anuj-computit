<div class="fs--1">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" accept="image/*" />
      <input type="hidden" name="current_session_id" id="current_session_id" value="{{Session::getId()}}" />
   </form>
   <br>
   <div class="m-0">
      <span class="d-block">Please select only one photo for each upload.</span>
      <button class="btn mt-1 theme-color btn-sm  border fs--1 bg-white" id="trigger_image"><i class="fas fa-upload"></i> Add Photo </button>
      <div class="row m-0 text-center" id="image-container">
      </div>
   </div>
</div>
<!-- image preview modal -->
<div class="modal fade" id="job_image_preview_modal" tabindex="-1" role="dialog" aria-labelledby="job_image_preview_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="job_image_preview_holder" class="img-fluid" alt="Job attachment image preview" onerror="this.src='data:image/png;base64,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'" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white btn-sm card-1" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger btn-sm text-white card-1" onclick="delete_image();">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
   $(document).ready(function(){
    load_images();
     $('#upload_form').on('submit', function(event){
         event.preventDefault();
         $.ajax({
               url:"{{ route('guest_imageservice_images_upload') }}",
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
                   load_images();
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

   function load_images(){
     $.ajax({
           url: "{{route('guest_imageservice_images_fetch')}}",
           type: 'POST',
           data: {_token: CSRF_TOKEN, current_session_id:current_session_id},
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
                  img.src =  app_url + '/guest/storage/job_attachments/' + data[i]['path'];
                  img.classList = "pb-0 ml-1 mt-1 p-1 shadow-sm float-center";  
                  img.style.height = "67px";
                  img.style.width = "67px";
                  img.id = "imgguid-"+data[i]['id'];
                  img.setAttribute('data-imagepath',img.src);
                  img.addEventListener('click', function (e) {
                    job_attachment_delete(this.id, this.getAttribute('data-imagepath'));
                  });
                  col.appendChild(img);
                  element.appendChild(col);
               }
             }else{
               $("#message").css("display", "none");
             }
           }
       });
   }


   var delete_image_id = null;
  function job_attachment_delete(global_image_id,global_image_path) {
    $('#job_image_preview_modal').modal('show');
    $('#job_image_preview_holder').attr("src",global_image_path);
    delete_image_id = null;
    delete_image_id = global_image_id.substr(8);
  }

  function delete_image(){
    console.log('Deleting image...');
    toggle_animation(true);
    $.ajax({
         url: "{{route('guest_imageservice_images_delete')}}",
         type: 'POST',
         data: {_token: CSRF_TOKEN, job_attachment_id:delete_image_id},
         dataType: 'JSON',
         success: function (data) {
            toggle_animation(false);
            $('#job_image_preview_modal').modal('hide');
            if(data == true) {
            console.log('Image deleted.');
            delete_image_id = null;
            load_images();
            } 
         },
         error: function(results, status, err) {
            toggle_animation(false);
            console.log(err);
         }
      });
  }

</script>
