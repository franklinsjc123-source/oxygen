 @extends('app_template')
 @section('title','Vendor Store')
 @section('content')
   <!-- Start of Main -->

<style>

    .shop-footer{
        height: 69px !important;
    }
    .shop-details-ps-image{
            height: 65px;
            /* margin-top: 12px; */
    }

</style>
   
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shops') }}">Shops</a></li>
                        <li><a href="{{ route('shop-details', $vendordetails->id) }}">{{  $vendordetails->shop_name  }}</a></li>
                  
                    </ul>
                </div>
            </nav>
      

            <!-- Start of Pgae Contetn -->
            <div class="page-content mb-8">
                <div class="container">
                    <div class="row gutter-lg">
                        <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-right"></i></a>
                            <div class="sidebar-content">
                                <div class="sticky-sidebar">
                                    {{-- <div class="widget widget-collapsible widget-categories">
                                        <h3 class="widget-title"><span>All Categories</span></h3>
                                        <ul class="widget-body filter-items search-ul">
                                            <li><a href="#">Clothing</a></li>
                                            <li><a href="#">Computers</a></li>
                                            <li><a href="#">Electronics</a></li>
                                            <li><a href="#">Fashion</a></li>
                                            <li><a href="#">Furniture</a></li>
                                            <li><a href="#">Games</a></li>
                                            <li><a href="#">Kitchen</a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Sports</a></li>
                                        </ul>
                                    </div> --}}
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible widget-contact">
                                        <h3 class="widget-title"><span>Contact Vendor</span></h3>
                                        <div class="widget-body">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Your Name" />
                                            <input type="text" class="form-control" name="email" id="email_1"
                                                placeholder="you@example.com" />
                                            <textarea name="message" maxlength="1000" cols="25" rows="6"
                                                placeholder="Type your messsage..." class="form-control"
                                                required="required"></textarea>
                                            <a href="#" class="btn btn-dark btn-rounded">Send Message</a>
                                        </div>
                                    </div>
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible widget-time">
                                        <h3 class="widget-title"><span>Store Time</span></h3>
                                        <ul class="widget-body">
                                            <li><label>Sunday</label></li>
                                            <li><label>Monday</label></li>
                                            <li><label>Tuesday</label></li>
                                            <li><label>Wednesday</label></li>
                                            <li><label>Thursday</label></li>
                                            <li><label>Friday</label></li>
                                            <li><label>Saturday</label></li>
                                        </ul>
                                    </div>
                                    <!-- End of Widget -->
                                    {{-- <div class="widget widget-collapsible widget-products">
                                        <h3 class="widget-title"><span>Best Selling</span></h3>
                                        <div class="widget-body">
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/1.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">3D Television</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 80%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$220.00</div>
                                                </div>
                                            </div>
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/2-1.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">Alarm Clock With Lamp</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 80%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">
                                                        <ins class="new-price">$30.00</ins><del
                                                            class="old-price">$60.00</del>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/3.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">Apple Laptop</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$1,000.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- End of Widget -->
                                    {{-- <div class="widget widget-collapsible widget-products">
                                        <h3 class="widget-title"><span>Top Rated</span></h3>
                                        <div class="widget-body">
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/12.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">Classic Simple Backpack</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$85.00</div>
                                                </div>
                                            </div>
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/13.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">Smart Watch</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$90.00</div>
                                                </div>
                                            </div>
                                            <div class="product product-widget">
                                                <figure class="product-media">
                                                    <a href="product-default.html">
                                                        <img src="assets/images/shop/20.jpg" alt="Product" width="100"
                                                            height="106" />
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="product-default.html">Pencil Case</a>
                                                    </h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">$54.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- End of Widget -->
                                </div>
                            </div>
                        </aside>
                        <!-- End of Sidebar -->

                        <div class="main-content">
                            <div class="container-fluid store store-banner mb-4">
                                <div class="rows g-0 align-items-stretch">

                                    <!-- Left 25% : Store Content -->
                                    <div class="col-md-3 text-white">
                                    <div class="store-content h-100 p-4">
                                        <figure class="seller-brand mb-3">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendordetails->profile_image) }}"
                                            alt="Brand" width="80" height="80" />
                                        </figure>

                                        <h4 class="store-title">{{ $vendordetails->shop_name }}</h4>

                                        <ul class="seller-info-list list-style-none mb-4">
                                        <li class="store-address">
                                            <i class="w-icon-map-marker"></i>
                                            {{ $vendordetails->address }}, <br>
                                            {{ $vendordetails->city }} - {{ $vendordetails->pincode }}, <br>
                                            {{ $vendordetails->state }}.
                                        </li>
                                        <li class="store-phone">
                                            <a href="tel:{{ $vendordetails->mobile_number1 }}" class="text-white">
                                            <i class="w-icon-phone"></i>
                                            {{ $vendordetails->mobile_number1 }}
                                            </a>
                                        </li>
                                        <li class="store-open">
                                            <i class="w-icon-cart"></i> Store Open
                                        </li>
                                        </ul>

                                        <div class="social-icons social-no-color border-thin">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-google w-icon-google"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        </div>
                                    </div>
                                    </div>

                                    <!-- Right 75% : Image -->
                                    <div class="col-md-9">
                                    
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendordetails->profile_image) }}"
                                            alt="Vendor"
                                            class="img-fluid w-100 h-100"
                                            style="object-fit:cover; background-color:#414960;" />
                                    
                                    </div>

                                </div>
                            </div>

                            <!-- End of Store Banner -->


                            <ul class="nav nav-tabs mb-3" id="productTabs">
                                <li  style="cursor:pointer;" class="nav-item">
                                    <a class="nav-link active" data-target="#allProducts"
                                    href="javascript:void(0)">All Products</a>
                                </li>


                                <li  style="cursor:pointer;" class="nav-item">
                                    <a class="nav-link" data-target="#offers"
                                    href="javascript:void(0)">Offers</a>
                                </li>
                               
                                <li  style="cursor:pointer;" class="nav-item">
                                    <a class="nav-link" data-target="#newCollection"
                                    href="javascript:void(0)">New Collection</a>
                                </li>
                                <li  style="cursor:pointer;" class="nav-item">
                                    <a class="nav-link" data-target="#featuredProducts"
                                    href="javascript:void(0)">Featured Products</a>
                                </li>
                            </ul>

                            <div id="productTabContents">
                            <div  id="allProducts" class="product-wrapper row cols-md-5 cols-sm-2 cols-2 tabContent active">
                                @foreach ($products as $product)
                                    @include('frontend/product-card', ['product' => $product, 'showStockCount' => true])
                                @endforeach
                            </div>

                            <div  id="offers" class="product-wrapper row cols-md-5 cols-sm-2 cols-2 tabContent d-none">
                                @if(count($offerList) > 0)
                                    @foreach($offerList as $products )

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

                                                    <div class="product-pa-wrapper">
                                                        <div class="product-price">
                                                            ₹{{ $products['selling_price'] }} 
                                                        </div>
                                                        <div  class="product-price-discount" >
                                                                ₹{{ $products['retail_price'] }} 
                                                        </div>
                                                        <?php
                                                        $retailPrice = (float) ($products['retail_price'] ?? 0);
                                                        $sellingPrice = (float) ($products['selling_price'] ?? 0);
                                                        if ($retailPrice > 0) {
                                                            $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                                                            $discount_rounded = round($discount_percentage / 10) * 10;
                                                        } else {
                                                            $discount_rounded = 0;
                                                        }
                                                        ?>

                                                        <div  class="product-offer-percentage" >
                                                                {{ $discount_rounded }}% Off
                                                        </div>
                                                        @php
                                                            $stockQty = isset($products['stock_qty']) ? (int) $products['stock_qty'] : null;
                                                            $lowStockLimit = isset($products['low_stock_limit']) ? (int) $products['low_stock_limit'] : null;
                                                        @endphp
                                                        @if($stockQty !== null)
                                                            <div class="small mt-1 {{ ($lowStockLimit !== null && $stockQty <= $lowStockLimit) ? 'text-danger' : 'text-muted' }}">
                                                                Stock: {{ $stockQty }}
                                                                @if($lowStockLimit !== null && $stockQty <= $lowStockLimit)
                                                                    <span class="ms-1">Low stock</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
				                @endif
                            </div>

                           

                            <div  id="newCollection" class="product-wrapper row cols-md-5 cols-sm-2 cols-2 tabContent d-none">
                                @foreach ($newCollection as $product)
                                    @include('frontend/product-card', ['product' => $product, 'showStockCount' => true])
                                @endforeach
                            </div>

                            <div  id="featuredProducts" class="product-wrapper row cols-md-5 cols-sm-2 cols-2 tabContent d-none">
                                @foreach ($featuredProducts as $product)
                                    @include('frontend/product-card', ['product' => $product, 'showStockCount' => true])
                                @endforeach
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
 @endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabNav = document.getElementById('productTabs');
        if (!tabNav) return;
        const panelIds = ['#allProducts', '#offers', '#newCollection', '#featuredProducts'];

        function activateTab(target) {
            tabNav.querySelectorAll('.nav-link').forEach(function (el) {
                el.classList.remove('active');
            });

            const activeTab = tabNav.querySelector('.nav-link[data-target="' + target + '"]');
            if (activeTab) activeTab.classList.add('active');

            panelIds.forEach(function (id) {
                const panel = document.querySelector(id);
                if (panel) panel.classList.add('d-none');
            });

            const activePanel = document.querySelector(target);
            if (activePanel) activePanel.classList.remove('d-none');
        }

        tabNav.querySelectorAll('.nav-link').forEach(function (tab) {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');
                if (!target) return;
                activateTab(target);
            });
        });
    });
</script>


