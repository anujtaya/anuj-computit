<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
   <![endif]-->
   <!--[if IE 7]>         
   <html class="no-js lt-ie9 lt-ie8">
      <![endif]-->
      <!--[if IE 8]>         
      <html class="no-js lt-ie9">
         <![endif]-->
         <!--[if gt IE 8]><!-->
         <html lang="en" class="no-js">
            <!--<![endif]-->
            <head>
               <meta charset="utf-8" />
               <meta http-equiv="X-UA-Compatible" content="IE=edge" />
               <meta
                  name="viewport"
                  content="width=device-width, initial-scale=1, shrink-to-fit=no"
                  />
               <meta name="description" content="" />
               <meta name="author" content="" />
               <title>Home</title>
               <!-- Standard Favicon -->
               <link rel="icon" href="img/fav.svg" />
               <!-- Touch Icons - iOS and Android 2.1+ -->
               <link rel="apple-touch-icon" href="{{config('app.frontend_resource_url')}}/img/fav/android-icon-48x48.png" />
               <link
                  rel="apple-touch-icon"
                  sizes="72x72"
                  href="{{config('app.frontend_resource_url')}}/img/fav/android-icon-72x72.png"
                  />
               <link
                  rel="apple-touch-icon"
                  sizes="114x114"
                  href="{{config('app.frontend_resource_url')}}/img/fav/apple-icon-114x114.png"
                  />
               <!--bootstrap v4.0.0-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/bootstrap.min.css" />
               <!--reset css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/normalize.css" />
               <!--menu css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/menu-maker.css" />
               <!--animate-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/animation.css" />
               <!--owl-carousel-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/owl.carousel.min.css" />
               <link
                  rel="stylesheet"
                  type="text/css"
                  href="{{config('app.frontend_resource_url')}}/css/owl.theme.default.min.css"
                  />
               <!--pop up css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/magnific-popup.css" />
               <!--fontawesome cdn-->
               <link
                  href="https://use.fontawesome.com/releases/v5.9.0/css/all.css"
                  rel="stylesheet"
                  />
               <!--main style-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/style.css" />
               <!--fonts-->
               <link
                  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700,700i,800,800i&display=swap"
                  rel="stylesheet"
                  />
               <link
                  href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap"
                  rel="stylesheet"
                  />
               <!--modernizr-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/modernizr.js"></script>
               <!--[if lt IE 9]>
               <script src="js/html5/respond.min.js"></script>
               <![endif]-->
            </head>
            <body data-spy="scroll" data-target=".navbar" data-offset="60">
               <div class="se-pre-con"></div>
               <!-- start header section -->
               <div class="header-logo-menu bg_cover">
                  <div class="container">
                     <div class="navigatin" id="main_nav_id">
                        <div class="row no-gutters">
                           <div class="col-lg-3">
                              <a class="navbar-brand" href="{{route('app_frontend_homepage')}}">
                                 <!-- <img src="img/logo.png" alt="menu"/> -->
                                 <img src="{{config('app.frontend_resource_url')}}/img/logo.svg" alt="menu" />
                              </a>
                           </div>
                           <div class="col-lg-9">
                              <nav id="mobile-menu" class="main-menu">
                                 <ul>
                                    <li>
                                       <a href="{{route('app_frontend_homepage')}}">Home</a>
                                       <!-- <ul class="sub-menu">
                                          <li><a href="index.html">home1</a></li>
                                          <li><a href="index-2.html">Home 02</a></li>
                                          <li><a href="index-3.html">Home 03</a></li>
                                          <li><a href="index-4.html">Home 04</a></li>
                                          </ul> -->
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
                                    <li class="current">
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
                              <!-- nav -->
                              <div class="mobile-menu"></div>
                           </div>
                        </div>
                        <!-- row -->
                     </div>
                  </div>
                  <!-- container -->
               </div>
               <!-- end of header section -->
               <!--hero_section-->
               <header class="broadcamp_pages blog">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="broadcamp_inside_co title">
                              <h2>Want to know more?<br> Check out our list of FAQ's below. </h2>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--/.container-->
                  <div class="shape">
                     <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem1.png" class="shape1" alt=""/>
                     <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem2.png" class="shape2" alt=""/>
                     <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem3.png" class="shape3" alt=""/>
                     <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem4.png" class="shape4" alt=""/>
                  </div>
               </header>
               <!--hero_section-->
               <!--blog-content-->
               <section class="blog_pages_main pt-5 ">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8 col-lg-7">
                           <div class="single_blog_page_in blog_single">
                              <div class="images">
                                 <img src="{{config('app.frontend_resource_url')}}/img/blog-bg-2.jpg" alt=""/>
                                 <div class="overlay">
                                    <ul class="meta">
                                       <!-- <li>Novermber 05, 2018</li> -->
                                       <li>By <a href="#">Admin</a></li>
                                    </ul>
                                    <h4>FREQUENTLY ASKED QUESTIONS</h4>
                                 </div>
                              </div>
                           </div>
                           <!--/.single_blog_page_in-->
                        </div>
                     </div>
                  </div>
                  <!--/.container-->
               </section>
               <!--blog-content-->
               <div class="container h1-title">
                  <div class="p-2 m-1">
                     <h1><strong>FAQ's</strong></h1>
                  </div>
                  <div class="mb-md">
                     <h4 class="mb-4" id="customization"></h4>
                     <!-- Accordion -->
                     <div id="accordion-2" class="accordion accordion-spaced">
                        <!-- Accordion card 1 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-1" data-toggle="collapse" role="button" data-target="#collapse-2-1" aria-expanded="false" aria-controls="collapse-2-1">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>What is Local2LocaL?</h6>
                           </div>
                           <div id="collapse-2-1" class="collapse" aria-labelledby="heading-2-1" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>An easy to use online platform that helps people to request services like car repairs,dog walking, house cleaning, parcel delivery, just to name a few, from people around them. LocaL2LocaL is a community-based real-time help service.</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 2 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-2" data-toggle="collapse" role="button" data-target="#collapse-2-2" aria-expanded="false" aria-controls="collapse-2-2">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>What types of jobs are available on LocaL2LocaL?</h6>
                           </div>
                           <div id="collapse-2-2" class="collapse" aria-labelledby="heading-2-2" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>Almost anything you can think of with the list of categories expanding regularly as suggestions are made. As the platform expands and more Service Providers get on-board and realise their skills can make them extra money after work even if its “not your day job”, the list of jobs will be almost endless.</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 3 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-3" aria-expanded="false" aria-controls="collapse-2-3">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>Who can request a job?</h6>
                           </div>
                           <div id="collapse-2-3" class="collapse" aria-labelledby="heading-2-3" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>Anyone with a device and the capability to download an App can request a job (under 18 year olds need to have a parent or guardians approval).</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 4 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-4" aria-expanded="false" aria-controls="collapse-2-4">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>Who is a Service Provider?</h6>
                           </div>
                           <div id="collapse-2-4" class="collapse" aria-labelledby="heading-2-4" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>A Service Provider is someone who can offer their services, skills or talents on the LocaL2LocaL App and complete the job for the Service Seeker who requested them.</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 5 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-5" aria-expanded="false" aria-controls="collapse-2-5">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>Who is a Service Seeker?</h6>
                           </div>
                           <div id="collapse-2-5" class="collapse" aria-labelledby="heading-2-5" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>A Service Seeker is a person who needs a job done.</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 6 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-6" aria-expanded="false" aria-controls="collapse-2-6">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>What is unique about LocaL2LocaL?</h6>
                           </div>
                           <div id="collapse-2-6" class="collapse" aria-labelledby="heading-2-6" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>LocaL2LocaL has the unique advantage of real time tracking of the requested job. If a Service Seeker has a job they need done immediately and there is a Service Provider nearby who accepts the job, they can track them from the acceptance of the job. This eliminates the window of time that some trades offer as to when they will arrive and gives real time updates as they travel to your job. You can now plan your day and not be left wondering.</p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 9 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-9" data-toggle="collapse" role="button" data-target="#collapse-2-9" aria-expanded="false" aria-controls="collapse-2-9">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>What is the Local2LocaL Service Fee?</h6>
                           </div>
                           <div id="collapse-2-9" class="collapse" aria-labelledby="heading-2-9" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>The total Service Fee amount charged will always be clearly displayed. The Service Fee will only be payable once a job has been accepted by a Service Provider.
                                    All service fees are subject to GST, which will be clearly displayed on the invoice.
                                    A Service fee is charged for all payments made through the LocaL2LocaL payment gateway (Stripe)
                                    If a cancellation occurs a service fee may still be charged.
                                 </p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 10 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-10" data-toggle="collapse" role="button" data-target="#collapse-2-10" aria-expanded="false" aria-controls="collapse-2-10">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>What is Stripe?</h6>
                           </div>
                           <div id="collapse-2-10" class="collapse" aria-labelledby="heading-2-10" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>Stripe helps to power 100,000+ businesses in 100+ countries and across nearly every industry. Headquartered in San Francisco, Stripe has 9 global offices and hundreds of people working to help transform how modern businesses are built and run. Data security is of utmost importance to Stripe. They invest heavily in securing their infrastructure in close partnership with world-class security experts.• All card numbers are encrypted on disk with AES-256. Decryption keys are stored on separate machines.
                                    Stripe’s infrastructure for storing, decrypting, and transmitting card numbers runs in separate hosting infrastructure, and doesn’t share any credentials with Stripe’s primary services.
                                    Click here to visit Stripe Inc.
                                 </p>
                              </div>
                           </div>
                        </div>
                        <!-- Accordion card 11 -->
                        <div class="card shadow-lg">
                           <div class="card-header py-4" id="heading-2-11" data-toggle="collapse" role="button" data-target="#collapse-2-11" aria-expanded="false" aria-controls="collapse-2-11">
                              <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>How much does Local2LocaL charge?</h6>
                           </div>
                           <div id="collapse-2-11" class="collapse" aria-labelledby="heading-2-11" data-parent="#accordion-2">
                              <div class="card-body">
                                 <p>You can register to be both a Service Seeker and a Service Provider for free. It is also free for a Service Provider to advertise their business & personal services. A Service Provider nominates the amount they wish to be paid either per job or per hour. When a Service Seeker engages you to do a job, the nominated amount is secured from the Service Seeker’s credit card and placed on hold. When the Service Provider completes the job, they are paid automatically less a small engagement fee of 9%.
                                    Local2Local will send both the Service Seeker and Service Provider a receipt and tax invoice for the transaction.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Scroll to top -->
                     <div class="text-right py-4">
                        <a href="#customization" data-scroll-to="" data-scroll-to-offset="50" class="text-sm font-weight-bold">Back to top<i class="far fa-long-arrow-alt-up ml-2"></i></a>
                     </div>
                  </div>
               </div>
               <!--footers-->
               <footer class="footers">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="footer_content">
                              <h3>Now Available On</h3>
                              <a
                                 href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8"
                                 ><img src="{{config('app.frontend_resource_url')}}/img/icon/btn1.png" alt=""
                                 /></a>
                              <a
                                 href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US"
                                 ><img src="{{config('app.frontend_resource_url')}}/img/icon/btn2.png" alt=""
                                 /></a>
                           </div>
                           <!--/.footer_content-->
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                           <div class="copyright_con">
                              <div class="row">
                                 <div class="col">
                                    <img class="f_logo" src="{{config('app.frontend_resource_url')}}/img/logo.svg" alt="" />
                                 </div>
                                 <div class="col my-auto text-right">
                                    <p>
                                       2020 Copyright LocaL2LocaL <a href="#"></a> . All Rights
                                       Reserved
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <!--/.copyright_con-->
                        </div>
                     </div>
                  </div>
                  <!--/.container-->
                  <img src="{{config('app.frontend_resource_url')}}/img/footer_mock1.png" class="f-left" alt="" />
                  <img src="{{config('app.frontend_resource_url')}}/img/footer_mock2.png" class="f-right" alt="" />
               </footer>
               <!--footers-->
               <!--<div data-aos="fade-up" data-aos-anchor=".other-element"></div>-->
               <!--jquery-->
               <script src="{{config('app.frontend_resource_url')}}/js/jquery-1.12.4.min.js"></script>
               <!--bootstrap v4 js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/bootstrap.min.js"></script>
               <!--popper js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/popper.min.js"></script>
               <!--menu js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/menu.js"></script>
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/one-page.js"></script>
               <!--moving js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/moving.js"></script>
               <!--counter js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/counter.js"></script>
               <!--owl carousel -->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/owl-carousel.js"></script>
               <!--magnifice popup-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/magnifice-js.js"></script>
               <!--wow-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/wow.js"></script>
               <!--easing js-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/easing.js"></script>
               <!--main script-->
               <script src="{{config('app.frontend_resource_url')}}/js/main.js"></script>
            </body>
         </html>