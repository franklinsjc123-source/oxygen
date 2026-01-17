   @extends('app_template')
 @section('title','Vendor Products')
 @section('content')
  <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                      
                        <li><a href="{{ url('demoEight')}}">Home</a></li>
                        <li><a href="{{ url( 'mainCategoryShop/'.$main_category->id ) }}">  {{ $main_category->category_main_name  }} </a> </li>
                        <li><a href="{{ url( 'categoryShop/'.$category->id ) }}">  {{$category->category_name  }} </a> </li>
                        <?php  if(isset($sub_category)) {  ?>
                            <li><a href="{{ url( 'categoryShop/'.$category->id.'/'.$sub_category->id ) }}">  {{$sub_category->category_sub_name  }} </a> </li>

                        <?php }  ?>

                    </ul>
                </div>
            </nav>

                         <input  type="hidden"  id="category_id" value="<?= $category->id  ?>">
                        <input  type="hidden"  id="sub_category_id" value="<?= isset($sub_category) ? $sub_category->id  : 0 ?>">
             
            
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    

                   
                    <!-- End of Shop Brands-->

                    <!-- Start of Shop Category -->
                    <div class="shop-default-category category-ellipse-section mb-6">
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
                        }">
                            <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-3 cols-2">
                              
                              	@foreach($sub_categories_menu as $sc )

                                    <div class="swiper-slide category-wrap">
                                        <div class="category category-ellipse">
                                            <figure class="category-media">
                                                <a href="{{ url( 'categoryShop/'.$sc->category_id.'/'.$sc->id ) }}">
                                                    <img src="{{  $sc->category_sub_image ? asset('assets/images/categorySub').'/'.$sc->category_sub_image  : ''}}" alt="Categroy"
                                                    style="background-color: #5C92C0;" />
                                                </a>
                                            </figure>
                                            <div class="category-content">
                                                <h4 class="category-name">
                                                    <a href="{{ url( 'categoryShop/'.$sc->category_id.'/'.$sc->id ) }}">{{$sc->category_sub_name}}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                              
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <!-- End of Shop Category -->

                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg mb-10">
                          <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                            <div class="sidebar-content scrollable">
                                <div class="sticky-sidebar">
                                    <div class="filter-actions">
                                        <a href="#" class="btn btn-dark btn-link filter-clean"></a>
                                    </div>
                                  
                                   <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><label>Price</label></h3>

                                        <div class="widget-body">
                                            <div class="range-container">

                                                <div class="double-range">
                                                    <div class="slider-track"></div>

                                                    <!-- MIN -->
                                                    <input class="price-filter" type="range" id="minPrice" min="0" max="5000" step="10" value="0">
                                                    <div class="price-bubble" id="minBubble">₹0</div>

                                                    <!-- MAX -->
                                                    <input  class="price-filter" type="range" id="maxPrice" min="0" max="5000" step="10" value="5000">
                                                    <div class="price-bubble" id="maxBubble">₹500</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Color</span><span class="toggle-btn"></span></h3>
                                        <ul class="widget-body filter-items item-check mt-1">
                                            <div class="color-picker">
                                            @foreach ($colours as $color)
                                                <div class="color-swatch" title="{{ $color }}">
                                                    <input type="checkbox" id="color_{{ $color }}" name="colors[]" value="{{ $color }}" style="display: none;">
                                                    <label for="color_{{ $color }}" style="background-color: {{ $color }};"></label>
                                                </div>
                                            @endforeach
                                        </div>
                                        </ul>
                                       
                                    </div>
                            </div>
                        </aside>
                        
                        <div class="main-content">
                            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                <div class="toolbox-left">
                                    <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                        btn-icon-left d-block d-lg-none"><i
                                            class="w-icon-category"></i><span>Filters</span></a>
                                        <div class="toolbox-item toolbox-sort select-box text-dark">
                                            <label>Sort By :</label>
                                            <select name="orderby" id="orderby" class="form-control">
                                                <option value="default" selected="selected">Default sorting</option>
                                                <option value="price-low">Low to High</option>
                                                <option value="price-high">High to Low</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="toolbox-right">
                                    {{-- <div class="toolbox-item toolbox-show select-box">
                                        <select name="count" class="form-control">
                                            <option value="9">Show 9</option>
                                            <option value="12" selected="selected">Show 12</option>
                                            <option value="24">Show 24</option>
                                            <option value="36">Show 36</option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="toolbox-item toolbox-layout">
                                        <a href="shop-banner-sidebar.html" class="icon-mode-grid btn-layout active">
                                            <i class="w-icon-grid"></i>
                                        </a>
                                        <a href="shop-list.html" class="icon-mode-list btn-layout">
                                            <i class="w-icon-list"></i>
                                        </a>
                                    </div> --}}
                                </div>
                            </nav>
                                 <div class="product-wrapper row cols-md-5 cols-sm-2 cols-2"  id="productslist">
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
                                                        <a href="<?= url('/vendorDetails/'.$products['vendor_id']) ?>">{{ $products['shop_name']  }}</a>
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
                            {{-- 
                            <div class="toolbox toolbox-pagination justify-content-between">
                                <p class="showing-info mb-2 mb-sm-0">
                                    Showing<span>1-12 of 60</span>Products
                                </p>
                                <ul class="pagination">
                                    <li class="prev disabled">
                                        <a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <i class="w-icon-long-arrow-left"></i>Prev
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="next">
                                        <a href="#" aria-label="Next">
                                            Next<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div> 
                            --}}
                        </div>
                        <!-- End of Shop Main Content -->
                    </div>
                    <!-- End of Shop Content -->
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

         <script>
            
        const minSlider = document.getElementById("minPrice");
        const maxSlider = document.getElementById("maxPrice");
        const minBubble = document.getElementById("minBubble");
        const maxBubble = document.getElementById("maxBubble");

        const sliderTrack = document.querySelector(".slider-track");
        const rangeActive = document.createElement("div");
        rangeActive.classList.add("range-active");
        sliderTrack.appendChild(rangeActive);

        function setBubble(slider, bubble) {
            const max = slider.max;
            const val = slider.value;
            const percent = (val / max) * 100;

            bubble.innerHTML = "₹" + val;
            bubble.style.left = percent + "%";
        }

        function updateRange() {
            let min = parseInt(minSlider.value);
            let max = parseInt(maxSlider.value);

            if (min > max - 100) {
                minSlider.value = max - 100;
            }
            if (max < min + 100) {
                maxSlider.value = min + 100;
            }

            setBubble(minSlider, minBubble);
            setBubble(maxSlider, maxBubble);

            const minPercent = (minSlider.value / minSlider.max) * 100;
            const maxPercent = (maxSlider.value / maxSlider.max) * 100;

            rangeActive.style.left = minPercent + "%";
            rangeActive.style.width = (maxPercent - minPercent) + "%";
        }

        minSlider.addEventListener("input", updateRange);
        maxSlider.addEventListener("input", updateRange);

        updateRange();


        $(document).ready(function() {
    
            $('input[name="colors[]"]').on('change', function() {
                getproducts();
            });

            $('#orderby').change(function() {
                getproducts();
            });

            $('.price-filter').change(function() {
                getproducts();
            });
        
        });





        function getproducts()
        {


        
            let min_price = $('#minPrice').length ? $('#minPrice').val() : null;
            let max_price = $('#maxPrice').length ? $('#maxPrice').val() : null;
        
            let orderby = $('#orderby').length ? $('#orderby').val() : null;
           
            let category_id = $('#category_id').length ? $('#category_id').val() : null;
            let sub_category_id = $('#sub_category_id').length ? $('#sub_category_id').val() : null;

            var checkedColors = [];            
            $('input[name="colors[]"]:checked').each(function() {
                checkedColors.push($(this).val());  
            });

            var siteurl = "{{ url('/') }}";
            $.ajax({
                url: "{{ route('get-filter-product') }}",
                method: 'GET',
                data: {
                    minprice: min_price,
                    maxprice: max_price,
                    orderby: orderby,
                    main_category_id: 0,
                    category_id: category_id,
                    sub_category_id: sub_category_id,
                    color: checkedColors
                },
                success: function(data) {
                    $('#productslist').empty();

                    if (data.products.length > 0) {
                        $.each(data.products, function(index, product) {

                            let discount_percentage = ((product.retail_price - product.selling_price) / product.retail_price) * 100;
                            let discount_rounded = Math.round(discount_percentage / 10) * 10;
                            let productHtml = `
                                <div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="${siteurl}/productVar/${product.id}">
                                                <img src="${siteurl}/assets/images/products/${product.product_image}" alt="${product.product_name}" width="300" height="200" />
                                            </a>
                                            <div class="product-action-horizontal">
                                                <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                                                <a href="javascript:void(0)" onclick="showQuickView('${product.id}')" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                <a href="${siteurl}/vendorDetails/${product.vendor_id}">${product.shop_name}</a>
                                            </div>
                                            <h3 class="product-name">
                                                <a href="${siteurl}/productVar/${product.id}">${product.product_name}</a>
                                            </h3>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width:100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="#" class="rating-reviews">(3 reviews)</a>
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">₹${product.selling_price}</div>
                                                <div class="product-price-discount"><del>₹${product.retail_price}</del></div>
                                                <div class="product-offer-percentage">${discount_rounded}% Off</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('#productslist').append(productHtml);
                        });
                    } else {
                        $('#productslist').append(`
                            <div align="center">
                                <img src="${siteurl}/assets/images/banners/outofstock.png" alt="Out Of Stock" width="190" height="190">
                            </div>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }
    </script>
 @endsection