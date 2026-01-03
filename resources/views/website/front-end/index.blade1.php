 
    @include('website.front-end.newhead')
    @include('website.partials.js.frontendjs')
    @include('paritials.js.userwebsite.cart_js')
    @include('paritials.website.header')

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

<body style="background-color:#F0F0F0" class="theme-color-29">
    <div id="loading-container">
        <div class="loader"></div>
    </div>

<section class="" style="padding:15px;">
        <div class="container-fuild">
           <div class="col-md-12 m-auto">
            <div class="row margin-default ratio_square">
                
                
                <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('allproductshow')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>ALL</h6>
                                 
                            </div>
                        </a>
                    </div>
                    
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{ route('allvendors') }}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>VENDORS</h6>
                                 
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('alloffers')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>DEALS</h6>
                                 
                            </div>
                        </a>
                    </div>
                    
                   @foreach ($categorymain as $categorymain1)
                    <div class="col-xl-1 p-0 col-sm-1 col-4">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{ url( 'MainCatergoryproductshow/'.$categorymain1->id ) }}">
                                <div class="img-sec">
                                    <img  src=" {{ asset('assets/images/categoryMain') . '/' . $categorymain1->category_main_image }} "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>{{ $categorymain1->category_main_name }}</h6>
                                 
                            </div>
                        </a>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 @endforeach
    
            </div></div>
        </div>
    </section>

    <!-- Home slider -->
    <section class="p-0">
        <div class="slider-animate home-slider">
		 @foreach ($mainslider as $mslides )
		 
            <div>
                <div class="home height-apply p-bottom">
                    <img src="{{ asset('assets/images/banners/mainslider') . '/' . $mslides->image }}" alt="" class="bg-img  lazyload">
                    <div class="container-lg">
                        <div class="row">
                            <div class="col">
                                <div class="slider-contain height-apply">
                                    <div>
                                        <h4>{{$mslides->title }}</h4>
                                        <h1>{{$mslides->sub_title }}</h1>
										<a href="{{$mslides->link }}"
                                            class="btn btn-solid btn-gradient animated">shop
                                            now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			@endforeach
            
    </section>
    <!-- Home slider end -->


    <!-- category section start -->
    
    <!-- category section end -->
    <div class="title1 section-t-space pt-5">
        
        <h4 class="title-inner1 text-left">Our Lastest Products</h4>
    </div>
    
    <!-- Paragraph end -->


    <!-- Product section -->
   <section style="background-color:#f7f1f2" class="pt-0 section-b-space ratio_asos">
      <div class="container-fuild">
        <div class="row game-product grid-products px-5">
      

        <div align="center">
            <button style="color:#add8e6;" class="btn btn-default filter-button" data-filter="all">All</button>
                @php $a=array(); @endphp
                @foreach($products as $product1 )
                @php array_push($a,$product1->collection);@endphp
               
                @endforeach
                 @php $collections=array_unique($a);@endphp
                   @foreach($collections as $collection )
                
                 <button style="color:#add8e6;" class="btn btn-default filter-button" data-filter="tab-{{str_replace(" ","-",$collection)}}">{{$collection}}</button>
               @endforeach
        </div>
        <br/>

        @foreach($products as $product )
            
         
            <div class="gallery_product product-box col-xl-2 col-lg-3 col-sm-4 col-6 filter tab-{{str_replace(" ","-",$product->collection)}} tab-content  default">
                <div class="product-box">
                    <div class="img-wrapper">
                            <div class="front">
    
                                    <a href="{{ route('addtocart', $product->id ) }}">
                                    <img src="{{ asset('assets/images/products') . '/' . $product->product_image }}" class="img-fluid blur-up lazyload bg-img"
                                        alt=""></a>
                                        
                           
                            </div>
                                                            <div class="cart-info cart-wrap">
                                                    <!--            <button data-bs-toggle="modal" data-bs-target="#addtocart"-->
                                                    <!--title="Add to cart"><i class="ti-shopping-cart"></i></button>-->
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                            class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div>
                           
                    <!--<a class="add-button" href="{{ route('addtocart', $product->product_id ) }}">View Product</a>-->
                    </div>
                    <div class="product-detail">
    
                        <a href="{{ route('addtocart', $product->product_id ) }}">
                           
                        
                         <?php
                            // dd($product);
                                $vendarname = App\Models\User::where('login_id',$product->created_by)->first();   
                                $productdetails = App\Models\Products\ProductsDetails::where('products_id',$product->id)->first();   
                                $disc = App\Models\Offer\Offer::where('id',$product->offers)->first();
                                // dd($disc);
                        
                        
                                if($product->product_id == $productdetails->products_id)
                                    {
                                        ?>
                                            <h6 style="background-color:lightgray;">{{ $vendarname->name }}</h6>
                                            <h6>{{ $product->product_name }}</h6>
                                            @php
                                            $disc = $productdetails->retail_price -$productdetails->selling_price;
                                            $offerperc = $disc/$productdetails->retail_price *100;
                                            @endphp
                                            
                                            <h6>Rs.{{ $productdetails->selling_price }} <del>Rs {{ $productdetails->retail_price }}</del><span style="color:red;">Offer: {{round($offerperc)}}%</span></h6>
                                            
                                            <ul class="color-variant">
                                             <li style="background-color:{{ $productdetails->color }};"></li>
                                            </ul>
                                   <?php
                                    }
                                  ?>
                         </a>
    
                    </div>
                </div>
               
            </div>

        
        @endforeach                                 

            
        </div>
    </div>
        
    </section>

    <!-- collection banner -->
    
    <!-- collection banner end -->


    <!-- collection banner start -->
    <section style="background-color:#c3caf8" class="banner-furniture ratio2_1  banner-padding">
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
                <!--<div class="col-md-4">-->
                <!--    <a href="#">-->
                <!--        <div class="collection-banner p-right text-end">-->
                <!--            <div class="img-part">-->
                <!--                <img src="{{url('frontend_assets/img/banner/2.jpg')}}"-->
                <!--                    class="img-fluid  lazyload bg-img" alt="">-->
                <!--            </div>-->
                <!--            <div class="contain-banner banner-3">-->
                <!--                <div>-->
                <!--                    <h4>10% off</h4>-->
                <!--                    <h2>earplug</h2>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </a>-->
                <!--</div>-->
                <!--<div class="col-md-4">-->
                <!--    <a href="#">-->
                <!--        <div class="collection-banner p-right text-end">-->
                <!--            <div class="img-part">-->
                <!--                <img src="{{url('frontend_assets/img/banner/4.jpg')}}"-->
                <!--                    class="img-fluid  lazyload bg-img" alt="">-->
                <!--            </div>-->
                <!--            <div class="contain-banner banner-3">-->
                <!--                <div>-->
                <!--                    <h4>50% off</h4>-->
                <!--                    <h2>best deal</h2>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </a>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <!-- collection banner end -->



 <div class="title1 title-fancy section-t-space">
        <h4>exclusive products</h4>
        <h2 class="title-inner1 title-gradient">Auction products</h2>
    </div>
	
    
    <!-- Paragraph end -->


    <!-- Product section -->
    <section style="background-color: #e9f7ff" class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">
			 @if(count($products) > 0)
                @foreach($products as $product )
                    <?php
                   
                       $productdetails = App\Models\auction\auction::where('product_id',$product->product_id)->get();
                         
                        //  print_r($productdetails);
                        // print_r($category);
                    ?>
                    @foreach($productdetails as $productdetail )
                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                            <div class="img-wrapper">
                                <div class="front">
                                    <?php   
                                        // $proimg = @json_decode($productdetail->product_detail_image);
                                        // dd($proimg);
                                    ?>
                                        {{-- @foreach ($proimg as $key => $value)
                                            @if($key == 0) --}}
                                            
                                            
                                                {{-- @endif
                                        @endforeach --}}
                                </div>

                                <div class="img-wrapper auction-panel">
                                    <div class="front">
                                        <a href="{{ route('addtocart', $product->product_id ) }}"><img
                                            src="{{ asset('assets/images/products') . '/' . $product->product_image }}"
                                            class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    </div>
                                   
                                     <div class="product-detail">
                                   
                                    {{-- <a href="product_view.php">
                                        <h6>Slim Fit Cotton Shirt</h6>
                                    </a> --}}
                                   <h5>Starting  <span>Rs.{{$productdetail->start_price}}</span></h5>
                                  
                                   <div class="btn auction-btn btn-lg pt-2" data-bs-toggle="modal" data-bs-target="#addtocart{{$productdetail->id}}">Bid Now</div><br><br>
                                   <div>
                                    <!--<p  style="font-size:20px;border-color:#009ffd;"id="demo"></p>-->
                                   <p style="font-size:15px; font-weight:bold;margin-left: -10px;">Days  &nbsp  Hrs  &nbsp    Min &nbsp    Sec</p>
                                   </div>
                                </div>
                                </div>
                                <?php 
                                // print_r($productdetail->id); 
                                ?>
                               
                                {{-- <div class="cart-info cart-wrap">
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                            class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div> --}}
                              {{-- <a class="add-button" href="{{ route('addtocart', $product->product_id ) }}">View Product</a> --}}
                            </div>
                            {{-- <div class="product-detail">

                                <a href="{{ route('addtocart', $product->product_id ) }}">
								<h6>{{ $product->product_name }}</h6>
                                </a> --}}
								{{-- <h5> <span>Rs.{{ $productdetail->selling_price }}</span></h5> --}}
                            {{-- </div> --}}
                        </div>


                        <!-- -->
                        <!-- Modal -->
                            <div class="modal fade" id="addtocart{{$productdetail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bid Amount</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    
                                    
                                    <form  action="{{ route('bidamt') }}" class="" id ="" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-body">
                                                <?php 
                                                    $maxbit = App\Models\bidamount::where('auction_id',$productdetail->id)->max('bid_value');
                                                    $lastbid = ($maxbit>0)?$maxbit:$productdetail->start_price;
                                                 ?>
                                                <label for="html" style="color:#3147FE;font-size:20px;">Last Bidding Amount:<span  style="color:#FE3431;font-size:20px;">&nbsp;{{ $lastbid}}</span></label><br>
                                                <!--<label for="html" style="color:#FE31FB;font-size:20px;">Next Bid Amount = Last Bidding Amount + {{ $productdetail->slab }}</label><br> -->
                                                
                                                <div class="form-check">
                                                  
                                                  <input type="radio" name='cbox' id ='cbox' value="{{ $lastbid +$productdetail->slab}}" class="theClass" onclick="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})"/>
                                                      
                                                     <span style="background-color: #2196F3;" class="label label-rounded">
                                                          {{ $lastbid +$productdetail->slab}}</span>

                                                   
                                                  
                                                </div>
                                                <div class="form-check">
                                                  <input type="radio" name='cbox' id ='cbox' value="{{ $lastbid +$productdetail->slab *2 }}" class="theClass" onclick="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})"/>
                                                  <label class="form-check-label" for="flexRadioDefault2">
                                                   {{ $lastbid +$productdetail->slab *2  }}
                                                  </label>
                                                </div>
                                                <div class="form-check">
                                                  <input type="radio" name='cbox' id ='cbox' value="{{ $lastbid +$productdetail->slab *3}}" class="theClass" onclick="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})"/>
                                                  <label class="form-check-label" for="flexRadioDefault2">
                                                   {{ $lastbid +$productdetail->slab *3}}
                                                  </label>
                                                </div>
                                                
                                                <div class="form-check">
                                                  <input type="radio" name='cbox' id ='cbox' value="{{ $lastbid +$productdetail->slab *5 }}" class="theClass" onclick="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})"/>
                                                  <label class="form-check-label" for="flexRadioDefault2">
                                                   {{ $lastbid +$productdetail->slab *5 }}
                                                  </label>
                                                </div>
                                                <div class="form-check">
                                                  <input type="radio" name='cbox' id ='cbox' value="{{ $lastbid +$productdetail->slab *10}}" class="theClass" onclick="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})"/>
                                                  <label class="form-check-label" for="flexRadioDefault2">
                                                   {{ $lastbid +$productdetail->slab *10}}
                                                  </label>
                                                </div>
                                                
                                              <span style="color:blue;font-size:20px;"> Your Bid Amount is</span> <input type="text" id = "bid_value{{ $productdetail->id }}" name ="bid_value"  value =""  onblur="myFunction({{ $productdetail->id }},{{ ($lastbid+$productdetail->slab) }}, {{ ($lastbid+$productdetail->slab*2) }} , {{ ($lastbid+$productdetail->slab*3 ) }} , {{ ($lastbid+$productdetail->slab*5 ) }} , {{ ($lastbid+$productdetail->slab*10 ) }})" required>
                                                <input type="hidden" id = "pro_id{{ $productdetail->id }}" name ="pro_id" value = {{ $productdetail->id }}>
                                                <input type="hidden" id = "pro_val{{ $productdetail->id }}" name = "pro_val" value = {{ $productdetail->bid_price }}>

                                                <input type="hidden" id = "product_val" name = "product_val" value = {{ $productdetail->start_price }}>
                                                <input type="hidden" id = "admin_id" name = "admin_id" value = {{ $productdetail->admin_id }}>
                                                <input type="hidden" id = "product_type" name = "product_type" value = {{ $productdetail->product_type }}>
                                                <input type="hidden" id = "product_id" name = "product_id" value = {{ $productdetail->product_id }}>
                                                <input type="hidden" id = "slab{{ $productdetail->id }}" name = "slab" value = {{ $productdetail->slab }}>
                                                <input type="hidden" id = "bid_price" name = "bid_price" value = {{ $productdetail->bid_price }}>
                                                <input type="hidden" id = "max_price{{ $productdetail->id }}" name = "max_price" value = {{ $lastbid }}>
                          
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="bidbtn{{ $productdetail->id }}">Bid Now</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearBidValue({{ $productdetail->id }})">Close</button>
                                                
                                            </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                        <!--End -->
                    @endforeach
                @endforeach
				@else
				<div class="product-box col-12">
				<center><img   src="{{ asset('assets/images/products/no-product-found.png')}}" class="img-fluid  lazyload bg-img" alt=""></center>
				</div>
				@endif
                
                <!--  -->

  
                <!--  -->
                
            </div>
        </div>
    </section>
	
 <h3 align="center" class="title-inner1 title-gradient">Offer Section</h3>
<section style="background-color:#f1e9ff" class="section-b-space">
        <div class="container-lg container">
            
            <div class="row margin-default ratio_square ">
                
                @php $b=array(); @endphp
               
                    @foreach($offers as $offers1 )
                    @php array_push($b,$offers1->type);@endphp
                
                    @endforeach
                    
                 @php $offers2 = array_unique($b);@endphp
              
                   @foreach($offers2 as $offers3 )
                    <div class="col-xl-2 col-md-3 col-sm-4 col-4">
                        <a href="#">
                        <div class="deal-category">
                                <img src="{{url('frontend_assets/images/gradient/deal-bg/1.jpg')}}" class="img-fluid w-100" alt="">
                                <div class="deal-content">
                                <div>
                                        <h2>{{ $offers3 }}</h2>
                                          {{-- <h2>60%</h2>
                                        <h2 class="mb-0">off</h2> --}}
                                    </div>
                                </div>
                        </div>
                        </a>

                    </div>
                    @endforeach
              
           </div>
       </div>
  </section>
    <!-- category section start -->
   
    
     <h3 align="center" class="title-inner1 title-gradient">Top pics Men</h3>
      <section style="background-color:#ebbdfb">
        <div class="container container-lg">
            <div class="row margin-default ratio_square">
                @foreach ($categorymain as $categorymains)

                    @if($categorymains->category_main_name =='Men')
                    
                    @foreach ($products1 as $item)
                        @if($categorymains->id == $item->category_main)
                        <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                            <a href="{{ route('addtocart', $item->id ) }}">
                                <div class="gradient-category">
                                    <div class="gradient-border">
                                        <div class="img-sec">
                                            <img src="{{ asset('assets/images/products') . '/' . $item->product_image }}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <h4>{{$categorymains->category_main_name }}</h4>
                                </div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                    
                    @endif
                @endforeach
                
            </div>
        </div>
    </section>
    
    
        <h3 align="center" class="title-inner1 title-gradient">Top pics Women</h3>
         <section style="background-color:#d2addf">
            <div class="container container-lg">
            <div class="row margin-default ratio_square">
                @foreach ($categorymain as $categorymains)

                    @if($categorymains->category_main_name =='Women')
                    
                    @foreach ($products1 as $item)
                        @if($categorymains->id == $item->category_main)
                        <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                            <a href="{{ route('addtocart', $item->id ) }}">
                                <div class="gradient-category">
                                    <div class="gradient-border">
                                        <div class="img-sec">
                                            <img src="{{ asset('assets/images/products') . '/' . $item->product_image }}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <h4>{{$categorymains->category_main_name }}</h4>
                                </div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                    
                    @endif
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
                                    <h4>{!! html_entity_decode($paid_adv1->title) !!}</h4>
                                    <h2>{!! html_entity_decode($paid_adv1->sub_title) !!}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
              
            </div>
        </div>
    </section>

    <!-- product slider -->
	
	 <div class="title1 title-fancy section-t-space">
        <h4>exclusive products</h4>
        <h2 class="title-inner1 title-gradient">special products</h2>
    </div>
    <section style="background-color:#e1cdf6" class="section-b-space pt-0 ratio_asos">
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
                                    <!--<a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i-->
                                    <!--        class="ti-heart" aria-hidden="true"></i></a>-->
                                    <!--<a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"-->
                                    <!--    tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>-->
                                    <!--<a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"-->
                                    <!--        aria-hidden="true"></i></a>-->
                                </div>
                              <!--<a class="add-button" href="{{ route('addtocart', $product->product_id ) }}">View Product</a>-->
                            </div>
                            <div class="product-detail">

                                <a href="{{ route('addtocart', $product->product_id ) }}">
								 <?php
                                
                                $vendarname = App\Models\User::where('login_id',$product->created_by)->first();   
                                // dd($vendarname);
                                $productdetails = App\Models\Products\ProductsDetails::where('products_id',$product->id)->first();   
                        
                                if($product->product_id == $productdetails->products_id)
                                    {
                                        ?>
                                        
                                            <h6>{{ $vendarname->name }}</h6>
                                            <h6>{{ $product->product_name }}</h6>
                                            <h4>Rs.{{ $productdetails->selling_price }} <del>Rs {{ $productdetails->retail_price }}</del></h4>
                                            <!--<h6>Size.{{ $productdetails->size }}</h6>-->
                                            <ul class="color-variant">
                                             <li style="background-color:{{ $productdetails->color }};"></li>
                                            </ul>
                                   <?php
                                    }
                                  ?>
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
		 <!-- <div class="row">
                <div class="col">
                    <div class="theme-tab">
                        <ul class="tabs tab-title">
                            <li class="current"><a href="tab-4">RECENTLY VIEWED</a></li>
                            <li class=""><a href="tab-5">RECOMMENDED ITEMS</a></li>
                            <li class=""><a href="tab-6">POPULAR</a></li>
                        </ul>
                        <div class="tab-content-cls">
                            <div id="tab-4" class="tab-content active default">
                                <div class="no-slider row five-product">
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/1.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/2.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/3.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/4.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/top/1/1.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/top/2/1.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/top/3/1.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/top/4/1.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/5.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <a href="#"><img
                                                    src="{{url('frontend_assets/img/product/saree/6.jpg')}}"
                                                    class="img-fluid  lazyload bg-img" alt=""></a>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="detail-inline">
                                                <a href="#">
                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                </a>
                                                <h4>₹500.00</h4>
                                            </div>
                                            <ul class="color-variant pt-0">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-5" class="tab-content">
                                <div class="no-slider row">
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/33.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/34.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-box cart-box-bottom">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/35.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/36.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/1.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/2.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/27.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/28.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/27.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/28.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/1.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/2.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/33.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/34.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/35.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/36.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-6" class="tab-content">
                                <div class="no-slider row">
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/33.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/34.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/27.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/28.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/33.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/34.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/1.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/2.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/35.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/36.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/35.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/36.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block"><span class="lable-gradient">new</span> <span
                                                    class="lable4">on sale</span></div>
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/1.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/2.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/27.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="back">
                                                <a href="#"><img
                                                        src="{{url('frontend_assets/images/pro3/28.jpg')}}"
                                                        class="img-fluid  lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-bs-toggle="modal" data-bs-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button> <a
                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                        class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="#">
                                                <h6>Slim Fit Cotton Shirt</h6>
                                            </a>
                                            <h4>₹500.00</h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        --></div>
    </section>
    
    <!-- product slider -->


    <!-- deal zone section start -->
   
    <!-- deal zone section end -->


   


   
	<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("july 5, 2022 15:37:25").getTime();
    
    // // Update the count down every 1 second
    // var x = setInterval(function() {
    
    //   // Get today's date and time
    //   var now = new Date().getTime();
        
    //   // Find the distance between now and the count down date
    //   var distance = countDownDate - now;
        
    //   // Time calculations for days, hours, minutes and seconds
    //   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    //   // Output the result in an element with id="demo"
    //   document.getElementById("demo").innerHTML = "&nbsp&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //   document.getElementById("demo1").innerHTML = "&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //   document.getElementById("demo2").innerHTML = "&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //   document.getElementById("demo3").innerHTML = "&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //     document.getElementById("demo4").innerHTML ="&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //   document.getElementById("demo5").innerHTML = "&nbsp"+days + "&nbsp&nbsp &nbsp  " + hours + "&nbsp &nbsp&nbsp  "
    //   + minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
    //   // If the count down is over, write some text 
    //   if (distance < 0) {
    //     clearInterval(x);
    //     document.getElementById("demo").innerHTML = "EXPIRED";
    // 	 document.getElementById("demo1").innerHTML = "EXPIRED";
    // 	  document.getElementById("demo2").innerHTML = "EXPIRED";
    // 	   document.getElementById("demo3").innerHTML = "EXPIRED";
    // 	    document.getElementById("demo4").innerHTML = "EXPIRED";
    // 		 document.getElementById("demo5").innerHTML = "EXPIRED";
    //   }
    // }, 1000);
</script>
<script>
        function myFunction(data,nextval, nextval2, nextval3, nextval4, nextval5 ) {
            
            
            
            //var bidValue = $('#bid_value'+data).val();
            
            

            
            $('input[type=radio]').on('change', function() {
            if($(this).is(':checked')){
                var bidValue    = ($(this).val());
                
                $('#bid_value'+data).val(bidValue);
              
                $('#bidbtn'+data).removeAttr("type").attr("type", "submit");
                }
                else{
                $('#bidbtn'+data).removeAttr("type").attr("type", "button");
                }
            });
            
             
            // if(parseInt(bidValue) == parseInt(nextval))
            // {
            //     alert(nextval);
            //     // $('#bid_value'+data).val(nextval);
            //     // $('#bidbtn'+data).removeAttr("type").attr("type", "submit");
            // }
            
            // else if(parseInt(bidValue) == parseInt(nextval2))
            // {
            //     alert(nextval2);
            //     // $('#bid_value'+data).val(nextval2);
            //     // $('#bidbtn'+data).removeAttr("type").attr("type", "submit");
            // }
            // else if(parseInt(bidValue) == parseInt(nextval3))
            // {
            //     alert(nextval3);
            //     // $('#bid_value'+data).val(nextval3);
            //     // $('#bidbtn'+data).removeAttr("type").attr("type", "submit");
            // }


            // else
            // {
            //     alert('Next Bid Amount is '+nextval);
            //     $('#bid_value'+data).val(0);
            //     $('#bidbtn'+data).removeAttr("type").attr("type", "button");
            // }
           
        }

        function clearBidValue(data) {
    
            var inputElement = document.getElementById('bid_value'+data);
    
    
            inputElement.value = '';
    }
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


    
    
   $(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>
   @include('website.front-end.newfooter')