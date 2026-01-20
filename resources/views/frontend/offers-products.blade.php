 @extends('app_template')
 @section('title',' Offer Products')
 @section('content')

 
  <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">

                        <li><a href="{{ url('home')}}">Home</a></li>
                        <li><a href="{{ url( 'offers' ) }}"> Offers </a> </li>

                        <?php if($offer_id !=''){  ?>
                            <li><a href="{{ url( 'offer-products/'.$vendor_id ) }}"> <?= $offer_name ?> </a> </li>
                        <?php  } else {  ?>
                            <li><a href="{{ url( 'offer-products') }}"> All </a> </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">

                    <div class="shop-default-category category-ellipse-section ">
                        <div class="swiper-container swiper-theme shadow-swiper"
                                data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '480': {
                                        'slidesPerView': 3
                                    },
                                    '576': {
                                        'slidesPerView': 4
                                    },
                                    '768': {
                                        'slidesPerView': 6
                                    },
                                    '992': {
                                        'slidesPerView': 7
                                    },
                                    '1200': {
                                        'slidesPerView': 8,
                                        'spaceBetween': 30
                                    }
                                }
                            }"
                        >
                            <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-3 cols-2">
                              
                                <div class="swiper-slide category-wrap">
                                    <div class="category category-ellipse">
                                       <center>

                                         <figure class="category-media">
                                            <a href="{{ url( 'offer-products/'.$vendor_id ) }}">
                                                
                                                <img src="{{ asset('assets/images/offer_logo/all_offer.jpeg') }}" alt="All Offers"
                                                   style="background-color: #5C92C0;" />
                                            </a>
                                        </figure>
                                       </center>
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="{{ url( 'offer-products/'.$vendor_id ) }}">All Offers</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                              	@foreach($offer as $o )

                             
                                <div class="swiper-slide category-wrap">
                                    <div class="category category-ellipse">
                                       <center>

                                         <figure class="category-media">
                                            <a href="{{ url( 'offer-products/'.$vendor_id.'?id='.$o->id ) }}">
                                                
                                                <img src="{{ asset('assets/images/offer_logo/'.$o->offer_logo) }}" alt="Categroy"
                                                   style="background-color: #5C92C0;" />
                                            </a>
                                        </figure>
                                       </center>
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="{{ url( 'offer-products/'.$vendor_id.'?id='.$o->id ) }}">{{$o->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              
                            </div>


                            
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                     <div class="page-content mb-8 mt-5">
                        <div class="container">
                            <div class="toolbox vendor-toolbox pb-0">
                            
                                <div class="toolbox-left mb-4 mb-md-0">
                                    {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                                    {{-- <label class="d-block">Total Store Showing 6</label> --}}
                                    <h2><label class="d-block">Offer Products </label></h3><h4><?=  $offer_name ? '( ' . $offer_name. ' )' :''  ?></h4>
                                </div>
                               
                            </div>
                            <div class="vendor-search-wrapper">
                                <form class="vendor-search-form">
                                    <input type="email" class="form-control mr-4 bg-white" name="vendor" id="vendor"
                                        placeholder="Search Vendors" />
                                    <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                                </form>
                            </div>

                              <div class="product-wrapper row cols-md-6 cols-sm-2 cols-2"  id="productslist">
                                @if(count($prouctsList) > 0)
                                    @foreach($prouctsList as $products )

                                        <div class="product-wrap">
                                            <div class="product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= url('/productVar/'.$products['id'] ) ?>">
                                                        <img src="<?php echo asset('assets') ?>/images/products/<?= $products['product_image']  ?>" alt="Product" width="300"
                                                            height="200" />
                                                    </a>
                                                    <div class="product-action-horizontal">
                                                        <a href="" class="btn-product-icon btn-cart w-icon-cart"
                                                            title="Add to cart"></a>
                                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                            title="Wishlist"></a>
                                                    
                                                        <a href="javascript:void(0)" onclick="showQuickView('<?= $products['id']  ?>')" data-id='<?=  $products['id']  ?>' class="btn-product-icon btn-quickview w-icon-search"
                                                            title="Quick View"></a>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <div class="product-cat">
                                                        <a href="<?= url('/shop-details/'.$products['vendor_id']) ?>">{{ $products['shop_name']  }}</a>
                                                    </div>
                                                    <h3 class="product-name">
                                                        <a href="">{{ $products['product_name']  }}</a>
                                                    </h3>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="product-default.html" class="rating-reviews">(3 reviews)</a>
                                                    </div>
                                                    {{-- <div class="product-pa-wrapper">
                                                        <div class="product-price">
                                                            $220.00 - $230.00
                                                        </div>
                                                    </div> --}}

                                                    <div class="product-pa-wrapper">
                                                        <div class="product-price">
                                                            ₹{{ $products['selling_price'] }} 
                                                        </div>
                                                        <div  class="product-price-discount" >
                                                                ₹{{ $products['retail_price'] }} 
                                                        </div>
                                                        <?php 
                                                        $discount_percentage = (($products['retail_price'] - $products['selling_price']) / $products['retail_price']) * 100;
                                                            $discount_rounded = round($discount_percentage / 10) * 10;
                                                        ?>

                                                        <div  class="product-offer-percentage" >
                                                                {{ $discount_rounded }}% Off
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
				                @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </main>

 @endsection