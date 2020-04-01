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

</style>

<div class="m-1">
<div class="d-flex theme-background-color-n bg-white rounded   bd-highlight ml-2 mr-2 mt-1 shadow-sm">
   <div class="p-3 bd-highlight">
      <img src="https://i.pravatar.cc/{{rand(300,400)}}" class="border-white card-2" height="60" style="border-radius:50%;" width="60" alt="">
   </div>
   <div class="p-4 bd-highlight">
      <span class="font-weight-bold">{{Auth::user()->first}} {{Auth::user()->last}}</span> <br>
      <span class="fs--1 ">{{Auth::user()->email}}</span> <br>
      <span class="badge border text-success mt-1 p-2" style="border-radius:20px!important;"><i class="far fa-check-circle"></i> Verified</span>
   </div>
</div>
<div class="row m-1" style="overflow:scroll; height:630px;" >
   <div class="col-12 fs--1 p-2 " >
      <div class="form-group">
         <label for="exampleInputEmail1">First Name</label>
         <input type="text" class="form-control form-control-sm"  id="first_name" value="{{Auth::user()->first}}">
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Last Name</label>
         <input type="text" class="form-control form-control-sm"  id="last_name" value="{{Auth::user()->last}}">
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Address</label>
         <input type="text" class="form-control form-control-sm"  id="address" value="">
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Email</label>
         <input type="email" class="form-control form-control-sm"  id="email" value="{{Auth::user()->email}}">
      </div>
      <div class="form-group">
         <label for="exampleInputEmail1">Mobile No.</label>
         <input type="email" class="form-control form-control-sm"  id="phone" value="{{Auth::user()->phone}}">
      </div>
      <div class="form-group">
         <button class="btn btn-info btn-sm fs--1 font-weight-normal">Save Changes</button>
      </div>
      <div class="form-group mt-0">
        <a href="" class="text-danger fs--1"><i class="far fa-frown"></i> Delete My Account</a>
      </div>
   </div>

   <div class="w3-center shadow-sm p-2" id="t4">
      <h5 class=" font-weight-bold text-secondary w3-center mb-2" >Rate Your Service Provider</h5>
      <div class=" stars  w3-tiny">
         <div class="rating" id="rating"></div>
      </div>
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

</script>
