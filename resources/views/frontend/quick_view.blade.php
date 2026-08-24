<style>
     .product-single .product-image > img {
         height: 450px !important;
         object-fit: cover !important;
         width: 100% !important;
     }
 </style>
 <div class="product product-single product-popup">
     <div class="row gutter-lg">
         <div class="col-md-6 mb-4 mb-md-0">
             <div class="product-gallery product-gallery-sticky">
                 <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                     <div class="swiper-wrapper row cols-1 gutter-no">
                          <?php
                             if (isset($imageList)) {
                                 foreach ($imageList as $key => $row) { ?>
                                   <div class="swiper-slide">
                                       <figure class="product-image">
                                            <?php
                                                $imagePath = $row;
                                                if (!str_contains($imagePath, 'assets/')) {
                                                    $imagePath = 'assets/images/products/detail/' . $row;
                                                    if (!file_exists(public_path($imagePath)) && file_exists(public_path('assets/images/products/' . $row))) {
                                                        $imagePath = 'assets/images/products/' . $row;
                                                    }
                                                }
                                            ?>
                                           <img <?php if ($key === 0) { echo 'id="firstImg"'; } ?> src="<?php echo asset($imagePath) ?>"
                                               data-zoom-image="<?php echo asset($imagePath) ?>"
                                               alt="Water Boil Black Utensil" width="800" height="900">

                                           <?php if ($key === 0) { ?>
                                               @php
                                                   $offer_image = $prouctsList[$id]['offer_image'] ?? null;
                                               @endphp
                                                @php
                                                     $offer_image = $prouctsList[$id]['offer_image'] ?? null;
                                                     $offerName = '';
                                                     $offerId = null;
                                                     if (isset($prouctsList[$id])) {
                                                         $pObj = $prouctsList[$id];
                                                         if (is_array($pObj)) {
                                                             $offerId = $pObj['offer_id'] ?? null;
                                                         }
                                                     }
                                                     if (empty($offerId) && isset($offerDetails) && $offerDetails) {
                                                         $offerId = $offerDetails->id;
                                                     }
                                                     
                                                     if ($offerId) {
                                                         $offerInfo = DB::table('master_offers')->where('id', $offerId)->first();
                                                         if ($offerInfo) {
                                                             if ($offerInfo->type == "Buy X Get Y Free") {
                                                                 $offerName = 'Buy ' . ($offerInfo->buy ?: '1') . ' Get ' . ($offerInfo->getoffer ?: '1') . ' Free';
                                                             } elseif ($offerInfo->type == "Cashback" || $offerInfo->type == "Cashback Offer") {
                                                                 if (strtolower($offerInfo->cashbacktype) == 'percentage') {
                                                                     $offerName = "Cash Back {$offerInfo->cashbackvalue}% Off";
                                                                 } else {
                                                                     $offerName = "Cashback ₹{$offerInfo->cashbackvalue} Off";
                                                                 }
                                                             } elseif ($offerInfo->type == "Fixed Discount") {
                                                                 if (strtolower($offerInfo->discount_type) == 'percentage') {
                                                                     $offerName = "Flat {$offerInfo->value}% Off";
                                                                 } else {
                                                                     $offerName = "Flat ₹{$offerInfo->value} Off";
                                                                 }
                                                             } elseif (str_contains($offerInfo->type, '@')) {
                                                                 $buyQty = $offerInfo->buy ?: ($offerInfo->buyproduct ?: "1");
                                                                 $amt = $offerInfo->getamt ? "₹{$offerInfo->getamt}/-" : "{$offerInfo->value}%";
                                                                 $offerName = "Buy {$buyQty} @ {$amt}";
                                                             } else {
                                                                 $offerName = $offerInfo->title ?: $offerInfo->type;
                                                             }
                                                         }
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
                                                   <?php } ?>
                                       </figure>
                                   </div>
                          <?php }
                             }   ?>
                     </div>
                 </div>
                 <div class="product-thumbs-wrap swiper-container">
                     <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                         <?php

                            if (isset($imageList)) {
                                foreach ($imageList as $key => $row) { ?>
                                   <?php
                                       $imagePath = $row;
                                       if (!str_contains($imagePath, 'assets/')) {
                                           $imagePath = 'assets/images/products/detail/' . $row;
                                           if (!file_exists(public_path($imagePath)) && file_exists(public_path('assets/images/products/' . $row))) {
                                               $imagePath = 'assets/images/products/' . $row;
                                           }
                                       }
                                   ?>
                                  <div onclick="setImage(this)" data-image="<?php echo asset($imagePath) ?>" class="product-thumb swiper-slide">
                                      <img  src="<?php echo asset($imagePath) ?>" alt="Product Thumb" width="103"
                                          height="116">
                                  </div>

                         <?php }
                            }   ?>
                     </div>


                     <!-- <button class="swiper-button-next"></button>
                     <button class="swiper-button-prev"></button> -->
                 </div>
             </div>
         </div>
         <div class="col-md-6 overflow-hidden p-relative">
             <div class="product-details scrollable pl-0">
                 <h2 class="product-title"><?= $prouctsList[$id]['product_name'] ?></h2>
                 <div class="product-bm-wrapper">
                     <figure class="brand">
                         <img src="<?= asset('assets/images/vendor/profile/' . $prouctsList[$id]['profile_image']) ?>" alt="Brand" width="60" height="55" />
                     </figure>
                     <div class="product-meta">
                         <div class="product-categories">
                             Shop Name:
                             <span class="product-category"><a href="#"><?= $prouctsList[$id]['shop_name'] ?></a></span>
                         </div>
                         @if(!empty($prouctsList[$id]['mobile_number1']))
                         <div class="product-categories mt-1">
                             Shop Contact:
                             <span class="product-category"><a href="tel:<?= $prouctsList[$id]['mobile_number1'] ?>"><i class="w-icon-phone"></i> <?= $prouctsList[$id]['mobile_number1'] ?></a></span>
                         </div>
                         @endif
                         {{-- <div class="product-categories">
                             Category:
                             <span class="product-category"><a href="#"><?= $prouctsList[$id]['category_name'] ?></a></span>
                         </div>
                         <div class="product-categories">
                             Sub Category:
                             <span class="product-category"><a href="#"><?= $prouctsList[$id]['category_main_name'] ?></a></span>
                         </div> --}}
                         <!-- <div class="product-sku">
                               SKU: <span>MS46891340</span>
                           </div> -->
                     </div>
                 </div>

                 <hr class="product-divider">

                 <div class="product-pa-wrapper">
                     <div class="product-price">
                         ₹<?= $prouctsList[$id]['selling_price'] ?>
                     </div>
                     <div class="product-price-discount">
                         ₹<?= $prouctsList[$id]['retail_price'] ?>
                     </div>

                      <?php 
                         $retailPrice = (float)($prouctsList[$id]['retail_price'] ?? 0);
                         $sellingPrice = (float)($prouctsList[$id]['selling_price'] ?? 0);
                         $discount = $retailPrice > 0 ? round((($retailPrice - $sellingPrice) / $retailPrice) * 100) : 0;
                      ?>
                      <div class="product-offer-percentage">
                          <?= $discount ?>% Off
                      </div>
                 </div>

                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: {{ $percent ?? 0 }}%"></span>
                        </div>
                        <a>({{ $reviewCount }} Reviews)</a>
                    </div>

                 <div class="product-short-desc">
                     <!-- <ul class="list-type-check list-style-none">
                         <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                         <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                         <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                     </ul> -->
                     <p><?= $prouctsList[$id]['description'] ?></p>
                 </div>

                 <hr class="product-divider">
                 <div class="product-variation-price">
                     <span></span>
                 </div>

                 <div class="product-form">
                     <a href="<?= url('/products/' . ($prouctsList[$id]['slug'] ?? $prouctsList[$id]['id'])) ?>" class="btn btn-primary ">
                         <i class="w-icon-cart"></i>
                         <span>Add to Cart</span>
                     </a>
                 </div>

                  <div class="social-links-wrapper">
                      <div class="social-links">
                          <div class="social-icons social-no-color border-thin">
                              <a href="{{ $prouctsList[$id]['facebook_link'] ?? '#' }}" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                              <a href="{{ $prouctsList[$id]['instagram_link'] ?? '#' }}" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                              @php
                                  $whatsappNumber = preg_replace('/[^0-9]/', '', $prouctsList[$id]['whatsapp_number'] ?? '');
                              @endphp
                              <a href="{{ $whatsappNumber ? 'https://wa.me/' . $whatsappNumber : '#' }}" target="_blank" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                          </div>
                      </div>
                     <span class="divider d-xs-show"></span>
                      <div class="product-link-wrapper d-flex">
                          <a href="#" onclick="addwishlist('{{ $id }}', this)" class="btn-product-icon btn-wishlist {{ in_array($id, $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($id, $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"><span></span></a>
                      </div>
                 </div>
             </div>
         </div>
     </div>
 </div>