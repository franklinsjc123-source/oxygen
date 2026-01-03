<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Oxygen</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('website_assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = "{{ asset('website_assets/js/webfont.js')}}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
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

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/style.min.css')}}">
	<style>
	table  tbody tr td { text-align:center;}
	</style>
</head>

<body class="my-account">
    <div class="page-wrapper">
       
        <!-- Start of Header -->
         @include('front_end.common.header')
        <!-- End of Header -->

        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Account</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/Accounts/Myaccount')}}">My account</a></li>
                        <li>My Profile</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                         @include('front_end.common.myaccount_sidebar')

                        <div class="tab-content mb-6">
                           <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                    </div>
                                </div> 
							<p class="mb-2">The following addresses will be used on the checkout page by default.
						</p>

						<form action="{{url('/updateaddress')}}" name="frm-login" method="post" autocomplete="Off" class="checkout-form" onsubmit="return confirm('Do you  want to Change Billing Address?');">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-xs-6">
									<label>First Name *</label>
									<input type="text" class="form-control" name="customer_firstname" onkeyup="this.value = this.value.toUpperCase(); " required="" value="{{@$customer->customer_firstname}}" />
								</div>
								<div class="col-xs-6">
									<label>Last Name *</label>
									<input type="text" class="form-control" name="customer_lastname" onkeyup="this.value = this.value.toUpperCase(); " required="" value="{{@$customer->customer_lastname}}" />
								</div>
							</div>
							<label>Company Name (Optional)</label>
							<input type="text" class="form-control" name="customer_company_name" onkeyup="this.value = this.value.toUpperCase(); " value="{{@$customer->customer_company_name}}" />

							<label>Street Address *</label>
							<input type="text" class="form-control" name="customer_address" required="" placeholder="House number and street name" value="{{@$customer->customer_address}}" />
							<input type="text" class="form-control" name="customer_address1" required="" placeholder="Area" value="{{@$customer->customer_address1}}" />

							<div class="row">
								<div class="col-xs-6">
									<label>ZIP / POSTAL CODE*</label>
									<input type="text" class="form-control" id="pincode" name="customer_pincode" required="" value="{{@$customer->customer_pincode}}" />
								</div>
								<div class="col-xs-6">
									<label>Phone *</label>
									<input type="text" class="form-control" name="customer_mobileno" id="order_mobile" required="" onblur="verify_mobile(this.value)" value="{{@$customer->customer_mobileno}}" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label>Town / City *</label>
									<input type="text" class="form-control" id="city" name="customer_city" required=""  value="{{@$customer->customer_city}}" />
								</div>
								<div class="col-xs-6">
									<label>State *</label>
									<input type="text" class="form-control" id="state" name="customer_state" required="" value="{{@$customer->customer_state}}"  />
								</div>
							</div>
							<label>Email Address *</label>
							<input type="email" class="form-control" name="customer_email" required="" value="{{@$customer->customer_email}}" />

							<br>
							<div class="login-on-checkout">
								<p class="form-row">
									<button type="submit" name="btn-sbmt" class="btn">SAVE CHANGES</button>
								</p>
						</form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        <!-- Start of Footer -->
         @include('front_end.common.footer')

    <!-- Plugin JS File -->
    <script src="{{ asset('website_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/main.min.js')}}"></script>
</body>

</html>