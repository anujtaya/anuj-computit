@extends('frontend.master')
@section('title')
LocaL2LocaL – Homepage
@endsection
@section('topnav')
<nav id="mobile-menu" class="main-menu">
   <ul>
      <li class="current">
         <a href="#home_id">Home</a>
      </li>
      <li>
         <a href="#features_id">Features</a>
      </li>
      <li>
         <a href="#overview_id">Overview</a>
      </li>
      <li>
         <a href="#pricing_id">Service Fee</a>
      </li>
      <li>
         <a href="#screenshot_id">App</a>
      </li>
      <li>
         <a href="#">More</a>
         <ul class="sub-menu">
            <li><a href="https://blog.local2local.com.au">Blog</a></li>
            <li><a href="{{route('app_frontend_faq')}}">FAQ</a></li>
            <li><a href="{{route('app_frontend_support')}}">Support</a></li>
         </ul>
      </li>
      <li>
         <a class="btn btn-style1" href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8">Download</a>
      </li>
   </ul>
</nav>
@endsection
@section('content')
<!--hero_section-->
<header class="hero_section_t" id="home_id">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="row h-100">
               <div class="col my-auto">
                  <div class="hero_content_in">
                     <h1>
                        If you need it now,<br />
                        LocaL2LocaL it.
                     </h1>
                     <a href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8" class="btn btn-style2">Download Now</a>
                     <div class="donwload_btn">
                        <p>Available on all platform</p>
                        <div class="btn-group">
                           <a
                              href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8"
                              class="btn"
                              ><i class="fab fa-apple"></i
                              ></a>
                           <a
                              href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US"
                              class="btn"
                              ><i class="fab fa-android"></i
                              ></a>
                           <!-- <a href="#" class="btn"><i class="fab fa-windows"></i></a> -->
                        </div>
                     </div>
                  </div>
                  <!--/.hero_content_in-->
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="hero_image_right">
               <div id="wrapper">
                  <div
                     class="letra"
                     data-speed="0.08"
                     style="transform: matrix(1, 0, 0, 1, -22.32, -17.16)"
                     >
                     <img src="{{config('app.frontend_resource_url')}}/img/mockup.png" alt="" />
                  </div>
               </div>
            </div>
            <!--/.hero_image_right-->
         </div>
      </div>
   </div>
   <!--/.container-->
   <!-- <img src="img/hero_left.png" class="mid_hero_s" alt=""/> -->
</header>
<!--hero_section-->
<!--services-->
<section class="services_sec2 pb-160 new-services">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title text-center mb-30">
               <h2>Booking a job has<br />Never been easier.</h2>
            </div>
            <!--/.title-->
         </div>
         <div class="w-100"></div>
         <div class="col-md-4">
            <div class="single_service_in2 wow animated fadeInUp">
               <img src="{{config('app.frontend_resource_url')}}/img/post.svg" alt="" />
               <h4><a href="#">Post a job</a></h4>
               <p>
                  As a Seeker write a brief description about your job. Provide us with the details of where you want it done and choose to post it immediately or schedule in a later date. Our booking process is quick and simple whilst being completly free.
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/home2/icon/service-shape.svg" class="svg" alt="" />
            </div>
            <!--/.single_service_in2-->
         </div>
         <div class="col-md-4">
            <div
               class="single_service_in2 wow animated fadeInUp"
               data-wow-delay="0.2s"
               >
               <img src="{{config('app.frontend_resource_url')}}/img/postt.svg" alt="" />
               <h4><a href="#">Select your Provider</a></h4>
               <p>
                  Once a Provider makes an offer on your job you’ll be immediately notified and will be able to browse through their profiles filtering your selection through pricing, distance, ratings until you find the right one for the job.
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/home2/icon/service-shape.svg" class="svg" alt="" />
            </div>
            <!--/.single_service_in2-->
         </div>
         <div class="col-md-4">
            <div
               class="single_service_in2 wow animated fadeInUp"
               data-wow-delay="0.4s"
               >
               <img src="{{config('app.frontend_resource_url')}}/img/location.svg" alt="" />
               <h4><a href="#">Completion</a></h4>
               <p>
                  Once selected our in app messaging systems allow for easy breezy communication and our live tracking  feature shows your provider coming to you in real time. On completion, just confirm your payment method, leave a review and you're all done. 
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/home2/icon/service-shape.svg" class="svg" alt="" />
            </div>
            <!--/.single_service_in2-->
         </div>
      </div>
   </div>
   <!--/.container-->
</section>
<!--services-->
<br />
<div class="container app-description">
   <div class="app-dec-cont shadow-lg mt-4 mb-4 bg-white rounded pt-10">
      <p class="pl-4 pr-4">
         LocaL2LocaL is an app, that has been founded on the need to create a
         network of mobile businesses and individual Service Providers for
         immediate services.<br />
         A Service Seeker engages an active Service Provider to do a job and
         once accepted, can track them approaching the specified location.
      </p>
      <h5 class="pl-4 w3-center mb-2 mt-2">
         <strong
            >LocaL2LocaL uses map tracking technologies like popular rideshare
         apps.</strong
            >
      </h5>
      <p class="pl-4 pr-4">
         A Service Provider nominates the amount they wish
         to be paid either per job or per hour. When a Service Seeker engages
         you to do a job, the nominated amount is secured from the Service
         Seeker’s credit card and placed on hold. When the Service Provider
         completes the job, they are paid automatically less a small engagement
         fee.
      </p>
   </div>
</div>
<div class="container">
   <div id="main-video-tag" class="mt-5 mb-5 border-top">
      <div
         class="mb-5 mt-5"
         style="font-weight: bolder; font-size: 34px; text-align: center"
         >
         How does LocaL2LocaL work?
      </div>
      <div style="font-size: 20px; text-align: center">
         Check out the video below to see how we can assist you in
         getting things done!
      </div>
      <br /><br />
      <div style="text-align: center">
         <div
            id="carouselExampleControls"
            class="carousel slide"
            data-ride="carousel"
            data-interval="false"
            >
            <div class="carousel-inner">
               <!-- Carousel 0 -->
               <div class="carousel-item active">
                  <video
                     id="player1"
                     poster="images/market_poster.png"
                     class="video-edit l-to-l-video"
                     controls
                     autoplay
                     muted
                     loop
                     >
                     <source
                        src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/front-page-video_480.mp4"
                        />
                     Your browser does not support HTML5 video.
                  </video>
               </div>
               <!-- Carousel 1 -->
               <div class="carousel-item">
                  <video
                     id="player2"
                     class="video-edit l-to-l-video"
                     controls
                     autoplay
                     muted
                     >
                     <source
                        src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/media/video/1-l2lmain_480.mp4"
                        />
                     Your browser does not support HTML5 video.
                  </video>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--features-->
<section class="features_hm2" id="features_id">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="title color-white">
               <h2>Features:</h2>
            </div>
            <!--/.title-->
            <div class="single_feature_in2">
               <span class="icon cl1"
                  ><i class="fas fa-map-marker-alt"></i
                  ></span>
               <h4>Immediate Assistance</h4>
               <p>
                  One tap and a Service Provider comes directly to you. Payment is
                  safe via our secure Stripe payment gateway The LocaL2LocaL
                  community extends throughout the country.
               </p>
            </div>
            <!--/.single_feature_in2-->
            <div class="single_feature_in2">
               <span class="icon cl2"
                  ><i class="fas fa-hand-holding-usd"></i
                  ></span>
               <h4>On-Demand Service</h4>
               <p>
                  As a Service Seeker, you can book the services you need, anytime, anywhere. Subject to Service Provider availablity.
               </p>
            </div>
            <!--/.single_feature_in2-->
         </div>
         <div class="col-md-4">
            <div class="mid_img wow animated zoomIn" data-wow-delay="0.2s">
               <img src="{{config('app.frontend_resource_url')}}/img/app-screen/05.png" alt="" />
            </div>
         </div>
         <div class="col-md-4">
            <div class="single_feature_in2">
               <div class="icon cl3"><i class="fas fa-people-carry"></i></div>
               <h4>Real Time Tracking</h4>
               <p>
                  Track your Service Provider, live, using our Smart App. All you need is a location enabled device.
               </p>
            </div>
            <!--/.single_feature_in2-->
            <div class="single_feature_in2">
               <div class="icon cl4"><i class="fas fa-shield-alt"></i></div>
               <h4>Provider Selection</h4>
               <p>
                  As a Service Seeker, you can select a Service Provider and look at their profile before booking services.
               </p>
            </div>
            <!--/.single_feature_in2-->
            <div class="single_feature_in2">
               <div class="icon cl5"><i class="fab fa-codepen"></i></div>
               <h4>Fraud Protection</h4>
               <p>
                  We verify the information of every Service Provider that joins
                  our team. This helps us create a fraud-free environment at
                  LocaL2LocaL.
                  <br>
                  <Br>
               </p>
            </div>
            <!--/.single_feature_in2-->
         </div>
      </div>
   </div>
   <!--/.container-->
</section>
<!--features-->
<!--section-overview-->
<section class="apps_overview_se2" id="overview_id">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="overview_img_data">
               <img src="{{config('app.frontend_resource_url')}}/img/s011.png" alt="" />
               <img src="{{config('app.frontend_resource_url')}}/img/s022.png" class="wow fadeIn animated" alt="" />
            </div>
            <!--/.overview_img_data-->
         </div>
         <div class="col-md-5 offset-md-1">
            <div class="row h-100">
               <div class="col my-auto">
                  <div class="overview_contents">
                     <h3>Unique Tracking</h3>
                     <p>
                        The unique tracking once a job has been accepted gives an immediate response to allow for the continuation of your day without the indefinite wait time. <br> We understand that everybody is on a deadline and when something needs to be done now, we can’t wait. <br>This App allows you to visually see who in your local area can come to your aid and help with almost anything.
                     </p>
                     <a href="#" class="btn btn-style2">Try it Free Now</a>
                  </div>
                  <!--/.overview_contents-->
               </div>
            </div>
         </div>
         <div class="w-100 pt-120"></div>
         <div class="col-md-5">
            <div class="row h-100">
               <div class="col my-auto">
                  <div class="overview_contents">
                     <h3>In-App Messaging</h3>
                     <p>
                        Our in app messaging is available as soon as you receive your first offer on your job post until completion. Allowing both parties to immediately reach out via our private messaging system to discuss pricing, times, job details and more.
                     </p>
                     <a href="#" class="btn btn-style2">Sign Up for free Now</a>
                  </div>
                  <!--/.overview_contents-->
               </div>
            </div>
         </div>
         <div class="col-md-6 offset-md-1 p-4">
            <div class="overview_img_data second">
               <img class="img-responsive center-block d-block mx-auto" src="{{config('app.frontend_resource_url')}}/img/Untitled design-2.png" />
               <img src="" class="img-fluid" alt="" />
            </div>
            <!--/.overview_img_data-->
         </div>
      </div>
   </div>
   <!--/.container-->
</section>
<!--section-overview-->
<!--pricing-testimonials-->
<section class="pricing-testimonials-sec home2">
   <div class="container-fluid">
      <div class="owl-carousel" id="testimonial_slider_owl">
         <div>
            <div class="testimonials_inside_single">
               <i class="far fa-comment fa-rotate-270"></i>
               <i class="far fa-comment"></i>
               <h4>Local Reviews</h4>
               <p>
                  "Reff did an amazing job cleaning my apartment from top to bottom (inside & outside) . Her attention to detail is so impressive. Could not be more happ..."
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/ryan.jpg" alt="" />
               <h6><strong>Damian G</strong> - Deception Bay, QLD</h6>
            </div>
            <!--/.testimonials_inside_single-->
         </div>
         <div>
            <div class="testimonials_inside_single">
               <i class="far fa-comment fa-rotate-270"></i>
               <i class="far fa-comment"></i>
               <h4>Local Reviews</h4>
               <p>
                  "Perfectly done! They were very careful with my piano. Thanks for the hard work guys!"
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/Tai.jpg" alt="" />
               <h6><strong>Shibu T</strong> - Sydney, NSW</h6>
            </div>
            <!--/.testimonials_inside_single-->
         </div>
         <div>
            <div class="testimonials_inside_single">
               <i class="far fa-comment fa-rotate-270"></i>
               <i class="far fa-comment"></i>
               <h4>Local Reviews</h4>
               <p>
                  "Cannot recommend enough. 100% happy. Excellent finish and eye for detail. Mick really cares about the quality of the finish..."
               </p>
               <img src="{{config('app.frontend_resource_url')}}/img/tegan.jpg" alt="" />
               <h6><strong>Grant P</strong> - Mornington, VIC</h6>
            </div>
            <!--/.testimonials_inside_single-->
         </div>
      </div>
      <!--/#testimonial_slider_owl-->
   </div>
   <div class="container" id="pricing_id">
      <div class="row">
         <div class="w-100 pt-160"></div>
         <div class="col-md-4">
            <div class="row h-100">
               <div class="col my-auto">
                  <div class="title price_title">
                     <h2>Want to be your own boss?</h2>
                     <p>
                        You can register to be both a Service Seeker and a Service Provider
                        for free. It's free for a Service Provider to advertise their
                        business & services. So what are you waiting for?
                     </p>
                  </div>
                  <!--/.price_title-->
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="row">
               <div class="col">
                  <div class="price_single_in wow animated zoomIn">
                     <div class="head">
                        <h4>Seeker</h4>
                        <h4 class="p">Free<small></small></h4>
                     </div>
                     <ul>
                        <li>On-Demand Service</li>
                        <li>Real-Time Tracking</li>
                        <li>Provider Selection</li>
                        <li>Ratings and Reviews</li>
                     </ul>
                     <a href="#" class="btn btn-price">Get Started Now</a>
                  </div>
                  <!--/.price_single_in-->
               </div>
               <div class="col">
                  <div
                     class="price_single_in wow animated zoomIn"
                     data-wow-delay="0.2s"
                     >
                     <div class="head">
                        <h4>Provider</h4>
                        <h4 class="p">9%<small></small></h4>
                     </div>
                     <ul>
                        <li>First 3 months free</li>
                        <li>Be your own boss</li>
                        <li>Time Flexibility</li>
                        <li>Create Community</li>
                     </ul>
                     <a href="#" class="btn btn-price">Get Started Now</a>
                  </div>
                  <!--/.price_single_in-->
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/.container-->
</section>
<!--pricing-testimonials-->
<!--fun-fact-->
<div class="fun_fact_s home2">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center">
            <div class="count_title title">
               <h2>The easier way to work</h2>
               <p>
                  Local2Local is an application for fulfilling Immediate Services. This means that if you need something done ‘Now’, then LocaL2LocaL provides a method to connect with a Service Provider who is available to assist. <br>There are many services currently listed including trades, cars, pet care, handyman and tutoring. If you are able to assist a local, then create an account and select from the list of services you wish to provide. <br>In this day and age where having a full-time job or needing a second job is more necessary, the LocaL2LocaL platform allows you to choose what you can benefit your community with and then, in your time, become an active LocaL2LocaL Service Provider and attain payment for your service.
               </p>
            </div>
            <!--/.title-->
         </div>
         <div class="w-100 mt-30"></div>
         <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <div class="row">
               <div class="col">
                  <div class="single_fact_in wow animated fadeIn">
                     <h3><span class="counter">4,720</span></h3>
                     <p>Downloads</p>
                  </div>
                  <!--/.single_fact_in-->
               </div>
               <div class="col">
                  <div
                     class="single_fact_in wow animated fadeIn"
                     data-wow-delay="0.2s"
                     >
                     <h3><span class="counter">1,090</span>+</h3>
                     <p>Active Users</p>
                  </div>
                  <!--/.single_fact_in-->
               </div>
               <div class="col">
                  <div
                     class="single_fact_in wow animated fadeIn"
                     data-wow-delay="0.4s"
                     >
                     <h3><span class="counter">831</span>+</h3>
                     <p>Projects Done</p>
                  </div>
                  <!--/.single_fact_in-->
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/.container-->
</div>
<!--fun-fact-->
<!--screenshot-->
<div class="screenshot_h2" id="screenshot_id">
   <div class="container-fluid">
      <div class="row">
         <div class="col">
            <div class="title color-white text-center">
               <h2>The App</h2>
               <p>
                  This is a supportive community where we can share our skills and talents and give back to the local area with these attributes and earn extra money while doing so. <br>Locals helping Locals – Neighbours helping Neighbours The ‘need it now’ motto means exactly that, if you need it now, then someone local and nearby <br>will be able to lend a hand and get the job done.
               </p>
            </div>
            <!--/.title-->
         </div>
         <div class="w-100"></div>
         <div class="col-md-12">
            <div class="owl-carousel" id="screenshot_owl_2">
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/01.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/02.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/03.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/04.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/05.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
               <div>
                  <div class="ss_img">
                     <img src="{{config('app.frontend_resource_url')}}/img/app-screen/06.png" alt="" />
                  </div>
                  <!--/.ss_imgc-->
               </div>
            </div>
            <!--/#screenshot_owl_2-->
         </div>
      </div>
   </div>
   <!--/.container-fluid-->
</div>
<!--screenshot-->
<!--blog-->
<section class="recent_blogs pt-160" id="news_id">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center">
            <div class="count_title title">
               <h2>Stay in the loop with our weekly Blog</h2>
               <p>
                  <br>
               </p>
            </div>
            <!--/.title-->
         </div>
         <div class="w-100 mt-30"></div>
         <div class="col-md-4">
            <div class="blog_single_in wow animated zoomIn">
               <div class="img"></div>
               <!--simply use inline background-image-->
               <div class="content">
                  <ul class="meta">
                     <li><i class="far fa-calendar-alt"></i> 29 Sep, 2020</li>
                     <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                  </ul>
                  <h4>
                  <a href="https://blog.local2local.com.au/top-6-tips-when-renovating-for-profit">Top 6 Tips
                                when Renovating for Profit</a>
                  </h4>
               </div>
            </div>
            <!--/.blog_single_in-->
         </div>
         <div class="col-md-4">
            <div
               class="blog_single_in wow animated zoomIn"
               data-wow-delay="0.2s"
               >
               <div class="img img2"></div>
               <!--simply use inline background-image-->
               <div class="content">
                  <ul class="meta">
                     <li><i class="far fa-calendar-alt"></i> 29 Sep, 2020</li>
                     <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                  </ul>
                  <h4>
                  <a
                                href="https://blog.local2local.com.au/did-you-catch-local2local-featured-on-7-news-gold-coast">Did
                                you catch us on 7 News Gold Coast?</a>
                  </h4>
               </div>
            </div>
            <!--/.blog_single_in-->
         </div>
         <div class="col-md-4">
            <div
               class="blog_single_in wow animated zoomIn"
               data-wow-delay="0.4s"
               >
               <div class="img img3"></div>
               <!--simply use inline background-image-->
               <div class="content">
                  <ul class="meta">
                     <li><i class="far fa-calendar-alt"></i> 29 Sep, 2020</li>
                     <li><i class="fas fa-user"></i> <a href="#">Admin</a></li>
                  </ul>
                  <h4>
                  <a href="https://blog.local2local.com.au/how-to-launch-your-own-business-in-6-simple-steps">How
                                to Launch Your Own Business in 6 Simple Steps</a>
                  </h4>
               </div>
            </div>
            <!--/.blog_single_in-->
         </div>
      </div>
   </div>
   <!--/.container-->
</section>
<!--blog-->
@endsection