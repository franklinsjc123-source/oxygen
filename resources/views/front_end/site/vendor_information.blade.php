<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Oxygen - Shopping Site</title>

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

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="demo1.html">Home</a></li>
                        <li><a href="#">Vendor</a></li>
                        <li><a href="#">{{$vendordetails->shop_name}}</a></li>
                        <li>Store</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Pgae Contetn -->
            <div class="page-content mb-8">
                <div class="container">
                    <div class="store store-wcfm-banner">
                        <figure class="store-media">
                            <img src="{{ asset('website_assets/images/vendor/shop.png') }}"  alt="Vendor" width="1240" height="460"
                                style="background-color: #40475e;" />
                        </figure>
                        <div class="store-content">
                            <div class="store-content-left mr-auto">
                                <div class="personal-info">
                                    <figure class="seller-brand">
                                        <img src="{{ asset('assets/images/vendor/profile/'.$vendordetails->profile_image)}}"  alt="Brand" width="100"
                                            height="100" />
                                            
                                    </figure>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="address-info">
                                    <h4 class="store-title">{{$vendordetails->shop_name}}</h4>
                                    <ul class="seller-info-list list-style-none">
                                        <li class="store-address">
                                            <i class="w-icon-map-marker"></i>
                                            {{$vendordetails->owner_name}},
                                            <span class="detail">{{$vendordetails->address}},</span>
                                                    <span class="detail">{{$vendordetails->address1}},</span>
                                                    <span class="detail">{{$vendordetails->city}},</span>
                                                    <span class="detail">{{$vendordetails->state}}</span>
                                                    <span class="detail">- {{$vendordetails->pincode}}</span>
                                            Carjon,
                                        </li>
                                        <li class="store-phone">
                                            <a href="tel:123456789">
                                                <i class="w-icon-phone"></i>
                                                {{$vendordetails->mobile_number1}}, {{$vendordetails->mobile_number2}}
                                            </a>
                                        </li>
                                        <li class="store-email">
                                            <a href="email:#">
                                                <i class="far fa-envelope"></i>
                                                {{$vendordetails->email}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="store-content-right">
                                <!--<div class="btn btn-white btn-rounded btn-icon-left btn-inquiry"><i
                                        class="far fa-question-circle"></i>Inquiry</div>-->
                                <div class="social-icons social-icons-colored border-thin">
                                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                    <a href="#" class="social-icon social-linkedin fab fa-linkedin"></a>
                                    <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                    <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Store WCMP Banner -->

                    <div class="row gutter-lg">
                        <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <a href="#" class="sidebar-toggle"><i class="w-icon-angle-right"></i></a>
                            <div class="sidebar-content">
                                <div class="sticky-sidebar">
                                    <div class="widget widget-collapsible widget-categories">
                                        <h3 class="widget-title"><span>All Categories</span></h3>
                                        <ul class="widget-body filter-items search-ul">
                                        @foreach($Categorysub as $category)
                                            <li><a href="{{ url( 'VendorSubcategoryproductshow/'.$category->id.'/'.$vendordetails->id ) }}">
                                            @if($category->category_sub_image!='' && file_exists(public_path('assets/images/categorySub/' . $category->category_sub_image)))
                                                    <img src="{{ asset('/assets/images/categorySub/'.$category->category_sub_image) }}" alt="{{ $category->category_sub_name }}"
                                                    width="60" height="60"  />
                                                   
                                                
                                                @else
                                                <img src="{{ asset('assets/images/products.png') }}" alt="{{ $category->category_sub_name }}"
                                                    width="60" height="60" />
                                                    @endif
                                                 
                                                 {{$category->category_sub_name}}</a></li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible widget-coupons">
                                        <h3 class="widget-title"><span>Store Coupons</span></h3>
                                        <div class="widget-body">
                                            <div class="coupon">
                                                First Shopping Coupon
                                                <div class="coupon-tip">
                                                    <div class="coupon-info-title">FREE Shipping Coupon</div>
                                                    <div class="coupon-info-date">April 30, 2021</div>
                                                    <div>Test coupon for vendor page</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Widget 
                                    <div class="widget widget-collapsible widget-time">
                                        <h3 class="widget-title"><span><i class="far fa-clock"></i>Store Time</span>
                                        </h3>
                                        <ul class="widget-body">
                                            <li>
                                                <span>Monday:</span>9:00 - 10:00 pm
                                            </li>
                                            <li>
                                                <span>Tuesday:</span>9:00 - 10:00 pm
                                            </li>
                                            <li>
                                                <span>Wednesday:</span>9:00 - 10:00 pm
                                            </li>
                                            <li>
                                                <span>Thursday:</span>9:00 - 2:00 pm
                                            </li>
                                            <li>
                                                <span>Friday:</span>9:00 - 10:00 pm
                                            </li>
                                            <li>
                                                <span>Saturday:</span>9:00 - 10:00 pm
                                            </li>
                                            <li>
                                                <span>Sunday:</span>9:00 - 10:00 pm
                                            </li>
                                        </ul>
                                    </div>-->
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span><i class="w-icon-truck"></i>Shipping Rules</span>
                                        </h3>
                                        <div class="widget-body">
                                            <p class="mb-0">Delivery Time: 2-3 business days</p>
                                        </div>
                                    </div>
                                    <!-- End of Widget 
                                    <div class="widget widget-collapsible widget-location">
                                        <h3 class="widget-title"><span>Store Location</span></h3>
                                        <div class="widget-body">
                                            <div class="google-map" id="googlemaps"></div>
                                        </div>
                                    </div>-->
                                    <!-- End of Widget 
                                    <div class="widget widget-collapsible widget-products">
                                        <h3 class="widget-title"><span>Best Selling</span></h3>
                                        <div class="widget-body">
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="{{ asset('website_assets/images/shop/1.jpg') }}"  alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">3D Television</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$220.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!-- End of Widget -->
                                </div>
                            </div>
                        </aside>
                        <!-- End of Sidebar -->

                        <div class="main-content">
                            <div class="tab tab-nav-underline tab-nav-boxed tab-vendor-wcfm">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#tab-1" class="nav-link active">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-2" class="nav-link">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-3" class="nav-link">Policies</a>
                                    </li>
                                    <!--<li class="nav-item">
                                        <a href="#tab-4" class="nav-link">Reviews(1)</a>
                                    </li>-->
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                        <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                            <div class="toolbox-left">
                                                <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                                    btn-icon-left d-block d-lg-none"><i
                                                        class="w-icon-category"></i><span>Filters</span></a>
                                                <div class="toolbox-item toolbox-sort select-box text-dark">
                                                    <label>Sort By :</label>
                                                    <select name="orderby" id="orderby" class="form-control">
                                                        <option value="default" selected="selected">Default sorting</option>
                                                        <!--<option value="popularity">Sort by popularity</option>
                                                        <option value="rating">Sort by average rating</option>-->
                                                        <option value="date">Sort by latest</option>
                                                        <option value="price-low">Sort by pric: low to high</option>
                                                        <option value="price-high">Sort by price: high to low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="toolbox-right d-none">
                                                <div class="toolbox-item toolbox-show select-box">
                                                    <select name="count" class="form-control">
                                                        <option value="9">Show 9</option>
                                                        <option value="12" selected="selected">Show 12</option>
                                                        <option value="24">Show 24</option>
                                                        <option value="36">Show 36</option>
                                                    </select>
                                                </div>
                                                <div class="toolbox-item toolbox-layout">
                                                    <a href="vendor-wcfm-store-product-grid.html"
                                                        class="icon-mode-grid btn-layout active">
                                                        <i class="w-icon-grid"></i>
                                                    </a>
                                                    <a href="vendor-wcfm-store-product-list.html"
                                                        class="icon-mode-list btn-layout">
                                                        <i class="w-icon-list"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </nav>
                                        <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2" id="productslist">
                                @if(!empty($products))                              
                                @foreach ($products as $product)  
                                <div class="product-wrap">
                                                <div class="product product-simple text-center">
                                                    <figure class="product-media">
                                                        <a href="{{ route('getProduct',$product->id )  }}">
                                                            <img src="{{ asset('assets/images/products') . '/' . $product->product_image }}" alt="Product" width="300" height="338">
                                                        </a>
                                                        <div class="product-action-vertical">
                                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a>
                                                        </div>
                                                        <div class="product-action">
                                                            <a href="{{ route('getProduct',$product->id )  }}" class="btn-product" title="Quick View">
                                                                View Product</a>
                                                        </div>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h4 class="product-name"><a href="{{ route('getProduct',$product->id )  }}">{{ $product->product_name }}</a></h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 100%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <a href="{{ route('getProduct',$product->id )  }}" class="rating-reviews">(3
                                                                reviews)</a>
                                                        </div>
                                                        <div class="product-pa-wrapper">
                                                        <div class="product-price">
                                                        ₹ {{ $product->selling_price }} - <del><span class="text-danger"> ₹ {{ $product->retail_price }} </span></del>
                                                    </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                            
                                                                                                         
                                @endforeach 
                                @else
                                <div class="text-center">123
                                <img src="{{ asset('assets/images/banners/outofstock.png') }}" alt="Out Of Stock" width="190" height="190">
                                </div>
                                @endif                              
                            </div>
                                    </div>
                                    <div class="tab-pane" id="tab-2">
                                    <p class="mb-5">
                                    {{$vendordetails->description}}
                                    </p>
                                    </div>
                                    <div class="tab-pane" id="tab-3">
                                        <div class="policies-area">
                                            <h3 class="title">Shipping Policy</h3>
                                            <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                                purus
                                                ut. Tellus rutrum tellus pelle.</p>
                                        </div>
                                        <div class="policies-area">
                                            <h3 class="title">Refund Policy</h3>
                                            <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                                purus ut. Tellus rutrum tellus pelle.</p>
                                        </div>
                                        <div class="policies-area">
                                            <h3 class="title text-left">Cancellation / Return / Exchange Policy</h3>
                                            <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                                purus ut. Tellus rutrum tellus pelle.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-4">
                                        <div class="review-area">
                                            <h3 class="title font-weight-bold mb-5">Write A Review</h3>
                                            <input name="review" type="text" class="form-control"
                                                placeholder="your review">
                                            <button class="btn btn-rounded">Add Your Review</button>
                                        </div>
                                        <!-- End of Reveiw Area -->
                                        <div class="review-area">
                                            <h3 class="title font-weight-bold mb-5">Reviews</h3>
                                            <div class="reviewers d-flex align-items-center flex-wrap mb-7">
                                                <div class="reviewers-picture d-flex mr-2">
                                                    <figure>
                                                        <img src="{{ asset('website_assets/images/vendor/wcfm/avatar.png') }}"  alt="Avatar"
                                                            width="113" height="112" />
                                                    </figure>
                                                    <figure>
                                                        <img src="{{ asset('website_assets/images/vendor/wcfm/avatar.png') }}"  alt="Avatar"
                                                            width="113" height="112" />
                                                    </figure>
                                                    <figure>
                                                        <img src="{{ asset('website_assets/images/vendor/wcfm/avatar.png') }}"  alt="Avatar"
                                                            width="113" height="112" />
                                                    </figure>
                                                </div>
                                                <div class="reviewer-name">
                                                    <a href="#" class="font-weight-bold mr-1">John Doe</a>has reviewed
                                                    this store
                                                </div>
                                            </div>
                                            <!-- End of Reviewers -->
                                            <div class="review-ratings">
                                                <div class="review-ratings-left mr-auto">
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Feature</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Varity</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Flexibility</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Delivery</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Support</label>
                                                    </div>
                                                </div>
                                                <!-- End of Review Ratings Left -->
                                                <div class="review-ratings-right">
                                                    <div class="average-rating">5.0<sub>/5</sub></div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full mr-0">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Review Ratings Right -->
                                            </div>
                                            <!-- End of Review Ratings -->
                                            <div class="user-wrap">
                                                <div class="user-photo">
                                                    <figure>
                                                        <img src="{{ asset('website_assets/images/vendor/wcfm/avatar.png') }}"  alt="Avatar"
                                                            width="113" height="112" />
                                                    </figure>
                                                    <div class="rated text-center">
                                                        <label>Rated</label>
                                                        <span class="score">5.0</span>
                                                    </div>
                                                </div>
                                                <!-- End of User Photo -->
                                                <div class="user-info">
                                                    <h4 class="user-name">John Doe</h4>
                                                    <div class="user-date mb-7">
                                                        <span>1 Reviews</span>
                                                        <span>April 1, 2021 12:12 Pm</span>
                                                    </div>
                                                    <p>Diam in arcu cursus euismod quis. Eget sit amet tellusvitae
                                                        sapien pellentesque habitant morbi tristique senectus et.
                                                        Cras adipiscing enim ermentum et sollicitudin ac orci phasellus.
                                                    </p>
                                                </div>
                                                <!-- End of User Info -->
                                                <div class="review-ratings">
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Feature</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Varity</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Flexibility</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Delivery</label>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        </div>
                                                        <label>5.0 Support</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of User Wrap -->
                                        </div>
                                        <!-- End of Reveiw Area -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Main Content -->
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->
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