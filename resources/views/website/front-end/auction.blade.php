@include('website.front-end.newhead')
 
 {{-- @include('website.front-end.newheader') --}}
    <!-- header end -->


    @include('website.partials.js.frontendjs')
    @include('paritials.js.userwebsite.cart_js')
    @include('website.partials.css.frontendcss');
   

    <!-- loader start -->

    <!-- loader end -->


    <!-- header start -->
    @include('paritials.website.header')
    <!-- header end -->
    <div class="title1 section-t-space pt-5">

        <h4 class="title-inner1 text-left">DEAL OF THE DAY</h4>
    </div>

    <!-- Paragraph end -->


    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">

                @foreach($auction as $auct )
                    <?php
                    $productdetails = App\Models\Products\Products::where('product_id',$auct->product_id)->get();
                // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$auct->product_id)->get();
                //  print_r($productdetails);
               // print_r($category);
                ?>
                    @foreach($productdetails as $productdetail )
                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{ route('addtocart', $productdetail->id ) }}"><img
                                            src="{{ asset('assets/images/products/') . '/' . $productdetail->product_image }}"
                                            class="img-fluid  lazyload bg-img" alt=""></a>
                                </div>
                                <div class="cart-info cart-wrap">
                                    <!--<a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i-->
                                    <!--        class="ti-heart" aria-hidden="true"></i></a>-->
                                    <!--<a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"-->
                                    <!--    tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>-->
                                    <!--<a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"-->
                                    <!--        aria-hidden="true"></i></a>-->
                                </div>
                                <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                                    cart</div>
                            </div>
                            <div class="product-detail">

                                <a href="{{ route('addtocart', $productdetail->id ) }}">
                                    <!--<h6>{{ $productdetail->selling_price }}</h6>-->
                                </a>

                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </section>
    
    <!-- footer -->

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

@include('website.front-end.newfooter')