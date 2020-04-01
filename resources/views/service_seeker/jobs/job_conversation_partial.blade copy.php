<div class="fs--1 mt-2 p-2 " id="scroll-area" style="overflow:scroll; height:500px;scroll-behavior: smooth;">
   <small class="text-muted">Conversation Log History</small> <br> <br>
   @for($i=0;$i<1;$i++)
   <div class="media w-50 mb-3">
      <div class="media-body ml-2">
         <img src="https://i.pravatar.cc/301" height="25" class="rounded-circle mb-1" width="25" alt=""> 
         <div class="bg-light  py-2 px-3 mb-2" style="border-radius:20px">
            <p class="text-small mb-0 ">Hi there! I would like to do this job for $50.45 only.</p>
         </div>
         <p class="small text-muted">12:00 PM | Aug 13</p>
      </div>
   </div>
   <!-- Reciever Message-->
   <div class="media w-50 ml-auto mb-3">
      <div class="media-body">
         <div class="text-right">
            <img src="https://i.pravatar.cc/300" height="25" class="rounded-circle mb-1 " width="25" alt=""> 
         </div>
         <div class="bg-secondary py-2 px-3 mb-2" style="border-radius:20px">
            <p class="text-small mb-0 text-white text-break">I will get back to you. {{substr(md5(mt_rand()), 0, 40)}}</p>
         </div>
         <p class="small text-muted">12:00 PM | Aug 13</p>
      </div>
   </div>
   @endfor
   <!-- offer recieved message -->
   <div class="media w-50 mb-3">
      <div class="media-body ml-2">
         <img src="https://i.pravatar.cc/301" height="25" class="rounded-circle mb-1" width="25" alt=""> 
         <div class="bg-light text-dark  py-2 px-3 mb-2" style="border-radius:20px">
            <p class="text-small mb-0 "> I can do this job for $45 on 12/02/2020 at 10:00AM. </p>
            <div class="row mt-3">
               <div class="col-6">
                  <button class="btn btn-sm text-success bg-white shadow-sm border fs--2 bg-white " style="border-radius:20px;" id="map_btn" onclick="alert('Message sent!');">
                  Acceept  
                  </button>
               </div>
               <div class="col-6">
                  <button class="btn btn-sm text-danger bg-white  shadow-sm border fs--2 bg-white " style="border-radius:20px;" id="map_btn" onclick="alert('Message sent!');">
                  Reject  
                  </button>  
               </div>
            </div>
         </div>
         <p class="small text-muted">12:00 PM | Aug 13</p>
      </div>
   </div>
   <!-- end offer recieved message -->
   <!-- offer recieved message -->
   <div class="media w-100 ml-auto mb-3">
      <div class="media-body text-center ml-2">
         
         <div class="bg-white border border-success text-success py-2 px-3 mb-2" style="border-radius:20px">
            <p class="text-small mb-0 text-success text-break"> You have Accpeted the offer..</p>
         </div>
         <p class="small text-muted">12:00 PM | Aug 13</p>
      </div>
   </div>
   <!-- end offer recieved message -->
   <!-- offer recieved message -->
   <div class="media w-100 ml-auto mb-3">
      <div class="media-body text-center ml-2">
         <div class="bg-white border border-danger  py-2 px-3 mb-2" style="border-radius:20px">
            <p class="text-small mb-0 text-danger text-break"> You have rejected the offer for $45 on 12/10/2020 at 10:00AM. </p>
         </div>
         <p class="small text-muted">12:00 PM | Aug 13</p>
      </div>
   </div>
   <!-- end offer recieved message -->
</div>
<div class="p-2 sticky-bottom  bg-white border-top">
   <div class="d-flex bd-highlight mb-2">
      <div class="p-2 flex-grow-1 bd-highlight">  <label for="">Reply</label></div>
      <div class=" bd-highlight">
         <button class="btn btn-sm theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="alert('Message sent!');">
         <i class="fas fa-paper-plane"></i> Send  
         </button>
      </div>
      <div class="pl-2 bd-highlight"><button class="btn btn-sm theme-color  shadow-sm border fs--1 bg-white text-muted" style="border-radius:20px;" id="map_btn" onclick="alert('Message sent!');">
         <i class="far fa-image"></i> Add Photo  
         </button>
      </div>
   </div>
   <div class="form-group m-2" >
      <textarea type="text" class="form-control form-control-sm" rows="3" id="service_job_description" ></textarea>
   </div>
</div>
<script>
   $( document ).ready(function() {
     var elem = document.getElementById('scroll-area');
     elem.scrollTop = elem.scrollHeight;
   
   });
</script>