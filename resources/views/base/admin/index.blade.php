<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ asset('assets/backend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset('assets/backend/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{ asset('assets/backend/css/morris/morris.css') }}" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{ asset('assets/backend/css/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{ asset('assets/backend/css/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{ asset('assets/backend/css/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ asset('assets/backend/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('assets/backend/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="{{asset ('assets/frontend/css/all.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/frontend/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/frontend/css/brands.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/frontend/css/solid.css') }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">

        @include('layout/admin/header')

        <div class="wrapper row-offcanvas row-offcanvas-left">
            
            @include('layout/admin/sidebar')

            @yield('content')
            
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="{{ asset('assets/backend/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="{{asset ('assets/backend/js/raphael-min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{ asset('assets/backend/js/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{ asset('assets/backend/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="{{ asset('assets/backend/js/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('assets/backend/js/plugins/jqueryKnob/jquery.knob.js') }}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('assets/backend/js/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('assets/backend/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/backend/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('assets/backend/js/AdminLTE/app.js') }}" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('assets/backend/js/AdminLTE/dashboard.js') }}" type="text/javascript"></script>   

        {{-- Font Awesome --}}
        <script src="{{asset ('assets/frontend/js/all.js') }}"></script>
        <script src="{{asset ('assets/frontend/js/brands.js') }}"></script>
        <script src="{{asset ('assets/frontend/js/solid.js') }}"></script>
        <script src="{{asset ('assets/frontend/js/fontawesome.js') }}"></script>     

    </body>
</html>