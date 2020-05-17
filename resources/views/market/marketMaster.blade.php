<!DOCTYPE html>
<html lang="en">
   <head>
      <title>@yield('title')</title>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <meta name="author" content="LocaL 2 LocaL Pty. Ltd.">
      <meta name="description" content="An app that connects people to mobile service providers for immediate type services within the community. If you need it now, LocaL2LocaL it.">
      <link rel="apple-touch-icon" sizes="57x57" href="./images/favicon/apple-icon-57x57.png">
      <meta name="revisit-after" content="1 days">
      <meta name="distribution" content="web">
      <meta name="keywords" content="Local2Local, LocaL2LocaL Australia,Book services,Instant help,package delivery" />
      <meta property="og:title" content="LocaL2Local – If you need it now, LocaL2Local it." />
      <meta property="og:description" content="An app that connects people to mobile service providers for immediate type services within the community. If you need it now, LocaL2LocaL it." />
      <meta property="og:site_name" content="LocaL2LocaL Australia" />
      <meta property="og:type" content="article" />
      <meta property="og:url" content="https://local2local.com.au/" />
      <meta property="og:image" content="{{asset('/images/brand/l2l-logo-svg?v=1')}}" />
      <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122733731-1"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'UA-122733731-1');
      </script>
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-NBP6NN5');
      </script>
      <!-- End Google Tag Manager -->
      <link rel="apple-touch-icon" sizes="60x60" href="./images/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="./images/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="./images/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="./images/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="./images/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="./images/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="./images/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="./images/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="./images/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
      <link rel="manifest" href="./images/favicon/manifest.json">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>       
      <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
      @yield('scripts')
      <style>
         body {
         margin: 0;
         padding: 0;
         width: 100%;
         letter-spacing: 0em !important;
         font-weight:400;
         }
         title {
         font-size: 50px;
         color:white;
         }
         .body-text {
         font-size: 20px;
         color:white;
         }
         .zoom:hover {
         transform: scale(1.4);
         }
         .alto-margin {
         margin-right:5px!important;
         }    
         .col-container {
         display: table !important; 
         width: 100%; 
         }
         .col {
         display: table-cell !important; 
         }         
         hr{
         border-color:green;
         }
         .small_font {
         font-size: 15px!important;
         }
         .super_margin_top {
         margin-top:60px!important;
         }
         .marketing_image {
         background: url("./marketImages/a.jpg");
         min-height:200px!important;
         background-size: cover;
         }
         .font_title {
         font-size: 30px!important;
         }
         .font_title_small {
         font-size: 18px!important;
         }
         .icon_font_large {
         font-size: 50px!important;
         }
         .center_div{
         margin: 0 auto;
         width:360px!important;
         }
         .font_title_small {
         font-size: 15px!important;
         }
         nav-item,body,html {
         font-family: "Helvetica Neue", Helvetica, sans-serif !important;
         font-size:14px!important;
         }
         .menu-link {
         padding:10px!important;
         font-size:16px!important;
         margin-top:20px!important;
         color:black;
         text-decoration:none!important;
         }
         .feedback {
         background-color : #31B0D5;
         color: white;
         padding: 10px 20px;
         border-radius: 4px;
         border-color: #46b8da;
         }

         #mybutton {
         position: fixed;
         bottom: -4px;
         left: 10px;
         }
         
      </style>
      @if (app()->environment() === 'production')
      <!-- Facebook Pixel Code -->
      <script>
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window,document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '408839122989089'); 
         fbq('track', 'PageView');
      </script>
      <noscript>
         <img height="1" width="1" 
            src="https://www.facebook.com/tr?id=408839122989089&ev=PageView
            &noscript=1"/>
      </noscript>
      <!-- End Facebook Pixel Code -->
      @endif
   </head>
   <body class="bg bg-light small_font" >
      @if (app()->environment() === 'production')
      <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBP6NN5"
         height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) --> 
      @endif
      <div class="container  bg-white">
         <nav class=" navbar navbar-expand-lg border-bottom" >
            <a class="navbar-brand" href="{{secure_url('/')}}"> <img src="{{asset('/images/brand/l2l-logo-svg.svg?v=2')}}" width="50" height="50" alt="LocaL2LocaL Logo" class=" w3-white w3-circle d-inline-block align-top" title="LocaL2LocaL Logo"> </a>
            <a class="navbar-brand  " href="{{secure_url('/')}}">  <span class="menu-link"><strong>LocaL2LocaL</strong></span> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="menu_transition()" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="material-icons w3-xxlarge" id="tag">menu</i>
            </button>
            <div class="collapse navbar-collapse small_font" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item ">
                     <a class="manu-link mr-2 btn btn-primary" href="{{secure_url('/root')}}" >
                     <strong>Login</strong>
                     </a>
                  </li>
                  <li class="nav-item ">
                     <a class="menu-link" href="https://blog.local2local.com.au" >
                             Blog </a>
                  </li>
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketServiceProviders')}}" >
                     Service Provider
                     </a>
                  </li>
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketClients')}}" >
                     Service Seeker
                     </a>
                  </li>
                  <!--<li class="nav-item ">-->
                  <!--   <a class="menu-link" href="{{secure_url('/market_business')}}" >-->
                  <!--   For Business-->
                  <!--   </a>-->
                  <!--</li>-->
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketCategories')}}">
                     Service Categories
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="menu-link" href="{{secure_url('/marketAbout')}}">
                     About
                     </a>
                  </li>
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketFAQ')}}">
                     FAQ
                     </a>
                  </li>
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketDownloadApp')}}">
                     Download App
                     </a>
                  </li>
                  
                 
                  <li class="nav-item ">
                     <a class="menu-link" href="{{secure_url('/marketHelp')}}">
                       Help
                     </a>
                  </li>
                  
                  
               </ul>
            </div>
         </nav>
      </div>
      <div class="child_content">
         @yield('content')
      </div>
      <div class="market_footer   w3-small">
         <div class="container w3-black">
            <div class="row ">
               <div class="col-sm w3-padding">
                  <div class="row w3-padding w3-margin">
                     <div class="col- ">
                        <p class="font_title_small">Office</p>
                        P.O. Box 6</br>
                        Toowong, Brisbane, QLD 4066 Australia
                     </div>
                  </div>
               </div>
               <div class="col-sm w3-padding">
                  <div class="row w3-padding w3-margin">
                     <div class="col- ">
                        <p class="font_title_small ">Contact Us</p>
                        <a href="mailto:info@local2local.com.au" class="w3-text-white">Email - info@local2local.com.au</a> </br>
                        <a href="tel:1300443507" class="w3-text-white">Online Support</a>
                     </div>
                  </div>
               </div>
               <div class="col-sm w3-padding">
                  <div class="row w3-padding w3-margin">
                     <div class="col- ">
                        <p class="font_title_small"> Legal</p>
                        <a href="{{secure_url('/marketPolicy')}}" class="w3-text-white"> Terms of use  </a></br>
                        <a href="{{secure_url('/marketSafety')}}" class="w3-text-white">Security</a>
                     </div>
                  </div>
               </div>
               <div class="col-sm w3-padding">
                  <div class="row w3-padding w3-margin">
                     <div class="col- ">
                        <p class="font_title_small">Social Links </p>
                        <a href="https://facebook.com/local2localapp/" target="_blank" class="w3-text-white"><i class="fab fa-facebook w3-xlarge"></i> Facebook</a></br>
                        <a href="https://www.instagram.com/local2localapp/" class="w3-text-white"><i class="fab fa-instagram w3-xlarge"></i> Instagram</a> </br>
                     </div>
                  </div>
               </div>
               <div class="col-sm w3-padding">
                  <div class="row w3-padding w3-margin">
                     <div class="col- ">
                        <p class="font_title_small">Download </p>
                        <a href="https://apps.apple.com/app/id1367359034/"><img src="./images/market/market_ios_badge.svg" height="40px" width="100px" alt="Apple Store App Store Badge Icon"/> </a></br>
                        <a href="http://play.google.com/store/apps/details?id=com.local2localcompany.trackingservice&hl=en_US>"><img src="./images/market/market_android_badge.svg"  height="40px" width="100px"  alt="Play Store  Badge Icon" /> </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="w3-row">
               <p class="w3-margin w3-center w3-tiny">&copy; 2018 Local2Local Pty. Ltd. ABN 67 625 654 613 </p>
            </div>
         </div>
      </div>



      <div id="mybutton" class="d-block d-sm-none d-md-block d-lg-none">
         <a class="btn btn-primary w3-card mb-4" href="{{url('/login')}}"><i class="fas fa-arrow-left"></i> Back to App</a>
      </div>


      <script>
         function myFunction() {
             var x = document.getElementById("demo");
             if (x.className.indexOf("w3-show") == -1) {
                 x.className += " w3-show";
             } else { 
                 x.className = x.className.replace(" w3-show", "");
             }
         }
         function menu_transition(){
            var content = document.getElementById("tag").innerHTML;
            if(content === "cancel") {
            document.getElementById("tag").innerHTML = "menu";
            }
            else if(content === "menu") {
                document.getElementById("tag").innerHTML = "cancel";
            }
         }
      </script>
   </body>
</html>