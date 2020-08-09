<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>{{config('app.name')}} - @yield('title')</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <!-- google font -->
      <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Arimo|Poppins&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('lib/snackbar/snackbar.min.css')}}"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
      <script src="{{asset('scripts/jquery.form.min.js')}}?v=2"></script>
      @stack('header-style')
      <script src="{{asset('lib/fa/js/all.min.js')}}"></script>
      <script src="{{asset('lib/snackbar/snackbar.min.js')}}"></script> 
      <!-- theme css -->
      <link rel="stylesheet" href="{{asset('css/backend/admin_portal.css')}}?v={{rand(10,10000)}}">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      @stack('header-script')
      <style>

         html, body {
         height: 100%;
         font-family: 'Arimo', sans-serif;
         font-size:13px!important;
         }
         html {
         scroll-behavior: smooth;
         }
         .svg-inline--fa{
            font-size:18px;
         }
      </style>
   </head>
   <body class="bg-light">
   <nav  class="navbar  navbar-expand-lg bg-dark  card-1   sticky-top">
         <div class="container-fluid p-0">
            <a class="navbar-brand" href="{{route('app_portal_provider_home')}}"> 
            <img class="p-1 rounded-circle bg-white"  src="{{asset('/images/brand/l2l-logo-svg.svg')}}" height="40" width="40px" /> 
            </a>
            <button type="button" id="sidebarCollapse" class="btn btn-light rounded-0 border m-0">
            <i class="fas fa-bars"></i> 
            </button>
         </div>
      </nav>
      <div class="wrapper">
         <nav id="sidebar" class="p-1 bg-white border-rights card-1 "> 
           
          @include('admin_portal.layouts.side_nav')
         </nav>
         <!-- Page Content -->
         <div id="content" class=" ">
            <div class="row m-2">
               @if(Session::has('status'))

                  <div class="col-lg-12 p-3">
                     <div class="alert alert-info">{{Session::pull('status')}}</div>
                  </div>
               @endif
               @if(Session::has('error'))

<div class="col-lg-12 p-2">
   <div class="alert alert-danger">{{Session::pull('error')}}</div>
</div>
@endif
            
            </div>
            @yield('content')
         </div>
      </div>
      @include('partial.loader')
      <script>
      @yield('customjavascripts')
      $(document).ready(function () {
         
         $('#sidebarCollapse').on('click', function () {
         $('#sidebar').toggleClass('active');
         });
         
         });
   </script>
   

   

   </body>
</html>
