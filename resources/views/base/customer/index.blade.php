<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Batik</title>
	<!-- Favicon -->
	<link rel="icon" type="{{asset ('assets/frontend/image/png') }}" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/magnific-popup.min.css') }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/font-awesome.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/jquery.fancybox.min.css') }}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/themify-icons.css') }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/niceselect.css') }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/animate.css') }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/flex-slider.min.css') }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/owl-carousel.css') }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/slicknav.min.css') }}">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/reset.css') }}">
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{asset ('assets/frontend/css/responsive.css') }}">

	{{-- Font Awesome --}}
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/all.css') }}">
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/fontawesome.css') }}">
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/brands.css') }}">
	<link rel="stylesheet" href="{{asset ('assets/frontend/css/solid.css') }}">

	<script src="{{ asset('js/app.js') }}"></script>

</head>
<body class="js">
	
	@include('layout/customer/header')
	
	@yield('content')
	
	@include('layout/customer/footer')

	@include('sweetalert::alert')
 
	<!-- Jquery -->
    <script src="{{asset ('assets/frontend/js/jquery.min.js') }}"></script>
    <script src="{{asset ('assets/frontend/js/jquery-migrate-3.0.0.js') }}"></script>
	<script src="{{asset ('assets/frontend/js/jquery-ui.min.js') }}"></script>
	<!-- Popper JS -->
	<script src="{{asset ('assets/frontend/js/popper.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset ('assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- Color JS -->
	<script src="{{asset ('assets/frontend/js/colors.js') }}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset ('assets/frontend/js/slicknav.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset ('assets/frontend/js/owl-carousel.js') }}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset ('assets/frontend/js/magnific-popup.js') }}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset ('assets/frontend/js/waypoints.min.js') }}"></script>
	<!-- Countdown JS -->
	<script src="{{asset ('assets/frontend/js/finalcountdown.min.js') }}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset ('assets/frontend/js/nicesellect.js') }}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset ('assets/frontend/js/flex-slider.js') }}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset ('assets/frontend/js/scrollup.js') }}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset ('assets/frontend/js/onepage-nav.min.js') }}"></script>
	<!-- Easing JS -->
	<script src="{{asset ('assets/frontend/js/easing.js') }}"></script>
	<!-- Active JS -->
	<script src="{{asset ('assets/frontend/js/active.js') }}"></script>
	{{-- Font Awesome --}}
	<script src="{{asset ('assets/frontend/js/all.js') }}"></script>
	<script src="{{asset ('assets/frontend/js/brands.js') }}"></script>
	<script src="{{asset ('assets/frontend/js/solid.js') }}"></script>
	<script src="{{asset ('assets/frontend/js/fontawesome.js') }}"></script>
</body>
</html>