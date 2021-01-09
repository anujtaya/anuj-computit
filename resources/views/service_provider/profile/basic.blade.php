<script src="{{secure_url('/js/star_rating_client.js')}}"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
   .star-icon {
   color: blue;
   font-size: 2em;
   position: relative;
   }
   .star-icon.full:before {
   text-shadow: 0 0 2px rgba(0, 0, 0, 0.7);
   color: blue;
   content: '\2605';
   /* Full star in UTF-8 */
   position: absolute;
   left: 0;
   }
   .star-icon.half:before {
   text-shadow: 0 0 2px rgba(0, 0, 0, 0.7);
   color: blue;
   content: '\2605';
   /* Full star in UTF-8 */
   position: absolute;
   left: 0;
   width: 50%;
   overflow: hidden;
   }
   ody {
   font-family: sans-serif;
   padding: 60px 20px;
   }
   @media (min-width: 600px) {
   body {
   padding: 60px;
   }
   }
   /* .range-slider {
   margin: 60px 0 0 0%;
   } */
   .range-slider {
   width: 100%;
   }
   .range-slider__range {
   -webkit-appearance: none;
   width: calc(100% - (73px));
   height: 10px;
   border-radius: 5px;
   background: #d7dcdf;
   outline: none;
   padding: 0;
   margin: 0;
   }
   .range-slider__range::-webkit-slider-thumb {
   -webkit-appearance: none;
   appearance: none;
   width: 20px;
   height: 20px;
   border-radius: 50%;
   background: #2c3e50;
   cursor: pointer;
   -webkit-transition: background 0.15s ease-in-out;
   transition: background 0.15s ease-in-out;
   }
   .range-slider__range::-webkit-slider-thumb:hover {
   background: #1abc9c;
   }
   .range-slider__range:active::-webkit-slider-thumb {
   background: #1abc9c;
   }
   .range-slider__range::-moz-range-thumb {
   width: 20px;
   height: 20px;
   border: 0;
   border-radius: 50%;
   background: #2c3e50;
   cursor: pointer;
   -moz-transition: background 0.15s ease-in-out;
   transition: background 0.15s ease-in-out;
   }
   .range-slider__range::-moz-range-thumb:hover {
   background: #1abc9c;
   }
   .range-slider__range:active::-moz-range-thumb {
   background: #1abc9c;
   }
   .range-slider__range:focus::-webkit-slider-thumb {
   box-shadow: 0 0 0 3px #fff, 0 0 0 6px #1abc9c;
   }
   .range-slider__value {
   display: inline-block;
   position: relative;
   width: 60px;
   color: #fff;
   line-height: 20px;
   text-align: center;
   border-radius: 3px;
   background: #2c3e50;
   padding: 5px 10px;
   margin-left: 8px;
   }
   .range-slider__value:after {
   position: absolute;
   top: 8px;
   left: -7px;
   width: 0;
   height: 0;
   border-top: 7px solid transparent;
   border-right: 7px solid #2c3e50;
   border-bottom: 7px solid transparent;
   content: "";
   }
   ::-moz-range-track {
   background: #d7dcdf;
   border: 0;
   }
</style>
<div class="m-1">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" accept="image/*" />
   </form>
   <br>
   @if(Session::has('status'))
   <div class="fs--1 ml-2 border-0 mr-2 alert alert-info">{{Session::pull('status')}}</div>
   @endif
   @if(Session::has('error'))
   <div class="fs--1 ml-2 border-0 mr-2 alert alert-danger">{{Session::pull('error')}}</div>
   @endif
   <div class="row ml-0 mr-0 bg-white rounded   bd-highlight  mb-3 mt-1 shadow-sm">
      <div class="col-4 p-3 bd-highlight" id="image_container">
         <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{Auth::user()->profile_image_path}}" class="border-white card-1 trigger_image" id="trigger_image" height="60" width="60"  style="border-radius:50%;" alt="User profile image" onerror="this.src='data:image/png;base64,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'"  >
      </div>
      <div class="col-8 p-4">
         <span class="font-weight-bold">{{Auth::user()->first}} {{Auth::user()->last}}</span> 
         <p class="fs--2 text-break">{{Auth::user()->email}}</p>
      </div>
      @if(Auth::user()->profile_image_path == null)
      <div class="col-12 pl-3 pr-3 pb-2 trigger_image">
         <span>Add profile photo</span>
      </div>
      @else
      <div class="col-12 pl-3 pr-3 pb-2 trigger_image">
         <span>Update profile photo</span>
      </div>
      @endif
   </div>
   <div class="fs--1" style="overflow:scroll; height:930px;">
      <span class="text-muted">Personal Details</span><br><br>
      <form action="{{route('app_user_update_account_information')}}" method="POST" onsubmit="toggle_animation(true);">
         @csrf
         <div class="form-group">
            <label for="user_first_name">First Name</label>
            <input type="text" class="form-control form-control-sm"  id="user_first_name" name="user_first_name" value="{{Auth::user()->first}}">
            @error('user_first_name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="user_last_name">Last Name</label>
            <input type="text" class="form-control form-control-sm"  id="user_last_name" name="user_last_name" value="{{Auth::user()->last}}">
            @error('user_last_name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="user_phone">Mobile No.   @if(Auth::user()->is_verified) <span class="badge badge-success fs--2">Verified</span> @endif</label>
            <input type="tel" class="form-control form-control-sm"  id="user_phone" name="user_phone" value="{{Auth::user()->phone}}" required>
            @error('user_phone')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control form-control-sm"  id="user_email"  value="{{Auth::user()->email}}" readonly>
         </div>
         <div class="form-group">
            <label for="user_job_radius">Job Radius <small>(10km - 200km radius range applies)</small></label>
            <div class="range-slider">
               <input class="range-slider__range" type="range" id="user_job_radius" name="user_job_radius" min="10" max="200" value="{{Auth::user()->work_radius}}" required>
               <span class="range-slider__value">{{Auth::user()->work_radius}}</span>
            </div>
            <!-- <input type="number" class="form-control form-control-sm"  id="user_job_radius" name="user_job_radius" value="{{Auth::user()->work_radius}}" required> -->
            @error('user_job_radius')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group">
            <button type="submit" class="btn theme-background-color btn-sm fs--1 font-weight-normal card-1">Save Changes</button>
         </div>
      </form>
      <div class="fs--1">
         <span class="text-muted">Business Details</span><br><br>
         @include('service_provider.profile.businessinfo')
      </div>
   </div>
</div>
<script>
   var rating_url = "{{secure_url('/addRating')}}"; //needs to be changed later
   var master_url = "{{route('service_seeker_profile')}}"; // needs to be changed later
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
         $('.rating').addRating();
         $('.rating-2').addRating({max : 10,icon : 'favorite'});
         $("#lol").hide();
   
      })
   //user profile image upload script
   var CSRF_TOKEN = "{{csrf_token()}}"
   $(document).ready(function(){
      $('#upload_form').on('submit', function(event){
         event.preventDefault();
         toggle_animation(true);
         $.ajax({
               url:"{{ route('imageservice_images_user_profile_image_upload') }}",
               method:"POST",
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               { 
                  toggle_animation(false);
                  //console.log(data);
                  $('#message').css('display', 'block');
                  $('#message').html(data.message);
                  $('#message').addClass(data.class_name);
                  $('#image_container').html(data.uploaded_image);
                  //console.log(data.uploaded_image);
                  document.getElementById('trigger_image').onclick = function() {
                     document.getElementById('file').click();
                  };
               },
               error: function(xhr, status, error) {
                  toggle_animation(false);
               }
         })
      });
   });
   
   
   //propmt user to select a file from device
   
   
   var elements = document.getElementsByClassName("trigger_image");
   
   for (var i = 0; i < elements.length; i++) {
      elements[i].onclick = function() {
      document.getElementById('file').click();
   };
   }
   
   // I've added annotations to make this easier to follow along at home. Good luck learning and check out my other pens if you found this useful
   
   // First let's set the colors of our sliders
   const settings = {
   fill: "#5D29BA",
   background: "#d7dcdf"
   };
   
   // First find all our sliders
   const sliders = document.querySelectorAll(".range-slider");
   
   // Iterate through that list of sliders
   // ... this call goes through our array of sliders [slider1,slider2,slider3] and inserts them one-by-one into the code block below with the variable name (slider). We can then access each of wthem by calling slider
   Array.prototype.forEach.call(sliders, (slider) => {
   // Look inside our slider for our input add an event listener
   //   ... the input inside addEventListener() is looking for the input action, we could change it to something like change
   slider.querySelector("input").addEventListener("input", (event) => {
    // 1. apply our value to the span
    slider.querySelector("span").innerHTML = event.target.value;
    // 2. apply our fill to the input
    applyFill(event.target);
   });
   // Don't wait for the listener, apply it now!
   applyFill(slider.querySelector("input"));
   });
   
   // This function applies the fill to our sliders by using a linear gradient background
   function applyFill(slider) {
   // Let's turn our value into a percentage to figure out how far it is in between the min and max of our input
   const percentage =
    (100 * (slider.value - slider.min)) / (slider.max - slider.min);
   // now we'll create a linear gradient that separates at the above point
   // Our background color will change here
   const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${
    settings.background
   } ${percentage + 0.1}%)`;
   slider.style.background = bg;
   }
   
</script>