<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

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
<body>
	<div class="col-8" style="margin: auto;">
		<div class="main-sidebar">
		<!-- Single Widget -->
			<div class="single-widget newsletter">
				<h3 class="title">Transaksi</h3>
					<div class="letter-inner">
						<div class="form-inner">
							<table class="table">
                                <tbody>
                                    <tr>
                                        <td>ID Order</td>
                                        <td>:</td>
                                    	<td>{{ $transaksi->id_order }}</td>
                                    </tr>
									<tr>
                                        <td>Total Harga</td>
                                        <td>:</td>
                                        <td>{{ $pesanan->total_harga }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Ongkir</td>
                                        <td>:</td>
                                        <td>{{ $pesanan->total_ongkir }}</td>
                                    </tr>
									<tr>
                                        <td>Total Pesanan</td>
                                        <td>:</td>
                                        <td>{{ $pesanan->total_pesanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kurir</td>
                                        <td>:</td>
                                        <td>{{ $pesanan->kurir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $transaksi->type_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Transaksi</td>
                                        <td>:</td>
                                        <td>{{ $transaksi->status_transaksi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Transaksi</td>
                                        <td>:</td>
                                        <td>{{ $transaksi->tgl_transaksi }}</td>
                                    </tr>
									<tr>
										<td></td>
										<td></td>
                                        <td>
                                        	<div class="row">
                                        		<div class="col-5">
	                                        		<a href="/cancel/{{ $transaksi->id_order }}" class="btn btn-primary" style="padding-bottom: 50px; padding-right: 0px; padding-left: 0px;">Batalkan</a>
	                                        	</div>
	                                        	<div class="col-6">
	                                        		<a href="" class="btn btn-primary" style="padding-bottom: 50px; padding-right: 0px; padding-left: 0px;">Bayar Sekarang</a>
	                                        	</div>
                                        	</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
						</form>
					</div>
				</div>
			</div>
		<!--/ End Single Widget -->
		</div>
	</div>
</body>
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
</html>