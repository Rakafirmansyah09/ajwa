@extends('template.index')

@section('css')
<style>
   #error {
      padding: 2rem 0;
   }

   #error .img-error {
      height: 435px;
      object-fit: contain;
      padding: 3rem 0
   }

   #error .error-title {
      font-size: 3rem;
      margin-top: 1rem
   }
</style>
@endsection

@section('main')
<div id="error">
   <div class="error-page container">
      <div class="col-md-8 col-12 offset-md-2">
         <div class="text-center">
            <img class="img-error" src="{{asset('mazer/compiled/svg/error-404.svg')}}" alt="Not Found">
            <h1 class="error-title">TIDAK DITEMUKAN</h1>
            <p class="fs-5 text-gray-600">{{$message}}</p>
            <a href="{{route('admin.dashboard')}}" class="btn btn-lg btn-outline-primary mt-3">Dashboard</a>
         </div>
      </div>
   </div>


</div>
@endsection