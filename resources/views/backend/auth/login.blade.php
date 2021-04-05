@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Admin Panel
@endsection

@section('login_content')
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Trakk</b>Poll</a>
      </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Admin Panel Sign IN</p>


      @include('backend.partials.message')

      <form action="{{ route('admin.login.submit') }}" method="POST">

        @csrf

        <div class="input-group mb-3">
          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email or Username" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('SignIn') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <p class="mb-1">
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection