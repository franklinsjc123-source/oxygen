 @extends('app_template')
 @section('title','Vendor Products')
 @section('content')
 <!-- Start of Main -->
 <main class="main mb-10 pb-1">
     <!-- Start of Breadcrumb -->
     <nav class="breadcrumb-nav container">
         <ul class="breadcrumb bb-no">
             <li><a href="demo1.html">Home</a></li>
             <li>Products</li>
         </ul>
         <ul class="product-nav list-style-none">
             <li class="product-nav-prev">
                 <a href="#">
                     <i class="w-icon-angle-left"></i>
                 </a>
                 <span class="product-nav-popup">
                     <img src="<?php echo asset('assets') ?>/images/products/product-nav-prev.jpg" alt="Product" width="110"
                         height="110" />
                     <span class="product-name">Soft Sound Maker</span>
                 </span>
             </li>
             <li class="product-nav-next">
                 <a href="#">
                     <i class="w-icon-angle-right"></i>
                 </a>
                 <span class="product-nav-popup">
                     <img src="<?php echo asset('assets') ?>/images/products/product-nav-next.jpg" alt="Product" width="110"
                         height="110" />
                     <span class="product-name">Fabulous Sound Speaker</span>
                 </span>
             </li>
         </ul>
     </nav>
     <!-- End of Breadcrumb -->

     <!-- Start of Page Content -->
     <div class="page-content">
         <div class="container">
             <div class="row gutter-lg">
                 <div class="main-content">
                     <div class="product product-single row">
                         <div class="col-md-6 mb-4 mb-md-8">
                             <div class="product-gallery product-gallery-sticky">
                                 <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                     <div class="swiper-wrapper row cols-1 gutter-no">
                                         <?php
                                            if (isset($imageList)) {
                                                foreach ($imageList as $row) { ?>
                                                 <div class="swiper-slide">
                                                     <figure class="product-image">
                                                         <img src="<?php echo asset('assets') ?>/images/products/detail/<?php echo $row ?>"
                                                             data-zoom-image="<?php echo asset('assets') ?>/images/products/detail/<?php echo $row ?>"
                                                             alt="Electronics Black Wrist Watch" width="800" height="900">
                                                     </figure>
                                                 </div>
                                         <?php }
                                            } ?>

                                     </div>
                                     <button class="swiper-button-next"></button>
                                     <button class="swiper-button-prev"></button>
                                 </div>
                                 <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                     <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                         <?php
                                            if (isset($imageList)) {
                                                foreach ($imageList as $row) { ?>
                                                 <div class="product-thumb swiper-slide">
                                                     <img src="<?php echo asset('assets') ?>/images/products/detail/<?php echo $row ?>"
                                                         alt="Product Thumb" width="800" height="900">
                                                 </div>
                                         <?php }
                                            } ?>

                                     </div>
                                     <button class="swiper-button-next"></button>
                                     <button class="swiper-button-prev"></button>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6 mb-6 mb-md-8">
                             <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                 <h1 class="product-title"><?php echo $prouctsList['product_name'] ?></h1>
                                 <div class="product-bm-wrapper">
                                    <a href="{{ url('shop-details'). '/'.$getProduct['id'] }}">
                                     <figure class="brand">
                                         <img src="<?php echo asset('assets/images/vendor/profile/' . $prouctsList['profile_image']) ?>" alt="Brand"
                                             width="60" height="50" />
                                     </figure>
                                      </a>
                                     <div class="product-meta">
                                         <div class="product-categories">
                                             Shop Name:
                                             <span class="product-category"><a href="{{ url('shop-details'). '/'.$getProduct['id'] }}">
                                                <?php echo $vendor_details['shop_name'] ?></a></span>
                                         </div>
                                         <div class="product-categories">
                                             Location:
                                            <span class="product-category">
                                                <a href="#">
                                                    {{ $vendor_details->address }},
                                                    {{ $vendor_details->city }},
                                                    {{ $vendor_details->state }} - {{ $vendor_details->pincode }}
                                                </a>
                                            </span>
                                         </div>
                                         <div class="product-categories">
                                             Phone no:
                                             <span class="product-category"><a href="#"><?php echo $vendor_details['mobile_number1'] ?></a></span>
                                         </div>
                                     </div>
                                 </div>

                                 <hr class="product-divider">

                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            ₹{{ $prouctsList['selling_price'] }} 
                                        </div>
                                        <div  class="product-price-discount" >
                                                ₹{{ $prouctsList['retail_price'] }} 
                                        </div>
                                        <?php 
                                        $discount_percentage = (($prouctsList['retail_price'] - $prouctsList['selling_price']) / $prouctsList['retail_price']) * 100;
                                            $discount_rounded = round($discount_percentage / 10) * 10;
                                        ?>

                                        <div  class="product-offer-percentage" >
                                                {{ $discount_rounded }}% Off
                                        </div>
                                    </div>


                                 <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: {{ $percent ?? 0 }}%"></span>
                                    </div>
                                    <a>({{ $reviewCount }} Reviews)</a>
                                </div>

                                 <div class="product-short-desc">
                                     <ul class="list-type-check list-style-none">
                                         <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                                         <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                                         <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                                     </ul>
                                 </div>

                                 <hr class="product-divider">
                                 <input type="hidden" id="product-size" value="" />
                                 <input type="hidden" id="product-color" value="" />
                                 <div class="product-form product-variation-form product-color-swatch">
                                     <label>Color:</label>
                                     <div class="d-flex align-items-center product-variations">
                                         <?php if (isset($prouctsList['colors'])) {
                                                foreach ($prouctsList['colors'] as $col) { ?>
                                                 <a onclick="setColor('<?= $col ?>')" href="#" class="color" style="background-color: <?php echo $col ?>"></a>
                                         <?php }
                                            } ?>
                                     </div>
                                 </div>
                                 <div class="product-form product-variation-form product-size-swatch">
                                     <label class="mb-1">Size:</label>
                                     <div class="flex-wrap d-flex align-items-center product-variations">
                                         <?php if (isset($prouctsList['size'])) {
                                                foreach ($prouctsList['size'] as $key=>$col) { ?>
                                                 <a data-amount1="<?= isset($prouctsList['retail_amount'][$key]) ? $prouctsList['retail_amount'][$key]:'' ?>" data-amount="<?= isset($prouctsList['selling_amount'][$key]) ? $prouctsList['selling_amount'][$key]:'' ?>" onclick="setSize('<?= $col ?>',this)" href="#" class="size"><?php echo $col ?></a>
                                         <?php }
                                            } ?>
                                     </div>

                                 </div>

                                   <div class="product-sticky-content sticky-content">
                                     <div class="product-form container">
                                         <div class="product-qty-form mt-2">
                                             <div class="input-group">
                                                 <input class="quantity form-control" id="quantity" type="number" min="1"
                                                     max="100">
                                                 <button class="quantity-plus w-icon-plus"></button>
                                                 <button class="quantity-minus w-icon-minus"></button>
                                             </div>
                                         </div>
                                         <button class="btn btn-primary" onclick="addCart('<?= $prouctsList['id'] ?>')">
                                             <i class="w-icon-cart"></i>
                                             <span>Add to Cart</span>
                                         </button>
                                     </div>
                                 </div> 


                                 

                                 

                                 <div class="social-links-wrapper">
                                     <div class="social-links">
                                         <div class="social-icons social-no-color border-thin">
                                             <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                             <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                             <a href="#"
                                                 class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                             <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                             <a href="#"
                                                 class="social-icon social-youtube fab fa-linkedin-in"></a>
                                         </div>
                                     </div>
                                     <span class="divider d-xs-show"></span>
                                     <div class="product-link-wrapper d-flex">
                                         <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                     </div>
                                      
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                         <ul class="nav nav-tabs" role="tablist">
                             <li class="nav-item">
                                 <a href="#product-tab-description" class="nav-link active">Description</a>
                             </li>
                             <li class="nav-item">
                                 <a href="#product-tab-specification" class="nav-link">Specification</a>
                             </li>
                             <li class="nav-item">
                                 <a href="#product-tab-vendor" class="nav-link">Shop Info</a>
                             </li>
                             <li class="nav-item">
                                 <a href="#product-tab-reviews" class="nav-link">Customer Reviews (3)</a>
                             </li>
                         </ul>
                         <div class="tab-content">
                             <div class="tab-pane active" id="product-tab-description">
                                 <div class="row mb-4">
                                     <div class="col-md-6 mb-5">
                                         <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                         <p class="mb-4">{{ $getSpecificProduct->product->description }}</p>
                                     </div>
                                     <div class="col-md-6 mb-5">
                                         <div class="banner banner-video product-video br-xs">
                                             <figure class="banner-media">
                                                 <a href="#">
                                                     <img src="<?php echo asset('assets') ?>/images/products/video-banner-610x300.jpg"
                                                         alt="banner" width="610" height="300"
                                                         style="background-color: #bebebe;">
                                                 </a>
                                                 <a class="btn-play-video btn-iframe"
                                                     href="<?php echo asset('assets') ?>/video/memory-of-a-woman.mp4"></a>
                                             </figure>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row cols-md-3">
                                     <div class="mb-3">
                                         <h5 class="sub-title font-weight-bold"><span class="mr-3">1.</span>Free
                                             Shipping &amp; Return</h5>
                                         <p class="detail pl-5">We offer free shipping for products on orders
                                             above 50$ and offer free delivery for all orders in US.</p>
                                     </div>
                                     <div class="mb-3">
                                         <h5 class="sub-title font-weight-bold"><span>2.</span>Free and Easy
                                             Returns</h5>
                                         <p class="detail pl-5">We guarantee our products and you could get back
                                             all of your money anytime you want in 30 days.</p>
                                     </div>
                                     <div class="mb-3">
                                         <h5 class="sub-title font-weight-bold"><span>3.</span>Special Financing
                                         </h5>
                                         <p class="detail pl-5">Get 20%-50% off items over 50$ for a month or
                                             over 250$ for a year with our special credit card.</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="tab-pane" id="product-tab-specification">
                                 @foreach ($ProductSpecs as $spec)
                                 <p>{{ $spec->specify_attribute }} : {{ $spec->specify_value }} </p>
                                 @endforeach
                             </div>
                             <div class="tab-pane" id="product-tab-vendor">
                                @if ($vendor_details != '')
                            <div class="row mb-3">


                                <div class="col-md-6 mb-4">
                                    <figure class="vendor-banner br-sm">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendor_details->profile_image) }}"
                                            alt="Vendor Banner" width="610" height="200"
                                            style="background-color: #353B55;" />
                                    </figure>
                                </div>
                                <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                    <div class="vendor-user">
                                        <!--<figure class="vendor-logo mr-4">
                                                        <a href="#">
                                                            <img src="/website_assets/images/products/vendor-logo.jpg"
                                                                alt="Vendor Logo" width="80" height="80" />
                                                        </a>
                                                    </figure>-->
                                        <div>
                                            <div class="vendor-name"><a
                                                    href="{{ url('shop-details').'/'.$vendor_details->id }}" >{{ $vendor_details->owner_name }}</a>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 90%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!--<a href="#" class="rating-reviews">(32 Reviews)</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="vendor-info list-style-none">
                                        <li class="store-name">
                                            <label>Store Name:</label>
                                            <span class="detail">{{ $vendor_details->shop_name }}</span>
                                        </li>
                                        <li class="store-address">
                                            <label>Address:</label>
                                            <span class="detail">{{ $vendor_details->address }},</span>
                                            <span class="detail">{{ $vendor_details->address1 }},</span>
                                            <span class="detail">{{ $vendor_details->city }},</span>
                                            <span class="detail">{{ $vendor_details->state }}</span>
                                            <span class="detail">- {{ $vendor_details->pincode }}</span>
                                        </li>
                                        <li class="store-phone">
                                            <label>Phone:</label>
                                            <a href="#tel:">{{ $vendor_details->mobile_number1 }}</a>
                                        </li>
                                        <li class="store-phone">
                                            <label>Other Phone:</label>
                                            <a href="#tel:">{{ $vendor_details->mobile_number2 }}</a>
                                        </li>
                                    </ul>
                                    
                                          <a href="{{ url('shop-details').'/'.$vendor_details->id }}"
                                        class="btn btn-dark btn-link btn-underline btn-icon-right"><h3> Visit Store <i class="w-icon-long-arrow-right"></i> </h3></a>
                                    
                                  
                                  
                                </div>
                            </div>
                            @else
                            <div class="row mb-3">


                                <div class="col-md-6 mb-4">
                                    <figure class="vendor-banner br-sm">
                                        <img src="{{ asset('website_assets/images/brands/brand.jpg') }}"
                                            alt="Vendor Banner" width="610" height="200"
                                            style="background-color: #353B55;" />
                                    </figure>
                                </div>

                            </div>
                            @endif
                             </div>
                             <div class="tab-pane" id="product-tab-reviews">
                                 <div class="row mb-4">
                                     <div class="col-xl-4 col-lg-5 mb-4">
                                         <div class="ratings-wrapper">
                                             <div class="avg-rating-container">
                                                 <h4 class="avg-mark font-weight-bolder ls-50">3.3</h4>
                                                 <div class="avg-rating">
                                                     <p class="text-dark mb-1">Average Rating</p>
                                                     <div class="ratings-container">
                                                         <div class="ratings-full">
                                                             <span class="ratings" style="width: 60%;"></span>
                                                             <span class="tooltiptext tooltip-top"></span>
                                                         </div>
                                                         <a href="#" class="rating-reviews">(3 Reviews)</a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div
                                                 class="ratings-value d-flex align-items-center text-dark ls-25">
                                                 <span
                                                     class="text-dark font-weight-bold">66.7%</span>Recommended<span
                                                     class="count">(2 of 3)</span>
                                             </div>
                                             <div class="ratings-list">
                                                 <div class="ratings-container">
                                                     <div class="ratings-full">
                                                         <span class="ratings" style="width: 100%;"></span>
                                                         <span class="tooltiptext tooltip-top"></span>
                                                     </div>
                                                     <div class="progress-bar progress-bar-sm ">
                                                         <span></span>
                                                     </div>
                                                     <div class="progress-value">
                                                         <mark>70%</mark>
                                                     </div>
                                                 </div>
                                                 <div class="ratings-container">
                                                     <div class="ratings-full">
                                                         <span class="ratings" style="width: 80%;"></span>
                                                         <span class="tooltiptext tooltip-top"></span>
                                                     </div>
                                                     <div class="progress-bar progress-bar-sm ">
                                                         <span></span>
                                                     </div>
                                                     <div class="progress-value">
                                                         <mark>30%</mark>
                                                     </div>
                                                 </div>
                                                 <div class="ratings-container">
                                                     <div class="ratings-full">
                                                         <span class="ratings" style="width: 60%;"></span>
                                                         <span class="tooltiptext tooltip-top"></span>
                                                     </div>
                                                     <div class="progress-bar progress-bar-sm ">
                                                         <span></span>
                                                     </div>
                                                     <div class="progress-value">
                                                         <mark>40%</mark>
                                                     </div>
                                                 </div>
                                                 <div class="ratings-container">
                                                     <div class="ratings-full">
                                                         <span class="ratings" style="width: 40%;"></span>
                                                         <span class="tooltiptext tooltip-top"></span>
                                                     </div>
                                                     <div class="progress-bar progress-bar-sm ">
                                                         <span></span>
                                                     </div>
                                                     <div class="progress-value">
                                                         <mark>0%</mark>
                                                     </div>
                                                 </div>
                                                 <div class="ratings-container">
                                                     <div class="ratings-full">
                                                         <span class="ratings" style="width: 20%;"></span>
                                                         <span class="tooltiptext tooltip-top"></span>
                                                     </div>
                                                     <div class="progress-bar progress-bar-sm ">
                                                         <span></span>
                                                     </div>
                                                     <div class="progress-value">
                                                         <mark>0%</mark>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-xl-8 col-lg-7 mb-4">
                                         <div class="review-form-wrapper">
                                             <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                 Review</h3>
                                             <p class="mb-3">Your email address will not be published. Required
                                                 fields are marked *</p>
                                             <!-- <form action="#" method="POST" class="review-form">
                                                 <div class="rating-form">
                                                     <label for="rating">Your Rating Of This Product :</label>
                                                     <span class="rating-stars">
                                                         <a class="star-1" href="#">1</a>
                                                         <a class="star-2" href="#">2</a>
                                                         <a class="star-3" href="#">3</a>
                                                         <a class="star-4" href="#">4</a>
                                                         <a class="star-5" href="#">5</a>
                                                     </span>
                                                     <select name="rating" id="rating" required=""
                                                         style="display: none;">
                                                         <option value="">Rate…</option>
                                                         <option value="5">Perfect</option>
                                                         <option value="4">Good</option>
                                                         <option value="3">Average</option>
                                                         <option value="2">Not that bad</option>
                                                         <option value="1">Very poor</option>
                                                     </select>
                                                 </div>
                                                 <textarea cols="30" rows="6"
                                                     placeholder="Write Your Review Here..." class="form-control"
                                                     id="review"></textarea>
                                                 <div class="row gutter-md">
                                                     <div class="col-md-6">
                                                         <input type="text" class="form-control"
                                                             placeholder="Your Name" id="author">
                                                     </div>
                                                     <div class="col-md-6">
                                                         <input type="text" class="form-control"
                                                             placeholder="Your Email" id="email_1">
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <input type="checkbox" class="custom-checkbox"
                                                         id="save-checkbox">
                                                     <label for="save-checkbox">Save my name, email, and website
                                                         in this browser for the next time I comment.</label>
                                                 </div>
                                                 <button type="submit" class="btn btn-dark">Submit
                                                     Review</button>
                                             </form> -->
                                             @if(session()->has('customer_id') && $canRate)
                                                <form action="{{ route('rating.store') }}" method="POST" class="review-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $prouctsList['id'] }}">

                                                    <div class="rating-form">
                                                        <label>Your Rating Of This Product :</label>
                                                        <span class="rating-stars" id="user-rating">
                                                            <a href="#" class="star-1" data-val="1"></a>
                                                            <a href="#" class="star-2" data-val="2"></a>
                                                            <a href="#" class="star-3" data-val="3"></a>
                                                            <a href="#" class="star-4" data-val="4"></a>
                                                            <a href="#" class="star-5" data-val="5"></a>
                                                        </span>

                                                        <input type="hidden" name="star_rating" id="rating">
                                                    </div>

                                                    <input type="file"
                                                        name="review_images[]"
                                                        class="form-control mt-2"
                                                        multiple
                                                        accept="image/*">

                                                    <textarea name="comment" cols="30" rows="6"
                                                        placeholder="Write Your Review Here..."
                                                        class="form-control"
                                                        required>{{ $myRating->comments ?? '' }}</textarea>

                                                    <button type="submit" class="btn btn-dark">Submit Review</button>
                                                </form>

                                                @elseif(!session()->has('customer_id'))
                                                <p>Please login to give rating</p>
                                                @else
                                                <p>You can rate only after purchasing this product</p>
                                                @endif
                                         </div>
                                     </div>
                                 </div>

                                 <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                     <ul class="nav nav-tabs" role="tablist">
                                         <li class="nav-item">
                                             <a href="#show-all" class="nav-link active">Show All</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#helpful-positive" class="nav-link">Most Helpful
                                                 Positive</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#helpful-negative" class="nav-link">Most Helpful
                                                 Negative</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                         </li>
                                     </ul>
                                     <div class="tab-content">
                                         <div class="tab-pane active" id="show-all">
                                             <ul class="comments list-style-none">
                                                  @forelse($ratings as $rating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $rating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ date('M d, Y h:i A', strtotime($rating->created_at)) }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($rating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $rating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $rating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $rating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $rating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $rating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $rating->images ? explode(',', $rating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                                 
                                                 
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="helpful-positive">
                                             <ul class="comments list-style-none">
                                                 <li class="comment">
                                                     <div class="comment-body">
                                                         <figure class="comment-avatar">
                                                             <img src="<?php echo asset('assets') ?>/images/agents/1-100x100.png"
                                                                 alt="Commenter Avatar" width="90" height="90">
                                                         </figure>
                                                         <div class="comment-content">
                                                             <h4 class="comment-author">
                                                                 <a href="#">John Doe</a>
                                                                 <span class="comment-date">March 22, 2021 at
                                                                     1:54 pm</span>
                                                             </h4>
                                                             <div class="ratings-container comment-rating">
                                                                 <div class="ratings-full">
                                                                     <span class="ratings"
                                                                         style="width: 60%;"></span>
                                                                     <span
                                                                         class="tooltiptext tooltip-top"></span>
                                                                 </div>
                                                             </div>
                                                             <p>pellentesque habitant morbi tristique senectus
                                                                 et. In dictum non consectetur a erat.
                                                                 Nunc ultrices eros in cursus turpis massa
                                                                 tincidunt ante in nibh mauris cursus mattis.
                                                                 Cras ornare arcu dui vivamus arcu felis bibendum
                                                                 ut tristique.</p>
                                                             <div class="comment-action">
                                                                 <a href="#"
                                                                     class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                 </a>
                                                                 <a href="#"
                                                                     class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-down"></i>Unhelpful
                                                                     (0)
                                                                 </a>
                                                                 <div class="review-image">
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-1.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-1.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </li>
                                                 <li class="comment">
                                                     <div class="comment-body">
                                                         <figure class="comment-avatar">
                                                             <img src="<?php echo asset('assets') ?>/images/agents/2-100x100.png"
                                                                 alt="Commenter Avatar" width="90" height="90">
                                                         </figure>
                                                         <div class="comment-content">
                                                             <h4 class="comment-author">
                                                                 <a href="#">John Doe</a>
                                                                 <span class="comment-date">March 22, 2021 at
                                                                     1:52 pm</span>
                                                             </h4>
                                                             <div class="ratings-container comment-rating">
                                                                 <div class="ratings-full">
                                                                     <span class="ratings"
                                                                         style="width: 80%;"></span>
                                                                     <span
                                                                         class="tooltiptext tooltip-top"></span>
                                                                 </div>
                                                             </div>
                                                             <p>Nullam a magna porttitor, dictum risus nec,
                                                                 faucibus sapien.
                                                                 Ultrices eros in cursus turpis massa tincidunt
                                                                 ante in nibh mauris cursus mattis.
                                                                 Cras ornare arcu dui vivamus arcu felis bibendum
                                                                 ut tristique.</p>
                                                             <div class="comment-action">
                                                                 <a href="#"
                                                                     class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                 </a>
                                                                 <a href="#"
                                                                     class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-down"></i>Unhelpful
                                                                     (0)
                                                                 </a>
                                                                 <div class="review-image">
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-2.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-2-800x900.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-3.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-3-800x900.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </li>
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="helpful-negative">
                                             <ul class="comments list-style-none">
                                                 <li class="comment">
                                                     <div class="comment-body">
                                                         <figure class="comment-avatar">
                                                             <img src="<?php echo asset('assets') ?>/images/agents/3-100x100.png"
                                                                 alt="Commenter Avatar" width="90" height="90">
                                                         </figure>
                                                         <div class="comment-content">
                                                             <h4 class="comment-author">
                                                                 <a href="#">John Doe</a>
                                                                 <span class="comment-date">March 22, 2021 at
                                                                     1:21 pm</span>
                                                             </h4>
                                                             <div class="ratings-container comment-rating">
                                                                 <div class="ratings-full">
                                                                     <span class="ratings"
                                                                         style="width: 60%;"></span>
                                                                     <span
                                                                         class="tooltiptext tooltip-top"></span>
                                                                 </div>
                                                             </div>
                                                             <p>In fermentum et sollicitudin ac orci phasellus. A
                                                                 condimentum vitae
                                                                 sapien pellentesque habitant morbi tristique
                                                                 senectus et. In dictum
                                                                 non consectetur a erat. Nunc scelerisque viverra
                                                                 mauris in aliquam sem fringilla.</p>
                                                             <div class="comment-action">
                                                                 <a href="#"
                                                                     class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-up"></i>Helpful (0)
                                                                 </a>
                                                                 <a href="#"
                                                                     class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-down"></i>Unhelpful
                                                                     (1)
                                                                 </a>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </li>
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="highest-rating">
                                             <ul class="comments list-style-none">
                                                 <li class="comment">
                                                     <div class="comment-body">
                                                         <figure class="comment-avatar">
                                                             <img src="<?php echo asset('assets') ?>/images/agents/2-100x100.png"
                                                                 alt="Commenter Avatar" width="90" height="90">
                                                         </figure>
                                                         <div class="comment-content">
                                                             <h4 class="comment-author">
                                                                 <a href="#">John Doe</a>
                                                                 <span class="comment-date">March 22, 2021 at
                                                                     1:52 pm</span>
                                                             </h4>
                                                             <div class="ratings-container comment-rating">
                                                                 <div class="ratings-full">
                                                                     <span class="ratings"
                                                                         style="width: 80%;"></span>
                                                                     <span
                                                                         class="tooltiptext tooltip-top"></span>
                                                                 </div>
                                                             </div>
                                                             <p>Nullam a magna porttitor, dictum risus nec,
                                                                 faucibus sapien.
                                                                 Ultrices eros in cursus turpis massa tincidunt
                                                                 ante in nibh mauris cursus mattis.
                                                                 Cras ornare arcu dui vivamus arcu felis bibendum
                                                                 ut tristique.</p>
                                                             <div class="comment-action">
                                                                 <a href="#"
                                                                     class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                 </a>
                                                                 <a href="#"
                                                                     class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-down"></i>Unhelpful
                                                                     (0)
                                                                 </a>
                                                                 <div class="review-image">
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-2.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-2-800x900.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-3.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-3-800x900.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </li>
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="lowest-rating">
                                             <ul class="comments list-style-none">
                                                 <li class="comment">
                                                     <div class="comment-body">
                                                         <figure class="comment-avatar">
                                                             <img src="<?php echo asset('assets') ?>/images/agents/1-100x100.png"
                                                                 alt="Commenter Avatar" width="90" height="90">
                                                         </figure>
                                                         <div class="comment-content">
                                                             <h4 class="comment-author">
                                                                 <a href="#">John Doe</a>
                                                                 <span class="comment-date">March 22, 2021 at
                                                                     1:54 pm</span>
                                                             </h4>
                                                             <div class="ratings-container comment-rating">
                                                                 <div class="ratings-full">
                                                                     <span class="ratings"
                                                                         style="width: 60%;"></span>
                                                                     <span
                                                                         class="tooltiptext tooltip-top"></span>
                                                                 </div>
                                                             </div>
                                                             <p>pellentesque habitant morbi tristique senectus
                                                                 et. In dictum non consectetur a erat.
                                                                 Nunc ultrices eros in cursus turpis massa
                                                                 tincidunt ante in nibh mauris cursus mattis.
                                                                 Cras ornare arcu dui vivamus arcu felis bibendum
                                                                 ut tristique.</p>
                                                             <div class="comment-action">
                                                                 <a href="#"
                                                                     class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                 </a>
                                                                 <a href="#"
                                                                     class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                     <i class="far fa-thumbs-down"></i>Unhelpful
                                                                     (0)
                                                                 </a>
                                                                 <div class="review-image">
                                                                     <a href="#">
                                                                         <figure>
                                                                             <img src="<?php echo asset('assets') ?>/images/products/default/review-img-3.jpg"
                                                                                 width="60" height="60"
                                                                                 alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                 data-zoom-image="<?php echo asset('assets') ?>/images/products/default/review-img-3-800x900.jpg" />
                                                                         </figure>
                                                                     </a>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </li>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <section class="vendor-product-section">
                         <div class="title-link-wrapper mb-4">
                             <h4 class="title text-left">More Products From This Vendor</h4>
                             <a href="{{ url('shop-details'). '/'.$getProduct['id'] }}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                 Products<i class="w-icon-long-arrow-right"></i></a>
                         </div>
                         <div class="swiper-container swiper-theme" data-swiper-options="{
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
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
                                <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                  @foreach ($vendorProducts as $product)
                                    <div class=" col-md-4 swiper-slide product">
                                        <figure class="product-media">
                                            <a href="{{ url('/productVar/'.$product->id) }}">
                                                <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product"
                                                    width="300" height="338" />
                                               
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                    title="Add to cart"></a>
                                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Add to wishlist"></a>
                                              
                                            </div>
                                            <div class="product-action">
                                                <a style="cursor:pointer" onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}"  class="btn-product btn-quickview" title="Quick View">Quick
                                                    View</a>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat"><a href="shop-banner-sidebar.html">{{  $prouctsList['shop_name'] }}</a>
                                            </div>
                                            <h4 class="product-name"><a href="{{ url('productVar').'/'.$product->id }}">{{ $product->product_name }}</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="product-default.html" class="rating-reviews">(3 reviews)</a>
                                            </div>
                                              <div class="product-pa-wrapper">
                                                    <div class="product-price">₹{{ $product->selling_price }}</div>
                                                    <div class="product-price-discount">₹{{ $product->retail_price }}</div>
                                                    @php
                                                        $discount = number_format((($product->retail_price - $product->selling_price) / $product->retail_price) * 100);
                                                    @endphp
                                                    <div class="product-offer-percentage">{{ $discount }}% Off</div>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach

                                
                                </div>
                         </div>
                     </section>
                     <section class="related-product-section">
                         <div class="title-link-wrapper mb-4">
                             <h4 class="title">Related Products</h4>
                             <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                 Products<i class="w-icon-long-arrow-right"></i></a>
                         </div>
                            <div class="swiper-container swiper-theme" data-swiper-options="{
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
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
                                <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                    @foreach ($relatedProducts as $product)
                                        <div class="col-md-4 swiper-slide product">
                                            <figure class="product-media">
                                                <a href="{{ url('productVar').'/'.$product->id }}">
                                                    <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product"/>
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                  
                                                </div>
                                                <div class="product-action">
                                                    <a   onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}" class="btn-product btn-quickview" title="Quick View">Quick
                                                        View</a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a href="{{ url('productVar').'/'.$product->id }}">{{ $product->product_name }}</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="product-default.html" class="rating-reviews">(3 reviews)</a>
                                                </div>
                                                <div class="product-pa-wrapper">
                                                        <div class="product-price">₹{{ $product->selling_price }}</div>
                                                            <div class="product-price-discount">₹{{ $product->retail_price }}</div>
                                                            @php
                                                                $discount = number_format((($product->retail_price - $product->selling_price) / $product->retail_price) * 100);
                                                            @endphp
                                                            <div class="product-offer-percentage">{{ $discount }}% Off</div>
                                                        </div>
                                            </div>
                                        </div>
                                    
                                    @endforeach
                                </div>
                            </div>
                     </section>
                 </div>
                 <!-- End of Main Content -->
                 <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                     <div class="sidebar-overlay"></div>
                     <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                     <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                     <div class="sidebar-content scrollable">
                         <div class="sticky-sidebar">
                             <div class="widget widget-icon-box mb-6">
                                 <div class="icon-box icon-box-side">
                                     <span class="icon-box-icon text-dark">
                                         <i class="w-icon-truck"></i>
                                     </span> 
                                     <div class="icon-box-content">
                                         <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                         <p>For all orders over $99</p>
                                     </div>
                                 </div>
                                 <div class="icon-box icon-box-side">
                                     <span class="icon-box-icon text-dark">
                                         <i class="w-icon-bag"></i>
                                     </span>
                                     <div class="icon-box-content">
                                         <h4 class="icon-box-title">Secure Payment</h4>
                                         <p>We ensure secure payment</p>
                                     </div>
                                 </div>
                                 <div class="icon-box icon-box-side">
                                     <span class="icon-box-icon text-dark">
                                         <i class="w-icon-money"></i>
                                     </span>
                                     <div class="icon-box-content">
                                         <h4 class="icon-box-title">Money Back Guarantee</h4>
                                         <p>Any back within 30 days</p>
                                     </div>
                                 </div>
                             </div>
                             <!-- End of Widget Icon Box -->

                             <div class="widget widget-banner mb-9">
                                 <div class="banner banner-fixed br-sm">
                                     <figure>
                                         <img src="<?php echo asset('assets') ?>/images/shop/banner3.jpg" alt="Banner" width="266"
                                             height="220" style="background-color: #1D2D44;" />
                                     </figure>
                                     <div class="banner-content">
                                         <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                             40<sup class="font-weight-bold">%</sup><sub
                                                 class="font-weight-bold text-uppercase ls-25">Off</sub>
                                         </div>
                                         <h4
                                             class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                             Ultimate Sale</h4>
                                     </div>
                                 </div>
                             </div>
                             <!-- End of Widget Banner -->

                             <div class="widget widget-products">
                                 <div class="title-link-wrapper mb-2">
                                     <h4 class="title title-link font-weight-bold">More Products</h4>
                                 </div>

                                 <div class="swiper nav-top">
                                     <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                                'slidesPerView': 1,
                                                'spaceBetween': 20,
                                                'navigation': {
                                                    'prevEl': '.swiper-button-prev',
                                                    'nextEl': '.swiper-button-next'
                                                }
                                            }">
                                         <div class="swiper-wrapper">
                                             <div class="widget-col swiper-slide">
                                                @foreach ($vendorProducts as $product)
                                                 <div class="product product-widget">
                                                     <figure class="product-media">
                                                         <a href="{{ url('/productVar/'.$product->id) }}">
                                                             <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product"
                                                                 width="100" height="113" />
                                                         </a>
                                                     </figure>
                                                     <div class="product-details">
                                                         <h4 class="product-name">
                                                             <a href="#">{{ $product->product_name }}</a>
                                                         </h4>
                                                         <div class="ratings-container">
                                                             <div class="ratings-full">
                                                                 <span class="ratings" style="width: 100%;"></span>
                                                                 <span class="tooltiptext tooltip-top"></span>
                                                             </div>
                                                         </div>
                                                         <!-- <div class="product-price">$80.00 - $90.00</div> -->
                                                          <div class="product-pa-wrapper">
                                                                <div class="product-price">₹{{ $product->selling_price }}</div>
                                                                <div class="product-price-discount">₹{{ $product->retail_price }}</div>
                                                                @php
                                                                    $discount = number_format((($product->retail_price - $product->selling_price) / $product->retail_price) * 100);
                                                                @endphp
                                                                <div class="product-offer-percentage">{{ $discount }}% Off</div>
                                                            </div>
                                                     </div>
                                                 </div>
                                                @endforeach
                                               
                                                
                                             </div>
                                             <div class="widget-col swiper-slide">
                                                 <div class="product product-widget">
                                                     <figure class="product-media">
                                                         <a href="#">
                                                             <img src="<?php echo asset('assets') ?>/images/shop/16.jpg" alt="Product"
                                                                 width="100" height="113" />
                                                         </a>
                                                     </figure>
                                                     <div class="product-details">
                                                         <h4 class="product-name">
                                                             <a href="#">Skate Pan</a>
                                                         </h4>
                                                         <div class="ratings-container">
                                                             <div class="ratings-full">
                                                                 <span class="ratings" style="width: 100%;"></span>
                                                                 <span class="tooltiptext tooltip-top"></span>
                                                             </div>
                                                         </div>
                                                         <div class="product-price">$278.00</div>
                                                     </div>
                                                 </div>
                                                 <div class="product product-widget">
                                                     <figure class="product-media">
                                                         <a href="#">
                                                             <img src="<?php echo asset('assets') ?>/images/shop/17.jpg" alt="Product"
                                                                 width="100" height="113" />
                                                         </a>
                                                     </figure>
                                                     <div class="product-details">
                                                         <h4 class="product-name">
                                                             <a href="#">Modern Cooker</a>
                                                         </h4>
                                                         <div class="ratings-container">
                                                             <div class="ratings-full">
                                                                 <span class="ratings" style="width: 80%;"></span>
                                                                 <span class="tooltiptext tooltip-top"></span>
                                                             </div>
                                                         </div>
                                                         <div class="product-price">$324.00</div>
                                                     </div>
                                                 </div>
                                                 <div class="product product-widget">
                                                     <figure class="product-media">
                                                         <a href="#">
                                                             <img src="<?php echo asset('assets') ?>/images/shop/18.jpg" alt="Product"
                                                                 width="100" height="113" />
                                                         </a>
                                                     </figure>
                                                     <div class="product-details">
                                                         <h4 class="product-name">
                                                             <a href="#">CT Machine</a>
                                                         </h4>
                                                         <div class="ratings-container">
                                                             <div class="ratings-full">
                                                                 <span class="ratings" style="width: 100%;"></span>
                                                                 <span class="tooltiptext tooltip-top"></span>
                                                             </div>
                                                         </div>
                                                         <div class="product-price">$236.00</div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <button class="swiper-button-next"></button>
                                         <button class="swiper-button-prev"></button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </aside>
                 <!-- End of Sidebar -->
             </div>
         </div>
     </div>
     <!-- End of Page Content -->
 </main>
 <!-- End of Main -->
 <script>
     function setSize(size,e) {
       var amt1 = $(e).attr('data-amount');
       var amt2 =  $(e).attr('data-amount1');
         $('#product-size').val(size);
         setTimeout(() => {
            $('.new-price').text("₹"+amt1);
            $('#strikeamt').text("₹"+amt2);
               $('#sellingAmount').text("₹"+amt1);
         }, 300);
     }

     function setColor(color) {
         $('#product-color').val(color);
     }

     function addCart(id) {


         var pincode = '<?= session()->get('pincode'); ?>';

         if (pincode === '') {
             $.notify("Please Check Pincode!", "error");
             return false;
         }

         var qty = $('#quantity').val();
         var url = '<?= route('customCart') ?>';
         var size = $('#product-size').val();
         var color = $('#product-color').val();

         if (color === '') {
             $.notify("Please Choose Color!", "error");
             return false;
         }

         if (size === '') {
             $.notify("Please Choose Size!", "error");
             return false;
         }
         $.post(url, {
             id: id,
             qty: qty,
             size: size,
             color: color,
             '_token': '<?= csrf_token() ?>'
         }, function(data) {
             $.notify(data.message, "success", "bottom");
             $('.cart-count').html(data.count);
         });
     }
 </script>
 <script>
    
$('.vote-btn').click(function () {
    let btn = $(this);

    $.ajax({
        url: "{{ route('review.vote') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            rating_id: btn.data('id'),
            type: btn.data('type')
        },
        success: function (res) {
            btn.closest('.comment-action').find('.helpful-count').text(res.helpful);
            btn.closest('.comment-action').find('.unhelpful-count').text(res.unhelpful);
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                alert('Please login to vote');
                window.location.href = "{{ route('home') }}";
            }
        }
    });
});

 </script>
 @endsection