<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>

      @yield('title')
      
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  @include('frontend.pages.partials.style')

</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('frontend.pages.partials.nav')


@include('frontend.pages.partials.sidebar')


@yield('user_content')


 <footer class="main-footer" style="text-align: center">
    <strong>Copyright &copy; 2021 Trakkpoll</strong> All rights reserved.
  </footer>
</div><!-- ./wrapper -->

@include('frontend.pages.partials.scripts')

</body>
</html>