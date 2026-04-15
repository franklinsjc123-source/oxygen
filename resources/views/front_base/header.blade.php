<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title')</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('frontend') ?>/images/favicon.png">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Poppins:400,500,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '<?= asset('frontend') ?>/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/css/style.min.css">


    <link rel="preload" href="<?= asset('frontend') ?>/vendor/fontawesome-free/webfonts/fa-regular-400.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= asset('frontend') ?>/vendor/fontawesome-free/webfonts/fa-solid-900.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= asset('frontend') ?>/fonts/wolmart.woff?png09e" as="font" type="font/woff"
        crossorigin="anonymous">
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/animate/animate.min.css">

    <!-- preloading link
    <link rel="preload" href="<?= asset('frontend') ?>/fonts/venedor.woff" as="font" type="font/woff" crossorigin="anonymous"> -->

    <!-- Plugins CSS -->

    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="<?= asset('frontend') ?>/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/css/demo8.min.css">

    <script src="<?= asset('frontend') ?>/vendor/jquery/jquery.min.js"></script>

</head>

<body>


    <?php
    
    use App\Models\Category\CategoryMain;
    use App\Models\Category\Category;
    use App\Models\Category\CategorySub;
    use App\Models\Ecom_Customer_info;
    use Darryldecode\Cart\Facades\CartFacade as Cart;
    use Illuminate\Support\Facades\Session;
    
    $categorymain = CategoryMain::orderBy('category_main_sortorder', 'asc')->get();
    // dd($categorymain);
    // $category = Category::orderBy('category_sortorder', 'asc')->get();

    // $categorysub = CategorySub::orderBy('category_sub_sortorder', 'asc')->get();
    $count = Cart::getContent()->count();
    // $customerName = Session::get('customer_name');
    if ( Session::has('customer_id')) {
        $customerName = optional(Ecom_Customer_info::where('customer_id', Session::get('customer_id'))->first())->customer_firstname;
    }
    ?>

    <style>
        .search-suggest-box {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1100;
            max-height: 280px;
            overflow-y: auto;
            display: none;
        }

        .search-suggest-item {
            padding: 8px 10px;
            font-size: 13px;
            color: #333;
            cursor: pointer;
            line-height: 1.35;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .search-suggest-left {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .search-suggest-thumb {
            width: 34px !important;
            height: 34px !important;
            border-radius: 4px;
            object-fit: cover !important;
            background: #f4f4f4;
            flex-shrink: 0;
            display: block !important;
            max-width: 34px !important;
            min-width: 34px !important;
        }

        .search-suggest-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }

        .search-suggest-item:hover,
        .search-suggest-item.active {
            background: #f3f8ff;
        }

        .search-suggest-type {
            font-size: 11px;
            color: #888;
            text-transform: capitalize;
            white-space: nowrap;
        }

        @media (max-width: 767.98px) {
            .header-middle .container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
            }

            .home-mobile-logo {
                display: none !important;
            }

            .header-middle .container .header-left {
                display: flex;
                align-items: center;
                flex: 1 1 auto;
                min-width: 0;
                margin-right: 0 !important;
                overflow: hidden;
            }

            /* Hide existing small search if we use the new row */
            .header.header-border .header-middle .header-left .home-mobile-search {
                display: none !important;
            }

            .header-middle .container .header-right {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                flex: 0 0 auto;
                margin-left: 10px !important;
            }

            .header-middle .container .header-right .cart-dropdown .cart-label,
            .header-middle .container .header-right .compare-label,
            .header-middle .container .header-right .wishlist-label {
                display: none !important;
            }

            /* New Mobile Sub Header Styles */
            .mobile-search-row {
                background: #e1f3ff; /* Light blue based on user image */
                padding: 8px 10px;
                display: flex;
                align-items: center;
                gap: 6px;
                border-bottom: 1px solid #c8e5f9;
            }
            .mobile-search-row .mobile-location {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-width: 35px;
                max-width: 50px;
                cursor: pointer;
                gap: 0;
                padding-right: 3px;
                border-right: 1px solid rgba(0, 136, 221, 0.2);
                margin-right: 2px;
                overflow: hidden;
            }
            .mobile-search-row .mobile-location marquee {
                width: 100%;
                line-height: 1;
                margin-top: -2px;
            }
            .mobile-search-row .mobile-location span {
                font-size: 8px;
                font-weight: 800;
                color: #0088dd;
                text-transform: uppercase;
                white-space: nowrap;
            }
            
            .mobile-search-row .back-btn {
                font-size: 18px;
                color: #333;
                width: 25px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .mobile-search-row .mobile-search-form {
                flex: 1;
                position: relative;
            }
            .mobile-search-row .search-input-group {
                background: #fff;
                border: 1px solid #0088dd; /* Blue border like the image */
                border-radius: 25px; /* Pill shape */
                padding: 8px 15px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .mobile-search-row .search-input-group i {
                font-size: 16px;
                color: #666;
            }
            .mobile-search-row .search-input-group input {
                border: none;
                width: 100%;
                outline: none;
                font-size: 14px;
                background: transparent;
                height: 26px;
            }
            .mobile-search-row .clear-search-btn {
                font-size: 18px;
                color: #666;
                width: 35px;
                display: none;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: color 0.2s;
            }
            .mobile-search-row .clear-search-btn:hover {
                color: #ff0000;
            }
        }

        @media (max-width: 575.98px) {
            .header-middle .container {
                gap: 6px;
            }

            .header.header-border .header-middle .header-left .home-mobile-search {
                width: 210px !important;
                flex-basis: 210px !important;
                max-width: 210px !important;
            }

            .header.header-border .header-middle .header-left .home-mobile-search .form-control {
                font-size: 11px;
                padding: 4px 6px;
            }
        }

        @media (max-width: 420px) {
            .header.header-border .header-middle .header-left .home-mobile-search {
                width: 165px !important;
                flex-basis: 165px !important;
                max-width: 165px !important;
            }
        }

        @media (max-width: 360px) {
            .header.header-border .header-middle .header-left .home-mobile-search {
                width: 140px !important;
                flex-basis: 140px !important;
                max-width: 140px !important;
            }
        }

        /* Side cart: make items scroll and keep actions visible at bottom */
        .cart-dropdown.cart-offcanvas .dropdown-box.sideCart {
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 80px);
            height: 100%;
        }

        .cart-dropdown.cart-offcanvas .dropdown-box.sideCart .products {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            padding-right: 6px;
        }

        .cart-dropdown.cart-offcanvas .dropdown-box.sideCart .cart-total,
        .cart-dropdown.cart-offcanvas .dropdown-box.sideCart .cart-action {
            flex: 0 0 auto;
            background: #fff;
        }

        .cart-dropdown.cart-offcanvas .dropdown-box.sideCart .cart-action {
            position: sticky;
            bottom: 0;
            padding-top: 12px;
        }

        /* ── Megamenu Premium Design ── */
        /* Ensure megamenu always opens aligned to the very top */
        .category-menu {
            position: static !important;
        }
        .category-menu > li {
            position: static !important;
        }

        .category-menu > li > .megamenu {
            position: absolute !important;
            top: 0 !important;
            left: -9999px !important; /* Force off-screen when not hovered */
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            z-index: 9999 !important;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.04);
            border-radius: 0 12px 12px 0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.03);
            padding: 15px !important;
            margin-top: 0 !important;
            max-width: 880px !important; /* Approx width for exactly 4 columns */
            width: 880px !important;
            display: flex !important;
            flex-wrap: wrap !important;
            overflow: visible !important;
        }
        
        @keyframes fadeInMenu {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .category-menu > li:hover > .megamenu {
            left: 100% !important; /* Bring directly to right edge of main menu */
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
            animation: fadeInMenu 0.3s ease-out forwards;
        }

        /* Hide hr dividers */
        .category-menu > li > .megamenu .divider {
            display: none;
        }

        /* Each category column */
        .category-menu > li > .megamenu > li {
            flex: 0 0 210px !important; /* Force exact uniform column width */
            max-width: 210px !important;
            border-right: 1px solid #f1f5f9 !important;
            padding: 8px 15px !important;
            margin: 0 !important;
            transition: transform 0.3s ease;
        }
        .category-menu > li > .megamenu > li:last-child {
            border-right: none !important;
            padding: 8px 15px !important;
            margin: 0 !important;
        }
        .category-menu > li > .megamenu > li:hover {
            transform: translateY(-2px);
        }

        /* Category heading — Bold & Elegant */
        .category-menu > li > .megamenu > li > a {
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            padding: 0 0 8px 0 !important;
            margin: 0 0 10px 0 !important;
            border-bottom: 2px solid #e2e8f0 !important;
            display: block !important;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: relative;
            white-space: nowrap;
        }
        
        /* Subtle animated underline on hover for heading */
        .category-menu > li > .megamenu > li > a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #0088dd;
            transition: width 0.3s ease;
        }
        .category-menu > li > .megamenu > li:hover > a::after {
            width: 30px;
        }

        /* Subcategory child links */
        .category-menu > li > .megamenu > li ul li a {
            padding: 4px 8px !important;
            margin-bottom: 2px;
            font-size: 11.5px !important;
            font-weight: 500 !important;
            color: #475569 !important;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            background-color: transparent;
        }
        
        .category-menu > li > .megamenu > li ul li a:hover {
            color: #0088dd !important;
            background-color: #f1f6fa !important;
            padding-left: 16px !important;
        }

        /* ── Stock Badge Design ── */
        .product-stock-status {
            display: flex;
            justify-content: center;
            margin: 8px 0 2px 0;
            min-height: 24px;
        }
        .stock-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
        }
        .stock-label i {
            font-size: 12px;
        }
        .stock-label.in-stock {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
        }
        .stock-label.low-stock {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
            animation: pulse-low-stock 2s infinite ease-in-out;
        }
        .stock-label.out-of-stock {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }
        @keyframes pulse-low-stock {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.02); }
        }
    </style>

    <body>
        <!-- Start of Page Wrapper -->
        <div class="page-wrapper">
            <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
            <!-- Start of Header -->
            <header class="header header-border">
                <!-- <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Welcome to Oxygen ! </p>
                    </div>
                    <div class="header-right">
                       

                        
                      
                         <span class="divider d-lg-show"></span>
                        <a href="blog.html" class="d-lg-show">Blog</a>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                         <a href="my-account.html" class="d-lg-show">My Account</a>
                         <a href="javascript:void(0)" onclick="showLoginPopup()" class="d-lg-show login sign-in"><i
                                class="w-icon-account"></i>Sign In</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="javascript:void(0)" onclick="showLoginPopup()" class="ml-0 d-lg-show login register">Register</a>
                    </div>
                </div>
            </div> -->
                <!-- End of Header Top -->

                <div class="header-middle">
                    <div class="container">
                        <div class="header-left mr-md-4">
                            <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                            </a>
                            <a href="{{ url('home') }}" class="logo ml-lg-0 ">
                                <img src="<?= asset('frontend') ?>/images/header-logo.png" alt="logo" width="144"
                                    height="45" />
                            </a>

                             <form method="get" action="{{ route('productsearchdetails') }}"
                                class="header-search hs-expanded hs-round d-flex d-md-none input-wrapper home-mobile-search">
                                <input type="text" class="form-control" name="keywords" id="search_mobile_old"
                                    autocomplete="off" placeholder="Search in..." />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                </button>
                                <div class="search-suggest-box" id="search_suggest_mobile_old"></div>
                            </form> 
                            <form method="get" action="{{ route('productsearchdetails') }}"
                                class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                                <?php  
                            
                            $pincode_area = Session::get('pincode_area'); 
                            $pincode = Session::get('pincode');
                        
                            if($pincode_area) {
                            
                            ?>

                                <div class="select-box show-location" onclick="showPicodePopup()">

                                    <img class="location-icon" src="<?= asset('frontend') ?>/images/location_icon.svg"
                                        alt="location" />

                                    <marquee behavior="scroll" direction="left" scrollamount="3">
                                        <h6 class="location-text">
                                            {{ $pincode_area }} - {{ $pincode }}
                                        </h6>
                                    </marquee>
                                </div>

                                <?php   } ?>


                                <input type="text" class="form-control" name="keywords" id="search"
                                    autocomplete="off" placeholder="Search in..." />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                </button>
                                <div class="search-suggest-box" id="search_suggest_desktop"></div>
                            </form>
                        </div>
                        <div class="header-right ml-4">
                            <!-- <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:#" class="w-icon-call"></a>
                            <div class="call-info d-lg-show">
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                    <a href="mailto:#" class="text-capitalize">Call</a></h4>
                                <a href="tel:#" class="phone-number font-weight-bolder ls-50">+91 98845 88797</a>
                            </div>
                        </div> -->



                            <?php  if(session('customer_id')){ ?>

                            <a href="{{ route('myAccount') }}" class="compare label-down link d-xs-show mt-1">
                                  <i class="w-icon-account" style="font-size:24px;"></i>
                                <span class="compare-label d-lg-show mt-1">{{ $customerName ?: 'Account' }}</span>
                            </a>

                            <a class="wishlist label-down link d-xs-show" href="{{ route('myWallet') }}">
                                <i class="w-icon-wallet2"></i>
                                <span class="wishlist-label d-lg-show mt-1">Wallet </span>
                            </a>

                            <a class="wishlist label-down link d-xs-show" href="{{ route('myWishlist') }}">
                                <i class="w-icon-heart"></i>
                                <span class="wishlist-label d-lg-show mt-1">Wishlist</span>
                            </a>




                            <?php  }else{ ?>

                            <a href="javascript:void(0)" onclick="showLoginPopup()"
                                class="compare label-down link d-xs-show">
                                <i class="w-icon-account" style="font-size:28px;"></i>
                                <span class="compare-label d-lg-show mt-1">Login</span>
                            </a>

                            <?php } ?>
                            {{-- <a class="compare label-down link d-xs-show" href="compare.html">
                            <i class="w-icon-compare"></i>
                            <span class="compare-label d-lg-show">Compare</span>
                        </a> --}}
                            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                                <div class="cart-overlay"></div>
                                <a href="javascript:void(0)" onclick="showSideCart()"
                                    class="cart-toggle label-down link">
                                    <i class="w-icon-cart-header">
                                        <span class="cart-count ">0</span>
                                    </i>
                                    <span class="cart-label">Cart</span>
                                </a>
                                <div class="dropdown-box sideCart">

                                </div>
                                <!-- End of Dropdown Box -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Header Middle -->

                <!-- New Mobile Search Row -->
                <div class="mobile-search-row d-md-none">
                    <div class="mobile-location" onclick="showPicodePopup()" title="Change Location">
                        <img src="<?= asset('frontend') ?>/images/location_icon.svg" alt="loc" style="width:16px; height:16px;">
                        <marquee behavior="scroll" direction="left" scrollamount="2">
                            <span>
                                {{ Session::get('pincode_area') ?: 'Set Area' }} 
                                @if(Session::has('pincode')) - {{ Session::get('pincode') }} @endif
                            </span>
                        </marquee>
                    </div>

                    <form method="get" action="{{ route('productsearchdetails') }}" class="mobile-search-form">
                        <div class="search-input-group">
                            <i class="w-icon-search"></i>
                            <input type="text" name="keywords" id="search_mobile" 
                                autocomplete="off" placeholder="Search for products..." />
                        </div>
                        <div class="search-suggest-box" id="search_suggest_mobile"></div>
                    </form>
                    <a href="javascript:void(0)" id="clear_mobile_search" class="clear-search-btn">
                        <i class="w-icon-times-solid"></i>
                    </a>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var mobileInput = document.getElementById('search_mobile');
                        var clearBtn = document.getElementById('clear_mobile_search');
                        
                        if (mobileInput && clearBtn) {
                            mobileInput.addEventListener('input', function() {
                                clearBtn.style.display = (this.value.length > 0) ? 'flex' : 'none';
                            });
                            
                            clearBtn.addEventListener('click', function() {
                                mobileInput.value = '';
                                clearBtn.style.display = 'none';
                                mobileInput.focus();
                                // Trigger an input event to hide suggestions
                                mobileInput.dispatchEvent(new Event('input'));
                            });
                        }
                    });
                </script>

                <div class="header-bottom sticky-content fix-top sticky-header">
                    <div class="container">
                        <div class="inner-wrap">
                            <div class="header-left">
                                <div class="dropdown category-dropdown has-border " data-visible="true">
                                    <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true" data-display="static"
                                        title="Browse Categories">
                                        <i class="w-icon-category"></i>
                                        <span>Browse Categories</span>
                                    </a>
                                    <div class="dropdown-box text-default">
                                        <ul class="menu vertical-menu category-menu">
                                            @foreach ($categorymain as $categoriesmain)
                                                @if (count($categoriesmain->submenu) > 0)
                                                    <li>
                                                        <a href="{{ url('mainCategoryShop/' . $categoriesmain->id) }}">

                                                            {{ $categoriesmain->category_main_name }}
                                                        </a>
                                                        <ul class="megamenu">
                                                            @foreach ($categoriesmain->submenu as $submenus)
                                                                @if (count($submenus->childmenu) > 0)
                                                                    <li>
                                                                        <a href="{{ url('categoryShop/' . $submenus->id) }}">{{ $submenus->category_name }}</a>
                                                                        <hr class="divider">
                                                                        <ul>
                                                                            @foreach ($submenus->childmenu as $childmenus)
                                                                                <li><a href="{{ url('categoryShop/' . $submenus->id . '/' . $childmenus->id) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a href="{{ url('categoryShop/' . $submenus->id) }}">{{ $submenus->category_name }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach


                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a
                                                            href="{{ url('mainCategoryShop/' . $categoriesmain->id) }}">{{ $categoriesmain->category_main_name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                    </div>

                                </div>
                                <nav class="main-nav">
                                    <ul class="menu active-underline">
                                        <li>
                                            <a href="{{ url('home') }}"><i class="w-icon-home"></i> Home</a>
                                        </li>
                                        {{-- <li>
                                        <a href="shop-banner-sidebar.html">Shop</a>

                                        <ul class="megamenu">
                                            <li>
                                                <h4 class="menu-title">Shop Pages</h4>
                                                <ul>
                                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                                    <li><a href="shop-horizontal-filter.html">Horizontal Filter<span
                                                                class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="shop-off-canvas.html">Off Canvas Sidebar<span
                                                                class="tip tip-new">New</span></a></li>
                                                    <li><a href="shop-infinite-scroll.html">Infinite Ajax Scroll</a>
                                                    </li>
                                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-both-sidebar.html">Both Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Layouts</h4>
                                                <ul>
                                                    <li><a href="shop-grid-3cols.html">3 Columns Mode</a></li>
                                                    <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                                                    <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                                                    <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                                                    <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                                                    <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                                                    <li><a href="shop-list.html">List Mode</a></li>
                                                    <li><a href="shop-list-sidebar.html">List Mode With Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Pages</h4>
                                                <ul>
                                                    <li><a href="product-variable.html">Variable Product</a></li>
                                                    <li><a href="product-featured.html">Featured &amp; Sale</a></li>
                                                    <li><a href="product-accordion.html">Data In Accordion</a></li>
                                                    <li><a href="product-section.html">Data In Sections</a></li>
                                                    <li><a href="product-swatch.html">Image Swatch</a></li>
                                                    <li><a href="product-extended.html">Extended Info</a>
                                                    </li>
                                                    <li><a href="product-without-sidebar.html">Without Sidebar</a></li>
                                                    <li><a href="product-video.html">360<sup>o</sup> &amp; Video<span
                                                                class="tip tip-new">New</span></a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Layouts</h4>
                                                <ul>
                                                    <li><a href="product-default.html">Default<span
                                                                class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="product-vertical.html">Vertical Thumbs</a></li>
                                                    <li><a href="product-grid.html">Grid Images</a></li>
                                                    <li><a href="product-masonry.html">Masonry</a></li>
                                                    <li><a href="product-gallery.html">Gallery</a></li>
                                                    <li><a href="product-sticky-info.html">Sticky Info</a></li>
                                                    <li><a href="product-sticky-thumb.html">Sticky Thumbs</a></li>
                                                    <li><a href="product-sticky-both.html">Sticky Both</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> --}}
                                        <li>
                                            <a href="{{ url('shops') }}"> <i class="w-icon-vendor-store"></i>
                                                Shops</a>
                                            {{-- <ul>
                                            <li>
                                                <a href="vendor-dokan-store-list.html">Store Listing</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                                    <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                                    <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                                    <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="vendor-dokan-store.html">Vendor Store</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                                    <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a>
                                                    </li>
                                                    <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a>
                                                    </li>
                                                    <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            
                                        </ul> --}}
                                        </li>

                                        <li> <a href="{{ url('mainCategoryShop') . '/' . '1' }}"><i
                                                    class="w-icon-tshirt"></i> Men</a></li>

                                        <li><a href="{{ url('mainCategoryShop') . '/' . '3' }}"><i
                                                    class="w-icon-tshirt2"></i> Women</a></li>

                                        <li><a href="{{ url('mainCategoryShop') . '/' . '2' }}"> <i
                                                    class="w-icon-basketball"></i> Kids</a></li>
                                        <li><a href="{{ url('mainCategoryShop') . '/' . '4' }}"> <i
                                                    class="w-icon-shopify"></i> Living</a></li>
                                        {{-- <li><a href="">Location</a></li> --}}
                                        {{-- <li >
                                        <a href="vendor-dokan-store.html">Offers</a>
                                        
                                    </li> --}}
                                        {{-- <li>
                                        <a href="blog.html">Blog</a>
                                        <ul>
                                            <li><a href="blog.html">Classic</a></li>
                                            <li><a href="blog-listing.html">Listing</a></li>
                                            <li>
                                                <a href="blog-grid-3cols.html">Grid</a>
                                                <ul>
                                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-masonry-3cols.html">Masonry</a>
                                                <ul>
                                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-mask-grid.html">Mask</a>
                                                <ul>
                                                    <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                                    <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="post-single.html">Single Post</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                        {{-- <li>
                                        <a href="about-us.html">Pages</a>
                                        <ul>

                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                                            <li><a href="contact-us.html">Contact Us</a></li>
                                            <li><a href="faq.html">FAQs</a></li>
                                            <li><a href="error-404.html">Error 404</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="compare.html">Compare</a></li>
                                        </ul>
                                    </li> --}}
                                        {{-- <li>
                                        <a href="elements.html">Elements</a>
                                        <ul>
                                            <li><a href="element-accordions.html">Accordions</a></li>
                                            <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                                            <li><a href="element-blog-posts.html">Blog Posts</a></li>
                                            <li><a href="element-buttons.html">Buttons</a></li>
                                            <li><a href="element-cta.html">Call to Action</a></li>
                                            <li><a href="element-icons.html">Icons</a></li>
                                            <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                                            <li><a href="element-instagrams.html">Instagrams</a></li>
                                            <li><a href="element-categories.html">Product Category</a></li>
                                            <li><a href="element-products.html">Products</a></li>
                                            <li><a href="element-tabs.html">Tabs</a></li>
                                            <li><a href="element-testimonials.html">Testimonials</a></li>
                                            <li><a href="element-titles.html">Titles</a></li>
                                            <li><a href="element-typography.html">Typography</a></li>

                                            <li><a href="element-vendors.html">Vendors</a></li>
                                        </ul>
                                    </li> --}}
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right">
                                <a href="{{ url('offers') }}"><i class="w-icon-sale"></i>Offer Products</a>
                                <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track
                                    Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End of Header -->
            <script>
                (function() {
                    var productEndpoint = "{{ route('ajax.search') }}";
                    var vendorEndpoint = "{{ route('ajax.vendor.search') }}";
                    var defaultSuggestImage = "{{ asset('frontend/images/favicon.png') }}";
                    var isShopsPage = window.location.pathname.replace(/\/+$/, '') === '/shops';

                    function escapeHtml(value) {
                        return String(value || '').replace(/[<>&"]/g, function(ch) {
                            return ({
                                '<': '&lt;',
                                '>': '&gt;',
                                '&': '&amp;',
                                '"': '&quot;'
                            })[ch];
                        });
                    }

                    function navigateToSuggestion(item, input, form) {
                        if (!item) return;
                        if (item.url) {
                            window.location.href = item.url;
                            return;
                        }
                        input.value = item.value || '';
                        form.submit();
                    }

                    function setupSearchSuggest(inputId, boxId) {
                        var input = document.getElementById(inputId);
                        var box = document.getElementById(boxId);
                        if (!input || !box) return;

                        var form = input.closest('form');
                        var endpoint = isShopsPage ? vendorEndpoint : productEndpoint;
                        if (isShopsPage && form) {
                            form.setAttribute('action', "{{ route('shops') }}");
                        }
                        var suggestions = [];
                        var activeIndex = -1;
                        var debounceTimer = null;
                        var reqSeq = 0;

                        function hideBox() {
                            box.style.display = 'none';
                            box.innerHTML = '';
                            suggestions = [];
                            activeIndex = -1;
                        }

                        function render(items) {
                            if (!items || !items.length) {
                                hideBox();
                                return;
                            }
                            suggestions = items;
                            activeIndex = -1;
                            box.innerHTML = items.map(function(item, idx) {
                                var safeValue = escapeHtml(item.value);
                                var safeType = escapeHtml(item.type || 'search');
                                var imgSrc = item.image ? item.image : defaultSuggestImage;
                                var imageHtml = '<img class="search-suggest-thumb" style="width:34px;height:34px;display:block;object-fit:cover;border-radius:4px;flex:0 0 34px;" src="' + escapeHtml(imgSrc) + '" alt="' + safeValue + '" onerror="this.src=\'' + escapeHtml(defaultSuggestImage) + '\'">';
                                return '<div class="search-suggest-item" data-index="' + idx + '">' +
                                    '<span class="search-suggest-left">' + imageHtml + '<span class="search-suggest-text">' + safeValue + '</span></span>' +
                                    '<span class="search-suggest-type">' + safeType + '</span>' +
                                    '</div>';
                            }).join('');
                            box.style.display = 'block';
                        }

                        function setActive(idx) {
                            var items = box.querySelectorAll('.search-suggest-item');
                            items.forEach(function(el) {
                                el.classList.remove('active');
                            });
                            if (idx >= 0 && idx < items.length) {
                                items[idx].classList.add('active');
                                activeIndex = idx;
                            }
                        }

                        function fetchSuggest(query) {
                            reqSeq += 1;
                            var currentReq = reqSeq;
                            fetch(endpoint + '?q=' + encodeURIComponent(query), {
                                    method: 'GET'
                                })
                                .then(function(res) {
                                    return res.ok ? res.json() : {
                                        suggestions: []
                                    };
                                })
                                .then(function(data) {
                                    if (currentReq !== reqSeq) return;
                                    render((data && data.suggestions) ? data.suggestions : []);
                                })
                                .catch(function() {
                                    hideBox();
                                });
                        }

                        input.addEventListener('input', function() {
                            var value = input.value.trim();
                            if (debounceTimer) clearTimeout(debounceTimer);
                            if (value.length < 2) {
                                hideBox();
                                return;
                            }
                            debounceTimer = setTimeout(function() {
                                fetchSuggest(value);
                            }, 250);
                        });

                        input.addEventListener('keydown', function(e) {
                            if (box.style.display !== 'block') return;
                            if (e.key === 'ArrowDown') {
                                e.preventDefault();
                                setActive(Math.min(activeIndex + 1, suggestions.length - 1));
                            } else if (e.key === 'ArrowUp') {
                                e.preventDefault();
                                setActive(Math.max(activeIndex - 1, 0));
                            } else if (e.key === 'Enter' && activeIndex >= 0 && suggestions[activeIndex]) {
                                e.preventDefault();
                                hideBox();
                                navigateToSuggestion(suggestions[activeIndex], input, form);
                            } else if (e.key === 'Escape') {
                                hideBox();
                            }
                        });

                        box.addEventListener('mousedown', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var item = e.target.closest('.search-suggest-item');
                            if (!item) return;
                            var idx = parseInt(item.getAttribute('data-index'), 10);
                            if (!isNaN(idx) && suggestions[idx]) {
                                var selected = suggestions[idx];
                                hideBox();
                                setTimeout(function() {
                                    navigateToSuggestion(selected, input, form);
                                }, 0);
                                return;
                            }
                            hideBox();
                        });

                        box.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var item = e.target.closest('.search-suggest-item');
                            if (!item) return;
                            var idx = parseInt(item.getAttribute('data-index'), 10);
                            if (!isNaN(idx) && suggestions[idx]) {
                                var selected = suggestions[idx];
                                hideBox();
                                setTimeout(function() {
                                    navigateToSuggestion(selected, input, form);
                                }, 0);
                            }
                        });

                        document.addEventListener('click', function(e) {
                            if (!form.contains(e.target)) {
                                hideBox();
                            }
                        });

                        form.addEventListener('submit', function() {
                            hideBox();
                        });
                    }

                    setupSearchSuggest('search', 'search_suggest_desktop');
                    setupSearchSuggest('search_mobile', 'search_suggest_mobile');
                })();
            </script>
