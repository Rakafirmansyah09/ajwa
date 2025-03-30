<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>{{$pageTitle ?? 'Dashboard'}} - AJWA</title>
   <link rel="shortcut icon" href="{{asset('asset/picture/logoajwa.png')}}" type="image/x-icon">

   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app-dark.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/iconly.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/extensions/@fortawesome/fontawesome-free/css/all.css') }}">
   <style>
      /* template toast */
      .toast-container {
         position: fixed;
         top: 1rem;
         right: 1rem;
         z-index: 1050;
      }

      /* page conten */
      #main .card .card-header {
         padding-bottom: 10px;
      }

      #main .card {
         margin-bottom: 20px;
      }

      #main-body {
         min-height: calc(100vh - 110px);
      }
   </style>
   @yield('css')
</head>

<body>
   <script src="{{ asset('mazer/static/js/initTheme.js') }}"></script>
   <div id="app">
      @include('template.sidebar')

      <div id="main">
         <div id="main-body">
            @yield('main')
         </div>

         @include('template.footer')
      </div>
   </div>
   @include('template.notif')
   <script src="{{ asset('mazer/extensions/jquery/jquery.js') }}"></script>
   <script src="{{ asset('mazer/static/js/components/dark.js') }}"></script>
   <script src="{{ asset('mazer/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

   <script src="{{ asset('mazer/compiled/js/app.js') }}"></script>
   @yield('js')





</body>

</html>