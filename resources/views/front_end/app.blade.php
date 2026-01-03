<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		
		<title>Oxygen - Shopping Site</title>
		
		<meta name="keywords" content="ecommerce,Marketplace,shopping" />
		<meta name="description" content="Oxygen - Your one-stop shop for all your shopping needs.">
		<meta name="author" content="Oxygen">
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ asset('website_assets/images/icons/favicon.png')}}">
		
		<!-- WebFont.js')}}" -->
		<script>
			WebFontConfig = {
				google: { families: ['Poppins:400,500,600,700,800',] }
			};
			var links='/website_assets/js/webfont.js';
			(function (d) {
				var wf = d.createElement('script'), s = d.scripts[0];
				wf.src = links;
				wf.async = true;
				s.parentNode.insertBefore(wf, s);
			})(document);
		</script>
		
		<link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
		<link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
		<link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
		crossorigin="anonymous">
		<link rel="preload" href="{{ asset('website_assets/fonts/wolmart.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">
		
		<!-- Vendor CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/fontawesome-free/css/all.min.css')}}">
		
		<!-- Plugins CSS -->
		<link rel="stylesheet" href="{{ asset('website_assets/vendor/swiper/swiper-bundle.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/animate/animate.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/magnific-popup/magnific-popup.min.css')}}">
		
		<!-- Default CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/demo8.min.css')}}">
	</head>
<body>
     @yield('content')       
    @include('front_end.common.footer')
</body>
</html>