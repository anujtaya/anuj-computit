<html lang="en">
   <head>
   <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>Landing Page</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      @stack('header-style')
      <script src="https://kit.fontawesome.com/bcffd7c145.js" crossorigin="anonymous"></script>
      <!-- theme css -->
      <link rel="stylesheet" href="{{asset('css/backend/main.css')}}?v={{rand(10,10000)}}">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      @stack('header-script')
      <style>
         html,body,h1,h2,h3,h5,h6,p,button,a,label {
         font-family: 'Varela Round', sans-serif!important;
         color: #575757!important;
         }
         html {
         scroll-behavior: smooth;
         }
      </style>
   </head>
   <body>
      <div id="app">
         <main class="py-0">
            @yield('content')
         </main>
      </div>
      @include('partial.loader')

      <script>
         @yield('customjavascripts')






         function main_btn_status(btn_id) {
               var btn = document.getElementById(btn_id);
               if(typeof(btn) != 'undefined' && btn != null){
                  btn.innerHTML = "<div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div>";
                  btn.disabled = true;
                  btn.classList.add("disabled");
               } else{
                  console.log('err: element not found : for loading');
               }
         }
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <!-- <script src="{{asset('custom.js')}}"></script> -->
   </body>
</html>
