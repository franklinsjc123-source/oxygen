@extends('front_end.app')
@section('content')
    <div class="page-wrapper">
        @include('front_end.common.header')
        <!-- Start of Main -->
        <main class="main">

            <div class="container pb-2">
                <div class=" mt-4">
                    <div class="swiper-container swiper-theme pg-inner animation-slider row cols-1 gutter-no"
                        data-swiper-options="{
                        'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                        }
                        }">
                        <div class="swiper-wrapper">
                            @foreach ($mainslider as $mslides)
                                <div class="swiper-slide banner banner-fixed intro-slide intro-slide1 br-sm"
                                    style="background-image: url({{ asset('assets/images/banners/mainslider') . '/' . $mslides->image }}); background-color: #E8EAEF;">
                                    <div class="banner-content y-50 text-right">
                                        <div class="slide-animate"
                                            data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                            }">
                                            <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2">
                                                {{ $mslides->title }}</h5>
                                            <h3 class="banner-title text-capitalize ls-25">
                                                <span class="text-dark">{{ $mslides->sub_title }}</span><br>
                                                Fashion Lifestyle<br>Collection
                                            </h3>
                                            <a href="{{ $mslides->link }}"
                                                class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">
                                                Shop Now<i class="w-icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- End of Intro Slide 3 -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- End of Swiper Container -->
            </div>
            <!-- End of Intro Wrapper -->
            <div class="container pb-2">
            <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6 mb-10"
                data-swiper-options="{
                'loop': true,
                'autoplay': {
                'delay': 4000,
                'disableOnInteraction': false
                },
                'slidesPerView': 1,
                'breakpoints': {
                '576': {
                'slidesPerView': 2
                },
                '768': {
                'slidesPerView': 3
                },
                '992': {
                'slidesPerView': 3
                },
                '1200': {
                'slidesPerView': 4
                }
                }
                }">
                <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Free Shipping & Return </h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- End of Icon Box Wrapper -->

            <div class="swiper-container container  swiper-theme category-banner-3cols pt-2 pb-10"
                data-swiper-options="{
    'spaceBetween': 20,
    'slidesPerView': 1,
    'breakpoints': {
    '576': {
    'slidesPerView': 2
    },
    '992': {
    'slidesPerView': 3
    }
    }
    }">
                <div class="swiper-wrapper row cols-lg-3 cols-sm-2 cols-1">
                    <div class="swiper-slide banner banner-fixed category-banner br-sm">
                        <figure>
                            <img src="{{ asset('website_assets/images/demos/demo8/category/1-1.jpg') }}"
                                alt="Category Banner" width="447" height="230" style="background-color: #cfd1cf;" />
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title text-capitalize ls-25 mb-0">For Men's</h3>
                            <div class="banner-price-info text-uppercase text-default ls-25 font-weight-bold">Starting
                                at <span class="text-secondary">₹99.00</span></div>
                            <hr class="banner-divider bg-dark">
                            <a href="product-default"
                                class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End of Category Banner -->
                    <div class="swiper-slide banner banner-fixed category-banner br-sm">
                        <figure>
                            <img src="{{ asset('website_assets/images/demos/demo8/category/1-2.jpg') }}"
                                alt="Category Banner" width="447" height="230" style="background-color: #333" />
                        </figure>
                        <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2">
                            <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">Get
                                {{ $coupon->discount_type == 'Percentage' ? $coupon->discount_percentage . '%' : '₹' . $coupon->discount_amount }}
                                Off
                                Your Entire Order!</h5>
                            <h3 class="banner-title text-white text-uppercase ls-25">{{ $coupon->title }}</h3>
                            <p>Use code <strong class="text-uppercase text-white">{{ $coupon->coupon_code }}</strong> at
                                checkout.</p>
                            <a href="product-default" class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End of Category Banner -->
                    <div class="swiper-slide banner banner-fixed category-banner br-sm">
                        <figure>
                            <img src="{{ asset('website_assets/images/demos/demo8/category/1-3.jpg') }}"
                                alt="Category Banner" width="447" height="230" style="background-color: #e0dddd;" />
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title text-capitalize ls-25 mb-0">For Women's</h3>
                            <div class="banner-price-info text-uppercase text-default ls-25 font-weight-bold">From Only
                                <span class="text-secondary">₹99.00</span>
                            </div>
                            <hr class="banner-divider bg-dark">
                            <a href="product-default"
                                class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End of Category Banner -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Swiper Container -->

            <h2 class="title title-center mb-3">Top Categories Of The Month</h2>
            <div class="swiper-container container  swiper-theme shadow-swiper pb-10"
                data-swiper-options="{
                'spaceBetween': 20,
                'slidesPerView': 2,
                'breakpoints': {
                '576': {
                'slidesPerView': 3
                },
                '768': {
                'slidesPerView': 4
                },
                '992': {
                'slidesPerView': 5
                },
                '1200': {
                'slidesPerView': 6
                }
                }
                }">
                <div class="swiper-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">

                    
                    @foreach ($topCategories as $topCategories)

                    <div class="swiper-slide product product-simple text-center swiper-slide-next" role="group" aria-label="2 / 6" style="width: 213.333px; margin-right: 20px;">
                        <figure class="product-media">
                            <a href="{{ url('productshow/' . $topCategories->id) }}">
                                <img src="{{ asset('assets/images/categoryMain/' . $topCategories->category_main_image) }}" alt="Product" width="260" height="291">
                            </a>
                            
                            <!-- <div class="product-action">
                                <a href="{{ url('productshow/' . $topCategories->id) }}" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div> -->
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name"><a href="{{ url('productshow/' . $topCategories->id) }}">{{ $topCategories->category_main_name }}</a></h4>
                        </div>
                    </div>

                        {{-- <div class="swiper-slide category-wrap">
                            <div class="category category-classic category-absolute overlay-zoom br-sm">
                                <a href="{{ url('productshow/' . $topCategories->id) }}">
                                    <figure class="category-media">
                                        <img src="{{ asset('assets/images/categoryMain/' . $topCategories->category_main_image) }}"
                                            alt="Category" style="height: 213px; width:213px" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name ls-normal">{{ $topCategories->category_main_name }}</h4>
                                    <a href="{{ url('productshow/' . $topCategories->id) }}"
                                        class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">Shop Now</a>
                                </div>
                                <div class="product-action">
                                    <!-- <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                        View</a> -->
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                    <!-- End of Category Classic -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Swiper -->
            {{-- 
    <div class="notification-wrapper bg-dark br-sm mb-10 appear-animate justify-content-center fadeIn appear-animation-visible"
    style="animation-duration: 1.2s;">
    <i class="w-icon-mobile"></i>
    <p>Download our new app today! Don't Miss our mobile-only offers and shop with Android Play.</p>
    <a href="#"
    class="btn btn-white btn-outline btn-rounded btn-sm btn-icon-right font-weight-normal text-capitalize">
    Download<i class="w-icon-long-arrow-down"></i></a>
    </div> --}}
    </div>
    <!-- End of Container grey-section -->

    <section class=" appear-animate">
        <div class="container mb-2">

            <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Best Offer Products
            </h2>
            <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New arrivals</a>
                    </li>
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best seller</a>
                    </li>
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-3">most popular</a>
                    </li>
                    <li class="nav-item mr-0 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-4">Auction</a>
                    </li>
                </ul>
            </div>
            <!-- End of Tab -->
            <div class="tab-content product-wrapper appear-animate">
                <div class="tab-pane active pt-4" id="tab1-1">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        @foreach ($newArrivals as $newArrivals)
                            <div class="product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('getProducts', $newArrivals->productdetails->id) }}">
                                            <img src="{{ asset('assets/images/products') . '/' . $newArrivals->product_image }}"
                                                alt="Product" width="300" height="308" />
                                        </a>
                                        @php
                                            $adcartbtn = 'd-block';
                                            $pincodetxtbtn = 'd-block';
                                  
                                            
                                        @endphp
                                        @if (session()->has('pincode'))
                                                @php
                                                    $adcartbtn = 'd-block';
                                                    $adcartbtnactinact = 'enable';
                                                    $pincodetxtbtn = 'd-none';
                                                @endphp
                                        @else
                                                @php
                                                    $adcartbtn = 'd-block';
                                                    $adcartbtnactinact = 'disabled';
                                                    $pincodetxtbtn = 'd-block';
                                                @endphp
                                        @endif
                                        <div class="product-action-vertical">
                                            <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" onclick="{{ $adcartbtnactinact == 'enable' ? "addqnty('{$newArrivals->productdetails->id}', 'Add')" : "swal('error!', 'Please check your pincode before adding to cart', 'error!')" }}"
                                                title="Add to cart"></a> onclick="addCart('<?= $newArrivals->product_id ?>')"-->

                                                <a  href="{{ route('getProducts', $newArrivals->productdetails->id) }}"  class="btn-product-icon w-icon-cart" 
                                                title="Add to cart"></a>
                                               
                                            <!--<a href="#" class="btn-product-icon btn-wishlist w-icon-heart"-->
                                            <!--    title="Add to wishlist"></a>-->
                                            <!--<a href="#" class="btn-product-icon btn-quickview w-icon-search"-->
                                            <!--    title="Quickview"></a>                                           -->
                                        </div>
                                        
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a
                                                href="{{ route('getProducts', $newArrivals->productdetails->id) }}">{{ $newArrivals->product_name }}</a>
                                        </h4>
                                        
                                      
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{ route('getProducts', $newArrivals->productdetails->id) }}"
                                                class="rating-reviews">(5 reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <ins
                                                class="new-price">₹{{ $newArrivals->productdetails->selling_price }}</ins>
                                            <del class="old-price">₹{{ $newArrivals->productdetails->retail_price }}</del>
                                            @php
                                                $saveAmount =
                                                    $newArrivals->productdetails->retail_price -
                                                    $newArrivals->productdetails->selling_price;
                                            @endphp

                                            @if ($saveAmount > 0)
                                                <span class="save-price"> (Save ₹ {{ $saveAmount }})</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane pt-4" id="tab1-2">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">

                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane pt-4" id="tab1-3">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">

                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane pt-4" id="tab1-4">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">

                    </div>
                </div>
                <!-- End of Tab Pane -->
            </div>
            <!-- End of Tab Content -->

            <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                @foreach ($oxygenAddBanner as $oxygenAddBanner)
                    <div class="col-md-6 mb-4">
                        <div class="banner banner-fixed category-banner-1 br-xs">
                            <figure>
                                <img src="{{ asset('assets/images/banners/advoxygen') . '/' . $oxygenAddBanner->image }}"
                                    alt="Category Banner" width="610" height="200"
                                    style="background-color: #3B4B48;" />
                            </figure>
                            <div class="banner-content y-50 pt-1">
                                <h5 class="banner-subtitle font-weight-bold text-uppercase">
                                    {{ $oxygenAddBanner->sub_title }}</h5>
                                <h3 class="banner-title font-weight-bolder text-capitalize text-white">
                                    {{ $oxygenAddBanner->title }}</h3>
                                <a href="{{ $oxygenAddBanner->link }}"
                                    class="btn btn-white btn-link btn-underline btn-icon-right">Shop Now<i
                                        class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- End of Category Cosmetic Lifestyle -->

            <div class="product-wrapper-1 appear-animate mb-5">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">Mens Products</h2>
                    <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">More
                        Products<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm"
                            style="background-image: url({{ asset('website_assets/images/demos/demo1/banners/2.webp') }}); 
                                background-color: #ebeced;">
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle font-weight-normal mb-2">Weekend Sale</h5>
                                <hr class="banner-divider bg-dark mb-2">
                                <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                    New Arrivals<br> <span class="font-weight-normal text-capitalize">Collection</span>
                                </h3>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme"
                            data-swiper-options="{
        'spaceBetween': 20,
        'slidesPerView': 2,
        'breakpoints': {
        '992': {
        'slidesPerView': 3
        },
        '1200': {
        'slidesPerView': 4
        }
        }
        }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach ($menproducts as $menproducts)
                                    <div class="swiper-slide product-col">
                                        <div class="product-wrap product text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('getProducts', $menproducts->productdetails->id) }}">
                                                    <img src="{{ asset('assets/images/products') . '/' . $menproducts->product_image }}"
                                                        alt="Product" width="216" height="243" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="{{ route('getProducts', $newArrivals->productdetails->id) }}"  class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                        title="Quickview"></a>
                                                    {{-- <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                        title="Add to Compare"></a> --}}
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a
                                                        href="product-default.html">{{ $menproducts->product_name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 60%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="{{ route('getProducts', $menproducts->productdetails->id) }}"
                                                        class="rating-reviews">(3
                                                        reviews)</a>
                                                </div>
                                                <div class="product-price">
                                                    <ins
                                                        class="new-price">₹{{ $menproducts->productdetails->selling_price }}</ins><del
                                                        class="old-price">₹{{ $menproducts->productdetails->retail_price }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Product Wrapper 1 -->

            <div class="product-wrapper-1 appear-animate mb-8">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">Womens Products</h2>
                    <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">More
                        Products<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm"
                            style="background-image: url({{ asset('website_assets/images/demos/demo1/banners/3.jpg') }}); 
                                    background-color: #252525;">
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle text-white font-weight-normal mb-2">New Collection</h5>
                                <hr class="banner-divider bg-white mb-2">
                                <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">
                                    Top Camera <br> <span class="font-weight-normal text-capitalize">Mirrorless</span>
                                </h3>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">shop now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme"
                            data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                '992': {
                                'slidesPerView': 3
                                },
                                '1200': {
                                'slidesPerView': 4
                                }
                                }
                                }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach ($womenproducts as $womenproducts)
                                    <div class="swiper-slide product-col">
                                        <div class="product-wrap product text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('getProducts', $womenproducts->productdetails->id) }}">
                                                    <img src="{{ asset('assets/images/products') . '/' . $womenproducts->product_image }}"
                                                        alt="Product" width="216" height="243" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                        title="Quickview"></a>
                                                    {{-- <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                        title="Add to Compare"></a> --}}
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a
                                                        href="product-default.html">{{ $womenproducts->product_name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 60%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="{{ route('getProducts', $womenproducts->productdetails->id) }}"
                                                        class="rating-reviews">(3
                                                        reviews)</a>
                                                </div>
                                                <div class="product-price">
                                                    <ins
                                                        class="new-price">₹{{ $womenproducts->productdetails->selling_price }}</ins><del
                                                        class="old-price">₹{{ $womenproducts->productdetails->retail_price }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <!-- End of Produts -->
                    </div>
                </div>
            </div>
            <!-- End of Product Wrapper 1 -->


            <div class="product-wrapper-1 appear-animate mb-8">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">Kids Products</h2>
                    <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">More
                        Products<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm"
                            style="background-image: url({{ asset('website_assets/images/demos/demo1/banners/baby.JPEG') }}); 
                                    background-color: #252525;">
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle text-white font-weight-normal mb-2">New Collection</h5>
                                <hr class="banner-divider bg-white mb-2">
                                <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">
                                    Top Camera <br> <span class="font-weight-normal text-capitalize">Mirrorless</span>
                                </h3>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark  btn-rounded btn-sm bg-dark text-white">shop now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme"
                            data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                '992': {
                                'slidesPerView': 3
                                },
                                '1200': {
                                'slidesPerView': 4
                                }
                                }
                                }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach ($kidsproducts as $kidsproducts)
                                    <div class="swiper-slide product-col">
                                        <div class="product-wrap product text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('getProducts', $kidsproducts->productdetails->id) }}">
                                                    <img src="{{ asset('assets/images/products') . '/' . $kidsproducts->product_image }}"
                                                        alt="Product" width="216" height="243" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                        title="Quickview"></a>
                                                    {{-- <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                        title="Add to Compare"></a> --}}
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a
                                                        href="product-default.html">{{ $kidsproducts->product_name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 60%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="{{ route('getProducts', $kidsproducts->productdetails->id) }}"
                                                        class="rating-reviews">(3
                                                        reviews)</a>
                                                </div>
                                                <div class="product-price">
                                                    <ins
                                                        class="new-price">₹{{ $kidsproducts->productdetails->selling_price }}</ins><del
                                                        class="old-price">₹{{ $kidsproducts->productdetails->retail_price }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <!-- End of kids Produts -->
                    </div>
                </div>
            </div>

            
            @if ($paidAddSlip)
            <div class="banner banner-shoes br-sm mb-9" style="background-image: url({{ asset('assets/images/banners/adv-baner') . '/' . $paidAddSlip->image }});
                    background-color: #36332C;">
                <div class="banner-content d-block d-lg-flex align-items-center">
                    <div class="content-left mr-auto mb-6 mb-lg-0 align-items-center">
                        <div class="banner-price-info text-secondary text-uppercase font-weight-bolder ls-25">
                            {{ $paidAddSlip->title }}
                            {{-- <sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-10">Off</sub> --}}
                        </div>
                        <hr class="banner-divider">
                        <h3 class="banner-title font-weight-normal text-white mb-0 ls-25">
                            <strong>{{ $paidAddSlip->sub_title }}</strong>
                        </h3>
                    </div>
                    <a href="{{ $paidAddSlip->link }}" class="content-right btn btn-white btn-outline btn-rounded btn-icon-right">
                        Discover Now<i class="w-icon-long-arrow-right"></i>
                    </a>
                </div>
                {{-- <figure class="image-shoes skrollable">
                    <img src="{{ asset('assets/images/banners/adv-baner') . '/' . $paidAddSlip->image }}" alt="Shoes" data-bottom-top="transform: translateY(2vh);" data-top-bottom="transform: translateY(-2vh);" class="skrollable skrollable-between" style="transform: translateY(0.505495vh);">
                </figure> --}}
            </div>
            @endif

            {{-- @if ($paidAddSlip)
            <a href="{{ $paidAddSlip->link }}"><div class="banner banner-fixed sale-on-banner appear-animate br-sm mb-9  ">
                <figure>
                    <img src="{{ asset('assets/images/banners/adv-baner') . '/' . $paidAddSlip->image }}" alt="Category Banner" width="680" height="180" style="background-color: #2F3237;">
                </figure>   
                <div class="banner-content text-center x-50 y-50 mt-1 ">
                    <h3 class="banner-title text-white font-secondarydemo11 font-weight-normal mb-2" >{{ $paidAddSlip->title }}</h3>
                    <h4 class="banner-price-info justify-content-center text-white text-uppercase ls-25 d-flex mb-2">
                        {{ $paidAddSlip->sub_title }}
                    </h4>
                </div>                
            </div></a>
            @endif --}}
            <!-- End of Kids Product Wrapper 1 -->
            {{-- @if ($paidAddSlip)
                <div class="banner banner-fashion appear-animate br-sm mb-9"
                    style="background-image: url({{ asset('assets/images/banners/adv-baner') . '/' . $paidAddSlip->image }});
                background-color: #383839;">
                    <div class="banner-content align-items-center">
                        <div class="content-left d-flex align-items-center mb-3">
                            <div class="banner-price-info font-weight-bolder text-secondary text-uppercase lh-1 ls-25">
                                25
                                <sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-25">Off</sub>
                            </div>
                            <hr class="banner-divider bg-white mt-0 mb-0 mr-8">
                        </div>
                        <div class="content-right d-flex align-items-center flex-1 flex-wrap">
                            <div class="banner-info mb-0 mr-auto pr-4 mb-3">
                                <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">
                                    {!! $paidAddSlip->title !!}</h3>
                                <p class="text-white mb-0">{!! $paidAddSlip->sub_title !!}
                                    <span class="text-dark bg-white font-weight-bold ls-50 pl-1 pr-1 d-inline-block">Black
                                    <strong>12345</strong></span> to get best offer.
                                </p>
                            </div>
                            <a href="{{ $paidAddSlip->link }}"
                                class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">Shop Now<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif --}}
            <!-- End of Banner Fashion -->


            <!-- End of Product Wrapper 1 -->

            <h2 class="title title-underline mb-4 ls-normal appear-animate">Our Clients</h2>
            <div class="swiper-container swiper-theme brands-wrapper mb-9 appear-animate"
                data-swiper-options="{
    'spaceBetween': 0,
    'slidesPerView': 2,
    'breakpoints': {
    '576': {
    'slidesPerView': 3
    },
    '768': {
    'slidesPerView': 4
    },
    '992': {
    'slidesPerView': 5
    },
    '1200': {
    'slidesPerView': 6
    }
    }
    }">
                <div class="swiper-wrapper row gutter-no cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/1.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/2.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/3.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/4.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/5.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/6.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/7.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/8.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/9.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/10.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                    <div class="swiper-slide brand-col">
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/11.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                        <figure class="brand-wrapper">
                            <img src="{{ asset('website_assets/images/demos/demo1/brands/12.png') }}" alt="Brand"
                                width="410" height="186" />
                        </figure>
                    </div>
                </div>
            </div>
            <!-- End of Brands Wrapper -->


            <!-- Post Wrapper -->

            {{-- <h2 class="title title-underline mb-4 ls-normal appear-animate">Your Recent Views</h2>
            <div class="swiper-container swiper-theme shadow-swiper appear-animate pb-4 mb-8"
                data-swiper-options="{
    'spaceBetween': 20,
    'slidesPerView': 2,
    'breakpoints': {
    '576': {
    'slidesPerView': 3
    },
    '768': {
    'slidesPerView': 5
    },
    '992': {
    'slidesPerView': 6
    },
    '1200': {
    'slidesPerView': 8
    }
    }
    }">
                <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-2">
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-1.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Women's Fashion Handbag</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-2.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Electric Frying Pan</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-3.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Black Winter Skating</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-4.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">HD Television</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-5.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Home Sofa</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-6.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">USB Receipt</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-7.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Electric Rice-Cooker</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                    <div class="swiper-slide product-wrap mb-0">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="product-defaproduct-default.html">
                                    <img src="{{ asset('website_assets/images/demos/demo1/products/7-8.jpg') }}"
                                        alt="Category image" width="130" height="146"
                                        style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="product-default.html">Table Lamp</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                </div>
                <div class="swiper-pagination"></div>
            </div> --}}
            <!-- End of Reviewed Producs -->
        </div>
        <!-- End of Container -->
    </section>
    <!-- End of Grey Section -->
    </main>
    </div>
    <!-- The Modal -->
    {{-- <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <p>Some text in the Modal Body</p>
                <p>Some other text...</p>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>
    </div>
    <div class="product-action">
        <a href="#" class="btn-product btn-cart" title="Add to Cart"><i class="w-icon-cart"></i> Bid Amount</a>
        <button id="myBtn">Open Modal</button>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script> --}}
@endsection
