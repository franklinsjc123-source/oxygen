<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    
    @include('paritials.website.header')
    @include('website.partials.js.frontendjs')
    @include('website.partials.css.frontendcss');
    
   
</head>

<body class="theme-color-29">


    <!-- loader start -->

    <!-- loader end -->


    <!-- header start -->
    {{-- @include('paritials.website.header'); --}}
    <!-- header end -->
    <div class="title1 section-t-space pt-5">

        <h4 class="title-inner1 text-left">Collection of Products</h4>
    </div>

    <!-- Paragraph end -->


    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">

                @foreach($product as $products )
                    <?php
                $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products->product_id)->get();
                //  print_r($productdetails);
               // print_r($category);
                ?>
                    @foreach($productdetails as $productdetail )
                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                            <div class="img-wrapper">
                                <div class="front">
                                    <?php   
                                        $proimg = @json_decode($productdetail->product_detail_image);
                                    // dd($proimg);
                                    ?>
                                    @foreach ($proimg as $key => $value)
                                        @if($key == 0)
                                        
                                            <a href="{{ route('addtocart', $productdetail->id ) }}"><img
                                            src="{{ asset('assets/images/products/detail') . '/' . $value }}"
                                            class="img-fluid blur-up lazyload bg-img" alt="" style="width:200px;height:200px;"></a>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="cart-info cart-wrap">
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                            class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                        tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div>
                                <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                                    cart</div>
                            </div>
                            <div class="product-detail">
                                <?php
                                 $vendarname = App\Models\User::where('login_id',$products->created_by)->first(); 
                                 
                                 ?>
                                <a href="{{ route('addtocart', $productdetail->id ) }}">
                                    
                                <h4 style="background-color:lightgray;">{{ $vendarname->name }}</h4>
                                <h6><b>{{ $products->product_name }}</b></h6>
                                            @php
                                            $disc = $productdetail->retail_price -$productdetail->selling_price;
                                            $offerperc = $disc/$productdetail->retail_price *100;
                                            @endphp
                                            <h6>Rs.{{ $productdetail->selling_price }} <del>Rs {{ $productdetail->retail_price }}</del><span style="color:red;">({{round($offerperc)}}%Off)</span></h6>
                                            
                                            <ul class="color-variant">
                                             <li style="background-color:{{ $productdetail->color }};"></li>
                                            </ul>
                                
                                </a>
                                

                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </section>


    
   
    <script>
        new WOW().init();

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("july 5, 2022 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = "&nbsp&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo1").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo2").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo3").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo4").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            document.getElementById("demo5").innerHTML = "&nbsp" + days + "&nbsp&nbsp &nbsp  " + hours +
                "&nbsp &nbsp&nbsp  " +
                minutes + "  &nbsp&nbsp&nbsp " + seconds + " &nbsp&nbsp&nbsp ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("demo1").innerHTML = "EXPIRED";
                document.getElementById("demo2").innerHTML = "EXPIRED";
                document.getElementById("demo3").innerHTML = "EXPIRED";
                document.getElementById("demo4").innerHTML = "EXPIRED";
                document.getElementById("demo5").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

</body>
@include('website.front-end.newfooter')
</html>