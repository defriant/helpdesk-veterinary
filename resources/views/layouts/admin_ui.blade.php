<!doctype html>
<html lang="en">

<head>
	<title>KLINIK RENITA PETCARE</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!--  CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome-pro-master/css/all.min.css') }}">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('admins/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admins/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ asset('admins/vendor/chartist/css/chartist-custom.css') }}">
	<link rel="stylesheet" href="{{ asset('admins/vendor/toastr/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admins/vendor/jquery/jquery-ui.css') }}">
	<!-- Datetimepicker css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admins/datetimepicker/jquery.datetimepicker.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('admins/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('admins/css/style.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('admins/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admins/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admins/img/favicon.png') }}">
</head>

<body class="@if(Auth::user()->role == 'owner') layout-fullwidth @endif">
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/admin/produk"><img src="{{ asset('logo/logo.jpeg') }}" class="logo" alt="LOGO"></a>
			</div>
			<div class="container-fluid">
				@if (Auth::user()->role == 'admin')
					<div class="navbar-btn">
						<button type="button" class="btn-toggle-fullwidth"><i
								class="lnr lnr-arrow-left-circle"></i></button>
					</div>
				@endif
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="far fa-user-circle" style="margin-right: 5px"></i> <span>{{ Auth::user()->name }}</span> <i
									class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="/user-logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@if (Auth::user()->role == 'admin')
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						{{-- <li><a href="/admin" class="{{ Request::is('admin') ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
						</li> --}}
						<li style="margin-top: 10px;">
							<a href="/admin/produk" class="{{ Request::is('admin/produk') ? 'active' : '' }}"><i class="far fa-box"></i> <span>Produk</span></a>
						</li>
						<li>
							<a id="pesanan" href="#pesananPages" data-toggle="collapse" class="collapsed" aria-expanded="false">
								<i class="far fa-sack-dollar"></i> <span>Pesanan</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
							</a>
							<div id="pesananPages" class="collapse" aria-expanded="false" style="height: 0px;">
								<ul class="nav">
									<li><a id="menunggu-konfirmasi" href="/admin/pesanan/menunggu-konfirmasi" class="{{ Request::is('admin/pesanan/menunggu-konfirmasi') ? 'active' : '' }}">Menunggu konfirmasi </a></li>
									<li><a id="validasi-pembayaran" href="/admin/pesanan/validasi-pembayaran" class="{{ Request::is('admin/pesanan/validasi-pembayaran') ? 'active' : '' }}">Validasi Pembayaran </a></li>
									<li><a id="pengiriman" href="/admin/pesanan/pengiriman" class="{{ Request::is('admin/pesanan/pengiriman') ? 'active' : '' }}">Pengiriman </a></li>
									<li><a href="/admin/pesanan/konfirmasi-tiba-di-tujuan" class="{{ Request::is('admin/pesanan/konfirmasi-tiba-di-tujuan') ? 'active' : '' }}">Konfirmasi tiba di tujuan</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="/admin/semua-transaksi" class="{{ Request::is('admin/semua-transaksi') ? 'active' : '' }}"><i class="far fa-comments-alt-dollar"></i> <span>Semua Transaksi</span></a>
						</li>
						<li>
							<a href="/admin/laporan-transaksi" class="{{ Request::is('admin/laporan-transaksi') ? 'active' : '' }}"><i class="far fa-cash-register"></i> <span>Laporan Transaksi</span></a>
						</li>
						<li>
							<a href="/admin/komplain" class="{{ Request::is('admin/komplain') ? 'active' : '' }}"><i class="far fa-flag"></i> <span>Laporan Pengaduan</span></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		@endif
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			@yield('content')
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; {{ date('Y') }} All Rights Reserved.</p>
			</div>
		</footer>

		@auth
			@if (Auth::user()->role == "admin")
			<div class="btn-chat-wrapper" id="btn-chat">
				<span class="chat-notif" style="display: none;">0</span>
				<button class="chat-btn"><i class="fas fa-comment-dots"></i></button>
			</div>
			<div class="chat-panel-w-user" id="chat-panel">
				<div class="left-panel">
					<div class="top">
						Chat
					</div>
					<div class="bottom">
						
					</div>
				</div>
				<div class="right-panel">
					<div class="top">
						<span></span>
						<i class="fas fa-chevron-down" id="close-chat-panel"></i>
					</div>
					<div class="empty-chat">
						<i class="fas fa-comment-dots"></i>
					</div>
				</div>
			</div>
			@endif
		@endauth
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ asset('admins/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('admins/vendor/jquery/jquery-ui.js') }}"></script>
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	<script src="{{ asset('admins/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admins/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admins/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('admins/vendor/chartist/js/chartist.min.js') }}"></script>
	<script src="{{ asset('admins/vendor/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('admins/scripts/klorofil-common.js') }}"></script>
	<script src="{{ asset('admins/datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('admins/scripts/main.js') }}"></script>

	@if (Request::is('admin/produk'))
		<script src="{{ asset('admins/scripts/produk-script.js') }}"></script>
	@endif

	@if (Request::is('admin/laporan-transaksi'))
		<script src="{{ asset('admins/scripts/transactionReport.js') }}"></script>
	@endif

	@if (Request::is('owner'))
		<script src="{{ asset('admins/scripts/owner-produk-script.js') }}"></script>
	@endif

	@yield('scripts')
	
	@if (Request::is('admin/*'))
		<script src="{{ asset('admins/scripts/notif-badge-script.js') }}"></script>
		<script src="{{ asset('admins/scripts/notification-script.js') }}"></script>
	@endif

	@if (Request::is('admin/pesanan/*'))
		<script>
			$(window).on('load', function(){
				$('#pesanan').click();
			})
		</script>
	@endif

	@auth
		@if (Auth::user()->role == "owner")
		<script src="{{ asset('admins/scripts/owner-chat.js') }}"></script>
		@endif

		@if (Auth::user()->role == "admin")
		<script src="{{ asset('admins/scripts/admin-chat.js') }}"></script>
		@endif
	@endauth
	<input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
</body>

</html>