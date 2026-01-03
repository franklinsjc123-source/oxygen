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
                        <li>My Account</li>
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
                            
							 <form action="{{url('/changepassword')}}" method="post" name="frm-login" autocomplete="Off" class="checkout-form" onsubmit="return confirm('Do you  want to Change Password?');">
                                    {{ csrf_field() }}
                                    <fieldset style="padding:20px;">
                                        <legend>Password Change</legend>
                                        <label>Current password </label>
                                        <input type="password" class="form-control" id="customer_opassword" onblur="opass_verify(this.value)" name="current_password" required value="">

                                        <label>New password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" onblur="pass_verify(this.value)" id="customer_password" name="new_password" required>

                                        <label>Confirm new password</label>
                                        <input type="password" onblur="cpass_verify(this.value)" class="form-control" id="customer_cpassword" name="confirm_password" required>
                                    </fieldset>
                                    <br>
                                    <div class="login-on-checkout">
                                        <p class="form-row">
                                            <button type="submit" name="btn btn-dark btn-rounded " class="btn">SAVE CHANGES</button>
                                        </p>
                                    </div>
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