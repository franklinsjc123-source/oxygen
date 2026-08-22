 
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

    @media (max-width: 767px) {
        .home-slider .home,
        .home-slider .slider-contain {
            height: 260px !important;
        }
    }
    @media (max-width: 480px) {
        .home-slider .home,
        .home-slider .slider-contain {
            height: 260px !important;
        }
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
      <div class="container-fuild px-4">
        @php
            $hasResults = isset($groupedProducts) && $groupedProducts->count() > 0;
        @endphp

        @if(!$hasResults)
            <div class="pt-4 pb-4">
                <h5>No products found for "{{ $keyword ?? '' }}".</h5>
            </div>
        @endif

        @foreach(($groupedProducts ?? collect()) as $groupName => $groupItems)
            <div class="pt-4">
                <h4 class="title-inner1 text-left">{{ $groupName }}</h4>
            </div>
            <div class="row game-product grid-products">
                @foreach($groupItems as $product)
                    <div class="gallery_product product-box col-xl-2 col-lg-3 col-sm-4 col-6 default">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{ route('addtocart', $product->product_id ) }}">
                                        <img src="{{ asset('assets/images/products') . '/' . $product->product_image }}" class="img-fluid blur-up lazyload bg-img" alt="">
                                    </a>
                                    @if(isset($product->offer_image) && $product->offer_image != '')
                                       <div class="product-label-group" style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                                           <img src="{{ asset('assets/images/offer_logo/'.$product->offer_image) }}" alt="Offer" style="width: 45px; height: 45px; object-fit: contain; border-radius: 5px; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));">
                                       </div>
                                    @endif
                                </div>
                            </div>
                            <div class="product-detail">
                                <a href="{{ route('addtocart', $product->product_id ) }}">
                                    <?php $vendarname = App\Models\User::where('login_id', $product->created_by)->first(); ?>
                                    <h6 style="background-color:lightgray;">{{ $vendarname->name ?? 'Vendor' }}</h6>
                                    <h6>{{ $product->product_name }}</h6>
                                    @php
                                        $retail = (float) ($product->retail_price ?? 0);
                                        $selling = (float) ($product->selling_price ?? 0);
                                        $offerperc = $retail > 0 ? (($retail - $selling) / $retail) * 100 : 0;
                                        $displayColor = $product->attributevalue1 ?? '#d9d9d9';
                                    @endphp
                                    <h6>Rs.{{ $selling }} <del>Rs {{ $retail }}</del><span style="color:red;">Offer: {{ round($offerperc) }}%</span></h6>
                                    <ul class="color-variant">
                                        <li style="background-color:{{ $displayColor }};"></li>
                                    </ul>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
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
