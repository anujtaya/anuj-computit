<!-- wizard 1 -->
<div id="wizard_view_1">
   <div class="row fs--1 m-0" >
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1" >Step 1 of 4</span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_selection_name_display"  class="fs-1 text-white"></span>
         </div>
      </div>
      <!-- sub category list view -->
      <div class="col-12 p-2 p-3" >
         <span class="fs--1">Choose a Sub-category</span>
         <br><br>
         <ul class="list-group fs--1" id="wizard_service_node_list">
         </ul>
      </div>
      <!-- end view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white sticky-bottom justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" class="text-white " onclick="wizard_exit(); event.preventDefault();">
               <i class="fas fs-1 fa-times theme-color"></i>
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" onclick="wizard_switch('wizard_view_2');event.preventDefault();">
               <i class="fas fa-arrow-right theme-color fs-2"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 1 -->
<!-- wizad 2 -->
<div id="wizard_view_2" style="display:none;">
   <div class="row fs--1 m-0" id="wizard_view_2">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1" >Step 2 of 4</span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display"  class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- job title and description -->
      <div class="col-12 fs--1 p-2 p-3" >
         <div class="form-group">
            <label for="exampleInputEmail1">Write your job title</label>
            <input type="email" class="form-control form-control-sm" onchange="create_seeker_job_draft();"  id="service_job_title" placeholder="Please enter your job title" value="Sample job title">
            <small id="emailHelp" class="form-text text-muted">Please use plain english text.</small>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea type="text" class="form-control form-control-sm" onchange="create_seeker_job_draft();" rows="12" id="service_job_description" placeholder="Please enter your job description">Sample job description</textarea>
            <small id="emailHelp" class="form-text text-muted">Provide as much as details you can.</small>
         </div>
      </div>
      <!-- end view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" onclick="wizard_switch('wizard_view_1');event.preventDefault();">
               <i class="fas fa-arrow-left theme-color fs-2"></i>
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" onclick="wizard_switch('wizard_view_3');event.preventDefault();">
               <i class="fas fa-arrow-right theme-color fs-2"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- end bottom nav  -->
</div>
<!-- end wzard 2 -->
<!-- wizard 3 -->
<div id="wizard_view_3" style="display:none;">
   <div class="row fs--1 m-0">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1" >Step 3 of 4</span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
           <span id="service_subselection_name_display"  class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- job title and description -->
      <div class="col-12 fs--1 p-2 p-3" >
         <div class="form-group">
            <label for="exampleInputEmail1">Preferred Date and Time</label>
            <input  type='datetime-local' onchange="create_seeker_job_draft();" class="form-control form-control-sm"  id="service_job_datetime" value="2020-06-13T13:00">
            <small class="form-text text-muted">Please use plain english text.</small>
         </div>

         @include('service_seeker.partial.image_upload_grid')

      </div>
      <!-- end view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" onclick="wizard_switch('wizard_view_2');event.preventDefault();">
               <i class="fas fa-arrow-left theme-color fs-2"></i>
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" onclick="wizard_switch('wizard_view_4');event.preventDefault();">
               <i class="fas fa-arrow-right theme-color fs-2"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 3 -->
<!-- wizard 4 -->
<div id="wizard_view_4" style="display:none;">
   <div class="row fs--1 m-0">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1" >Step 4 of 4</span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
           <span id="service_subselection_name_display"  class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- confirm user location -->
      <div class="col-12 fs--1 p-2 p-3" >
        @include('service_seeker.location_confirmation')
      </div>
      <!-- end confirm user location view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" onclick="wizard_switch('wizard_view_3');event.preventDefault();">
               <i class="fas fa-arrow-left theme-color fs-2"></i>
               </a>
            </div>
            <div class=" bd-highlight   pt-3 pr-4 pb-3">
               <a class="theme-color fs-1" onclick="book_job();">
                Done
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 4 -->
<script>
var seeker_jobs_url = '{{route("service_seeker_jobs")}}';
</script>
