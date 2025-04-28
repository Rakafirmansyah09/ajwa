<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{$pageTilte ?? 'Dashboard'}} - AJWA</title>



   <link rel="shortcut icon" href="{{asset('asset/picture/logoajwa.png')}}" type="image/x-icon">

   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app-dark.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/iconly.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/extensions/@fortawesome/fontawesome-free/css/all.css') }}">

   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/auth.css')}}">
   @yield('css')

   <style>
      /* template toast */
      .toast-container {
         position: fixed;
         top: 1rem;
         right: 1rem;
         z-index: 1050;
      }
   </style>

</head>

<body>
   <script src="{{ asset('mazer/static/js/initTheme.js') }}"></script>
   <div id="auth">

      <div class="row h-100">
         <div class="col-lg-5 col-12">
            @yield('content')
         </div>
         <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
         </div>
      </div>

   </div>

   @yield('js')
   <script src="{{ asset('mazer/compiled/js/app.js') }}"></script>

   @include('template.notif')
</body>

</html>