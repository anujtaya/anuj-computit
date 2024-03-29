<!-- wizard 1 -->
<div id="wizard_view_1">
   <div class="row fs--1 m-0">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1">Step 1 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_selection_name_display" class="fs-1 text-white"></span>
         </div>
      </div>
      <!-- sub category list view -->
      <div class="col-12 p-2 p-3">
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
               <a href="" class="fs-1 theme-color" onclick="wizard_exit(); event.preventDefault();">
                  <i class="fas fa-times"></i> Cancel
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_2');event.preventDefault();">
                  Next <i class="fas fa-arrow-right"></i>
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
               <span class="text-white mt-1">Step 2 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display" class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- job title and description -->
      <div class="col-12 fs--1 p-2 p-3">
         <div class="form-group">
            <label for="exampleInputEmail1">Write your job title</label>
            <input type="text" class="form-control form-control-sm" onchange="create_seeker_job_draft();"
               id="service_job_title" placeholder="Please enter your job title" value="asdsad">
            <small id="emailHelp" class="form-text text-muted">Please use plain english text.</small>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea type="text" class="form-control form-control-sm" onchange="create_seeker_job_draft();" rows="12"
               id="service_job_description" placeholder="Please enter your job description">sadsa</textarea>
            <small id="emailHelp" class="form-text text-muted">Provide as much detail as you can.</small>
         </div>
      </div>
      <!-- end view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_1');event.preventDefault();">
                  <i class="fas fa-arrow-left"></i> Back
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_3');event.preventDefault();">
                  Next <i class="fas fa-arrow-right"></i>
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
               <span class="text-white mt-1">Step 3 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display" class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- job title and description -->
      <div class="col-12 fs--1 p-2 p-3">
         <div class="form-group">
            <label for="exampleInputEmail1">As soon as possible after this Date and Time:</label>
            <div class="input-group input-group-sm mb-3">
               <input class="form-control" type="text" onchange="create_seeker_job_draft();"
                  class="form-control form-control-sm" id="service_job_datetime"
                  value="{{\Carbon\Carbon::now()->format('h:i A d/m/Y')}}" readonly="readonly" required>
               <div class="input-group-append">
                  <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="fas fa-calendar fs-1"></i> </span>
               </div>
            </div>
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
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_2');event.preventDefault();">
                  <i class="fas fa-arrow-left"></i> Back
               </a>
            </div>
            <div class=" bd-highlight pt-3 pr-4 pb-3">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_4');event.preventDefault();">
                  Next <i class="fas fa-arrow-right"></i>
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
               <span class="text-white mt-1">Step 4 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display" class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- confirm user location -->
      <div class="col-12 fs--1 p-2 p-3">
         @include('service_seeker.location_confirmation')
      </div>
      <!-- end confirm user location view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_3');event.preventDefault();">
                  <i class="fas fa-arrow-left"></i> Back
               </a>
            </div>
            <div class=" bd-highlight   pt-3 pr-4 pb-3">
               <a href="" class="theme-color fs-1" onclick="book_job();event.preventDefault();">
                  Done
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 4 -->

<!-- new steps for delivery locations -->

<!-- wizard 5 for deliveries only -->
<div id="wizard_view_5" style="display:none;">
   <div class="row fs--1 m-0">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1">Step 4 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display" class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- confirm user location -->
      <div class="col-12 fs--1 p-2 p-3">
         @include('service_seeker.location_confirmation_pickup')
      </div>
      <!-- end confirm user location view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_3');event.preventDefault();">
                  <i class="fas fa-arrow-left"></i> Back
               </a>
            </div>
            <div class=" bd-highlight   pt-3 pr-4 pb-3">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_6');event.preventDefault();">
                  Next <i class="fas fa-arrow-right"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 5 for deliveries only -->
<!-- wizard 6 for deliveries -->
<div id="wizard_view_6" style="display:none;">
   <div class="row fs--1 m-0">
      <div class="col-12 text-center p-2 p-3" style="background:#399BDB!important;">
         <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
               <span class="text-white mt-1">Step 5 of <span class="total_steps"></span></span>
            </div>
            <div class=" bd-highlight p-2">
               <a href="" class="text-white float-right " onclick="wizard_exit(); event.preventDefault();"><i
                     class="fas fs-1 fa-times"></i></a>
            </div>
         </div>
         <div class="text-center mt-4">
            <span id="service_subselection_name_display" class="fs-1 text-white"></span><br>
         </div>
      </div>
      <!-- confirm user location -->
      <div class="col-12 fs--1 p-2 p-3">
      @include('service_seeker.location_confirmation_dropoff')
      </div>
      <!-- end confirm user location view -->
   </div>
   <!-- bottom nav -->
   <div class="fixed-bottom">
      <div class=" border-top bg-white  justify-content-center fs--1 text-center m-0">
         <div class="d-flex bd-highlight">
            <div class="mr-auto pt-3 pl-4 pb-3 bd-highlight">
               <a href="" class="theme-color fs-1" onclick="wizard_switch('wizard_view_5');event.preventDefault();">
                  <i class="fas fa-arrow-left"></i> Back
               </a>
            </div>
            <div class=" bd-highlight   pt-3 pr-4 pb-3">
               <span href="" class="theme-color fs-1" onclick="book_delivery_job();event.preventDefault();">
                  Done
</span>
            </div>
         </div>
      </div>
   </div>
   <!-- en bottom nav  -->
</div>
<!-- end wizard 6 for deliveries -->
<!-- end new steps for delivery locations -->
<script>
   var seeker_jobs_url = '{{route("service_seeker_jobs")}}';
   $(document).ready(function()
      {
         $("#service_job_datetime").AnyPicker(
         {
            mode: "datetime",
            showComponentLabel: true,
            dateTimeFormat: "hh:mm AA d/M/yyyy",
            onChange: function(iRow, iComp, oSelectedValues)
            {
                  //console.log("Changed Value : " + iRow + " " + iComp + " " + oSelectedValues);
            },
            theme: "Android"
         });

      });
</script>