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
               <meta http-equiv="X-UA-Compatible" content="IE=edge" />
               <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
               <meta charset="utf-8">
               <meta name="csrf-token" content="{{ csrf_token() }}" />
               <meta name="author" content="LocaL 2 LocaL Pty. Ltd.">
               <meta name="description"
                  content="An app that connects people to mobile service providers for immediate type services within the community. If you need it now, LocaL2LocaL it.">
               <meta name="revisit-after" content="1 days">
               <meta name="distribution" content="web">
               <meta name="keywords" content="Local2Local, LocaL2LocaL Australia,Book services,Instant help,package delivery" />
               <meta property="og:title" content="LocaL2Local – If you need it now, LocaL2Local it." />
               <meta property="og:description"
                  content="An app that connects people to mobile service providers for immediate type services within the community. If you need it now, LocaL2LocaL it." />
               <meta property="og:site_name" content="LocaL2LocaL Australia" />
               <meta property="og:type" content="article" />
               <meta property="og:url" content="https://local2local.com.au/" />
               <!-- <meta property="og:image" content="{{asset('/images/brand/main_logo_small_2-compressor.svg?v=1')}}" /> -->
               <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
               <title>@yield('title')</title>
               <!-- Standard Favicon -->
               <link rel="shortcut icon" href="{{config('app.frontend_resource_url')}}/img/fav/favicon.ico" />
               <!-- Touch Icons - iOS and Android 2.1+ -->
               <link rel="apple-touch-icon" href="{{config('app.frontend_resource_url')}}/img/fav/android-icon-48x48.png" />
               <link rel="apple-touch-icon" sizes="72x72"
                  href="{{config('app.frontend_resource_url')}}/img/fav/android-icon-72x72.png" />
               <link rel="apple-touch-icon" sizes="114x114"
                  href="{{config('app.frontend_resource_url')}}/img/fav/apple-icon-114x114.png" />
               <!--bootstrap v4.0.0-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/bootstrap.min.css" />
               <!--reset css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/normalize.css" />
               <!--menu css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/menu-maker.css" />
               <!--animate-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/animation.css" />
               <!--owl-carousel-->
               <!-- <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/owl.carousel.min.css" /> -->
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
               <link rel="stylesheet" type="text/css"
                  href="{{config('app.frontend_resource_url')}}/css/owl.theme.default.min.css" />
               <!--pop up css-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/magnific-popup.css" />
               <!--fontawesome cdn-->
               <link href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" rel="stylesheet" />
               <!--main style-->
               <link rel="stylesheet" type="text/css" href="{{config('app.frontend_resource_url')}}/css/style.css" />
               <!--fonts-->
               <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700,700i,800,800i&display=swap"
                  rel="stylesheet" />
               <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet" />
               <!-- custom style-->
               <link rel="stylesheet" type="text/css" href="{{secure_url('/css/common/custom.css')}}" />
               <!--modernizr-->
               <script src="{{config('app.frontend_resource_url')}}/js/vendor/modernizr.js"></script>
               <!--[if lt IE 9]>
               <script src="js/html5/respond.min.js"></script>
               <![endif]-->
               <!-- Global site tag (gtag.js) - Google Analytics -->
               <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122733731-1"></script>
               <script>
                  window.dataLayer = window.dataLayer || [];
                            function gtag(){dataLayer.push(arguments);}
                            gtag('js', new Date());
                            gtag('config', 'UA-122733731-1');
               </script>
               <!-- Google Tag Manager -->
               <script>
                  (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                            })(window,document,'script','dataLayer','GTM-NBP6NN5');
               </script>
               <!-- End Google Tag Manager -->
               @if (app()->environment() === 'production')
               <script>
                  ! function(f, b, e, v, n, t, s) {
                      if (f.fbq) return;
                      n = f.fbq = function() {
                          n.callMethod ?
                              n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                      };
                      if (!f._fbq) f._fbq = n;
                      n.push = n;
                      n.loaded = !0;
                      n.version = '2.0';
                      n.queue = [];
                      t = b.createElement(e);
                      t.async = !0;
                      t.src = v;
                      s = b.getElementsByTagName(e)[0];
                      s.parentNode.insertBefore(t, s)
                  }(window, document, 'script',
                      'https://connect.facebook.net/en_US/fbevents.js');
                  fbq('init', '1273619936159574');
                  fbq('track', 'PageView'); 
               </script> 
               <noscript> 
                  <img height="1"width="1" style="display:none" src="https://www.facebook.com/tr?id=1273619936159574&ev=PageView&noscript=1"/>
               </noscript>
               @endif
            </head>
            <body data-spy="scroll" data-target=".navbar" data-offset="60">
               @if (app()->environment() === 'production')
               <!-- Google Tag Manager (noscript) -->
               <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBP6NN5" height="0" width="0"
                  style="display:none;visibility:hidden"></iframe></noscript>
               <!-- End Google Tag Manager (noscript) -->
               @endif
               <div class="se-pre-con"></div>
               <!-- start header section -->
               <div class="header-logo-menu bg_cover">
                  <div class="container">
                     <div class="navigatin" id="main_nav_id">
                        <div class="row no-gutters">
                           <div class="col-lg-3" id="checkLogo">
                              <a class="navbar-brand" href="{{route('app_frontend_homepage')}}">
                                 <!-- <img src="img/logo.png" alt="menu"/> -->
                                 <img src="{{config('app.frontend_resource_url')}}/img/logo.svg" alt="menu" />
                              </a>
                           </div>
                           <div class="col-lg-9" id="checkNav">
                              @yield('topnav')
                              <div class="mobile-menu"></div>
                           </div>
                        </div>
                        <!-- row -->
                     </div>
                  </div>
                  <!-- container -->
               </div>
               <!-- end of header section -->
               <!-- main content -->
               @yield('content')
               <!-- end main content -->
               <!--footers-->
               <footer class="footers">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="footer_content">
                              <h3>Now Available On</h3>
                              <a href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8"><img
                                 src="{{config('app.frontend_resource_url')}}/img/icon/btn1.png" alt="" /></a>
                              <a
                                 href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US"><img
                                 src="{{config('app.frontend_resource_url')}}/img/icon/btn2.png" alt="" /></a>
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
                                       2021 Copyright LocaL2LocaL <a href="#"></a> . All Rights
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
               <!-- <script src="{{config('app.frontend_resource_url')}}/js/vendor/owl-carousel.js"></script> -->
               <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"></script>
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