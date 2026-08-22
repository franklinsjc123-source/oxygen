 @extends('app_template')
 @section('title','Tryneww')
 @section('content')
 <style>
    .product-price-home{

        font-family: monospace;
    }
 </style>
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
                         <p class="text-default">For all orders over ₹499</p>
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
                         <p class="text-default">Any return within 7 - 10 work days</p>
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
                             at <span class="text-secondary">₹29.00</span></div>
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
                         <img style="cursor:pointer" src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-2.jpg" alt="Category Banner" width="447"
                             height="230" style="background-color: #0088dd" />
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
                             <span class="text-secondary">₹29.00</span>
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
                                 <a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>">
                                     <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                         height="291" />
                                 </a>

                                  @php
                                      $offerName = '';
                                      $offerId = $row['offer_id'] ?? $row['offers'] ?? null;
                                      if ($offerId) {
                                          $offerDetails = DB::table('master_offers')->where('id', $offerId)->first();
                                          if ($offerDetails) {
                                              if ($offerDetails->type == "Buy X Get Y Free") {
                                                  $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                                              } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                                                  if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                                      $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                                                  } else {
                                                      $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                                                  }
                                              } elseif ($offerDetails->type == "Fixed Discount") {
                                                  if (strtolower($offerDetails->discount_type) == 'percentage') {
                                                      $offerName = "Flat {$offerDetails->value}% Off";
                                                  } else {
                                                      $offerName = "Flat ₹{$offerDetails->value} Off";
                                                  }
                                              } elseif (str_contains($offerDetails->type, '@')) {
                                                  $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                                                  $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                                              } else {
                                                  $offerName = $offerDetails->title ?: $offerDetails->type;
                                              }
                                          }
                                      }
                                      if (empty($offerName)) {
                                          $offerName = $row['offer_text'] ?? $row['offer_type'] ?? null;
                                      }
                                  @endphp
                                                                                @if(!empty($offerName))
                @php
                    $shape = 'ribbon';
                    $bg = '#1a5fe5';
                    $text = '#ffffff';
                    $shadow = '0 2px 8px rgba(0,0,0,0.25)';
                    
                    $offerLower = strtolower($offerName);
                    if (str_contains($offerLower, '@')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #d41e7d, #a3105a)'; // Pink for Buy @
                    } elseif (str_contains($offerLower, 'buy') || str_contains($offerLower, 'free')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #7a1ae5, #5b10b8)'; // Purple for Buy X Get Y
                    } elseif (str_contains($offerLower, 'cash')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #2ebd59, #1fa04a)';
                    } elseif (str_contains($offerLower, 'flat')) {
                        $shape = 'shield';
                        $bg = 'linear-gradient(135deg, #1a73e8, #1558b5)';
                    } elseif (str_contains($offerLower, 'intro')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e97a31, #d46520)';
                    } elseif (str_contains($offerLower, 'save')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #ffd400, #f0c800)';
                        $text = '#000000';
                    } elseif (str_contains($offerLower, 'discount') || str_contains($offerLower, 'off')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e51a2f, #c41525)';
                    } else {
                        $bg = 'linear-gradient(135deg, #1a5fe5, #1450c0)';
                    }
                    
                    $style = '';
                    if ($shape == 'ribbon') {
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                    } elseif ($shape == 'circle') {
                        $style = "position:absolute; top:8px; left:8px; width:56px; height:56px; border-radius:50%; padding:4px; box-shadow:{$shadow};";
                    } else { // shield
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:60px; clip-path:polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%); padding:6px 3px 16px 3px;";
                    }
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

                                 <div class="product-action-vertical">
                                     <a href="#" onclick="addwishlist('{{  $row['id'] }}', this)" class="btn-product-icon btn-wishlist {{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                         title="Add to wishlist"></a>
                                 </div>
                                 <div class="product-action">
                                     <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>' class="btn-product btnquickview" title="Quick View">Quick
                                         View</a>
                                 </div>
                             </figure>
                             <div class="product-details">
                                 <div class="sold-by">
                                     <b><a href="<?= url('/shop/' . ($row['vendor_slug'] ?? $row['vendor_id'])) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                 </div>
                                 <h4 class="product-name"><a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                             </div>
                             <div class="ratings-container">
                                 <div class="ratings-full">
                                     <span class="ratings" style="width: {{ $row['rating_percent'] ?? 0 }}%"></span>
                                 </div>
                                 <a>({{ $row['review_count'] ?? 0 }} Reviews)</a>
                             </div>
                             <div class="product-pa-wrapper">
                                 <div class="product-price-home">
                                     ₹{{ $row['selling_price'] }}
                                 </div>
                                 <div class="product-price-discount">
                                     ₹{{ $row['retail_price'] }}
                                 </div>
                                 <?php
                                    $retailPrice = (float) ($row['retail_price'] ?? 0);
                                    $sellingPrice = (float) ($row['selling_price'] ?? 0);
                                    if ($retailPrice > 0) {
                                        $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    } else {
                                        $discount_rounded = 0;
                                    }
                                    ?>

                                 <div class="product-offer-percentage">
                                     {{ $discount_rounded }}% Off
                                 </div>
                             </div>

                         </div>
                     </div>
             <?php }
                } ?>
         </div>

        <div class="title-link-wrapper mb-3">
            <h2 class="title mb-0 pt-2 pb-2">Offer Products</h2>
            <a href="{{ url('offers') }}" class="mb-0">More Products<i
                    class="w-icon-long-arrow-right"></i></a>
        </div>

        <div class="row grid banner-product-wrapper mb-6">
            <?php if (isset($offerProducts)) {
                   foreach ($offerProducts as $row) { ?>
                    <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                        <div class="product product-simple text-center">
                            <figure class="product-media">
                                <a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>">
                                    <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                        height="291" />
                                </a>

                                @php
                                      $offerName = '';
                                      $offerId = $row['offer_id'] ?? $row['offers'] ?? null;
                                      if ($offerId) {
                                          $offerDetails = DB::table('master_offers')->where('id', $offerId)->first();
                                          if ($offerDetails) {
                                              if ($offerDetails->type == "Buy X Get Y Free") {
                                                  $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                                              } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                                                  if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                                      $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                                                  } else {
                                                      $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                                                  }
                                              } elseif ($offerDetails->type == "Fixed Discount") {
                                                  if (strtolower($offerDetails->discount_type) == 'percentage') {
                                                      $offerName = "Flat {$offerDetails->value}% Off";
                                                  } else {
                                                      $offerName = "Flat ₹{$offerDetails->value} Off";
                                                  }
                                              } elseif (str_contains($offerDetails->type, '@')) {
                                                  $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                                                  $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                                              } else {
                                                  $offerName = $offerDetails->title ?: $offerDetails->type;
                                              }
                                          }
                                      }
                                      if (empty($offerName)) {
                                          $offerName = $row['offer_text'] ?? $row['offer_type'] ?? null;
                                      }
                                  @endphp
                                                                                @if(!empty($offerName))
                @php
                    $shape = 'ribbon';
                    $bg = '#1a5fe5';
                    $text = '#ffffff';
                    $shadow = '0 2px 8px rgba(0,0,0,0.25)';
                    
                    $offerLower = strtolower($offerName);
                    if (str_contains($offerLower, '@')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #d41e7d, #a3105a)'; // Pink for Buy @
                    } elseif (str_contains($offerLower, 'buy') || str_contains($offerLower, 'free')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #7a1ae5, #5b10b8)'; // Purple for Buy X Get Y
                    } elseif (str_contains($offerLower, 'cash')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #2ebd59, #1fa04a)';
                    } elseif (str_contains($offerLower, 'flat')) {
                        $shape = 'shield';
                        $bg = 'linear-gradient(135deg, #1a73e8, #1558b5)';
                    } elseif (str_contains($offerLower, 'intro')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e97a31, #d46520)';
                    } elseif (str_contains($offerLower, 'save')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #ffd400, #f0c800)';
                        $text = '#000000';
                    } elseif (str_contains($offerLower, 'discount') || str_contains($offerLower, 'off')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e51a2f, #c41525)';
                    } else {
                        $bg = 'linear-gradient(135deg, #1a5fe5, #1450c0)';
                    }
                    
                    $style = '';
                    if ($shape == 'ribbon') {
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                    } elseif ($shape == 'circle') {
                        $style = "position:absolute; top:8px; left:8px; width:56px; height:56px; border-radius:50%; padding:4px; box-shadow:{$shadow};";
                    } else { // shield
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:60px; clip-path:polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%); padding:6px 3px 16px 3px;";
                    }
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

                                <div class="product-action-vertical">
                                    <a href="#" onclick="addwishlist('{{  $row['id'] }}', this)" class="btn-product-icon btn-wishlist {{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                        title="Add to wishlist"></a>
                                </div>
                                <div class="product-action">
                                    <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>' class="btn-product btnquickview" title="Quick View">Quick
                                        View</a>
                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="sold-by">
                                    <b><a href="<?= url('/shop/' . ($row['vendor_slug'] ?? $row['vendor_id'])) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                </div>
                                <h4 class="product-name"><a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: {{ $row['rating_percent'] ?? 0 }}%"></span>
                                </div>
                                <a>({{ $row['review_count'] ?? 0 }} Reviews)</a>
                            </div>
                            <div class="product-pa-wrapper">
                                <div class="product-price-home">
                                    ₹{{ $row['selling_price'] }}
                                </div>
                                <div class="product-price-discount">
                                    ₹{{ $row['retail_price'] }}
                                </div>
                                <?php
                                   $retailPrice = (float) ($row['retail_price'] ?? 0);
                                   $sellingPrice = (float) ($row['selling_price'] ?? 0);
                                   if ($retailPrice > 0) {
                                       $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                       $discount_rounded = round($discount_percentage / 10) * 10;
                                   } else {
                                       $discount_rounded = 0;
                                   }
                                   ?>

                                <div class="product-offer-percentage">
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
             <a href="{{ url('main-category/men') }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($mensProducts)) {
                    foreach ($mensProducts as $row) { ?>
                     <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                         <div class="product product-simple text-center">
                             <figure class="product-media">
                                 <a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>">
                                     <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                         height="291" />
                                 </a>

                                  @php
                                      $offerName = '';
                                      $offerId = $row['offer_id'] ?? $row['offers'] ?? null;
                                      if ($offerId) {
                                          $offerDetails = DB::table('master_offers')->where('id', $offerId)->first();
                                          if ($offerDetails) {
                                              if ($offerDetails->type == "Buy X Get Y Free") {
                                                  $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                                              } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                                                  if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                                      $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                                                  } else {
                                                      $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                                                  }
                                              } elseif ($offerDetails->type == "Fixed Discount") {
                                                  if (strtolower($offerDetails->discount_type) == 'percentage') {
                                                      $offerName = "Flat {$offerDetails->value}% Off";
                                                  } else {
                                                      $offerName = "Flat ₹{$offerDetails->value} Off";
                                                  }
                                              } elseif (str_contains($offerDetails->type, '@')) {
                                                  $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                                                  $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                                              } else {
                                                  $offerName = $offerDetails->title ?: $offerDetails->type;
                                              }
                                          }
                                      }
                                      if (empty($offerName)) {
                                          $offerName = $row['offer_text'] ?? $row['offer_type'] ?? null;
                                      }
                                  @endphp
                                                                                @if(!empty($offerName))
                @php
                    $shape = 'ribbon';
                    $bg = '#1a5fe5';
                    $text = '#ffffff';
                    $shadow = '0 2px 8px rgba(0,0,0,0.25)';
                    
                    $offerLower = strtolower($offerName);
                    if (str_contains($offerLower, '@')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #d41e7d, #a3105a)'; // Pink for Buy @
                    } elseif (str_contains($offerLower, 'buy') || str_contains($offerLower, 'free')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #7a1ae5, #5b10b8)'; // Purple for Buy X Get Y
                    } elseif (str_contains($offerLower, 'cash')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #2ebd59, #1fa04a)';
                    } elseif (str_contains($offerLower, 'flat')) {
                        $shape = 'shield';
                        $bg = 'linear-gradient(135deg, #1a73e8, #1558b5)';
                    } elseif (str_contains($offerLower, 'intro')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e97a31, #d46520)';
                    } elseif (str_contains($offerLower, 'save')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #ffd400, #f0c800)';
                        $text = '#000000';
                    } elseif (str_contains($offerLower, 'discount') || str_contains($offerLower, 'off')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e51a2f, #c41525)';
                    } else {
                        $bg = 'linear-gradient(135deg, #1a5fe5, #1450c0)';
                    }
                    
                    $style = '';
                    if ($shape == 'ribbon') {
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                    } elseif ($shape == 'circle') {
                        $style = "position:absolute; top:8px; left:8px; width:56px; height:56px; border-radius:50%; padding:4px; box-shadow:{$shadow};";
                    } else { // shield
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:60px; clip-path:polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%); padding:6px 3px 16px 3px;";
                    }
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

                                 <div class="product-action-vertical">
                                     <a href="#" onclick="addwishlist('{{  $row['id'] }}', this)" class="btn-product-icon btn-wishlist {{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                         title="Add to wishlist"></a>
                                 </div>
                                 <div class="product-action"> <!--  -->
                                     <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>' class="btn-product btnquickview" title="Quick View">Quick
                                         View</a>
                                 </div>
                             </figure>
                             <div class="product-details">
                                 <div class="sold-by">
                                     <b><a href="<?= url('/shop/' . ($row['vendor_slug'] ?? $row['vendor_id'])) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                 </div>
                                 <h4 class="product-name"><a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                             </div>
                             <div class="ratings-container">
                                 <div class="ratings-full">
                                     <span class="ratings" style="width: {{ $row['rating_percent'] ?? 0 }}%"></span>
                                 </div>
                                 <a>({{ $row['review_count'] ?? 0 }} Reviews)</a>
                             </div>
                             <div class="product-pa-wrapper">
                                 <div class="product-price-home">
                                     ₹{{ $row['selling_price'] }}
                                 </div>
                                 <div class="product-price-discount">
                                     ₹{{ $row['retail_price'] }}
                                 </div>
                                 <?php
                                    $retailPrice = (float) ($row['retail_price'] ?? 0);
                                    $sellingPrice = (float) ($row['selling_price'] ?? 0);
                                    if ($retailPrice > 0) {
                                        $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    } else {
                                        $discount_rounded = 0;
                                    }
                                    ?>

                                 <div class="product-offer-percentage">
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
             <a href="{{ url('main-category/women') }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($womensProducts)) {
                    foreach ($womensProducts as $row) { ?>
                     <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                         <div class="product product-simple text-center">
                             <figure class="product-media">
                                 <a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>">
                                     <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                         height="291" />
                                 </a>

                                  @php
                                      $offerName = '';
                                      $offerId = $row['offer_id'] ?? $row['offers'] ?? null;
                                      if ($offerId) {
                                          $offerDetails = DB::table('master_offers')->where('id', $offerId)->first();
                                          if ($offerDetails) {
                                              if ($offerDetails->type == "Buy X Get Y Free") {
                                                  $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                                              } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                                                  if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                                      $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                                                  } else {
                                                      $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                                                  }
                                              } elseif ($offerDetails->type == "Fixed Discount") {
                                                  if (strtolower($offerDetails->discount_type) == 'percentage') {
                                                      $offerName = "Flat {$offerDetails->value}% Off";
                                                  } else {
                                                      $offerName = "Flat ₹{$offerDetails->value} Off";
                                                  }
                                              } elseif (str_contains($offerDetails->type, '@')) {
                                                  $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                                                  $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                                              } else {
                                                  $offerName = $offerDetails->title ?: $offerDetails->type;
                                              }
                                          }
                                      }
                                      if (empty($offerName)) {
                                          $offerName = $row['offer_text'] ?? $row['offer_type'] ?? null;
                                      }
                                  @endphp
                                                                                @if(!empty($offerName))
                @php
                    $shape = 'ribbon';
                    $bg = '#1a5fe5';
                    $text = '#ffffff';
                    $shadow = '0 2px 8px rgba(0,0,0,0.25)';
                    
                    $offerLower = strtolower($offerName);
                    if (str_contains($offerLower, '@')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #d41e7d, #a3105a)'; // Pink for Buy @
                    } elseif (str_contains($offerLower, 'buy') || str_contains($offerLower, 'free')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #7a1ae5, #5b10b8)'; // Purple for Buy X Get Y
                    } elseif (str_contains($offerLower, 'cash')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #2ebd59, #1fa04a)';
                    } elseif (str_contains($offerLower, 'flat')) {
                        $shape = 'shield';
                        $bg = 'linear-gradient(135deg, #1a73e8, #1558b5)';
                    } elseif (str_contains($offerLower, 'intro')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e97a31, #d46520)';
                    } elseif (str_contains($offerLower, 'save')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #ffd400, #f0c800)';
                        $text = '#000000';
                    } elseif (str_contains($offerLower, 'discount') || str_contains($offerLower, 'off')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e51a2f, #c41525)';
                    } else {
                        $bg = 'linear-gradient(135deg, #1a5fe5, #1450c0)';
                    }
                    
                    $style = '';
                    if ($shape == 'ribbon') {
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                    } elseif ($shape == 'circle') {
                        $style = "position:absolute; top:8px; left:8px; width:56px; height:56px; border-radius:50%; padding:4px; box-shadow:{$shadow};";
                    } else { // shield
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:60px; clip-path:polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%); padding:6px 3px 16px 3px;";
                    }
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

                                 <div class="product-action-vertical">
                                     <a href="#" onclick="addwishlist('{{  $row['id'] }}', this)" class="btn-product-icon btn-wishlist {{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                         title="Add to wishlist"></a>
                                 </div>
                                 <div class="product-action"> <!--  -->
                                     <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>' class="btn-product btnquickview" title="Quick View">Quick
                                         View</a>
                                 </div>
                             </figure>
                             <div class="product-details">
                                 <div class="sold-by">
                                     <b><a href="<?= url('/shop/' . ($row['vendor_slug'] ?? $row['vendor_id'])) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                 </div>
                                 <h4 class="product-name"><a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                             </div>
                             <div class="ratings-container">
                                 <div class="ratings-full">
                                     <span class="ratings" style="width: {{ $row['rating_percent'] ?? 0 }}%"></span>
                                 </div>
                                 <a>({{ $row['review_count'] ?? 0 }} Reviews)</a>
                             </div>
                             <div class="product-pa-wrapper">
                                 <div class="product-price-home">
                                     ₹{{ $row['selling_price'] }}
                                 </div>
                                 <div class="product-price-discount">
                                     ₹{{ $row['retail_price'] }}
                                 </div>
                                 <?php
                                    $retailPrice = (float) ($row['retail_price'] ?? 0);
                                    $sellingPrice = (float) ($row['selling_price'] ?? 0);
                                    if ($retailPrice > 0) {
                                        $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    } else {
                                        $discount_rounded = 0;
                                    }
                                    ?>

                                 <div class="product-offer-percentage">
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
             <a href="{{ url('main-category/kids') }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($kidsProducts)) {
                    foreach ($kidsProducts as $row) { ?>
                     <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6">
                         <div class="product product-simple text-center">
                             <figure class="product-media">
                                 <a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>">
                                     <img src="<?php echo asset('assets') ?>/images/products/<?= $row['product_image'] ?>" alt="Product" width="260"
                                         height="291" />
                                 </a>

                                  @php
                                      $offerName = '';
                                      $offerId = $row['offer_id'] ?? $row['offers'] ?? null;
                                      if ($offerId) {
                                          $offerDetails = DB::table('master_offers')->where('id', $offerId)->first();
                                          if ($offerDetails) {
                                              if ($offerDetails->type == "Buy X Get Y Free") {
                                                  $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                                              } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                                                  if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                                      $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                                                  } else {
                                                      $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                                                  }
                                              } elseif ($offerDetails->type == "Fixed Discount") {
                                                  if (strtolower($offerDetails->discount_type) == 'percentage') {
                                                      $offerName = "Flat {$offerDetails->value}% Off";
                                                  } else {
                                                      $offerName = "Flat ₹{$offerDetails->value} Off";
                                                  }
                                              } elseif (str_contains($offerDetails->type, '@')) {
                                                  $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                                                  $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                                              } else {
                                                  $offerName = $offerDetails->title ?: $offerDetails->type;
                                              }
                                          }
                                      }
                                      if (empty($offerName)) {
                                          $offerName = $row['offer_text'] ?? $row['offer_type'] ?? null;
                                      }
                                  @endphp
                                                                                @if(!empty($offerName))
                @php
                    $shape = 'ribbon';
                    $bg = '#1a5fe5';
                    $text = '#ffffff';
                    $shadow = '0 2px 8px rgba(0,0,0,0.25)';
                    
                    $offerLower = strtolower($offerName);
                    if (str_contains($offerLower, '@')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #d41e7d, #a3105a)'; // Pink for Buy @
                    } elseif (str_contains($offerLower, 'buy') || str_contains($offerLower, 'free')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #7a1ae5, #5b10b8)'; // Purple for Buy X Get Y
                    } elseif (str_contains($offerLower, 'cash')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #2ebd59, #1fa04a)';
                    } elseif (str_contains($offerLower, 'flat')) {
                        $shape = 'shield';
                        $bg = 'linear-gradient(135deg, #1a73e8, #1558b5)';
                    } elseif (str_contains($offerLower, 'intro')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e97a31, #d46520)';
                    } elseif (str_contains($offerLower, 'save')) {
                        $shape = 'circle';
                        $bg = 'linear-gradient(135deg, #ffd400, #f0c800)';
                        $text = '#000000';
                    } elseif (str_contains($offerLower, 'discount') || str_contains($offerLower, 'off')) {
                        $shape = 'ribbon';
                        $bg = 'linear-gradient(135deg, #e51a2f, #c41525)';
                    } else {
                        $bg = 'linear-gradient(135deg, #1a5fe5, #1450c0)';
                    }
                    
                    $style = '';
                    if ($shape == 'ribbon') {
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                    } elseif ($shape == 'circle') {
                        $style = "position:absolute; top:8px; left:8px; width:56px; height:56px; border-radius:50%; padding:4px; box-shadow:{$shadow};";
                    } else { // shield
                        $style = "position:absolute; top:0; left:10px; width:52px; min-height:60px; clip-path:polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%); padding:6px 3px 16px 3px;";
                    }
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

                                 <div class="product-action-vertical">
                                     <a href="#" onclick="addwishlist('{{  $row['id'] }}', this)" class="btn-product-icon btn-wishlist {{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($row['id'], $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                         title="Add to wishlist"></a>
                                 </div>
                                 <div class="product-action"> <!--  -->
                                     <a href="javascript:void(0)" onclick="showQuickView('<?= $row['id'] ?>')" data-id='<?= $row['id'] ?>' class="btn-product btnquickview" title="Quick View">Quick
                                         View</a>
                                 </div>
                             </figure>
                             <div class="product-details">
                                 <div class="sold-by">
                                     <b><a href="<?= url('/shop/' . ($row['vendor_slug'] ?? $row['vendor_id'])) ?>"><?= $row['shop_name'] ?? 'N/A' ?></a></b>
                                 </div>
                                 <h4 class="product-name"><a href="<?= url('/products/' . ($row['slug'] ?? $row['id'])) ?>"><?= ucwords($row['product_name']) ?></a></h4>

                             </div>
                             <div class="ratings-container">
                                 <div class="ratings-full">
                                     <span class="ratings" style="width: {{ $row['rating_percent'] ?? 0 }}%"></span>
                                 </div>
                                 <a>({{ $row['review_count'] ?? 0 }} Reviews)</a>
                             </div>
                             <div class="product-pa-wrapper">
                                 <div class="product-price-home">
                                     ₹{{ $row['selling_price'] }}
                                 </div>
                                 <div class="product-price-discount">
                                     ₹{{ $row['retail_price'] }}
                                 </div>
                                 <?php
                                    $retailPrice = (float) ($row['retail_price'] ?? 0);
                                    $sellingPrice = (float) ($row['selling_price'] ?? 0);
                                    if ($retailPrice > 0) {
                                        $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                        $discount_rounded = round($discount_percentage / 10) * 10;
                                    } else {
                                        $discount_rounded = 0;
                                    }
                                    ?>

                                 <div class="product-offer-percentage">
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

         @if(isset($auctionProducts) && count($auctionProducts) > 0)
         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Auction Products</h2>
             <a href="{{ url('auction') }}" class="mb-0">More Products<i
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
                 @foreach($auctionProducts as $auction)
                 <div class="swiper-slide product product-simple text-center">
                     <figure class="product-media">
                         <a href="{{ route('auction.detail', $auction->auction_id) }}">
                             <img src="{{ asset('assets/images/products/' . $auction->product_image) }}" alt="Product" width="260"
                                 height="291" />
                         </a>
                          <div class="product-action-vertical">
                              <a href="#" onclick="addwishlist('{{ $auction->id }}', this)" class="btn-product-icon btn-wishlist {{ in_array($auction->id, $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($auction->id, $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"
                                  title="Add to wishlist"></a>
                          </div>
                          <div class="product-countdown-container">
                             @php
                                $endDateStr = str_replace('T', ' ', $auction->end_date);
                                $parsedDate = \Carbon\Carbon::parse($endDateStr);
                                $formattedForJs = $parsedDate->format('Y, n, j, G, i, s');
                             @endphp
                             <div class="product-countdown countdown-compact" data-until="{{ $formattedForJs }}"
                                 data-format="DHMS" data-compact="false" data-labels-short="Days, Hours, Mins, Secs">
                                 00:00:00:00</div>
                         </div>
                     </figure>
                     <div class="product-details">
                         <div class="sold-by">
                             <b><a href="{{ url('/shop/' . ($auction->vendor_slug ?? $auction->vendor_id)) }}">{{ $auction->shop_name ?? 'Admin' }}</a></b>
                         </div>
                         <h4 class="product-name"><a href="{{ route('auction.detail', $auction->auction_id) }}">{{ ucwords($auction->product_name) }}</a></h4>

                         <div class="ratings-container">
                             <div class="ratings-full">
                                 <span class="ratings" style="width: {{ $auction->rating_percent ?? 0 }}%"></span>
                             </div>
                             <a>({{ $auction->review_count ?? 0 }} Reviews)</a>
                         </div>

                         <div class="product-pa-wrapper" style="display: flex; align-items: center; justify-content: center; padding-top: 5px;">
                             <div class="product-price-home" style="font-family: monospace; font-size: 1.6rem; font-weight: 700; color: #000;" title="Bid Amount">
                                <span style="color: #666; font-size: 1.4rem; font-weight: 600; margin-right: 5px; font-family: inherit;">Bid:</span>₹{{ $auction->selling_price > 0 ? $auction->selling_price : ($auction->retail_price ?? 0) }}
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- End of Product Simple -->
                 @endforeach

             </div>
             <div class="swiper-pagination"></div>
         </div>
         <!-- End of Swiper Container -->
         @endif

     </div>
<style>
.brands-wrapper .swiper-wrapper {
    align-items: flex-start !important;
}
.vendor-figure {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    margin: 0 !important;
    padding: 0 !important;
    text-align: center;
}

.vendor-img-link {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
    padding: 0 !important;
    text-decoration: none !important;
}

.vendor-img-wrap {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 120px !important;
    height: 120px !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    border: 3px solid #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    background-color: #f5f6f9;
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease, border-color 0.4s ease;
    flex-shrink: 0 !important;
}

.vendor-profile-img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    border-radius: 50% !important;
    display: block;
}

/* Background Section */
.custom-shops-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #edf1f5 100%);
    padding: 40px 0;
    border-top: 1px solid #eaeaea;
    margin-top: 25px;
}

.swiper-slide-vendor center {
    margin: 0 !important;
    padding: 0 !important;
}

.vendor-name {
    font-weight: 600;
    font-size: 15px;
    color: #333;
    transition: color 0.3s ease;
    margin-top: 6px;
    letter-spacing: 0.3px;
    padding: 0 5px;
    min-height: 36px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-word;
}

/* Hover effects */
.swiper-slide-vendor {
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    align-items: center !important;
    cursor: pointer;
    text-align: center;
    padding-top: 5px !important;
}

.swiper-slide-vendor:hover .vendor-img-wrap {
    transform: translateY(-8px) scale(1.05); /* Lift up and scale slightly */
    box-shadow: 0 15px 30px rgba(0, 136, 221, 0.25);
    border-color: #0088dd; /* Ring highlight */
}

.swiper-slide-vendor:hover .vendor-name {
    color: #0088dd; /* Highlight text */
}

/* --- MOBILE SPECIFIC MEDIA QUERIES --- */
@media (max-width: 991px) {
    .custom-shops-section {
        padding: 30px 0 !important;
        margin-top: 20px !important;
    }
    .vendor-img-wrap {
        width: 100px !important;
        height: 100px !important;
    }
}

@media (max-width: 768px) {
    .custom-shops-section {
        padding: 20px 0 !important;
        margin-top: 15px !important;
    }
    .custom-shops-section h2.title {
        font-size: 20px !important;
        margin-bottom: 12px !important;
    }
    /* Strictly force the images to be round circles */
    .vendor-img-wrap {
        width: 80px !important;
        height: 80px !important;
        border-width: 2px !important;
    }
    .vendor-name {
        font-size: 12px !important;
        min-height: 30px !important;
    }
}

@media (max-width: 480px) {
    .custom-shops-section {
        padding: 10px 0 !important;
        margin-top: 10px !important;
    }
    .custom-shops-section h2.title {
        font-size: 17px !important;
        margin-bottom: 8px !important;
    }
    /* Very strict exact pixels to override any global resizing */
    .vendor-img-wrap {
        width: 70px !important;
        height: 70px !important;
        border-width: 2px !important;
    }
    .vendor-name {
        font-size: 10px !important;
        margin-top: 4px;
        line-height: 1.2;
        min-height: 24px !important;
    }
}
</style>

     <div class="custom-shops-section">
         <div class="container">
             <h2 class="title text-left mb-5 appear-animate"> Shops</h2>
         <div class="swiper-container swiper-theme  brands-wrapper br-sm mb-9 appear-animate"
             data-swiper-options="{
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    },
                    'loop': true,
                    'spaceBetween': 20,
                    'slidesPerView': 3,
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
             <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-3">

                 <?php if (isset($vendorcreate)) {
                        foreach ($vendorcreate as $row) { ?>
                           
                         <div class="swiper-slide swiper-slide-vendor">
                            <figure class="vendor-figure">
                                <a href="<?= url('/shop/' . ($row['slug'] ?? $row['id'])) ?>" class="vendor-img-link">
                                    <span class="vendor-img-wrap">
                                        <img
                                            class="vendor-profile-img"
                                            src="{{ asset('assets/images/vendor/profile/' . $row->profile_image) }}"
                                            alt="Brand"
                                        />
                                    </span>
                                </a>

                              
                            </figure>
                              <center>
                                    <figcaption class="vendor-name">
                                        {{ $row->shop_name }}
                                    </figcaption>
                                </center>
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
                'spaceBetween': 20,
                'slidesPerView': 3,
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
             <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-3">

                 @isset($locations)
                    @foreach($locations as $key=>$row)

                    @php
                    $imgNo = ($key % 9) + 1;
                    @endphp
                     <div class="swiper-slide swiper-slide-vendor">
                            <figure class="vendor-figure">
                               
                                    <span class="vendor-img-wrap">
                                        <img
                                            class="vendor-profile-img"
                                            src="{{ asset('frontend/images/00' .$imgNo  . '.jpg') }}"
                                            alt="Brand"
                                        />
                                    </span>
                              

                              
                            </figure>
                              <center>
                                    <figcaption class="vendor-name">
                                       {{ $row->area }}
                                    </figcaption>
                                </center>
                        </div>

                    @endforeach
                 @endisset

             </div>
         </div>
     </div>
 </main>

 @endsection
