@extends('Admin.Auth.index')

@section('content')
<div class="card">
   <div class="card-body">
      <h1 class="auth-title">Masuk</h1>
      <p class="auth-subtitle mb-3">Masuk dengan data yang Anda masukkan saat pendaftaran.</p>

      <form action="{{ route('admin.login.post') }}" method="POST">
         @csrf
         <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-md" placeholder="Akun Admin" name="email">
            <div class="form-control-icon">
               <i class="bi bi-person"></i>
            </div>
         </div>
         <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-md" placeholder="Kata Sandi" name="password">
            <div class="form-control-icon">
               <i class="bi bi-shield-lock"></i>
            </div>
         </div>
         <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
               Tetap masuk
            </label>
         </div>
         <button class="btn btn-warning btn-block fw-bold mt-4">Masuk</button>
      </form>

      <div class="text-center mt-2">
         <p><a class="font-bold" href="{{ route('admin.forgotPassword') }}">Lupa kata sandi?</a>.</p>
      </div>
   </div>
</div>

@endsection