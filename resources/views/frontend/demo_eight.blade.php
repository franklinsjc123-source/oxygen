@extends('app_template')
 @section('title','Tryneww')
 @section('content')
 @php
     $masterOffersMap = \Illuminate\Support\Facades\DB::table('master_offers')->get()->keyBy('id');
 @endphp
 <style>
    .animation-slider {
        padding-bottom: 40px !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
    }
    .animation-slider .swiper-pagination {
        bottom: 10px !important;
    }
    .animation-slider .swiper-wrapper,
    .animation-slider .intro-slide,
    .animation-slider .intro-slide1 {
        min-height: unset !important;
        aspect-ratio: 1920 / 880 !important;
    }
    .intro-slide {
        background-size: 100% 100% !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }
    .product-price-home{

        font-family: monospace;
    }
    .product-media img {
        object-fit: cover !important;
        width: 100% !important;
        height: 100% !important;
    }
    .title-link-wrapper a {
        color: #0088dd !important;
        transition: color 0.2s ease;
    }
    .title-link-wrapper a i {
        color: inherit !important;
    }
    .sold-by a,
    .ratings-container a,
    .rating-reviews {
        color: #0088dd !important;
        font-weight: 700;
        transition: color 0.2s ease;
    }
    a:hover,
    a:focus,
    .product-name a:hover,
    .product-title a:hover,
    .product-cat a:hover,
    .sold-by a:hover,
    .ratings-container a:hover,
    .rating-reviews:hover,
    .title-link-wrapper a:hover,
    .title-link-wrapper a:hover i,
    .btn-link:hover,
    .more-products:hover {
        color: #ff5e5e !important;
    }
    .btnquickview,
    .btn-product.btnquickview,
    .product-action .btn-product,
    .product-action .btn-product:hover,
    .product-action .btn-product:focus,
    .product-action .btn-product:active,
    .btnquickview:hover,
    .btnquickview:focus,
    .btnquickview:active,
    .product-popup .btn-primary,
    .product-popup .btn-primary:hover,
    .product-popup .btn-primary:focus,
    .product-popup .btn-primary:active,
    .product-popup .btn-primary *,
    .product-popup .btn-primary:hover * {
        color: #ffffff !important;
    }
    .banner-shoes {
        aspect-ratio: 1300 / 200 !important;
        background-size: contain !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        min-height: unset !important;
        height: auto !important;
    }
    @media (max-width: 767px) {
        .banner-shoes {
            aspect-ratio: 1300 / 450 !important;
            background-size: 100% 100% !important;
            min-height: unset !important;
            height: auto !important;
            padding: 10px 20px !important;
        }
        .banner-shoes .banner-content {
            padding: 0 !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }
        .banner-shoes .banner-title {
            font-size: 1rem !important;
            line-height: 1.2 !important;
            margin-bottom: 5px !important;
        }
        .banner-shoes .btn {
            font-size: 0.7rem !important;
            padding: 4px 8px !important;
        }
    }
    @media (max-width: 767px) {
        .animation-slider {
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
            padding-bottom: 15px !important;
        }
        .animation-slider .banner-content {
            top: auto !important;
            bottom: 10% !important;
            right: 5% !important;
            transform: none !important;
        }
        .animation-slider .banner-content .btn {
            font-size: 8px !important;
            padding: 4px 8px !important;
            margin-top: 0 !important;
            line-height: 1.2 !important;
        }
        h2.title {
            font-size: 1.2rem !important;
        }
    }
        .main > div.pb-2 {
            padding-bottom: 0 !important;
        }
        .main > div.pb-2 > div.mt-4 {
            margin-top: 0 !important;
        }
        .offer-badges-container {
            margin-top: 5px !important;
            margin-bottom: 5px !important;
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
            min-height: unset !important;
            height: auto !important;
            width: 100% !important;
            object-fit: fill !important;
            aspect-ratio: 330 / 160 !important;
        }
    }
 </style>
 <!-- Start of Main -->


 <main class="main">

     <div class="container-fluid p-0 pb-2" style="padding-left: 0 !important; padding-right: 0 !important; max-width: 100% !important;">
          <div class="mt-4" style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 0 !important; padding-right: 0 !important;">
              <div class="swiper-container swiper-theme pg-inner animation-slider row cols-1 gutter-no" data-swiper-options="{
                            'autoplay': {
                                'delay':3000,
                                'disableOnInteraction': false
                            }
                        }">
                 <div class="swiper-wrapper">
                     <?php if (isset($mainslider)) {
                            foreach ($mainslider as $val) { 
                                $slideUrl = !empty($val->link) ? (filter_var($val->link, FILTER_VALIDATE_URL) ? $val->link : url($val->link)) : url('shops');
                            ?>
                             <div class="swiper-slide banner banner-fixed intro-slide intro-slide1 br-sm"
                                 style="background-image: url(<?php echo asset('assets/images/banners/mainslider/' . $val->image) ?>); background-color: #E8EAEF; cursor: pointer;"
                                 onclick="window.location.href='<?php echo $slideUrl; ?>';">
                                 <a href="<?php echo $slideUrl; ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; display: block;" aria-label="Slider Banner Link"></a>
                                 <div class="banner-content y-50 text-right">
                                     <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                        }">
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
      <div class="container mt-5 mb-4 py-3 offer-badges-container">
          <style>
              .offer-badge-img-wrapper {
                  width: 85px;
                  height: 85px;
                  border-radius: 50%;
                  overflow: hidden;
                  margin: 0 auto 6px;
                  box-shadow: 0 4px 10px rgba(0,0,0,0.12);
                  background-color: #fff;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  border: 1px solid #e2e8f0;
                  transition: transform 0.2s ease, box-shadow 0.2s ease;
              }
              .offer-badge-img-wrapper:hover {
                  transform: scale(1.08);
                  box-shadow: 0 6px 14px rgba(0,0,0,0.18);
              }
              .offer-badge-img {
                  width: 100%;
                  height: 100%;
                  object-fit: contain;
                  padding: 2px;
              }
              .offer-badge-css {
                  width: 85px;
                  height: 85px;
                  border-radius: 50%;
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  justify-content: center;
                  color: #fff;
                  font-weight: 700;
                  box-shadow: 0 4px 10px rgba(0,0,0,0.12);
                  border: 2px solid #fff;
                  padding: 6px;
                  margin: 0 auto 6px;
                  transition: transform 0.2s ease, box-shadow 0.2s ease;
                  box-sizing: border-box;
              }
              .offer-badge-css:hover {
                  transform: scale(1.08);
                  box-shadow: 0 6px 14px rgba(0,0,0,0.22);
              }
              .offer-badge-css span {
                  font-size: 11px;
                  font-weight: 800;
                  line-height: 1.15;
                  text-transform: uppercase;
                  text-align: center;
                  width: 100%;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  white-space: nowrap;
              }
              @media (max-width: 767px) {
                   .offer-badge-img-wrapper,
                   .offer-badge-css {
                       width: 56px;
                       height: 56px;
                       margin-bottom: 4px;
                   }
                   .offer-badge-css {
                       padding: 3px;
                   }
                   .offer-badge-css span {
                       font-size: 8.5px;
                       line-height: 1.1;
                   }
                   .offer-badges-container {
                       margin-top: 1rem !important;
                       margin-bottom: 1rem !important;
                       padding-top: 0.5rem !important;
                       padding-bottom: 0.5rem !important;
                   }
              }
          </style>
          
          <div class="swiper-container swiper-theme"
               data-swiper-options="{
                      'slidesPerView': 4.5,
                      'spaceBetween': 8,
                      'initialSlide': 0,
                      'centeredSlides': false,
                      'loop': false,
                      'autoplay': false,
                      'freeMode': true,
                      'breakpoints': {
                          '576': {
                              'slidesPerView': 5.5,
                              'spaceBetween': 10
                          },
                          '768': {
                              'slidesPerView': 7.5,
                              'spaceBetween': 12
                          },
                          '992': {
                              'slidesPerView': 9.5,
                              'spaceBetween': 14
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

      <!-- Auction Products -->
      @if(isset($auctionProducts) && count($auctionProducts) > 0)
      <div class="container mt-4 mb-4 auction-container">
         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">BID & WIN</h2>
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
      </div>
          @endif

          <!-- Offer Products Section (Moved after Advertisements) -->
          <div class="container mt-2 mb-4" style="margin-top: 15px !important;">
              <div class="title-link-wrapper mb-3">
                  <h2 class="title mb-0 pt-2 pb-2" style="font-weight: 700; font-family: 'Poppins', sans-serif;">DEALS YOU’LL LOVE</h2>
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
                                                $offerDetails = $masterOffersMap[$offerId] ?? null;
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
                          $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
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
                 @php
                     $dbCategoryBanners = \App\Models\Banners\CategoryBanner::where('status', 1)->orderBy('sort', 'asc')->get();
                 @endphp
                 @if($dbCategoryBanners->isNotEmpty())
                     @foreach($dbCategoryBanners as $index => $item)
                         @php
                              $cUrl = !empty($item->link) ? (filter_var($item->link, FILTER_VALIDATE_URL) ? $item->link : url($item->link)) : 'javascript:void(0)';
                          @endphp
                          <div class="swiper-slide banner banner-fixed category-banner br-sm" style="cursor: pointer; position: relative;" onclick="if('{{ $cUrl }}' !== 'javascript:void(0)') window.location.href='{{ $cUrl }}';">
                              <a href="{{ $cUrl }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; display: block;" aria-label="{{ $item->title }}"></a>
                              <figure>
                                  <img src="{{ asset('assets/images/banners/category-banner/' . $item->image) }}" alt="Category Banner" width="447"
                                      height="230" />
                              </figure>
                              <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2" style="z-index: 2; pointer-events: none;">
                                   <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">{!! $item->sub_title !!}</h5>
                                   <h3 class="banner-title text-white text-uppercase ls-25 mb-0">{{ $item->title }}</h3>
                               </div>
                          </div>
                     @endforeach
                 @else
                     <div class="swiper-slide banner banner-fixed category-banner br-sm">
                         <figure>
                             <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-1.jpg" alt="Category Banner" width="447"
                                 height="230" style="background-color: #cfd1cf;" />
                         </figure>
                         <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2">
                             <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">Starting at <span class="text-secondary">₹29.00</span></h5>
                             <h3 class="banner-title text-white text-uppercase ls-25 mb-2">For Men's</h3>
                         </div>
                     </div>
                     <!-- End of Category Banner -->
                     <div class="swiper-slide banner banner-fixed category-banner br-sm">
                         <figure>
                             <img style="cursor:pointer" src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-2.jpg" alt="Category Banner" width="447"
                                 height="230" style="background-color: #0088dd" />
                         </figure>
                         <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2">
                             <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">Get 30% Off Your Entire Order!</h5>
                             <h3 class="banner-title text-white text-uppercase ls-25 mb-2">Black Friday Sale</h3>
                         </div>
                     </div>
                     <!-- End of Category Banner -->
                     <div class="swiper-slide banner banner-fixed category-banner br-sm">
                         <figure>
                             <img src="<?php echo asset('frontend') ?>/images/demos/demo8/category/1-3.jpg" alt="Category Banner" width="447"
                                 height="230" style="background-color: #e0dddd;" />
                         </figure>
                         <div class="banner-content text-center x-50 y-50 w-100 pl-2 pr-2">
                             <h5 class="banner-subtitle text-primary text-capitalize ls-25 font-weight-bold">From Only <span class="text-secondary">₹29.00</span></h5>
                             <h3 class="banner-title text-white text-uppercase ls-25 mb-2">For Women's</h3>
                         </div>
                     </div>
                     <!-- End of Category Banner -->
                 @endif
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <!-- End of Swiper Container -->


         <!-- End of Swiper -->


     </div>
     <!-- End of Offer Products Container -->


     <!-- Shops Section (Moved after Auction Products) -->
          <div class="container mt-3 mb-0" style="margin-bottom: 0px !important; padding-left: 15px !important; padding-right: 15px !important;">
              <div class="title-link-wrapper mb-3">
                  <h2 class="title mb-0 pt-2 pb-2" style="font-weight: 700; font-family: 'Poppins', sans-serif;">DISCOVER LOCAL SELLERS</h2>
                  <a href="{{ url('shops') }}" class="mb-0" style="font-weight: 600; display: inline-flex; align-items: center; gap: 4px; font-size: 1.3rem;">View All <i class="w-icon-long-arrow-right" style="font-weight: 800; font-size: 1.1rem; line-height: 1;"></i></a>
              </div>
              <div class="swiper-container swiper-theme brands-wrapper br-sm mb-1 appear-animate"
                  data-swiper-options="{
                         'autoplay': {
                             'delay': 4000,
                             'disableOnInteraction': false
                         },
                         'loop': true,
                         'spaceBetween': 8,
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

     

<div class="container mt-3">

         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">TRENDING & LOVED</h2>
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
                                          $offerDetails = $masterOffersMap[$offerId] ?? null;
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
                          $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
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

     <!-- Category Banner 2Cols (Advertisements moved before Mens Products) -->
     @if(isset($oxygen_adv) && count($oxygen_adv) > 0)
     <div class="container mt-1 mb-0" style="margin-bottom: 0px !important; margin-top: 5px !important;">
         <div class="row cols-1 cols-md-2 category-banner-2cols mb-1">
             @foreach($oxygen_adv->take(2) as $key => $banner)
             @php
                 $advLink = !empty($banner->link) ? (filter_var($banner->link, FILTER_VALIDATE_URL) ? $banner->link : url($banner->link)) : '#';
             @endphp
             <div class="banner banner-fixed mb-1" style="cursor: pointer; position: relative;" onclick="if('{{ $advLink }}' !== '#') window.location.href='{{ $advLink }}';">
                 <a href="{{ $advLink }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; display: block;" aria-label="{{ $banner->title }}"></a>
                 <figure class="br-sm">
                     <img src="{{ asset('assets/images/banners/advoxygen/' . $banner->image) }}" alt="{{ $banner->title }}" width="330"
                          height="160" style="background-color: {{ $key == 0 ? '#384744' : '#e7e7e7' }}; object-fit: cover; width: 100% !important; height: auto !important;" />
                 </figure>
                 <div class="banner-content y-50" style="z-index: 2; pointer-events: none;">
                     <h5 class="banner-subtitle text-uppercase {{ $key == 0 ? 'text-white' : '' }} font-weight-bold">{{ $banner->title }}</h5>
                     <h3 class="banner-title text-capitalize {{ $key == 0 ? 'text-white' : '' }}">{!! nl2br(e($banner->sub_title)) !!}</h3>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
     @endif

     <!-- Premium Feature Bar (Swiper Slider - one at a time on mobile) -->
          <div class="container mb-2">
             <style>
              /* Premium Feature Bar Slider Styles */
              .premium-feature-slider {
                  background: #ffffff;
                  border-radius: 16px;
                  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                  border: 1px solid #e2e8f0;
                  padding: 1.2rem 1.5rem;
                  margin: 1rem 0;
                  overflow: hidden;
                  position: relative;
              }
              .premium-feature-slider .swiper-slide {
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  padding: 0.5rem 0;
                  background: transparent !important;
                  border: none !important;
                  box-shadow: none !important;
              }

             .premium-feature-icon {
                 width: 54px;
                 height: 54px;
                 border-radius: 50%;
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 margin-right: 1.2rem;
                 flex-shrink: 0;
             }

             /* Specific background and icon colors */
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
                 width: 26px;
                 height: 26px;
             }

             .premium-feature-content {
                 display: flex;
                 flex-direction: column;
                 min-width: 0;
             }

             .premium-feature-title {
                 font-size: 1.5rem;
                 font-weight: 700;
                 color: #222222;
                 margin: 0 0 0.1rem 0;
                 line-height: 1.2;
                 white-space: nowrap;
                 overflow: hidden;
                 text-overflow: ellipsis;
             }

             .premium-feature-desc {
                 font-size: 1.15rem;
                 color: #777777;
                 margin: 0;
                 line-height: 1.2;
                 white-space: nowrap;
                 overflow: hidden;
                 text-overflow: ellipsis;
             }

             /* Responsive adjustments */
             @media (max-width: 991px) {
                 .premium-feature-slider {
                     padding: 1.2rem 1.4rem;
                     border-radius: 16px;
                     margin: 1.2rem 0;
                 }
                 .premium-feature-icon {
                     width: 52px;
                     height: 52px;
                     margin-right: 1rem;
                 }
                 .premium-feature-icon svg {
                     width: 25px;
                     height: 25px;
                 }
                 .premium-feature-title {
                     font-size: 1.45rem;
                 }
                 .premium-feature-desc {
                     font-size: 1.1rem;
                 }
             }

             @media (max-width: 576px) {
                 .premium-feature-slider {
                     padding: 1.4rem 1.2rem !important;
                     border-radius: 12px;
                     margin: 1rem 0;
                 }
                 .premium-feature-icon {
                     width: 50px;
                     height: 50px;
                     margin-right: 1rem;
                 }
                 .premium-feature-icon svg {
                     width: 24px;
                     height: 24px;
                 }
                 .premium-feature-title {
                     font-size: 1.4rem;
                     font-weight: 700;
                 }
                 .premium-feature-desc {
                     font-size: 1.1rem;
                 }
             }
             </style>

             <div class="premium-feature-slider">
                 <div class="swiper-container swiper-theme" data-swiper-options="{
                     'autoplay': {
                         'delay': 2500,
                         'disableOnInteraction': false
                     },
                     'loop': true,
                     'slidesPerView': 1,
                     'spaceBetween': 20,
                     'breakpoints': {
                         '768': {
                             'slidesPerView': 2,
                             'spaceBetween': 20
                         },
                         '992': {
                             'slidesPerView': 4,
                             'spaceBetween': 10
                         }
                     }
                 }">
                     <div class="swiper-wrapper">
                         <!-- Slide 1: Free Delivery -->
                         <div class="swiper-slide">
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
                         <!-- Slide 2: Secure Payment -->
                         <div class="swiper-slide">
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
                         <!-- Slide 3: Easy Returns -->
                         <div class="swiper-slide">
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
                         <!-- Slide 4: 24/7 Support -->
                         <div class="swiper-slide">
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
             </div>
          </div>

          


<div class="container">
         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">STYLES FOR HIM</h2>
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
                                          $offerDetails = $masterOffersMap[$offerId] ?? null;
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
                          $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
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

     <div class="container">

         <div class="title-link-wrapper mb-3">
             <h2 class="title mb-0 pt-2 pb-2">STYLES FOR HER</h2>
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
                                          $offerDetails = $masterOffersMap[$offerId] ?? null;
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
                          $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
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
             <h2 class="title mb-0 pt-2 pb-2">LITTLE ONES, BIG STYLE</h2>
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
                                          $offerDetails = $masterOffersMap[$offerId] ?? null;
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
                          $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
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

     <!-- Advertisement Banner (After LITTLE ONES, BIG STYLE) -->
     <div class="container mt-4 mb-3">
          @if(isset($paidAddSlip))
              @php
                  $paidLink = !empty($paidAddSlip->link) ? (filter_var($paidAddSlip->link, FILTER_VALIDATE_URL) ? $paidAddSlip->link : url($paidAddSlip->link)) : '#';
              @endphp
              <div class="banner banner-shoes br-sm mb-2" style="background-image: url({{ asset('assets/images/banners/adv-baner/' . $paidAddSlip->image) }}); background-color: #36332C; cursor: pointer; position: relative;" onclick="if('{{ $paidLink }}' !== '#') window.location.href='{{ $paidLink }}';">
                  <a href="{{ $paidLink }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; display: block;" aria-label="Paid Advertisement Banner"></a>
                  <div class="banner-content d-block d-lg-flex align-items-center" style="position: relative; z-index: 2; pointer-events: none;">
                      <div class="content-left mr-auto mb-6 mb-lg-0 align-items-center">
                          <h3 class="banner-title font-weight-normal text-white mb-0 ls-25">
                              {!! $paidAddSlip->title !!}<br><strong>{!! $paidAddSlip->sub_title !!}</strong>
                          </h3>
                      </div>
                  </div>
              </div>
          @else
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
                  </div>
                  <figure class="image-shoes skrollable">
                      <img src="<?php echo asset('frontend') ?>/images/demos/demo8/banner/shoes.png" alt="Shoes"
                          data-bottom-top="transform: translateY(2vh);"
                          data-top-bottom="transform: translateY(-2vh);">
                  </figure>
              </div>
          @endif
     </div>

     <div class="container">
          <!-- Shop by Location Section (Moved above Mens Products) -->
          <h2 class="title text-left mb-1 appear-animate mt-4" style="margin-bottom: 5px !important; font-weight: 700; font-family: 'Poppins', sans-serif;">SHOP NEAR YOU</h2>
          <div class="swiper-container swiper-theme brands-wrapper br-sm mb-2 appear-animate mt-2"
              data-swiper-options="{
                 'autoplay': {
                     'delay': 4000,
                     'disableOnInteraction': false
                 },
                 'loop': true,
                 'spaceBetween': 4,
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
    padding: 0 !important;
}

.vendor-img-wrap {
    display: block !important;
    width: 140px !important;
    height: 185px !important;
    border-radius: 15px !important;
    overflow: hidden !important;
    border: none !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    background-color: #ffffff !important;
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease, border-color 0.4s ease;
    flex-shrink: 0 !important;
    position: relative !important;
}

.vendor-profile-img {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
    border-radius: inherit !important; /* Inherit border-radius from parent */
    display: block !important;
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
    background: linear-gradient(to top, rgba(0, 136, 221, 0.95) 0%, rgba(0, 136, 221, 0.55) 65%, rgba(0, 136, 221, 0) 100%);
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
    transition: all 0.3s ease;
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
    transform: translateY(-6px) scale(1.02); /* Lift up and scale slightly */
    box-shadow: 0 10px 25px rgba(0, 136, 221, 0.3);
    border-color: #0088dd; /* Ring highlight */
}

.swiper-slide-vendor:hover .vendor-name-overlay {
    color: #ffffff !important; /* Highlight text */
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
    .brands-wrapper .swiper-wrapper {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    .brands-wrapper .swiper-slide {
        padding-left: 4px !important;
        padding-right: 4px !important;
    }
    .vendor-figure,
    .vendor-img-link {
        width: 100% !important;
    }
    .vendor-img-wrap {
        width: 100% !important;
        max-width: 100% !important;
        height: 115px !important;
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
        width: 100% !important;
        max-width: 100% !important;
        height: 105px !important;
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
