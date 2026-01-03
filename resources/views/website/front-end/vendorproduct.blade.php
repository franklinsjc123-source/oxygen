 
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
    
    <br>
        <div class="container-fluid">
            <div class="row">
             <div class="col-sm-8">
                <div style="position: relative; display: inline-block; margin-top: 157px;">
                    
                    @if(!empty($vendorcreate->profile_image))
                    <img src="{{ asset('assets/images/vendor/profile') . '/' . $vendorcreate->profile_image }}" class="bg-size blur-up lazyloaded" height="300" width="900" alt="">
                    @endif
                    <a href="#" class="fa fa-whatsapp" style="position: absolute; top: 90%; left: 86%; transform: translate(-50%, -50%); font-size: 30px; color: green;"></a>
                    <a href="#" class="fa fa-facebook" style="position: absolute; top: 90%; left: 90%; transform: translate(-50%, -50%); font-size: 30px; color: blue;"></a>
                    <a href="#" class="fa fa-instagram" style="position: absolute; top: 90%; left: 94%; transform: translate(-50%, -50%); font-size: 30px; color: pink;"></a>
                </div>
            </div>

                
              <div class="col-sm-2" style="margin-top: 157px;">
                @php $pep= count($products); @endphp
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
                                    <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4ZM7.5 1H3.75L1.5 4h6V1Zm1 0v3h6l-2.25-3H8.5ZM15 5H1v10h14V5Z"/>
                                  </svg>
                    Products : <span style="color:red">{{$pep}}</span></p>
                <p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> Following : 50</p>
              
                @if(!empty($vendorcreate->business_category))
              
                <p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 0C21.5 0 0 21.5 0 48V464c0 26.5 21.5 48 48 48h96V432c0-26.5 21.5-48 48-48s48 21.5 48 48v80h96c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H48zM64 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V240zm112-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V240zM80 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V112zM272 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16z"/></svg>Business  : {{$vendorcreate->business_category}}</p>
              
                @endif
             
               </div>
             
              <div class="col-sm-2" style="margin-top: 157px;">
               <p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>Followers : 187</p>
               <p><span class="fa fa-star"></span>
Rating : 5.0(1 Rating)</p>
           @if(!empty($vendorcreate->address))
            <p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240.1 4.2c9.8-5.6 21.9-5.6 31.8 0l171.8 98.1L448 104l0 .9 47.9 27.4c12.6 7.2 18.8 22 15.1 36s-16.4 23.8-30.9 23.8H32c-14.5 0-27.2-9.8-30.9-23.8s2.5-28.8 15.1-36L64 104.9V104l4.4-1.6L240.1 4.2zM64 224h64V416h40V224h64V416h48V224h64V416h40V224h64V420.3c.6 .3 1.2 .7 1.8 1.1l48 32c11.7 7.8 17 22.4 12.9 35.9S494.1 512 480 512H32c-14.1 0-26.5-9.2-30.6-22.7s1.1-28.1 12.9-35.9l48-32c.6-.4 1.2-.7 1.8-1.1V224z"/></svg>Area  : {{$vendorcreate->address}} </p>
          @endif

              </div>
            </div>
          </div>

    <!-- header end -->
            @if(session()->has('login_id'))
           
                <div class="alert alert-danger">
                 
                </div>
            @endif
<section class="" style="padding:15px;">
        <div class="container-fuild">
           <div class="col-md-12 m-auto">
            <div class="row margin-default ratio_square">
                   @foreach ($categorymain as $categorymain1)
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{ url( 'vendorMainCatergoryproductshow/'.$categorymain1->id ) }}">
                                <div class="img-sec">
                                    <img  src=" {{ asset('assets/images/categoryMain') . '/' . $categorymain1->category_main_image }} "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>{{ $categorymain1->category_main_name }}</h6>
                                 
                            </div>
                        </a>
                    </div>
                 @endforeach
   
               
            </div></div>
        </div>
    </section>

    <!-- Home slider -->
    
    <!-- Home slider end -->


    <!-- category section start -->
    
    <!-- category section end -->
    <div class="title1 section-t-space pt-5">
        
        <h4 class="title-inner1 text-left">Our Lastest Products</h4>
    </div>
    
    <!-- Paragraph end -->


    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">
              
			
                
                    <?php
                // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$product->product_id)->get();
                //  print_r($productdetails);
               // print_r($category);
                ?>
                    {{-- @foreach($productdetails as $productdetail ) --}}
                      
                                 @if(count($products) > 0)
                                 <div align="center">
                                    <button class="btn btn-default filter-button" data-filter="all">All</button>
                                        @php $a=array(); @endphp
                                        @foreach($products as $product1 )
                                        @php array_push($a,$product1->collection);@endphp
                                       
                                        @endforeach
                                         @php $collections=array_unique($a);@endphp
                                           @foreach($collections as $collection )
                                        
                                         <button class="btn btn-default filter-button" data-filter="tab-{{str_replace(" ","-",$collection)}}">{{$collection}}</button>
                                       @endforeach
                                </div>
                                <br/>
                                
                                @foreach($products as $product )
                                    
                                 
                                    <div class="gallery_product col-lg-2 col-md-2 col-sm-4 col-xs-6 filter tab-{{str_replace(" ","-",$product->collection)}} tab-content  default">
                                        <div class="product-box">
                                            <div class="img-wrapper">
                                                    <div class="front">
                            
                                                            <a href="{{ route('addtocart', $product->id ) }}">
                                                            <img src="{{ asset('assets/images/products') . '/' . $product->product_image }}" class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    
                                                    </div>
                                                   
                                            <a class="add-button" href="{{ route('addtocart', $product->product_id ) }}">View Product</a>
                                            </div>
                                            <div class="product-detail">
                            
                                                <a href="{{ route('addtocart', $product->product_id ) }}">
                                                    @if(!empty($vendorcreate->username))
                                                   <h6 style="background-color:lightgray;">{{ $vendorcreate->username }}</h6>
                                                    @endif
                                                   <h6>{{ $product->product_name }}</h6>
                                                            @php
                                                            $disc = $product->retail_price -$product->selling_price;
                                                            $offerperc = $disc/$product->retail_price *100;
                                                            @endphp
                                                                                
                                                   <h6>Rs.{{ $product->selling_price }} <del>{{ $product->retail_price }}</del> <span style="color:red;">({{round($offerperc)}}%Off)</span></h6>
                                                </a>
                            
                                                <ul class="color-variant">
                                                <li style="background-color:{{ $product->color }};"></li>
                                                </ul>
                                                                                
                                            </div>
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
    </section>

    <!-- collection banner -->
    
    <!-- collection banner end -->


    <!-- collection banner start -->
    {{-- <section class="banner-furniture ratio2_1  banner-padding">
        <div class="container-fuild">
            <div class="row partition3">
                
                @foreach ($oxygen_adv as $oxygen_adv1 )
                <div class="col-md-4">
                    <a href="#">
                        <div class="collection-banner p-right text-end">
                            <div class="img-part">
                                <img src="{{ asset('assets/images/banners/advoxygen') . '/' . $oxygen_adv1->image }}" class="img-fluid  lazyload bg-img" alt="">
                            </div>
                            <div class="contain-banner banner-3">
                                <div>
                                    <h4>{{$oxygen_adv1->title }}</h4>
                                    <h2>{{$oxygen_adv1->sub_title }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    
<section class="pb-0  banner-furniture ratio2_1">
        <div class="container-fuild">
            <div class="row partition2">
                
                @foreach($paid_adv as $paid_adv1)
                <div class="col-md-6">
                    <a href="#">
                        <div class="collection-banner p-right text-center">
                            <div class="img-part">
                                <img src="{{ asset('assets/images/banners/adv-baner') . '/' . $paid_adv1->image }}"
                                    class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="contain-banner">
                                <div>
                                    <h4>{{ $paid_adv1->title }}</h4>
                                    <h2>{{ $paid_adv1->sub_title }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                
              
            </div>
        </div>
    </section> --}}

    <!-- product slider -->
	
	 <div class="title1 title-fancy section-t-space">
        <h4>exclusive products</h4>
        <h2 class="title-inner1 title-gradient">special products</h2>
    </div>
    <section class="section-b-space pt-0 ratio_asos">
        <div class="container container-lg">
		 <div class="row game-product grid-products px-5">
			@if(count($products) > 0)
                @foreach($products as $product )
                    <?php
                // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$product->product_id)->get();
                //  print_r($productdetails);
               // print_r($category);
                ?>
                    {{-- @foreach($productdetails as $productdetail ) --}}
                    @if( $product->collection == 'Special Products' || $product->collection == 'Special offer' || $product->collection == 'Pongal offer' || $product->collection == 'SUMMER SPECIAL')
                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                            <div class="img-wrapper">
                                <div class="front">
                                    <?php   
                                        // $proimg = @json_decode($productdetail->product_detail_image);
                                    // dd($proimg);
                                    ?>
                                    {{-- @foreach ($proimg as $key => $value)
                                        @if($key == 0) --}}
                                        
                                            <a href="{{ route('addtocart', $product->product_id ) }}"><img
                                            src="{{ asset('assets/images/products') . '/' . $product->product_image }}"
                                            class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            {{-- @endif
                                    @endforeach --}}
                                </div>
                                <div class="cart-info cart-wrap">
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                            class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div>
                              <a class="add-button" href="{{ route('addtocart', $product->product_id ) }}">View Product</a>
                            </div>
                            <div class="product-detail">

                                <a href="{{ route('addtocart', $product->product_id ) }}">
								<h6>{{ $product->product_name }}</h6>
                                </a>
								{{-- <h5> <span>Rs.{{ $productdetail->selling_price }}</span></h5> --}}
                            </div>
                        </div>
                         @endif
                    {{-- @endforeach --}}
                @endforeach
				@else
				<div class="product-box col-12">
				<center><img   src="{{ asset('assets/images/products/no-product-found.png')}}" class="img-fluid  lazyload bg-img" alt=""></center>
				</div>
				@endif
                
               
              
            </div>
		</div>
    </section>
    
    <!-- product slider -->


    <!-- deal zone section start -->
   
    <!-- deal zone section end -->


   


   
	<script>
    // Set the date we're counting down to
   
</script>

    
    <script>
               document.addEventListener("DOMContentLoaded", function () {
                // Function to show the loading container
                function showLoader() {
                    document.getElementById("loading-container").style.display = "block";
                }
            
                // Function to hide the loading container
                function hideLoader() {
                    document.getElementById("loading-container").style.display = "none";
                }
            
                // Event listener to show loader when the page starts loading
                window.addEventListener("beforeunload", showLoader);
            
                // Event listener to hide loader when the page finishes loading
                window.addEventListener("load", hideLoader);
            });


    </script>
    
   
   @include('website.front-end.newfooter')