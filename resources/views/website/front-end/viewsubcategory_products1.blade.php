
@include('website.front-end.newhead')
 
{{-- @include('website.front-end.newheader') --}}
   <!-- header end -->


   @include('website.partials.js.frontendjs')
   @include('paritials.js.userwebsite.cart_js')
   @include('website.partials.css.frontendcss');
  

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
        #loading-container {
       display: none;
       position: fixed;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-color: rgba(255, 255, 255, 0.8);
       z-index: 9999;
   }
   
   .loader {
       border: 8px solid #f3f3f3;
       border-top: 8px solid #3498db;
       border-radius: 50%;
       width: 50px;
       height: 50px;
       animation: spin 2s linear infinite;
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
   }
   
   @keyframes spin {
       0% { transform: rotate(0deg); }
       100% { transform: rotate(360deg); }
   }


</style>

<body class="theme-color-29">
   <div id="loading-container">
       <div class="loader"></div>
   </div>

   <!-- loader start -->
   
   <!-- loader end -->

<!-- header start -->
   @include('paritials.website.header')
   
   
   
	   <div class="title1 section-t-space pt-5">

        <!--<h4 class="title-inner1 text-left">{{strtoupper($category->category_main_name)}} / {{strtoupper($category->category_name)}} / {{strtoupper($category->category_sub_name)}} </h4>-->
    </div>
   
{{--  @if(count($categorys) > 0)
	   <!--<div class="title1 section-t-space pt-5">-->

        <!--<h4 class="title-inner1 text-left">{{strtoupper($category->category_sub_name)}} </h4>-->
    <!--</div>-->


                
    <!-- Paragraph end -->
    <section style="padding-top:20px;">
        <div class="container container-lg">
            <div class="row margin-default ratio_square">
				@foreach($categorys as $catelist )
                <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                    <a href="{{ url( 'Subcategoryproductshow/'.$catelist->id ) }}">
                        <div class="gradient-category">
                            <div class="gradient-border">
                                <div class="img-sec">
                                    
									<img src="{{ asset('assets/images/categorySub').'/'.$catelist->category_sub_image }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <h4>{{$catelist->category_sub_name}}</h4>
                        </div>
                    </a>
                </div>
				@endforeach
                
            </div>
        </div>
    </section>
	@endif --}}
	
	
	<div class="product-page-per-view">
    <p style="font-size: 15px; position: absolute; top: 22px;"><b> Products Per Page</b></p>

    </div>
	
    <div class="title1 section-t-space pt-5">

        <!--<h4 class="title-inner1 text-left">{{strtoupper($category->category_name)}} PRODUCTS</h4>-->
        <h4 class="title-inner1 text-left">{{strtoupper($category->category_main_name)}} / {{strtoupper($category->category_name)}} / {{strtoupper($category->category_sub_name)}} </h4>
        <p style="font-size: 15px; position: absolute; top: 460px; left:500px"><b>{{count($product)}} Products Per Page</b></p>
    </div>

    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="top-banner-wrapper">
                                        <a href="#"><img src="../assets/images/mega-menu/2.jpg"
                                                class="img-fluid blur-up lazyload" alt=""></a>
                                        
                                    </div>
                                    {{-- @dd($product); --}}

                                
                                    <div class="collection-product-wrapper">
                                           
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="popup-filter">
                                                        <div class="sidebar-popup"><a class="popup-btn">filter
                                                                products</a></div>
                                                     <form  method="POST" action ="{{ route('subfilterproducts') }}">
                                                            @csrf
                                                        <div class="open-popup">
                                                            <div class="collection-filter">
                                                                <!-- side-bar colleps block stat -->
                                                                <div class="collection-filter-block">
                                                                    <!-- brand filter start -->
                                                                    <div class="collection-mobile-back"><span
                                                                            class="filter-back"><i
                                                                                class="fa fa-angle-left"
                                                                                aria-hidden="true"></i> back</span>
                                                                    </div>
                                                                    
                                                                    <input type="hidden" id="cate1" name="cate1" value="{{$subcategory_id}}">

                                                                    {{-- <div class="collection-collapse-block open">
                                                                        <h3 class="collapse-block-title">Category</h3>
                                                                        <div class="collection-collapse-block-content">
                                                                            <div class="collection-brand-filter">
                                                                                
                                                                                @foreach($categorys as $catelist )
                                                                                
                                                                                    
                                                                                        <div
                                                                                            class="form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="form-check-input" name ="cate[]" id="" value="{{$catelist->id}}">
                                                                                            <label class="form-check-label"
                                                                                                for="zara">{{$catelist->category_sub_name}}</label>
                                                                                                
                                                                                        </div>
         
                                                                                     @endforeach
                                                                                     <input type="hidden" id="" name="cate1" value="{{$subcategory_id}}">
                                                                                     
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                    <!-- color filter start here -->
                                                                    <div class="collection-collapse-block open">
                                                                        <h3 class="collapse-block-title">colors</h3>
                                                                        <div class="collection-collapse-block-content">
                                                                            <div class="color-selector">
                                                                                
                                                                                <ul>
                                                                                    <?php
                                                                                        $uniqueColors = [];
                                                                                           

                                                                                                foreach ($color_list as $color1) {
                                                                                                    // Check if the color is unique before displaying it
                                                                                                    if (!in_array($color1->color, $uniqueColors)) {
                                                                                                        $uniqueColors[] = $color1->color;
                                                                                                        ?>
                                                                                                        {{-- <li style="background-color:{{ $color1->color }};"></li> --}}

                                                                                                        <input style="background-color:{{ $color1->color }}; width:30px;height:30px;" type="checkbox"
                                                                                                            class="form-check-input" name="color[]"
                                                                                                            id="" value="{{ $color1->color }}">                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                            
                                                                                         ?>
                                                                                
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- price filter start here -->
                                                                    <div
                                                                        class="collection-collapse-block border-0 open">
                                                                        <h3 class="collapse-block-title">price</h3>
                                                                        <div class="collection-collapse-block-content">
                                                                            <div class="collection-brand-filter">
                                                                                <div class="row" style="width:300px;">
                                                                                    <div class="col-6">
                                                                                      <h6>Min
                                                                                     <input type="number" name="pricemin" class="form-control"></h6>
                                                                                    </div>
                                                                                     <div class="col-6">
                                                                                      <h6>Min
                                                                                     <input type="number" name="pricemax"  value-="" class="form-control"> </h6>
                                                                                    </div>
                                                                                  </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    

                                                                    <div  class="collection-collapse-block border-0 open">
                                                                        <h3 class="collapse-block-title">size</h3>
                                                                        <div class="collection-collapse-block-content">
                                                                            <div class="collection-brand-filter">
                                                                                
                                                                                <?php
                                                                                        $uniquesize = [];
                                                                                                                                                          

                                                                                                foreach ($size_list as $size1) {
                                                                                                    // Check if the color is unique before displaying it
                                                                                                    if (!in_array($size1->size, $uniquesize)) {
                                                                                                        $uniquesize[] = $size1->size;
                                                                                                        ?>

                                                                                                        <div
                                                                                                        class="form-check collection-filter-checkbox">
                                                                                                            <input type="checkbox"
                                                                                                            class="form-check-input" name="size[]"
                                                                                                            id="" value="{{ $size1->size }}">
                                                                                                            <label class="form-check-label"
                                                                                                            for="hundred">{{ $size1->size }}</label>
                                                                                                        </div>
                                                                                                      
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                           
                                                                                         ?>


                                                                               
                                                                                
                                                                                <div class="col-12">
                                                                                    <div class="text-end button_bottom">
                                                                                        <button   type="submit" class="btn btn-solid btn-xs me-2">apply</button>
                                                                                        <a href="javascript:void(0)"
                                                                                            class="btn btn-solid btn-xs close-filter-bottom popup-btn">close
                                                                                            filter</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- silde-bar colleps block end here -->
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="collection-grid-view">
                                                            <ul>
                                                                <li><img src="../assets/images/icon/2.png" alt=""
                                                                        class="product-2-layout-view"></li>
                                                                <li><img src="../assets/images/icon/3.png" alt=""
                                                                        class="product-3-layout-view"></li>
                                                                <li><img src="../assets/images/icon/4.png" alt=""
                                                                        class="product-4-layout-view"></li>
                                                                <li><img src="../assets/images/icon/6.png" alt=""
                                                                        class="product-6-layout-view"></li>
                                                            </ul>
                                                        </div>
                                                        
                                                        <div class="product-page-filter">
                                                             <select name="sort"  id="sort">
                                                                
                                                                    <option value ="High_to_Low ">Price: High to Low</option>
                                                                    <option value ="Low_to_High">Price: Low to High</option>
                                                                    <option value ="offers">Better Discount</option>
                                                                    <option value ="currentdate">What's New</option>
                                                            </select>
                                                        </div>
                                                        <div class="product-page-per-view">
                                                            <p style="font-size: 15px; position: absolute; top: 22px;"><b>{{count($product)}} Products Per Page</b></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="container-fuild">
                                            <div class="row game-product grid-products px-5" id="product-list">
                                                {{-- @dd($product); --}}
                                                @if(count($product) > 0)
                                                @foreach($product as $products )
                                                    
                                                
                                                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                                                            <div class="img-wrapper">
                                                               <div class="front">
                                                                        
                                                                            <a href="{{ route('addtocart', $products->id ) }}"><img
                                                                            src="{{ asset('assets/images/products/') . '/' . $products->product_image }}"
                                                                            class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                
                                                                </div>
                                                                <div class="back">
                                                                        
                                                                    <a href="{{ route('addtocart', $products->id ) }}"><img
                                                                    src="{{ asset('assets/images/products/') . '/' . $products->product_image }}"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        
                                                                </div>
                                                                <div class="cart-info cart-wrap">
                                                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                                            class="ti-heart" aria-hidden="true"></i></a>
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                                                            aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i></div>
                                                                    
                                                               
                                                                
                                                                
                                                                  <?php
                                
                                                                    $vendarname = App\Models\User::where('login_id',$products->created_by)->first();   
                                                                    // dd($vendarname);
                                                                    $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products->id)->first();   
                                                            
                                                                        if($products->product_id == $productdetails->products_id)
                                                                        {
                                                                            ?>
                                                                            
                                                                                <h4 style="background-color:lightgray;">{{ $vendarname->name }}</h4>
                                                                                <h6>{{ $products->product_name }}</h6>
                                                                                @php
                                                                                $disc = $productdetails->retail_price -$productdetails->selling_price;
                                                                                $offerperc = $disc/$productdetails->retail_price *100;
                                                                                @endphp
                                                                                <h4>Rs.{{ $productdetails->selling_price }} <del>Rs {{ $productdetails->retail_price }}</del><span style="color:red;">Offer: {{round($offerperc)}}%</span></h4>
                                                                                
                                                                                <!--<h6>Size.{{ $productdetails->size }}</h6>-->
                                                                                <ul class="color-variant">
                                                                                 <li style="background-color:{{ $productdetails->color }};"></li>
                                                                                </ul>
                                                                       <?php
                                                                        }
                                                                      ?>
                                                                
                                                            </div>
                                                            <div class="product-detail">
                                
                                                                <a href="{{ route('addtocart', $products->id ) }}">
                                                
                                                                </a>
                                
                                                            </div>
                                                        </div>
                                                
                                                @endforeach
                                                    @else
                                                        <div class="product-box col-12">
                                                        <center><img   src="{{ asset('assets/images/products/no-product-found.png')}}" class="img-fluid  lazyload bg-img" alt=""></center>
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                       

                                        
                                        <div class="product-pagination">
                                            <div class="theme-paggination-block">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination">
                                                                <li class="page-item"><a class="page-link" href="#"
                                                                        aria-label="Previous"><span
                                                                            aria-hidden="true"><i
                                                                                class="fa fa-chevron-left"
                                                                                aria-hidden="true"></i></span> <span
                                                                            class="sr-only">Previous</span></a></li>
                                                                <li class="page-item active"><a class="page-link"
                                                                        href="#">1</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">2</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">3</a></li>
                                                                <li class="page-item"><a class="page-link" href="#"
                                                                        aria-label="Next"><span aria-hidden="true"><i
                                                                                class="fa fa-chevron-right"
                                                                                aria-hidden="true"></i></span> <span
                                                                            class="sr-only">Next</span></a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <div class="product-search-count-bottom">
                                                            <h5>Showing Products 1-24 of 10 Result</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
    <script>
        $('#sort').on('change', function() {
            // alert( this.value );

        var sortcategory = this.value 
        var cate1 = $('#cate1').val();
    
        $.ajax
        ({
        type: "POST",
        url: "{{route("subfilterproducts")}}",
        // data: dataString,
        data: {
                        "_token": "{{ csrf_token() }}",
                        "sortcategory": sortcategory,"cate1":cate1
                    },
        cache: false,
        success: function(product)
        {
            $('#product-list').empty();

            var productListContainer = $("#product-list");
            //  console.log(product);
            product.forEach(function (product) {
                productListContainer.append(generateProductHTML(product));
               
            });
              
        
        } 
        });
    
    
        });
        function asset(relativePath) {
            // Define the base URL of your assets
            const baseUrl = 'https://oxygen.ktonline.in/public/assets/'; // Replace with your actual asset URL

            // Combine the base URL with the relative path to get the absolute URL
            return `${baseUrl}/${relativePath}`;
        }

        function generateProductHTML(product) {
            
            console.log(product);
            return `
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="addtocart/${product.id}">
                                <img src="${asset(`images/products/${product.product_image}`)}" class="img-fluid blur-up lazyload bg-img" alt="">
                            </a>
                        </div>
                        <div class="back">
                            <a href="addtocart/${product.id}">
                                <img src="${asset(`images/products/${product.product_image}`)}" class="img-fluid blur-up lazyload bg-img" alt="">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart" aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View" tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <div>
                            
                            
                            <h6>${ product.name }</h6>
                            <h6>${ product.product_name }</h6>
                            <h4>Rs.${ product.selling_price } <del>Rs ${ product.retail_price }</del></h4>
                            <h6 style="background-color:yellow;">Offers:${product.type }</h6>
                            <ul class="color-variant">
                                
                                <li style="background-color:${product.color};"></li>
                            </ul>
                        </div>
                        <a href="addtocart/${product.id}"></a>
                    </div>
                </div>
            `;
        }
        </script>


    @include('website.front-end.newfooter')