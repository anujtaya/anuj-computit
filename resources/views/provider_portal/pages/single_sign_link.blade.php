
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>{{config('app.name')}} - @yield('title')</title>
      <link rel="stylesheet" href="{{asset('css/backend/provider_portal.css')}}?v={{rand(10,10000)}}">
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
      <div class="container p-4 text-center">
        @if(isset($link))
        <a href="{{$link->url}}" class="btn theme-background-color fs--1 btn-sm">Click here to proceed.</a>
        @else 
            <div class="alert alert-danger">An error occurred.</div>
            <a href="{{route('app_portal_provider_banking')}}" class="btn theme-background-color fs--1 btn-sm">Go Back</a>
        @endif
      </div>
   </body>
</html>
