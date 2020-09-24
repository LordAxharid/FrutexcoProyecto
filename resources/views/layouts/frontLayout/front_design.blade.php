<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Frutexco </title>
    @if(!empty($meta_description))<meta name="description" content="{{ $meta_description }}">@endif

    @if(!empty($meta_keywords))<meta name="keywords" content="{{ $meta_keywords }}">@endif


    <link href="{{ asset('css/frontend_css/layout/coming_soon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/layout/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/custom_bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/elegant.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/fontawesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/icomoon.css') }}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/password.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/scroll.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/style.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5cc08788f3971d0012e248e5&product=inline-share-buttons' async='async'></script>




 <!-- Icono Barra -->
 <link href="{{ asset('images/frontend_images/home/FRUTEXCO.png') }}" rel="icon">

</head><!--/head-->

<body>
    @include('layouts.frontLayout.front_header')

<!-- Icono Whatsapp -->

<!-- Cierre Icono Whatsapp -->

	@yield('content')

	@include('layouts.frontLayout.front_footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/frontend_js/bootstrap.js') }}"></script>
	<script src="{{ asset('js/frontend_js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/frontend_js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('js/frontend_js/jquery.easing.js') }}"></script>
    <script src="{{ asset('js/frontend_js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/frontend_js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/frontend_js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/login.js') }}"></script>
    <script src="{{ asset('js/frontend_js/main.js') }}"></script>
    <script src="{{ asset('js/frontend_js/numscroller-1.0.js') }}"></script>
    <script src="{{ asset('js/frontend_js/parallax.js') }}"></script>
    <script src="{{ asset('js/frontend_js/password.js') }}"></script>
    <script src="{{ asset('js/frontend_js/slick.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/validates.js') }}"></script>
    <script src="{{ asset('js/frontend_js/vanilla-tilt.min.js') }}"></script>
 

 
</body>

</html>
