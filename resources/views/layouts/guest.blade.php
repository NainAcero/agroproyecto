<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agrovic Torres</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-03.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/882059baa9.js" crossorigin="anonymous"></script>

</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				<div class="topbar-menu-area">
					<div class="container">
						<div class="topbar-menu left-menu">
							<ul>
								<li class="menu-item" >
									<a title="Teléfono: (052) 424394" href="#" ><span class="icon label-before fa fa-mobile"></span>Teléfono: (052) 424394</a>
								</li>
							</ul>
						</div>
						<div class="topbar-menu right-menu">
							<ul>
                                @if(Route::has('login'))

                                    @auth
                                         @if(Auth::user()->utype === 'ADM')
                                            <li class="menu-item menu-item-has-children parent" >
                                                <a title="My Account" href="#">Mi cuenta ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                {{-- <a title="My Account" href="#">My Account ({{ $_SESSION['name'] }})<i class="fa fa-angle-down" aria-hidden="true"></i></a> --}}

                                                <ul class="submenu curency" >
                                                    <li class="menu-item" >
                                                        <a title="Dashboard" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="contacto" href="{{ route('admin.contacto') }}">Mensajes</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Categoria" href="{{ route('admin.categoria') }}">Categoria</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Productos" href="{{ route('admin.producto') }}">Producto</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Productos" href="{{ route('admin.proveedor') }}">Proveedor</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Productos" href="{{ route('admin.descuento.index') }}">Descuentos</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
                                                    </li>
                                                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                    </form>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="menu-item menu-item-has-children parent" >
                                                <a title="My Account" href="#">Mi cuenta ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency" >
                                                    <li class="menu-item" >
                                                        <a title="Dashboard" href="{{ route('user.dashboard') }}">Compra</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Factura" href="{{ route('factura.index') }}">Factura</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
                                                    </li>
                                                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                    </form>
                                                </ul>
                                            </li>
                                        @endif
                                    @else
                                        <li class="menu-item" ><a title="Register or Login" href="{{route('login')}}">Login</a></li>
								        <li class="menu-item" ><a title="Register or Login" href="{{route('register')}}">Register</a></li>
                                    @endif
                                @endif
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="/" class="link-to-home"><img src="{{ asset('img/logo.png') }}" alt="mercado"></a>
						</div>

						<!-- Search -->
                        @livewire('header-search-component')

						<div class="wrap-icon right-section">
							<div class="wrap-icon-section minicart">
								<a href="/cart" class="link-direction">
									<i class="fa fa-shopping-basket" aria-hidden="true"></i>
									<div class="left-info">
                                        @if(Cart::count() > 0)
                                            <span class="index">{{ Cart::count() }} item</span>
                                        @endif
										<span class="title">CARRITO</span>
									</div>
								</a>
							</div>
							<div class="wrap-icon-section show-up-after-1024">
								<a href="#" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<div class="nav-section header-sticky">

					<div class="primary-nav-section">
						<div class="container">
							<ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
								<li class="menu-item home-icon">
									<a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
								</li>
								<li class="menu-item">
									<a href="/about" class="link-term mercado-item-title">Sobre nosotros</a>
								</li>
								<li class="menu-item">
									<a href="/shop" class="link-term mercado-item-title" >Tienda</a>
								</li>
								<li class="menu-item">
									<a href="/cart" class="link-term mercado-item-title">Carrito</a>
								</li>
								<li class="menu-item">
									<a href="/contact" class="link-term mercado-item-title">Contactos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

    {{ $slot }}

	<footer id="footer">
		<div class="wrap-footer-content footer-style-1">

			<div class="wrap-function-info">
				<div class="container">
					<ul>
						<li class="fc-info-item">
							<i class="fa fa-truck" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">ENVÍO GRATIS</h4>
								<p class="fc-desc">Gratis con pedido superior a $99</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-recycle" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Garantía</h4>
								<p class="fc-desc">30 días de devolución de dinero</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Pago seguro</h4>
								<p class="fc-desc">Su pago es seguro en línea</p>
							</div>

						</li>
						<li class="fc-info-item">
							<i class="fa fa-life-ring" aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">Soporte en línea</h4>
								<p class="fc-desc">Nosotros tenemos soporte 24/7</p>
							</div>

						</li>
					</ul>
				</div>
			</div>
			<!--End function info-->

			<div class="main-footer-content">

				<div class="container">

					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">DETALLES DE CONTACTO</h3>
								<div class="item-content">
									<div class="wrap-contact-detail">
										<ul>
											<li>
												<i class="fa fa-map-marker" aria-hidden="true"></i>
												<p class="contact-txt"> Prolongación Patricio Melendez 583 – Tacna </p>
											</li>
											<li>
												<i class="fa fa-phone" aria-hidden="true"></i>
												<p class="contact-txt">(052) 424 394</p>
											</li>
											<li>
												<i class="fa fa-envelope" aria-hidden="true"></i>
												<p class="contact-txt">agrovid@torres.com</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

							<div class="wrap-footer-item">
								<h3 class="item-header">LÍNEA DIRECTA</h3>
								<div class="item-content">
									<div class="wrap-hotline-footer">
										<b class="phone-number">(052) 424 394</b>
									</div>
								</div>
							</div>


						</div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

							<div class="wrap-footer-item">
                                <div class="banner-item">
                                    <a href="/shop" class="link-banner banner-effect-1">
                                        <figure><img src="https://irp-cdn.multiscreensite.com/519cc0c7/DESKTOP/jpg/1380793-banner.jpg" width="100%" alt=""></figure>
                                    </a>
                                </div>
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">USAMOS PAGOS SEGUROS:</h3>
								<div class="item-content">
									<div class="wrap-list-item wrap-gallery">
										<img src="{{ asset('assets/images/payment.png') }}" style="max-width: 260px;">
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="wrap-back-link">
					<div class="container">
					</div>
				</div>

			</div>

			<div class="coppy-right-box">
				<div class="container">
					<div class="coppy-right-item item-left">
						<p class="coppy-right-text">Copyright © 2021 AGROVIC TORRES todos los derechos reservados</p>
					</div>
					<div class="coppy-right-item item-right">
						<div class="wrap-nav horizontal-nav">

						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</footer>

	<script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
	<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('assets/js/functions.js') }}"></script>

    @stack('scripts')
</body>
</html>

