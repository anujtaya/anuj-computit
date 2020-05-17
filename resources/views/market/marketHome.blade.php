@extends('market/marketMaster')

@section('title')
LocaL2LocaL – If you need it now, LocaL2LocaL it.
@endsection

@section('scripts')
@endsection
@section('content')
<style>
   @media screen and (min-width: 300px){   
   .loc_image {
   background: url("images/brisbane-city.jpg");;
   min-height:450px;
   background-size: cover;
   }
   }
   @media screen and (min-width: 700px) {      
   .loc_image {
   background:url("images/brisbane-city.jpg");;
   min-height:600px;
   background-size: cover;
   }
   } 
   .homepage_margin {
   margin-top:60px!important;
   }
   #main-services{
   color:black;
   }
   .cat-icons{
   background: black;
   margin: 30px;
   border-radius: 23px;
   width: 80px;
   height: 80px;
   text-align: center;
   transition: transform 0.25s ease 0s;
   }
   .font-custom{
   font-size:25px;
   line-height:80px; /* change the verticle position of fontawesome icon */
   color: white;
   }
   .font-custom-todo{
   font-size:70px;
   margin-right: 20px;
   }
   .image-custom{
   position: relative;
   top: 35px;
   }
   .cat-div{
   cursor: pointer;
   width:auto;
   }
   .cat-div:hover .cat-icons{
   transform: scale(1.2);
   }
   #book-now-btn:hover{
   background-color: #0885E9!important;
   }
   .flex-container{
   display: flex;
   justify-content: center;
   flex-flow: row wrap;
   margin-top:20px
   }
   .flex-container > div{
   width: 360px;
   margin: 50px;
   }
   .todo-align-div{
   padding: 10px;
   font-size: 18px;
   position: relative;
   color: #0a3d62;
   }
   .todo-align-div > *{
   float: left;
   /*margin-right: 5px;*/
   /*display: inline-block;*/
   }
   .l2l-benefits-items{
   margin-left: 20%;
   margin-right: 20%;
   color:black;
   }
   @media (min-width:320px)  {
   .aboutmeprofile{
   border-left: none!important;
   display: flex;
   justify-content: center;
   }
   }
   @media (min-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
   @media (min-width:641px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
   @media (min-width:961px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ }
   .video-edit{
   margin: 0 auto;
   width: 90%;
   }
   .main-cat-link-style{
   text-decoration: none!important;
   color:black;
   }
   .main-cat-link-style:hover{
   color:black;
   }
   .center_div_cat{
   margin: 0 auto;
   width:40%!important; /* value of your choice which suits your alignment */
   }
   .footer-link {
   color:#0a3d62!important;
   font-size:15px!important;
   }
   .custom_image_layout {
   width:100%!important;
   height:100%!important;
   position:relative;
   }
   @media (min-width: 300px) {
   .custom_image_layout_child {
   position:relative;
   font-size:13px!important;
   color:black!important;
   }
   h1 {
   font-size:34px!important;
   text-align:left;
   }
   }
   @media only screen and (min-width: 768px) {
   .custom_image_layout_child {
   position:absolute;
   top:200px;
   left:250px;
   font-size:55px!important;
   color:white!important;
   } 
   h2 {
   font-size:40px;
   }
   
   #custom_width_icons {
      max-width:900px!important;
      margin:0 auto;
   }
   }
</style>
<div class="jumbotron loc_image " id="image_display">
      <div class=" w3-center w3-text-white p-3 m-1    super_margin_top" >
         <h1 class="w3-center " style="font-size:50px;">
            <strong>If you need it now, LocaL2LocaL it!</strong></h2>
            <button  class="btn btn-primary btn-lg w3-card-4 mt-4 w3-border w3-border-white" onclick="location.href='{{secure_url('root')}}'">Login</button>
         </h1>
      </div>
</div>
<div id="main-services" class="container  p-2 bg-white" >
   <div class="jumbotron p-2 bg-white">
      <h3 class="w3-center mb-3 mt-2"><strong>Download App</strong></h3>
      <div class="w3-row">
         <div class="w3-col s6 border-right p-2">
            <span class="w3-right">
            <a href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8">
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/apple_badge.svg" height="46px" width="153px" alt="Apple Store App Store Badge Icon"/> 
            </a> 
            </span>
         </div>
         <div class="w3-col s6 p-2">
            <a href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US>">
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/android_badge.png"    alt="Play Store  Badge Icon" /> 
            </a>
         </div>
      </div>
   </div>
   
   <div>
      <p class="pl-4 pr-4">
         LocaL2LocaL is an app, that has been founded on the need to create a network of mobile businesses and individual Service Providers for immediate services. A Service Seeker engages an active Service Provider to do a job and once accepted, can track them approaching the specified location. 
      </p>
       <h5 class="w3-center mb-3 mt-2"><strong>LocaL2LocaL uses map tracking technologies like popular rideshare apps.</strong></h5>
       <p class="pl-4 pr-4">
          You can register to be both a Service Seeker and a Service Provider for free. It is also free for a Service Provider to advertise their business & services. A Service Provider nominates the amount they wish to be paid either per job or per hour. When a Service Seeker engages you to do a job, the nominated amount is secured from the Service Seeker’s credit card and placed on hold. When the Service Provider completes the job, they are paid automatically less a small engagement fee.
       </p>
      
   </div>
   
   
   
   <div class="mt-5 mb-5 p-0">
     <h3 class="w3-center mb-3 mt-2"><strong>Our Main Services</strong></h3>
      <div class="row " id="custom_width_icons">
         <div  class="col cat-div">
            <div id="carousel0" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-star"></i>
               <p class="mb-3">Main features</p>
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel1" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-paw"></i>
               <p class="mb-3">Pet care</p>
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel2" class="main-cat-link-style cat-icons"onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-toolbox"></i>
               <p class="mb-3">Trades</p>
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel3" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-chalkboard-teacher"></i> </br>
               Tutoring
               </br>
               </br> 
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel4" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-truck"></i> </br>
               Delivering Flowers
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel5" class="main-cat-link-style cat-icons " onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-car"></i> </br>
               Cars Flat Tyre
            </div>
         </div>
     
    
         <div  class="col cat-div " >
            <div id="carousel6" class="main-cat-link-style cat-icons w3-center" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-tree"></i>
               <i class="font-custom fas fa-tree"></i></br>
               Home and Gardening
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel7" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-heart"></i><br>
               Health, Beauty and Wedding
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel8" class="main-cat-link-style cat-icons" onclick="location.href='#main-video-tag'">
               <i class="font-custom fas fa-hands-helping"></i><br>Care and Support Babysitting
            </div>
         </div>
         <div  class="col cat-div">
            <div id="carousel9" class="main-cat-link-style cat-icons" onclick="">
               <i class="font-custom"></i><br>
            </div>
         </div>
        
      </div>
   </div>
   <div class="mt-5 mb-5 text-white">
      Empty Container
   </div>
   <div id="main-video-tag" class="mt-5 mb-5 border-top" >
      <div class="mb-5 mt-5" style="font-weight:bolder;font-size:34px;text-align:center;">How does LocaL2LocaL work?</div>
      <div style="font-size:20px;text-align:center;"> Check out the video below to see how LocaL2LocaL can assist you in getting things done!</div>
      <br><br>
      <div style="text-align:center">
         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
               <!-- Carousel 0 -->
               <div class="carousel-item active">
                  <video id="player1" poster="images/market_poster.png" class="video-edit" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/front-page-video_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 1 -->
               <div class="carousel-item">
                  <video id="player2"  class="video-edit" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/1-l2lmain_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 2 -->
               <div id="main-video-tag2" class="carousel-item">
                  <video id="player3"  poster="" class="video-edit" style=" object-fit: contain;" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/L2L+-+Dog+Walking+480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 3 -->
               <div class="carousel-item">
                  <video id="player4"  poster="" class="video-edit" style=" object-fit: contain;" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/3-l2ltrades_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 4 -->
               <div class="carousel-item">
                  <video id="player5"  poster="" class="video-edit" style=" object-fit: contain;" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/4-l2ltutoring_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 5 -->
               <div class="carousel-item">
                  <video id="player6"  poster="images/homepage-images/flowers_vid_poster.png" class="video-edit" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/L2L+-+Delivering+Flowers+480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 6 -->
               <div class="carousel-item">
                  <video id="player7" poster="images/homepage-images/cars_vid_poster.png" class="video-edit"  controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/L2L+-+Cars+Flat+Tyre+480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 7 -->
               <div class="carousel-item">
                  <video id="player8"  poster="" class="video-edit" style=" object-fit: contain;">
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/l2lgardens_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 8 -->
               <div class="carousel-item">
                  <video id="player9"  poster="" class="video-edit" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/9-l2lwedding_480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 9 -->
               <div class="carousel-item">
                  <video id="player10"  poster="" class="video-edit" controls>
                     <source src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/L2L+-+Baby+Sitting+480.mp4">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 10 -->

            </div>
            <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="height: 470px;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="height: 470px;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a> -->
         </div>
      </div>
   </div>
   <div class="row m-2">
      <div class="col-md-6  w3-hover-shadow p-3  ">
         <i class="fas fa-map-marker-alt icon_font_large w3-text-black"></i>
         <br>
         <br>
         <h5 ><strong>Immediate Assistance, Anywhere, Anytime</strong></h5>
         <p>One tap and a Service Provider comes directly to you. Payment is safe via our secure Stripe payment gateway The LocaL2LocaL community extends throughout the country.</p>
      </div>
      <div class="col-md-6 p-3 w3-hover-shadow">
         <i class="fas fa-hand-holding-usd icon_font_large w3-text-black"></i>
         <br>
         <br>
         <h5 ><strong>Earn extra money in your time</strong></h5>
         <p>LocaL2LocaL offers you a great way to earn more money every day. You can work anytime you want and start making some money by helping people within your set radius.</p>
      </div>
      <div class="col-md-6 p-3 w3-hover-shadow ">
         <i class="fas fa-people-carry icon_font_large w3-text-black"></i>
         <br>
         <br>
         <h5 ><strong>Available Workforce</strong></h5>
         <p>The Local2LocaL Business Platform gives the business owner a flexible, expansive workforce that can fluctuate according to demand.</p>
      </div>
      <div class="col-md-6 p-3 w3-hover-shadow ">
         <i class="fas fa-shield-alt icon_font_large w3-text-black"></i>
         <br>
         <br>
         <h5 ><strong>Fraud Protection</strong></h5>
         <p class="">We verify the information of every Service Provider that joins our team. This helps us create a fraud-free environment at LocaL2LocaL.</p>
      </div>
   </div>
</div>
<script>
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player1').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player2').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player3').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player4').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player5').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player6').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player7').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player8').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player9').pause();
   });
   $('#carouselExampleControls').on('slide.bs.carousel', function () {
     document.getElementById('player10').pause();
   });
   
   $('#carousel0').on('click', function() {
       $('#carouselExampleControls').carousel(1);
   });
   $('#carousel1').on('click', function() {
       $('#carouselExampleControls').carousel(2);
   });
   $('#carousel2').on('click', function() {
       $('#carouselExampleControls').carousel(3);
   });
   $('#carousel3').on('click', function() {
       $('#carouselExampleControls').carousel(4);
   });
   $('#carousel4').on('click', function() {
       $('#carouselExampleControls').carousel(5);
   });
   $('#carousel5').on('click', function() {
      console.log("you clicked me");
       $('#carouselExampleControls').carousel(6);
   });
   $('#carousel6').on('click', function() {
       $('#carouselExampleControls').carousel(7);
   });
   $('#carousel7').on('click', function() {
       $('#carouselExampleControls').carousel(8);
   });
   $('#carousel8').on('click', function() {
       $('#carouselExampleControls').carousel(9);
   });
   $('#carousel9').on('click', function() {
       $('#carouselExampleControls').carousel(10);
   });
   
</script>
<script src="{{secure_url('/js/loc_img_process.js')}}?v={{rand(10,100)}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&callback=initMap"></script>
@endsection