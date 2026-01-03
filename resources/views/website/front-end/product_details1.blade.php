<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    @include('website.partials.css.frontendcss')
    {{-- <link rel="icon" href="../frontend_assets/images/favicon/25.png" type="image/x-icon">
    <link rel="shortcut icon" href="../frontend_assets/images/favicon/25.png" type="image/x-icon">
    <title>Oxegen Ecommerce</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/fontawesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="../frontend_assets/css/style.css"> --}}

</head>

<body class="theme-color-29">


    <!-- loader start -->

    <!-- loader end -->


    <!-- header start -->
    <header class="header-tools zindex-up header-style top-relative">
        <div class="mobile-fix-option"></div>
        <div class="logo-menu-part">
            <div class="container-fuild  px-3  border-bottom-0 rounded-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-menu">
                            <div class="col-md-3">
                                <div class="menu-left">
                                    <div class="navbar">
                                        <a href="javascript:void(0)" onclick="openNav()">
                                            <div class="bar-style px-2"><i class="fa fa-bars sidebar-bar"
                                                    style="font-size: 25px;color: #000;" aria-hidden="true"></i>
                                            </div>
                                        </a>

                                        <div id="mySidenav" class="sidenav">
                                            <a href="javascript:void(0)" class="sidebar-overlay"
                                                onclick="closeNav()"></a>
                                            <nav>
                                                <div onclick="closeNav()">
                                                    <div class="sidebar-back text-start"><i
                                                            class="fa fa-angle-left pe-2" aria-hidden="true"></i> Back
                                                    </div>
                                                </div>

                                            </nav>
                                        </div>
                                    </div>
                                    <div class="brand-logo">
                                        <a href="index.php"> <img src="{{url('frontend_assets/img/logo/logo.png')}}"
                                                class="img-fluid lazyload" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pt-1">
                                    <form class="form_search m-auto" role="form">
                                        <input id="query search-autocomplete" type="search"
                                            placeholder="Search anything here..." class="nav-search nav-search-field"
                                            aria-expanded="true">
                                        <button type="submit" name="nav-submit-button" class="btn-search">
                                            <i class="ti-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="menu-right">

                                    <div class="top-header">
                                        {{-- <ul class="header-dropdown">
                                            <li class="mobile-wishlist"><a href="#"><img
                                                        src="../frontend_assets/images/icon/heart-1.png" alt=""> </a>
                                            </li>
                                            <li class="onhover-dropdown mobile-account">
                                                <img src="../frontend_assets/images/icon/user-1.png" alt="">
                                                <ul class="onhover-show-div">
                                                    <li>
                                                        <a href="{{ route('userlogin') }}"
                                                        data-lng="en">
                                                        Login

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('usersignin.index') }}" data-lng="en">
                                                            Sign in

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-lng="es">
                                                            Logout
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul> --}}
                                    </div>
                                    <div>
                                        <div class="icon-nav">
                                            <ul>
                                                <li class="onhover-div  d-md-none d-sm-block mobile-search">
                                                    <div class=""><img src="../frontend_assets/images/icon/search.png"
                                                            onclick="openSearch()" class="img-fluid  lazyload" alt="">
                                                        <i class="ti-search" onclick="openSearch()"></i>
                                                    </div>
                                                    <div id="search-overlay" class="search-overlay">
                                                        <div>
                                                            <span class="closebtn" onclick="closeSearch()"
                                                                title="Close Overlay">×</span>
                                                            <div class="overlay-content">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-xl-12">
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="exampleInputPassword1"
                                                                                        placeholder="Search a Product">
                                                                                </div>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"><i
                                                                                        class="fa fa-search"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    <div class="title1 section-t-space pt-5">

        <h4 class="title-inner1 text-left">DEAL OF THE DAY</h4>
    </div>

    <!-- Paragraph end -->


    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">

                @foreach($product as $products )
                <?php
                $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products->product_id)->get();
                //  print_r($productdetails);
                ?>
                @foreach($productdetails as $productdetail )
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href=""><img
                                    src="{{ asset('assets/images/products/detail') . '/' . $productdetail->product_detail_image }}"
                                    class="img-fluid  lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">

                        <a href="">
                            <h6>{{ $productdetail->selling_price }}</h6>
                        </a>

                    </div>
                </div>
                @endforeach
            @endforeach

            </div>
        </div>
    </section>


    @include('website.partials.js.frontendjs')
    <!-- footer -->



    {{-- <!-- latest jquery-->
    <script src="../frontend_assets/js/jquery-3.3.1.min.js"></script>

    <!-- slick js-->
    <script src="../frontend_assets/js/slick.js"></script>
    <script src="../frontend_assets/js/slick-animation.min.js"></script>

    <!-- wow js-->
    <script src="../frontend_assets/js/wow.min.js"></script>

    <!-- menu js-->
    <script src="../frontend_assets/js/menu.js"></script>

    <!-- lazyload js-->
    <script src="../frontend_assets/js/lazysizes.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../frontend_assets/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Notification js-->
    <script src="../frontend_assets/js/bootstrap-notify.min.js"></script>

    <!-- Theme js-->
    <script src="../frontend_assets/js/theme-setting.js"></script>
    <script src="../frontend_assets/js/color-setting.js"></script>
    <script src="../frontend_assets/js/script.js"></script>
    <script src="../frontend_assets/js/custom-slick-animated.js"></script> --}}

    <script>
        new WOW().init();

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("july 5, 2022 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = "&nbsp&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo1").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo2").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo3").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo4").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo5").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("demo1").innerHTML = "EXPIRED";
                document.getElementById("demo2").innerHTML = "EXPIRED";
                document.getElementById("demo3").innerHTML = "EXPIRED";
                document.getElementById("demo4").innerHTML = "EXPIRED";
                document.getElementById("demo5").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

</body>

</html>