 
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
@include('paritials.website.menu')

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
{{-- @dd($products); --}}

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
                            //  dd($product);
                                $vendarname = App\Models\User::where('login_id',$product->created_by)->first();   
                                // dd(count($vendarname));
                                // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$product->id)->first();   
                                
                                $disc = App\Models\Offer\Offer::where('id',$product->offers)->first();
                                // dd($disc);
                        
                                            
                                            ?>
                                           <h6 style="background-color:lightgray;">{{ $vendarname->name }}</h6>
                                            <h6>{{ $product->product_name }}</h6>
                                            @php
                                            $disc = $product->retail_price -$product->selling_price;
                                            $offerperc = $disc/$product->retail_price *100;
                                            @endphp
                                            <h6>Rs.{{ $product->selling_price }} <del>Rs {{ $product->retail_price }}</del><span style="color:red;">Offer: {{round($offerperc)}}%</span></h6>
                                            
                                            <ul class="color-variant">
                                             <li style="background-color:{{ $product->color }};"></li>
                                            </ul>
                                
                         </a>
    
                    </div>
                </div>
               
            </div>

        
        @endforeach                                 

            
        </div>
    </div>
        
    </section>

<script>
        function myFunction(data,nextval, nextval2, nextval3, nextval4, nextval5 ) {
    
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