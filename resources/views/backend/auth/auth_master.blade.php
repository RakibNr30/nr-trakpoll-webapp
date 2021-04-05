<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>   
        @yield('auth_title', 'TrakkPoll | Admin LogIn')
   </title>

   @include('backend.partials.style')

</head>
<body class="hold-transition login-page">

@yield('login_content')


@include('backend.partials.scripts')

</body>
</html>
