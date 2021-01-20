<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <meta name="description" content="">
      <meta name="author" content="LocaL2LocaL - Anuj Taya (Computit Pty. Ltd.)">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>Landing Page</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      @stack('header-style')
      <script src="{{asset('lib/fa/js/all.min.js')}}"></script>
      <!-- theme css -->
      <link rel="stylesheet" href="{{asset('css/backend/main_sp.css')}}?v={{rand(100,10000)}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      @stack('header-script')
      <style>
         html,body,h1,h2,h3,h5,h6,p,button,a,label {
         font-family: 'Varela Round', sans-serif!important;
         color: #575757!important;
         
         /* width: 100%; */
         }
         html {
         scroll-behavior: smooth;
         height: 100%;
         }
         * {
            -webkit-touch-callout: none;
            /* -webkit-user-select: none; Disable selection/copy in UIWebView */
         }
      </style>
   </head>
   <body >
      <input type="hidden" name="android_user_id" id="android_user_id" value="'{'user_id':'{{Auth::id()}}','cat':'WP'}'">
      <input type="hidden" name="android_csrf_token_id" id="android_csrf_token_id" value="{{csrf_token()}}" >
      <div id="app">
         <main class="py-0 d-lg-noneq">
            @yield('content')
         </main>

      </div>

      <!-- <div class="d-none d-xl-block  container text-danger p-3 mt-5 text-center">
            <i class="fas fa-desktop display-1"></i> <br><br>
            Desktop version not suported. Please switch to mobile or tablet view to see the content.
         </div> -->
      <div id="anim-1" style="background:rgba(255, 252, 252, 0.68);position:fixed;top:0;left:0;z-index:10000!important;height:100%;width:100%;display:none!important;">
         <div class="text-center" style="margin-top:250px;">
            <img src="{{secure_url('/images/brand/l2l-logo-svg.svg')}}" class="fa-spin spin" height="60" width="60">
         </div>
         <div class="text-center ml-4 mr-4 d-none" style="margin-top:20px;" id="anim-2">
         </div>
      </div>
      <!-- <span class="fixed-top text-right pt-3 pr-2" style="position:fixed;top:0;right:0;z-index:10000!important;">
         <a href="{{route('login')}}" onclick="toggle_animation(true);" class="bg-dark text-white p-2 fs--2" style="opacity:0.6;">Login</a>
      </span> -->
      <script>
         @yield('customjavascripts')

         var app_url = "{{secure_url('/')}}";
         var csrf_token = "{{csrf_token()}}";

         function toggle_animation(a,m){
         var e = document.getElementById("anim-1");
         if(a == true) {
          e.style.display = "block";
         } else {
         e.style.display = "none";
         }
         if(m != null) {
         document.getElementById("anim-2").innerHTML = m;
         }
         }
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <!-- <script src="{{asset('custom.js')}}"></script> -->
   </body>
</html>
