
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

   @if(count($categorys) > 0)
	   <div class="title1 section-t-space pt-5">

        <h4 class="title-inner1 text-left">{{strtoupper($category->category_main_name)}} </h4>
    </div>


                
    <!-- Paragraph end -->
<section>
        <div class="container container-lg">
            <div class="row margin-default ratio_square">
				@foreach($categorys as $catelist )
                <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                    <a href="{{ url( 'Categoryproductshow/'.$catelist->id ) }}">
                        <div class="gradient-category">
                            <div class="gradient-border">
                                <div class="img-sec">
                                    
									<img src="{{ asset('assets/images/category').'/'.$catelist->category_image }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <h4>{{$catelist->category_name}}</h4>
                        </div>
                    </a>
                </div>
				@endforeach
                
            </div>
        </div>
    </section>
	@endif
 <!-- header end -->
    <div class="title1 section-t-space pt-5">

        <h4 class="title-inner1 text-left">{{strtoupper($category->category_main_name)}} PRODUCTS</h4>
    </div>
    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">
				@if(count($product) > 0)
                @foreach($product as $products )
                    
                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                            <div class="img-wrapper">
                                <div class="front">
                                           <a href="{{ route('addtocart', $products->id ) }}"><img
                                            src="{{ asset('assets/images/products/') . '/' . $products->product_image }}"
                                            class="img-fluid blur-up lazyload" alt="" style="width:150px;height:150px;"></a>
                
                                </div>
                                <div class="cart-info cart-wrap">
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                            class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div>
                                <a class="add-button" href="{{ route('addtocart', $products->id ) }}">View Product</a>
                            </div>
                            <div class="product-detail">

                                <a href="{{ route('addtocart',$products->id ) }}">
                
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
    </section>


    @include('website.front-end.newfooter')
    