 <div class="product product-single product-popup">
     <div class="row gutter-lg">
         <div class="col-md-6 mb-4 mb-md-0">
             <div class="product-gallery product-gallery-sticky">
                 <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                     <div class="swiper-wrapper row cols-1 gutter-no">
                         <div class="swiper-slide">
                                     <figure class="product-image">
                                         <img id="firstImg" src="<?php echo asset('assets') ?>/images/products/<?= $prouctsList[$id]['product_image']?>"
                                             data-zoom-image="<?php echo asset('assets') ?>/images/products/<?= $prouctsList[$id]['product_image']?>"
                                             alt="Water Boil Black Utensil" width="800" height="900">

                                         @php
                                             $offer_image = $prouctsList[$id]['offer_image'] ?? null;
                                         @endphp
                                         @if($offer_image)
                                             <div class="product-label-group" style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                                                 <img src="{{ asset('assets/images/offer_logo/'.$offer_image) }}" alt="Offer" style="width: 50px; height: 50px; object-fit: contain; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3)); border-radius: 5px;">
                                             </div>
                                         @endif
                                     </figure>
                                 </div>
                         <?php
                            if (isset($imageList)) {
                                foreach ($imageList as $row) { ?>
                                 <div class="swiper-slide">
                                     <figure class="product-image">
                                         <img src="<?php echo asset('assets') ?>/images/products/detail/<?= $row ?>"
                                             data-zoom-image="<?php echo asset('assets') ?>/images/products/detail/<?= $row ?>"
                                             alt="Water Boil Black Utensil" width="800" height="900">
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
                                 <div onclick="setImage(this)" data-image="<?php echo asset('assets') ?>/images/products/detail/<?= $row ?>" class="product-thumb swiper-slide">
                                     <img  src="<?php echo asset('assets') ?>/images/products/detail/<?= $row ?>" alt="Product Thumb" width="103"
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

                     <div class="product-offer-percentage">
                         60% Off
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
                     <a href="<?= url('/productVar/' . $prouctsList[$id]['id']) ?>" class="btn btn-primary ">
                         <i class="w-icon-cart"></i>
                         <span>Add to Cart</span>
                     </a>
                 </div>

                 <div class="social-links-wrapper">
                     <div class="social-links">
                         <div class="social-icons social-no-color border-thin">
                             <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                             <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                             <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                             <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                             <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                         </div>
                     </div>
                     <span class="divider d-xs-show"></span>
                     <div class="product-link-wrapper d-flex">
                         <a href="#" onclick="addwishlist('{{ $id }}')" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>