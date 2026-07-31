   @extends('app_template')
 @section('title','Shop Products')
 @section('content')
  <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                      
                        <li><a href="{{ url('home')}}">Home</a></li>
                        <li><a href="{{ url('main-category/' . ($main_category->slug ?? $main_category->id)) }}">  {{ $main_category->category_main_name  }} </a> </li>
                        <li><a href="{{ url('category/' . ($category->slug ?? $category->id)) }}">  {{$category->category_name  }} </a> </li>
                        <?php  if(isset($sub_category)) {  ?>
                            <li><a href="{{ url('category/' . ($category->slug ?? $category->id) . '/' . ($sub_category->slug ?? $sub_category->id)) }}">  {{$sub_category->category_sub_name  }} </a> </li>

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

                    <!-- Active Category Highlight Styles -->
                    <style>
                        /* ── Selected / Active Sub-Category ── */
                        .category-ellipse.sc-active .category-media {
                            position: relative;
                            border-radius: 50%;
                            padding: 4px;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
                            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.45),
                                        0 0 30px rgba(118, 75, 162, 0.2);
                            transition: all 0.35s cubic-bezier(.25,.8,.25,1);
                        }
                        .category-ellipse.sc-active .category-media img {
                            border-radius: 50%;
                            border: 3px solid #fff;
                        }
                        .category-ellipse.sc-active {
                            transform: scale(1.08);
                            transition: transform 0.35s cubic-bezier(.25,.8,.25,1);
                        }
                        .category-ellipse.sc-active .category-name a {
                            color: #764ba2 !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.2px;
                        }
                        /* Small "selected" dot indicator under the name */
                     
                        
                        /* Hover effect for non-active items */
                        .category-ellipse:not(.sc-active):hover {
                            transform: translateY(-3px);
                            transition: transform 0.25s ease;
                        }
                        .category-ellipse:not(.sc-active):hover .category-media {
                            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                            transition: box-shadow 0.25s ease;
                        }

                        /* Mobile Category Image & Text Size reduction */
                        @media (max-width: 479px) {
                            .category-ellipse .category-media {
                                width: 55px !important;
                                height: 55px !important;
                                min-width: 55px !important;
                                min-height: 55px !important;
                                margin: 0 auto !important;
                            }
                            .category-ellipse .category-media img {
                                width: 100% !important;
                                height: 100% !important;
                                object-fit: cover !important;
                            }
                            .category-ellipse.sc-active .category-media {
                                padding: 2px !important;
                            }
                            .category-ellipse.sc-active .category-media img {
                                border-width: 1.5px !important;
                            }
                            .category-ellipse .category-name {
                                font-size: 10px !important;
                                line-height: 1.2 !important;
                                margin-top: 4px !important;
                            }
                        }
                    </style>

                    <!-- Start of Shop Category -->
                    <div class="shop-default-category category-ellipse-section mb-6">
                        <div class="swiper-container swiper-theme shadow-swiper"
                            data-swiper-options="{
                            'spaceBetween': 10,
                            'slidesPerView': 4,
                            'breakpoints': {
                                '480': {
                                    'slidesPerView': 4
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
                            <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-4 cols-4">
                              
                              	@foreach($sub_categories_menu as $sc )

                                    <div class="swiper-slide category-wrap">
                                        <div class="category category-ellipse {{ (isset($sub_category) && $sub_category->id == $sc->id) ? 'sc-active' : '' }}">
                                            <center> <figure class="category-media">
                                               <a href="{{ url('category/' . ($category->slug ?? $sc->category_id) . '/' . ($sc->slug ?? $sc->id)) }}">
                                                    <img src="{{  $sc->category_sub_image ? asset('assets/images/categorySub').'/'.$sc->category_sub_image  : ''}}" alt="Categroy"
                                                    style="background-color: #5C92C0;" />
                                                </a>
                                            </figure></center>
                                            <div class="category-content">
                                                <h4 class="category-name">
                                                    <a href="{{ url('category/' . ($category->slug ?? $sc->category_id) . '/' . ($sc->slug ?? $sc->id)) }}">{{$sc->category_sub_name}}</a>
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

                                    <div style="padding: 15px 0; border-bottom: 2px solid #222;">
                                        <h4 style="font-size: 16px; font-weight: 700; letter-spacing: 1px; margin: 0; color: #222;">FILTER:</h4>
                                    </div>

                                    {{-- Color Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Color</h5>
                                            <i class="fas fa-chevron-up" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 500px; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach ($colours as $colorItem)
                                                <li style="padding: 5px 0;">
                                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; color: #555;">
                                                        <input type="checkbox" name="colors[]" value="{{ $colorItem->color }}" class="filter-checkbox" style="accent-color: #222; width: 15px; height: 15px;">
                                                        @php
                                                            $colorMap = [
                                                                'light slate blue' => '#8470FF',
                                                                'multi' => 'conic-gradient(red, yellow, green, blue, purple)',
                                                                'navy blue' => 'navy',
                                                                'peach' => '#FFDAB9',
                                                                'mustard' => '#FFDB58',
                                                                'teal' => '#008080'
                                                            ];
                                                            $colorName = strtolower(trim($colorItem->color));
                                                            $bgColor = $colorMap[$colorName] ?? strtolower(str_replace(' ', '', $colorItem->color));
                                                        @endphp
                                                        <span style="display: inline-block; width: 16px; height: 16px; border-radius: 50%; background: {{ $bgColor }}; border: 1px solid #ccc; flex-shrink: 0;"></span>
                                                        {{ $colorItem->color }} ({{ $colorItem->count }})
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Size Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Size</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <div style="padding: 10px 0 0 0; display: flex; flex-wrap: wrap; gap: 8px;">
                                                @foreach($sizes as $size)
                                                <label style="display: inline-flex; align-items: center; justify-content: center; min-width: 42px; height: 36px; padding: 0 10px; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; font-size: 13px; font-weight: 500; color: #555; transition: all 0.2s;">
                                                    <input type="checkbox" name="filter_size[]" value="{{ $size }}" class="filter-checkbox" style="display: none;">
                                                    {{ $size }}
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Price</h5>
                                            <i class="fas fa-chevron-up" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 500px; overflow: hidden; transition: max-height 0.35s ease;">
                                            <div class="range-container" style="padding: 15px 5px 10px 5px;">
                                                <div class="price-display" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; color: #444; font-weight: 600;">
                                                    <span id="minText">₹0</span>
                                                    <span id="maxText">₹5000</span>
                                                </div>
                                                <div class="double-range" style="position: relative; width: 100%; height: 6px; background: #e5e5e5; border-radius: 4px;">
                                                    <div class="slider-track" style="position: absolute; height: 100%; background: #222; border-radius: 4px; z-index: 1;"></div>
                                                    <input class="price-filter" type="range" id="minPrice" min="0" max="5000" step="10" value="0" style="position: absolute; width: 100%; top: 0; height: 6px; z-index: 2; -webkit-appearance: none; appearance: none; background: transparent; pointer-events: none; outline: none; margin: 0;">
                                                    <input class="price-filter" type="range" id="maxPrice" min="0" max="5000" step="10" value="5000" style="position: absolute; width: 100%; top: 0; height: 6px; z-index: 2; -webkit-appearance: none; appearance: none; background: transparent; pointer-events: none; outline: none; margin: 0;">
                                                </div>
                                                <style>
                                                    .price-filter::-webkit-slider-thumb {
                                                        -webkit-appearance: none;
                                                        appearance: none;
                                                        width: 18px;
                                                        height: 18px;
                                                        border-radius: 50%;
                                                        background: #222;
                                                        cursor: pointer;
                                                        pointer-events: auto;
                                                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                                        transition: transform 0.1s;
                                                        margin-top: -6px;
                                                    }
                                                    .price-filter::-webkit-slider-thumb:hover {
                                                        transform: scale(1.15);
                                                    }
                                                    .price-filter::-moz-range-thumb {
                                                        width: 18px;
                                                        height: 18px;
                                                        border-radius: 50%;
                                                        background: #222;
                                                        cursor: pointer;
                                                        pointer-events: auto;
                                                        border: none;
                                                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                                        transition: transform 0.1s;
                                                    }
                                                    .price-filter::-moz-range-thumb:hover {
                                                        transform: scale(1.15);
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Discount Filter --}}
                                    <div class="filter-section" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Discount</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach([10, 20, 30, 40, 50, 60, 70] as $disc)
                                                <li style="padding: 4px 0;">
                                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; color: #555;">
                                                        <input type="radio" name="filter_discount" value="{{ $disc }}" class="filter-radio" style="accent-color: #222; width: 15px; height: 15px;">
                                                        {{ $disc }}% and above
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Offer Filter --}}
                                    <div class="filter-section" style="padding: 15px 0;">
                                        <div class="filter-header" onclick="toggleFilter(this)" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                                            <h5 style="font-size: 15px; font-weight: 600; margin: 0; color: #333;">Offer</h5>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #999; transition: transform 0.3s;"></i>
                                        </div>
                                        <div class="filter-body" style="max-height: 0; overflow: hidden; transition: max-height 0.35s ease;">
                                            <ul style="list-style: none; padding: 10px 0 0 0; margin: 0;">
                                                @foreach($offerTypes as $offer)
                                                <li style="padding: 4px 0;">
                                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; color: #555;">
                                                        <input type="checkbox" name="filter_offer[]" value="{{ $offer->id }}" class="filter-checkbox" style="accent-color: #222; width: 15px; height: 15px;">
                                                        @php
                                                            $offerName = $offer->title;
                                                            if ($offer->type == 'Buy X Get Y Free') {
                                                                $buy = $offer->buy ?: '1';
                                                                $get = $offer->getoffer ?: '1';
                                                                $offerName = "Buy {$buy} Get {$get} Free";
                                                            } elseif ($offer->type == 'Cashback') {
                                                                if (strtolower($offer->cashbacktype) == 'percentage') {
                                                                    $offerName = "Cashback {$offer->cashbackvalue}% Off";
                                                                } else {
                                                                    $offerName = "Cashback ₹{$offer->cashbackvalue} Off";
                                                                }
                                                            } elseif ($offer->type == 'Fixed Discount') {
                                                                if (strtolower($offer->discount_type) == 'percentage') {
                                                                    $offerName = "Flat {$offer->value}% Off";
                                                                } else {
                                                                    $offerName = "Flat ₹{$offer->value} Off";
                                                                }
                                                            } elseif (str_contains($offer->type, '@')) {
                                                                $amt = $offer->getamt ? "₹{$offer->getamt}/-" : "{$offer->value}%";
                                                                $offerName = "Buy {$offer->buy} @ {$amt}";
                                                            }
                                                        @endphp
                                                        {{ $offerName }}
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Clear All Filters --}}
                                    <div style="padding: 15px 0; text-align: center;">
                                        <button onclick="clearAllFilters()" style="background: #222; color: #fff; border: none; padding: 8px 25px; border-radius: 4px; font-size: 13px; font-weight: 600; cursor: pointer; letter-spacing: 0.5px; transition: background 0.2s;">Clear All Filters</button>
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
                                                 <option value="new-collections">New Collections</option>
                                                 <option value="best-sellers">Best Sellers</option>
                                                 <option value="top-rated">Top Rated</option>
                                                 <option value="price-low">Price Low to High</option>
                                                 <option value="price-high">Price High to Low</option>
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
                                     @foreach($prouctsList as $product)
                                         @include('frontend/product-card', ['product' => $product, 'showStockCount' => true])
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
        </main>

         <script>
        const wishlistedProductIds = @json($wishlistedProductIds ?? []);

        // Accordion toggle
        function toggleFilter(header) {
            var body = header.nextElementSibling;
            var icon = header.querySelector('i');
            if (body.style.maxHeight === '0px' || body.style.maxHeight === '') {
                body.style.maxHeight = '500px';
                icon.className = 'fas fa-chevron-up';
            } else {
                body.style.maxHeight = '0px';
                icon.className = 'fas fa-chevron-down';
            }
        }

        // Size button visual toggle
        document.querySelectorAll('input[name="filter_size[]"]').forEach(function(cb) {
            cb.addEventListener('change', function() {
                var lbl = this.parentElement;
                if (this.checked) {
                    lbl.style.background = '#222';
                    lbl.style.color = '#fff';
                    lbl.style.borderColor = '#222';
                } else {
                    lbl.style.background = '#fff';
                    lbl.style.color = '#555';
                    lbl.style.borderColor = '#ddd';
                }
            });
        });

        // Clear all filters
        function clearAllFilters() {
            document.querySelectorAll('.filter-checkbox, .filter-radio, input[name="colors[]"]').forEach(function(el) {
                el.checked = false;
            });
            document.querySelectorAll('input[name="filter_size[]"]').forEach(function(cb) {
                var lbl = cb.parentElement;
                lbl.style.background = '#fff';
                lbl.style.color = '#555';
                lbl.style.borderColor = '#ddd';
            });
            document.getElementById('minPrice').value = 0;
            document.getElementById('maxPrice').value = 5000;
            document.getElementById('orderby').value = 'default';
            updateRange();
            getproducts();
        }

        // Price slider
        const minSlider = document.getElementById("minPrice");
        const maxSlider = document.getElementById("maxPrice");
        const minText = document.getElementById("minText");
        const maxText = document.getElementById("maxText");
        const sliderTrack = document.querySelector(".slider-track");

        function updateRange() {
            var min = parseInt(minSlider.value);
            var max = parseInt(maxSlider.value);
            
            if (min > max - 100) minSlider.value = max - 100;
            if (max < min + 100) maxSlider.value = min + 100;
            
            minText.innerHTML = "₹" + minSlider.value;
            maxText.innerHTML = "₹" + maxSlider.value;
            
            var minPercent = (minSlider.value / minSlider.max) * 100;
            var maxPercent = (maxSlider.value / maxSlider.max) * 100;
            
            sliderTrack.style.left = minPercent + "%";
            sliderTrack.style.width = (maxPercent - minPercent) + "%";
        }

        minSlider.addEventListener("input", updateRange);
        maxSlider.addEventListener("input", updateRange);
        updateRange();

        // Event bindings
        $(document).ready(function() {
            $('input[name="colors[]"]').on('change', function() { getproducts(); });
            $('#orderby').change(function() { getproducts(); });
            $('.price-filter').change(function() { getproducts(); });
            $('input[name="filter_subcategory[]"]').on('change', function() { getproducts(); });
            $('input[name="filter_size[]"]').on('change', function() { getproducts(); });
            $('input[name="filter_collection"]').on('change', function() { getproducts(); });
            $('input[name="filter_discount"]').on('change', function() { getproducts(); });
            $('input[name="filter_offer[]"]').on('change', function() { getproducts(); });
        });

        function getproducts() {
            let min_price = $('#minPrice').val();
            let max_price = $('#maxPrice').val();
            let orderby = $('#orderby').val();
            let category_id = $('#category_id').val();

            var checkedColors = [];
            $('input[name="colors[]"]:checked').each(function() { checkedColors.push($(this).val()); });

            var checkedSizes = [];
            $('input[name="filter_size[]"]:checked').each(function() { checkedSizes.push($(this).val()); });

            var checkedOffers = [];
            $('input[name="filter_offer[]"]:checked').each(function() { checkedOffers.push($(this).val()); });

            var checkedSubCats = [];
            $('input[name="filter_subcategory[]"]:checked').each(function() { checkedSubCats.push($(this).val()); });

            var collection = $('input[name="filter_collection"]:checked').val() || '';
            var discount = $('input[name="filter_discount"]:checked').val() || '';

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
                    sub_category_id: checkedSubCats.length > 0 ? checkedSubCats : $('#sub_category_id').val(),
                    color: checkedColors,
                    size: checkedSizes,
                    collection: collection,
                    offer_id: checkedOffers,
                    discount: discount
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
                                            <a href="${siteurl}/products/${product.slug || product.id}">
                                                <img src="${siteurl}/assets/images/products/${product.product_image}" alt="${product.product_name}" />
                                            </a>
                                            ${product.offer_image ? `
                                               <div class="product-label-group" style="position: absolute; top: 10px; left: 10px; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                                   <img src="${siteurl}/assets/images/offer_logo/${product.offer_image}" alt="Offer" style="width: 45px; height: 45px; object-fit: contain; border-radius: 5px; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));">
                                                   ${product.offer_text ? `
                                                       <div style="background: #0088dd; color: #fff; font-size: 8px; font-weight: 700; padding: 1px 4px; border-radius: 2px; box-shadow: 0 1px 3px rgba(0,0,0,0.2); white-space: nowrap; line-height: 1.1;">
                                                           ${product.offer_text}
                                                       </div>
                                                   ` : ''}
                                               </div>
                                            ` : ''}
                                             <div class="product-action-vertical">
                                                 <a href="${siteurl}/products/${product.slug || product.id}" class="btn-product-icon w-icon-cart"></a>
                                                 <a href="#" onclick="addwishlist('${product.id}', this)" class="btn-product-icon btn-wishlist ${wishlistedProductIds.includes(parseInt(product.id)) ? 'w-icon-heart-full' : 'w-icon-heart'}" ${wishlistedProductIds.includes(parseInt(product.id)) ? 'style="color: #ef4444 !important;"' : ''}><span></span></a>
                                                 <a href="javascript:void(0)" onclick="showQuickView('${product.id}')" data-id="${product.id}" class="btn-product-icon btn-quickview w-icon-search"></a>
                                             </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="sold-by" style="margin-bottom: 2px;">
                                                <a href="${siteurl}/shop/${product.vendor_slug || product.vendor_id}" style="color: #0088dd; font-weight: 700; font-size: 1.3rem;">
                                                    ${product.shop_name || ''}
                                                </a>
                                            </div>
                                            <h4 class="product-name" style="margin-bottom: 5px; font-weight: 500; font-size: 1.4rem;">
                                                <a href="${siteurl}/products/${product.slug || product.id}" style="color: #333; text-decoration: none;">
                                                    ${product.product_name}
                                                </a>
                                            </h4>
                                            <div class="ratings-container" style="margin-bottom: 5px;">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 0%;"></span>
                                                </div>
                                                <a class="rating-reviews" style="font-size: 1.1rem; color: #0088dd;">(0 Reviews)</a>
                                            </div>
                                            <div class="product-pa-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 4px; white-space: nowrap; flex-wrap: nowrap;">
                                                <div class="product-price-home" style="font-family: monospace; font-size: 1.5rem; font-weight: 700; color: #000;">₹${product.selling_price}</div>
                                                <div class="product-price-discount" style="text-decoration: line-through; color: #888; font-size: 1.1rem; font-weight: 600;">₹${product.retail_price}</div>
                                                <div class="product-offer-percentage" style="color: #27ae60; font-weight: 700; font-size: 1.1rem;">${discount_rounded}% Off</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('#productslist').append(productHtml);
                        });
                    } else {
                        $('#productslist').append(`
                            <div style="text-align: center; width: 100%; padding: 50px 15px;">
                                <i class="fas fa-search" style="font-size: 40px; color: #ddd; margin-bottom: 15px;"></i>
                                <h4 style="color: #666; font-size: 1.6rem; margin-bottom: 5px; font-weight: 600;">No Products Found</h4>
                                <p style="color: #999; font-size: 1.3rem;">Try adjusting your filters to find what you're looking for.</p>
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