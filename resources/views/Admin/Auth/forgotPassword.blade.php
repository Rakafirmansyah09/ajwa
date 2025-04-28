@extends('Admin.Auth.index')

@section('content')
<div id="auth-left">
   <h1 class="auth-title">Forgot Password</h1>
   <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>

   <form action="{{route('admin.forgotPassword.post')}}" method="POST">
      @csrf
      <!-- message email reset password sudah dikirim ke email -->
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif

      <div class="form-group position-relative has-icon-left mb-4">
         <input type="email" class="form-control form-control-xl" placeholder="Email">
         <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
         </div>
      </div>
      <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
   </form>
   <div class="text-center mt-5 text-lg fs-4">
      <p class='text-gray-600'>Remember your account? <a href="{{route('admin.login')}}" class="font-bold">Log in</a>.
      </p>
   </div>
</div>

@endsection