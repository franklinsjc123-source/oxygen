<?php
if (!session()->has('pincode') && session()->has('customer_id')) {
    $customerId = session('customer_id');
    $customerInfo = \App\Models\Ecom_Customer_info::where('customer_id', $customerId)->first();
    if ($customerInfo && $customerInfo->customer_pincode) {
        $pincodeRecord = \App\Models\PinCode\PinCode::where('name', $customerInfo->customer_pincode)->first();
        if ($pincodeRecord) {
            session([
                'pincode' => $customerInfo->customer_pincode,
                'pincode_area' => $pincodeRecord->area,
                'post_region' => $pincodeRecord->post_region
            ]);
        }
    }
}
?>
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
    $menCategory = $categorymain->firstWhere('slug', 'men') ?? $categorymain->filter(fn($c) => strtolower($c->category_main_name) === 'men')->first();
    $womenCategory = $categorymain->firstWhere('slug', 'women') ?? $categorymain->filter(fn($c) => strtolower($c->category_main_name) === 'women')->first();
    $kidsCategory = $categorymain->firstWhere('slug', 'kids') ?? $categorymain->filter(fn($c) => strtolower($c->category_main_name) === 'kids')->first();
    $livingCategory = $categorymain->firstWhere('slug', 'living-personalized') ?? $categorymain->filter(fn($c) => str_contains(strtolower($c->category_main_name), 'living'))->first();
    
    $count = Cart::getContent()->count();
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
            .header-middle .container .header-right a.header-wishlist-btn,
            .header-middle .container .header-right .cart-dropdown,
            .header-middle .container .header-right .cart-dropdown .cart-toggle {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                height: 32px !important;
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .header-middle .container .header-right a.header-wishlist-btn {
                margin-right: 15px !important;
                color: #fff !important;
            }
            .header-middle .container .header-right a.header-wishlist-btn i,
            .header-middle .container .header-right .cart-dropdown .cart-toggle i {
                font-size: 22px !important;
                color: #fff !important;
                display: inline-block !important;
                line-height: 1 !important;
                position: relative !important;
            }
            .header-middle .container .header-right a.header-wishlist-btn i span.wishcount,
            .header-middle .container .header-right .cart-dropdown .cart-toggle i span.cart-count {
                position: absolute !important;
                top: -8px !important;
                right: -10px !important;
                width: 16px !important;
                height: 16px !important;
                border-radius: 50% !important;
                font-size: 10px !important;
                font-weight: 500 !important;
                line-height: 16px !important;
                background: #ff5b5b !important;
                color: #fff !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-style: normal !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .mobile-search-row {
                background: #e1f3ff;
                padding: 10px 12px; /* Increased padding */
                display: flex;
                align-items: center;
                gap: 8px;
                border-bottom: 1px solid #cce8f9;
                min-height: 50px; /* Ensure enough height */
            }
            .mobile-search-row .mobile-location {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                flex: 0 0 55px;
                width: 55px;
                cursor: pointer;
                gap: 1px;
                overflow: hidden;
            }
            .mobile-search-row .mobile-location marquee {
                width: 100%;
                display: block;
                line-height: 1;
            }
            .mobile-search-row .mobile-location span {
                font-size: 8px;
                font-weight: 800;
                color: #0088dd;
                text-transform: uppercase;
                white-space: nowrap;
                display: block;
            }
            
            .mobile-search-row .mobile-search-form {
                flex: 1;
                min-width: 0;
                position: relative;
                margin: 0; /* Remove potential margins */
            }
            .mobile-search-row .search-input-group {
                background: #fff;
                border: 1px solid #0088dd;
                border-radius: 25px;
                padding: 6px 15px; /* Better internal padding */
                display: flex;
                align-items: center;
                gap: 10px;
                height: 38px; /* Fixed height for pill */
            }
            .mobile-search-row .search-input-group i {
                font-size: 16px;
                color: #0088dd;
                flex-shrink: 0;
            }
            .mobile-search-row .search-input-group input {
                border: none !important;
                width: 100%;
                outline: none !important;
                font-size: 14px;
                background: transparent;
                height: 100%;
                padding: 0;
                margin: 0;
                box-shadow: none !important;
            }
            .mobile-search-row .clear-search-btn {
                font-size: 18px;
                color: #666;
                width: 30px;
                height: 38px; /* Match input height */
                display: none;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
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
            max-height: 100vh;
            height: 100vh;
            width: 350px;
            padding: 0;
            background: #fff;
        }

        .sideCart .cart-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9f9f9;
        }

        .sideCart .cart-header span {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }

        .sideCart .products {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            padding: 10px 20px;
        }

        .sideCart .product-cart {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f1f1;
            position: relative;
            gap: 12px;
        }

        .sideCart .product-media {
            width: 70px;
            height: 70px;
            margin: 0;
            flex-shrink: 0;
        }

        .sideCart .product-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
        }

        .sideCart .product-detail {
            flex: 1;
            min-width: 0;
        }

        .sideCart .product-name {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sideCart .price-box {
            font-size: 13px;
            color: #666;
        }

        .sideCart .product-quantity::after {
            content: ' x ';
            margin: 0 4px;
        }

        .sideCart .product-price {
            font-weight: 700;
            color: #0088dd;
        }

        .sideCart .btn-close {
            position: absolute;
            right: -5px;
            top: 10px;
            font-size: 14px;
            color: #aaa;
        }

        .sideCart .cart-total {
            padding: 15px 20px;
            background: #fdfdfd;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sideCart .cart-total label {
            font-weight: 600;
            color: #333;
        }

        .sideCart .cart-total .price {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .sideCart .cart-action {
            padding: 15px 20px 25px;
            display: flex;
            gap: 10px;
            background: #fff;
        }

        .sideCart .cart-action .btn {
            flex: 1;
            padding: 12px 5px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 4px;
        }

        @media (max-width: 767px) {
            .cart-dropdown.cart-offcanvas .dropdown-box.sideCart {
                width: 300px;
                max-width: 85vw;
            }
        }
        
        @media (max-width: 480px) {
            .cart-dropdown.cart-offcanvas .dropdown-box.sideCart {
                width: 320px;
                max-width: 90vw;
            }
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
            font-size: 13px !important;
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
            /* display: flex; */
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

        /* ── Uniform Product Image Sizes ── */
        .product-media > a > img {
            width: 100% !important;
            height: 220px !important;
            object-fit: cover !important;
            object-position: center !important;
        }
        @supports (aspect-ratio: 1/1) {
            .product-media > a > img {
                aspect-ratio: 260 / 291 !important;
                height: auto !important;
            }
        }
        @media (max-width: 768px) {
            .product-media > a > img {
                height: 185px !important;
            }
            @supports (aspect-ratio: 1/1) {
                .product-media > a > img {
                    height: auto !important;
                }
            }
        }

        /* ── Premium Horizontal Megamenu Styling for Main Nav ── */
        .main-nav .menu > li > .megamenu {
            display: none !important;
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            width: 1000px !important;
            min-width: 800px !important;
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            border-radius: 0 0 12px 12px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.03) !important;
            padding: 18px 22px !important;
            z-index: 99999 !important;
            flex-wrap: wrap !important;
            flex-direction: row !important;
        }

        .main-nav .menu > li:hover > .megamenu,
        .main-nav .menu > li.mega-hover > .megamenu {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            transform: none !important;
        }

        /* Megamenu columns */
        .main-nav .menu .megamenu > li {
            flex: 0 0 190px !important;
            max-width: 190px !important;
            border-right: 1px solid #f1f5f9 !important;
            padding: 4px 14px !important;
            margin: 0 !important;
            list-style: none !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .main-nav .menu .megamenu > li:last-child {
            border-right: none !important;
        }

        /* Column Heading */
        .main-nav .menu .megamenu > li > a {
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            padding: 0 0 6px 0 !important;
            margin: 0 0 8px 0 !important;
            border-bottom: 2px solid #0088dd !important;
            display: block !important;
            position: relative !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .main-nav .menu .megamenu > li > a:hover {
            color: #0088dd !important;
        }

        /* Inner list */
        .main-nav .menu .megamenu > li ul {
            padding: 0 !important;
            margin: 10px 0 0 0 !important;
            list-style: none !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 1px !important;
        }

        .main-nav .menu .megamenu > li ul li {
            padding: 0 !important;
            margin: 0 !important;
            list-style: none !important;
        }

        /* Sub-links */
        .main-nav .menu .megamenu > li ul li a {
            padding: 3px 6px !important;
            margin-bottom: 1px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #475569 !important;
            border-radius: 6px !important;
            transition: all 0.2s ease-in-out !important;
            display: block !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            background-color: transparent !important;
            text-transform: none !important;
        }

        .main-nav .menu .megamenu > li ul li a:hover {
            color: #0088dd !important;
            background-color: #f1f6fa !important;
            padding-left: 12px !important;
        }

        .main-nav .menu .megamenu .divider {
            display: none !important;
        }

        .main-nav {
            position: relative !important;
        }

        .main-nav .menu > li {
            position: static !important;
        }


            /* Mobile Category Nav Bar styles */
            .mobile-categories-nav-wrapper {
                background: #f8fcff;
                border-bottom: 1px solid #ddecf8;
                padding: 4px 0;
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
            .mobile-categories-nav-wrapper::-webkit-scrollbar {
                display: none;
            }
            .mobile-categories-nav {
                display: flex;
                padding: 0 15px;
                gap: 12px;
            }
            .mobile-cat-nav-item {
                font-size: 13px !important;
                font-weight: 700 !important;
                color: #333333;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding-bottom: 1px;
                border-bottom: 2px solid transparent;
                transition: all 0.3s ease;
            }
            .mobile-cat-nav-item.active {
                color: #0088dd;
                border-bottom-color: #0088dd;
            }
            .mobile-cat-nav-item i {
                font-size: 10px;
                transition: transform 0.3s;
            }
            .mobile-cat-nav-item.active i {
                transform: rotate(180deg);
            }

            /* Mobile Category Dropdowns styles */
            .mobile-categories-dropdowns {
                position: relative;
                z-index: 1000;
            }
            .mobile-cat-dropdown-panel {
                background: #ffffff;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                border-bottom: 2px solid #0088dd;
                max-height: 380px;
                overflow-y: auto;
                padding: 6px 10px;
                display: none;
                animation: slideDown 0.3s ease;
            }
            @keyframes slideDown {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .mobile-cat-group {
                margin-bottom: 6px;
            }
            .mobile-cat-group:last-child {
                margin-bottom: 0;
            }
            .mobile-cat-title {
                font-size: 12px;
                font-weight: 700;
                color: #0088dd;
                text-transform: uppercase;
                margin-bottom: 2px;
                border-bottom: 1px solid #f0f0f0;
                padding-bottom: 1px;
            }
            .mobile-cat-title a {
                color: inherit;
                text-decoration: none;
            }
            .mobile-cat-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
            }
            .mobile-cat-list li {
                width: calc(50% - 5px);
            }
            .mobile-cat-list li a {
                font-size: 11px;
                color: #666666;
                text-decoration: none;
                display: block;
                padding: 0;
                transition: color 0.2s;
            }
            .offer-icon-btn {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                color: #183543 !important;
                padding: 0 5px !important;
                border-bottom: none !important;
                margin-left: auto !important;
            }
            .offer-icon-btn i {
                font-size: 18px !important;
                color: #183543 !important;
            }
            /* Auction Pulse Icon Animation */
            .auction-pulse-btn {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                color: #183543 !important;
                padding: 0 5px !important;
                border-bottom: none !important;
                margin-left: 10px !important;
            }
            .auction-pulse-btn i {
                font-size: 18px !important;
                animation: gavelPulse 1.2s infinite ease-in-out !important;
                color: #183543 !important;
            }
            @keyframes gavelPulse {
                0% { transform: scale(1); filter: drop-shadow(0 0 1px rgba(24,53,67,0.4)); }
                50% { transform: scale(1.4); filter: drop-shadow(0 0 6px rgba(24,53,67,0.8)); }
                100% { transform: scale(1); filter: drop-shadow(0 0 1px rgba(24,53,67,0.4)); }
            }
        }
    </style>

    {{-- JavaScript hover handler for main-nav megamenu --}}
    <script>
        $(document).ready(function() {
            // Target only main-nav menu items that have a .megamenu child
            $('.main-nav .menu > li').has('.megamenu').each(function() {
                var $li = $(this);
                var $mega = $li.children('.megamenu');

                $li.on('mouseenter', function() {
                    $li.addClass('mega-hover');
                    $mega.css({
                        'display': 'flex',
                        'visibility': 'visible',
                        'opacity': '1',
                        'position': 'absolute',
                        'top': '100%',
                        'left': '0',
                        'z-index': '99999',
                        'pointer-events': 'auto'
                    });
                });

                $li.on('mouseleave', function() {
                    $li.removeClass('mega-hover');
                    $mega.css({
                        'display': 'none'
                    });
                });
            });
        });
    </script>

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
                            
                            if (!$pincode_area && session('customer_id')) {
                                $customer = \App\Models\Ecom_Customer_info::where('customer_id', session('customer_id'))->first();
                                if ($customer && $customer->customer_pincode) {
                                    $pincodeRecord = \App\Models\PinCode\PinCode::where('name', $customer->customer_pincode)->first();
                                    if ($pincodeRecord) {
                                        $pincode = $customer->customer_pincode;
                                        $pincode_area = $pincodeRecord->area ?: $pincodeRecord->post_region;
                                        Session::put('pincode', $pincode);
                                        Session::put('pincode_area', $pincode_area);
                                        if ($pincodeRecord->post_region) {
                                            Session::put('post_region', $pincodeRecord->post_region);
                                        }
                                    }
                                }
                            }
                        
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


                                <div style="position:relative; flex:1; display:flex;">
                                    <input type="text" class="form-control" name="keywords" id="search" value="{{ request('keywords') }}"
                                        autocomplete="off" placeholder="Search in..." style="padding-right: 30px;" />
                                    <a href="javascript:void(0)" id="clear_desktop_search" class="clear-search-btn" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:16px; color:#666; display:none; align-items:center; justify-content:center; text-decoration:none;">
                                        <i class="w-icon-times-solid"></i>
                                    </a>
                                </div>
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

                            <a class="wishlist header-wishlist-btn label-down link d-xs-show" href="{{ route('myWishlist') }}">
                                <i class="w-icon-heart" style="position: relative;">
                                    <span class="wishcount" style="position:absolute; top:-5px; right:-8px; width:1.9rem; height:1.9rem; border-radius:50%; font-style:normal; z-index:1; font-size:1.1rem; font-weight:400; line-height:1.9rem; background:#ff5b5b; color:#fff; text-align:center;">0</span>
                                </i>
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
                    @if(Session::has('pincode'))
                    <div class="mobile-location" onclick="showPicodePopup()" title="Change Location">
                        <img src="<?= asset('frontend') ?>/images/location_icon.svg" alt="loc" style="width:16px; height:16px;">
                        <marquee behavior="scroll" direction="left" scrollamount="2">
                            <span>
                                {{ Session::get('pincode_area') ?: 'Area' }} - {{ Session::get('pincode') }}
                            </span>
                        </marquee>
                    </div>
                    @endif

                    <form method="get" action="{{ route('productsearchdetails') }}" class="mobile-search-form">
                        <div class="search-input-group">
                            <i class="w-icon-search"></i>
                            <input type="text" name="keywords" id="search_mobile" value="{{ request('keywords') }}"
                                autocomplete="off" placeholder="Search for products..." />
                            <a href="javascript:void(0)" id="clear_mobile_search" class="clear-search-btn">
                                <i class="w-icon-times-solid"></i>
                            </a>
                        </div>
                        <div class="search-suggest-box" id="search_suggest_mobile"></div>
                    </form>
                </div>

                <!-- Mobile Category Navigation Bar -->
                <div class="mobile-categories-nav-wrapper d-md-none">
                    <div class="mobile-categories-nav">
                        @if(isset($menCategory) && $menCategory)
                            <a href="javascript:void(0)" class="mobile-cat-nav-item" data-target="mobile-cat-men">Men <i class="w-icon-angle-down"></i></a>
                        @endif
                        @if(isset($womenCategory) && $womenCategory)
                            <a href="javascript:void(0)" class="mobile-cat-nav-item" data-target="mobile-cat-women">Women <i class="w-icon-angle-down"></i></a>
                        @endif
                        @if(isset($kidsCategory) && $kidsCategory)
                            <a href="javascript:void(0)" class="mobile-cat-nav-item" data-target="mobile-cat-kids">Kids <i class="w-icon-angle-down"></i></a>
                        @endif
                        @if(isset($livingCategory) && $livingCategory)
                            <a href="javascript:void(0)" class="mobile-cat-nav-item" data-target="mobile-cat-living">Living <i class="w-icon-angle-down"></i></a>
                        @endif
                        <a href="{{ url('offers') }}" class="offer-icon-btn" title="Offers"><i class="w-icon-sale"></i></a>
                        <a href="{{ url('auction') }}" class="auction-pulse-btn" title="Live Auction"><i class="fas fa-gavel"></i></a>
                    </div>
                </div>

                <!-- Dropdown Menus for Mobile Categories -->
                <div class="mobile-categories-dropdowns d-md-none">
                    @if(isset($menCategory) && $menCategory && count($menCategory->submenu) > 0)
                        <div class="mobile-cat-dropdown-panel" id="mobile-cat-men" style="display:none;">
                            @foreach($menCategory->submenu as $submenus)
                                @if(count($submenus->childmenu) > 0)
                                <div class="mobile-cat-group">
                                    <h6 class="mobile-cat-title">
                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                    </h6>
                                    
                                        <ul class="mobile-cat-list">
                                            @foreach($submenus->childmenu as $childmenus)
                                                <li>
                                                    <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if(isset($womenCategory) && $womenCategory && count($womenCategory->submenu) > 0)
                        <div class="mobile-cat-dropdown-panel" id="mobile-cat-women" style="display:none;">
                            @foreach($womenCategory->submenu as $submenus)
                                @if(count($submenus->childmenu) > 0)
                                <div class="mobile-cat-group">
                                    <h6 class="mobile-cat-title">
                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                    </h6>
                                    
                                        <ul class="mobile-cat-list">
                                            @foreach($submenus->childmenu as $childmenus)
                                                <li>
                                                    <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if(isset($kidsCategory) && $kidsCategory && count($kidsCategory->submenu) > 0)
                        <div class="mobile-cat-dropdown-panel" id="mobile-cat-kids" style="display:none;">
                            @foreach($kidsCategory->submenu as $submenus)
                                @if(count($submenus->childmenu) > 0)
                                <div class="mobile-cat-group">
                                    <h6 class="mobile-cat-title">
                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                    </h6>
                                    
                                        <ul class="mobile-cat-list">
                                            @foreach($submenus->childmenu as $childmenus)
                                                <li>
                                                    <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if(isset($livingCategory) && $livingCategory && count($livingCategory->submenu) > 0)
                        <div class="mobile-cat-dropdown-panel" id="mobile-cat-living" style="display:none;">
                            @foreach($livingCategory->submenu as $submenus)
                                @if(count($submenus->childmenu) > 0)
                                <div class="mobile-cat-group">
                                    <h6 class="mobile-cat-title">
                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                    </h6>
                                    
                                        <ul class="mobile-cat-list">
                                            @foreach($submenus->childmenu as $childmenus)
                                                <li>
                                                    <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var mobileInput = document.getElementById('search_mobile');
                        var clearBtn = document.getElementById('clear_mobile_search');
                        
                        if (mobileInput && clearBtn) {
                            if (mobileInput.value.length > 0) {
                                clearBtn.style.display = 'flex';
                            }
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

                        var desktopInput = document.getElementById('search');
                        var clearDesktopBtn = document.getElementById('clear_desktop_search');
                        if (desktopInput && clearDesktopBtn) {
                            if (desktopInput.value.length > 0) {
                                clearDesktopBtn.style.display = 'flex';
                            }
                            desktopInput.addEventListener('input', function() {
                                clearDesktopBtn.style.display = (this.value.length > 0) ? 'flex' : 'none';
                            });
                            
                            clearDesktopBtn.addEventListener('click', function() {
                                desktopInput.value = '';
                                clearDesktopBtn.style.display = 'none';
                                desktopInput.focus();
                                desktopInput.dispatchEvent(new Event('input'));
                            });
                        }

                        // Mobile Category Navigation Dropdown Interaction
                        var catLinks = document.querySelectorAll('.mobile-cat-nav-item');
                        var panels = document.querySelectorAll('.mobile-cat-dropdown-panel');
                        
                        catLinks.forEach(function(link) {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                
                                var targetId = this.getAttribute('data-target');
                                var targetPanel = document.getElementById(targetId);
                                var isActive = this.classList.contains('active');
                                
                                // Close all panels
                                panels.forEach(function(panel) {
                                    panel.style.display = 'none';
                                });
                                catLinks.forEach(function(l) {
                                    l.classList.remove('active');
                                });
                                
                                if (!isActive && targetPanel) {
                                    this.classList.add('active');
                                    targetPanel.style.display = 'block';
                                }
                            });
                        });
                        
                        // Close panel if clicked outside
                        document.addEventListener('click', function(e) {
                            if (!e.target.closest('.mobile-categories-nav-wrapper') && !e.target.closest('.mobile-categories-dropdowns')) {
                                panels.forEach(function(panel) {
                                    panel.style.display = 'none';
                                });
                                catLinks.forEach(function(l) {
                                    l.classList.remove('active');
                                });
                            }
                        });
                    });
                </script>

                <div class="header-bottom sticky-content fix-top sticky-header">
                    <div class="container">
                        <div class="inner-wrap">
                            <div class="header-left">
                                {{--
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
                                                        <a href="{{ url('main-category/' . ($categoriesmain->slug ?? $categoriesmain->id)) }}">

                                                            {{ $categoriesmain->category_main_name }}
                                                        </a>
                                                        <ul class="megamenu">
                                                            @foreach ($categoriesmain->submenu as $submenus)
                                                                @if (count($submenus->childmenu) > 0)
                                                                    <li>
                                                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                        <hr class="divider">
                                                                        <ul>
                                                                            @foreach ($submenus->childmenu as $childmenus)
                                                                                <li><a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach


                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a
                                                            href="{{ url('main-category/' . ($categoriesmain->slug ?? $categoriesmain->id)) }}">{{ $categoriesmain->category_main_name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                    </div>

                                </div>
                                --}}
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

                                        @if ($menCategory && count($menCategory->submenu) > 0)
                                            <li>
                                                <a href="{{ url('main-category/men') }}"><i class="w-icon-tshirt"></i> Men</a>
                                                <ul class="megamenu">
                                                    @foreach ($menCategory->submenu as $submenus)
                                                        @if (count($submenus->childmenu) > 0)
                                                            <li>
                                                                <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach ($submenus->childmenu as $childmenus)
                                                                        <li><a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li> <a href="{{ url('main-category/men') }}"><i class="w-icon-tshirt"></i> Men</a></li>
                                        @endif

                                        @if ($womenCategory && count($womenCategory->submenu) > 0)
                                            <li>
                                                <a href="{{ url('main-category/women') }}"><i class="w-icon-tshirt2"></i> Women</a>
                                                <ul class="megamenu">
                                                    @foreach ($womenCategory->submenu as $submenus)
                                                        @if (count($submenus->childmenu) > 0)
                                                            <li>
                                                                <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach ($submenus->childmenu as $childmenus)
                                                                        <li><a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('main-category/women') }}"><i class="w-icon-tshirt2"></i> Women</a></li>
                                        @endif

                                        @if ($kidsCategory && count($kidsCategory->submenu) > 0)
                                            <li>
                                                <a href="{{ url('main-category/kids') }}"><i class="w-icon-basketball"></i> Kids</a>
                                                <ul class="megamenu">
                                                    @foreach ($kidsCategory->submenu as $submenus)
                                                        @if (count($submenus->childmenu) > 0)
                                                            <li>
                                                                <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach ($submenus->childmenu as $childmenus)
                                                                        <li><a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('main-category/kids') }}"> <i class="w-icon-basketball"></i> Kids</a></li>
                                        @endif

                                        @if ($livingCategory && count($livingCategory->submenu) > 0)
                                            <li>
                                                <a href="{{ url('main-category/living-personalized') }}"><i class="w-icon-shopify"></i> Living</a>
                                                <ul class="megamenu">
                                                    @foreach ($livingCategory->submenu as $submenus)
                                                        @if (count($submenus->childmenu) > 0)
                                                            <li>
                                                                <a href="{{ url('category/' . ($submenus->slug ?? $submenus->id)) }}">{{ $submenus->category_name }}</a>
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach ($submenus->childmenu as $childmenus)
                                                                        <li><a href="{{ url('category/' . ($submenus->slug ?? $submenus->id) . '/' . ($childmenus->slug ?? $childmenus->id)) }}">{{ $childmenus->category_sub_name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('main-category/living-personalized') }}"> <i class="w-icon-shopify"></i> Living</a></li>
                                        @endif
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
                                <a href="{{ url('offers') }}"><i class="w-icon-sale"></i>Offers</a>
                                <a href="{{ url('auction') }}" style="margin-left: 20px; display: inline-flex; align-items: center;"><i class="fas fa-gavel" style="margin-right: 6px; font-size: 18px;"></i>Auction</a>
                                @if(session('customer_id'))
                                    <a href="{{ url('track-order') }}" class="d-xl-show" style="margin-left: 20px;"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                                @else
                                    <a href="javascript:void(0)" onclick="showLoginPopup()" class="d-xl-show" style="margin-left: 20px;"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                                @endif
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
