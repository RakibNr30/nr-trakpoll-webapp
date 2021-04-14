<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>

    @yield('title')

    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('backend.partials.style')
    @yield('style')
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('backend.partials.nav')


@include('backend.partials.sidebar')


@yield('admin_content')


 <footer class="main-footer" style="text-align: center">
    <strong>Copyright &copy; 2021 Trakkpoll</strong> All rights reserved.
  </footer>
</div><!-- ./wrapper -->

@include('backend.partials.scripts')
@yield('script')
</body>
</html>