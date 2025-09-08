@extends('Admin.Auth.index')

@section('content')
<div class="card">
   <div class="card-body">
      <h1 class="auth-title">Reset Password</h1>
      <p class="auth-subtitle mb-5">Please enter your new password below.</p>

      <form action="{{route('admin.resetPassword.post')}}" method="POST">
         @csrf
         <input type="hidden" name="token" value="{{ $token }}">
         <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-md" name="email" value="{{ $email }}" readonly>
            <div class="form-control-icon">
               <i class="bi bi-envelope"></i>
            </div>
         </div>
         <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-md" name="password" placeholder="New Password" required>
            <div class="form-control-icon">
               <i class="bi bi-shield-lock"></i>
            </div>
         </div>
         <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-md" name="password_confirmation" placeholder="Confirm Password" required>
            <div class="form-control-icon">
               <i class="bi bi-shield-lock"></i>
            </div>
         </div>
         <button type="submit" class="btn btn-primaryd-block mx-auto fw-bold mt-4">Reset Password</button>
      </form>
      <div class="text-center mt-2">
         <p class='text-gray-600'>Remember your account? <a href="{{ route('admin.login') }}" class="font-bold">Log in</a>.
         </p>
      </div>
   </div>
</div>

@endsection