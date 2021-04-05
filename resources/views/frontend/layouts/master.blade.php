<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>   
        @yield('title', 'TrakkPoll | User Dashboard')
   </title>
   <!--===============================================================================================-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animsition/css/animsition.min.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/select2/select2.min.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/daterangepicker/daterangepicker.css') }}">
   <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
   <!--===============================================================================================-->
   <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
   </head>
   <body>
   
   
@yield('user_content')
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
     <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/select2/select2.min.js') }}"></script>
     <script>
       $(".selection-2").select2({
         minimumResultsForSearch: 20,
         dropdownParent: $('#dropDownSelect1')
       });
     </script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
     <script src="{{ asset('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/vendor/countdowntime/countdowntime.js') }}"></script>
   <!--===============================================================================================-->
     <script src="{{ asset('frontend/js/main.js') }}"></script>
     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     <!-- Global site tag (gtag.js) - Google Analytics -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
     <script>
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments);}
       gtag('js', new Date());
   
       gtag('config', 'UA-23581568-13');
     </script>
     <script>
      @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"
    
      
        switch(type){
          case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
               case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
    </script>
   </body>
   </html>
   