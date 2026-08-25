@extends('app_template')
 @section('title','Tryneww')
 @section('content')
 <style>
    .product-price-home{

        font-family: monospace;
    }
    .title-link-wrapper a {
        color: #0088dd !important;
    }
    @media (max-width: 767px) {
        .animation-slider,
        .animation-slider .swiper-wrapper,
        .animation-slider .intro-slide,
        .animation-slider .intro-slide1 {
            min-height: 260px !important;
            height: 260px !important;
        }
        .animation-slider .banner-content {
            top: 45% !important;
            transform: translateY(-50%) !important;
        }
        .animation-slider .banner-content .btn {
            font-size: 10px !important;
            padding: 8px 16px !important;
            margin-top: 0 !important;
            line-height: 1.2 !important;
        }
        .main > div.pb-2 {
            padding-bottom: 0 !important;
        }
        .main > div.pb-2 > div.mt-4 {
            margin-top: 0 !important;
        }
        .offer-badges-container {
            margin-top: 5px !important;
            margin-bottom: 0px !important;
        }
        .auction-container {
            margin-top: 15px !important;
            margin-bottom: 5px !important;
        }
        .auction-container .title-link-wrapper {
            margin-bottom: 5px !important;
        }
        .auction-container .title {
            padding-top: 0px !important;
            padding-bottom: 0px !important;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
        .info-icon-box-wrapper {
            margin-top: 15px !important;
        }
        .category-banner-2cols img {
            min-height: 180px !important;
        }
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

     <!-- Offer Badges Section -->
     @if(isset($sliderOffers) && count($sliderOffers) > 0)
      <div class="container mt-2 mb-2 offer-badges-container" style="margin-top: 15px !important;">
         <style>
             .offer-badge-img-wrapper {
                 width: 65px;
                 height: 65px;
                 border-radius: 50%;
                 overflow: hidden;
                 margin: 0 auto 6px;
                 box-shadow: 0 3px 6px rgba(0,0,0,0.1);
                 background-color: #fff;
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 border: 1px solid #e2e8f0;
                 transition: transform 0.2s ease, box-shadow 0.2s ease;
             }
             .offer-badge-img-wrapper:hover {
                 transform: scale(1.08);
                 box-shadow: 0 5px 12px rgba(0,0,0,0.15);
             }
             .offer-badge-img {
                 width: 100%;
                 height: 100%;
                 object-fit: contain;
                 padding: 2px;
             }
             .offer-badge-css {
                 width: 65px;
                 height: 65px;
                 border-radius: 50%;
                 display: flex;
                 flex-direction: column;
                 align-items: center;
                 justify-content: center;
                 color: #fff;
                 font-weight: 700;
                 box-shadow: 0 3px 6px rgba(0,0,0,0.1);
                 border: 1.5px solid #fff;
                 padding: 4px;
                 margin: 0 auto 6px;
                 transition: transform 0.2s ease, box-shadow 0.2s ease;
                 box-sizing: border-box;
             }
             .offer-badge-css:hover {
                 transform: scale(1.08);
                 box-shadow: 0 5px 12px rgba(0,0,0,0.2);
             }
             .offer-badge-css span {
                 font-size: 9.5px;
                 font-weight: 800;
                 line-height: 1.15;
                 text-transform: uppercase;
                 text-align: center;
                 width: 100%;
                 overflow: hidden;
                 text-overflow: ellipsis;
                 white-space: nowrap;
             }
         </style>
         
         <div class="swiper-container swiper-theme"
              data-swiper-options="{
                     'slidesPerView': 4,
                     'slidesPerGroup': 4,
                     'spaceBetween': 10,
                     'loop': true,
                     'autoplay': {
                         'delay': 2000,
                         'disableOnInteraction': false
                     },
                     'breakpoints': {
                         '576': {
                             'slidesPerView': 4,
                             'slidesPerGroup': 4
                         },
                         '768': {
                             'slidesPerView': 6,
                             'slidesPerGroup': 6
                         },
                         '992': {
                             'slidesPerView': 8,
                             'slidesPerGroup': 8
                         }
                     }
                 }">
             <div class="swiper-wrapper">
                 @foreach($sliderOffers as $key => $offer)
                     <div class="swiper-slide text-center">
                         <a href="{{ url('offers?id='.$offer->id) }}">
                             @if(!empty($offer->db_logo))
                                 <div class="offer-badge-img-wrapper">
                                     <img class="offer-badge-img" src="{{ asset('assets/images/offer_logo/' . $offer->offer_logo) }}" alt="{{ $offer->title }}">
                                 </div>
                             @else
                                  @php
                                      $gradients = [
                                          'linear-gradient(135deg, #60a5fa 0%, #2563eb 100%)',
                                          'linear-gradient(135deg, #34d399 0%, #059669 100%)',
                                          'linear-gradient(135deg, #fb7185 0%, #e11d48 100%)',
                                          'linear-gradient(135deg, #fbbf24 0%, #d97706 100%)',
                                          'linear-gradient(135deg, #818cf8 0%, #4f46e5 100%)',
                                          'linear-gradient(135deg, #f472b6 0%, #db2777 100%)'
                                      ];
                                      $bgGradient = $gradients[$key % 6];
                                      $badgeLines = [];

                                      if ($offer->type == 'Buy X Get Y Free') {
                                          $badgeLines = ['BUY ' . ($offer->buy ?? 1), 'GET ' . ($offer->getoffer ?? 1), 'FREE'];
                                      } elseif ($offer->type == 'Buy X @ Y') {
                                          $badgeLines = ['BUY ' . ($offer->buyproduct ?? 1), '@ ₹' . ($offer->getamt ?? 0)];
                                      } elseif ($offer->type == 'Cashback Offer') {
                                          $val = $offer->cashbackvalue ?? 0;
                                          $unit = ($offer->cashbacktype == 'Percentage') ? '%' : '';
                                          $prefix = ($offer->cashbacktype == 'Percentage') ? '' : '₹';
                                          $badgeLines = ['CASH', 'BACK', $prefix . $val . $unit . ' OFF'];
                                      } elseif ($offer->type == 'Fixed Discount') {
                                          $val = $offer->value ?? 0;
                                          $unit = ($offer->discount_type == 'Percentage') ? '%' : '';
                                          $prefix = ($offer->discount_type == 'Percentage') ? '' : '₹';
                                          $badgeLines = ['FLAT', $prefix . $val . $unit, 'OFF'];
                                      } else {
                                          $words = explode(' ', $offer->title);
                                          $badgeLines = array_slice($words, 0, 3);
                                      }
                                  @endphp
                                  <div class="offer-badge-css" style="background: {!! $bgGradient !!};">
                                      @foreach($badgeLines as $line)
                                          <span>{{ $line }}</span>
                                      @endforeach
                                  </div>
                             @endif
                         </a>
                     </div>
                 @endforeach
             </div>
         </div>
     </div>
     @endif

       <!-- Premium Feature Bar -->
       <div class="container pb-2">
         <style>
         /* Custom Feature Bar styles to match the premium design exactly */
         .premium-feature-bar {
             background: #ffffff;
             border-radius: 20px;
             box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
             border: 1px solid rgba(0, 0, 0, 0.03);
             padding: 1.5rem 2rem;
             margin: 2rem 0;
             display: flex;
             justify-content: space-between;
             align-items: center;
             flex-wrap: nowrap; /* Keep in a single row always */
             overflow: hidden;
         }

         .premium-feature-item {
             display: flex;
             align-items: center;
             flex: 1;
             min-width: 0; /* Allow items to shrink to fit single row */
             padding: 0 1rem;
             position: relative;
         }

         /* Vertical divider lines between items */
         .premium-feature-item:not(:last-child)::after {
             content: '';
             position: absolute;
             right: 0;
             top: 50%;
             transform: translateY(-50%);
             height: 30px;
             width: 1px;
             background-color: rgba(0, 0, 0, 0.08);
         }

         .premium-feature-icon {
             width: 40px;
             height: 40px;
             border-radius: 50%;
             display: flex;
             align-items: center;
             justify-content: center;
             margin-right: 1rem;
             flex-shrink: 0;
         }

         /* Specific background and icon colors matching the design */
         .premium-feature-icon.shipping {
             background-color: #fff0f3;
             color: #ff3b30;
         }

         .premium-feature-icon.payment {
             background-color: #eafaf1;
             color: #34c759;
         }

         .premium-feature-icon.returns {
             background-color: #e8f4fe;
             color: #007aff;
         }

         .premium-feature-icon.support {
             background-color: #fff9e6;
             color: #ff9500;
         }

         .premium-feature-icon svg {
             width: 18px;
             height: 18px;
         }

         .premium-feature-content {
             display: flex;
             flex-direction: column;
             min-width: 0;
         }

         .premium-feature-title {
             font-size: 1.2rem;
             font-weight: 700;
             color: #222222;
             margin: 0 0 0.1rem 0;
             line-height: 1.2;
             white-space: nowrap;
             overflow: hidden;
             text-overflow: ellipsis;
         }

         .premium-feature-desc {
             font-size: 1rem;
             color: #777777;
             margin: 0;
             line-height: 1.2;
             white-space: nowrap;
             overflow: hidden;
             text-overflow: ellipsis;
         }

         /* Responsive adjustments */
         @media (max-width: 991px) {
             .premium-feature-bar {
                 padding: 1rem 0.5rem;
                 border-radius: 16px;
                 margin: 1.5rem 0;
             }
             .premium-feature-item {
                 padding: 0 0.5rem;
             }
             .premium-feature-icon {
                 width: 32px;
                 height: 32px;
                 margin-right: 0.6rem;
             }
             .premium-feature-icon svg {
                 width: 14px;
                 height: 14px;
             }
             .premium-feature-title {
                 font-size: 0.95rem;
             }
             .premium-feature-desc {
                 font-size: 0.75rem;
             }
             .premium-feature-item:not(:last-child)::after {
                 height: 20px;
             }
         }

         @media (max-width: 576px) {
             .premium-feature-bar {
                 padding: 0.8rem 0.3rem;
                 border-radius: 12px;
             }
             .premium-feature-item {
                 padding: 0 0.3rem;
             }
             .premium-feature-icon {
                 width: 26px;
                 height: 26px;
                 margin-right: 0.4rem;
             }
             .premium-feature-icon svg {
                 width: 12px;
                 height: 12px;
             }
             .premium-feature-title {
                 font-size: 0.8rem;
             }
             .premium-feature-desc {
                 font-size: 0.65rem;
             }
             .premium-feature-item:not(:last-child)::after {
                 height: 16px;
             }
         }

         @media (max-width: 380px) {
             .premium-feature-title {
                 font-size: 0.7rem;
             }
             .premium-feature-desc {
                 font-size: 0.58rem;
             }
             .premium-feature-icon {
                 width: 20px;
                 height: 20px;
                 margin-right: 0.3rem;
             }
             .premium-feature-icon svg {
                 width: 10px;
                 height: 10px;
             }
         }
         </style>

         <div class="premium-feature-bar">
             <div class="premium-feature-item">
                 <div class="premium-feature-icon shipping">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                         <rect x="1" y="3" width="15" height="13"></rect>
                         <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                         <circle cx="5.5" cy="18.5" r="2.5"></circle>
                         <circle cx="18.5" cy="18.5" r="2.5"></circle>
                     </svg>
                 </div>
                 <div class="premium-feature-content">
                     <h4 class="premium-feature-title">Free Delivery</h4>
                     <p class="premium-feature-desc">On orders above ₹499</p>
                 </div>
             </div>
             <div class="premium-feature-item">
                 <div class="premium-feature-icon payment">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                         <path d="M9 11l2 2 4-4"></path>
                     </svg>
                 </div>
                 <div class="premium-feature-content">
                     <h4 class="premium-feature-title">Secure Payment</h4>
                     <p class="premium-feature-desc">100% Protected</p>
                 </div>
             </div>
             <div class="premium-feature-item">
                 <div class="premium-feature-icon returns">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                         <polyline points="23 4 23 10 17 10"></polyline>
                         <polyline points="1 20 1 14 7 14"></polyline>
                         <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                     </svg>
                 </div>
                 <div class="premium-feature-content">
                     <h4 class="premium-feature-title">Easy Returns</h4>
                     <p class="premium-feature-desc">7 Days Return</p>
                 </div>
             </div>
             <div class="premium-feature-item">
                 <div class="premium-feature-icon support">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                         <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                     </svg>
                 </div>
                 <div class="premium-feature-content">
                     <h4 class="premium-feature-title">24/7 Support</h4>
                     <p class="premium-feature-desc">We're here to help</p>
                 </div>
             </div>
         </div>
       </div>

      <!-- Auction Products (Moved below offers) -->
      @if(isset($auctionProducts) && count($auctionProducts) > 0)
      <div class="container mt-4 mb-4 auction-container">
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
          <!-- Shops Section (Moved after Auction Products) -->
          <div class="container mt-3 mb-0" style="margin-bottom: 0px !important; padding: 0 !important;">
              <div class="title-link-wrapper mb-3">
                  <h2 class="title mb-0 pt-2 pb-2" style="font-weight: 700; font-family: 'Poppins', sans-serif;">Shop by Seller</h2>
                  <a href="{{ url('shops') }}" class="mb-0" style="color: #ff4b72; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; font-size: 1.3rem;">View All <i class="w-icon-long-arrow-right" style="color: #ff4b72; font-weight: 800; font-size: 1.1rem; line-height: 1;"></i></a>
              </div>
              <div class="swiper-container swiper-theme brands-wrapper br-sm mb-1 appear-animate"
                  data-swiper-options="{
                         'autoplay': {
                             'delay': 4000,
                             'disableOnInteraction': false
                         },
                         'loop': true,
                         'spaceBetween': 10,
                         'slidesPerView': 4,
                         'breakpoints': {
                             '576': {
                                 'slidesPerView': 4
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
                  <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-4 cols-4">
                      <?php if (isset($vendorcreate)) {
                             foreach ($vendorcreate as $row) { ?>
                               <div class="swiper-slide swiper-slide-vendor">
                                  <figure class="vendor-figure">
                                      <a href="<?= url('/shop/' . ($row['slug'] ?? $row['id'])) ?>" class="vendor-img-link">
                                          <span class="vendor-img-wrap">
                                              <img
                                                  class="vendor-profile-img"
                                                  src="{{ asset('assets/images/vendor/profile/' . $row->profile_image) }}"
                                                  alt="{{ $row->shop_name }}"
                                              />
                                              <span class="vendor-name-overlay">{{ $row->shop_name }}</span>
                                          </span>
                                      </a>
                                  </figure>
                               </div>
                      <?php }
                         } ?>
                  </div>
              </div>
          </div>
          <!-- Category Banner 2Cols (Advertisements moved after Shop by Seller) -->
          @if(isset($oxygen_adv) && count($oxygen_adv) > 0)
          <div class="container mt-4 mb-0" style="padding: 0 !important; margin-bottom: 0px !important;">
              <div class="row cols-2 cols-md-2 category-banner-2cols mb-1">
                  @foreach($oxygen_adv->take(2) as $key => $banner)
                  <div class="banner banner-fixed mb-1">
                      <figure class="br-sm">
                          <img src="{{ asset('assets/images/banners/advoxygen/' . $banner->image) }}" alt="{{ $banner->title }}" width="680"
                              height="220" style="background-color: {{ $key == 0 ? '#384744' : '#e7e7e7' }}; object-fit: cover; height: 180px !important; width: 100% !important;" />
                      </figure>
                      <div class="banner-content y-50">
                          <h5 class="banner-subtitle text-uppercase {{ $key == 0 ? 'text-white' : '' }} font-weight-bold">{{ $banner->title }}</h5>
                          <h3 class="banner-title text-capitalize {{ $key == 0 ? 'text-white' : '' }}">{!! nl2br(e($banner->sub_title)) !!}</h3>
                          <a href="{{ $banner->link ?? '#' }}" class="btn {{ $key == 0 ? 'btn-white' : 'btn-dark' }} btn-link btn-slide-right btn-icon-right">
                              Shop Now<i class="w-icon-long-arrow-right"></i></a>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
          @endif
          </div>
         <!-- End of Icon Box Wrapper -->

          <!-- Offer Products Section (Moved after Advertisements) -->
          <div class="container mt-2 mb-4" style="margin-top: 15px !important;">
              <div class="title-link-wrapper mb-3">
                  <h2 class="title mb-0 pt-2 pb-2" style="font-weight: 700; font-family: 'Poppins', sans-serif;">Offer Products</h2>
                  <a href="{{ url('offers') }}" class="mb-0">More Products<i
                          class="w-icon-long-arrow-right"></i></a>
              </div>
              <div class="row grid banner-product-wrapper mb-6">
                  <?php if (isset($offerProducts)) {
                         foreach ($offerProducts as $key => $row) { ?>
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
                          $bg = 'linear-gradient(135deg, #34d399 0%, #059669 100%)';
                          $text = '#ffffff';
                          $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
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
          </div>

         <div class="swiper-container swiper-theme category-banner-3cols pt-0 mt-0" style="margin-top: 0px !important; padding-top: 0px !important;"
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

         <div class="row grid banner-product-wrapper mb-1">
             <?php if (isset($topRatedProducts)) {
                    foreach ($topRatedProducts as $key => $row) { ?>
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
                          $bg = 'linear-gradient(135deg, #34d399 0%, #059669 100%)';
                          $text = '#ffffff';
                          $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
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

          <!-- Shop by Location Section (Moved above Mens Products) -->
          <h2 class="title text-left mb-1 appear-animate mt-4" style="margin-bottom: 5px !important; font-weight: 700; font-family: 'Poppins', sans-serif;">Shop by Location</h2>
          <div class="swiper-container swiper-theme brands-wrapper br-sm mb-2 appear-animate mt-2"
              data-swiper-options="{
                 'autoplay': {
                     'delay': 4000,
                     'disableOnInteraction': false
                 },
                 'loop': true,
                 'spaceBetween': 10,
                 'slidesPerView': 4,
                 'breakpoints': {
                     '576': {
                         'slidesPerView': 4
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
              <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-4 cols-4">
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
                                              alt="{{ $row->area }}"
                                          />
                                          <span class="vendor-name-overlay">{{ $row->area }}</span>
                                      </span>
                              </figure>
                        </div>
                     @endforeach
                  @endisset
              </div>
          </div>

          <!-- Banner Shoes (Moved after Shop by Location) -->
          <div class="banner banner-shoes br-sm mb-2" style="background-image: url(<?php echo asset('frontend') ?>/images/demos/demo8/banner/3.jpg);
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

         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">Mens Products</h2>
             <a href="{{ url('main-category/men') }}" class="mb-0">More Products<i
                     class="w-icon-long-arrow-right"></i></a>
         </div>
         <div class="row grid banner-product-wrapper mb-6">
             <?php if (isset($mensProducts)) {
                    foreach ($mensProducts as $key => $row) { ?>
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
                          $bg = 'linear-gradient(135deg, #34d399 0%, #059669 100%)';
                          $text = '#ffffff';
                          $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
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
                    foreach ($womensProducts as $key => $row) { ?>
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
                          $bg = 'linear-gradient(135deg, #34d399 0%, #059669 100%)';
                          $text = '#ffffff';
                          $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
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
                    foreach ($kidsProducts as $key => $row) { ?>
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
                          $bg = 'linear-gradient(135deg, #34d399 0%, #059669 100%)';
                          $text = '#ffffff';
                          $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
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

.brands-wrapper {
    background: transparent !important;
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

.vendor-img-wrap {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 140px !important;
    height: 185px !important;
    border-radius: 15px !important;
    overflow: hidden !important;
    border: none !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    background-color: transparent !important;
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease, border-color 0.4s ease;
    flex-shrink: 0 !important;
    position: relative !important;
}

.vendor-profile-img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    border-radius: inherit !important; /* Inherit border-radius from parent */
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

.vendor-name-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 3rem 0.8rem 0.8rem 0.8rem;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 65%, rgba(0,0,0,0) 100%);
    color: #ffffff !important;
    font-weight: 700;
    font-size: 1.2rem;
    text-align: left;
    line-height: 1.2;
    z-index: 2;
    border-bottom-left-radius: inherit !important; /* Inherit border-radius from parent */
    border-bottom-right-radius: inherit !important; /* Inherit border-radius from parent */
    white-space: normal;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: color 0.3s ease;
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
    transform: translateY(-8px) scale(1.03); /* Lift up and scale slightly */
    box-shadow: 0 15px 30px rgba(0, 136, 221, 0.25);
    border-color: #0088dd; /* Ring highlight */
}

.swiper-slide-vendor:hover .vendor-name-overlay {
    color: #0088dd !important; /* Highlight text */
}

/* --- MOBILE SPECIFIC MEDIA QUERIES --- */
@media (max-width: 991px) {
    .custom-shops-section {
        padding: 30px 0 !important;
        margin-top: 20px !important;
    }
    .vendor-img-wrap {
        width: 110px !important;
        height: 145px !important;
        border-radius: 12px !important;
    }
    .vendor-profile-img {
        border-radius: inherit !important;
    }
    .vendor-name-overlay {
        font-size: 1rem;
        padding: 2.2rem 0.6rem 0.6rem 0.6rem;
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
    .vendor-img-wrap {
        width: 90px !important;
        height: 120px !important;
        border-radius: 12px !important;
        border: none !important;
    }
    .vendor-profile-img {
        border-radius: inherit !important;
    }
    .vendor-name-overlay {
        font-size: 0.85rem;
        padding: 1.8rem 0.4rem 0.4rem 0.4rem;
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
    .vendor-img-wrap {
        width: 75px !important;
        height: 100px !important;
        border-radius: 10px !important;
        border: none !important;
    }
    .vendor-profile-img {
        border-radius: inherit !important;
    }
    .vendor-name-overlay {
        font-size: 0.75rem;
        padding: 1.5rem 0.3rem 0.3rem 0.3rem;
    }
}
</style>


 </main>

 @endsection
