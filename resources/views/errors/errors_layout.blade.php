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
    @include('backend.partials.style')    
<style>
/*-------------------- 25. 404 Page ------------------- */
    
.error-area {
        min-height: 100vh;
        background: #F3F8FB;
    }
    
    .error-content {
        background: #fff;
        width: 100%;
        max-width: 600px;
        margin: auto;
        padding: 70px 30px;
    }
    
    .error-content h2 {
        font-size: 98px;
        font-weight: 800;
        color: #686cdc;
        margin-bottom: 28px;
        text-shadow: -3px -3px 0 #ffffff, 3px -3px 0 #ffffff, -3px 3px 0 #ffffff, 3px 3px 0 #ffffff, 4px 4px 0 #6569dc, 5px 5px 0 #6569dc, 6px 6px 0 #6569dc, 7px 7px 0 #6569dc;
        font-family: 'lato', sans-serif;
    }
    
    .error-content img {
        margin-bottom: 50px;
    }
    
    .error-content p {
        font-size: 17px;
        color: #787bd8;
        font-weight: 600;
    }
    
    .error-content a {
        display: inline-block;
        margin-top: 40px;
        background: #656aea;
        color: #fff;
        padding: 16px 26px;
        border-radius: 3px;
    }
    
    /*-------------------- END 404 Page ------------------- */    
</style>    

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @yield('errors_content')
</div>
 <!-- ./wrapper -->

@include('backend.partials.scripts')
</body>
</html>
