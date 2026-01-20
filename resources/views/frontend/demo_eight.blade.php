 @extends('app_template')
 @section('title','TryNexX')
 @section('content')
 <!-- Start of Main -->

 
 <main class="main">

        <div class=" pb-2">
            <div class=" mt-4">
                <div class="swiper-container swiper-theme pg-inner animation-slider row cols-1 gutter-no" data-swiper-options="{
                            'autoplay': {
                                'delay':3000,
                                'disableOnInteraction': false
                            }
                        }">
                    <div class="swiper-wrapper">
                        <?php if (isset($mainslider)) {
                                foreach ($mainslider as $val) { ?>
                                <div class="swiper-slide banner banner-fixed intro-slide intro-slide1 br-sm"
                                    style="background-image: url(<?php echo asset('assets/images/banners/mainslider/' . $val->image) ?>); background-color: #E8EAEF;">
                                    <div class="banner-content y-50 text-right">
                                        <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                        }">
                                            {{-- <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2"><?php echo $val->title ?></h5> --}}
                                            <h3 class="banner-title text-capitalize ls-25">
                                                {{-- <span class="text-primary"><?php echo $val->sub_title ?></span><br> --}}
                                                {{-- Fashion Lifestyle<br>Collection --}}
                                            </h3>
                                            <a href="{{ url('shops')}}"
                                                class="btn btn-dark btn-outline btn-rounded btn-icon-right">
                                                Shop Now<i class="w-icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                            } ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>




     <div class="container pb-2">

         <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6"
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
                         <h4 class="icon-box-title">Free Shipping & Returns</h4>
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
         <!-- End of Icon Box Wrapper -->

         <div class="swiper-container swiper-theme category-banner-3cols pt-2"
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
                         <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-1.jpg" alt="Category Banner" width="447"
                             height="230" style="background-color: #cfd1cf;" />
                     </figure>
                     <div class="banner-content y-50">
                         <h3 class="banner-title text-capitalize ls-25 mb-0">For Men's</h3>
                         <div class="banner-price-info text-uppercase text-default ls-25 font-weight-bold">Starting
                             at <span class="text-secondary">$29.00</span></div>
                         <hr class="banner-divider bg-dark">
                         <a href="demo8-shop.html"
                             class="btn btn-dark btn-link btn-outline btn-icon-right btn-slide-right">
                             Shop Now<i class="w-icon-long-arrow-right"></i>
                         </a>
                     </div>
                 </div>
                 <!-- End of Category Banner -->
                 <div class="swiper-slide banner banner-fixed category-banner br-sm">
                     <figure>
                         <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-2.jpg" alt="Category Banner" width="447"
                             height="230" style="background-color: #333" />
                     </figure>
                     <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2">
                         <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">Get 30% Off
                             Your Entire Order!</h5>
                         <h3 class="banner-title text-white text-uppercase ls-25">Black Friday Sale</h3>
                         <p>Use code <strong class="text-uppercase text-white">Blkfri40</strong> at checkout.</p>
                         <a href="demo8-shop.html"
                             class="btn btn-primary btn-outline btn-rounded btn-icon-right text-white btn-slide-right">
                             Shop Now<i class="w-icon-long-arrow-right"></i>
                         </a>
                     </div>
                 </div>
                 <!-- End of Category Banner -->
                 <div class="swiper-slide banner banner-fixed category-banner br-sm">
                     <figure>
                         <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-3.jpg" alt="Category Banner" width="447"
                             height="230" style="background-color: #e0dddd;" />
                     </figure>
                     <div class="banner-content y-50">
                         <h3 class="banner-title text-capitalize ls-25 mb-0">For Women's</h3>
                         <div class="banner-price-info text-uppercase text-default ls-25 font-weight-bold">From Only
                             <span class="text-secondary">$29.00</span>
                         </div>
                         <hr class="banner-divider bg-dark">
                         <a href="demo8-shop.html"
                             class="btn btn-dark btn-link btn-outline btn-icon-right btn-slide-right">
                             Shop Now<i class="w-icon-long-arrow-right"></i>
                         </a>
                     </div>
                 </div>
                 <!-- End of Category Banner -->
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <!-- End of Swiper Container -->

        
         <!-- End of Swiper -->


     </div>
     <!-- End of Container -->


     <!-- End of Grey Section -->




         <!-- End of Banner Product Wrapper -->

     <div class="container">

        <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Top Rated Products</h2>
             <a href="{{ url('shops') }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>

         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($topRatedProducts)) {
                    foreach ($topRatedProducts as $row) { ?>
                        <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                            <div class="product product-simple text-center">
                                <figure class="product-media">
                                    <a href="<?= url('/productVar/'.$row['id']) ?>">
                                        <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                            height="291" />
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#"   onclick="addwishlist('{{  $row['id'] }}')" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>                                    
                                    </div>
                                    <div class="product-action"> <!--  -->
                                        <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>'  class="btn-product btnquickview" title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="sold-by">
                                        <b><a href="<?= url('/shop-details/'.$row['vendor_id']) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                    </div>
                                    <h4 class="product-name"><a href="<?= url('/productVar/'.$row['id']) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                                </div>
                                <div class="product-pa-wrapper">
                                    <div class="product-price">
                                        ₹{{ $row['selling_price'] }} 
                                    </div>
                                    <div  class="product-price-discount" >
                                            ₹{{ $row['retail_price'] }} 
                                    </div>
                                    <?php 
                                      $discount_percentage = (($row['retail_price'] - $row['selling_price']) / $row['retail_price']) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    ?>

                                    <div  class="product-offer-percentage" >
                                            {{ $discount_rounded }}% Off
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
             <?php }
                } ?>
         </div>


         <div class="row cols-md-2 category-banner-2cols mb-5">
             <div class="banner banner-fixed mb-4">
                 <figure class="br-sm">
                     <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/2-1.jpg" alt="Category Banner" width="680"
                         height="220" style="background-color: #384744;" />
                 </figure>
                 <div class="banner-content y-50">
                     <h5 class="banner-subtitle text-uppercase text-white font-weight-bold">Natural Process</h5>
                     <h3 class="banner-title text-capitalize text-white">Cosmetic Makeup<br>Professional</h3>
                     <a href="demo8-shop.html" class="btn btn-white btn-link btn-slide-right btn-icon-right">
                         Shop Now<i class="w-icon-long-arrow-right"></i></a>
                 </div>
             </div>
             <!-- End of Banner -->
             <div class="banner banner-fixed mb-4">
                 <figure class="br-sm">
                     <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/2-2.jpg" alt="Category Banner" width="680"
                         height="220" style="background-color: #e7e7e7;" />
                 </figure>
                 <div class="banner-content y-50">
                     <h5 class="banner-subtitle text-uppercase font-weight-bold">Trending Now</h5>
                     <h3 class="banner-title text-capitalize">Women’s Lifestyle<br>Collection</h3>
                     <a href="demo8-shop.html" class="btn btn-dark btn-link btn-slide-right btn-icon-right">
                         Shop Now<i class="w-icon-long-arrow-right"></i></a>
                 </div>
             </div>
             <!-- End of Banner -->
         </div>
         <!-- End of Category Banner 2Cols -->



        <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Mens Products</h2>
             <a href="{{ url('mainCategoryShop').'/'.'1' }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($mensProducts)) {
                    foreach ($mensProducts as $row) { ?>
                        <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                            <div class="product product-simple text-center">
                                <figure class="product-media">
                                    <a href="<?= url('/productVar/'.$row['id']) ?>">
                                        <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                            height="291" />
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#"   onclick="addwishlist('{{  $row['id'] }}')" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>                                    
                                    </div>
                                    <div class="product-action"> <!--  -->
                                        <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>'  class="btn-product btnquickview" title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="sold-by">
                                        <b><a href="<?= url('/shop-details/'.$row['vendor_id']) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                    </div>
                                    <h4 class="product-name"><a href="<?= url('/productVar/'.$row['id']) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                                </div>
                                <div class="product-pa-wrapper">
                                    <div class="product-price">
                                        ₹{{ $row['selling_price'] }} 
                                    </div>
                                    <div  class="product-price-discount" >
                                            ₹{{ $row['retail_price'] }} 
                                    </div>
                                    <?php 
                                      $discount_percentage = (($row['retail_price'] - $row['selling_price']) / $row['retail_price']) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    ?>

                                    <div  class="product-offer-percentage" >
                                            {{ $discount_rounded }}% Off
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
             <?php }
                } ?>
         </div>



          <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Womens Products</h2>
             <a href="{{ url('mainCategoryShop').'/'.'3' }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($womensProducts)) {
                    foreach ($womensProducts as $row) { ?>
                        <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                            <div class="product product-simple text-center">
                                <figure class="product-media">
                                    <a href="<?= url('/productVar/'.$row['id']) ?>">
                                        <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                            height="291" />
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#"   onclick="addwishlist('{{  $row['id'] }}')" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>                                    
                                    </div>
                                    <div class="product-action"> <!--  -->
                                        <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>'  class="btn-product btnquickview" title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="sold-by">
                                        <b><a href="<?= url('/shop-details/'.$row['vendor_id']) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                    </div>
                                    <h4 class="product-name"><a href="<?= url('/productVar/'.$row['id']) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                                </div>
                                <div class="product-pa-wrapper">
                                    <div class="product-price">
                                        ₹{{ $row['selling_price'] }} 
                                    </div>
                                    <div  class="product-price-discount" >
                                            ₹{{ $row['retail_price'] }} 
                                    </div>
                                    <?php 
                                      $discount_percentage = (($row['retail_price'] - $row['selling_price']) / $row['retail_price']) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    ?>

                                    <div  class="product-offer-percentage" >
                                            {{ $discount_rounded }}% Off
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
             <?php }
                } ?>
         </div>




          <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">kids Products</h2>
             <a href="{{ url('mainCategoryShop').'/'.'2' }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($kidsProducts)) {
                    foreach ($kidsProducts as $row) { ?>
                        <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                            <div class="product product-simple text-center">
                                <figure class="product-media">
                                    <a href="<?= url('/productVar/'.$row['id']) ?>">
                                        <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                            height="291" />
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#"   onclick="addwishlist('{{  $row['id'] }}')" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>                                    
                                    </div>
                                    <div class="product-action"> <!--  -->
                                        <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>'  class="btn-product btnquickview" title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="sold-by">
                                        <b><a href="<?= url('/shop-details/'.$row['vendor_id']) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                    </div>
                                    <h4 class="product-name"><a href="<?= url('/productVar/'.$row['id']) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                                </div>
                                <div class="product-pa-wrapper">
                                    <div class="product-price">
                                        ₹{{ $row['selling_price'] }} 
                                    </div>
                                    <div  class="product-price-discount" >
                                            ₹{{ $row['retail_price'] }} 
                                    </div>
                                    <?php 
                                      $discount_percentage = (($row['retail_price'] - $row['selling_price']) / $row['retail_price']) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    ?>

                                    <div  class="product-offer-percentage" >
                                            {{ $discount_rounded }}% Off
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
             <?php }
                } ?>
         </div>
         </div>

     



         <div class="banner banner-shoes br-sm mb-9" style="background-image: url(<?php echo asset('frontend') ?>/images/demos/demo8/banner/3.jpg);
                    background-color: #36332C;">
             <div class="banner-content d-block d-lg-flex align-items-center">
                 <div class="content-left mr-auto mb-6 mb-lg-0 align-items-center">
                     <div class="banner-price-info text-secondary text-uppercase font-weight-bolder ls-25">
                         40<sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-10">Off</sub>
                     </div>
                     <hr class="banner-divider">
                     <h3 class="banner-title font-weight-normal text-white mb-0 ls-25">
                         Summer Season's Sale<br><strong>For Men's Sneakers</strong>
                     </h3>
                 </div>
                 <a href="demo8-shop.html"
                     class="content-right btn btn-white btn-outline btn-rounded btn-icon-right">
                     Discover Now<i class="w-icon-long-arrow-right"></i>
                 </a>
             </div>
             <figure class="image-shoes skrollable">
                 <img src="<?php echo asset('frontend') ?>/images/demos/demo8/banner/shoes.png" alt="Shoes"
                     data-bottom-top="transform: translateY(2vh);"
                     data-top-bottom="transform: translateY(-2vh);">
             </figure>
         </div>
         <!-- End of Banner Shoes -->
         <div class="container">

         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Auction Products</h2>
             <a href="shop-boxed-banner.html" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="swiper-container swiper-theme product-wrapper"
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
                 <div class="swiper-slide product product-simple text-center">
                     <figure class="product-media">
                         <a href="product-default.html">
                             <img src="<?php echo asset('frontend') ?>/images/demos/demo8/product/5-1.jpg" alt="Product" width="260"
                                 height="291" />
                         </a>
                         <div class="product-action-vertical">
                             <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                 title="Add to wishlist"></a>
                             <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                 title="Add to Compare"></a>
                         </div>
                         <div class="product-action">
                             <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                 View</a>
                         </div>
                         <div class="product-countdown-container">
                             <div class="product-countdown countdown-compact" data-until="2021, 9, 9"
                                 data-format="DHMS" data-compact="false" data-labels-short="Days, Hours, Mins, Secs">
                                 00:00:00:00</div>
                         </div>
                     </figure>
                     <div class="product-details">
                         <h4 class="product-name"><a href="product-default.html">Charge &amp; Alarm Machine</a></h4>
                         <div class="product-pa-wrapper">
                             <div class="product-price">
                                 <ins class="new-price">$26.88</ins><del class="old-price">$27.89</del>
                             </div>
                             <div class="product-action">
                                 <a href="#"
                                     class="btn-cart btn-product btn btn-icon-right btn-link btn-underline">Add
                                     To Cart</a>
                             </div>
                         </div>
                         <div class="sold-by">
                             Sold By: <a href="#">Vendor 5</a>
                         </div>
                     </div>
                 </div>
                 <!-- End of Product Simple -->
               
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <!-- End of Swiper Container -->

     </div>

    <div>
        <h2 class="title text-left mb-5 appear-animate"> Shops</h2>
        <div class="swiper-container swiper-theme  brands-wrapper br-sm mb-9 appear-animate"
                data-swiper-options="{
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    },
                    'loop': true,
                    'spaceBetween': 50,
                    'slidesPerView': 2,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 3
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 6
                        },
                        '1200': {
                            'slidesPerView': 7
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
                    
                <?php if (isset($vendorcreate)) {
                    foreach ($vendorcreate as $row) { ?>
                
                <div class="swiper-slide swiper-slide-vendor">
                        <figure>
                        <a href="<?= url('/shop-details/'.$row['id']) ?>" >
                            <img style="border-radius: 50%; object-fit: cover; margin-top: 20px;" src="{{ asset('assets/images/vendor/profile/' . $row->profile_image) }}" alt="Brand" />
                        </a>

                            <center>
                            <figcaption style="margin-top: 20px; font-weight: 600;">
                                    {{ $row->shop_name }}
                                </figcaption>
                        </center> 
                        
                        </figure>
                    </div>

                    <?php }
                } ?>
                
                </div>
            </div>



        <h2 class="title text-left mb-5 appear-animate"> Locations</h2>
        <div class="swiper-container swiper-theme  brands-wrapper br-sm mb-9 appear-animate mt-2"
            data-swiper-options="{
                'autoplay': {
                    'delay': 4000,
                    'disableOnInteraction': false
                },
                'loop': true,
                'spaceBetween': 50,
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
                        'slidesPerView': 7
                    }
                }
            }">
            <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
                
            @isset($locations)
                @foreach($locations as  $key=>$row)

                @php
                    $imgNo = ($key % 9) + 1;
                @endphp
                    <div class="swiper-slide swiper-slide-vendor text-center">
                        <figure>
                            <img src="{{ asset('frontend/images/00' .$imgNo  . '.jpg') }}"  
                                
                                style="width:150px;height:auto;object-fit:cover;border-radius:50%;">
                            
                            <figcaption style="margin-top: 8px; font-weight: 600;">
                                {{ $row->area }}
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            @endisset
            
            </div>
        </div>
    </div>
 </main>
 
 @endsection