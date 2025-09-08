@extends('Admin.Auth.index')

@section('content')
<div class="card">
   <div class="card-body">
      <h1 class="auth-title">Forgot Password</h1>
      <p class="auth-subtitle mb-3">Input your email and we will send you reset password link.</p>

      <form action="{{route('admin.forgotPassword.post')}}" method="POST">
         @csrf
         <!-- message email reset password sudah dikirim ke email -->
         @if (session('status'))
         <div class="alert alert-success">
            {{ session('status') }}
         </div>
         @endif

         <div class="form-group position-relative has-icon-left mb-3">
            <input type="email" class="form-control form-control-md" placeholder="Email">
            <div class="form-control-icon">
               <i class="bi bi-envelope"></i>
            </div>
         </div>
         <button class="btn btn-primary btn-block mx-auto fw-bold mt-2">Send</button>
      </form>
      <div class="text-center mt-2">
         <p class='text-gray-600'>Remember your account? <a href="{{route('admin.login')}}" class="font-bold">Log in</a>.
         </p>
      </div>
   </div>
</div>

@endsection