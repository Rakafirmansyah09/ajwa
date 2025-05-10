<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $pageTilte ?? 'Dashboard' }} - AJWA</title>

   <link rel="shortcut icon" href="{{ asset('asset/picture/logoajwa.png') }}" type="image/x-icon">

   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app-dark.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/compiled/css/iconly.css') }}">
   <link rel="stylesheet" href="{{ asset('mazer/extensions/@fortawesome/fontawesome-free/css/all.css') }}">

   @yield('css')

   <style>
      body {
         margin: 0;
         padding: 0;
         min-height: 100vh;
         background: url("{{ asset('asset/picture/backgroudAuth.jpg') }}") no-repeat center center fixed;
         background-size: cover;
         display: flex;
         justify-content: center;
         align-items: center;
         position: relative;
      }

      body::before {
         content: "";
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         backdrop-filter: blur(6px);
         z-index: 0;
      }

      .container-auth {
         z-index: 1;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
      }

      .logo-auth {
         margin-bottom: 1.5rem;
      }

      .logo-auth img {
         height: 100px;
      }

      .card {
         border-radius: 10px;
         padding: 1rem 2rem;
         width: 100%;
         max-width: 700px;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      }

      .auth-title {
         text-align: center;
         font-size: 1.8rem;
         margin-bottom: 0.5rem;
      }

      .auth-subtitle {
         text-align: center;
         color: #666;
      }

      .toast-container {
         top: 5px;
         right: 5px;
      }
   </style>
</head>

<body>

   <div class="container-auth">
      <div class="logo-auth">
         <img src="{{ asset('asset/picture/logoajwa.png') }}" alt="Logo AJWA">
      </div>

      @yield('content')
   </div>

   @yield('js')
   <script src="{{ asset('mazer/compiled/js/app.js') }}"></script>
   @include('template.notif')

</body>

</html>