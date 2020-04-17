<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>{{config('app.name')}} - @yield('title')</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <!-- google font -->
      <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

      @stack('header-style')
      <script src="{{asset('lib/fa/js/all.js')}}"></script>
      <!-- theme css -->
      <link rel="stylesheet" href="{{asset('css/backend/provider_portal.css')}}?v={{rand(10,10000)}}">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

      @stack('header-script')

      <style>

         html,body {
         font-family: 'Varela Round', sans-serif!important;
         color: #575757!important;
         background:#f7f7f9!important;
         }
         html {
         scroll-behavior: smooth;
         }
      </style>
   </head>
   <body>
      <div class="container">
          @include('provider_portal.layout.side_nav')
         <div class="content">
            @include('provider_portal.layout.top_nav')
            @yield('content')
         </div>
      </div>
      
      @include('partial.loader')
      <script>
      @yield('customjavascripts')
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   </body>
</html>
