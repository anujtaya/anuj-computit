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
                              <h2>Keep in touch with us, <br>we are available 24/7 </h2>
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
               <!--contact-page-area-->
               <div class="contact-page-area pt-5">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8 offset-lg-1">
                           <div class="contact_inside_pg">
                              <h4>Contact Us</h4>
                              <form>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" placeholder="Name" />
                                    </div>
                                    <div class="col-md-6">
                                       <input type="email" class="form-control" placeholder="Email" />
                                    </div>
                                    <div class="col-md-6">
                                       <input type="number" class="form-control" placeholder="Phone" />
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" placeholder="Subject" />
                                    </div>
                                    <div class="col-md-12 mb-4">
                                       <textarea rows="4"  class="form-control" placeholder="Comment"></textarea>
                                       <button class="btn btn-style2" type="submit">Submit</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <!--/.contact_inside_pg-->
                        </div>
                        <div class="col-md-4 col-lg-3">
                           <div class="contact_page_sidebar">
                              <ul>
                                 <li>
                                    <div class="icon"><i class="far fa-envelope"></i></div>
                                    <a href="mailto@info@yourmail.com">info@local2local.com.au</a>
                                 </li>
                                 <li>
                                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                    <a href="tel:123456788">(07) 3871 1222</a>
                                 </li>
                                 <li>
                                    <div class="icon"><i class="fas fa-home"></i></div>
                                    <address>
                                       166 Wickham Terrace, Spring Hill 4000, QLD
                                    </address>
                                 </li>
                              </ul>
                           </div>
                           <!--/.contact_page_sidebar-->
                        </div>
                        <div class="col-md-12 col-lg-11 offset-lg-1">
                           <div class="map-style">
                              <div class="mapouter">
                                 <div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.126345183447!2d153.02236521546905!3d-27.465325682892704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b915a02ee5f0749%3A0x17696fb0ddd808d0!2s166%20Wickham%20Terrace%2C%20Brisbane%20City%20QLD%204000!5e0!3m2!1sen!2sau!4v1601429825834!5m2!1sen!2sau" width="750" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--/.container-->
               </div>
               <!--contact-page-area-->
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