@extends('frontend.auth.login_master')
@section('title')
  Login Page | Trakkpoll
@endsection
@section('login_content')
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">TrakkPoll</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    </ul>
  </div>
</nav>
<div class="container-contact100">
  <div class="wrap-contact100">
    <form class="contact100-form validate-form" action="{{ route('login.user') }}" method="POST">
      @csrf
      <span class="contact100-form-title">
        Login For Survey
      </span>

      <label class="label-input100" for="email">{{ __('Enter your email') }}</label>
      <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
        <input id="email" class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Eg. example@email.com" value="{{ old('email') }}" required autocomplete="email">
        <span class="focus-input100"></span>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <label class="label-input100" for="password">{{ __('Enter password') }}</label>
      <div class="wrap-input100">
        <input id="password" class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter Your Password" required autocomplete="password">
        <span class="focus-input100"></span>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="container-contact100-form-btn">
        <button class="contact100-form-btn" type="submit">
          Login
        </button>
      </div>
    </form>

    <div class="contact100-more flex-col-c-m" style="background-image: url('frontend/images/bg-01.jpg');">
      <div class="flex-w size1 p-b-47">
        <div class="txt1 p-r-25">
          <span class="lnr lnr-map-marker"></span>
        </div>

        <div class="flex-col size2">
          <span class="txt1 p-b-20">
            Address
          </span>

          <span class="txt2">
            Mada Center 8th floor, 379 Hudson St, New York, NY 10018 US
          </span>
        </div>
      </div>

      <div class="dis-flex size1 p-b-47">
        <div class="txt1 p-r-25">
          <span class="lnr lnr-phone-handset"></span>
        </div>

        <div class="flex-col size2">
          <span class="txt1 p-b-20">
            Lets Talk
          </span>

          <span class="txt3">
            +1 800 1236879
          </span>
        </div>
      </div>

      <div class="dis-flex size1 p-b-47">
        <div class="txt1 p-r-25">
          <span class="lnr lnr-envelope"></span>
        </div>

        <div class="flex-col size2">
          <span class="txt1 p-b-20">
            General Support
          </span>

          <span class="txt3">
            contact@example.com
          </span>
        </div>
      </div>
    </div>
  </div>
</div>



<div id="dropDownSelect1"></div>
@endsection